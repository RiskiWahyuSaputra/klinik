@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('public.articles') }}" class="inline-flex items-center text-gray-500 hover:text-pink-500 transition mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Artikel
        </a>

        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="h-64 flex items-center justify-center overflow-hidden" style="background: linear-gradient(135deg, #FFF8DC, #FFB6C1);">
                @if($article->featured_image)
                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}"
                    class="w-full h-full object-cover">
                @else
                <span class="text-6xl">📝</span>
                @endif
            </div>
            <div class="p-8">
                <div class="flex items-center space-x-3 text-sm text-gray-400 mb-4">
                    <span>{{ $article->created_at->format('d M Y') }}</span>
                    @if($article->category)
                        <span>•</span>
                        <span class="px-2 py-1 rounded-full text-xs" style="background: #FFF8DC; color: #D4AF37;">{{ $article->category }}</span>
                    @endif
                </div>

                <h1 class="text-3xl font-bold font-[Poppins] text-gray-800 mb-6">{{ $article->title }}</h1>

                <div class="prose prose-gray max-w-none">
                    {!! $article->content !!}
                </div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('public.articles') }}" class="inline-block text-white px-8 py-3 rounded-xl font-semibold transition shadow-md hover:shadow-lg" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                Artikel Lainnya
            </a>
        </div>
    </div>
</div>
@endsection