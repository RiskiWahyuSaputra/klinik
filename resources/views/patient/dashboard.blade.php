@extends('layouts.patient')

@section('title', 'Dashboard Pasien')
@section('breadcrumb', 'Dashboard')

@section('content')
<div>
    <div class="page-header">
        <div>
            <h1 class="page-title">Halo, {{ auth()->user()->name }}!</h1>
            <p class="page-subtitle">Selamat datang di Klinik Mon Cheri</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider" style="color: var(--text-muted);">Total Appointment</p>
                    <p class="text-2xl font-bold mt-1" style="color: var(--text-heading);">{{ $appointmentCount }}</p>
                </div>
                <div class="stat-card-icon pink">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider" style="color: var(--text-muted);">Selesai</p>
                    <p class="text-2xl font-bold mt-1" style="color: #16A34A;">{{ $completedCount }}</p>
                </div>
                <div class="stat-card-icon green">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider" style="color: var(--text-muted);">Menunggu</p>
                    <p class="text-2xl font-bold mt-1" style="color: #a16207;">{{ $pendingCount }}</p>
                </div>
                <div class="stat-card-icon gold">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="card overflow-hidden" style="margin-top: 40px;">
        <div class="flex items-center justify-between px-5 py-4 border-b" style="border-color: var(--border);">
            <h2 class="font-semibold" style="font-size: 15px; font-family: 'Poppins', sans-serif;">Appointment Mendatang</h2>
            @if($upcomingAppointments->count())
            <span class="text-sm" style="color: var(--text-muted);">{{ $upcomingAppointments->count() }} appointment</span>
            @endif
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
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
                        <td data-label="No."><span class="font-medium" style="color: var(--text-heading);">#{{ $appointment->appointment_number }}</span></td>
                        <td data-label="Tanggal">{{ $appointment->appointment_date->format('d M Y') }}</td>
                        <td data-label="Jam">{{ $appointment->appointment_time->format('H:i') }}</td>
                        <td data-label="Dokter">dr. {{ $appointment->doctor->user->name }}</td>
                        <td data-label="Status">
                            <span class="badge
                                @if($appointment->status == 'pending') badge-amber
                                @elseif($appointment->status == 'confirmed') badge-blue
                                @elseif($appointment->status == 'checked_in') badge-pink
                                @elseif($appointment->status == 'in_progress') badge-purple
                                @elseif($appointment->status == 'completed') badge-green
                                @elseif($appointment->status == 'cancelled') badge-red
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                            </span>
                        </td>
                        <td data-label="Aksi">
                            <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-outline btn-sm">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                </div>
                                <p class="empty-state-title">Belum ada appointment</p>
                                <p class="empty-state-desc">Buat appointment baru untuk memulai.</p>
                                <a href="{{ route('appointments.create') }}" class="btn btn-primary mt-4">Buat Appointment</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endSection
