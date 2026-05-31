@extends('layouts.staff')

@section('title', 'Pembayaran Baru')
@section('breadcrumb', 'Pembayaran / Baru')

@section('content')
<div>
    <div class="max-w-2xl mx-auto">
        <div class="page-header">
            <div>
                <h1 class="page-title">Catat Pembayaran</h1>
                <p class="page-subtitle">Catat pembayaran untuk appointment pasien</p>
            </div>
        </div>

        <div class="card p-6">
            <form method="POST" action="{{ route('staff.payments.store') }}">
                @csrf

                <div class="mb-5">
                    <label class="label">Appointment</label>
                    <select name="appointment_id" required
                        class="input select @error('appointment_id') border-red-300 @enderror">
                        <option value="">Pilih Appointment</option>
                        @foreach($appointments as $appointment)
                        <option value="{{ $appointment->id }}" data-amount="{{ $appointment->service->price ?? 0 }}" @selected(old('appointment_id') == $appointment->id)>
                            #{{ $appointment->appointment_number }} - {{ $appointment->patient->user->name }} - {{ $appointment->appointment_date->format('d M Y') }}
                        </option>
                        @endforeach
                    </select>
                    @error('appointment_id') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                </div>

                <div class="mb-5">
                    <label class="label">Jumlah Pembayaran</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm" style="color: var(--text-muted);">Rp</span>
                        <input type="number" name="amount" id="amount" value="{{ old('amount') }}" required
                            class="input @error('amount') border-red-300 @enderror"
                            style="padding-left: 36px;"
                            placeholder="0">
                    </div>
                    @error('amount') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                </div>

                <div class="mb-5">
                    <label class="label">Metode Pembayaran</label>
                    <select name="payment_method" required
                        class="input select @error('payment_method') border-red-300 @enderror">
                        <option value="">Pilih Metode</option>
                        <option value="cash" @selected(old('payment_method') == 'cash')>Tunai</option>
                        <option value="debit" @selected(old('payment_method') == 'debit')>Kartu Debit</option>
                        <option value="credit" @selected(old('payment_method') == 'credit')>Kartu Kredit</option>
                        <option value="transfer" @selected(old('payment_method') == 'transfer')>Transfer Bank</option>
                        <option value="qris" @selected(old('payment_method') == 'qris')>QRIS</option>
                    </select>
                    @error('payment_method') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                </div>

                <div class="mb-5">
                    <label class="label">Status</label>
                    <select name="status" required class="input select">
                        <option value="paid" @selected(old('status') == 'paid')>Lunas</option>
                        <option value="pending" @selected(old('status') == 'pending')>Menunggu</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="label">Catatan</label>
                    <textarea name="notes" rows="3" class="input resize-none" style="min-height: 80px;">{{ old('notes') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary w-full" style="padding: 11px; justify-content: center;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Catat Pembayaran
                </button>
            </form>
        </div>
    </div>
</div>
@endSection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const appointmentSelect = document.querySelector('select[name="appointment_id"]');
    const amountInput = document.getElementById('amount');

    appointmentSelect.addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        const amount = selected.dataset.amount || 0;
        if (!amountInput.value) {
            amountInput.value = amount;
        }
    });
});
</script>
@endpush
