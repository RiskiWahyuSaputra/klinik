<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Staff') - Klinik Mon Cheri</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --sidebar-w: 270px;
            --color-pink: #FFB6C1;
            --color-pink-dark: #FF69B4;
            --color-gold: #D4AF37;
            --color-gold-light: #F0E68C;
            --sidebar-bg: #1a0f1c;
            --sidebar-hover: rgba(255, 182, 193, 0.08);
            --sidebar-active: rgba(255, 182, 193, 0.15);
            --success: #22C55E;
            --warning: #F59E0B;
            --danger: #EF4444;
            --bg-page: #F8F9FC;
            --text-heading: #1a1a2e;
            --text-body: #4a4a6a;
            --text-muted: #8e8ea0;
            --border: #eef0f5;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-page);
            min-height: 100vh;
            display: flex;
            color: var(--text-body);
        }

        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; color: var(--text-heading); }

        .role-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-w);
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
        .role-sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }

        .sidebar-brand {
            padding: 22px 18px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            flex-shrink: 0;
        }
        .sidebar-brand-link {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #fff;
        }
        .sidebar-brand-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--color-pink), var(--color-pink-dark));
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; font-weight: 700; flex-shrink: 0;
            font-family: 'Poppins', sans-serif;
            box-shadow: 0 4px 12px rgba(255, 105, 180, 0.3);
        }
        .sidebar-brand-text { display: flex; flex-direction: column; }
        .sidebar-brand-name { font-family: 'Poppins', sans-serif; font-size: 17px; font-weight: 700; color: #fff; line-height: 1.2; }
        .sidebar-brand-sub { font-size: 10px; text-transform: uppercase; letter-spacing: 1.8px; color: rgba(255,255,255,0.4); font-weight: 500; }

        .sidebar-nav { padding: 10px 10px; flex: 1; }

        .sidebar-label {
            font-size: 10px; text-transform: uppercase; letter-spacing: 1.2px;
            color: rgba(255,255,255,0.25); font-weight: 600;
            padding: 14px 12px 6px;
        }

        .sidebar-link {
            display: flex; align-items: center; gap: 12px;
            padding: 9px 12px; border-radius: 8px;
            color: rgba(255,255,255,0.6); text-decoration: none;
            font-size: 14px; font-weight: 500; cursor: pointer;
            transition: all 0.2s ease; margin-bottom: 2px;
            position: relative;
        }
        .sidebar-link:hover { background: var(--sidebar-hover); color: #fff; }

        .sidebar-link.active {
            background: var(--sidebar-active);
            color: var(--color-pink);
        }
        .sidebar-link.active::before {
            content: '';
            position: absolute; left: -10px; top: 50%; transform: translateY(-50%);
            width: 3px; height: 20px;
            background: linear-gradient(180deg, var(--color-pink), var(--color-gold));
            border-radius: 0 3px 3px 0;
        }

        .sidebar-link-icon {
            width: 34px; height: 34px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; flex-shrink: 0;
            transition: all 0.2s ease; background: rgba(255,255,255,0.05);
        }
        .sidebar-link:hover .sidebar-link-icon { background: rgba(255, 182, 193, 0.15); }
        .sidebar-link.active .sidebar-link-icon {
            background: linear-gradient(135deg, rgba(255, 182, 193, 0.2), rgba(212, 175, 55, 0.15));
            color: var(--color-pink);
        }
        .sidebar-link-text { flex: 1; }
        .sidebar-link-arrow { font-size: 11px; opacity: 0.3; transition: transform 0.2s ease; }
        .sidebar-link:hover .sidebar-link-arrow { opacity: 0.7; transform: translateX(3px); }

        .sidebar-footer {
            padding: 14px 14px;
            border-top: 1px solid rgba(255,255,255,0.06);
            flex-shrink: 0;
        }
        .sidebar-user {
            display: flex; align-items: center; gap: 10px;
            padding: 8px; border-radius: 8px;
            transition: background 0.2s ease; cursor: pointer;
        }
        .sidebar-user:hover { background: var(--sidebar-hover); }
        .sidebar-user-avatar {
            width: 34px; height: 34px; border-radius: 8px;
            background: linear-gradient(135deg, var(--color-pink), var(--color-gold));
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 600; color: #fff; flex-shrink: 0;
            font-family: 'Poppins', sans-serif;
        }
        .sidebar-user-info { flex: 1; min-width: 0; }
        .sidebar-user-name { font-size: 13px; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .sidebar-user-role { font-size: 11px; color: rgba(255,255,255,0.4); }

        .sidebar-overlay {
            position: fixed; inset: 0; background: rgba(0,0,0,0.4);
            z-index: 999; opacity: 0; visibility: hidden;
            transition: all 0.3s ease; backdrop-filter: blur(4px);
        }
        .sidebar-overlay.open { opacity: 1; visibility: visible; }

        .role-main {
            margin-left: var(--sidebar-w);
            flex: 1; min-height: 100vh; display: flex; flex-direction: column;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .role-topbar {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 0 28px; height: 60px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
        }

        .topbar-left { display: flex; align-items: center; gap: 14px; }

        .topbar-hamburger {
            display: none; width: 36px; height: 36px;
            border: none; background: #F3F4F6; border-radius: 8px;
            cursor: pointer; align-items: center; justify-content: center;
            transition: all 0.2s ease; color: var(--text-muted);
        }
        .topbar-hamburger:hover { background: #E5E7EB; }

        .topbar-breadcrumb { font-size: 13px; color: var(--text-muted); font-weight: 500; }
        .topbar-breadcrumb span { color: var(--text-heading); font-weight: 600; font-family: 'Poppins', sans-serif; }

        .topbar-right { display: flex; align-items: center; gap: 10px; }

        .topbar-user-dropdown { position: relative; }

        .topbar-user-btn {
            display: flex; align-items: center; gap: 8px;
            padding: 4px 10px 4px 4px; border: none;
            background: #F3F4F6; border-radius: 8px;
            cursor: pointer; transition: all 0.2s ease;
        }
        .topbar-user-btn:hover { background: #E5E7EB; }

        .topbar-user-avatar {
            width: 30px; height: 30px; border-radius: 7px;
            background: linear-gradient(135deg, var(--color-pink), var(--color-gold));
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 600; color: #fff;
            font-family: 'Poppins', sans-serif;
        }
        .topbar-user-name { font-size: 13px; font-weight: 500; color: var(--text-heading); }
        .topbar-user-chevron { font-size: 10px; color: var(--text-muted); transition: transform 0.2s ease; }
        .topbar-user-btn[aria-expanded="true"] .topbar-user-chevron { transform: rotate(180deg); }

        .dropdown-menu {
            position: absolute; top: calc(100% + 6px); right: 0;
            background: #fff; border-radius: 10px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            min-width: 190px; padding: 5px;
            opacity: 0; visibility: hidden; transform: translateY(-6px);
            transition: all 0.2s ease; z-index: 200;
            border: 1px solid var(--border);
        }
        .dropdown-menu.open { opacity: 1; visibility: visible; transform: translateY(0); }

        .dropdown-item {
            display: flex; align-items: center; gap: 8px;
            padding: 8px 10px; border-radius: 7px;
            color: var(--text-body); text-decoration: none; font-size: 13px; font-weight: 500;
            transition: all 0.15s ease; cursor: pointer;
            border: none; background: none; width: 100%; text-align: left;
        }
        .dropdown-item:hover { background: #F3F4F6; color: var(--text-heading); }
        .dropdown-item-danger:hover { background: #FEF2F2; color: var(--danger); }
        .dropdown-divider { height: 1px; background: var(--border); margin: 4px 5px; }

        .role-content {
            flex: 1; padding: 24px 28px 40px;
        }

        .card {
            background: #fff; border-radius: 12px;
            border: 1px solid var(--border);
            transition: box-shadow 0.25s ease;
        }

        .stat-card {
            background: #fff; border-radius: 12px; padding: 20px;
            border: 1px solid var(--border);
            transition: all 0.25s ease; position: relative; overflow: hidden;
        }
        .stat-card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
            border-color: #D1D5DB;
        }
        .stat-card-icon {
            width: 44px; height: 44px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;
        }
        .stat-card-icon.pink { background: #fce7f3; color: #db2777; }
        .stat-card-icon.gold { background: #fef9c3; color: #a16207; }
        .stat-card-icon.blue { background: #DBEAFE; color: #2563EB; }
        .stat-card-icon.green { background: #DCFCE7; color: #16A34A; }
        .stat-card-icon.purple { background: #F3E8FF; color: #7C3AED; }

        .data-table { width: 100%; border-collapse: collapse; }
        .data-table thead th {
            text-align: left; padding: 12px 16px;
            font-size: 11px; font-weight: 600; text-transform: uppercase;
            letter-spacing: 0.4px; color: var(--text-muted);
            background: #F9FAFB; border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }
        .data-table tbody tr { border-bottom: 1px solid #F3F4F6; transition: background 0.15s ease; }
        .data-table tbody tr:last-child { border-bottom: none; }
        .data-table tbody tr:hover { background: #F9FAFB; }
        .data-table tbody td { padding: 12px 16px; font-size: 13px; color: var(--text-body); vertical-align: middle; }

        .badge {
            display: inline-flex; align-items: center; padding: 3px 10px;
            border-radius: 6px; font-size: 11px; font-weight: 600; letter-spacing: 0.2px;
            white-space: nowrap;
        }
        .badge-pink { background: #fce7f3; color: #db2777; }
        .badge-amber { background: #fef9c3; color: #a16207; }
        .badge-blue { background: #DBEAFE; color: #1D4ED8; }
        .badge-green { background: #DCFCE7; color: #15803D; }
        .badge-red { background: #FEE2E2; color: #DC2626; }
        .badge-purple { background: #F3E8FF; color: #7C3AED; }
        .badge-gray { background: #F3F4F6; color: #6B7280; }

        .btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px; border: none; border-radius: 8px;
            font-size: 13px; font-weight: 600; cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none; font-family: 'Inter', sans-serif;
            line-height: 1;
        }
        .btn-primary {
            background: var(--color-pink-dark); color: #fff;
            box-shadow: 0 2px 8px rgba(255, 105, 180, 0.25);
        }
        .btn-primary:hover { background: #e85d9e; }
        .btn-outline {
            background: transparent; color: var(--text-body);
            border: 1px solid var(--border);
        }
        .btn-outline:hover { background: #F9FAFB; border-color: #D1D5DB; }
        .btn-gold {
            background: var(--color-gold); color: #fff;
            box-shadow: 0 2px 8px rgba(212, 175, 55, 0.25);
        }
        .btn-gold:hover { background: #c4a030; }
        .btn-danger {
            background: var(--danger); color: #fff;
        }
        .btn-danger:hover { background: #DC2626; }
        .btn-sm { padding: 6px 12px; font-size: 12px; border-radius: 6px; }
        .btn-xs { padding: 4px 8px; font-size: 11px; border-radius: 5px; }

        .input {
            width: 100%; padding: 9px 14px;
            border: 1px solid var(--border); border-radius: 8px;
            font-size: 14px; color: var(--text-heading); background: #fff;
            outline: none; transition: all 0.2s ease; font-family: 'Inter', sans-serif;
        }
        .input:focus { border-color: var(--color-pink); box-shadow: 0 0 0 3px rgba(255, 182, 193, 0.15); }
        .input::placeholder { color: #9CA3AF; }

        .select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 12px center; padding-right: 36px;
            cursor: pointer;
        }

        .label {
            display: block; font-size: 12px; font-weight: 600; color: var(--text-muted);
            margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.3px;
        }

        .alert {
            padding: 12px 16px; border-radius: 10px;
            font-size: 13px; font-weight: 500;
            display: flex; align-items: center; gap: 8px;
            margin-bottom: 20px;
        }
        .alert-success { background: #DCFCE7; color: #15803D; border: 1px solid #BBF7D0; }
        .alert-error { background: #FEE2E2; color: #DC2626; border: 1px solid #FECACA; }

        .page-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 24px; flex-wrap: wrap; gap: 14px;
        }
        .page-title { font-size: 22px; font-weight: 700; letter-spacing: -0.3px; }
        .page-subtitle { font-size: 14px; color: var(--text-muted); margin-top: 2px; }

        .section-header {
            display: flex; align-items: center; gap: 10px;
            padding-bottom: 14px; margin-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }
        .section-title { font-size: 16px; font-weight: 600; font-family: 'Poppins', sans-serif; }

        .pagination-wrap { margin-top: 20px; }
        .pagination-wrap nav { display: flex; align-items: center; justify-content: center; gap: 3px; }
        .pagination-wrap a, .pagination-wrap span {
            display: inline-flex; align-items: center; justify-content: center;
            min-width: 34px; height: 34px; padding: 0 7px; border-radius: 8px;
            font-size: 13px; font-weight: 500; color: var(--text-body);
            background: #fff; border: 1px solid var(--border);
            text-decoration: none; transition: all 0.2s ease;
        }
        .pagination-wrap a:hover { background: #F9FAFB; border-color: #D1D5DB; }
        .pagination-wrap span[aria-current="page"] {
            background: linear-gradient(135deg, var(--color-pink), var(--color-pink-dark));
            color: #fff; border-color: transparent;
        }
        .pagination-wrap .disabled span { opacity: 0.4; cursor: not-allowed; background: #F9FAFB; }

        .empty-state {
            text-align: center; padding: 48px 20px;
        }
        .empty-state-icon {
            width: 64px; height: 64px; margin: 0 auto 16px;
            border-radius: 16px; display: flex; align-items: center; justify-content: center;
            background: #F3F4F6;
        }
        .empty-state-title { font-size: 16px; font-weight: 600; color: var(--text-heading); margin-bottom: 4px; }
        .empty-state-desc { font-size: 13px; color: var(--text-muted); }

        @media (max-width: 1024px) {
            .role-content { padding: 20px; }
            .role-topbar { padding: 0 20px; }
        }

        @media (max-width: 768px) {
            .role-sidebar { transform: translateX(-100%); }
            .role-sidebar.open { transform: translateX(0); }
            .role-main { margin-left: 0; }
            .role-content { padding: 16px; }
            .role-topbar { padding: 0 16px; height: 56px; }
            .topbar-hamburger { display: flex; }
            .page-header { flex-direction: column; align-items: stretch; }
            .page-title { font-size: 20px; }
            .stat-card { padding: 16px; }

            .data-table thead { display: none; }
            .data-table tbody tr {
                display: block; padding: 14px;
                border: 1px solid var(--border); border-radius: 10px;
                margin-bottom: 10px; background: #fff;
            }
            .data-table tbody td {
                display: flex; justify-content: space-between; align-items: center;
                padding: 6px 0; border: none; font-size: 13px;
            }
            .data-table tbody td::before {
                content: attr(data-label);
                font-weight: 600; color: var(--text-muted);
                font-size: 11px; text-transform: uppercase; letter-spacing: 0.3px;
            }
            .data-table tbody tr:hover { background: #fff; }
            .data-table tbody td:last-child { padding-bottom: 0; }
            .data-table tbody td:first-child { padding-top: 0; }
        }

        @media (max-width: 480px) {
            .role-content { padding: 12px; }
            .topbar-user-name { display: none; }
        }
    </style>
    @stack('styles')
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <aside class="role-sidebar" id="roleSidebar">
        <div class="sidebar-brand">
            <a href="{{ route('staff.dashboard') }}" class="sidebar-brand-link">
                <div class="sidebar-brand-icon">M</div>
                <div class="sidebar-brand-text">
                    <span class="sidebar-brand-name">Mon Cheri</span>
                    <span class="sidebar-brand-sub">Staff Panel</span>
                </div>
            </a>
        </div>

        <nav class="sidebar-nav" aria-label="Menu staff">
            <div class="sidebar-label">Menu</div>

            <a href="{{ route('staff.dashboard') }}" class="sidebar-link {{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">
                <div class="sidebar-link-icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/>
                        <rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/>
                    </svg>
                </div>
                <span class="sidebar-link-text">Dashboard</span>
                <span class="sidebar-link-arrow">→</span>
            </a>

            <a href="{{ route('appointments.index') }}" class="sidebar-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                <div class="sidebar-link-icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                </div>
                <span class="sidebar-link-text">Appointment</span>
                <span class="sidebar-link-arrow">→</span>
            </a>

            <a href="{{ route('staff.patients') }}" class="sidebar-link {{ request()->routeIs('staff.patients*') ? 'active' : '' }}">
                <div class="sidebar-link-icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <span class="sidebar-link-text">Pasien</span>
                <span class="sidebar-link-arrow">→</span>
            </a>

            <a href="{{ route('staff.payments') }}" class="sidebar-link {{ request()->routeIs('staff.payments*') ? 'active' : '' }}">
                <div class="sidebar-link-icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                    </svg>
                </div>
                <span class="sidebar-link-text">Pembayaran</span>
                <span class="sidebar-link-arrow">→</span>
            </a>
        </nav>

        @auth
        <div class="sidebar-footer">
            <div class="sidebar-user" onclick="toggleDropdown()" id="sidebarUserBtn" tabindex="0" role="button" aria-label="Menu pengguna">
                <div class="sidebar-user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                <div class="sidebar-user-info">
                    <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
                    <div class="sidebar-user-role">Staff</div>
                </div>
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: rgba(255,255,255,0.25); flex-shrink: 0;">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </div>
            <div class="dropdown-menu" id="sidebarDropdown" style="left: 0; right: auto; bottom: calc(100% + 8px); top: auto;">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item dropdown-item-danger" aria-label="Logout">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
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
                <button class="topbar-hamburger" onclick="toggleSidebar()" aria-label="Buka menu sidebar">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>
                </button>
                <div class="topbar-breadcrumb"><span>@yield('breadcrumb', 'Dashboard Staff')</span></div>
            </div>
            <div class="topbar-right">
                <div class="topbar-user-dropdown">
                    <button class="topbar-user-btn" onclick="toggleUserDropdown()" aria-expanded="false" id="userDropdownBtn" aria-label="Menu pengguna">
                        <div class="topbar-user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                        <span class="topbar-user-name">{{ auth()->user()->name }}</span>
                        <svg class="topbar-user-chevron" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                    <div class="dropdown-menu" id="userDropdown">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item dropdown-item-danger">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-error">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif
            @yield('content')
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('roleSidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }
        function toggleUserDropdown() {
            const menu = document.getElementById('userDropdown');
            const btn = document.getElementById('userDropdownBtn');
            menu.classList.toggle('open');
            btn.setAttribute('aria-expanded', menu.classList.contains('open'));
        }
        function toggleDropdown() {
            document.getElementById('sidebarDropdown').classList.toggle('open');
        }
        document.addEventListener('click', function(e) {
            const userDropdown = document.getElementById('userDropdown');
            const userBtn = document.getElementById('userDropdownBtn');
            if (userDropdown && !userBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.remove('open');
                userBtn.setAttribute('aria-expanded', 'false');
            }
            const sidebarDropdown = document.getElementById('sidebarDropdown');
            const sidebarUserBtn = document.getElementById('sidebarUserBtn');
            if (sidebarDropdown && sidebarUserBtn && !sidebarUserBtn.contains(e.target) && !sidebarDropdown.contains(e.target)) {
                sidebarDropdown.classList.remove('open');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
