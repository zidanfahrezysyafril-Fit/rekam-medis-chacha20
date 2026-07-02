<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use \App\Traits\Encryptable;

    protected $encryptable = [
        'doctor_name',
        'sip_number',
        'specialization',
        'phone_number',
    ];

    protected $fillable = [
        'doctor_name',
        'sip_number',
        'specialization',
        'phone_number',
        'nonce',
    ];

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
