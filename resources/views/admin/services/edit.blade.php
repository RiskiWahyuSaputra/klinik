@extends('layouts.admin')

@section('title', 'Edit Layanan')

@section('breadcrumb', 'Admin / Layanan / Edit')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Layanan</h1>
    <a href="{{ route('admin.services') }}" class="btn-secondary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Kembali
    </a>
</div>

<div class="admin-card" style="max-width: 600px; padding: 28px 32px;">
    <form method="POST" action="{{ route('admin.services.update', $service) }}">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 18px;">
            <label class="form-label">Nama Layanan</label>
            <input type="text" name="name" value="{{ old('name', $service->name) }}" required
                class="form-input @error('name') error @enderror"
                placeholder="Nama layanan">
            @error('name') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom: 18px;">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" rows="4"
                class="form-input @error('description') error @enderror"
                placeholder="Deskripsi layanan">{{ old('description', $service->description) }}</textarea>
            @error('description') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom: 18px;">
            <label class="form-label">Kategori</label>
            <select name="category" required
                class="form-input form-select @error('category') error @enderror">
                <option value="">Pilih Kategori</option>
                <option value="general" @selected(old('category', $service->category) == 'general')>Umum</option>
                <option value="dental" @selected(old('category', $service->category) == 'dental')>Gigi</option>
                <option value="pediatric" @selected(old('category', $service->category) == 'pediatric')>Anak</option>
                <option value="skin" @selected(old('category', $service->category) == 'skin')>Kulit</option>
                <option value="other" @selected(old('category', $service->category) == 'other')>Lainnya</option>
            </select>
            @error('category') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 18px;">
            <div>
                <label class="form-label">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $service->price) }}" required
                    class="form-input @error('price') error @enderror"
                    placeholder="0">
                @error('price') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Durasi (menit)</label>
                <input type="number" name="duration" value="{{ old('duration', $service->duration) }}" required
                    class="form-input @error('duration') error @enderror"
                    placeholder="30">
                @error('duration') <p class="form-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $service->is_active))
                    style="width: 16px; height: 16px; border-radius: 4px; accent-color: #FF69B4;">
                <span style="font-size: 13px; font-weight: 500; color: #4a4a6a;">Layanan Aktif</span>
            </label>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 12px;">
            <a href="{{ route('admin.services') }}" class="btn-secondary">Batal</a>
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
