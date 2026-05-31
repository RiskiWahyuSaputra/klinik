@extends('layouts.staff')

@section('title', 'Kelola Appointment')
@section('breadcrumb', 'Appointment')

@section('content')
<div class="py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="page-title">Kelola Appointment</h1>
        <a href="{{ route('appointments.create') }}" class="text-white px-5 py-3 rounded-xl font-medium transition shadow-md hover:shadow-lg" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
            + Appointment Baru
        </a>
    </div>

    <div class="bg-white rounded-2xl p-4 mb-6 shadow-sm">
        <form method="GET" class="flex flex-wrap gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pasien/dokter..." class="px-4 py-2 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition flex-1 min-w-[200px]">
            <select name="status" class="px-4 py-2 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
                <option value="">Semua Status</option>
                <option value="pending" @selected(request('status') == 'pending')>Pending</option>
                <option value="confirmed" @selected(request('status') == 'confirmed')>Confirmed</option>
                <option value="checked_in" @selected(request('status') == 'checked_in')>Checked In</option>
                <option value="in_progress" @selected(request('status') == 'in_progress')>In Progress</option>
                <option value="completed" @selected(request('status') == 'completed')>Completed</option>
                <option value="cancelled" @selected(request('status') == 'cancelled')>Cancelled</option>
            </select>
            <input type="date" name="date" value="{{ request('date') }}" class="px-4 py-2 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
            <button type="submit" class="px-5 py-2 rounded-xl text-white font-medium transition shadow" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">Filter</button>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-500 border-b border-gray-100">
                        <th class="px-6 py-4 font-medium">No.</th>
                        <th class="px-6 py-4 font-medium">Pasien</th>
                        <th class="px-6 py-4 font-medium">Dokter</th>
                        <th class="px-6 py-4 font-medium">Tanggal</th>
                        <th class="px-6 py-4 font-medium">Jam</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                    <tr class="border-b border-gray-50 hover:bg-pink-50/50 transition">
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">#{{ $appointment->appointment_number }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $appointment->patient->user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">dr. {{ $appointment->doctor->user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $appointment->appointment_date->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $appointment->appointment_time->format('H:i') }}</td>
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
                                <a href="{{ route('appointments.show', $appointment) }}" class="text-xs font-medium hover:underline px-3 py-1" style="color: #D4AF37;">Detail</a>
                                @if($appointment->status == 'pending')
                                <form method="POST" action="{{ route('appointments.cancel', $appointment) }}" onsubmit="return confirm('Batalkan?')">
                                    @csrf @method('PUT')
                                    <button type="submit" class="text-xs text-red-500 hover:underline px-3 py-1">Batal</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            <p class="text-4xl mb-4">📅</p>
                            <p>Tidak ada appointment.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $appointments->links() }}
    </div>
</div>
@endsection