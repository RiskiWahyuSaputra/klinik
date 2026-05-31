@extends('layouts.admin')

@section('title', 'Kelola Pengguna')

@section('breadcrumb', 'Admin / Pengguna')

@section('content')
<div class="page-header">
    <h1 class="page-title">Kelola Pengguna</h1>
    <a href="{{ route('admin.users.create') }}" class="btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        Tambah Pengguna
    </a>
</div>

<div class="admin-card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td data-label="Nama" style="font-weight: 600; color: #1a1a2e;">{{ $user->name }}</td>
                    <td data-label="Email">{{ $user->email }}</td>
                    <td data-label="Role">
                        <span class="badge
                            @if($user->role == 'admin') badge-yellow
                            @elseif($user->role == 'doctor') badge-purple
                            @elseif($user->role == 'staff') badge-green
                            @else badge-blue
                            @endif">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td data-label="Status">
                        <span class="badge {{ $user->is_active ? 'badge-green' : 'badge-red' }}">
                            {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td data-label="Aksi">
                        <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}">
                            @csrf @method('PUT')
                            <button type="submit" class="btn-sm {{ $user->is_active ? 'btn-danger' : 'btn-primary' }}">
                                {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                            <p class="empty-state-title">Tidak ada pengguna</p>
                            <p class="empty-state-desc">Belum ada pengguna yang terdaftar.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="pagination-wrap">
    {{ $users->links() }}
</div>
@endsection
