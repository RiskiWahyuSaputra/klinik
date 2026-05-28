@extends('layouts.app')

@section('title', 'Layanan')

@section('content')
<div class="py-8">
    <div class="rounded-2xl p-8 mb-8 text-white" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
        <h1 class="text-3xl font-bold font-[Poppins]">Layanan Kami</h1>
        <p class="mt-2 text-white/80">Berbagai layanan kesehatan berkualitas untuk Anda dan keluarga</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($services as $service)
        <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition border border-gray-100">
            <div class="w-14 h-14 rounded-xl flex items-center justify-center text-2xl mb-4" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">
                🩺
            </div>
            <h3 class="text-xl font-semibold text-gray-800">{{ $service->name }}</h3>
            <p class="text-gray-500 mt-2 text-sm">{{ Str::limit($service->description, 120) }}</p>
            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                <span class="font-bold text-lg" style="color: #D4AF37;">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                <span class="text-sm text-gray-400">{{ $service->duration }} menit</span>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-gray-400">
            <p class="text-4xl mb-4">📋</p>
            <p>Belum ada layanan tersedia.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $services->links() }}
    </div>
</div>
@endsection