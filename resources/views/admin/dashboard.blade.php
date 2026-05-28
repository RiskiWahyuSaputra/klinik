@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="py-8">
    <h1 class="text-3xl font-bold font-[Poppins] text-gray-800 mb-8">Dashboard Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Pasien</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalPatients }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">👤</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Dokter</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalDoctors }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">👨‍⚕️</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Appointment</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalAppointments }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">📅</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Hari Ini</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $todayAppointments }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">📊</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800">Appointment Terbaru</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-sm text-gray-500 border-b border-gray-100">
                                <th class="px-6 py-4 font-medium">Pasien</th>
                                <th class="px-6 py-4 font-medium">Dokter</th>
                                <th class="px-6 py-4 font-medium">Tanggal</th>
                                <th class="px-6 py-4 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentAppointments as $appointment)
                            <tr class="border-b border-gray-50 hover:bg-pink-50/50 transition">
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $appointment->patient->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">dr. {{ $appointment->doctor->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $appointment->appointment_date->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium
                                        @if($appointment->status == 'pending') bg-yellow-100 text-yellow-700
                                        @elseif($appointment->status == 'confirmed') bg-blue-100 text-blue-700
                                        @elseif($appointment->status == 'checked_in') bg-indigo-100 text-indigo-700
                                        @elseif($appointment->status == 'in_progress') bg-purple-100 text-purple-700
                                        @elseif($appointment->status == 'completed') bg-green-100 text-green-700
                                        @else bg-red-100 text-red-700
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-400">Belum ada appointment.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Menu Cepat</h2>
                <div class="space-y-3">
                    <a href="{{ route('admin.users') }}" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-pink-50 transition">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">👥</div>
                        <span class="text-gray-700 font-medium">Kelola Pengguna</span>
                    </a>
                    <a href="{{ route('admin.doctors') }}" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-pink-50 transition">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">👨‍⚕️</div>
                        <span class="text-gray-700 font-medium">Kelola Dokter</span>
                    </a>
                    <a href="{{ route('admin.services') }}" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-pink-50 transition">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">🩺</div>
                        <span class="text-gray-700 font-medium">Kelola Layanan</span>
                    </a>
                    <a href="{{ route('admin.doctors') }}" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-pink-50 transition">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">🗓️</div>
                        <span class="text-gray-700 font-medium">Kelola Jadwal</span>
                    </a>
                    <a href="{{ route('admin.articles') }}" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-pink-50 transition">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">📝</div>
                        <span class="text-gray-700 font-medium">Kelola Artikel</span>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Layanan Populer</h2>
                @forelse($popularServices ?? [] as $service)
                <div class="flex justify-between items-center py-2 border-b border-gray-50 last:border-0">
                    <span class="text-sm text-gray-600">{{ $service->name ?? $service->service_name ?? '-' }}</span>
                    <span class="text-sm font-semibold" style="color: #D4AF37;">{{ $service->total ?? 0 }}</span>
                </div>
                @empty
                <p class="text-sm text-gray-400">Belum ada data.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection