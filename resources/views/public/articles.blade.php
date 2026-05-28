@extends('layouts.app')

@section('title', 'Artikel')

@section('content')
<div class="py-8">
    <div class="rounded-2xl p-8 mb-8 text-white" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
        <h1 class="text-3xl font-bold font-[Poppins]">Artikel Kesehatan</h1>
        <p class="mt-2 text-white/80">Tips dan informasi kesehatan terbaru untuk Anda</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($articles as $article)
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden border border-gray-100">
            <div class="h-48 flex items-center justify-center text-4xl" style="background: linear-gradient(135deg, #FFF8DC, #FFB6C1);">
                📝
            </div>
            <div class="p-6">
                <div class="flex items-center space-x-2 text-xs text-gray-400 mb-2">
                    <span>{{ $article->created_at->format('d M Y') }}</span>
                    @if($article->category)
                        <span>•</span>
                        <span style="color: #D4AF37;">{{ $article->category }}</span>
                    @endif
                </div>
                <h3 class="font-semibold text-gray-800 text-lg">{{ $article->title }}</h3>
                <p class="text-gray-500 text-sm mt-2">{{ Str::limit($article->excerpt ?? strip_tags($article->content), 120) }}</p>
                <a href="{{ route('public.article', $article->slug) }}" class="inline-block mt-4 font-semibold hover:underline text-sm" style="color: #D4AF37;">
                    Baca Selengkapnya →
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-gray-400">
            <p class="text-4xl mb-4">📝</p>
            <p>Belum ada artikel tersedia.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $articles->links() }}
    </div>
</div>
@endsection