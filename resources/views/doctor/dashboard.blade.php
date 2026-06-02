@extends('layouts.doctor')

@section('title', 'Dashboard Dokter')
@section('breadcrumb', 'Dashboard')

@push('styles')
<style>
    .animate-fade-up {
        opacity: 0;
        transform: translateY(24px);
        animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    .stat-card-anim {
        opacity: 0;
        transform: translateY(24px);
        animation: fadeUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    .stat-card-anim:nth-child(1) { animation-delay: 0.05s; }
    .stat-card-anim:nth-child(2) { animation-delay: 0.12s; }
    .stat-card-anim:nth-child(3) { animation-delay: 0.19s; }
    .stat-card-anim:nth-child(4) { animation-delay: 0.26s; }
    .stat-card-anim:nth-child(5) { animation-delay: 0.33s; }

    @keyframes fadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@section('content')
<div>
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard Dokter</h1>
            <p class="page-subtitle">Selamat datang, dr. {{ auth()->user()->name }} — {{ now()->format('d M Y') }}</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-sm" style="color: var(--text-muted);">{{ now()->format('l') }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <div class="stat-card stat-card-anim">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider" style="color: var(--text-muted);">Pasien Hari Ini</p>
                    <p class="text-2xl font-bold mt-1" style="color: var(--text-heading);">{{ $todayAppointments->count() }}</p>
                </div>
                <div class="stat-card-icon pink">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
            </div>
        </div>
        <div class="stat-card stat-card-anim">
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
        <div class="stat-card stat-card-anim">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider" style="color: var(--text-muted);">Check In</p>
                    <p class="text-2xl font-bold mt-1" style="color: #2563EB;">{{ $checkedInCount }}</p>
                </div>
                <div class="stat-card-icon blue">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
            </div>
        </div>
        <div class="stat-card stat-card-anim">
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
        <div class="stat-card stat-card-anim">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider" style="color: var(--text-muted);">Total Pasien</p>
                    <p class="text-2xl font-bold mt-1" style="color: var(--text-heading);">{{ $totalPatients }}</p>
                </div>
                <div class="stat-card-icon indigo">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: 48px;" class="card overflow-hidden animate-fade-up">
        <div class="flex items-center justify-between px-5 py-4 border-b" style="border-color: var(--border);">
            <h2 class="font-semibold" style="font-size: 15px; font-family: 'Poppins', sans-serif;">Appointment Hari Ini</h2>
            <span class="text-sm" style="color: var(--text-muted);">{{ $todayAppointments->count() }} appointment</span>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
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
                        <td data-label="Pasien">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold flex-shrink-0" style="background: #fce7f3; color: #db2777;">
                                    {{ substr($appointment->patient->user->name, 0, 1) }}
                                </div>
                                <span class="font-medium text-sm" style="color: var(--text-heading);">{{ $appointment->patient->user->name }}</span>
                            </div>
                        </td>
                        <td data-label="Jam">{{ $appointment->appointment_time->format('H:i') }}</td>
                        <td data-label="Layanan">{{ $appointment->service->name ?? '-' }}</td>
                        <td data-label="Keluhan">
                            <span class="truncate block max-w-[180px]" title="{{ $appointment->complaint ?? '' }}">{{ $appointment->complaint ?? '-' }}</span>
                        </td>
                        <td data-label="Status">
                            <span class="badge
                                @if($appointment->status == 'pending') badge-amber
                                @elseif($appointment->status == 'confirmed') badge-blue
                                @elseif($appointment->status == 'checked_in') badge-pink
                                @elseif($appointment->status == 'in_progress') badge-purple
                                @elseif($appointment->status == 'completed') badge-green
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                            </span>
                        </td>
                        <td data-label="Aksi">
                            @if($appointment->status == 'checked_in' || $appointment->status == 'in_progress')
                            <a href="{{ route('doctor.medical-records.create', ['appointment' => $appointment->id]) }}" class="btn btn-gold btn-sm">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
                                Rekam Medis
                            </a>
                            @elseif($appointment->status == 'completed')
                            <a href="{{ route('medical-records.show', $appointment->medicalRecord) }}" class="btn btn-primary btn-sm">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                Lihat
                            </a>
                            @else
                            <span class="text-sm" style="color: var(--text-muted);">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                </div>
                                <p class="empty-state-title">Tidak ada appointment hari ini</p>
                                <p class="empty-state-desc">Appointment yang dijadwalkan hari ini akan muncul di sini.</p>
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
