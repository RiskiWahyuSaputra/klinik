@extends('layouts.patient')

@section('title', 'Riwayat Appointment')
@section('breadcrumb', 'Appointment')

@section('content')
<div>
    <div class="page-header">
        <div>
            <h1 class="page-title">Riwayat Appointment</h1>
            <p class="page-subtitle">Daftar appointment Anda</p>
        </div>
        <a href="{{ route('appointments.create') }}" class="btn btn-primary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Buat Appointment
        </a>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No. Appointment</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Dokter</th>
                        <th>Layanan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                    <tr>
                        <td data-label="No."><span class="font-medium" style="color: var(--text-heading);">#{{ $appointment->appointment_number }}</span></td>
                        <td data-label="Tanggal">{{ $appointment->appointment_date->format('d M Y') }}</td>
                        <td data-label="Jam">{{ $appointment->appointment_time->format('H:i') }}</td>
                        <td data-label="Dokter">dr. {{ $appointment->doctor->user->name }}</td>
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
                                <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-outline btn-sm">Detail</a>
                                @if($appointment->status == 'pending')
                                <form method="POST" action="{{ route('appointments.cancel', $appointment) }}" onsubmit="return confirm('Batalkan appointment ini?')">
                                    @csrf @method('PUT')
                                    <button type="submit" class="btn btn-sm" style="background: #FEE2E2; color: var(--danger);">Batal</button>
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

    @if($appointments->hasPages())
    <div class="pagination-wrap">
        {{ $appointments->links() }}
    </div>
    @endif
</div>
@endSection
