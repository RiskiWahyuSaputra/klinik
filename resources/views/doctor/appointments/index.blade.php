@extends('layouts.doctor')

@section('title', 'Appointment Saya')
@section('breadcrumb', 'Appointment')

@section('content')
<div class="py-8">
    <h1 class="page-title">Appointment Saya</h1>

    <div class="admin-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Pasien</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Layanan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                    <tr>
                        <td data-label="Pasien">{{ $appointment->patient->user->name }}</td>
                        <td data-label="Tanggal">{{ $appointment->appointment_date->format('d M Y') }}</td>
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
                                @if($appointment->status == 'checked_in' || $appointment->status == 'in_progress')
                                <a href="{{ route('doctor.medical-records.create', ['appointment' => $appointment->id]) }}" class="btn-warning btn-sm">
                                    Rekam Medis
                                </a>
                                @elseif($appointment->status == 'completed' && $appointment->medicalRecord)
                                <a href="{{ route('medical-records.show', $appointment->medicalRecord) }}" class="btn-primary btn-sm">Lihat</a>
                                @else
                                <span class="text-sm text-gray-400">-</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <p class="text-4xl mb-4">📅</p>
                            <p>Tidak ada appointment.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="pagination-wrap">
        {{ $appointments->links() }}
    </div>
</div>
@endsection