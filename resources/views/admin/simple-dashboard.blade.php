<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Incident Report</title>

    <style>
        /* =========================================
           1. RESET & VARIABLE (Warna Abu-abu Tailwind)
           ========================================= */
        :root {
            --bg-body: #f9fafb;       /* gray-50 */
            --bg-white: #ffffff;
            --border-color: #e5e7eb;  /* gray-200 */
            --text-main: #111827;     /* gray-900 */
            --text-muted: #4b5563;    /* gray-600 */
            --text-light: #9ca3af;    /* gray-400 */

            --primary-dark: #1f2937;  /* gray-800 */
            --primary-med: #374151;   /* gray-700 */
            --primary-light: #4b5563; /* gray-600 */

            --danger: #dc2626;        /* red-600 */
            --danger-hover: #b91c1c;  /* red-700 */

            /* Warna Badge */
            --badge-yellow-bg: #fef3c7; --badge-yellow-text: #92400e;
            --badge-red-bg: #fee2e2;    --badge-red-text: #991b1b;
            --badge-gray-bg: #f3f4f6;   --badge-gray-text: #4b5563;
            --badge-dark-bg: #1f2937;   --badge-dark-text: #ffffff;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
        }

        a { text-decoration: none; }

        /* Container Utama */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* =========================================
           2. NAVBAR & HEADER
           ========================================= */
        .navbar {
            background-color: var(--bg-white);
            border-bottom: 1px solid var(--border-color);
            height: 64px;
            display: flex;
            align-items: center;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .logo-area img {
            height: 40px;
            width: auto;
            margin-right: 16px;
            display: block; /* Memastikan tidak ada gap bawah */
        }

        .nav-actions {
            display: flex;
            gap: 16px;
            align-items: center; /* Pastikan sejajar vertikal */
        }

        .btn-nav {
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
            white-space: nowrap; /* Mencegah teks turun baris */
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-register { background-color: var(--primary-med); }
        .btn-register:hover { background-color: var(--primary-light); }

        .btn-logout { background-color: var(--primary-light); }
        .btn-logout:hover { background-color: #6b7280; }

        /* Greeting Section */
        .greeting-bar {
            background-color: var(--bg-white);
            border-bottom: 1px solid var(--border-color);
            padding: 20px 0;
            margin-bottom: 30px;
        }
        .greeting-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .greeting-text { font-size: 18px; font-weight: 600; margin: 0; }
        .clock-text { font-size: 18px; font-weight: 600; color: var(--text-main); }

        /* =========================================
           3. STATISTICS CARDS (GRID SYSTEM)
           ========================================= */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* Default 4 kolom */
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background-color: var(--bg-white);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 24px;
            display: flex;
            align-items: center;
            transition: box-shadow 0.3s;
        }
        .stat-card:hover { box-shadow: 0 4px 6px rgba(0,0,0,0.05); }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            font-weight: bold;
            flex-shrink: 0;
            margin-right: 16px;
        }

        /* Warna Icon Berbeda tiap kartu */
        .icon-dark { background-color: var(--primary-dark); }
        .icon-med { background-color: var(--primary-light); }
        .icon-light { background-color: var(--primary-med); }
        .icon-black { background-color: #111827; }

        .stat-info p.label { font-size: 14px; color: var(--text-muted); margin: 0; font-weight: 500; }
        .stat-info p.value { font-size: 24px; color: var(--text-main); margin: 0; font-weight: 700; }

        /* =========================================
           4. TABLE SECTION
           ========================================= */
        .table-card {
            background-color: var(--bg-white);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden; /* Agar sudut tabel tdk lancip */
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .table-header {
            padding: 16px 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .table-title { font-size: 18px; font-weight: 600; margin: 0; }

        .btn-export {
            background-color: var(--primary-dark);
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-export:hover { background-color: var(--primary-med); }

        /* Responsive Table Wrapper */
        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px; /* Agar tidak hancur di HP */
        }

        thead { background-color: #f9fafb; }

        th {
            padding: 12px 24px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        td {
            padding: 16px 24px;
            white-space: nowrap;
            font-size: 14px;
            color: var(--text-main);
            border-bottom: 1px solid var(--border-color);
        }

        tbody tr:hover { background-color: #f9fafb; }

        /* Status Badges */
        .badge {
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-warning { background-color: var(--badge-yellow-bg); color: var(--badge-yellow-text); }
        .badge-danger  { background-color: var(--badge-red-bg); color: var(--badge-red-text); }
        .badge-gray    { background-color: var(--badge-gray-bg); color: var(--badge-gray-text); }
        .badge-dark    { background-color: var(--badge-dark-bg); color: var(--badge-dark-text); }

        /* Action Buttons */
        .action-container { display: flex; gap: 8px; }

        .btn-view {
            background-color: var(--primary-dark);
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }
        .btn-view:hover { background-color: var(--primary-med); }

        .btn-delete {
            background-color: var(--danger);
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            border: none;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
        }
        .btn-delete:hover { background-color: var(--danger-hover); }

        /* Pagination Wrapper */
        .pagination-wrapper {
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        /* =========================================
           5. RESPONSIVE MEDIA QUERIES
           ========================================= */

        /* Tablet (max-width: 1024px) */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Mobile (max-width: 640px) */
        @media (max-width: 640px) {
            /* Navbar Adjustment untuk Mobile */
            .navbar {
                padding: 0 10px; /* Padding navbar diperkecil */
                height: 56px;    /* Sedikit lebih pendek di mobile */
            }
            .container {
                padding: 0 12px;
            }

            .logo-area img {
                height: 32px; /* Kecilkan logo agar seimbang dengan tombol */
                margin-right: 10px;
            }

            .nav-actions {
                gap: 8px; /* Rapatkan jarak antar tombol */
            }

            .btn-nav {
                padding: 6px 10px; /* Kecilkan padding tombol */
                font-size: 11px;   /* Kecilkan font tombol */
            }

            /* Dashboard Layout */
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .greeting-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .table-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="container nav-content">
            <div class="logo-area">
                <img src="{{ asset('img/dynaplast-logo.jpg') }}" alt="Dynaplast Logo">
            </div>
            <div class="nav-actions">
                <a href="{{ route('admin.register.form') }}" class="btn-nav btn-register">
                    Register Admin
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline; margin:0;">
                    @csrf
                    <button type="submit" class="btn-nav btn-logout">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="greeting-bar">
        <div class="container greeting-content">
            <h2 class="greeting-text">
                @php
                    $hour = now()->hour;
                    $greeting = ($hour >= 6 && $hour < 10) ? 'Selamat pagi' :
                               (($hour >= 10 && $hour < 15) ? 'Selamat siang' :
                               (($hour >= 15 && $hour < 19) ? 'Selamat sore' : 'Selamat malam'));
                @endphp
                {{ $greeting }}, {{ auth()->user()->name }}
            </h2>
            <div class="clock-text">
                {{ now()->format('H:i') }}
            </div>
        </div>
    </div>

    <div class="container">

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon icon-dark">T</div>
                <div class="stat-info">
                    <p class="label">Total Laporan</p>
                    <p class="value">{{ $reports->total() ?? 0 }}</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-med">N</div>
                <div class="stat-info">
                    <p class="label">Laporan Baru</p>
                    <p class="value">{{ $reports->where('status', 'baru')->count() ?? 0 }}</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-light">P</div>
                <div class="stat-info">
                    <p class="label">Sedang Diproses</p>
                    <p class="value">{{ $reports->where('status', 'proses')->count() ?? 0 }}</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-black">S</div>
                <div class="stat-info">
                    <p class="label">Selesai</p>
                    <p class="value">{{ $reports->where('status', 'selesai')->count() ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="table-card">
            <div class="table-header">
                <h3 class="table-title">Daftar Laporan</h3>
                <a href="{{ route('admin.export') }}" class="btn-export">
                    <span>📊</span> Export Excel
                </a>
            </div>

            <div style="padding: 24px;">
                @if ($reports->isEmpty())
                    <div style="text-align: center; padding: 48px 0;">
                        <div style="width: 64px; height: 64px; background: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                            <span style="font-size: 24px;">📄</span>
                        </div>
                        <p style="color: #4b5563; margin-bottom: 16px;">Belum ada laporan yang masuk</p>
                        <a href="{{ route('report.create') }}" class="btn-nav btn-register" style="display: inline-block;">
                            Buat Laporan Pertama
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelapor</th>
                                    <th>Departemen</th>
                                    <th>Status Kejadian</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $index => $report)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $report->nama_pelapor }}</td>
                                        <td>{{ $report->departemen }}</td>
                                        <td>
                                            <span class="badge
                                                @if ($report->status_kejadian == 'hampir_celaka') badge-warning
                                                @elseif($report->status_kejadian == 'kecelakaan') badge-danger
                                                @else badge-gray @endif">
                                                {{ ucfirst(str_replace('_', ' ', $report->status_kejadian ?? 'Belum ada status')) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge
                                                @if ($report->status == 'baru') badge-gray
                                                @elseif($report->status == 'proses') badge-gray
                                                @elseif($report->status == 'selesai') badge-dark
                                                @else badge-gray @endif">
                                                {{ ucfirst($report->status ?? 'Belum ada status') }}
                                            </span>
                                        </td>
                                        <td style="color: #4b5563;">
                                            {{ $report->created_at ? \Carbon\Carbon::parse($report->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d M Y, H:i:s') . ' WIB' : '-' }}
                                        </td>
                                        <td>
                                            <div class="action-container">
                                                <a href="{{ route('admin.reports.show', $report) }}" class="btn-view">
                                                    Lihat
                                                </a>
                                                <form method="POST" action="{{ route('admin.reports.destroy', $report) }}"
                                                      onsubmit="return confirm('Yakin hapus data ini?')" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-delete">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination-wrapper">
                        {{ $reports->links() }}
                    </div>
                @endif
            </div>
        </div>

        <br><br> </div>

</body>
</html>
