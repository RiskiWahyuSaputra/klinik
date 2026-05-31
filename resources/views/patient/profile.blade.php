@extends('layouts.patient')

@section('title', 'Profil Saya')
@section('breadcrumb', 'Profil')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Profil Saya</h1>
        <p class="page-subtitle">Kelola data diri dan pengaturan akun</p>
    </div>
</div>

<div class="card overflow-hidden mb-6">
    <div style="background: linear-gradient(135deg, #1a0f1c, #2d1a28); padding: 32px 28px;">
        <div class="flex items-center gap-5">
            <div style="width: 64px; height: 64px; border-radius: 50%; background: linear-gradient(135deg, #FFB6C1, #FF69B4); display: flex; align-items: center; justify-content: center; font-size: 26px; font-weight: 700; color: #fff; flex-shrink: 0; font-family: 'Poppins', sans-serif; box-shadow: 0 4px 16px rgba(255, 105, 180, 0.4);">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div>
                <h2 style="font-size: 20px; font-weight: 700; color: #fff; font-family: 'Poppins', sans-serif;">{{ $user->name }}</h2>
                <p style="font-size: 13px; color: rgba(255, 255, 255, 0.6); margin-top: 2px;">{{ $user->email }}</p>
                @if($patient)
                <p style="font-size: 12px; color: rgba(255, 255, 255, 0.4); margin-top: 4px;">
                    Pasien sejak {{ $patient->created_at ? $patient->created_at->format('d M Y') : now()->format('d M Y') }}
                </p>
                @endif
            </div>
        </div>
    </div>
    @if($patient)
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 0; border-top: 1px solid var(--border);">
        <div style="padding: 16px 20px; text-align: center; border-right: 1px solid var(--border);">
            <p style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted); font-weight: 600;">Jenis Kelamin</p>
            <p style="font-size: 14px; font-weight: 600; color: var(--text-heading); margin-top: 4px;">
                @if($patient->gender == 'male') Laki-laki
                @elseif($patient->gender == 'female') Perempuan
                @else <span style="color: var(--text-muted);">—</span>
                @endif
            </p>
        </div>
        <div style="padding: 16px 20px; text-align: center; border-right: 1px solid var(--border);">
            <p style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted); font-weight: 600;">Tanggal Lahir</p>
            <p style="font-size: 14px; font-weight: 600; color: var(--text-heading); margin-top: 4px;">
                {{ $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->format('d M Y') : '—' }}
            </p>
        </div>
        <div style="padding: 16px 20px; text-align: center;">
            <p style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted); font-weight: 600;">Telepon</p>
            <p style="font-size: 14px; font-weight: 600; color: var(--text-heading); margin-top: 4px;">
                {{ $patient->phone ?? $user->phone ?? '—' }}
            </p>
        </div>
    </div>
    @endif
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="card p-6">
            <div class="flex items-center gap-3 mb-6">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FF69B4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <h2 style="font-size: 16px; font-weight: 600; color: var(--text-heading); font-family: 'Poppins', sans-serif;">Data Pribadi</h2>
            </div>

            <form method="POST" action="{{ route('patient.profile.update') }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="label">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="input @error('name') border-red-300 @enderror">
                        @error('name') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="input @error('email') border-red-300 @enderror">
                        @error('email') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="label">Nomor Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', $patient->phone ?? $user->phone) }}"
                            class="input @error('phone') border-red-300 @enderror">
                        @error('phone') <p class="text-xs mt-1" style="color: var(--danger);">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="label">Tanggal Lahir</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $patient->date_of_birth ?? '') }}" class="input">
                    </div>

                    <div>
                        <label class="label">Jenis Kelamin</label>
                        <select name="gender" class="input select">
                            <option value="">Pilih</option>
                            <option value="male" @selected(old('gender', $patient->gender ?? '') == 'male')>Laki-laki</option>
                            <option value="female" @selected(old('gender', $patient->gender ?? '') == 'female')>Perempuan</option>
                        </select>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="label">Alamat</label>
                        <textarea name="address" rows="2" class="input resize-none" style="min-height: 70px;">{{ old('address', $patient->address ?? '') }}</textarea>
                    </div>
                </div>

                <div class="mt-6 pt-5 border-t" style="border-color: var(--border);">
                    <button type="submit" class="btn btn-primary">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="space-y-6">
        <div class="card p-6">
            <div class="flex items-center gap-3 mb-6">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#D4AF37" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path>
                    <line x1="12" y1="2" x2="12" y2="12"></line>
                </svg>
                <h2 style="font-size: 16px; font-weight: 600; color: var(--text-heading); font-family: 'Poppins', sans-serif;">Kontak Darurat</h2>
            </div>

            <form method="POST" action="{{ route('patient.profile.update') }}">
                @csrf
                @method('PUT')

                <input type="hidden" name="name" value="{{ $user->name }}">
                <input type="hidden" name="email" value="{{ $user->email }}">
                <input type="hidden" name="phone" value="{{ $patient->phone ?? $user->phone }}">
                <input type="hidden" name="date_of_birth" value="{{ $patient->date_of_birth ?? '' }}">
                <input type="hidden" name="gender" value="{{ $patient->gender ?? '' }}">
                <input type="hidden" name="address" value="{{ $patient->address ?? '' }}">

                <div>
                    <label class="label">Nama Kontak Darurat</label>
                    <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name', $patient->emergency_contact_name ?? '') }}" class="input" placeholder="Nama keluarga / teman">
                </div>

                <div class="mt-4">
                    <label class="label">Telepon Kontak Darurat</label>
                    <input type="text" name="emergency_contact_phone" value="{{ old('emergency_contact_phone', $patient->emergency_contact_phone ?? '') }}" class="input" placeholder="Nomor telepon">
                </div>

                <div class="mt-5 pt-4 border-t" style="border-color: var(--border);">
                    <button type="submit" class="btn btn-gold" style="width: 100%; justify-content: center;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Simpan Kontak Darurat
                    </button>
                </div>
            </form>
        </div>

        <div class="card p-6">
            <div class="flex items-center gap-3 mb-6">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#8e8ea0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                <h2 style="font-size: 16px; font-weight: 600; color: var(--text-heading); font-family: 'Poppins', sans-serif;">Ubah Password</h2>
            </div>

            <form method="POST" action="{{ route('profile.password') }}">
                @csrf
                @method('PUT')

                <div>
                    <label class="label">Password Lama</label>
                    <input type="password" name="current_password" required class="input" placeholder="Password saat ini">
                </div>

                <div class="mt-4">
                    <label class="label">Password Baru</label>
                    <input type="password" name="password" required class="input" placeholder="Minimal 8 karakter">
                </div>

                <div class="mt-4">
                    <label class="label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required class="input" placeholder="Ulangi password baru">
                </div>

                <div class="mt-5 pt-4 border-t" style="border-color: var(--border);">
                    <button type="submit" class="btn btn-outline" style="width: 100%; justify-content: center;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg>
                        Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endSection
