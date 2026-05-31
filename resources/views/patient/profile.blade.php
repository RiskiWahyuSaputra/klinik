@extends('layouts.patient')

@section('title', 'Profil Saya')
@section('breadcrumb', 'Profil')

@section('content')
<div>
    <div class="page-header">
        <div>
            <h1 class="page-title">Profil Saya</h1>
            <p class="page-subtitle">Kelola data diri dan pengaturan akun</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="card p-6">
            <h2 class="font-semibold mb-5" style="font-size: 16px; font-family: 'Poppins', sans-serif;">Data Pribadi</h2>

            <form method="POST" action="{{ route('patient.profile.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="label">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="input @error('name') border-red-300 @enderror">
                    @error('name') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="input @error('email') border-red-300 @enderror">
                    @error('email') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="label">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $patient->phone ?? $user->phone) }}"
                        class="input @error('phone') border-red-300 @enderror">
                    @error('phone') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="label">Tanggal Lahir</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $patient->date_of_birth ?? '') }}" class="input">
                </div>

                <div class="mb-4">
                    <label class="label">Jenis Kelamin</label>
                    <select name="gender" class="input select">
                        <option value="">Pilih</option>
                        <option value="male" @selected(old('gender', $patient->gender ?? '') == 'male')>Laki-laki</option>
                        <option value="female" @selected(old('gender', $patient->gender ?? '') == 'female')>Perempuan</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="label">Alamat</label>
                    <textarea name="address" rows="3" class="input resize-none" style="min-height: 80px;">{{ old('address', $patient->address ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Simpan Perubahan
                </button>
            </form>
        </div>

        <div class="space-y-6">
            <div class="card p-6">
                <h2 class="font-semibold mb-5" style="font-size: 16px; font-family: 'Poppins', sans-serif;">Kontak Darurat</h2>

                <form method="POST" action="{{ route('patient.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="label">Nama Kontak Darurat</label>
                        <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name', $patient->emergency_contact_name ?? '') }}" class="input">
                    </div>

                    <div class="mb-4">
                        <label class="label">Telepon Kontak Darurat</label>
                        <input type="text" name="emergency_contact_phone" value="{{ old('emergency_contact_phone', $patient->emergency_contact_phone ?? '') }}" class="input">
                    </div>

                    <button type="submit" class="btn btn-gold">Simpan</button>
                </form>
            </div>

            <div class="card p-6">
                <h2 class="font-semibold mb-5" style="font-size: 16px; font-family: 'Poppins', sans-serif;">Ubah Password</h2>

                <form method="POST" action="{{ route('profile.password') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="label">Password Lama</label>
                        <input type="password" name="current_password" required class="input">
                    </div>

                    <div class="mb-4">
                        <label class="label">Password Baru</label>
                        <input type="password" name="password" required class="input">
                    </div>

                    <div class="mb-4">
                        <label class="label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" required class="input">
                    </div>

                    <button type="submit" class="btn btn-outline">Ubah Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endSection
