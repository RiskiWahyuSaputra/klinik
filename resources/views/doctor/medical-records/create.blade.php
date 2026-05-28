@extends('layouts.app')

@section('title', 'Input Rekam Medis')

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold font-[Poppins] text-gray-800 mb-2">Input Rekam Medis</h1>
        <p class="text-gray-500 mb-8">
            Pasien: <strong>{{ $appointment->patient->user->name }}</strong> |
            Layanan: <strong>{{ $appointment->service->name ?? '-' }}</strong> |
            Tanggal: <strong>{{ $appointment->appointment_date->format('d M Y') }}</strong>
        </p>

        <form method="POST" action="{{ route('doctor.medical-records.store') }}" id="medicalRecordForm">
            @csrf
            <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

            <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Tanda Vital</h2>
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Tekanan Darah</label>
                        <input type="text" name="blood_pressure" value="{{ old('blood_pressure') }}" placeholder="120/80"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Detak Jantung</label>
                        <input type="number" name="heart_rate" value="{{ old('heart_rate') }}" placeholder="bpm"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Suhu</label>
                        <input type="number" step="0.1" name="temperature" value="{{ old('temperature') }}" placeholder="°C"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Berat Badan</label>
                        <input type="number" step="0.1" name="weight" value="{{ old('weight') }}" placeholder="kg"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Tinggi Badan</label>
                        <input type="number" step="0.1" name="height" value="{{ old('height') }}" placeholder="cm"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Diagnosis & Tindakan</h2>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Diagnosis</label>
                    <textarea name="diagnosis" rows="4" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition resize-none @error('diagnosis') border-red-300 @enderror">{{ old('diagnosis') }}</textarea>
                    @error('diagnosis') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Tindakan</label>
                    <textarea name="treatment" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition resize-none">{{ old('treatment') }}</textarea>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Catatan Tambahan</label>
                    <textarea name="notes" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition resize-none">{{ old('notes') }}</textarea>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Resep Obat</h2>
                    <button type="button" id="addPrescription"
                        class="text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow"
                        style="background: linear-gradient(135deg, #D4AF37, #B8860B);">
                        + Tambah Obat
                    </button>
                </div>
                <div id="prescriptionsContainer">
                    <div class="prescription-item grid grid-cols-1 md:grid-cols-4 gap-4 p-4 bg-gray-50 rounded-xl mb-3">
                        <div>
                            <label class="block text-gray-700 text-xs font-medium mb-1">Nama Obat</label>
                            <input type="text" name="prescriptions[0][medicine_name]" placeholder="Nama obat"
                                class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition text-sm">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-xs font-medium mb-1">Dosis</label>
                            <input type="text" name="prescriptions[0][dosage]" placeholder="Contoh: 500mg"
                                class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition text-sm">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-xs font-medium mb-1">Frekuensi</label>
                            <input type="text" name="prescriptions[0][frequency]" placeholder="Contoh: 3x sehari"
                                class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition text-sm">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-xs font-medium mb-1">Durasi</label>
                            <input type="text" name="prescriptions[0][duration]" placeholder="Contoh: 5 hari"
                                class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition text-sm">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('doctor.dashboard') }}" class="px-6 py-3 rounded-xl font-medium border border-gray-200 text-gray-600 hover:bg-gray-50 transition">Batal</a>
                <button type="submit"
                    class="text-white px-8 py-3 rounded-xl font-semibold transition shadow-md hover:shadow-lg"
                    style="background: linear-gradient(135deg, #D4AF37, #B8860B);">
                    Simpan Rekam Medis
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let prescriptionIndex = 1;
    const container = document.getElementById('prescriptionsContainer');
    const addBtn = document.getElementById('addPrescription');

    addBtn.addEventListener('click', function() {
        const div = document.createElement('div');
        div.className = 'prescription-item grid grid-cols-1 md:grid-cols-4 gap-4 p-4 bg-gray-50 rounded-xl mb-3';
        div.innerHTML = `
            <div>
                <label class="block text-gray-700 text-xs font-medium mb-1">Nama Obat</label>
                <input type="text" name="prescriptions[${prescriptionIndex}][medicine_name]" placeholder="Nama obat"
                    class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition text-sm">
            </div>
            <div>
                <label class="block text-gray-700 text-xs font-medium mb-1">Dosis</label>
                <input type="text" name="prescriptions[${prescriptionIndex}][dosage]" placeholder="Contoh: 500mg"
                    class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition text-sm">
            </div>
            <div>
                <label class="block text-gray-700 text-xs font-medium mb-1">Frekuensi</label>
                <input type="text" name="prescriptions[${prescriptionIndex}][frequency]" placeholder="Contoh: 3x sehari"
                    class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition text-sm">
            </div>
            <div class="relative">
                <label class="block text-gray-700 text-xs font-medium mb-1">Durasi</label>
                <div class="flex space-x-2">
                    <input type="text" name="prescriptions[${prescriptionIndex}][duration]" placeholder="Contoh: 5 hari"
                        class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition text-sm">
                    <button type="button" class="remove-prescription text-red-500 hover:text-red-700 px-2">×</button>
                </div>
            </div>
        `;
        container.appendChild(div);
        prescriptionIndex++;

        div.querySelector('.remove-prescription').addEventListener('click', function() {
            div.remove();
        });
    });
});
</script>
@endpush