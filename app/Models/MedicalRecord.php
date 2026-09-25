<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use \App\Traits\Encryptable;

    protected $encryptable = [
        'complaint',
        'medical_history',
        'diagnosis',
        'treatment',
        'prescription',
        'doctor_notes',
    ];

    protected $fillable = [
        'medical_record_number',
        'patient_id',
        'doctor_id',
        'examination_date',
        'complaint',
        'medical_history',
        'diagnosis',
        'treatment',
        'prescription',
        'doctor_notes',
        'nonce',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
