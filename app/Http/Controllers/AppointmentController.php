<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $appointments = collect();

        if ($user->isPatient()) {
            $patient = $user->patient;
            $appointments = Appointment::where('patient_id', $patient->id)
                ->with(['doctor.user', 'service'])
                ->orderByDesc('appointment_date')
                ->orderByDesc('appointment_time')
                ->paginate(10);
            return view('patient.appointments.index', compact('appointments'));
        }

        if ($user->isDoctor()) {
            $doctor = $user->doctor;
            $appointments = Appointment::where('doctor_id', $doctor->id)
                ->with(['patient.user', 'service'])
                ->orderBy('appointment_date')
                ->orderBy('appointment_time')
                ->paginate(10);
            return view('doctor.appointments.index', compact('appointments'));
        }

        if ($user->isStaff() || $user->isAdmin()) {
            $appointments = Appointment::with(['patient.user', 'doctor.user', 'service'])
                ->orderByDesc('appointment_date')
                ->orderBy('appointment_time')
                ->paginate(15);
            return view('staff.appointments.index', compact('appointments'));
        }

        return redirect()->route('dashboard');
    }

    public function create(Request $request)
    {
        $doctors = Doctor::with('user', 'schedules', 'services')->where('is_available', true)->get();
        $services = Service::where('is_active', true)->get();

        $selectedPatient = null;
        if ($request->patient_id && auth()->user()->isStaff()) {
            $selectedPatient = Patient::with('user')->findOrFail($request->patient_id);
        }

        return view('patient.appointments.create', compact('doctors', 'services', 'selectedPatient'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'service_id' => 'nullable|exists:services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'complaint' => 'nullable|string|max:1000',
        ]);

        $user = auth()->user();

        // Staff/admin bisa buat appointment untuk pasien lain
        if ($user->isStaff() && $request->patient_id) {
            $patient = Patient::findOrFail($request->patient_id);
        } else {
            $patient = $user->patient;
        }

        $doctor = Doctor::findOrFail($request->doctor_id);
        $service = $request->service_id ? Service::find($request->service_id) : null;

        $duration = $service ? $service->duration : 30;

        $datePrefix = now()->format('Ymd');
        $random = strtoupper(Str::random(6));
        $appointmentNumber = "APT-{$datePrefix}-{$random}";

        $todayAppointments = Appointment::where('doctor_id', $request->doctor_id)
            ->whereDate('appointment_date', $request->appointment_date)
            ->count();

        $appointment = Appointment::create([
            'appointment_number' => $appointmentNumber,
            'patient_id' => $patient->id,
            'doctor_id' => $request->doctor_id,
            'service_id' => $request->service_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'duration' => $duration,
            'status' => 'pending',
            'queue_number' => $todayAppointments + 1,
            'complaint' => $request->complaint,
        ]);

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment berhasil dibuat. Nomor antrian Anda: ' . $appointment->queue_number);
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['patient.user', 'doctor.user', 'service', 'medicalRecord.prescriptions', 'payment']);
        return view('appointments.show', compact('appointment'));
    }

    public function cancel(Request $request, Appointment $appointment)
    {
        $request->validate(['cancelled_reason' => 'required|string|max:500']);

        $appointment->update([
            'status' => 'cancelled',
            'cancelled_reason' => $request->cancelled_reason,
            'cancelled_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Appointment berhasil dibatalkan.');
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate(['status' => 'required|in:confirmed,checked_in,in_progress,completed,cancelled']);

        $data = ['status' => $request->status];
        if ($request->status === 'cancelled') {
            $data['cancelled_reason'] = $request->cancelled_reason;
            $data['cancelled_at'] = now();
        }

        $appointment->update($data);

        return redirect()->back()->with('success', 'Status appointment berhasil diperbarui.');
    }

    public function getAvailableTimes(Request $request)
    {
        $doctorId = $request->doctor_id;
        $date = $request->date;

        $doctor = Doctor::findOrFail($doctorId);
        $dayOfWeek = date('w', strtotime($date));

        $schedule = $doctor->schedules()
            ->where('day_of_week', $dayOfWeek)
            ->where('is_available', true)
            ->first();

        if (!$schedule) {
            return response()->json([]);
        }

        $existingAppointments = Appointment::where('doctor_id', $doctorId)
            ->whereDate('appointment_date', $date)
            ->whereIn('status', ['pending', 'confirmed', 'checked_in', 'in_progress'])
            ->pluck('appointment_time')
            ->map(function ($time) {
                return substr($time, 0, 5);
            })
            ->toArray();

        $times = [];
        $start = strtotime($schedule->start_time);
        $end = strtotime($schedule->end_time);
        $interval = 30 * 60;

        for ($time = $start; $time < $end; $time += $interval) {
            $timeStr = date('H:i', $time);
            if (!in_array($timeStr, $existingAppointments)) {
                $times[] = $timeStr;
            }
        }

        return response()->json($times);
    }
}
