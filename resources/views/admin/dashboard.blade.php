@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('breadcrumb', 'Dashboard')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Dashboard Admin</h1>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p style="color: #8e8ea0; font-size: 13px; font-weight: 500;">Total Pasien</p>
                <p style="font-size: 28px; font-weight: 700; color: #1a1a2e; margin-top: 4px;">{{ $totalPatients }}</p>
            </div>
            <div class="stat-card-icon pink">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #db2777;">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>
        </div>
    </div>
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p style="color: #8e8ea0; font-size: 13px; font-weight: 500;">Total Dokter</p>
                <p style="font-size: 28px; font-weight: 700; color: #1a1a2e; margin-top: 4px;">{{ $totalDoctors }}</p>
            </div>
            <div class="stat-card-icon gold">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #a16207;">
                    <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
                </svg>
            </div>
        </div>
    </div>
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p style="color: #8e8ea0; font-size: 13px; font-weight: 500;">Total Appointment</p>
                <p style="font-size: 28px; font-weight: 700; color: #1a1a2e; margin-top: 4px;">{{ $totalAppointments }}</p>
            </div>
            <div class="stat-card-icon" style="background: linear-gradient(135deg, #dbeafe, #bfdbfe);">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #1d4ed8;">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
            </div>
        </div>
    </div>
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p style="color: #8e8ea0; font-size: 13px; font-weight: 500;">Hari Ini</p>
                <p style="font-size: 28px; font-weight: 700; color: #1a1a2e; margin-top: 4px;">{{ $todayAppointments }}</p>
            </div>
            <div class="stat-card-icon green">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #047857;">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6" style="margin-top: 40px;">
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
                                    @elseif($appointment->status == 'checked_in') badge-pink
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
                            <td colspan="4">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                    </div>
                                    <p class="empty-state-title">Belum ada appointment</p>
                                    <p class="empty-state-desc">Appointment terbaru akan muncul di sini.</p>
                                </div>
                            </td>
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
                    <div style="width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; background: #fce7f3;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    Kelola Pengguna
                </a>
                <a href="{{ route('admin.doctors') }}" class="quick-menu-item">
                    <div style="width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; background: #fef9c3;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#a16207" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
                        </svg>
                    </div>
                    Kelola Dokter
                </a>
                <a href="{{ route('admin.services') }}" class="quick-menu-item">
                    <div style="width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; background: #dbeafe;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                            <path d="M2 17l10 5 10-5"></path>
                            <path d="M2 12l10 5 10-5"></path>
                        </svg>
                    </div>
                    Kelola Layanan
                </a>
                <a href="{{ route('admin.schedules') }}" class="quick-menu-item">
                    <div style="width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; background: #ede9fe;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    Kelola Jadwal
                </a>
                <a href="{{ route('admin.articles') }}" class="quick-menu-item">
                    <div style="width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; background: #d1fae5;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#047857" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                    </div>
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
            <div class="empty-state" style="padding: 20px 0;">
                <div class="empty-state-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                        <path d="M2 17l10 5 10-5"></path>
                        <path d="M2 12l10 5 10-5"></path>
                    </svg>
                </div>
                <p class="empty-state-desc">Belum ada data layanan.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
