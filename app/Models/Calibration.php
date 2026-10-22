<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calibration extends Model
{
    use SoftDeletes;
    
    public static $preventUpdating = false;
    protected $table = 'calibrations';
    
    protected $fillable = [
        'id','no_label','id_alat','form_type','jumlah_form','NIK', 'namaAlat', 'LK', 'brandAlat', 'kodeAlat', 'typeAlat', 'skala','NoSeri', 'kapasitas',
        'resolusi','rangeMin','rangeMax', 'pemilikAlat', 'no_po', 'tanggalMasuk','tanggalKalibrasi','NextTanggalKalibrasi', 'tempatKalibrasi', 'jenisPembacaan',
        'lokasiPT', 'RT_condition1', 'RT_condition2', 'RT_condition3',
        'RH_condition1', 'RH_condition2', 'RH_condition3', 'kondisiAlat', 'keterangan',
        'status', 
        'status_transaction',
        'calibratedBy', 'calibrated', 'verifiedBy', 'verified', 'approvedBy', 'approved','type','capacity','location_data','reason','kode_th','additional_forms','subform_identities'
    ];
// Tambahkan ini untuk memberi tahu Laravel bahwa id bukan auto-increment
    public $incrementing = false;
    
    // Tambahkan ini untuk memberi tahu Laravel bahwa tipe data id adalah string
    protected $keyType = 'string';
    protected $casts = [
        'tanggalMasuk' => 'date', 
        'calibrated' => 'date',
        'verified' => 'date',
        'approved' => 'date',
        'status_transaction' => 'array',
        'additional_forms'=>'array',
    ];

    // Constants untuk status baru
    const STATUS_DRAFT = 'draft';
    const STATUS_WAITING_VERIFICATION = 'waiting_verification';
    const STATUS_WAITING_APPROVAL = 'waiting_approval';
    const STATUS_VERIFIED = 'verified';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    const STATUS_COMPLETED = 'completed';

     // Tambahkan relasi ke log_kalibrasi (LogKalibrasi model yang sudah kita buat)
    public function logs()
    {
        return $this->hasMany(LogKalibrasi::class, 'kalibrasi_id')->orderBy('created_at', 'desc');
    }

            protected static function boot()
{
    parent::boot();
    
    static::updating(function ($model) {
            if (self::$preventUpdating) {
                \Log::info("🚫 Prevented updating main calibration record during subform save.");
                return false; // Cancels update
            }
        });

    static::created(function ($model) {
        // COMMENT ini dulu:
        // buat_log_kalibrasi([
        //     'kalibrasi_id' => $model->id,
        //     'aksi' => 'BUAT',
        //     'deskripsi' => 'Data kalibrasi baru dibuat - ' . $model->namaAlat . ' (' . $model->kodeAlat . ')',
        //     'data_baru' => $model->toArray()
        // ]);
        
        // Ganti dengan logging sederhana:
        \Log::info('📝 CALIBRATION CREATED', [
            'id' => $model->id,
            'namaAlat' => $model->namaAlat,
            'kodeAlat' => $model->kodeAlat,
            'user' => auth()->user()?->name ?? 'System'
        ]);
    });

    static::updated(function ($model) {
        $original = $model->getOriginal();
        $changes = $model->getChanges();
        
        // Remove timestamps from changes
        unset($changes['updated_at']);
        
        if (!empty($changes)) {
            // Filter hanya field yang penting untuk log
            $filteredChanges = array_intersect_key($changes, array_flip([
                'namaAlat', 'kodeAlat', 'brandAlat', 'status', 'kondisiAlat', 
                'verifiedBy', 'approvedBy', 'reason'
            ]));
            
            if (!empty($filteredChanges)) {
                $data_lama = array_intersect_key($original, $filteredChanges);
                $data_baru = $filteredChanges;
                
                $deskripsi = 'Data kalibrasi diperbarui';
                
                // Tambahkan deskripsi khusus untuk status change
                if (isset($filteredChanges['status'])) {
                    $statusMessages = [
                        self::STATUS_WAITING_VERIFICATION => 'Data dikirim untuk verifikasi',
                        self::STATUS_WAITING_APPROVAL => 'Data menunggu approval',
                        self::STATUS_VERIFIED => 'Data telah diverifikasi',
                        self::STATUS_APPROVED => 'Data telah disetujui',
                        self::STATUS_REJECTED => 'Data ditolak',
                        self::STATUS_COMPLETED => 'Proses selesai'
                    ];
                    
                    $deskripsi = $statusMessages[$filteredChanges['status']] ?? 'Status berubah';
                    
                    if ($filteredChanges['status'] === self::STATUS_REJECTED && !empty($model->reason)) {
                        $deskripsi .= ' - Alasan: ' . $model->reason;
                    }
                }
                
                // COMMENT ini:
                // buat_log_kalibrasi([
                //     'kalibrasi_id' => $model->id,
                //     'aksi' => 'UBAH',
                //     'deskripsi' => $deskripsi,
                //     'data_lama' => $data_lama,
                //     'data_baru' => $data_baru
                // ]);
                
                // Ganti dengan:
                \Log::info('✏️ CALIBRATION UPDATED', [
                    'id' => $model->id,
                    'aksi' => 'UBAH',
                    'deskripsi' => $deskripsi,
                    'data_lama' => $data_lama,
                    'data_baru' => $data_baru,
                    'user' => auth()->user()?->name ?? 'System'
                ]);
            }
        }
    });

    static::deleted(function ($model) {
        // COMMENT ini:
        // buat_log_kalibrasi([
        //     'kalibrasi_id' => $model->id,
        //     'aksi' => 'HAPUS',
        //     'deskripsi' => 'Data kalibrasi dihapus - ' . $model->namaAlat . ' (' . $model->kodeAlat . ')',
        //     'data_lama' => $model->toArray()
        // ]);
        
        // Ganti dengan:
        \Log::warning('🗑️ CALIBRATION DELETED', [
            'id' => $model->id,
            'namaAlat' => $model->namaAlat,
            'kodeAlat' => $model->kodeAlat,
            'user' => auth()->user()?->name ?? 'System'
        ]);
    });
}


    // Method untuk mendapatkan log berdasarkan aksi
    public function getLogsByAction($actionType, $limit = 20)
    {
        return $this->logs()
            ->where('aksi', $actionType)
            ->limit($limit)
            ->get();
    }

    // Method untuk mendapatkan workflow timeline
    public function getWorkflowTimeline()
    {
        return $this->logs()
            ->whereIn('aksi', ['BUAT', 'UBAH'])
            ->orderBy('created_at', 'asc')
            ->get();
    }

    // Method untuk mendapatkan user activities
    public function getUserActivities($nik)
    {
        return $this->logs()
            ->whereHas('user', function($query) use ($nik) {
                $query->where('NIK', $nik);
            })
            ->orderBy('created_at', 'desc')
            ->get();
    }

    // Method helper untuk status
    public function isDraft()
    {
        return $this->status === self::STATUS_DRAFT;
    }

    public function isWaitingVerification()
    {
        return $this->status === self::STATUS_WAITING_VERIFICATION;
    }

    public function isWaitingApproval()
    {
        return $this->status === self::STATUS_WAITING_APPROVAL;
    }

    public function isVerified()
    {
        return $this->status === self::STATUS_VERIFIED;
    }

    public function isApproved()
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function isRejected()
    {
        return $this->status === self::STATUS_REJECTED;
    }

    public function isCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }
    
     /**
     * Method untuk workflow otomatis dengan logging
     */
    public function markAsDraft($createdBy = null)
    {
        $transaction = $this->status_transaction ?? [];
        $user = auth()->user();
        
        $transaction['created_by'] = $user->name;
        $transaction['created_by_nik'] = $user->nik ?? $user->NIK ?? null;
        $transaction['created_at'] = now()->toDateTimeString();
        $transaction['draft_at'] = now()->toDateTimeString();
        $transaction['last_updated_by'] = $user->name;
        $transaction['last_updated_by_nik'] = $user->nik ?? $user->NIK ?? null;
        $transaction['last_updated_at'] = now()->toDateTimeString();
        
        $this->update([
            'status' => self::STATUS_DRAFT,
            'status_transaction' => $transaction
        ]);
        
        return $this;
    }

   
    
     /**
     * Method untuk workflow otomatis dengan logging
     */
    public function markAsWaitingVerification($createdBy = null)
    {
        $transaction = $this->status_transaction ?? [];
        $user = auth()->user();
        
        $transaction['created_by'] = $user->name;
        $transaction['created_by_nik'] = $user->nik ?? $user->NIK ?? null;
        $transaction['created_at'] = now()->toDateTimeString();
        $transaction['waiting_verification_at'] = now()->toDateTimeString();
        $transaction['last_updated_by'] = $user->name;
        $transaction['last_updated_by_nik'] = $user->nik ?? $user->NIK ?? null;
        $transaction['last_updated_at'] = now()->toDateTimeString();
        
        $this->update([
            'status' => self::STATUS_WAITING_VERIFICATION,
            'status_transaction' => $transaction
        ]);
        
        return $this;
    }

    /**
     * Set status verified dan waiting for approval
     */
    public function markAsVerified($verifiedBy = null, $note = null)
    {
        $transaction = $this->status_transaction ?? [];
        $user = auth()->user();
        
        $transaction['verified_by'] = $user->name;
        $transaction['verified_by_nik'] = $user->nik ?? $user->NIK ?? null;
        $transaction['verified_at'] = now()->toDateTimeString();
        $transaction['verified_note'] = $note ?? 'Data telah diverifikasi dan siap untuk approval';
        $transaction['waiting_approval_at'] = now()->toDateTimeString();
        $transaction['last_updated_by'] = $user->name;
        $transaction['last_updated_by_nik'] = $user->nik ?? $user->NIK ?? null;
        $transaction['last_updated_at'] = now()->toDateTimeString();
        
        $this->update([
            'status' => self::STATUS_WAITING_APPROVAL,
            'verified' => now(),
            'verifiedBy' => $user->name,
            'status_transaction' => $transaction
        ]);
        
        return $this;
    }

    /**
     * Set status approved
     */
    public function markAsApproved($approvedBy = null, $note = null)
    {
        $transaction = $this->status_transaction ?? [];
        $user = auth()->user();
        
        $transaction['approved_by'] = $user->name;
        $transaction['approved_by_nik'] = $user->nik ?? $user->NIK ?? null;
        $transaction['approved_at'] = now()->toDateTimeString();
        $transaction['approved_note'] = $note ?? 'Data telah disetujui';
        $transaction['last_updated_by'] = $user->name;
        $transaction['last_updated_by_nik'] = $user->nik ?? $user->NIK ?? null;
        $transaction['last_updated_at'] = now()->toDateTimeString();
        
        $this->update([
            'status' => self::STATUS_APPROVED,
            'approved' => now(),
            'approvedBy' => $user->name,
            'status_transaction' => $transaction
        ]);
        
        return $this;
    }

    /**
     * Set status rejected dengan alasan
     */
    public function markAsRejected($rejectedBy = null, $reason = null, $rejectedFrom = null)
    {
        $transaction = $this->status_transaction ?? [];
        $user = auth()->user();
        $rejectedFrom = $rejectedFrom ?? 'Approver';
        
        $transaction['rejected_by'] = $user->name;
        $transaction['rejected_by_nik'] = $user->nik ?? $user->NIK ?? null;
        $transaction['rejected_at'] = now()->toDateTimeString();
        $transaction['rejected_from'] = $rejectedFrom;
        $transaction['rejected_reason'] = $reason ?? 'Data ditolak tanpa alasan spesifik';
        $transaction['last_updated_by'] = $user->name;
        $transaction['last_updated_by_nik'] = $user->nik ?? $user->NIK ?? null;
        $transaction['last_updated_at'] = now()->toDateTimeString();
        
        $this->update([
            'status' => self::STATUS_REJECTED,
            'reason' => $reason,
            'status_transaction' => $transaction
        ]);
        
        return $this;
    }

    /**
     * Set status completed
     */
    public function markAsCompleted($completedBy = null, $note = null)
    {
        $transaction = $this->status_transaction ?? [];
        $user = auth()->user();
        
        $transaction['completed_by'] = $user->name;
        $transaction['completed_by_nik'] = $user->nik ?? $user->NIK ?? null;
        $transaction['completed_at'] = now()->toDateTimeString();
        $transaction['completed_note'] = $note ?? 'Proses kalibrasi selesai';
        $transaction['last_updated_by'] = $user->name;
        $transaction['last_updated_by_nik'] = $user->nik ?? $user->NIK ?? null;
        $transaction['last_updated_at'] = now()->toDateTimeString();
        
        $this->update([
            'status' => self::STATUS_COMPLETED,
            'status_transaction' => $transaction
        ]);
        
        return $this;
    }


    /**
     * Method untuk mendapatkan informasi status transaction
     */
    public function getVerifiedBy()
    {
        return $this->status_transaction['verified_by'] ?? null;
    }

    public function getApprovedBy()
    {
        return $this->status_transaction['approved_by'] ?? null;
    }

    public function getRejectedBy()
    {
        return $this->status_transaction['rejected_by'] ?? null;
    }

    public function getRejectedFrom()
    {
        return $this->status_transaction['rejected_from'] ?? null;
    }

    public function getRejectedReason()
    {
        return $this->status_transaction['rejected_reason'] ?? null;
    }

    public function getVerifiedNote()
    {
        return $this->status_transaction['verified_note'] ?? null;
    }

    public function getApprovedNote()
    {
        return $this->status_transaction['approved_note'] ?? null;
    }

    public function getCompletedNote()
    {
        return $this->status_transaction['completed_note'] ?? null;
    }

    public function getLastStatusUpdate()
    {
        return [
            'by' => $this->status_transaction['last_updated_by'] ?? null,
            'at' => $this->status_transaction['last_updated_at'] ?? null
        ];
    }

    /**
     * Accessor untuk mengembalikan Certificate ID / No Sertifikat
     */
    public function getCertificateIdAttribute()
    {
        if (!empty($this->attributes['certificate_id'])) {
            return $this->attributes['certificate_id'];
        }

        $formTypeMapping = [
            'inside_micrometer' => 'headInsideMicrometer',
            'outside_micrometer' => 'headOutsideMicrometer',
            'depth_micrometer' => 'headDepthMicrometer',
            'insulation' => 'headInsulation',
            'thermometer' => 'headThermometer',
            'dial_indicator' => 'headDialIndicator',
            'dial_test_indicator' => 'headDialTestIndicator',
            'depth_caliper' => 'headDepthCaliper',
            'caliper' => 'headCaliper',
            'torque_wrench' => 'headTorqueWrench',
            'torque_meter' => 'headTorqueMeter',
            'ultrasonic_thickness_gauge' => 'headUltrasonicThicknessGauge',
            'thickness_gauge' => 'headThicknessGauge',
            'penggaris' => 'headPenggaris',
            'enclosure' => 'headEnclosure',
            'chamber' => 'headChamber',
            'pressure_gauge' => 'headPressureGauge',
            'differential_pressure_gauge' => 'headDifferentialPressureGauge',
            'height_gauge' => 'headHeightGauge',
            'volumetrik' => 'headVolumetrik',
            'thermohygrometer' => 'headThermoHygrometer',
            'viscometer' => 'headViscometer',
            'push_pull' => 'headPushPull',
            'timbangan' => 'headTimbangan',
            'timbangan_moisture' => 'headTimbanganMoisture',
            'timbangan_bias' => 'headTimbanganBias',
            'anak_timbangan' => 'headAnakTimbangan',
            'gauge_block' => 'headGaugeBlock',
            'holetest' => 'headHoletest',
            'conductivity_meter' => 'headConductivityMeter',
            'coating_thickness' => 'headCoatingThickness',
            'durometer' => 'headDurometer',
            'mikropipet_dispenset' => 'headMikropipetDispenset',
            'taper_gauge' => 'headTaperGauge',
            'feeler_gauge' => 'headFeelerGauge',
            'ph_meter' => 'headPhMeter',
            'tachometer' => 'headTachometer',
            'pin_gauge' => 'headPinGauge',
            'visco_cup' => 'headViscoCup',
            'plain_limit_gauge' => 'headPlainLimitGauge',
            'temp_humid_transmitter' => 'headTempHumidTransmitter',
            'temp_transmitter' => 'headTempTransmitter',
            'ir_thermometer' => 'headIrThermometer',
            'thermo_indicator' => 'headThermoIndicator',
            'plastic_shim' => 'headPlasticShim',
            'profil_projector' => 'headProfilProjector',
            'surface_roughness_tester' => 'headSurfaceRoughnessTester',
            'thread_gauge' => 'headThreadGauge',
            'stopwatch' => 'headStopwatch',
            'centrifuge' => 'headCentrifuge',
            'utm' => 'headUtm',
            'pressure_transmitter' => 'headPressureTransmitter',
            'surface_plate' => 'headSurfacePlate',
            'bore_gauge' => 'headBoreGauge',
            'abration_tester' => 'headAbrationTester',
        ];

        $currentFormType = $this->form_type ?? '';
        if ($currentFormType && isset($formTypeMapping[$currentFormType])) {
            $headModel = $formTypeMapping[$currentFormType];
            if (method_exists($this, $headModel)) {
                $rel = $this->$headModel;
                if ($rel) {
                    $cert = $rel->certificate_id ?? $rel->no_sertifikat ?? $rel->no_certificate ?? null;
                    if (!empty($cert)) {
                        return $cert;
                    }
                }
            }
        }

        return null;
    }

    public function getNoSertifikatAttribute()
    {
        return $this->certificate_id;
    }

    public function headInsideMicrometer()
    {
        return $this->hasOne(HeadInsideMicrometer::class, 'calibration_id');
    }
    
    public function headInsideMicrometerForm1()
    {
        return $this->hasOne(HeadInsideMicrometer::class, 'calibration_id')->where('form_index', 1);
    }
    
    public function headInsideMicrometerForm2()
    {
        return $this->hasOne(HeadInsideMicrometer::class, 'calibration_id')->where('form_index', 2);
    }
    
    public function headInsideMicrometerForm3()
    {
        return $this->hasOne(HeadInsideMicrometer::class, 'calibration_id')->where('form_index', 3);
    }
    
    public function headInsideMicrometerForm4()
    {
        return $this->hasOne(HeadInsideMicrometer::class, 'calibration_id')->where('form_index', 4);
    }
    
    public function detailInsideMicrometers()
    {
        return $this->hasMany(DetailInsideMicrometer::class);
    }

    public function headOutsideMicrometers()
    {
        return $this->hasMany(HeadOutsideMicrometer::class, 'calibration_id');
    }

    public function headOutsideMicrometer()
    {
        return $this->hasOne(HeadOutsideMicrometer::class, 'calibration_id');
    }

    public function headOutsideMicrometerForm($formIndex = 1)
    {
        return $this->hasOne(HeadOutsideMicrometer::class, 'calibration_id')->where('form_index', $formIndex);
    }
    
    public function detailOutsideMicrometers()
    {
        return $this->hasMany(DetailOutsideMicrometer::class, 'calibration_id');
    }

    public function addOutsideMicrometers()
    {
        return $this->hasMany(AddOutsideMicrometer::class, 'calibration_id');
    }

    public function addOutsideMicrometer()
    {
        return $this->hasOne(AddOutsideMicrometer::class, 'calibration_id');
    }

    public function addOutsideMicrometerForm($formIndex = 1)
    {
        return $this->hasOne(AddOutsideMicrometer::class, 'calibration_id')->where('form_index', $formIndex);
    }

    /**
     * Handle dynamic relationship calls for form_index (e.g. headOutsideMicrometerForm5, addOutsideMicrometerForm6)
     */
    public function __call($method, $parameters)
    {
        if (preg_match('/^headOutsideMicrometerForm(\d+)$/', $method, $matches)) {
            return $this->headOutsideMicrometerForm((int) $matches[1]);
        }

        if (preg_match('/^addOutsideMicrometerForm(\d+)$/', $method, $matches)) {
            return $this->addOutsideMicrometerForm((int) $matches[1]);
        }

        return parent::__call($method, $parameters);
    }

    /**
     * Handle dynamic relationship property access for form_index (e.g. $calibration->headOutsideMicrometerForm5)
     */
    public function getRelationValue($key)
    {
        if ($this->relationLoaded($key)) {
            return $this->relations[$key];
        }

        if (preg_match('/^(headOutsideMicrometerForm|addOutsideMicrometerForm)(\d+)$/', $key)) {
            return $this->getRelationshipFromMethod($key);
        }

        return parent::getRelationValue($key);
    }
    
    public function headDepthMicrometer()
    {
        return $this->hasOne(HeadDepthMicrometer::class, 'calibration_id');      
    }
    
      public function headDepthMicrometerForm1()
    {
        return $this->hasOne(HeadDepthMicrometer::class, 'calibration_id')->where('form_index', 1);
    }
    
    public function headDepthMicrometerForm2()
    {
        return $this->hasOne(HeadDepthMicrometer::class, 'calibration_id')->where('form_index', 2);
    }
    
    public function headDepthMicrometerForm3()
    {
        return $this->hasOne(HeadDepthMicrometer::class, 'calibration_id')->where('form_index', 3);
    }
    
    public function headDepthMicrometerForm4()
    {
        return $this->hasOne(HeadDepthMicrometer::class, 'calibration_id')->where('form_index', 4);
    }
    
      
    public function detailDepthMicrometers()
    {
        return $this->hasMany(DetailDepthMicrometer::class);
    }
       
    public function headThermometer()
    {
        return $this->hasOne(HeadThermometer::class, 'calibration_id');
    }
    
      public function headThermometerForm1()
    {
        return $this->hasOne(HeadThermometer::class, 'calibration_id')->where('form_index', 1);
    }
    
    public function headThermometerForm2()
    {
        return $this->hasOne(HeadThermometer::class, 'calibration_id')->where('form_index', 2);
    }
    
    public function headThermometerForm3()
    {
        return $this->hasOne(HeadThermometer::class, 'calibration_id')->where('form_index', 3);
    }
    
    public function headThermometerForm4()
    {
        return $this->hasOne(HeadThermometer::class, 'calibration_id')->where('form_index', 4);
    }
       
    public function detailThermometers()
    {
       return $this->hasMany(DetailThermometer::class, 'calibration_id');
    }

    public function headDialIndicator()
    {
        return $this->hasOne(HeadDialIndicator::class, 'calibration_id');
    }
       
    public function detailDialIndicators()
    {
       return $this->hasMany(DetailDialIndicator::class, 'calibration_id');
    }

    public function addDialIndicator()
    {
        return $this->hasOne(AddDialIndicator::class, 'calibration_id');
    }

    public function headDialTestIndicator()
    {
        return $this->hasOne(HeadDialTestIndicator::class, 'calibration_id');
    }
       
    public function detailDialTestIndicators()
    {
       return $this->hasMany(DetailDialTestIndicator::class, 'calibration_id');
    }

    public function addDialTestIndicator()
    {
        return $this->hasOne(AddDialTestIndicator::class, 'calibration_id');
    }

    public function headDepthCaliper()
    {
        return $this->hasOne(HeadDepthCaliper::class, 'calibration_id');
    }
       
    public function detailDepthCalipers()
    {
       return $this->hasMany(DetailDepthCaliper::class, 'calibration_id');
    }

    public function headCaliper()
    {
        return $this->hasOne(HeadCaliper::class, 'calibration_id');
    }
    
       public function headCaliperForm1()
    {
        return $this->hasOne(HeadCaliper::class, 'calibration_id')->where('form_index', 1);
    }
    
    public function headCaliperForm2()
    {
        return $this->hasOne(HeadCaliper::class, 'calibration_id')->where('form_index', 2);
    }
    
    public function headCaliperForm3()
    {
        return $this->hasOne(HeadCaliper::class, 'calibration_id')->where('form_index', 3);
    }
    
    public function headCaliperForm4()
    {
        return $this->hasOne(HeadCaliper::class, 'calibration_id')->where('form_index', 4);
    }

    public function detailCalipers()
    {
        return $this->hasMany(DetailCaliper::class, 'calibration_id');
    }

    public function addCaliper()
    {
        return $this->hasOne(AddCaliper::class, 'calibration_id');
    }
    
      public function addCaliperForm1()
    {
        return $this->hasOne(addCaliper::class, 'calibration_id')->where('form_index', 1);
    }
    
    public function addCaliperForm2()
    {
        return $this->hasOne(addCaliper::class, 'calibration_id')->where('form_index', 2);
    }
    
    public function addCaliperForm3()
    {
        return $this->hasOne(addCaliper::class, 'calibration_id')->where('form_index', 3);
    }
    
    public function addCaliperForm4()
    {
        return $this->hasOne(addCaliper::class, 'calibration_id')->where('form_index', 4);
    }


    public function headTorqueWrench()
    {
        return $this->hasOne(HeadTorqueWrench::class, 'calibration_id');
    }

    public function detailTorqueWrenchs()
    {
        return $this->hasMany(DetailTorqueWrench::class, 'calibration_id');
    }

    public function addTorqueWrench()
    {
        return $this->hasOne(AddTorqueWrench::class, 'calibration_id');
    }

    public function headTorqueMeter()
    {
        return $this->hasOne(HeadTorqueMeter::class, 'calibration_id');
    }

    public function detailTorqueMeters()
    {
        return $this->hasMany(DetailTorqueMeter::class, 'calibration_id');
    } 

    public function addTorqueMeter()
    {
        return $this->hasOne(AddTorqueMeter::class, 'calibration_id');
    }
    public function headUltrasonicThicknessGauge()
    {   
        return $this->hasOne(HeadUltrasonicThicknessGauge::class);
    }
    
    public function headUltrasonicThicknessGauges()
    {
        return $this->hasMany(HeadUltrasonicThicknessGauge::class, 'calibration_id');
    }
    
    public function headUltrasonicThicknessGaugeForm1()
    {
        return $this->hasOne(HeadUltrasonicThicknessGauge::class, 'calibration_id')->where('form_index', 1);
    }
    
    public function headUltrasonicThicknessGaugeForm2()
    {
        return $this->hasOne(HeadUltrasonicThicknessGauge::class, 'calibration_id')->where('form_index', 2);
    }
    
    public function headUltrasonicThicknessGaugeForm3()
    {
        return $this->hasOne(HeadUltrasonicThicknessGauge::class, 'calibration_id')->where('form_index', 3);
    }
    
    public function headUltrasonicThicknessGaugeForm4()
    {
        return $this->hasOne(HeadUltrasonicThicknessGauge::class, 'calibration_id')->where('form_index', 4);
    }
    public function detailUltrasonicThicknessGauges()
    {
        return $this->hasMany(DetailUltrasonicThicknessGauge::class, 'calibration_id');
    }

    public function headThicknessGauge()
    {
        return $this->hasOne(HeadThicknessGauge::class, 'calibration_id');
    }

    public function detailThicknessGauges()
    {
        return $this->hasMany(DetailThicknessGauge::class, 'calibration_id');
    } 
    public function headPenggaris()
    {
        return $this->hasOne(HeadPenggaris::class, 'calibration_id');
    }
    
    public function detailPenggaris()
    {
        return $this->hasMany(DetailPenggaris::class,'calibration_id');
    }

    public function headEnclosure()
    {
        return $this->hasOne(HeadEnclosure::class, 'calibration_id');
    }
    
    public function detailEnclosures()
    {
        return $this->hasMany(DetailEnclosure::class);
    }

    public function addEnclosure()
    {
        return $this->hasMany(AddEnclosure::class, 'calibration_id');
    }

    public function headChamber()
    {
        return $this->hasOne(HeadChamber::class, 'calibration_id');
    }
    
       public function headChamberForm1()
    {
        return $this->hasOne(HeadChamber::class, 'calibration_id')->where('form_index', 1);
    }
    
    public function headChamberForm2()
    {
        return $this->hasOne(HeadChamber::class, 'calibration_id')->where('form_index', 2);
    }
    
    public function headChamberForm3()
    {
        return $this->hasOne(HeadChamber::class, 'calibration_id')->where('form_index', 3);
    }
    
    public function headChamberForm4()
    {
        return $this->hasOne(HeadChamber::class, 'calibration_id')->where('form_index', 4);
    }
    
    public function detailChambers()
    {
        return $this->hasMany(DetailChamber::class);
    }

    public function addChamber()
    {
        return $this->hasMany(AddChamber::class, 'calibration_id');
    }

    public function headPressureGauge()
    {
        return $this->hasOne(HeadPressureGauge::class, 'calibration_id');
    }
    
    public function detailPressureGauges()
    {
        return $this->hasMany(DetailPressureGauge::class);
    }

    public function addPressureGauge()
    {
        return $this->hasOne(AddPressureGauge::class, 'calibration_id');
    }

    public function headDifferentialPressureGauge()
    {
        return $this->hasOne(HeadDifferentialPressureGauge::class, 'calibration_id');
    }
    
    public function detailDifferentialPressureGauges()
    {
        return $this->hasMany(DetailDifferentialPressureGauge::class);
    }

    public function addDifferentialPressureGauge()
    {
        return $this->hasOne(AddDifferentialPressureGauge::class, 'calibration_id');
    }

    public function headThermohygrometer()
    {
        return $this->hasOne(HeadThermohygrometer::class, 'calibration_id');
    }
    
    public function detailThermohygrometers()
    {
        return $this->hasMany(DetailThermohygrometer::class);
    }

    public function headVolumetrik()
    {
        return $this->hasOne(HeadVolumetrik::class, 'calibration_id');
    }
    
    public function detailVolumetriks()
    {
        return $this->hasMany(DetailVolumetrik::class);
    }

    public function addVolumetrik()
    {
        return $this->hasOne(AddVolumetrik::class, 'calibration_id');
    }

     public function headViscometer()
    {
        return $this->hasOne(HeadViscometer::class, 'calibration_id');
    }

    public function detailViscometers()
    {
        return $this->hasMany(DetailViscometer::class);
    }

    public function headPushPull()
    {
        return $this->hasOne(HeadPushPull::class, 'calibration_id');
    }

    public function detailPushPulls()
    {   
        return $this->hasMany(DetailPushPull::class);
    }   

    public function addPushPull()
    {
        return $this->hasOne(AddPushPull::class, 'calibration_id');
    }

    public function headTimbangan()
    {
        return $this->hasOne(HeadTimbangan::class, 'calibration_id');
    }
    
    public function headTimbanganForm1()
    {
        return $this->hasOne(HeadTimbangan::class, 'calibration_id')->where('form_index', 1);
    }
    
    public function headTimbanganForm2()
    {
        return $this->hasOne(HeadTimbangan::class, 'calibration_id')->where('form_index', 2);
    }
    
    public function headTimbanganForm3()
    {
        return $this->hasOne(HeadTimbangan::class, 'calibration_id')->where('form_index', 3);
    }
    
    public function headTimbanganForm4()
    {
        return $this->hasOne(HeadTimbangan::class, 'calibration_id')->where('form_index', 4);
    }
    

    public function detailTimbangans()
    {   
        return $this->hasMany(DetailTimbangan::class);
    }   

    public function addTimbangan()
    {
        return $this->hasOne(AddTimbangan::class, 'calibration_id');
    }
    
      public function addTimbanganForm1()
    {
        return $this->hasOne(AddTimbangan::class, 'calibration_id')->where('form_index', 1);
    }
    
    public function addTimbanganForm2()
    {
        return $this->hasOne(AddTimbangan::class, 'calibration_id')->where('form_index', 2);
    }
    
    public function addTimbanganForm3()
    {
        return $this->hasOne(AddTimbangan::class, 'calibration_id')->where('form_index', 3);
    }
    
    public function addTimbanganForm4()
    {
        return $this->hasOne(AddTimbangan::class, 'calibration_id')->where('form_index', 4);
    }

    public function headTimbanganMoisture()
    {
        return $this->hasOne(HeadTimbanganMoisture::class, 'calibration_id');
    }

    public function detailTimbanganMoistures()
    {   
        return $this->hasMany(DetailTimbanganMoisture::class);
    }   

    public function addTimbanganMoisture()
    {
        return $this->hasOne(AddTimbanganMoisture::class, 'calibration_id');
    }

    public function headTimbanganBias()
    {
        return $this->hasOne(HeadTimbanganBias::class, 'calibration_id');
    }

    public function detailTimbanganBiass()
    {   
        return $this->hasMany(DetailTimbanganBias::class);
    }   

    public function addTimbanganBias()
    {
        return $this->hasOne(AddTimbanganBias::class, 'calibration_id');
    }  

    public function headGaugeBlock()
    {
        return $this->hasOne(HeadGaugeBlock::class, 'calibration_id');
    }

    public function detailGaugeBlocks()
    {   
        return $this->hasMany(DetailGaugeBlock::class);
    }   

    public function addGaugeBlock()
    {
        return $this->hasOne(AddGaugeBlock::class, 'calibration_id');
    }  

    public function headHoletest()
    {
        return $this->hasOne(HeadHoletest::class, 'calibration_id');
    }

    public function detailHoletests()
    {   
        return $this->hasMany(DetailHoletest::class);
    }   

    public function headConductivityMeter()
    {
        return $this->hasOne(HeadConductivityMeter::class, 'calibration_id');
    }

    public function headConductivityMeterForm1()
    {
        return $this->hasOne(HeadConductivityMeter::class, 'calibration_id')->where('form_index', 1);
    }

    public function headConductivityMeterForm2()
    {
        return $this->hasOne(HeadConductivityMeter::class, 'calibration_id')->where('form_index', 2);
    }

    public function headConductivityMeterForm3()
    {
        return $this->hasOne(HeadConductivityMeter::class, 'calibration_id')->where('form_index', 3);
    }

    public function headConductivityMeterForm4()
    {
        return $this->hasOne(HeadConductivityMeter::class, 'calibration_id')->where('form_index', 4);
    }

    

    public function detailConductivityMeters()
    {   
        return $this->hasMany(DetailConductivityMeter::class);
    }     
    
     public function headCoatingThickness()
    {
        return $this->hasOne(HeadCoatingThickness::class, 'calibration_id');
    }

    public function detailCoatingThicknesses()
    {   
        return $this->hasMany(DetailCoatingThickness::class);
    }     
    
     public function headDurometer()
    {
        return $this->hasOne(HeadDurometer::class, 'calibration_id');
    }

    public function detailDurometers()
    {   
        return $this->hasMany(DetailDurometer::class);
    }   

    public function addDurometer()
    {
        return $this->hasOne(AddDurometer::class, 'calibration_id');
    }  

     public function headMikropipetDispenset()
    {   
        return $this->hasOne(HeadMikropipetDispenset::class);
    }  
    
       public function headMikropipetDispensetForm1()
    {
        return $this->hasOne(HeadMikropipetDispenset::class, 'calibration_id')->where('form_index', 1);
    }
    
    public function headMikropipetDispensetForm2()
    {
        return $this->hasOne(HeadMikropipetDispenset::class, 'calibration_id')->where('form_index', 2);
    }
    
    public function headMikropipetDispensetForm3()
    {
        return $this->hasOne(HeadMikropipetDispenset::class, 'calibration_id')->where('form_index', 3);
    }
    
    public function headMikropipetDispensetForm4()
    {
        return $this->hasOne(HeadMikropipetDispenset::class, 'calibration_id')->where('form_index', 4);
    }

    public function detailMikropipetDispensets()
    {
        return $this->hasMany(DetailMikropipetDispenset::class, 'calibration_id');
    }  
     public function headTaperGauge()
    {   
        return $this->hasOne(HeadTaperGauge::class);
    }   

    public function detailTaperGauges()
    {
        return $this->hasMany(DetailTaperGauge::class, 'calibration_id');
    }  

    public function headFeelerGauge()
    {   
        return $this->hasOne(HeadFeelerGauge::class);
    }   
           public function headFeelerGaugeForm1()
    {
        return $this->hasOne(HeadFeelerGauge::class, 'calibration_id')->where('form_index', 1);
    }
    
    public function headFeelerGaugeForm2()
    {
        return $this->hasOne(HeadFeelerGauge::class, 'calibration_id')->where('form_index', 2);
    }
    
    public function headFeelerGaugeForm3()
    {
        return $this->hasOne(HeadFeelerGauge::class, 'calibration_id')->where('form_index', 3);
    }
    
    public function headFeelerGaugeForm4()
    {
        return $this->hasOne(HeadFeelerGauge::class, 'calibration_id')->where('form_index', 4);
    }

    public function detailFeelerGauges()
    {   
        return $this->hasMany(DetailFeelerGauge::class, 'calibration_id');
    }  
    
    public function headPhMeter()
    {   
        return $this->hasOne(HeadPhMeter::class);
    }   

    public function detailPhMeters()
    {   
        return $this->hasMany(DetailPhMeter::class, 'calibration_id');
    } 

    public function headTachometer()
    {   
        return $this->hasOne(HeadTachometer::class);
    }   

    public function detailTachometers()
    {
        return $this->hasMany(DetailTachometer::class, 'calibration_id');
    } 

    public function headPinGauge()
    {   
        return $this->hasOne(HeadPinGauge::class);
    }   

    public function detailPinGauges()
    {
        return $this->hasMany(DetailPinGauge::class, 'calibration_id');
    } 

     public function headViscoCup()
    {   
        return $this->hasOne(HeadViscoCup::class);
    }   

    public function detailViscoCups()
    {
        return $this->hasMany(DetailViscoCup::class, 'calibration_id');
    } 

     public function addViscoCup()
    {
        return $this->hasOne(AddViscoCup::class, 'calibration_id');
    }  

    public function headPlainLimitGauge()
    {   
        return $this->hasOne(HeadPlainLimitGauge::class);
    }   

    public function detailPlainLimitGauges()
    {
        return $this->hasMany(DetailPlainLimitGauge::class, 'calibration_id');
    } 

    public function headTempHumidTransmitter()
    {   
        return $this->hasOne(HeadTempHumidTransmitter::class);
    }   

    public function detail_T_TempHumidTransmitters()
    {
        return $this->hasMany(Detail_T_TempHumidTransmitter::class, 'calibration_id');
    }

    public function detail_RH_TempHumidTransmitters()
    {
        return $this->hasMany(Detail_RH_TempHumidTransmitter::class, 'calibration_id');
    }

    public function headTempTransmitter()
    {   
        return $this->hasOne(HeadTempTransmitter::class);
    }   

    public function detailTempTransmitters()
    {
        return $this->hasMany(DetailTempTransmitter::class, 'calibration_id');
    }

      public function headIrThermometer()
    {   
        return $this->hasOne(HeadIrThermometer::class);
    }   

    public function detailIrThermometers()
    {
        return $this->hasMany(DetailIrThermometer::class, 'calibration_id');
    }
      public function addIrThermometer()
    {   
        return $this->hasOne(AddIrThermometer::class);
    }  

    public function headThermoIndicator()
    {   
        return $this->hasOne(HeadThermoIndicator::class);
    }
     public function headThermoIndicatorForm1()
    {
        return $this->hasOne(HeadThermoIndicator::class, 'calibration_id')->where('form_index', 1);
    }
    
    public function headThermoIndicatorForm2()
    {
        return $this->hasOne(HeadThermoIndicator::class, 'calibration_id')->where('form_index', 2);
    }
    
    public function headThermoIndicatorForm3()
    {
        return $this->hasOne(HeadThermoIndicator::class, 'calibration_id')->where('form_index', 3);
    }
    
    public function headThermoIndicatorForm4()
    {
        return $this->hasOne(HeadThermoIndicator::class, 'calibration_id')->where('form_index', 4);
    }
    
    public function detailThermoIndicators()
    {
        return $this->hasMany(DetailThermoIndicator::class, 'calibration_id');
    }
      public function addThermoIndicator()
    {   
        return $this->hasOne(AddThermoIndicator::class);
    }  

    public function headPlasticShim()
    {   
        return $this->hasOne(HeadPlasticShim::class);
    }   
    public function detailPlasticShims()
    {
        return $this->hasMany(DetailPlasticShim::class, 'calibration_id');
    }
    public function headProfilProjector()
    {   
        return $this->hasOne(HeadProfilProjector::class);
    }   
    public function detailProfilProjectors()
    {
        return $this->hasMany(DetailProfilProjector::class, 'calibration_id');
    }
    public function headSurfaceRoughnessTester()
    {   
        return $this->hasOne(HeadSurfaceRoughnessTester::class);
    }   
    public function detailSurfaceRoughnessTesters()
    {
        return $this->hasMany(DetailSurfaceRoughnessTester::class, 'calibration_id');
    }
     public function headThreadGauge()
    {   
        return $this->hasOne(HeadThreadGauge::class);
    }   
    public function detailThreadGauges()
    {
        return $this->hasMany(DetailThreadGauge::class, 'calibration_id');
    }
    public function headStopwatch()
    {   
        return $this->hasOne(HeadStopwatch::class);
    }   
    public function detailStopwatches()
    {
        return $this->hasMany(DetailStopwatch::class, 'calibration_id');
    }
     public function headCentrifuge()
    {   
        return $this->hasOne(HeadCentrifuge::class);
    }
    public function headCentrifugeForm1()
    {
        return $this->hasOne(HeadCentrifuge::class, 'calibration_id')->where('form_index', 1);
    }
    
    public function headCentrifugeForm2()
    {
        return $this->hasOne(HeadCentrifuge::class, 'calibration_id')->where('form_index', 2);
    }
    
    public function headCentrifugeForm3()
    {
        return $this->hasOne(HeadCentrifuge::class, 'calibration_id')->where('form_index', 3);
    }
    
    public function headCentrifugeForm4()
    {
        return $this->hasOne(HeadCentrifuge::class, 'calibration_id')->where('form_index', 4);
    }
    public function detailCentrifuges()
    {
        return $this->hasMany(DetailCentrifuge::class, 'calibration_id');
    }
     public function headUtm()
    {   
        return $this->hasOne(HeadUtm::class);
    }   
    public function detailUtms()
    {
        return $this->hasMany(DetailUtm::class, 'calibration_id');
    }
    public function headAnakTimbangan()
    {   
        return $this->hasOne(HeadAnakTimbangan::class);
    }   
    public function headAnakTimbangans()
    {   
        return $this->hasMany(HeadAnakTimbangan::class, 'calibration_id');
    }   
    public function detailAnakTimbangans()
    {
        return $this->hasMany(DetailAnakTimbangan::class, 'calibration_id');
    }
   
    public function headPressureTransmitter()
    {   
        return $this->hasOne(HeadPressureTransmitter::class);
    }   
    public function detailPressureTransmitters()
    {
        return $this->hasMany(DetailPressureTransmitter::class, 'calibration_id');
    }
    public function addPressureTransmitter()
    {   
        return $this->hasOne(AddPressureTransmitter::class);
    } 
    public function headSurfacePlate()
    {   
        return $this->hasOne(HeadSurfacePlate::class);
    }   
    public function detailSurfacePlates()
    {
        return $this->hasMany(DetailSurfacePlate::class, 'calibration_id');
    }
      public function headBoreGauge()
    {   
        return $this->hasOne(HeadBoreGauge::class);
    }   
    public function detailBoreGauges()
    {
        return $this->hasMany(DetailBoreGauge::class, 'calibration_id');
    }
    public function addBoreGauge()
    {   
        return $this->hasOne(AddBoreGauge::class);
    } 
    
      public function headAbrationTester()
    {   
        return $this->hasOne(HeadAbrationTester::class);
    }   
    public function detailAbrationTesters()
    {
        return $this->hasMany(DetailAbrationTester::class, 'calibration_id');
    }
    
    public function headHeightGauge()
    {   
        return $this->hasOne(HeadHeightGauge::class);
    }   
    public function detailHeightGauges()
    {
        return $this->hasMany(DetailHeightGauge::class, 'calibration_id');
    }
     public function headInsulation()
    {   
        return $this->hasOne(HeadInsulation::class);
    }   
    public function detailInsulations()
    {
        return $this->hasMany(DetailInsulation::class, 'calibration_id');
    }

}