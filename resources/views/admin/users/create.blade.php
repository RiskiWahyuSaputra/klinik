@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold font-[Poppins] text-gray-800 mb-8">Tambah Pengguna Baru</h1>

        <div class="bg-white rounded-2xl shadow-md p-8">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('name') border-red-300 @enderror"
                        placeholder="Nama lengkap">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('email') border-red-300 @enderror"
                        placeholder="nama@email.com">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('phone') border-red-300 @enderror"
                        placeholder="08123456789">
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('password') border-red-300 @enderror"
                        placeholder="Minimal 8 karakter">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition"
                        placeholder="Ulangi password">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Role</label>
                    <select name="role" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('role') border-red-300 @enderror">
                        <option value="">Pilih Role</option>
                        <option value="admin" @selected(old('role') == 'admin')>Admin</option>
                        <option value="doctor" @selected(old('role') == 'doctor')>Dokter</option>
                        <option value="staff" @selected(old('role') == 'staff')>Staff</option>
                        <option value="patient" @selected(old('role') == 'patient')>Pasien</option>
                    </select>
                    @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="is_active" value="1" checked
                            class="w-4 h-4 rounded border-gray-300 text-pink-500 focus:ring-pink-300">
                        <span class="text-gray-700 text-sm font-medium">Akun Aktif</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full text-white py-3 rounded-xl font-semibold transition shadow-md hover:shadow-lg"
                    style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                    Tambah Pengguna
                </button>
            </form>
        </div>
    </div>
</div>
@endsection