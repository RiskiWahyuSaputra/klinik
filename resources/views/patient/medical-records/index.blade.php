@extends('layouts.patient')

@section('title', 'Rekam Medis')
@section('breadcrumb', 'Rekam Medis')

@section('content')
<div>
    <div class="page-header">
        <div>
            <h1 class="page-title">Rekam Medis</h1>
            <p class="page-subtitle">Riwayat rekam medis Anda</p>
        </div>
        @if($records->count())
        <span class="text-sm" style="color: var(--text-muted);">{{ $records->total() }} total rekam medis</span>
        @endif
    </div>

    @if($records->isEmpty())
    <div class="card">
        <div class="empty-state">
            <div class="empty-state-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                </svg>
            </div>
            <p class="empty-state-title">Belum ada rekam medis</p>
            <p class="empty-state-desc">Rekam medis akan muncul setelah Anda melakukan appointment dengan dokter.</p>
        </div>
    </div>
    @else
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Dokter</th>
                        <th>Diagnosis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $record)
                    <tr>
                        <td data-label="Tanggal">
                            <span style="color: var(--text-heading); font-weight: 500;">{{ $record->created_at->format('d/m/Y') }}</span>
                            <span class="block text-xs" style="color: var(--text-muted);">{{ $record->created_at->format('H:i') }}</span>
                        </td>
                        <td data-label="Dokter">dr. {{ $record->appointment->doctor->user->name ?? '-' }}</td>
                        <td data-label="Diagnosis">
                            <span class="truncate block max-w-[300px]" title="{{ $record->diagnosis ?? '' }}">{{ $record->diagnosis ?? '-' }}</span>
                        </td>
                        <td data-label="Aksi">
                            <a href="{{ route('medical-records.show', $record) }}" class="btn btn-outline btn-sm">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                Lihat
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                                </div>
                                <p class="empty-state-title">Belum ada rekam medis</p>
                                <p class="empty-state-desc">Rekam medis akan muncul setelah Anda melakukan appointment dengan dokter.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($records->hasPages())
        <div class="pagination-wrap px-5 py-4 border-t" style="border-color: var(--border);">
            {{ $records->links() }}
        </div>
        @endif
    </div>
    @endif
</div>
@endSection
