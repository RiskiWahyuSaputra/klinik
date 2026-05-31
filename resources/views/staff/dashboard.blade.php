@extends('layouts.staff')

@section('title', 'Dashboard Staff')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="py-8">
    <h1 class="page-title">Dashboard Staff</h1>
    <p class="text-gray-500 mb-8">Overview appointment hari ini ({{ now()->format('d M Y') }})</p>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Menunggu</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $waitingCount }}</p>
                </div>
                <div class="stat-card-icon gold">⏳</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Check In</p>
                    <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $checkedInCount }}</p>
                </div>
                <div class="stat-card-icon indigo">✅</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Dalam Pemeriksaan</p>
                    <p class="text-3xl font-bold text-purple-600 mt-1">{{ $inProgressCount }}</p>
                </div>
                <div class="stat-card-icon purple">🩺</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Selesai</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ $completedCount }}</p>
                </div>
                <div class="stat-card-icon green">✅</div>
            </div>
        </div>
    </div>

    <div class="admin-card overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Appointment Hari Ini</h2>
            <span class="text-sm text-gray-400">{{ $todayAppointments->count() }} appointment</span>
        </div>
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Jam</th>
                        <th>Layanan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($todayAppointments as $appointment)
                    <tr>
                        <td data-label="No.">#{{ $appointment->appointment_number }}</td>
                        <td data-label="Pasien">{{ $appointment->patient->user->name }}</td>
                        <td data-label="Dokter">dr. {{ $appointment->doctor->user->name }}</td>
                        <td data-label="Jam">{{ $appointment->appointment_time->format('H:i') }}</td>
                        <td data-label="Layanan">{{ $appointment->service->name ?? '-' }}</td>
                        <td data-label="Status">
                            <span class="badge
                                @if($appointment->status == 'pending') badge-yellow
                                @elseif($appointment->status == 'confirmed') badge-blue
                                @elseif($appointment->status == 'checked_in') badge-indigo
                                @elseif($appointment->status == 'in_progress') badge-purple
                                @elseif($appointment->status == 'completed') badge-green
                                @elseif($appointment->status == 'cancelled') badge-red
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                            </span>
                        </td>
                        <td data-label="Aksi">
                            <div class="flex space-x-2">
                                @if($appointment->status == 'pending' || $appointment->status == 'confirmed')
                                <form method="POST" action="{{ route('appointments.update-status', $appointment) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="checked_in">
                                    <button type="submit" class="btn-primary btn-sm">Check In</button>
                                </form>
                                @endif
                                @if($appointment->status == 'checked_in')
                                <form method="POST" action="{{ route('appointments.update-status', $appointment) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="in_progress">
                                    <button type="submit" class="btn-primary btn-sm">Mulai</button>
                                </form>
                                @endif
                                @if($appointment->status == 'in_progress')
                                <form method="POST" action="{{ route('appointments.update-status', $appointment) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="btn-primary btn-sm">Selesai</button>
                                </form>
                                @endif
                                @if($appointment->status == 'pending')
                                <form method="POST" action="{{ route('appointments.update-status', $appointment) }}" onsubmit="return confirm('Batalkan appointment ini?')">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="btn-secondary btn-sm">Batal</button>
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