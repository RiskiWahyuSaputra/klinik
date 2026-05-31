<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Pasien') - Klinik Mon Cheri</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 280px;
            --color-pink: #FFB6C1;
            --color-pink-light: #FFC0CB;
            --color-pink-dark: #FF69B4;
            --color-gold: #D4AF37;
            --color-gold-light: #F0E68C;
            --sidebar-bg: #1a0f1c;
            --sidebar-hover: rgba(255, 182, 193, 0.08);
            --sidebar-active: rgba(255, 182, 193, 0.15);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background: #fff5f7;
            min-height: 100vh;
            display: flex;
        }

        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }

        .role-sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #1a0f1c 0%, #2d1a28 100%);
            color: #fff;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .role-sidebar::-webkit-scrollbar { width: 3px; }
        .role-sidebar::-webkit-scrollbar-track { background: transparent; }
        .role-sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 10px; }

        .sidebar-brand { padding: 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.06); flex-shrink: 0; }
        .sidebar-brand-link { display: flex; align-items: center; gap: 12px; text-decoration: none; color: #fff; }
        .sidebar-brand-icon {
            width: 42px; height: 42px; border-radius: 12px;
            background: linear-gradient(135deg, #FFB6C1, #FF69B4);
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; font-weight: 700; flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(255, 105, 180, 0.3);
        }
        .sidebar-brand-text { display: flex; flex-direction: column; }
        .sidebar-brand-name { font-family: 'Poppins', sans-serif; font-size: 18px; font-weight: 700; color: #fff; line-height: 1.2; }
        .sidebar-brand-sub { font-size: 10px; text-transform: uppercase; letter-spacing: 2px; color: rgba(255,255,255,0.5); font-weight: 500; }

        .sidebar-nav { padding: 12px 12px; flex: 1; }
        .sidebar-label { font-size: 10px; text-transform: uppercase; letter-spacing: 1.5px; color: rgba(255,255,255,0.3); font-weight: 600; padding: 16px 12px 8px; }

        .sidebar-link {
            display: flex; align-items: center; gap: 14px;
            padding: 10px 14px; border-radius: 10px;
            color: rgba(255,255,255,0.65); text-decoration: none;
            font-size: 14px; font-weight: 500;
            transition: all 0.2s ease; margin-bottom: 2px; position: relative;
        }
        .sidebar-link:hover { background: var(--sidebar-hover); color: #fff; transform: translateX(3px); }
        .sidebar-link.active { background: var(--sidebar-active); color: #fff; box-shadow: inset 3px 0 0 #FFB6C1; }
        .sidebar-link.active::before {
            content: ''; position: absolute; left: -12px; top: 50%; transform: translateY(-50%);
            width: 3px; height: 24px;
            background: linear-gradient(180deg, #FFB6C1, #D4AF37);
            border-radius: 0 3px 3px 0;
        }
        .sidebar-link-icon {
            width: 36px; height: 36px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; flex-shrink: 0;
            transition: all 0.2s ease; background: rgba(255,255,255,0.06);
        }
        .sidebar-link:hover .sidebar-link-icon { background: rgba(255, 182, 193, 0.15); }
        .sidebar-link.active .sidebar-link-icon { background: linear-gradient(135deg, rgba(255, 182, 193, 0.2), rgba(212, 175, 55, 0.15)); }
        .sidebar-link-text { flex: 1; }
        .sidebar-link-arrow { font-size: 12px; opacity: 0.4; transition: transform 0.2s ease; }
        .sidebar-link:hover .sidebar-link-arrow { opacity: 0.8; transform: translateX(3px); }

        .sidebar-footer { padding: 16px 16px; border-top: 1px solid rgba(255,255,255,0.06); flex-shrink: 0; }
        .sidebar-user { display: flex; align-items: center; gap: 12px; padding: 8px 8px; border-radius: 10px; transition: background 0.2s ease; cursor: pointer; }
        .sidebar-user:hover { background: var(--sidebar-hover); }
        .sidebar-user-avatar { width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, #FFB6C1, #D4AF37); display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 600; color: #fff; flex-shrink: 0; }
        .sidebar-user-info { flex: 1; min-width: 0; }
        .sidebar-user-name { font-size: 13px; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .sidebar-user-role { font-size: 11px; color: rgba(255,255,255,0.45); }

        .sidebar-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 999; opacity: 0; visibility: hidden; transition: all 0.3s ease; backdrop-filter: blur(4px); }
        .sidebar-overlay.open { opacity: 1; visibility: visible; }

        .role-main { margin-left: var(--sidebar-width); flex: 1; min-height: 100vh; display: flex; flex-direction: column; transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1); }

        .role-topbar { background: #fff; border-bottom: 1px solid #eef0f5; padding: 0 32px; height: 64px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; box-shadow: 0 1px 3px rgba(0,0,0,0.02); }
        .topbar-left { display: flex; align-items: center; gap: 16px; }
        .topbar-hamburger { display: none; width: 40px; height: 40px; border: none; background: #f4f5f9; border-radius: 10px; cursor: pointer; align-items: center; justify-content: center; transition: all 0.2s ease; color: #4a4a6a; }
        .topbar-hamburger:hover { background: #e8e9f0; }
        .topbar-breadcrumb { font-size: 13px; color: #8e8ea0; font-weight: 500; }
        .topbar-breadcrumb span { color: #2d2d44; font-weight: 600; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }

        .topbar-user-dropdown { position: relative; }
        .topbar-user-btn { display: flex; align-items: center; gap: 10px; padding: 4px 12px 4px 4px; border: none; background: #f4f5f9; border-radius: 10px; cursor: pointer; transition: all 0.2s ease; }
        .topbar-user-btn:hover { background: #e8e9f0; }
        .topbar-user-avatar { width: 32px; height: 32px; border-radius: 8px; background: linear-gradient(135deg, #FFB6C1, #D4AF37); display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 600; color: #fff; }
        .topbar-user-name { font-size: 13px; font-weight: 600; color: #2d2d44; }
        .topbar-user-chevron { font-size: 10px; color: #8e8ea0; transition: transform 0.2s ease; }
        .topbar-user-btn[aria-expanded="true"] .topbar-user-chevron { transform: rotate(180deg); }

        .dropdown-menu { position: absolute; top: calc(100% + 8px); right: 0; background: #fff; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.12); min-width: 200px; padding: 6px; opacity: 0; visibility: hidden; transform: translateY(-8px); transition: all 0.2s ease; z-index: 200; border: 1px solid #eef0f5; }
        .dropdown-menu.open { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown-item { display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 8px; color: #4a4a6a; text-decoration: none; font-size: 13px; font-weight: 500; transition: all 0.15s ease; cursor: pointer; border: none; background: none; width: 100%; text-align: left; }
        .dropdown-item:hover { background: #f4f5f9; color: #2d2d44; }
        .dropdown-item-danger:hover { background: #fef2f2; color: #dc2626; }
        .dropdown-divider { height: 1px; background: #eef0f5; margin: 4px 6px; }

        .role-content { flex: 1; padding: 28px 32px; animation: fadeInUp 0.4s ease; }

        @keyframes fadeInUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }

        .admin-card { background: #fff; border-radius: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.03); transition: all 0.25s ease; }
        .admin-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.06), 0 2px 4px rgba(0,0,0,0.04); transform: translateY(-1px); }

        .stat-card { background: #fff; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.03); transition: all 0.3s ease; position: relative; overflow: hidden; }
        .stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; border-radius: 16px 16px 0 0; }
        .stat-card:nth-child(1)::before { background: linear-gradient(90deg, #FFB6C1, #FF69B4); }
        .stat-card:nth-child(2)::before { background: linear-gradient(90deg, #34D399, #10B981); }
        .stat-card:nth-child(3)::before { background: linear-gradient(90deg, #D4AF37, #F0E68C); }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.08), 0 4px 8px rgba(0,0,0,0.04); }
        .stat-card-icon { width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
        .stat-card-icon.pink { background: linear-gradient(135deg, #fce7f3, #fbcfe8); }
        .stat-card-icon.green { background: linear-gradient(135deg, #d1fae5, #a7f3d0); }
        .stat-card-icon.gold { background: linear-gradient(135deg, #fef9c3, #fef08a); }

        .admin-table { width: 100%; border-collapse: collapse; }
        .admin-table thead th { text-align: left; padding: 14px 20px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #8e8ea0; background: #fafbfc; border-bottom: 1px solid #eef0f5; }
        .admin-table tbody tr { border-bottom: 1px solid #f4f5f9; transition: all 0.15s ease; }
        .admin-table tbody tr:last-child { border-bottom: none; }
        .admin-table tbody tr:hover { background: #fdf2f8; }
        .admin-table tbody td { padding: 14px 20px; font-size: 13px; color: #4a4a6a; }

        .badge { display: inline-flex; align-items: center; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; letter-spacing: 0.2px; }
        .badge-pink { background: #fce7f3; color: #db2777; }
        .badge-yellow { background: #fef9c3; color: #a16207; }
        .badge-blue { background: #dbeafe; color: #1d4ed8; }
        .badge-green { background: #d1fae5; color: #047857; }
        .badge-red { background: #fee2e2; color: #dc2626; }
        .badge-purple { background: #ede9fe; color: #7c3aed; }
        .badge-indigo { background: #e0e7ff; color: #4338ca; }
        .badge-gray { background: #f3f4f6; color: #6b7280; }

        .btn-primary { display: inline-flex; align-items: center; gap: 8px; padding: 10px 22px; border: none; border-radius: 12px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s ease; background: linear-gradient(135deg, #FFB6C1, #FF69B4); color: #fff; text-decoration: none; box-shadow: 0 2px 8px rgba(255, 105, 180, 0.25); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(255, 105, 180, 0.35); }
        .btn-secondary { display: inline-flex; align-items: center; gap: 8px; padding: 10px 22px; border: 1px solid #e2e4ea; border-radius: 12px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s ease; background: #fff; color: #4a4a6a; text-decoration: none; }
        .btn-secondary:hover { background: #f8f9fc; border-color: #d0d2da; }
        .btn-sm { padding: 6px 14px; font-size: 12px; border-radius: 8px; }

        .form-input { width: 100%; padding: 11px 16px; border: 1px solid #e2e4ea; border-radius: 12px; font-size: 14px; color: #2d2d44; background: #fff; outline: none; transition: all 0.2s ease; font-family: 'Poppins', sans-serif; }
        .form-input:focus { border-color: #FFB6C1; box-shadow: 0 0 0 3px rgba(255, 182, 193, 0.15); }
        .form-input.error { border-color: #fca5a5; }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: #4a4a6a; margin-bottom: 6px; }
        .form-error { font-size: 12px; color: #dc2626; margin-top: 4px; }
        .form-select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238e8ea0' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 14px center; padding-right: 40px; }

        .alert { padding: 14px 18px; border-radius: 12px; font-size: 13px; font-weight: 500; display: flex; align-items: center; gap: 10px; margin-bottom: 20px; animation: slideDown 0.3s ease; }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        .alert-success { background: #d1fae5; color: #047857; border: 1px solid #a7f3d0; }
        .alert-error { background: #fee2e2; color: #dc2626; border: 1px solid #fecaca; }

        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; flex-wrap: wrap; gap: 16px; }
        .page-title { font-size: 24px; font-weight: 700; color: #1a1a2e; letter-spacing: -0.3px; }

        .pagination-wrap { margin-top: 24px; }
        .pagination-wrap nav [role="navigation"] { display: flex; align-items: center; justify-content: center; gap: 4px; }
        .pagination-wrap a, .pagination-wrap span { display: inline-flex; align-items: center; justify-content: center; min-width: 36px; height: 36px; padding: 0 8px; border-radius: 10px; font-size: 13px; font-weight: 500; color: #4a4a6a; background: #fff; border: 1px solid #e2e4ea; text-decoration: none; transition: all 0.2s ease; }
        .pagination-wrap a:hover { background: #f4f5f9; border-color: #d0d2da; }
        .pagination-wrap span[aria-current="page"] { background: linear-gradient(135deg, #FFB6C1, #FF69B4); color: #fff; border-color: transparent; }
        .pagination-wrap .disabled span { opacity: 0.4; cursor: not-allowed; }

        @media (max-width: 1024px) { .role-content { padding: 24px 20px; } .role-topbar { padding: 0 20px; } }
        @media (max-width: 768px) {
            .role-sidebar { transform: translateX(-100%); }
            .role-sidebar.open { transform: translateX(0); }
            .role-main { margin-left: 0; }
            .role-content { padding: 20px 16px; }
            .role-topbar { padding: 0 16px; height: 56px; }
            .topbar-hamburger { display: flex; }
            .page-header { flex-direction: column; align-items: stretch; }
            .page-title { font-size: 20px; }
            .stat-card { padding: 18px; }
            .admin-table thead { display: none; }
            .admin-table tbody tr { display: block; padding: 16px; border: 1px solid #eef0f5; border-radius: 12px; margin-bottom: 12px; background: #fff; }
            .admin-table tbody td { display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border: none; font-size: 13px; }
            .admin-table tbody td::before { content: attr(data-label); font-weight: 600; color: #8e8ea0; font-size: 11px; text-transform: uppercase; letter-spacing: 0.3px; }
            .admin-table tbody tr:hover { background: #fff; }
            .admin-table tbody td:last-child { padding-bottom: 0; }
            .admin-table tbody td:first-child { padding-top: 0; }
        }
        @media (max-width: 480px) { .role-content { padding: 16px 12px; } .topbar-user-name { display: none; } .stat-card-icon { width: 40px; height: 40px; font-size: 18px; } }
    </style>
    @stack('styles')
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <aside class="role-sidebar" id="roleSidebar">
        <div class="sidebar-brand">
            <a href="{{ route('patient.dashboard') }}" class="sidebar-brand-link">
                <div class="sidebar-brand-icon">M</div>
                <div class="sidebar-brand-text">
                    <span class="sidebar-brand-name">Mon Cheri</span>
                    <span class="sidebar-brand-sub">Pasien Panel</span>
                </div>
            </a>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-label">Menu Pasien</div>

            <a href="{{ route('patient.dashboard') }}" class="sidebar-link {{ request()->routeIs('patient.dashboard') ? 'active' : '' }}">
                <div class="sidebar-link-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect>
                        <rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect>
                    </svg>
                </div>
                <span class="sidebar-link-text">Dashboard</span>
                <span class="sidebar-link-arrow">→</span>
            </a>

            <a href="{{ route('appointments.index') }}" class="sidebar-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                <div class="sidebar-link-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>
                <span class="sidebar-link-text">Appointment</span>
                <span class="sidebar-link-arrow">→</span>
            </a>

            <a href="{{ route('medical-records.index') }}" class="sidebar-link {{ request()->routeIs('medical-records.*') ? 'active' : '' }}">
                <div class="sidebar-link-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line>
                    </svg>
                </div>
                <span class="sidebar-link-text">Rekam Medis</span>
                <span class="sidebar-link-arrow">→</span>
            </a>

            <a href="{{ route('patient.profile') }}" class="sidebar-link {{ request()->routeIs('patient.profile*') ? 'active' : '' }}">
                <div class="sidebar-link-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <span class="sidebar-link-text">Profil Saya</span>
                <span class="sidebar-link-arrow">→</span>
            </a>
        </nav>

        @auth
        <div class="sidebar-footer">
            <div class="sidebar-user" onclick="toggleDropdown()" id="sidebarUserBtn">
                <div class="sidebar-user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                <div class="sidebar-user-info">
                    <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
                    <div class="sidebar-user-role">Pasien</div>
                </div>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: rgba(255,255,255,0.3); flex-shrink: 0;"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </div>
            <div class="dropdown-menu" id="sidebarDropdown" style="left: 0; right: auto; bottom: calc(100% + 8px); top: auto;">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item dropdown-item-danger">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
        @endauth
    </aside>

    <div class="role-main">
        <header class="role-topbar">
            <div class="topbar-left">
                <button class="topbar-hamburger" onclick="toggleSidebar()" aria-label="Toggle sidebar">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
                <div class="topbar-breadcrumb"><span>@yield('breadcrumb', 'Dashboard Pasien')</span></div>
            </div>
            <div class="topbar-right">
                <div class="topbar-user-dropdown">
                    <button class="topbar-user-btn" onclick="toggleUserDropdown()" aria-expanded="false" id="userDropdownBtn">
                        <div class="topbar-user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                        <span class="topbar-user-name">{{ auth()->user()->name }}</span>
                        <svg class="topbar-user-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                    <div class="dropdown-menu" id="userDropdown">
                        <a href="{{ route('patient.profile') }}" class="dropdown-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item dropdown-item-danger">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="role-content">
            @if (session('success'))
                <div class="alert alert-success">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-error">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="16"></line><line x1="9" y1="9" x2="15" y2="16"></line>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif
            @yield('content')
        </div>
    </div>

    <script>
        function toggleSidebar() { document.getElementById('roleSidebar').classList.toggle('open'); document.getElementById('sidebarOverlay').classList.toggle('open'); }
        function toggleUserDropdown() { const menu = document.getElementById('userDropdown'); const btn = document.getElementById('userDropdownBtn'); menu.classList.toggle('open'); btn.setAttribute('aria-expanded', menu.classList.contains('open')); }
        function toggleDropdown() { document.getElementById('sidebarDropdown').classList.toggle('open'); }
        document.addEventListener('click', function(e) {
            const userDropdown = document.getElementById('userDropdown'); const userBtn = document.getElementById('userDropdownBtn');
            if (userDropdown && !userBtn.contains(e.target) && !userDropdown.contains(e.target)) { userDropdown.classList.remove('open'); userBtn.setAttribute('aria-expanded', 'false'); }
            const sidebarDropdown = document.getElementById('sidebarDropdown'); const sidebarUserBtn = document.getElementById('sidebarUserBtn');
            if (sidebarDropdown && sidebarUserBtn && !sidebarUserBtn.contains(e.target) && !sidebarDropdown.contains(e.target)) { sidebarDropdown.classList.remove('open'); }
        });
    </script>
    @stack('scripts')
</body>
</html>
