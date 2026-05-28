<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $doctor = $user->doctor;

        $todayAppointments = Appointment::where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', now())
            ->with(['patient.user', 'service'])
            ->orderBy('appointment_time')
            ->get();

        $pendingCount = $todayAppointments->where('status', 'pending')->count();
        $checkedInCount = $todayAppointments->where('status', 'checked_in')->count();
        $completedCount = $todayAppointments->where('status', 'completed')->count();

        $upcomingAppointments = Appointment::where('doctor_id', $doctor->id)
            ->whereIn('status', ['confirmed', 'checked_in', 'in_progress'])
            ->whereDate('appointment_date', '>=', now())
            ->with(['patient.user', 'service'])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->take(5)
            ->get();

        $totalPatients = MedicalRecord::where('doctor_id', $doctor->id)
            ->distinct('patient_id')
            ->count('patient_id');

        return view('doctor.dashboard', compact(
            'user', 'doctor', 'todayAppointments',
            'pendingCount', 'checkedInCount', 'completedCount',
            'upcomingAppointments', 'totalPatients'
        ));
    }
}
