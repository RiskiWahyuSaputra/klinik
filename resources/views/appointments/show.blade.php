@extends('layouts.app')

@section('title', 'Detail Appointment')

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold font-[Poppins] text-gray-800">Detail Appointment</h1>
                <p class="text-gray-500 mt-1">No. {{ $appointment->appointment_number }}</p>
            </div>
            <span class="px-4 py-2 rounded-full text-sm font-medium
                @if($appointment->status == 'pending') bg-yellow-100 text-yellow-700
                @elseif($appointment->status == 'confirmed') bg-blue-100 text-blue-700
                @elseif($appointment->status == 'checked_in') bg-indigo-100 text-indigo-700
                @elseif($appointment->status == 'in_progress') bg-purple-100 text-purple-700
                @elseif($appointment->status == 'completed') bg-green-100 text-green-700
                @else bg-red-100 text-red-700
                @endif">
                {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pasien</h2>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-gray-500 text-sm">Nama</dt>
                        <dd class="text-gray-800 font-medium">{{ $appointment->patient->user->name ?? '-' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500 text-sm">No. Pasien</dt>
                        <dd class="text-gray-800 font-medium">{{ $appointment->patient->patient_number ?? '-' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Dokter</h2>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-gray-500 text-sm">Nama Dokter</dt>
                        <dd class="text-gray-800 font-medium">dr. {{ $appointment->doctor->user->name ?? '-' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500 text-sm">Spesialisasi</dt>
                        <dd class="text-gray-800 font-medium">{{ $appointment->doctor->specialization ?? '-' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Jadwal</h2>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-gray-500 text-sm">Tanggal</dt>
                        <dd class="text-gray-800 font-medium">{{ $appointment->appointment_date->format('d M Y') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500 text-sm">Jam</dt>
                        <dd class="text-gray-800 font-medium">{{ $appointment->appointment_time->format('H:i') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500 text-sm">Durasi</dt>
                        <dd class="text-gray-800 font-medium">{{ $appointment->duration }} menit</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500 text-sm">Antrian</dt>
                        <dd class="text-gray-800 font-medium">{{ $appointment->queue_number ?? '-' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Keluhan</h2>
                <p class="text-gray-600">{{ $appointment->complaint ?? 'Tidak ada keluhan' }}</p>
                @if($appointment->notes)
                    <h3 class="text-sm font-medium text-gray-700 mt-4">Catatan</h3>
                    <p class="text-gray-600">{{ $appointment->notes }}</p>
                @endif
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <a href="{{ url()->previous() }}" class="px-6 py-3 rounded-xl font-medium border border-gray-200 text-gray-600 hover:bg-gray-50 transition">Kembali</a>
        </div>
    </div>
</div>
@endsection
