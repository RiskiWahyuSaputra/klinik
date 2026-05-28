<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Prescription;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isPatient()) {
            $patient = $user->patient;
            $records = MedicalRecord::where('patient_id', $patient->id)
                ->with(['doctor.user', 'appointment', 'prescriptions'])
                ->orderByDesc('created_at')
                ->paginate(10);
            return view('patient.medical-records.index', compact('records'));
        }

        if ($user->isDoctor()) {
            $doctor = $user->doctor;
            $records = MedicalRecord::where('doctor_id', $doctor->id)
                ->with(['patient.user', 'appointment', 'prescriptions'])
                ->orderByDesc('created_at')
                ->paginate(10);
            return view('doctor.medical-records.index', compact('records'));
        }

        if ($user->isStaff() || $user->isAdmin()) {
            $records = MedicalRecord::with(['patient.user', 'doctor.user', 'appointment'])
                ->orderByDesc('created_at')
                ->paginate(15);
            return view('staff.medical-records.index', compact('records'));
        }

        return redirect()->route('dashboard');
    }

    public function create(Appointment $appointment)
    {
        $appointment->load(['patient.user', 'doctor.user']);
        return view('doctor.medical-records.create', compact('appointment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'notes' => 'nullable|string',
            'blood_pressure' => 'nullable|string|max:20',
            'temperature' => 'nullable|string|max:10',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);

        $record = MedicalRecord::create([
            'appointment_id' => $request->appointment_id,
            'patient_id' => $appointment->patient_id,
            'doctor_id' => $appointment->doctor_id,
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
            'notes' => $request->notes,
            'blood_pressure' => $request->blood_pressure,
            'temperature' => $request->temperature,
            'weight' => $request->weight,
            'height' => $request->height,
            'created_by' => auth()->id(),
        ]);

        $appointment->update(['status' => 'completed']);

        return redirect()->route('doctor.dashboard')
            ->with('success', 'Rekam medis berhasil disimpan.');
    }

    public function show(MedicalRecord $medicalRecord)
    {
        $medicalRecord->load(['patient.user', 'doctor.user', 'appointment', 'prescriptions']);
        return view('medical-records.show', compact('medicalRecord'));
    }

    public function addPrescription(Request $request, MedicalRecord $medicalRecord)
    {
        $request->validate([
            'medicine_name' => 'required|string|max:255',
            'dosage' => 'required|string|max:100',
            'frequency' => 'required|string|max:100',
            'duration_days' => 'nullable|integer',
            'quantity' => 'nullable|integer',
            'notes' => 'nullable|string',
        ]);

        Prescription::create([
            'medical_record_id' => $medicalRecord->id,
            'medicine_name' => $request->medicine_name,
            'dosage' => $request->dosage,
            'frequency' => $request->frequency,
            'duration_days' => $request->duration_days,
            'quantity' => $request->quantity,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Resep berhasil ditambahkan.');
    }
}
