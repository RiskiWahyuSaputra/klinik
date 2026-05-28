<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::create([
            'name' => 'Admin Klinik',
            'email' => 'admin@moncheri.id',
            'phone' => '081234567890',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Dokter 1
        $doctor1User = User::create([
            'name' => 'Sarah Wijaya',
            'email' => 'dokter.sarah@moncheri.id',
            'phone' => '081234567891',
            'password' => Hash::make('password'),
            'role' => 'doctor',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        Doctor::create([
            'user_id' => $doctor1User->id,
            'doctor_number' => 'DOC-202605-001',
            'specialization' => 'Dokter Umum',
            'license_number' => 'STR-12345',
            'education' => 'FK Universitas Padjajaran',
            'experience_years' => 8,
            'consultation_fee' => 150000,
            'bio' => 'Dokter umum berpengalaman dengan spesialisasi dalam pelayanan kesehatan keluarga.',
            'is_available' => true,
        ]);

        // Dokter 2
        $doctor2User = User::create([
            'name' => 'Rina Amelia',
            'email' => 'dokter.rina@moncheri.id',
            'phone' => '081234567892',
            'password' => Hash::make('password'),
            'role' => 'doctor',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        Doctor::create([
            'user_id' => $doctor2User->id,
            'doctor_number' => 'DOC-202605-002',
            'specialization' => 'Dokter Gigi',
            'license_number' => 'STR-12346',
            'education' => 'FK Gigi Universitas Indonesia',
            'experience_years' => 5,
            'consultation_fee' => 200000,
            'bio' => 'Dokter gigi spesialis perawatan gigi dan mulut untuk seluruh anggota keluarga.',
            'is_available' => true,
        ]);

        // Staff
        User::create([
            'name' => 'Staff Klinik',
            'email' => 'staff@moncheri.id',
            'phone' => '081234567893',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Pasien contoh
        $patientUser = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081234567894',
            'password' => Hash::make('password'),
            'role' => 'patient',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        Patient::create([
            'user_id' => $patientUser->id,
            'patient_number' => 'MC-202605-0001',
            'date_of_birth' => '1990-05-15',
            'gender' => 'male',
            'blood_type' => 'O',
            'address' => 'Jl. Merdeka No. 45, Bandung',
            'emergency_contact_name' => 'Siti Rahmawati',
            'emergency_contact_phone' => '081234567895',
        ]);
    }
}
