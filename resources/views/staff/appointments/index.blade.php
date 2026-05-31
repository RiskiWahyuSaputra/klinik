@extends('layouts.staff')

@section('title', 'Kelola Appointment')
@section('breadcrumb', 'Appointment')

@section('content')
<div>
    <div class="page-header">
        <div>
            <h1 class="page-title">Kelola Appointment</h1>
            <p class="page-subtitle">Daftar semua appointment pasien</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('appointments.create') }}" class="btn btn-primary">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Appointment Baru
            </a>
        </div>
    </div>

    <div class="card p-4 mb-5">
        <form method="GET" class="flex flex-wrap gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pasien/dokter..." class="input" style="flex: 1; min-width: 180px;">
            <select name="status" class="input select" style="width: auto; min-width: 140px;">
                <option value="">Semua Status</option>
                <option value="pending" @selected(request('status') == 'pending')>Pending</option>
                <option value="confirmed" @selected(request('status') == 'confirmed')>Confirmed</option>
                <option value="checked_in" @selected(request('status') == 'checked_in')>Checked In</option>
                <option value="in_progress" @selected(request('status') == 'in_progress')>In Progress</option>
                <option value="completed" @selected(request('status') == 'completed')>Completed</option>
                <option value="cancelled" @selected(request('status') == 'cancelled')>Cancelled</option>
            </select>
            <input type="date" name="date" value="{{ request('date') }}" class="input" style="width: auto;">
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
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
                        <td data-label="Tanggal">{{ $appointment->appointment_date->format('d M Y') }}</td>
                        <td data-label="Jam">{{ $appointment->appointment_time->format('H:i') }}</td>
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
                                <p class="empty-state-title">Tidak ada appointment</p>
                                <p class="empty-state-desc">Appointment yang dijadwalkan akan muncul di sini.</p>
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
