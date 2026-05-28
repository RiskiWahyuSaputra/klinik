@extends('layouts.app')

@section('title', 'Tambah Layanan')

@section('content')
<div class="py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold font-[Poppins] text-gray-800 mb-8">Tambah Layanan Baru</h1>

        <div class="bg-white rounded-2xl shadow-md p-8">
            <form method="POST" action="{{ route('admin.services.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Nama Layanan</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('name') border-red-300 @enderror"
                        placeholder="Nama layanan">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Deskripsi</label>
                    <textarea name="description" rows="4"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition resize-none @error('description') border-red-300 @enderror"
                        placeholder="Deskripsi layanan">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Kategori</label>
                    <select name="category" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('category') border-red-300 @enderror">
                        <option value="">Pilih Kategori</option>
                        <option value="general" @selected(old('category') == 'general')>Umum</option>
                        <option value="dental" @selected(old('category') == 'dental')>Gigi</option>
                        <option value="pediatric" @selected(old('category') == 'pediatric')>Anak</option>
                        <option value="skin" @selected(old('category') == 'skin')>Kulit</option>
                        <option value="other" @selected(old('category') == 'other')>Lainnya</option>
                    </select>
                    @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Harga (Rp)</label>
                        <input type="number" name="price" value="{{ old('price') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('price') border-red-300 @enderror"
                            placeholder="0">
                        @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Durasi (menit)</label>
                        <input type="number" name="duration" value="{{ old('duration', 30) }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('duration') border-red-300 @enderror"
                            placeholder="30">
                        @error('duration') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="is_active" value="1" checked
                            class="w-4 h-4 rounded border-gray-300 text-pink-500 focus:ring-pink-300">
                        <span class="text-gray-700 text-sm font-medium">Layanan Aktif</span>
                    </label>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="text-white px-8 py-3 rounded-xl font-semibold transition shadow-md hover:shadow-lg"
                        style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                        Tambah Layanan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection