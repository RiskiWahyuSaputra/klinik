@extends('layouts.app')

@section('title', 'Edit Artikel')

@section('content')
<div class="py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold font-[Poppins] text-gray-800 mb-8">Edit Artikel</h1>

        <div class="bg-white rounded-2xl shadow-md p-8">
            <form method="POST" action="{{ route('admin.articles.update', $article) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Judul Artikel</label>
                    <input type="text" name="title" value="{{ old('title', $article->title) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('title') border-red-300 @enderror"
                        placeholder="Judul artikel">
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $article->slug) }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('slug') border-red-300 @enderror"
                        placeholder="judul-artikel">
                    @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Kategori</label>
                    <input type="text" name="category" value="{{ old('category', $article->category) }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition"
                        placeholder="Contoh: Kesehatan, Tips">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Excerpt / Ringkasan</label>
                    <textarea name="excerpt" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition resize-none @error('excerpt') border-red-300 @enderror"
                        placeholder="Ringkasan artikel">{{ old('excerpt', $article->excerpt) }}</textarea>
                    @error('excerpt') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Konten</label>
                    <textarea name="content" rows="12" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition resize-y @error('content') border-red-300 @enderror"
                        placeholder="Tulis konten artikel di sini...">{{ old('content', $article->content) }}</textarea>
                    @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="is_published" value="1" @checked($article->is_published)
                            class="w-4 h-4 rounded border-gray-300 text-pink-500 focus:ring-pink-300">
                        <span class="text-gray-700 text-sm font-medium">Publikasikan</span>
                    </label>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.articles') }}" class="px-6 py-3 rounded-xl font-medium border border-gray-200 text-gray-600 hover:bg-gray-50 transition">Batal</a>
                    <button type="submit"
                        class="text-white px-8 py-3 rounded-xl font-semibold transition shadow-md hover:shadow-lg"
                        style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection