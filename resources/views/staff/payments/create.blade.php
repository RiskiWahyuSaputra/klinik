@extends('layouts.app')

@section('title', 'Pembayaran Baru')

@section('content')
<div class="py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold font-[Poppins] text-gray-800 mb-8">Catat Pembayaran</h1>

        <div class="bg-white rounded-2xl shadow-md p-8">
            <form method="POST" action="{{ route('staff.payments.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Appointment</label>
                    <select name="appointment_id" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('appointment_id') border-red-300 @enderror">
                        <option value="">Pilih Appointment</option>
                        @foreach($appointments as $appointment)
                        <option value="{{ $appointment->id }}" data-amount="{{ $appointment->service->price ?? 0 }}" @selected(old('appointment_id') == $appointment->id)>
                            #{{ $appointment->appointment_number }} - {{ $appointment->patient->user->name }} - {{ $appointment->appointment_date->format('d M Y') }}
                        </option>
                        @endforeach
                    </select>
                    @error('appointment_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Jumlah Pembayaran</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-gray-400">Rp</span>
                        <input type="number" name="amount" id="amount" value="{{ old('amount') }}" required
                            class="w-full px-12 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('amount') border-red-300 @enderror"
                            placeholder="0">
                    </div>
                    @error('amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Metode Pembayaran</label>
                    <select name="payment_method" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('payment_method') border-red-300 @enderror">
                        <option value="">Pilih Metode</option>
                        <option value="cash" @selected(old('payment_method') == 'cash')>Tunai</option>
                        <option value="debit" @selected(old('payment_method') == 'debit')>Kartu Debit</option>
                        <option value="credit" @selected(old('payment_method') == 'credit')>Kartu Kredit</option>
                        <option value="transfer" @selected(old('payment_method') == 'transfer')>Transfer Bank</option>
                        <option value="qris" @selected(old('payment_method') == 'qris')>QRIS</option>
                    </select>
                    @error('payment_method') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Status</label>
                    <select name="status" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
                        <option value="paid" @selected(old('status') == 'paid')>Lunas</option>
                        <option value="pending" @selected(old('status') == 'pending')>Menunggu</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Catatan</label>
                    <textarea name="notes" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition resize-none">{{ old('notes') }}</textarea>
                </div>

                <button type="submit"
                    class="w-full text-white py-3 rounded-xl font-semibold transition shadow-md hover:shadow-lg"
                    style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                    Catat Pembayaran
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

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