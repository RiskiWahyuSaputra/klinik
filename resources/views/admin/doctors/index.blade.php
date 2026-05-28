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
                            <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn-sm btn-secondary" style="font-size: 11px; padding: 5px 12px;">Edit</a>
                            <a href="{{ route('admin.schedules', $doctor) }}" class="btn-sm btn-secondary" style="font-size: 11px; padding: 5px 12px; color: #D4AF37;">Jadwal</a>
                            <form method="POST" action="{{ route('admin.doctors.destroy', $doctor) }}" onsubmit="return confirm('Hapus dokter ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-danger" style="font-size: 11px;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 48px 20px; color: #8e8ea0;">
                        <p style="font-size: 36px; margin-bottom: 12px;">👨‍⚕️</p>
                        <p>Belum ada dokter.</p>
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
