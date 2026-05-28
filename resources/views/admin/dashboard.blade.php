@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('breadcrumb', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p style="color: #8e8ea0; font-size: 13px; font-weight: 500;">Total Pasien</p>
                <p style="font-size: 28px; font-weight: 700; color: #1a1a2e; margin-top: 4px;">{{ $totalPatients }}</p>
            </div>
            <div class="stat-card-icon pink">👤</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p style="color: #8e8ea0; font-size: 13px; font-weight: 500;">Total Dokter</p>
                <p style="font-size: 28px; font-weight: 700; color: #1a1a2e; margin-top: 4px;">{{ $totalDoctors }}</p>
            </div>
            <div class="stat-card-icon gold">👨‍⚕️</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p style="color: #8e8ea0; font-size: 13px; font-weight: 500;">Total Appointment</p>
                <p style="font-size: 28px; font-weight: 700; color: #1a1a2e; margin-top: 4px;">{{ $totalAppointments }}</p>
            </div>
            <div class="stat-card-icon indigo">📅</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p style="color: #8e8ea0; font-size: 13px; font-weight: 500;">Hari Ini</p>
                <p style="font-size: 28px; font-weight: 700; color: #1a1a2e; margin-top: 4px;">{{ $todayAppointments }}</p>
            </div>
            <div class="stat-card-icon green">📊</div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="admin-card overflow-hidden">
            <div style="padding: 20px 24px; border-bottom: 1px solid #eef0f5;">
                <h2 style="font-size: 16px; font-weight: 600; color: #1a1a2e;">Appointment Terbaru</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentAppointments as $appointment)
                        <tr>
                            <td data-label="Pasien">{{ $appointment->patient->user->name }}</td>
                            <td data-label="Dokter">dr. {{ $appointment->doctor->user->name }}</td>
                            <td data-label="Tanggal">{{ $appointment->appointment_date->format('d M Y') }}</td>
                            <td data-label="Status">
                                <span class="badge
                                    @if($appointment->status == 'pending') badge-yellow
                                    @elseif($appointment->status == 'confirmed') badge-blue
                                    @elseif($appointment->status == 'checked_in') badge-indigo
                                    @elseif($appointment->status == 'in_progress') badge-purple
                                    @elseif($appointment->status == 'completed') badge-green
                                    @else badge-red
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 40px 20px; color: #8e8ea0;">Belum ada appointment.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="space-y-5">
        <div class="admin-card" style="padding: 20px 24px;">
            <h2 style="font-size: 15px; font-weight: 600; color: #1a1a2e; margin-bottom: 16px;">Menu Cepat</h2>
            <div class="quick-menu">
                <a href="{{ route('admin.users') }}" class="quick-menu-item">
                    <div style="width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; background: #fce7f3;">👥</div>
                    Kelola Pengguna
                </a>
                <a href="{{ route('admin.doctors') }}" class="quick-menu-item">
                    <div style="width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; background: #fef9c3;">👨‍⚕️</div>
                    Kelola Dokter
                </a>
                <a href="{{ route('admin.services') }}" class="quick-menu-item">
                    <div style="width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; background: #dbeafe;">🩺</div>
                    Kelola Layanan
                </a>
                <a href="{{ route('admin.schedules') }}" class="quick-menu-item">
                    <div style="width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; background: #ede9fe;">🗓️</div>
                    Kelola Jadwal
                </a>
                <a href="{{ route('admin.articles') }}" class="quick-menu-item">
                    <div style="width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; background: #d1fae5;">📝</div>
                    Kelola Artikel
                </a>
            </div>
        </div>

        <div class="admin-card" style="padding: 20px 24px;">
            <h2 style="font-size: 15px; font-weight: 600; color: #1a1a2e; margin-bottom: 16px;">Layanan Populer</h2>
            @forelse($popularServices ?? [] as $service)
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f4f5f9;">
                <span style="font-size: 13px; color: #4a4a6a;">{{ $service->name ?? $service->service_name ?? '-' }}</span>
                <span style="font-size: 13px; font-weight: 700; color: #D4AF37;">{{ $service->total ?? 0 }}</span>
            </div>
            @empty
            <p style="font-size: 13px; color: #8e8ea0;">Belum ada data.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection