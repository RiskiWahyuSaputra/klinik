@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="py-6">
    <div class="mb-8">
        <h1 class="text-2xl font-bold" style="color: #1a1a2e; font-family: 'Poppins', sans-serif; letter-spacing: -0.3px;">Profil Saya</h1>
        <p class="text-sm" style="color: #8e8ea0; margin-top: 2px;">Kelola data diri dan pengaturan akun</p>
    </div>

    <div class="rounded-2xl overflow-hidden mb-8" style="background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.03);">
        <div style="background: linear-gradient(135deg, #1a0f1c, #2d1a28); padding: 32px 28px;">
            <div class="flex items-center gap-5">
                <div class="photo-upload-wrap" style="position: relative; flex-shrink: 0;">
                    <div id="profileAvatar"
                        style="width: 72px; height: 72px; border-radius: 50%; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0; box-shadow: 0 4px 16px rgba(255, 105, 180, 0.4); cursor: pointer; position: relative;"
                        onclick="document.getElementById('photoInput').click()"
                        title="Klik untuk mengganti foto">
                        @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}"
                            style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                        <div style="width: 100%; height: 100%; border-radius: 50%; background: linear-gradient(135deg, #FFB6C1, #FF69B4); display: flex; align-items: center; justify-content: center; font-size: 30px; font-weight: 700; color: #fff; font-family: 'Poppins', sans-serif;">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        @endif
                        <div class="photo-overlay" style="position: absolute; inset: 0; border-radius: 50%; background: rgba(0,0,0,0.4); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.2s ease;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                <circle cx="12" cy="13" r="4"></circle>
                            </svg>
                        </div>
                    </div>
                </div>
                <div>
                    <h2 style="font-size: 20px; font-weight: 700; color: #fff; font-family: 'Poppins', sans-serif;">{{ $user->name }}</h2>
                    <p style="font-size: 13px; color: rgba(255, 255, 255, 0.6); margin-top: 2px;">{{ $user->email }}</p>
                    <p style="font-size: 12px; color: rgba(255, 255, 255, 0.4); margin-top: 4px;">
                        Bergabung {{ $user->created_at ? $user->created_at->format('d M Y') : now()->format('d M Y') }}
                    </p>
                </div>
            </div>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 0; border-top: 1px solid #eef0f5;">
            <div style="padding: 16px 20px; text-align: center; border-right: 1px solid #eef0f5;">
                <p style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: #8e8ea0; font-weight: 600;">Role</p>
                <p style="font-size: 14px; font-weight: 600; color: #1a1a2e; margin-top: 4px; text-transform: capitalize;">{{ $user->role ?? 'User' }}</p>
            </div>
            <div style="padding: 16px 20px; text-align: center; border-right: 1px solid #eef0f5;">
                <p style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: #8e8ea0; font-weight: 600;">Telepon</p>
                <p style="font-size: 14px; font-weight: 600; color: #1a1a2e; margin-top: 4px;">{{ $user->phone ?? '—' }}</p>
            </div>
            <div style="padding: 16px 20px; text-align: center;">
                <p style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: #8e8ea0; font-weight: 600;">Status</p>
                <p style="font-size: 14px; font-weight: 600; color: #1a1a2e; margin-top: 4px;">
                    <span style="display: inline-flex; align-items: center; gap: 5px; padding: 2px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; background: #d1fae5; color: #047857;">
                        <span style="width: 6px; height: 6px; border-radius: 50%; background: #22C55E; display: inline-block;"></span>
                        Aktif
                    </span>
                </p>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr; gap: 24px;">
        <div class="rounded-2xl" style="background: #fff; padding: 28px; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.03);">
            <div class="flex items-center gap-3 mb-6">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FF69B4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <h2 style="font-size: 16px; font-weight: 600; color: #1a1a2e; font-family: 'Poppins', sans-serif;">Data Pribadi</h2>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Hidden file input for photo -->
                <input type="file" id="photoInput" name="photo" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                    style="display: none;" onchange="previewPhoto(this)">

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px;">
                    <div>
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="form-input @error('name') error @enderror">
                        @error('name') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="form-input @error('email') error @enderror">
                        @error('email') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="form-input @error('phone') error @enderror"
                            placeholder="08123456789">
                        @error('phone') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                @error('photo') <p class="form-error" style="margin-bottom: 12px;">{{ $message }}</p> @enderror

                <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid #eef0f5; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                    <div>
                        <button type="button" class="btn-secondary btn-sm" onclick="document.getElementById('photoInput').click()">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                <circle cx="12" cy="13" r="4"></circle>
                            </svg>
                            Ganti Foto
                        </button>
                        @if($user->photo)
                        <span id="photoStatus" style="font-size: 12px; color: #8e8ea0; margin-left: 8px;">{{ basename($user->photo) }}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn-primary">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <div class="rounded-2xl" style="background: #fff; padding: 28px; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.03);">
            <div class="flex items-center gap-3 mb-6">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#8e8ea0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                <h2 style="font-size: 16px; font-weight: 600; color: #1a1a2e; font-family: 'Poppins', sans-serif;">Ubah Password</h2>
            </div>

            <form method="POST" action="{{ route('profile.password') }}">
                @csrf
                @method('PUT')

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 18px;">
                    <div>
                        <label class="form-label">Password Lama</label>
                        <input type="password" name="current_password" required class="form-input" placeholder="Password saat ini">
                        @error('current_password') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" required class="form-input @error('password') error @enderror" placeholder="Minimal 8 karakter">
                        @error('password') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" required class="form-input @error('password') error @enderror" placeholder="Ulangi password baru">
                        @error('password') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid #eef0f5;">
                    <button type="submit" class="btn-secondary">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="1 4 1 10 7 10"></polyline>
                            <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                        </svg>
                        Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .photo-upload-wrap:hover .photo-overlay {
        opacity: 1 !important;
    }
    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 22px;
        border: none;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        background: linear-gradient(135deg, #FFB6C1, #FF69B4);
        color: #fff;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(255, 105, 180, 0.25);
        font-family: 'Inter', sans-serif;
        line-height: 1;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 105, 180, 0.35);
    }
    .btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 22px;
        border: 1px solid #e2e4ea;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #fff;
        color: #4a4a6a;
        text-decoration: none;
        font-family: 'Inter', sans-serif;
        line-height: 1;
    }
    .btn-secondary:hover {
        background: #f8f9fc;
        border-color: #d0d2da;
    }
    .btn-sm {
        padding: 8px 14px;
        font-size: 12px;
        border-radius: 8px;
    }
    .form-input {
        width: 100%;
        padding: 11px 16px;
        border: 1px solid #e2e4ea;
        border-radius: 12px;
        font-size: 14px;
        color: #2d2d44;
        background: #fff;
        outline: none;
        transition: all 0.2s ease;
        font-family: 'Inter', sans-serif;
    }
    .form-input:focus {
        border-color: #FFB6C1;
        box-shadow: 0 0 0 3px rgba(255, 182, 193, 0.15);
    }
    .form-input.error {
        border-color: #fca5a5;
    }
    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #4a4a6a;
        margin-bottom: 6px;
    }
    .form-error {
        font-size: 12px;
        color: #dc2626;
        margin-top: 4px;
    }
    @media (max-width: 768px) {
        [style*="grid-template-columns: 1fr 1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
        [style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>

<script>
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const avatar = document.getElementById('profileAvatar');
            avatar.innerHTML = '<img src="' + e.target.result + '" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">'
                + '<div class="photo-overlay" style="position: absolute; inset: 0; border-radius: 50%; background: rgba(0,0,0,0.4); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.2s ease;">'
                + '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">'
                + '<path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>'
                + '<circle cx="12" cy="13" r="4"></circle></svg></div>';
            const status = document.getElementById('photoStatus');
            if (status) {
                status.textContent = input.files[0].name;
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
