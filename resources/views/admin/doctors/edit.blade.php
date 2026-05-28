@extends('layouts.admin')

@section('title', 'Edit Dokter')

@section('breadcrumb', 'Admin / Dokter / Edit')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Dokter</h1>
    <a href="{{ route('admin.doctors') }}" class="btn-secondary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Kembali
    </a>
</div>

<div class="admin-card" style="max-width: 720px; padding: 28px 32px;">
    <form method="POST" action="{{ route('admin.doctors.update', $doctor) }}">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px;">
            <div style="grid-column: 1 / -1;">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $doctor->user->name) }}" required
                    class="form-input @error('name') error @enderror">
                @error('name') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $doctor->user->email) }}" required
                    class="form-input @error('email') error @enderror">
                @error('email') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $doctor->user->phone) }}"
                    class="form-input">
            </div>

            <div>
                <label class="form-label">Spesialisasi</label>
                <input type="text" name="specialization" value="{{ old('specialization', $doctor->specialization) }}"
                    class="form-input"
                    placeholder="Contoh: Dokter Umum, Spesialis Anak">
            </div>

            <div>
                <label class="form-label">Biaya Konsultasi</label>
                <input type="number" name="consultation_fee" value="{{ old('consultation_fee', $doctor->consultation_fee) }}"
                    class="form-input">
            </div>

            <div style="grid-column: 1 / -1;">
                <label class="form-label">Layanan</label>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 8px;">
                    @foreach($services as $service)
                    <label style="display: flex; align-items: center; gap: 8px; padding: 10px 12px; border-radius: 10px; border: 1px solid #eef0f5; cursor: pointer; transition: all 0.15s ease; font-size: 13px; color: #4a4a6a;" onmouseover="this.style.background='#f8f9fc'" onmouseout="this.style.background='transparent'">
                        <input type="checkbox" name="services[]" value="{{ $service->id }}"
                            style="width: 16px; height: 16px; border-radius: 4px; accent-color: #FF69B4;"
                            @checked(in_array($service->id, old('services', $doctor->services->pluck('id')->toArray())))>
                        {{ $service->name }}
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 12px;">
            <a href="{{ route('admin.doctors') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                    <polyline points="7 3 7 8 15 8"></polyline>
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
