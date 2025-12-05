<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name','Reservasi Penginapan') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        :root {
            --bg-main: #050404;
            --bg-sidebar: #0d0907;
            --bg-surface: #120c09;
            --accent: #f5d7a1;
            --accent-soft: #f3e3cf;
            --text-main: #f8f3ee;
            --text-muted: #a2958b;
        }

        * { box-sizing: border-box; }

        html, body { margin:0;padding:0; }

        body {
            min-height:100vh;
            background:
                radial-gradient(circle at top, #3a2418 0, transparent 55%),
                radial-gradient(circle at bottom, #120c09 0, #050404 70%);
            color:var(--text-main);
            font-family:system-ui,-apple-system,BlinkMacSystemFont,"SF Pro Text","Segoe UI",sans-serif;
            display:flex;
        }

        a { text-decoration:none;color:inherit; }

        /* ===== SIDEBAR DESKTOP ===== */

        .sidebar {
            width:260px;
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.06), transparent 60%),
                linear-gradient(180deg, rgba(7,5,4,0.98), rgba(2,1,1,0.99));
            border-right:1px solid rgba(255,255,255,0.06);
            padding:18px 20px 18px;
            display:flex;
            flex-direction:column;
            gap:22px;
            position:sticky;
            top:0;
            height:100vh;
            backdrop-filter:blur(20px);
            box-shadow:0 0 40px rgba(0,0,0,0.85);
            z-index:40;
        }

        .sidebar-main {
            display:flex;
            flex-direction:column;
            gap:20px;
        }

        .sidebar-brand-wrap {
            position:relative;
            padding-left:10px;
        }
        .sidebar-brand-wrap::before {
            content:'';
            position:absolute;
            left:0;
            top:4px;
            bottom:4px;
            width:2px;
            border-radius:999px;
            background:linear-gradient(180deg,#f5d7a1,#a46d3b);
        }

        .sidebar-brand {
            font-size:13px;
            letter-spacing:.2em;
            text-transform:uppercase;
            color:#f0e0cc;
        }
        .sidebar-title {
            font-size:11px;
            color:var(--text-muted);
        }

        .sidebar-section-label {
            font-size:11px;
            text-transform:uppercase;
            letter-spacing:.16em;
            color:var(--text-muted);
            margin-bottom:6px;
        }

        .sidebar-nav {
            display:flex;
            flex-direction:column;
            gap:4px;
        }

        .nav-item {
            display:flex;
            align-items:center;
            gap:10px;
            padding:9px 12px;
            border-radius:999px;
            font-size:13px;
            color:var(--text-muted);
            cursor:pointer;
            transition:background .18s ease,color .18s ease,transform .12s ease,box-shadow .18s ease;
        }

        .nav-item span.icon {
            width:24px;
            height:24px;
            border-radius:999px;
            background:radial-gradient(circle at 30% 30%, #f5d7a1 0, #493026 35%, #120b08 70%);
            display:inline-flex;
            align-items:center;
            justify-content:center;
            font-size:11px;
            box-shadow:0 4px 10px rgba(0,0,0,0.8);
        }

        .nav-item.active {
            background:linear-gradient(90deg,#3a2418,#23140f);
            color:var(--accent-soft);
            transform:translateX(2px);
            box-shadow:0 10px 26px rgba(0,0,0,0.85);
        }

        .nav-item:hover {
            background:#22130e;
            color:var(--text-main);
        }

        .sidebar-footer {
            margin-top:auto;
            display:flex;
            flex-direction:column;
            gap:8px;
            font-size:13px;
            color:var(--text-muted);
        }

        .btn-nav {
            border-radius:999px;
            border:none;
            background:linear-gradient(135deg,#f5d7a1,#f3c77a);
            color:#2b1b13;
            font-weight:600;
            padding:7px 16px;
            font-size:13px;
            cursor:pointer;
            box-shadow:0 10px 26px rgba(0,0,0,0.8);
            transition:transform .15s ease,box-shadow .15s ease,background .15s ease;
        }
        .btn-nav:hover {
            transform:translateY(-1px);
            box-shadow:0 12px 30px rgba(0,0,0,0.9);
        }

        /* ===== MAIN CONTENT ===== */

        .app-shell {
            flex:1;
            padding:20px 26px 26px;
            min-width:0;
        }

        .btn-pill {
            border-radius:999px;
            border:none;
            background:var(--accent);
            color:#2b1b13;
            font-weight:600;
            padding:8px 18px;
            font-size:13px;
            cursor:pointer;
            box-shadow:0 8px 22px rgba(0,0,0,0.7);
            transition:transform .15s ease,box-shadow .15s ease,background .15s ease;
        }
        .btn-pill:hover {
            transform:translateY(-1px);
            box-shadow:0 10px 26px rgba(0,0,0,0.8);
        }

        .table-wrapper { width:100%; }
        .room-card img { display:block; }
        .room-detail-img { display:block; }

        /* ===== MOBILE NAVBAR / DROPDOWN ===== */

        .mobile-toggle {
            display:none;
            width:34px;
            height:34px;
            border-radius:999px;
            border:1px solid rgba(255,255,255,0.3);
            background:rgba(15,10,8,0.9);
            align-items:center;
            justify-content:center;
            cursor:pointer;
        }
        .mobile-toggle span {
            width:16px;
            height:2px;
            background:#f5d7a1;
            position:relative;
            display:block;
        }
        .mobile-toggle span::before,
        .mobile-toggle span::after {
            content:'';
            position:absolute;
            left:0;
            width:16px;
            height:2px;
            background:#f5d7a1;
            transition:transform .18s ease,top .18s ease,opacity .18s ease;
        }
        .mobile-toggle span::before { top:-5px; }
        .mobile-toggle span::after { top:5px; }

        .sidebar.collapsed .sidebar-nav,
        .sidebar.collapsed .sidebar-footer {
            display:none;
        }

        .sidebar.collapsed { height:auto; }

        .sidebar.collapsed .mobile-toggle { display:flex; }

        .sidebar.collapsed.open .sidebar-nav,
        .sidebar.collapsed.open .sidebar-footer {
            display:flex;
        }

        .sidebar.collapsed.open .sidebar-nav {
            flex-direction:column;
            margin-top:10px;
        }

        .sidebar.collapsed.open { padding-bottom:12px; }

        .sidebar.collapsed .sidebar-main {
            flex-direction:row;
            align-items:center;
            justify-content:space-between;
        }

        .sidebar.collapsed .sidebar-section-label { display:none; }

        .sidebar.collapsed .mobile-toggle { margin-left:auto; }

        .sidebar.collapsed .sidebar-footer {
            border-top:1px solid rgba(255,255,255,0.06);
            padding-top:8px;
        }

        .sidebar.collapsed .mobile-toggle span.open { background:transparent; }
        .sidebar.collapsed .mobile-toggle span.open::before {
            top:0;
            transform:rotate(45deg);
        }
        .sidebar.collapsed .mobile-toggle span.open::after {
            top:0;
            transform:rotate(-45deg);
        }

        /* ===== RESPONSIVE BREAKPOINTS ===== */

        @media (max-width: 900px) {
            body { flex-direction:column; }

            .sidebar {
                width:100%;
                height:auto;
                position:fixed;
                top:0;
                left:0;
                right:0;
            }

            .app-shell {
                padding:80px 14px 20px;
            }

            .mobile-toggle { display:flex; }

            .hero-shell,
            .content-two-col {
                display:grid;
                grid-template-columns:minmax(0,1fr) !important;
                gap:16px !important;
            }

            .table-wrapper { overflow-x:auto; }
        }

        @media (max-width: 640px) {
            .app-shell { padding:78px 10px 16px; }
            h1,h2 { font-size:18px; }
            .btn-pill { font-size:12px;padding:7px 14px; }
            .auth-card,.form-card {
                max-width:100% !important;
                padding:18px 16px 18px !important;
            }
            .room-card img,.room-detail-img {
                height:160px !important;
            }
        }

        /* grid kamar 1 kolom di layar sangat kecil */
        @media (max-width: 480px) {
            .rooms-grid {
                grid-template-columns: minmax(0, 1fr) !important;
            }
        }
    </style>
</head>
<body>
    <aside class="sidebar collapsed" id="sidebar">
        <div class="sidebar-main">
            <div class="sidebar-brand-wrap">
                <div class="sidebar-brand">RESERVASI PENGINAPAN</div>
                <div class="sidebar-title">Dashboard villa &amp; kamar</div>
            </div>

            <button class="mobile-toggle" id="sidebarToggle" type="button" aria-label="Menu">
                <span id="toggleIcon"></span>
            </button>

            <nav style="flex:1;">
                <div class="sidebar-section-label">Menu</div>
                <div class="sidebar-nav">
                    <a href="{{ route('landing') }}"
                       class="nav-item {{ request()->routeIs('landing') ? 'active' : '' }}">
                        <span class="icon">🏠</span>
                        Beranda
                    </a>

                    @auth
                        @can('isAdmin')
                            <a href="{{ route('admin.rooms.index') }}"
                               class="nav-item {{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}">
                                <span class="icon">🛏</span>
                                Admin kamar
                            </a>
                            <a href="{{ route('admin.reservations.index') }}"
                               class="nav-item {{ request()->routeIs('admin.reservations.*') ? 'active' : '' }}">
                                <span class="icon">📋</span>
                                Admin reservasi
                            </a>
                        @endcan

                        @can('isUser')
                            <a href="{{ route('reservations.my') }}"
                               class="nav-item {{ request()->routeIs('reservations.my') ? 'active' : '' }}">
                                <span class="icon">🧾</span>
                                Reservasi saya
                            </a>
                        @endcan
                    @endauth
                </div>
            </nav>
        </div>

        <div class="sidebar-footer">
            @auth
                <div style="font-size:12px;">
                    Login sebagai <strong>{{ auth()->user()->name }}</strong>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-nav">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-nav" style="text-align:center;display:inline-block;">
                    Login
                </a>
            @endauth
        </div>
    </aside>

    <main class="app-shell">
        @yield('content')
    </main>

    <script>
        (function () {
            const sidebar = document.getElementById('sidebar');
            const toggle  = document.getElementById('sidebarToggle');
            const iconBar = document.getElementById('toggleIcon');

            function applyInitial() {
                if (window.innerWidth <= 900) {
                    sidebar.classList.add('collapsed');
                } else {
                    sidebar.classList.remove('collapsed', 'open');
                    iconBar.classList.remove('open');
                }
            }

            applyInitial();

            window.addEventListener('resize', function () {
                applyInitial();
            });

            toggle.addEventListener('click', function () {
                sidebar.classList.toggle('open');
                iconBar.classList.toggle('open');
            });
        })();
    </script>
</body>
</html>
