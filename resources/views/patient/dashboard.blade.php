@extends('layouts.patient')

@section('title', 'Dashboard Pasien')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="py-8">
    <div class="mb-8">
        <h1 class="page-title">Halo, {{ auth()->user()->name }}!</h1>
        <p class="text-gray-500 mt-1">Selamat datang di Klinik Mon Cheri</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Appointment</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $appointmentCount }}</p>
                </div>
                <div class="stat-card-icon pink">📅</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Selesai</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ $completedCount }}</p>
                </div>
                <div class="stat-card-icon green">✅</div>
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
    </div>

    <div class="admin-card overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-xl font-semibold text-gray-800">Appointment Mendatang</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No. Appointment</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Dokter</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($upcomingAppointments as $appointment)
                    <tr>
                        <td data-label="No.">#{{ $appointment->appointment_number }}</td>
                        <td data-label="Tanggal">{{ $appointment->appointment_date->format('d M Y') }}</td>
                        <td data-label="Jam">{{ $appointment->appointment_time->format('H:i') }}</td>
                        <td data-label="Dokter">dr. {{ $appointment->doctor->user->name }}</td>
                        <td data-label="Status">
                            <span class="badge
                                @if($appointment->status == 'pending') badge-yellow
                                @elseif($appointment->status == 'confirmed') badge-blue
                                @elseif($appointment->status == 'checked_in') badge-indigo
                                @elseif($appointment->status == 'in_progress') badge-purple
                                @elseif($appointment->status == 'completed') badge-green
                                @elseif($appointment->status == 'cancelled') badge-red
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                            </span>
                        </td>
                        <td data-label="Aksi">
                            <a href="{{ route('appointments.show', $appointment) }}" class="btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <p class="text-4xl mb-4">📅</p>
                            <p>Belum ada appointment.</p>
                            <a href="{{ route('appointments.create') }}" class="btn-primary mt-4">
                                Buat Appointment
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection