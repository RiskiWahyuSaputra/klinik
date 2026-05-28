<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPatients = Patient::count();
        $totalDoctors = Doctor::count();
        $totalAppointments = Appointment::count();
        $todayAppointments = Appointment::whereDate('appointment_date', now())->count();

        $monthlyAppointments = Appointment::whereMonth('appointment_date', now()->month)
            ->whereYear('appointment_date', now()->year)
            ->count();

        $recentAppointments = Appointment::with(['patient.user', 'doctor.user'])
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        $popularServices = Appointment::selectRaw('service_id, count(*) as total')
            ->whereNotNull('service_id')
            ->groupBy('service_id')
            ->orderByDesc('total')
            ->with('service')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPatients', 'totalDoctors', 'totalAppointments',
            'todayAppointments', 'monthlyAppointments',
            'recentAppointments', 'popularServices'
        ));
    }

    public function users()
    {
        $users = User::with(['patient', 'doctor'])
            ->orderByDesc('created_at')
            ->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20|unique:users,phone',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:patient,staff,doctor,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.users')->with('success', 'User berhasil dibuat.');
    }

    public function toggleUserStatus(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
        return redirect()->back()->with('success', 'Status user berhasil diubah.');
    }

    public function doctors()
    {
        $doctors = Doctor::with('user', 'services')->paginate(10);
        return view('admin.doctors.index', compact('doctors'));
    }

    public function createDoctor()
    {
        $services = Service::where('is_active', true)->get();
        return view('admin.doctors.create', compact('services'));
    }

    public function storeDoctor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20|unique:users,phone',
            'password' => 'required|string|min:8',
            'specialization' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:50',
            'consultation_fee' => 'nullable|numeric',
            'bio' => 'nullable|string',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => 'doctor',
        ]);

        $doctor = Doctor::create([
            'user_id' => $user->id,
            'doctor_number' => 'DOC-' . now()->format('Ym') . '-' . strtoupper(substr(md5(time()), 0, 4)),
            'specialization' => $request->specialization,
            'license_number' => $request->license_number,
            'consultation_fee' => $request->consultation_fee ?? 0,
            'bio' => $request->bio,
        ]);

        if ($request->services) {
            $doctor->services()->attach($request->services);
        }

        return redirect()->route('admin.doctors')->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function editDoctor(Doctor $doctor)
    {
        $doctor->load('user', 'services');
        $services = Service::where('is_active', true)->get();
        return view('admin.doctors.edit', compact('doctor', 'services'));
    }

    public function updateDoctor(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $doctor->user_id,
            'phone' => 'required|string|max:20|unique:users,phone,' . $doctor->user_id,
            'specialization' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:50',
            'consultation_fee' => 'nullable|numeric',
            'bio' => 'nullable|string',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
        ]);

        $doctor->user->update($request->only(['name', 'email', 'phone']));

        $doctor->update([
            'specialization' => $request->specialization,
            'license_number' => $request->license_number,
            'consultation_fee' => $request->consultation_fee ?? 0,
            'bio' => $request->bio,
        ]);

        $doctor->services()->sync($request->services ?? []);

        return redirect()->route('admin.doctors')->with('success', 'Dokter berhasil diperbarui.');
    }

    public function destroyDoctor(Doctor $doctor)
    {
        $doctor->user->delete();
        $doctor->delete();

        return redirect()->route('admin.doctors')->with('success', 'Dokter berhasil dihapus.');
    }
}
