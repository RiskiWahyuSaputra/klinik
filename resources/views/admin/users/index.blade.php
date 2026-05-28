@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold font-[Poppins] text-gray-800">Kelola Pengguna</h1>
        <a href="{{ route('admin.users.create') }}" class="text-white px-5 py-3 rounded-xl font-medium transition shadow-md hover:shadow-lg" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
            + Tambah Pengguna
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-500 border-b border-gray-100">
                        <th class="px-6 py-4 font-medium">Nama</th>
                        <th class="px-6 py-4 font-medium">Email</th>
                        <th class="px-6 py-4 font-medium">Role</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="border-b border-gray-50 hover:bg-pink-50/50 transition">
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($user->role == 'admin') bg-yellow-100 text-yellow-700
                                @elseif($user->role == 'doctor') bg-purple-100 text-purple-700
                                @elseif($user->role == 'staff') bg-green-100 text-green-700
                                @else bg-blue-100 text-blue-700
                                @endif">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $user->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}">
                                    @csrf @method('PUT')
                                    <button type="submit" class="text-sm font-medium px-3 py-1 rounded-lg {{ $user->is_active ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }} transition">
                                        {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <p class="text-4xl mb-4">👥</p>
                            <p>Tidak ada pengguna.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection