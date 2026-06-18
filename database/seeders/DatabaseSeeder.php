<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        $admin = User::create([
            'name' => 'Admin System',
            'email' => 'admin@emr.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Doctor User
        $doctorUser = User::create([
            'name' => 'Dr. John Doe',
            'email' => 'doctor@emr.com',
            'password' => bcrypt('password'),
            'role' => 'doctor',
        ]);

        \App\Models\Doctor::create([
            'doctor_name' => 'Dr. John Doe',
            'sip_number' => 'SIP.123456789',
            'specialization' => 'General Practitioner',
            'phone_number' => '081234567890',
        ]);

        // Patient User
        $patientUser = User::create([
            'name' => 'Jane Smith',
            'email' => 'patient@emr.com',
            'password' => bcrypt('password'),
            'role' => 'patient',
        ]);

        \App\Models\Patient::create([
            'nik' => 'patient@emr.com', // Matching email for demo purpose
            'full_name' => 'Jane Smith',
            'date_of_birth' => '1990-01-01',
            'gender' => 'Female',
            'address' => '123 Health Street',
            'phone_number' => '089876543210',
            'blood_type' => 'O',
        ]);
    }
}
