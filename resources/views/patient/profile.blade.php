@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="py-8">
    <h1 class="text-3xl font-bold font-[Poppins] text-gray-800 mb-8">Profil Saya</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Data Pribadi</h2>

            <form method="POST" action="{{ route('patient.profile.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('name') border-red-300 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('email') border-red-300 @enderror">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $patient->phone ?? $user->phone) }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('phone') border-red-300 @enderror">
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Tanggal Lahir</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $patient->date_of_birth ?? '') }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Jenis Kelamin</label>
                    <select name="gender"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
                        <option value="">Pilih</option>
                        <option value="male" @selected(old('gender', $patient->gender ?? '') == 'male')>Laki-laki</option>
                        <option value="female" @selected(old('gender', $patient->gender ?? '') == 'female')>Perempuan</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Alamat</label>
                    <textarea name="address" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition resize-none">{{ old('address', $patient->address ?? '') }}</textarea>
                </div>

                <button type="submit"
                    class="text-white px-6 py-3 rounded-xl font-medium transition shadow-md hover:shadow-lg"
                    style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                    Simpan Perubahan
                </button>
            </form>
        </div>

        <div class="space-y-8">
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Kontak Darurat</h2>

                <form method="POST" action="{{ route('patient.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Nama Kontak Darurat</label>
                        <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name', $patient->emergency_contact_name ?? '') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Telepon Kontak Darurat</label>
                        <input type="text" name="emergency_contact_phone" value="{{ old('emergency_contact_phone', $patient->emergency_contact_phone ?? '') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
                    </div>

                    <button type="submit"
                        class="text-white px-6 py-3 rounded-xl font-medium transition shadow-md hover:shadow-lg"
                        style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                        Simpan
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Ubah Password</h2>

                <form method="POST" action="{{ route('profile.password') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Password Lama</label>
                        <input type="password" name="current_password" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Password Baru</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
                    </div>

                    <button type="submit"
                        class="text-white px-6 py-3 rounded-xl font-medium transition shadow-md hover:shadow-lg"
                        style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                        Ubah Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection