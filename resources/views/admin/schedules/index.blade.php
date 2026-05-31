@extends('layouts.admin')

@section('title', 'Kelola Jadwal Dokter')

@section('breadcrumb', 'Admin / Jadwal')

@section('content')
<div class="page-header">
    <h1 class="page-title">Kelola Jadwal Dokter</h1>
</div>

<div style="display: grid; grid-template-columns: 1fr; gap: 24px;">
    <div class="admin-card overflow-hidden">
        <div style="padding: 20px 24px; border-bottom: 1px solid #eef0f5;">
            <h2 style="font-size: 16px; font-weight: 600; color: #1a1a2e;">Jadwal Tersedia</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Dokter</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schedules as $schedule)
                    <tr>
                        <td data-label="Dokter" style="font-weight: 600; color: #1a1a2e;">dr. {{ $schedule->doctor->user->name }}</td>
                        <td data-label="Hari">
                            @php
                                $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                            @endphp
                            {{ $days[$schedule->day_of_week] ?? $schedule->day_of_week }}
                        </td>
                        <td data-label="Jam Mulai">{{ $schedule->start_time }}</td>
                        <td data-label="Jam Selesai">{{ $schedule->end_time }}</td>
                        <td data-label="Aksi">
                            <form method="POST" action="{{ route('admin.schedules.destroy', $schedule) }}" onsubmit="return confirm('Hapus jadwal ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                </div>
                                <p class="empty-state-title">Belum ada jadwal</p>
                                <p class="empty-state-desc">Tambah jadwal baru untuk dokter.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap" style="padding: 16px 24px;">
            {{ $schedules->links() }}
        </div>
    </div>

    <div class="admin-card" style="max-width: 500px; padding: 24px;">
        <h2 style="font-size: 16px; font-weight: 600; color: #1a1a2e; margin-bottom: 20px;">Tambah Jadwal Baru</h2>

        <form method="POST" action="{{ route('admin.schedules.store') }}">
            @csrf

            <div style="margin-bottom: 16px;">
                <label class="form-label">Dokter</label>
                <select name="doctor_id" required
                    class="form-input form-select @error('doctor_id') error @enderror">
                    <option value="">Pilih Dokter</option>
                    @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" @selected(old('doctor_id') == $doctor->id)>
                        dr. {{ $doctor->user->name }}
                    </option>
                    @endforeach
                </select>
                @error('doctor_id') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label class="form-label">Hari</label>
                <select name="day_of_week" required
                    class="form-input form-select @error('day_of_week') error @enderror">
                    <option value="">Pilih Hari</option>
                    <option value="1" @selected(old('day_of_week') == 1)>Senin</option>
                    <option value="2" @selected(old('day_of_week') == 2)>Selasa</option>
                    <option value="3" @selected(old('day_of_week') == 3)>Rabu</option>
                    <option value="4" @selected(old('day_of_week') == 4)>Kamis</option>
                    <option value="5" @selected(old('day_of_week') == 5)>Jumat</option>
                    <option value="6" @selected(old('day_of_week') == 6)>Sabtu</option>
                    <option value="0" @selected(old('day_of_week') == 0)>Minggu</option>
                </select>
                @error('day_of_week') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 20px;">
                <div>
                    <label class="form-label">Jam Mulai</label>
                    <input type="time" name="start_time" value="{{ old('start_time', '08:00') }}" required
                        class="form-input @error('start_time') error @enderror">
                    @error('start_time') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Jam Selesai</label>
                    <input type="time" name="end_time" value="{{ old('end_time', '16:00') }}" required
                        class="form-input @error('end_time') error @enderror">
                    @error('end_time') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Tambah Jadwal
            </button>
        </form>
    </div>
</div>
@endsection
