@extends('layouts.staff')

@section('title', 'Pasien')
@section('breadcrumb', 'Pasien')

@section('content')
<div>
    <div class="page-header">
        <div>
            <h1 class="page-title">Daftar Pasien</h1>
            <p class="page-subtitle">Kelola data pasien klinik</p>
        </div>
        <a href="{{ route('staff.patients.create') }}" class="btn btn-primary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Pasien Baru
        </a>
    </div>

    <div class="card p-4 mb-5">
        <form method="GET" class="flex flex-wrap gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/email/telepon..." class="input" style="flex: 1; min-width: 200px;">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No. Pasien</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $patient)
                    <tr>
                        <td data-label="No. Pasien"><span class="font-medium" style="color: var(--text-heading);">{{ $patient->patient_number ?? 'P-'.str_pad($patient->id, 4, '0', STR_PAD_LEFT) }}</span></td>
                        <td data-label="Nama">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold flex-shrink-0" style="background: #fce7f3; color: #db2777;">
                                    {{ substr($patient->user->name, 0, 1) }}
                                </div>
                                <span class="font-medium text-sm" style="color: var(--text-heading);">{{ $patient->user->name }}</span>
                            </div>
                        </td>
                        <td data-label="Email">{{ $patient->user->email }}</td>
                        <td data-label="Telepon">{{ $patient->phone ?? $patient->user->phone ?? '-' }}</td>
                        <td data-label="Aksi">
                            <a href="{{ route('staff.patients.show', $patient) }}" class="btn btn-outline btn-sm">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                </div>
                                <p class="empty-state-title">Tidak ada pasien</p>
                                <p class="empty-state-desc">Data pasien akan muncul di sini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($patients->hasPages())
    <div class="pagination-wrap">
        {{ $patients->links() }}
    </div>
    @endif
</div>
@endSection
