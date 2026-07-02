<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use \App\Traits\Encryptable;

    protected $encryptable = [
        'nik',
        'address',
        'phone_number',
        'blood_type',
        'date_of_birth',
    ];

    protected $fillable = [
        'nik',
        'nik_hash',
        'full_name',
        'date_of_birth',
        'gender',
        'address',
        'phone_number',
        'blood_type',
        'nonce',
    ];

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
