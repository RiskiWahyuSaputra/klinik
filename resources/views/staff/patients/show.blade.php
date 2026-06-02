@extends('layouts.staff')

@section('title', 'Detail Pasien')
@section('breadcrumb', 'Pasien / Detail')

@section('content')
<div>
    <div class="page-header">
        <div>
            <h1 class="page-title">Detail Pasien</h1>
            <p class="page-subtitle">Informasi lengkap pasien</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('appointments.create', ['patient_id' => $patient->id]) }}" class="btn btn-primary">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                Buat Appointment
            </a>
            <a href="{{ route('staff.patients') }}" class="btn btn-outline">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Profile Header -->
    <div class="card overflow-hidden mb-6">
        <div style="background: linear-gradient(135deg, #1a0f1c, #2d1a28); padding: 28px 24px;">
            <div class="flex items-center gap-4">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #FFB6C1, #FF69B4); display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 700; color: #fff; flex-shrink: 0; font-family: 'Poppins', sans-serif; box-shadow: 0 4px 12px rgba(255, 105, 180, 0.4);">
                    {{ substr($patient->user->name, 0, 1) }}
                </div>
                <div>
                    <h2 style="font-size: 18px; font-weight: 700; color: #fff; font-family: 'Poppins', sans-serif;">{{ $patient->user->name }}</h2>
                    <p style="font-size: 13px; color: rgba(255, 255, 255, 0.6); margin-top: 2px;">{{ $patient->user->email }}</p>
                    <p style="font-size: 12px; color: rgba(255, 255, 255, 0.4); margin-top: 2px;">No. Pasien: {{ $patient->patient_number ?? 'P-'.str_pad($patient->id, 4, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-0 border-t" style="border-color: var(--border);">
            <div style="padding: 14px 20px; text-align: center; border-right: 1px solid var(--border);">
                <p style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted); font-weight: 600;">Jenis Kelamin</p>
                <p style="font-size: 13px; font-weight: 600; color: var(--text-heading); margin-top: 4px;">
                    @if($patient->gender == 'male') Laki-laki
                    @elseif($patient->gender == 'female') Perempuan
                    @else <span style="color: var(--text-muted);">—</span>
                    @endif
                </p>
            </div>
            <div style="padding: 14px 20px; text-align: center; border-right: 1px solid var(--border);">
                <p style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted); font-weight: 600;">Tanggal Lahir</p>
                <p style="font-size: 13px; font-weight: 600; color: var(--text-heading); margin-top: 4px;">
                    {{ $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->format('d M Y') : '—' }}
                </p>
            </div>
            <div style="padding: 14px 20px; text-align: center; border-right: 1px solid var(--border);">
                <p style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted); font-weight: 600;">Telepon</p>
                <p style="font-size: 13px; font-weight: 600; color: var(--text-heading); margin-top: 4px;">{{ $patient->phone ?? $patient->user->phone ?? '—' }}</p>
            </div>
            <div style="padding: 14px 20px; text-align: center;">
                <p style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted); font-weight: 600;">Bergabung</p>
                <p style="font-size: 13px; font-weight: 600; color: var(--text-heading); margin-top: 4px;">{{ $patient->created_at ? $patient->created_at->format('d M Y') : now()->format('d M Y') }}</p>
            </div>
        </div>
        @if($patient->address)
        <div style="padding: 12px 20px; border-top: 1px solid var(--border); text-align: center;">
            <p style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted); font-weight: 600;">Alamat</p>
            <p style="font-size: 13px; color: var(--text-body); margin-top: 2px;">{{ $patient->address }}</p>
        </div>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Riwayat Appointment -->
        <div class="card overflow-hidden">
            <div style="padding: 16px 20px; border-bottom: 1px solid var(--border);">
                <h2 style="font-size: 15px; font-weight: 600; color: var(--text-heading); font-family: 'Poppins', sans-serif;">Riwayat Appointment</h2>
            </div>
            @if($patient->appointments && $patient->appointments->count() > 0)
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Dokter</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patient->appointments->sortByDesc('appointment_date')->take(10) as $appointment)
                        <tr>
                            <td data-label="Tanggal">{{ $appointment->appointment_date->format('d/m/Y') }}</td>
                            <td data-label="Dokter">dr. {{ $appointment->doctor->user->name ?? '-' }}</td>
                            <td data-label="Status">
                                <span class="badge
                                    @if($appointment->status == 'pending') badge-amber
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
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state" style="padding: 32px 20px;">
                <div class="empty-state-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <p class="empty-state-title">Belum ada appointment</p>
                <p class="empty-state-desc">Pasien belum pernah membuat appointment.</p>
            </div>
            @endif
        </div>

        <!-- Riwayat Rekam Medis -->
        <div class="card overflow-hidden">
            <div style="padding: 16px 20px; border-bottom: 1px solid var(--border);">
                <h2 style="font-size: 15px; font-weight: 600; color: var(--text-heading); font-family: 'Poppins', sans-serif;">Rekam Medis</h2>
            </div>
            @if($patient->medicalRecords && $patient->medicalRecords->count() > 0)
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Dokter</th>
                            <th>Diagnosis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patient->medicalRecords->sortByDesc('created_at')->take(10) as $record)
                        <tr>
                            <td data-label="Tanggal">{{ $record->created_at->format('d/m/Y') }}</td>
                            <td data-label="Dokter">dr. {{ $record->doctor->user->name ?? '-' }}</td>
                            <td data-label="Diagnosis">
                                <span class="truncate block max-w-[180px]" title="{{ $record->diagnosis ?? '' }}">{{ $record->diagnosis ?? '-' }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state" style="padding: 32px 20px;">
                <div class="empty-state-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                </div>
                <p class="empty-state-title">Belum ada rekam medis</p>
                <p class="empty-state-desc">Pasien belum memiliki rekam medis.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
