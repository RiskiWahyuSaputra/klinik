@extends('layouts.patient')

@section('title', 'Buat Appointment')
@section('breadcrumb', 'Appointment / Baru')

@section('content')
<div>
    <div class="max-w-3xl mx-auto">
        <div class="page-header">
            <div>
                <h1 class="page-title">Buat Appointment</h1>
                <p class="page-subtitle">Isi data di bawah untuk booking appointment</p>
            </div>
        </div>

        <div class="card p-6">
            <form method="POST" action="{{ route('appointments.store') }}" id="appointmentForm">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="label">Dokter</label>
                        <select name="doctor_id" id="doctor_id" required
                            class="input select @error('doctor_id') border-red-300 @enderror">
                            <option value="">Pilih Dokter</option>
                            @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" @selected(old('doctor_id') == $doctor->id)>
                                dr. {{ $doctor->user->name }} - {{ $doctor->specialization ?? 'Umum' }}
                            </option>
                            @endforeach
                        </select>
                        @error('doctor_id') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="label">Layanan</label>
                        <select name="service_id" id="service_id" required
                            class="input select @error('service_id') border-red-300 @enderror">
                            <option value="">Pilih Layanan</option>
                            @foreach($services as $service)
                            <option value="{{ $service->id }}" data-price="{{ $service->price }}" @selected(old('service_id') == $service->id)>
                                {{ $service->name }} - Rp {{ number_format($service->price, 0, ',', '.') }}
                            </option>
                            @endforeach
                        </select>
                        @error('service_id') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="label">Tanggal</label>
                        <input type="date" name="appointment_date" id="appointment_date" value="{{ old('appointment_date') }}" required
                            min="{{ date('Y-m-d') }}"
                            class="input @error('appointment_date') border-red-300 @enderror">
                        @error('appointment_date') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="label">Jam</label>
                        <select name="appointment_time" id="appointment_time" required
                            class="input select @error('appointment_time') border-red-300 @enderror">
                            <option value="">Pilih Jam</option>
                        </select>
                        @error('appointment_time') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-5">
                    <label class="label">Keluhan</label>
                    <textarea name="complaint" rows="4" required
                        class="input resize-none @error('complaint') border-red-300 @enderror"
                        style="min-height: 90px;"
                        placeholder="Jelaskan keluhan Anda...">{{ old('complaint') }}</textarea>
                    @error('complaint') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <div>
                        <p class="text-sm" style="color: var(--text-muted);">Estimasi Biaya:</p>
                        <p class="text-xl font-bold mt-1" id="priceDisplay" style="color: var(--color-gold);">Rp 0</p>
                    </div>
                    <button type="submit" class="btn btn-primary" style="padding: 10px 28px;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        Buat Appointment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endSection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const doctorSelect = document.getElementById('doctor_id');
    const serviceSelect = document.getElementById('service_id');
    const dateInput = document.getElementById('appointment_date');
    const timeSelect = document.getElementById('appointment_time');
    const priceDisplay = document.getElementById('priceDisplay');

    serviceSelect.addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        const price = selected.dataset.price || 0;
        priceDisplay.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(price);
    });

    function loadAvailableTimes() {
        const doctorId = doctorSelect.value;
        const date = dateInput.value;

        if (!doctorId || !date) {
            timeSelect.innerHTML = '<option value="">Pilih Jam</option>';
            return;
        }

        timeSelect.innerHTML = '<option value="">Memuat...</option>';

        fetch(`/api/doctors/${doctorId}/available-times?date=${date}`)
            .then(res => res.json())
            .then(data => {
                timeSelect.innerHTML = '<option value="">Pilih Jam</option>';
                if (data.times && data.times.length > 0) {
                    data.times.forEach(time => {
                        const opt = document.createElement('option');
                        opt.value = time;
                        opt.textContent = time;
                        timeSelect.appendChild(opt);
                    });
                } else {
                    timeSelect.innerHTML = '<option value="">Tidak ada jam tersedia</option>';
                }
            })
            .catch(() => {
                timeSelect.innerHTML = '<option value="">Gagal memuat jam</option>';
            });
    }

    doctorSelect.addEventListener('change', loadAvailableTimes);
    dateInput.addEventListener('change', loadAvailableTimes);
});
</script>
@endpush
