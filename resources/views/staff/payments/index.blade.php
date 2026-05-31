@extends('layouts.staff')

@section('title', 'Pembayaran')
@section('breadcrumb', 'Pembayaran')

@section('content')
<div>
    <div class="page-header">
        <div>
            <h1 class="page-title">Pembayaran</h1>
            <p class="page-subtitle">Riwayat pembayaran pasien</p>
        </div>
        <span class="text-sm" style="color: var(--text-muted);">Pembayaran dicatat melalui halaman appointment</span>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Pasien</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                    <tr>
                        <td data-label="Invoice"><span class="font-medium" style="color: var(--text-heading);">#{{ $payment->invoice_number }}</span></td>
                        <td data-label="Pasien">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold flex-shrink-0" style="background: #fce7f3; color: #db2777;">
                                    {{ substr($payment->appointment->patient->user->name ?? '?', 0, 1) }}
                                </div>
                                <span class="font-medium text-sm" style="color: var(--text-heading);">{{ $payment->appointment->patient->user->name ?? '-' }}</span>
                            </div>
                        </td>
                        <td data-label="Jumlah"><span class="font-medium" style="color: var(--color-gold);">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span></td>
                        <td data-label="Metode">{{ ucfirst($payment->payment_method ?? '-') }}</td>
                        <td data-label="Status">
                            <span class="badge
                                @if($payment->status == 'pending') badge-amber
                                @elseif($payment->status == 'paid') badge-green
                                @elseif($payment->status == 'cancelled') badge-red
                                @else badge-gray
                                @endif">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </td>
                        <td data-label="Tanggal">{{ $payment->created_at->format('d M Y') }}</td>
                        <td data-label="Aksi">
                            <a href="#" class="btn btn-outline btn-sm">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                                </div>
                                <p class="empty-state-title">Belum ada pembayaran</p>
                                <p class="empty-state-desc">Riwayat pembayaran akan muncul di sini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($payments->hasPages())
    <div class="pagination-wrap">
        {{ $payments->links() }}
    </div>
    @endif
</div>
@endSection
