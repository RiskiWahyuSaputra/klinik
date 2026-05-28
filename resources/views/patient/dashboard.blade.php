@extends('layouts.app')

@section('title', 'Patient Dashboard')

@section('content')
<div class="py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold font-[Poppins] text-gray-800">Halo, {{ auth()->user()->name }}!</h1>
        <p class="text-gray-500 mt-1">Selamat datang di Klinik Mon Cheri</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Appointment</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $appointmentCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">
                    📅
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Selesai</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ $completedCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background: #d4edda;">
                    ✅
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Menunggu</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $pendingCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background: #fff3cd;">
                    ⏳
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-xl font-semibold text-gray-800">Appointment Mendatang</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-500 border-b border-gray-100">
                        <th class="px-6 py-4 font-medium">No. Appointment</th>
                        <th class="px-6 py-4 font-medium">Tanggal</th>
                        <th class="px-6 py-4 font-medium">Jam</th>
                        <th class="px-6 py-4 font-medium">Dokter</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($upcomingAppointments as $appointment)
                    <tr class="border-b border-gray-50 hover:bg-pink-50/50 transition">
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">#{{ $appointment->appointment_number }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $appointment->appointment_date->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $appointment->appointment_time->format('H:i') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">dr. {{ $appointment->doctor->user->name }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($appointment->status == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($appointment->status == 'confirmed') bg-blue-100 text-blue-700
                                @elseif($appointment->status == 'checked_in') bg-indigo-100 text-indigo-700
                                @elseif($appointment->status == 'in_progress') bg-purple-100 text-purple-700
                                @elseif($appointment->status == 'completed') bg-green-100 text-green-700
                                @elseif($appointment->status == 'cancelled') bg-red-100 text-red-700
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('appointments.show', $appointment) }}" class="text-sm font-medium hover:underline" style="color: #D4AF37;">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <p class="text-4xl mb-4">📅</p>
                            <p>Belum ada appointment.</p>
                            <a href="{{ route('appointments.create') }}" class="inline-block mt-4 text-white px-6 py-2 rounded-lg font-medium transition shadow" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                                Buat Appointment
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection