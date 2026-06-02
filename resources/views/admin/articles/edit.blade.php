@extends('layouts.admin')

@section('title', 'Edit Artikel')

@section('breadcrumb', 'Admin / Artikel / Edit')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Artikel</h1>
    <a href="{{ route('admin.articles') }}" class="btn-secondary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Kembali
    </a>
</div>

<div class="admin-card" style="max-width: 720px; padding: 28px 32px;">
    <form method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 18px;">
            <label class="form-label">Judul Artikel</label>
            <input type="text" name="title" value="{{ old('title', $article->title) }}" required
                class="form-input @error('title') error @enderror"
                placeholder="Judul artikel">
            @error('title') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom: 18px;">
            <label class="form-label">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $article->slug) }}"
                class="form-input @error('slug') error @enderror"
                placeholder="judul-artikel">
            @error('slug') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom: 18px;">
            <label class="form-label">Kategori</label>
            <input type="text" name="category" value="{{ old('category', $article->category) }}"
                class="form-input"
                placeholder="Contoh: Kesehatan, Tips">
        </div>

        <div style="margin-bottom: 18px;">
            <label class="form-label">Gambar Featured</label>
            @if($article->featured_image)
            <div style="margin-bottom: 8px; display: flex; align-items: center; gap: 12px;">
                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}"
                    style="width: 80px; height: 60px; border-radius: 8px; object-fit: cover; border: 1px solid #eef0f5;">
                <span style="font-size: 12px; color: #8e8ea0;">{{ basename($article->featured_image) }}</span>
            </div>
            @endif
            <input type="file" name="featured_image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                class="form-input @error('featured_image') error @enderror"
                style="padding: 10px 16px;">
            <p style="font-size: 11px; color: #8e8ea0; margin-top: 4px;">Format: JPEG, PNG, JPG, GIF, WebP. Maks: 2MB. Biarkan kosong jika tidak ingin mengganti.</p>
            @error('featured_image') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom: 18px;">
            <label class="form-label">Excerpt / Ringkasan</label>
            <textarea name="excerpt" rows="3"
                class="form-input @error('excerpt') error @enderror"
                placeholder="Ringkasan artikel">{{ old('excerpt', $article->excerpt) }}</textarea>
            @error('excerpt') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom: 18px;">
            <label class="form-label">Konten</label>
            <textarea name="content" rows="12" required
                class="form-input @error('content') error @enderror"
                placeholder="Tulis konten artikel di sini..."
                style="min-height: 250px;">{{ old('content', $article->content) }}</textarea>
            @error('content') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                <input type="checkbox" name="is_published" value="1" @checked($article->is_published)
                    style="width: 16px; height: 16px; border-radius: 4px; accent-color: #FF69B4;">
                <span style="font-size: 13px; font-weight: 500; color: #4a4a6a;">Publikasikan</span>
            </label>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 12px;">
            <a href="{{ route('admin.articles') }}" class="btn-secondary">Batal</a>
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
