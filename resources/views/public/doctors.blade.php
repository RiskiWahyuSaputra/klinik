@extends('layouts.app')

@section('title', 'Dokter')

@section('content')
<div class="py-8">
    <div class="rounded-2xl p-8 mb-8 text-white" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
        <h1 class="text-3xl font-bold font-[Poppins]">Tim Dokter Kami</h1>
        <p class="mt-2 text-white/80">Dokter profesional dan berpengalaman siap melayani Anda</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($doctors as $doctor)
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6 text-center border border-gray-100">
            <div class="w-24 h-24 rounded-full mx-auto flex items-center justify-center text-4xl mb-4" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">
                👨‍⚕️
            </div>
            <h3 class="font-semibold text-gray-800 text-lg">dr. {{ $doctor->user->name }}</h3>
            <p class="text-sm" style="color: #D4AF37;">{{ $doctor->specialization ?? 'Dokter Umum' }}</p>
            <p class="text-xs text-gray-400 mt-2">{{ $doctor->experience_years ?? 0 }} tahun pengalaman</p>
            <p class="text-xs text-gray-400 mt-1">{{ $doctor->user->phone ?? '-' }}</p>
            <a href="{{ route('appointments.create', ['doctor_id' => $doctor->id]) }}"
               class="inline-block mt-4 text-white px-5 py-2 rounded-lg text-sm font-medium transition shadow"
               style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                Buat Appointment
            </a>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-gray-400">
            <p class="text-4xl mb-4">👨‍⚕️</p>
            <p>Belum ada dokter tersedia.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $doctors->links() }}
    </div>
</div>
@endsection