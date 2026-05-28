<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Appointment $appointment)
    {
        $appointment->load(['patient.user', 'doctor.user', 'service']);
        return view('staff.payments.create', compact('appointment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'amount' => 'required|numeric',
            'payment_method' => 'required|in:cash,transfer,ewallet,va',
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);

        $invoiceNumber = 'INV-' . now()->format('Ymd') . '-' . strtoupper(substr(md5(time()), 0, 6));

        Payment::create([
            'appointment_id' => $request->appointment_id,
            'patient_id' => $appointment->patient_id,
            'invoice_number' => $invoiceNumber,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'payment_status' => 'paid',
            'paid_at' => now(),
            'notes' => $request->notes,
        ]);

        $appointment->update(['status' => 'completed']);

        return redirect()->route('staff.dashboard')
            ->with('success', 'Pembayaran berhasil dicatat.');
    }

    public function history()
    {
        $payments = Payment::with(['appointment', 'patient.user'])
            ->orderByDesc('created_at')
            ->paginate(15);
        return view('staff.payments.index', compact('payments'));
    }
}
