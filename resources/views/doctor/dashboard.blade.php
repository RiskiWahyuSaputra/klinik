@extends('layouts.doctor')

@section('title', 'Dashboard Dokter')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="py-8">
    <h1 class="page-title">Dashboard Dokter</h1>
    <p class="text-gray-500 mb-8">Selamat datang, dr. {{ auth()->user()->name }} — {{ now()->format('d M Y') }}</p>

    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Pasien Hari Ini</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $todayAppointments->count() }}</p>
                </div>
                <div class="stat-card-icon blue">👨‍⚕️</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Menunggu</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $pendingCount }}</p>
                </div>
                <div class="stat-card-icon gold">⏳</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Check In</p>
                    <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $checkedInCount }}</p>
                </div>
                <div class="stat-card-icon indigo">✅</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Selesai</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ $completedCount }}</p>
                </div>
                <div class="stat-card-icon green">✓</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Pasien</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalPatients }}</p>
                </div>
                <div class="stat-card-icon orange">📊</div>
            </div>
        </div>
    </div>

    <div class="admin-card overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-xl font-semibold text-gray-800">Appointment Hari Ini</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Pasien</th>
                        <th>Jam</th>
                        <th>Layanan</th>
                        <th>Keluhan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($todayAppointments as $appointment)
                    <tr>
                        <td data-label="Pasien">{{ $appointment->patient->user->name }}</td>
                        <td data-label="Jam">{{ $appointment->appointment_time->format('H:i') }}</td>
                        <td data-label="Layanan">{{ $appointment->service->name ?? '-' }}</td>
                        <td data-label="Keluhan" class="max-w-[200px] truncate">{{ $appointment->complaint ?? '-' }}</td>
                        <td data-label="Status">
                            <span class="badge
                                @if($appointment->status == 'pending') badge-yellow
                                @elseif($appointment->status == 'confirmed') badge-blue
                                @elseif($appointment->status == 'checked_in') badge-indigo
                                @elseif($appointment->status == 'in_progress') badge-purple
                                @elseif($appointment->status == 'completed') badge-green
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                            </span>
                        </td>
                        <td data-label="Aksi">
                            @if($appointment->status == 'checked_in' || $appointment->status == 'in_progress')
                            <a href="{{ route('doctor.medical-records.create', ['appointment' => $appointment->id]) }}" class="btn-warning btn-sm">
                                Input Rekam Medis
                            </a>
                            @elseif($appointment->status == 'completed')
                            <a href="{{ route('medical-records.show', $appointment->medicalRecord) }}" class="btn-primary btn-sm">Lihat</a>
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