@extends('layouts.admin')

@section('title', 'Kelola Artikel')

@section('breadcrumb', 'Admin / Artikel')

@section('content')
<div class="page-header">
    <h1 class="page-title">Kelola Artikel</h1>
    <a href="{{ route('admin.articles.create') }}" class="btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        Tambah Artikel
    </a>
</div>

<div class="admin-card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                <tr>
                    <td data-label="Gambar">
                        @if($article->featured_image)
                        <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}"
                            style="width: 48px; height: 36px; border-radius: 6px; object-fit: cover; display: block;">
                        @else
                        <div style="width: 48px; height: 36px; border-radius: 6px; background: #f3f4f6; display: flex; align-items: center; justify-content: center;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        </div>
                        @endif
                    </td>
                    <td data-label="Judul" style="font-weight: 600; color: #1a1a2e; max-width: 250px; white-space: normal;">{{ $article->title }}</td>
                    <td data-label="Kategori">{{ $article->category ?? '-' }}</td>
                    <td data-label="Status">
                        <span class="badge {{ $article->is_published ? 'badge-green' : 'badge-gray' }}">
                            {{ $article->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td data-label="Tanggal">{{ $article->created_at->format('d M Y') }}</td>
                    <td data-label="Aksi">
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.articles.edit', $article) }}" class="btn-sm btn-secondary">Edit</a>
                            <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" onsubmit="return confirm('Hapus artikel ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                </svg>
                            </div>
                            <p class="empty-state-title">Belum ada artikel</p>
                            <p class="empty-state-desc">Buat artikel baru untuk informasi kesehatan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="pagination-wrap">
    {{ $articles->links() }}
</div>
@endsection
