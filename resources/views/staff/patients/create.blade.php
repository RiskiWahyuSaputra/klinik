@extends('layouts.app')

@section('title', 'Registrasi Pasien Baru')

@section('content')
<div class="py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold font-[Poppins] text-gray-800 mb-8">Registrasi Pasien Baru</h1>

        <div class="bg-white rounded-2xl shadow-md p-8">
            <form method="POST" action="{{ route('staff.patients.store') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('name') border-red-300 @enderror"
                            placeholder="Nama pasien">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('email') border-red-300 @enderror"
                            placeholder="pasien@email.com">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('phone') border-red-300 @enderror"
                            placeholder="08123456789">
                        @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('password') border-red-300 @enderror"
                            placeholder="Minimal 8 karakter">
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition"
                            placeholder="Ulangi password">
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Tanggal Lahir</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Jenis Kelamin</label>
                        <select name="gender"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            <option value="">Pilih</option>
                            <option value="male" @selected(old('gender') == 'male')>Laki-laki</option>
                            <option value="female" @selected(old('gender') == 'female')>Perempuan</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Alamat</label>
                        <textarea name="address" rows="3"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition resize-none">{{ old('address') }}</textarea>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit"
                        class="text-white px-8 py-3 rounded-xl font-semibold transition shadow-md hover:shadow-lg"
                        style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                        Daftarkan Pasien
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection