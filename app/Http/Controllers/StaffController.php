<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    public function dashboard()
    {
        $today = now()->toDateString();

        $todayAppointments = Appointment::whereDate('appointment_date', $today)
            ->with(['patient.user', 'doctor.user', 'service'])
            ->orderBy('appointment_time')
            ->get();

        $waitingCount = $todayAppointments->where('status', 'confirmed')->count();
        $checkedInCount = $todayAppointments->where('status', 'checked_in')->count();
        $inProgressCount = $todayAppointments->where('status', 'in_progress')->count();
        $completedCount = $todayAppointments->where('status', 'completed')->count();

        return view('staff.dashboard', compact(
            'todayAppointments', 'waitingCount', 'checkedInCount',
            'inProgressCount', 'completedCount'
        ));
    }

    public function patients()
    {
        $patients = Patient::with('user')
            ->orderByDesc('created_at')
            ->paginate(15);
        return view('staff.patients.index', compact('patients'));
    }

    public function createPatient()
    {
        return view('staff.patients.create');
    }

    public function storePatient(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20|unique:users,phone',
            'password' => 'required|string|min:8',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'address' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => 'patient',
        ]);

        Patient::create([
            'user_id' => $user->id,
            'patient_number' => 'MC-' . now()->format('Ym') . '-' . strtoupper(Str::random(4)),
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
        ]);

        return redirect()->route('staff.patients')
            ->with('success', 'Pasien berhasil diregistrasi.');
    }

    public function searchPatient(Request $request)
    {
        $query = $request->get('q');
        $patients = Patient::whereHas('user', function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('email', 'like', "%{$query}%")
              ->orWhere('phone', 'like', "%{$query}%");
        })
        ->orWhere('patient_number', 'like', "%{$query}%")
        ->with('user')
        ->take(10)
        ->get();

        return response()->json($patients);
    }
}
