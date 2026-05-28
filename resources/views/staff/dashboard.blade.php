@extends('layouts.app')

@section('title', 'Staff Dashboard')

@section('content')
<div class="py-8">
    <h1 class="text-3xl font-bold font-[Poppins] text-gray-800 mb-2">Dashboard Staff</h1>
    <p class="text-gray-500 mb-8">Overview appointment hari ini ({{ now()->format('d M Y') }})</p>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Menunggu</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $waitingCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background: #fff3cd;">⏳</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Check In</p>
                    <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $checkedInCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background: #e0e7ff;">✅</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Dalam Pemeriksaan</p>
                    <p class="text-3xl font-bold text-purple-600 mt-1">{{ $inProgressCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background: #f3e8ff;">🩺</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Selesai</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ $completedCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background: #d4edda;">✅</div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Appointment Hari Ini</h2>
            <span class="text-sm text-gray-400">{{ $todayAppointments->count() }} appointment</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-500 border-b border-gray-100">
                        <th class="px-6 py-4 font-medium">No.</th>
                        <th class="px-6 py-4 font-medium">Pasien</th>
                        <th class="px-6 py-4 font-medium">Dokter</th>
                        <th class="px-6 py-4 font-medium">Jam</th>
                        <th class="px-6 py-4 font-medium">Layanan</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($todayAppointments as $appointment)
                    <tr class="border-b border-gray-50 hover:bg-pink-50/50 transition">
                        <td class="px-6 py-4 text-sm text-gray-800">#{{ $appointment->appointment_number }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $appointment->patient->user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">dr. {{ $appointment->doctor->user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $appointment->appointment_time->format('H:i') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $appointment->service->name ?? '-' }}</td>
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
                            <div class="flex space-x-2">
                                @if($appointment->status == 'pending' || $appointment->status == 'confirmed')
                                <form method="POST" action="{{ route('appointments.update-status', $appointment) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="checked_in">
                                    <button type="submit" class="text-xs bg-indigo-100 text-indigo-700 px-3 py-1 rounded-lg hover:bg-indigo-200 transition">Check In</button>
                                </form>
                                @endif
                                @if($appointment->status == 'checked_in')
                                <form method="POST" action="{{ route('appointments.update-status', $appointment) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="in_progress">
                                    <button type="submit" class="text-xs bg-purple-100 text-purple-700 px-3 py-1 rounded-lg hover:bg-purple-200 transition">Mulai</button>
                                </form>
                                @endif
                                @if($appointment->status == 'in_progress')
                                <form method="POST" action="{{ route('appointments.update-status', $appointment) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-lg hover:bg-green-200 transition">Selesai</button>
                                </form>
                                @endif
                                @if($appointment->status == 'pending')
                                <form method="POST" action="{{ route('appointments.update-status', $appointment) }}" onsubmit="return confirm('Batalkan appointment ini?')">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="text-xs bg-red-100 text-red-700 px-3 py-1 rounded-lg hover:bg-red-200 transition">Batal</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            <p class="text-4xl mb-4">📅</p>
                            <p>Tidak ada appointment hari ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection