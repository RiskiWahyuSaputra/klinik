@extends('layouts.patient')

@section('title', 'Buat Appointment')
@section('breadcrumb', 'Appointment / Baru')

@section('content')
<div class="py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="page-title">Buat Appointment</h1>
        <p class="text-gray-500 mb-8">Isi data di bawah untuk booking appointment</p>

        <div class="admin-card p-8">
            <form method="POST" action="{{ route('appointments.store') }}" id="appointmentForm">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Dokter</label>
                        <select name="doctor_id" id="doctor_id" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('doctor_id') border-red-300 @enderror">
                            <option value="">Pilih Dokter</option>
                            @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" @selected(old('doctor_id') == $doctor->id)>
                                dr. {{ $doctor->user->name }} - {{ $doctor->specialization ?? 'Umum' }}
                            </option>
                            @endforeach
                        </select>
                        @error('doctor_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Layanan</label>
                        <select name="service_id" id="service_id" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('service_id') border-red-300 @enderror">
                            <option value="">Pilih Layanan</option>
                            @foreach($services as $service)
                            <option value="{{ $service->id }}" data-price="{{ $service->price }}" @selected(old('service_id') == $service->id)>
                                {{ $service->name }} - Rp {{ number_format($service->price, 0, ',', '.') }}
                            </option>
                            @endforeach
                        </select>
                        @error('service_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Tanggal</label>
                        <input type="date" name="appointment_date" id="appointment_date" value="{{ old('appointment_date') }}" required
                            min="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('appointment_date') border-red-300 @enderror">
                        @error('appointment_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Jam</label>
                        <select name="appointment_time" id="appointment_time" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('appointment_time') border-red-300 @enderror">
                            <option value="">Pilih Jam</option>
                        </select>
                        @error('appointment_time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Keluhan</label>
                    <textarea name="complaint" rows="4" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition resize-none @error('complaint') border-red-300 @enderror"
                        placeholder="Jelaskan keluhan Anda...">{{ old('complaint') }}</textarea>
                    @error('complaint') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mt-8 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Estimasi Biaya:</p>
                        <p class="text-2xl font-bold" id="priceDisplay" style="color: #D4AF37;">Rp 0</p>
                    </div>
                    <button type="submit"
                        class="text-white px-8 py-3 rounded-xl font-semibold text-lg transition shadow-md hover:shadow-lg"
                        style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                        Buat Appointment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

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