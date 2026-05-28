@extends('layouts.app')

@section('title', 'Kelola Artikel')

@section('content')
<div class="py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold font-[Poppins] text-gray-800">Kelola Artikel</h1>
        <a href="{{ route('admin.articles.create') }}" class="text-white px-5 py-3 rounded-xl font-medium transition shadow-md hover:shadow-lg" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
            + Tambah Artikel
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-500 border-b border-gray-100">
                        <th class="px-6 py-4 font-medium">Judul</th>
                        <th class="px-6 py-4 font-medium">Kategori</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium">Tanggal</th>
                        <th class="px-6 py-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                    <tr class="border-b border-gray-50 hover:bg-pink-50/50 transition">
                        <td class="px-6 py-4 text-sm font-medium text-gray-800 max-w-xs truncate">{{ $article->title }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $article->category ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $article->is_published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ $article->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $article->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.articles.edit', $article) }}" class="text-sm font-medium hover:underline text-blue-500">Edit</a>
                                <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" onsubmit="return confirm('Hapus artikel ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-sm text-red-500 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <p class="text-4xl mb-4">📝</p>
                            <p>Belum ada artikel.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $articles->links() }}
    </div>
</div>
@endsection