@extends('layouts.staff')

@section('title', 'Dashboard Staff')
@section('breadcrumb', 'Dashboard')

@section('content')
<div>
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard Staff</h1>
            <p class="page-subtitle">Overview appointment hari ini ({{ now()->format('d M Y') }})</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-sm" style="color: var(--text-muted);">{{ now()->format('l') }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider" style="color: var(--text-muted);">Menunggu</p>
                    <p class="text-2xl font-bold mt-1" style="color: #a16207;">{{ $waitingCount }}</p>
                </div>
                <div class="stat-card-icon gold">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
            </div>
        </div>
        <div class="stat-card">
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
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider" style="color: var(--text-muted);">Dalam Pemeriksaan</p>
                    <p class="text-2xl font-bold mt-1" style="color: #7C3AED;">{{ $inProgressCount }}</p>
                </div>
                <div class="stat-card-icon purple">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
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
    </div>

    <div class="card overflow-hidden" style="margin-top: 40px;">
        <div class="flex items-center justify-between px-5 py-4 border-b" style="border-color: var(--border);">
            <h2 class="font-semibold" style="font-size: 15px; font-family: 'Poppins', sans-serif;">Appointment Hari Ini</h2>
            <span class="text-sm" style="color: var(--text-muted);">{{ $todayAppointments->count() }} appointment</span>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Jam</th>
                        <th>Layanan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($todayAppointments as $appointment)
                    <tr>
                        <td data-label="No."><span class="font-medium" style="color: var(--text-heading);">#{{ $appointment->appointment_number }}</span></td>
                        <td data-label="Pasien">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold flex-shrink-0" style="background: #fce7f3; color: #db2777;">
                                    {{ substr($appointment->patient->user->name, 0, 1) }}
                                </div>
                                <span class="font-medium text-sm" style="color: var(--text-heading);">{{ $appointment->patient->user->name }}</span>
                            </div>
                        </td>
                        <td data-label="Dokter">dr. {{ $appointment->doctor->user->name }}</td>
                        <td data-label="Jam">{{ $appointment->appointment_time->format('H:i') }}</td>
                        <td data-label="Layanan">{{ $appointment->service->name ?? '-' }}</td>
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
                            <div class="flex gap-2">
                                @if($appointment->status == 'pending' || $appointment->status == 'confirmed')
                                <form method="POST" action="{{ route('appointments.update-status', $appointment) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="checked_in">
                                    <button type="submit" class="btn btn-primary btn-sm">Check In</button>
                                </form>
                                @endif
                                @if($appointment->status == 'checked_in')
                                <form method="POST" action="{{ route('appointments.update-status', $appointment) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="in_progress">
                                    <button type="submit" class="btn btn-gold btn-sm">Mulai</button>
                                </form>
                                @endif
                                @if($appointment->status == 'in_progress')
                                <form method="POST" action="{{ route('appointments.update-status', $appointment) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="btn btn-primary btn-sm">Selesai</button>
                                </form>
                                @endif
                                @if($appointment->status == 'pending')
                                <form method="POST" action="{{ route('appointments.update-status', $appointment) }}" onsubmit="return confirm('Batalkan appointment ini?')">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="btn btn-outline btn-sm" style="color: var(--danger); border-color: #FECACA;">Batal</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
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
