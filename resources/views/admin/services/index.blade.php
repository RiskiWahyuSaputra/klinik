@extends('layouts.admin')

@section('title', 'Kelola Layanan')

@section('breadcrumb', 'Admin / Layanan')

@section('content')
<div class="page-header">
    <h1 class="page-title">Kelola Layanan</h1>
    <a href="{{ route('admin.services.create') }}" class="btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        Tambah Layanan
    </a>
</div>

<div class="admin-card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama Layanan</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Durasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td data-label="Nama Layanan" style="font-weight: 600; color: #1a1a2e;">{{ $service->name }}</td>
                    <td data-label="Deskripsi" style="max-width: 200px; white-space: normal;">{{ $service->description ?? '-' }}</td>
                    <td data-label="Harga" style="font-weight: 600; color: #D4AF37;">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                    <td data-label="Durasi">{{ $service->duration }} menit</td>
                    <td data-label="Aksi">
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn-sm btn-secondary" style="font-size: 11px; padding: 5px 12px;">Edit</a>
                            <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Hapus layanan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-danger" style="font-size: 11px;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 48px 20px; color: #8e8ea0;">
                        <p style="font-size: 36px; margin-bottom: 12px;">🩺</p>
                        <p>Belum ada layanan.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="pagination-wrap">
    {{ $services->links() }}
</div>
@endsection
