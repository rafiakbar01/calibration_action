<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calibration extends Model
{
    protected $table = 'calibrations';
    
    protected $fillable = [
        'NIK', 'namaAlat', 'LK', 'brandAlat', 'kodeAlat', 'typeAlat', 'skala','NoSeri', 'kapasitas',
        'resolusi','rangeMin','rangeMax', 'pemilikAlat', 'tanggalMasuk','tanggalKalibrasi', 'tempatKalibrasi', 'jenisPembacaan',
        'lokasiPT', 'RT_condition1', 'RT_condition2', 'RT_condition3',
        'RH_condition1', 'RH_condition2', 'RH_condition3', 'kondisiAlat', 'keterangan',
        'status', 
        'status_transaction',
        'calibratedBy', 'calibrated', 'verifiedBy', 'verified', 'approvedBy', 'approved','type','location_data','reason'
    ];

    protected $casts = [
        'tanggalMasuk' => 'date', 
        'calibrated' => 'date',
        'verified' => 'date',
        'approved' => 'date',
        'status_transaction' => 'array',
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

    // Boot method untuk auto-log (SIMPLE VERSION - tanpa trait)
    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            buat_log_kalibrasi(
                kalibrasi_id: $model->id,
                aksi: 'BUAT',
                deskripsi: 'Data kalibrasi baru dibuat - ' . $model->namaAlat . ' (' . $model->kodeAlat . ')',
                data_baru: $model->toArray()
            );
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
                    
                    buat_log_kalibrasi(
                        kalibrasi_id: $model->id,
                        aksi: 'UBAH',
                        deskripsi: $deskripsi,
                        data_lama: $data_lama,
                        data_baru: $data_baru
                    );
                }
            }
        });

        static::deleted(function ($model) {
            buat_log_kalibrasi(
                kalibrasi_id: $model->id,
                aksi: 'HAPUS',
                deskripsi: 'Data kalibrasi dihapus - ' . $model->namaAlat . ' (' . $model->kodeAlat . ')',
                data_lama: $model->toArray()
            );
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

    public function headInsideMicrometer()
    {
        return $this->hasOne(HeadInsideMicrometer::class, 'calibration_id');
    }
    
    public function detailInsideMicrometers()
    {
        return $this->hasMany(DetailInsideMicrometer::class);
    }

    public function headOutsideMicrometer()
    {
        return $this->hasOne(HeadOutsideMicrometer::class, 'calibration_id');
    }
    
   
    public function detailOutsideMicrometers()
    {
        return $this->hasMany(DetailOutsideMicrometer::class, 'calibration_id');
    }

      public function addOutsideMicrometer()
      {
          return $this->hasOne(AddOutsideMicrometer::class, 'calibration_id');
      }
    
    public function headDepthMicrometer()
    {
        return $this->hasOne(HeadDepthMicrometer::class, 'calibration_id');      
    }
      
    public function detailDepthMicrometers()
    {
        return $this->hasMany(DetailDepthMicrometer::class);
    }
       
    public function headThermometer()
    {
        return $this->hasOne(HeadThermometer::class, 'calibration_id');
    }
       
    public function detailThermometers()
    {
       return $this->hasMany(DetailThermometer::class, 'calibration_id');
    }

    public function headDialIndicator()
    {
        return $this->hasOne(headDialIndicator::class, 'calibration_id');
    }
       
    public function detailDialIndicators()
    {
       return $this->hasMany(detailDialIndicator::class, 'calibration_id');
    }

    public function addDialIndicator()
    {
        return $this->hasOne(addDialIndicator::class, 'calibration_id');
    }

    public function headDialTestIndicator()
    {
        return $this->hasOne(headDialTestIndicator::class, 'calibration_id');
    }
       
    public function detailDialTestIndicators()
    {
       return $this->hasMany(detailDialTestIndicator::class, 'calibration_id');
    }

    public function addDialTestIndicator()
    {
        return $this->hasOne(addDialTestIndicator::class, 'calibration_id');
    }

    public function headDepthCaliper()
    {
        return $this->hasOne(headDepthCaliper::class, 'calibration_id');
    }
       
    public function detailDepthCalipers()
    {
       return $this->hasMany(detailDepthCaliper::class, 'calibration_id');
    }

    public function headCaliper()
    {
        return $this->hasOne(HeadCaliper::class, 'calibration_id');
    }

    public function detailCalipers()
    {
        return $this->hasMany(DetailCaliper::class, 'calibration_id');
    }

    public function addCaliper()
    {
        return $this->hasOne(AddCaliper::class, 'calibration_id');
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
    
    public function detailPenggariss()
    {
        return $this->hasMany(DetailPenggaris::class);
    }

    public function headEnclosure()
    {
        return $this->hasOne(headEnclosure::class, 'calibration_id');
    }
    
    public function detailEnclosures()
    {
        return $this->hasMany(detailEnclosure::class);
    }

    public function addEnclosure()
    {
        return $this->hasMany(addEnclosure::class, 'calibration_id');
    }

    public function headChamber()
    {
        return $this->hasOne(headChamber::class, 'calibration_id');
    }
    
    public function detailChambers()
    {
        return $this->hasMany(detailChamber::class);
    }

    public function addChamber()
    {
        return $this->hasMany(addChamber::class, 'calibration_id');
    }

    public function headPressureGauge()
    {
        return $this->hasOne(headPressureGauge::class, 'calibration_id');
    }
    
    public function detailPressureGauges()
    {
        return $this->hasMany(detailPressureGauge::class);
    }

    public function addPressureGauge()
    {
        return $this->hasOne(addPressureGauge::class, 'calibration_id');
    }

    public function headDifferentialPressureGauge()
    {
        return $this->hasOne(headDifferentialPressureGauge::class, 'calibration_id');
    }
    
    public function detailDifferentialPressureGauges()
    {
        return $this->hasMany(detailDifferentialPressureGauge::class);
    }

    public function addDifferentialPressureGauge()
    {
        return $this->hasOne(addDifferentialPressureGauge::class, 'calibration_id');
    }

    public function headThermohygrometer()
    {
        return $this->hasOne(headThermohygrometer::class, 'calibration_id');
    }
    
    public function detailThermohygrometers()
    {
        return $this->hasMany(detailThermohygrometer::class);
    }

    public function headVolumetrik()
    {
        return $this->hasOne(headVolumetrik::class, 'calibration_id');
    }
    
    public function detailVolumetriks()
    {
        return $this->hasMany(detailVolumetrik::class);
    }

    public function addVolumetrik()
    {
        return $this->hasOne(addVolumetrik::class, 'calibration_id');
    }

     public function headViscometer()
    {
        return $this->hasOne(headViscometer::class, 'calibration_id');
    }

    public function detailViscometers()
    {
        return $this->hasMany(detailViscometer::class);
    }

    public function headPushPull()
    {
        return $this->hasOne(headPushPull::class, 'calibration_id');
    }

    public function detailPushPulls()
    {   
        return $this->hasMany(detailPushPull::class);
    }   

    public function addPushPull()
    {
        return $this->hasOne(addPushPull::class, 'calibration_id');
    }

    public function headTimbangan()
    {
        return $this->hasOne(headTimbangan::class, 'calibration_id');
    }

    public function detailTimbangans()
    {   
        return $this->hasMany(detailTimbangan::class);
    }   

    public function addTimbangan()
    {
        return $this->hasOne(addTimbangan::class, 'calibration_id');
    }  

    public function headTimbanganMoisture()
    {
        return $this->hasOne(headTimbanganMoisture::class, 'calibration_id');
    }

    public function detailTimbanganMoistures()
    {   
        return $this->hasMany(detailTimbanganMoisture::class);
    }   

    public function addTimbanganMoisture()
    {
        return $this->hasOne(addTimbanganMoisture::class, 'calibration_id');
    }

    public function headTimbanganBias()
    {
        return $this->hasOne(headTimbanganBias::class, 'calibration_id');
    }

    public function detailTimbanganBiass()
    {   
        return $this->hasMany(detailTimbanganBias::class);
    }   

    public function addTimbanganBias()
    {
        return $this->hasOne(addTimbanganBias::class, 'calibration_id');
    }  

    public function headGaugeBlock()
    {
        return $this->hasOne(headGaugeBlock::class, 'calibration_id');
    }

    public function detailGaugeBlocks()
    {   
        return $this->hasMany(detailGaugeBlock::class);
    }   

    public function addGaugeBlock()
    {
        return $this->hasOne(addGaugeBlock::class, 'calibration_id');
    }  

    public function headHoletest()
    {
        return $this->hasOne(headHoletest::class, 'calibration_id');
    }

    public function detailHoletests()
    {   
        return $this->hasMany(detailHoletest::class);
    }   

    public function headConductivityMeter()
    {
        return $this->hasOne(headConductivityMeter::class, 'calibration_id');
    }

    public function detailConductivityMeters()
    {   
        return $this->hasMany(detailConductivityMeter::class);
    }     
    
     public function headCoatingThickness()
    {
        return $this->hasOne(headCoatingThickness::class, 'calibration_id');
    }

    public function detailCoatingThicknesses()
    {   
        return $this->hasMany(detailCoatingThickness::class);
    }     
    
     public function headDurometer()
    {
        return $this->hasOne(headDurometer::class, 'calibration_id');
    }

    public function detailDurometers()
    {   
        return $this->hasMany(detailDurometer::class);
    }   

    public function addDurometer()
    {
        return $this->hasOne(addDurometer::class, 'calibration_id');
    }  

     public function headMikropipetDispenset()
    {   
        return $this->hasOne(headMikropipetDispenset::class);
    }   

    public function detailMikropipetDispensets()
    {
        return $this->hasMany(detailMikropipetDispenset::class, 'calibration_id');
    }  
     public function headTaperGauge()
    {   
        return $this->hasOne(headTaperGauge::class);
    }   

    public function detailTaperGauges()
    {
        return $this->hasMany(detailTaperGauge::class, 'calibration_id');
    }  

    public function headFeelerGauge()
    {   
        return $this->hasOne(headFeelerGauge::class);
    }   

    public function detailFeelerGauges()
    {   
        return $this->hasMany(detailFeelerGauge::class, 'calibration_id');
    }  
    
    public function headPhMeter()
    {   
        return $this->hasOne(headPhMeter::class);
    }   

    public function detailPhMeters()
    {   
        return $this->hasMany(detailPhMeter::class, 'calibration_id');
    } 

    public function headTachometer()
    {   
        return $this->hasOne(headTachometer::class);
    }   

    public function detailTachometers()
    {
        return $this->hasMany(detailTachometer::class, 'calibration_id');
    } 

    public function headPinGauge()
    {   
        return $this->hasOne(headPinGauge::class);
    }   

    public function detailPinGauges()
    {
        return $this->hasMany(detailPinGauge::class, 'calibration_id');
    } 

     public function headViscoCup()
    {   
        return $this->hasOne(headViscoCup::class);
    }   

    public function detailViscoCups()
    {
        return $this->hasMany(detailViscoCup::class, 'calibration_id');
    } 

     public function addViscoCup()
    {
        return $this->hasOne(addViscoCup::class, 'calibration_id');
    }  

    public function headPlainLimitGauge()
    {   
        return $this->hasOne(headPlainLimitGauge::class);
    }   

    public function detailPlainLimitGauges()
    {
        return $this->hasMany(detailPlainLimitGauge::class, 'calibration_id');
    } 

    public function headTempHumidTransmitter()
    {   
        return $this->hasOne(headTempHumidTransmitter::class);
    }   

    public function detail_T_TempHumidTransmitters()
    {
        return $this->hasMany(detail_T_TempHumidTransmitter::class, 'calibration_id');
    }

    public function detail_RH_TempHumidTransmitters()
    {
        return $this->hasMany(detail_RH_TempHumidTransmitter::class, 'calibration_id');
    }

    public function headTempTransmitter()
    {   
        return $this->hasOne(headTempTransmitter::class);
    }   

    public function detailTempTransmitters()
    {
        return $this->hasMany(DetailTempTransmitter::class, 'calibration_id');
    }

      public function headIrThermometer()
    {   
        return $this->hasOne(headIrThermometer::class);
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
        return $this->hasOne(headThermoIndicator::class);
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

}