@extends('layouts.app')

@section('title', 'Doctor Dashboard')

@section('content')
<div class="py-8">
    <h1 class="text-3xl font-bold font-[Poppins] text-gray-800 mb-2">Dashboard Dokter</h1>
    <p class="text-gray-500 mb-8">Selamat datang, dr. {{ auth()->user()->name }} — {{ now()->format('d M Y') }}</p>

    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Pasien Hari Ini</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $todayPatients }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">👨‍⚕️</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Menunggu</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $pending }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background: #fff3cd;">⏳</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Check In</p>
                    <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $checkedIn }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background: #e0e7ff;">✅</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Selesai</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ $completed }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background: #d4edda;">✓</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Pasien</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalPatients }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background: linear-gradient(135deg, #FFF8DC, #D4AF37);">📊</div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-xl font-semibold text-gray-800">Appointment Hari Ini</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-500 border-b border-gray-100">
                        <th class="px-6 py-4 font-medium">Pasien</th>
                        <th class="px-6 py-4 font-medium">Jam</th>
                        <th class="px-6 py-4 font-medium">Layanan</th>
                        <th class="px-6 py-4 font-medium">Keluhan</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($todayAppointments as $appointment)
                    <tr class="border-b border-gray-50 hover:bg-pink-50/50 transition">
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $appointment->patient->user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $appointment->appointment_time->format('H:i') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $appointment->service->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500 max-w-[200px] truncate">{{ $appointment->complaint ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($appointment->status == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($appointment->status == 'confirmed') bg-blue-100 text-blue-700
                                @elseif($appointment->status == 'checked_in') bg-indigo-100 text-indigo-700
                                @elseif($appointment->status == 'in_progress') bg-purple-100 text-purple-700
                                @elseif($appointment->status == 'completed') bg-green-100 text-green-700
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($appointment->status == 'checked_in' || $appointment->status == 'in_progress')
                            <a href="{{ route('doctor.medical-records.create', ['appointment' => $appointment->id]) }}"
                               class="text-sm font-medium px-4 py-2 rounded-lg text-white transition shadow"
                               style="background: linear-gradient(135deg, #D4AF37, #B8860B);">
                                Input Rekam Medis
                            </a>
                            @elseif($appointment->status == 'completed')
                            <a href="{{ route('medical-records.show', $appointment->medicalRecord) }}" class="text-sm font-medium hover:underline" style="color: #D4AF37;">Lihat Rekam Medis</a>
                            @else
                            <span class="text-sm text-gray-400">Menunggu</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <p class="text-4xl mb-4">📅</p>
                            <p>Tidak ada appointment hari ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection