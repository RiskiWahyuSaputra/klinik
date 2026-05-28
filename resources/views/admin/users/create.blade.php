@extends('layouts.admin')

@section('title', 'Tambah Pengguna')

@section('breadcrumb', 'Admin / Pengguna / Tambah')

@section('content')
<div class="page-header">
    <h1 class="page-title">Tambah Pengguna Baru</h1>
    <a href="{{ route('admin.users') }}" class="btn-secondary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Kembali
    </a>
</div>

<div class="admin-card" style="max-width: 600px; padding: 28px 32px;">
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div style="margin-bottom: 18px;">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                class="form-input @error('name') error @enderror"
                placeholder="Nama lengkap">
            @error('name') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom: 18px;">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="form-input @error('email') error @enderror"
                placeholder="nama@email.com">
            @error('email') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom: 18px;">
            <label class="form-label">Nomor Telepon</label>
            <input type="text" name="phone" value="{{ old('phone') }}" required
                class="form-input @error('phone') error @enderror"
                placeholder="08123456789">
            @error('phone') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom: 18px;">
            <label class="form-label">Password</label>
            <input type="password" name="password" required
                class="form-input @error('password') error @enderror"
                placeholder="Minimal 8 karakter">
            @error('password') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom: 18px;">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required
                class="form-input"
                placeholder="Ulangi password">
        </div>

        <div style="margin-bottom: 18px;">
            <label class="form-label">Role</label>
            <select name="role" required
                class="form-input form-select @error('role') error @enderror">
                <option value="">Pilih Role</option>
                <option value="admin" @selected(old('role') == 'admin')>Admin</option>
                <option value="doctor" @selected(old('role') == 'doctor')>Dokter</option>
                <option value="staff" @selected(old('role') == 'staff')>Staff</option>
                <option value="patient" @selected(old('role') == 'patient')>Pasien</option>
            </select>
            @error('role') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                <input type="checkbox" name="is_active" value="1" checked
                    style="width: 16px; height: 16px; border-radius: 4px; accent-color: #FF69B4;">
                <span style="font-size: 13px; font-weight: 500; color: #4a4a6a;">Akun Aktif</span>
            </label>
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center; padding: 12px 22px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                <polyline points="7 3 7 8 15 8"></polyline>
            </svg>
            Tambah Pengguna
        </button>
    </form>
</div>
@endsection
