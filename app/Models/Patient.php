<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'nik',
        'full_name',
        'date_of_birth',
        'gender',
        'address',
        'phone_number',
        'blood_type',
    ];

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
