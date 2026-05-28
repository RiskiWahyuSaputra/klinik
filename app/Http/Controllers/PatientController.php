<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $patient = $user->patient;

        $upcomingAppointments = Appointment::where('patient_id', $patient->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->whereDate('appointment_date', '>=', now())
            ->with(['doctor.user', 'service'])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->take(5)
            ->get();

        $appointmentCount = Appointment::where('patient_id', $patient->id)->count();
        $completedCount = Appointment::where('patient_id', $patient->id)->where('status', 'completed')->count();
        $pendingCount = Appointment::where('patient_id', $patient->id)->where('status', 'pending')->count();

        return view('patient.dashboard', compact(
            'user', 'patient', 'upcomingAppointments',
            'appointmentCount', 'completedCount', 'pendingCount'
        ));
    }

    public function profile()
    {
        $user = auth()->user();
        $patient = $user->patient;
        return view('patient.profile', compact('user', 'patient'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $patient = $user->patient;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20|unique:users,phone,' . $user->id,
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'blood_type' => 'nullable|string|max:5',
            'address' => 'nullable|string',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'insurance_number' => 'nullable|string|max:50',
            'allergies' => 'nullable|string',
        ]);

        $user->update($request->only(['name', 'email', 'phone']));
        $patient->update($request->only([
            'date_of_birth', 'gender', 'blood_type', 'address',
            'emergency_contact_name', 'emergency_contact_phone',
            'insurance_number', 'allergies'
        ]));

        return redirect()->route('patient.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
