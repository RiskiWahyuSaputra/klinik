@extends('layouts.staff')

@section('title', 'Registrasi Pasien Baru')
@section('breadcrumb', 'Pasien / Baru')

@section('content')
<div>
    <div class="max-w-2xl mx-auto">
        <div class="page-header">
            <div>
                <h1 class="page-title">Registrasi Pasien Baru</h1>
                <p class="page-subtitle">Lengkapi data pasien untuk mendaftarkan akun baru</p>
            </div>
        </div>

        <div class="card p-6">
            <form method="POST" action="{{ route('staff.patients.store') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="label">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="input @error('name') border-red-300 @enderror"
                            placeholder="Nama pasien">
                        @error('name') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="input @error('email') border-red-300 @enderror"
                            placeholder="pasien@email.com">
                        @error('email') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="label">Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required
                            class="input @error('phone') border-red-300 @enderror"
                            placeholder="08123456789">
                        @error('phone') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="label">Password</label>
                        <input type="password" name="password" required
                            class="input @error('password') border-red-300 @enderror"
                            placeholder="Minimal 8 karakter">
                        @error('password') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                            class="input"
                            placeholder="Ulangi password">
                    </div>

                    <div>
                        <label class="label">Tanggal Lahir</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="input">
                    </div>

                    <div>
                        <label class="label">Jenis Kelamin</label>
                        <select name="gender" class="input select">
                            <option value="">Pilih</option>
                            <option value="male" @selected(old('gender') == 'male')>Laki-laki</option>
                            <option value="female" @selected(old('gender') == 'female')>Perempuan</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="label">Alamat</label>
                        <textarea name="address" rows="3" class="input resize-none" style="min-height: 80px;">{{ old('address') }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="btn btn-primary" style="padding: 10px 28px;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Daftarkan Pasien
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endSection
