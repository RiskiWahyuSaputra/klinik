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
                            <button type="submit" class="btn-sm {{ $user->is_active ? 'btn-danger' : 'btn-primary' }}" style="font-size: 11px;">
                                {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 48px 20px; color: #8e8ea0;">
                        <p style="font-size: 36px; margin-bottom: 12px;">👥</p>
                        <p>Tidak ada pengguna.</p>
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
