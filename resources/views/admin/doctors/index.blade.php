@extends('layouts.admin')

@section('title', 'Kelola Dokter')

@section('breadcrumb', 'Admin / Dokter')

@section('content')
<div class="page-header">
    <h1 class="page-title">Kelola Dokter</h1>
    <a href="{{ route('admin.doctors.create') }}" class="btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        Tambah Dokter
    </a>
</div>

<div class="admin-card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Spesialisasi</th>
                    <th>Telepon</th>
                    <th>Pengalaman</th>
                    <th>Layanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($doctors as $doctor)
                <tr>
                    <td data-label="Nama" style="font-weight: 600; color: #1a1a2e;">dr. {{ $doctor->user->name }}</td>
                    <td data-label="Spesialisasi">{{ $doctor->specialization ?? 'Dokter Umum' }}</td>
                    <td data-label="Telepon">{{ $doctor->user->phone ?? '-' }}</td>
                    <td data-label="Pengalaman">{{ $doctor->experience_years ?? 0 }} tahun</td>
                    <td data-label="Layanan" style="max-width: 160px; white-space: normal;">{{ $doctor->services->pluck('name')->implode(', ') ?: '-' }}</td>
                    <td data-label="Aksi">
                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                            <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn-sm btn-secondary">Edit</a>
                            <a href="{{ route('admin.schedules', $doctor) }}" class="btn-sm btn-secondary" style="color: #D4AF37;">Jadwal</a>
                            <form method="POST" action="{{ route('admin.doctors.destroy', $doctor) }}" onsubmit="return confirm('Hapus dokter ini?')">
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
                                    <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
                                </svg>
                            </div>
                            <p class="empty-state-title">Belum ada dokter</p>
                            <p class="empty-state-desc">Tambah dokter baru untuk mulai mengelola jadwal.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="pagination-wrap">
    {{ $doctors->links() }}
</div>
@endsection
