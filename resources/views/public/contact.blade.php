@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
<div class="py-8">
    <div class="rounded-2xl p-8 mb-8 text-white" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
        <h1 class="text-3xl font-bold font-[Poppins]">Hubungi Kami</h1>
        <p class="mt-2 text-white/80">Kami siap membantu Anda</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="space-y-6">
            <div class="bg-white rounded-2xl p-6 shadow-md">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Kontak</h3>
                <div class="space-y-4">
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">
                            <span>📍</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Alamat</p>
                            <p class="text-gray-500 text-sm">Jl. Contoh No. 123, Bandung, Jawa Barat 40123</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">
                            <span>📞</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Telepon</p>
                            <p class="text-gray-500 text-sm">(022) 1234-5678</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">
                            <span>📧</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Email</p>
                            <p class="text-gray-500 text-sm">info@moncheri-klinik.id</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">
                            <span>🕐</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Jam Operasional</p>
                            <p class="text-gray-500 text-sm">Senin - Sabtu: 08:00 - 20:00</p>
                            <p class="text-gray-500 text-sm">Minggu: 09:00 - 15:00</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-md">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Lokasi</h3>
                <div class="bg-gray-100 rounded-xl h-64 flex items-center justify-center text-gray-400">
                    <div class="text-center">
                        <span class="text-4xl">🗺️</span>
                        <p class="mt-2">Peta akan ditampilkan di sini</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-8 shadow-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Kirim Pesan</h3>
            <form method="POST" action="#" onsubmit="alert('Fitur kirim pesan akan segera tersedia!'); return false;">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition"
                        placeholder="Nama Anda">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition"
                        placeholder="nama@email.com">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Subjek</label>
                    <input type="text" name="subject" value="{{ old('subject') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition"
                        placeholder="Subjek pesan">
                    @error('subject') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Pesan</label>
                    <textarea name="message" rows="5" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition resize-none"
                        placeholder="Tulis pesan Anda...">{{ old('message') }}</textarea>
                    @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit"
                    class="w-full text-white py-3 rounded-xl font-semibold transition shadow-md hover:shadow-lg"
                    style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection