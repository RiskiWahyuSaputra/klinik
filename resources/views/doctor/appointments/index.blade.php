@extends('layouts.doctor')

@section('title', 'Appointment Saya')
@section('breadcrumb', 'Appointment')

@section('content')
<div>
    <div class="page-header">
        <div>
            <h1 class="page-title">Appointment Saya</h1>
            <p class="page-subtitle">Daftar appointment pasien yang telah dijadwalkan</p>
        </div>
        <span class="text-sm" style="color: var(--text-muted);">{{ $appointments->total() }} total appointment</span>
    </div>

    <div class="card overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-3 border-b flex-wrap" style="border-color: var(--border);">
            <div class="relative flex-1 min-w-[180px] max-w-[260px]">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" id="searchInput" placeholder="Cari pasien..." class="input" style="padding-left: 36px;">
            </div>
            <select id="statusFilter" class="input select" style="width: auto; min-width: 150px;">
                <option value="">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="checked_in">Check In</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table" id="appointmentsTable">
                <thead>
                    <tr>
                        <th>Pasien</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Layanan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                    <tr>
                        <td data-label="Pasien">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold flex-shrink-0" style="background: #fce7f3; color: #db2777;">
                                    {{ substr($appointment->patient->user->name, 0, 1) }}
                                </div>
                                <span class="font-medium text-sm" style="color: var(--text-heading);">{{ $appointment->patient->user->name }}</span>
                            </div>
                        </td>
                        <td data-label="Tanggal">{{ $appointment->appointment_date->format('d M Y') }}</td>
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
                            @if($appointment->status == 'checked_in' || $appointment->status == 'in_progress')
                            <a href="{{ route('doctor.medical-records.create', ['appointment' => $appointment->id]) }}" class="btn btn-gold btn-sm">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
                                Rekam Medis
                            </a>
                            @elseif($appointment->status == 'completed' && $appointment->medicalRecord)
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const table = document.getElementById('appointmentsTable');

    if (searchInput && statusFilter && table) {
        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();
            const statusVal = statusFilter.value.toLowerCase();
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const name = row.querySelector('td[data-label="Pasien"]')?.textContent?.toLowerCase() || '';
                const status = row.querySelector('td[data-label="Status"]')?.textContent?.trim()?.toLowerCase() || '';
                const matchSearch = name.includes(searchTerm);
                const matchStatus = !statusVal || status === statusVal.replace('_', ' ');
                row.style.display = matchSearch && matchStatus ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterTable);
        statusFilter.addEventListener('change', filterTable);
    }
});
</script>
@endpush
@endSection
