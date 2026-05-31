@extends('layouts.doctor')

@section('title', 'Rekam Medis')
@section('breadcrumb', 'Rekam Medis')

@section('content')
<div>
    <div class="page-header">
        <div>
            <h1 class="page-title">Rekam Medis Pasien</h1>
            <p class="page-subtitle">Riwayat rekam medis yang telah Anda buat</p>
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
            <p class="empty-state-desc">Rekam medis akan muncul setelah Anda menangani pasien.</p>
        </div>
    </div>
    @else
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Pasien</th>
                        <th>Diagnosis</th>
                        <th>Tindakan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                    <tr>
                        <td data-label="Tanggal">
                            <span style="color: var(--text-heading); font-weight: 500;">{{ $record->created_at->format('d/m/Y') }}</span>
                            <span class="block text-xs" style="color: var(--text-muted);">{{ $record->created_at->format('H:i') }}</span>
                        </td>
                        <td data-label="Pasien">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold flex-shrink-0" style="background: #fce7f3; color: #db2777;">
                                    {{ substr($record->patient->user->name ?? '?', 0, 1) }}
                                </div>
                                <span class="font-medium text-sm" style="color: var(--text-heading);">{{ $record->patient->user->name ?? '-' }}</span>
                            </div>
                        </td>
                        <td data-label="Diagnosis">
                            <span class="truncate block max-w-[240px]" title="{{ $record->diagnosis ?? '' }}">{{ $record->diagnosis ?? '-' }}</span>
                        </td>
                        <td data-label="Tindakan">
                            <span class="truncate block max-w-[200px]" title="{{ $record->treatment ?? '' }}">{{ $record->treatment ?? '-' }}</span>
                        </td>
                        <td data-label="Aksi">
                            <a href="{{ route('medical-records.show', $record) }}" class="btn btn-primary btn-sm">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
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
