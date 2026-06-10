<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FUJI Inventory</title>

    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #1f2937;
        }
        form {
    margin: 0 0 18px 0;
}

form input,
form select {
    margin-bottom: 10px;
}

form button,
form a,
.btn-primary,
.btn-secondary {
    display: inline-block;
    margin-top: 8px;
    margin-right: 8px;
}

.table-card,
table {
    margin-top: 18px;
}

.content > form,
.content form:first-of-type {
    background: white;
    padding: 16px;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    box-shadow: 0 3px 10px rgba(0,0,0,.04);
}

.content a[href*="create"],
.content a[href*="tambah"],
.content a.btn-primary {
    display: inline-block;
    margin: 12px 0 16px 0;
}

.page-head {
    margin-bottom: 26px;
}

.content table {
    clear: both;
}

td, th {
    vertical-align: middle;
}
        
        .app { display: flex; min-height: 100vh; }

        .sidebar {
            width: 240px;
            background: #1e3a5f;
            color: white;
            padding: 18px 14px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 18px;
            border-bottom: 1px solid rgba(255,255,255,.15);
            margin-bottom: 18px;
        }

        .brand img {
            width: 42px;
            height: 42px;
            object-fit: contain;
            background: white;
            border-radius: 10px;
            padding: 4px;
        }

        .brand-title {
            font-weight: bold;
            font-size: 18px;
        }

        .brand-sub {
            font-size: 11px;
            opacity: .75;
        }

        .nav-title {
            font-size: 12px;
            font-weight: bold;
            opacity: .7;
            margin: 18px 8px 8px;
        }

        .nav-link {
            display: block;
            color: #e5edf7;
            text-decoration: none;
            padding: 11px 12px;
            border-radius: 10px;
            margin-bottom: 4px;
            font-size: 14px;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255,255,255,.15);
            color: white;
        }

        .main {
            margin-left: 240px;
            width: calc(100% - 240px);
        }

        .topbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
        }

        .top-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .top-left img {
            width: 42px;
            height: 42px;
            object-fit: contain;
        }

        .top-title {
            font-weight: bold;
            font-size: 15px;
        }

        .top-sub {
            font-size: 12px;
            color: #6b7280;
        }

        .user-box {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 36px;
            height: 36px;
            background: #2563eb;
            color: white;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-weight: bold;
        }

        .logout-btn {
            border: 1px solid #d1d5db;
            background: white;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
        }

        .content {
            padding: 28px;
        }

        .page-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }

        .page-head h1 {
            margin: 0;
            font-size: 24px;
        }

        .page-head p {
            margin: 4px 0 0;
            color: #6b7280;
            font-size: 14px;
        }

        .card, .panel {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            box-shadow: 0 3px 10px rgba(0,0,0,.04);
        }

        .card {
            padding: 20px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
            border: 0;
            border-radius: 9px;
            padding: 10px 16px;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-secondary {
            background: white;
            color: #374151;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            padding: 10px 16px;
            text-decoration: none;
            cursor: pointer;
        }

        input, select, textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            background: #f8fafc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            text-align: left;
            font-size: 12px;
            color: #6b7280;
            padding: 13px;
            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 13px;
            border-bottom: 1px solid #eef2f7;
            font-size: 14px;
        }

        .table-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,.04);
        }
    </style>
</head>

<body>
<div class="app">

    <aside class="sidebar">
        <div class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <div>
                <div class="brand-title">FUJI</div>
                <div class="brand-sub">Inventory App</div>
            </div>
        </div>

        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Beranda</a>

        <div class="nav-title">MASTER DATA</div>
        <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">Kategori</a>
        <a href="{{ route('suppliers.index') }}" class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">Supplier</a>
        <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">Produk</a>

        <div class="nav-title">TRANSAKSI</div>
        <a href="{{ route('stock-ins.index') }}" class="nav-link {{ request()->routeIs('stock-ins.*') ? 'active' : '' }}">Stok Masuk</a>
        <a href="{{ route('stock-outs.index') }}" class="nav-link {{ request()->routeIs('stock-outs.*') ? 'active' : '' }}">Stok Keluar</a>

        <div class="nav-title">LAPORAN</div>
        <a href="{{ route('reports.stock') }}" class="nav-link {{ request()->routeIs('reports.stock') ? 'active' : '' }}">Laporan Stok</a>
    </aside>

    <main class="main">
        <header class="topbar">
            <div class="top-left">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                <div>
                    <div class="top-title">Sistem Inventaris Barang</div>
                    <div class="top-sub">Fuji Photocopy</div>
                </div>
            </div>

            <div class="user-box">
                <div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
                <div>
                    <div style="font-weight:bold;">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div style="font-size:12px;color:#6b7280;">{{ ucfirst(auth()->user()->role ?? 'admin') }}</div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout-btn">Logout</button>
                </form>
            </div>
        </header>

        <section class="content">
            <div class="page-head">
                <div>
                    <h1>@yield('page_title', 'Dashboard')</h1>
                    <p>@yield('page_desc', 'Sistem inventaris barang Fuji Photocopy')</p>
                </div>

                @yield('page_action')
            </div>

            @yield('content')
        </section>
    </main>

</div>
</body>
</html>