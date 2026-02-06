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
     * Method untuk workflow otomatis
     */

    /**
     * Set status waiting for verification setelah input
     */
    public function markAsWaitingVerification($createdBy = null)
    {
        $transaction = $this->status_transaction ?? [];
        $userName = $createdBy ?? auth()->user()->name;
        
        $transaction['created_by'] = $userName;
        $transaction['created_at'] = now()->toDateTimeString();
        $transaction['waiting_verification_at'] = now()->toDateTimeString();
        $transaction['last_updated_by'] = $userName;
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
        $userName = $verifiedBy ?? auth()->user()->name;
        
        $transaction['verified_by'] = $userName;
        $transaction['verified_at'] = now()->toDateTimeString();
        $transaction['verified_note'] = $note ?? 'Data telah diverifikasi dan siap untuk approval';
        $transaction['waiting_approval_at'] = now()->toDateTimeString();
        $transaction['last_updated_by'] = $userName;
        $transaction['last_updated_at'] = now()->toDateTimeString();
        
        $this->update([
            'status' => self::STATUS_WAITING_APPROVAL,
            'verified' => now(),
            'verifiedBy' => $userName,
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
        $userName = $approvedBy ?? auth()->user()->name;
        
        $transaction['approved_by'] = $userName;
        $transaction['approved_at'] = now()->toDateTimeString();
        $transaction['approved_note'] = $note ?? 'Data telah disetujui';
        $transaction['last_updated_by'] = $userName;
        $transaction['last_updated_at'] = now()->toDateTimeString();
        
        $this->update([
            'status' => self::STATUS_APPROVED,
            'approved' => now(),
            'approvedBy' => $userName,
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
        $userName = $rejectedBy ?? auth()->user()->name;
        $rejectedFrom = $rejectedFrom ?? 'Approver';
        
        $transaction['rejected_by'] = $userName;
        $transaction['rejected_at'] = now()->toDateTimeString();
        $transaction['rejected_from'] = $rejectedFrom;
        $transaction['rejected_reason'] = $reason ?? 'Data ditolak tanpa alasan spesifik';
        $transaction['last_updated_by'] = $userName;
        $transaction['last_updated_at'] = now()->toDateTimeString();
        
        $this->update([
            'status' => self::STATUS_REJECTED,
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
        $userName = $completedBy ?? auth()->user()->name;
        
        $transaction['completed_by'] = $userName;
        $transaction['completed_at'] = now()->toDateTimeString();
        $transaction['completed_note'] = $note ?? 'Proses kalibrasi selesai';
        $transaction['last_updated_by'] = $userName;
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


  
}