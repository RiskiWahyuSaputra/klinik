@extends('layouts.doctor')

@section('title', 'Input Rekam Medis')
@section('breadcrumb', 'Rekam Medis / Baru')

@section('content')
<div>
    <div class="max-w-4xl mx-auto">
        <div class="page-header">
            <div>
                <h1 class="page-title">Input Rekam Medis</h1>
                <p class="page-subtitle">Lengkapi data rekam medis untuk pasien</p>
            </div>
        </div>

        <div class="card p-4 mb-6">
            <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-sm">
                <div class="flex items-center gap-2">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <span style="color: var(--text-muted);">Pasien:</span>
                    <strong style="color: var(--text-heading);">{{ $appointment->patient->user->name }}</strong>
                </div>
                <div class="flex items-center gap-2">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    <span style="color: var(--text-muted);">Layanan:</span>
                    <strong style="color: var(--text-heading);">{{ $appointment->service->name ?? '-' }}</strong>
                </div>
                <div class="flex items-center gap-2">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <span style="color: var(--text-muted);">Tanggal:</span>
                    <strong style="color: var(--text-heading);">{{ $appointment->appointment_date->format('d M Y') }}</strong>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('doctor.medical-records.store') }}" id="medicalRecordForm">
            @csrf
            <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

            <div class="card p-5 mb-5">
                <div class="section-header">
                    <div class="section-header-icon pink">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                    </div>
                    <h2 class="section-title">Tanda Vital</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                    <div>
                        <label class="label">Tekanan Darah</label>
                        <input type="text" name="blood_pressure" value="{{ old('blood_pressure') }}" placeholder="120/80" class="input">
                    </div>
                    <div>
                        <label class="label">Suhu</label>
                        <input type="number" step="0.1" name="temperature" value="{{ old('temperature') }}" placeholder="°C" class="input">
                    </div>
                    <div>
                        <label class="label">Berat Badan</label>
                        <input type="number" step="0.1" name="weight" value="{{ old('weight') }}" placeholder="kg" class="input">
                    </div>
                    <div>
                        <label class="label">Tinggi Badan</label>
                        <input type="number" step="0.1" name="height" value="{{ old('height') }}" placeholder="cm" class="input">
                    </div>
                </div>
            </div>

            <div class="card p-5 mb-5">
                <div class="section-header">
                    <div class="section-header-icon blue">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    </div>
                    <h2 class="section-title">Diagnosis & Tindakan</h2>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="label">Diagnosis <span style="color: var(--danger);">*</span></label>
                        <textarea name="diagnosis" rows="4" required
                            class="input resize-none @error('diagnosis') border-red-300 @enderror"
                            style="min-height: 90px;">{{ old('diagnosis') }}</textarea>
                        @error('diagnosis') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="label">Tindakan</label>
                        <textarea name="treatment" rows="3" class="input resize-none" style="min-height: 80px;">{{ old('treatment') }}</textarea>
                    </div>
                    <div>
                        <label class="label">Catatan Tambahan</label>
                        <textarea name="notes" rows="3" class="input resize-none" style="min-height: 80px;">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card p-5 mb-6">
                <div class="flex items-center justify-between" style="padding-bottom: 14px; margin-bottom: 16px; border-bottom: 1px solid var(--border);">
                    <div class="flex items-center gap-3">
                        <div class="section-header-icon gold">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>
                        </div>
                        <h2 class="section-title">Resep Obat</h2>
                    </div>
                    <button type="button" id="addPrescription"
                        class="btn btn-gold btn-sm">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Tambah Obat
                    </button>
                </div>
                <div id="prescriptionsContainer">
                    <div class="prescription-item grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 p-4 rounded-lg mb-3" style="background: #F9FAFB;">
                        <div>
                            <label class="label">Nama Obat</label>
                            <input type="text" name="prescriptions[0][medicine_name]" placeholder="Nama obat" class="input">
                        </div>
                        <div>
                            <label class="label">Dosis</label>
                            <input type="text" name="prescriptions[0][dosage]" placeholder="Contoh: 500mg" class="input">
                        </div>
                        <div>
                            <label class="label">Frekuensi</label>
                            <input type="text" name="prescriptions[0][frequency]" placeholder="Contoh: 3x sehari" class="input">
                        </div>
                        <div>
                            <label class="label">Durasi</label>
                            <input type="text" name="prescriptions[0][duration]" placeholder="Contoh: 5 hari" class="input">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('doctor.dashboard') }}" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary" style="padding: 8px 24px;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Simpan Rekam Medis
                </button>
            </div>
        </form>
    </div>
</div>
@endSection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let prescriptionIndex = 1;
    const container = document.getElementById('prescriptionsContainer');
    const addBtn = document.getElementById('addPrescription');

    addBtn.addEventListener('click', function() {
        const div = document.createElement('div');
        div.className = 'prescription-item grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 p-4 rounded-lg mb-3';
        div.style.background = '#F9FAFB';
        div.innerHTML = `
            <div>
                <label class="label">Nama Obat</label>
                <input type="text" name="prescriptions[${prescriptionIndex}][medicine_name]" placeholder="Nama obat" class="input">
            </div>
            <div>
                <label class="label">Dosis</label>
                <input type="text" name="prescriptions[${prescriptionIndex}][dosage]" placeholder="Contoh: 500mg" class="input">
            </div>
            <div>
                <label class="label">Frekuensi</label>
                <input type="text" name="prescriptions[${prescriptionIndex}][frequency]" placeholder="Contoh: 3x sehari" class="input">
            </div>
            <div class="relative">
                <label class="label">Durasi</label>
                <div class="flex gap-2">
                    <input type="text" name="prescriptions[${prescriptionIndex}][duration]" placeholder="Contoh: 5 hari" class="input">
                    <button type="button" class="remove-prescription" style="background: #FEE2E2; color: #DC2626; border: none; border-radius: 6px; padding: 8px 10px; cursor: pointer; flex-shrink: 0; font-size: 16px; line-height: 1;" aria-label="Hapus obat">×</button>
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
