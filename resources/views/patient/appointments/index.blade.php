@extends('layouts.patient')

@section('title', 'Riwayat Appointment')
@section('breadcrumb', 'Appointment')

@section('content')
<div class="py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="page-title">Riwayat Appointment</h1>
            <p class="text-gray-500 mt-1">Daftar appointment Anda</p>
        </div>
        <a href="{{ route('appointments.create') }}" class="text-white px-5 py-3 rounded-xl font-medium transition shadow-md hover:shadow-lg" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
            + Buat Appointment
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-500 border-b border-gray-100">
                        <th class="px-6 py-4 font-medium">No. Appointment</th>
                        <th class="px-6 py-4 font-medium">Tanggal</th>
                        <th class="px-6 py-4 font-medium">Jam</th>
                        <th class="px-6 py-4 font-medium">Dokter</th>
                        <th class="px-6 py-4 font-medium">Layanan</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                    <tr class="border-b border-gray-50 hover:bg-pink-50/50 transition">
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">#{{ $appointment->appointment_number }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $appointment->appointment_date->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $appointment->appointment_time->format('H:i') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">dr. {{ $appointment->doctor->user->name }}</td>
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
                            <a href="{{ route('appointments.show', $appointment) }}" class="text-sm font-medium hover:underline" style="color: #D4AF37;">Detail</a>
                            @if($appointment->status == 'pending')
                                <form method="POST" action="{{ route('appointments.cancel', $appointment) }}" class="inline ml-2" onsubmit="return confirm('Batalkan appointment ini?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-sm text-red-500 hover:underline">Batal</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
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

    <div class="mt-6">
        {{ $appointments->links() }}
    </div>
</div>
@endsection