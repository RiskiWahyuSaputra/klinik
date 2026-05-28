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
                            <a href="{{ route('admin.articles.edit', $article) }}" class="btn-sm btn-secondary" style="font-size: 11px; padding: 5px 12px;">Edit</a>
                            <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" onsubmit="return confirm('Hapus artikel ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-danger" style="font-size: 11px;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 48px 20px; color: #8e8ea0;">
                        <p style="font-size: 36px; margin-bottom: 12px;">📝</p>
                        <p>Belum ada artikel.</p>
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
