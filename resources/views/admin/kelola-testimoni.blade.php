<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Testimoni - Atap Ciater</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2e7d32;
            --primary-light: #4caf50;
            --primary-dark: #1b5e20;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --text: #333333;
            --border: #e0e0e0;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
            --success: #28a745;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: var(--text);
            line-height: 1.6;
        }

        .navbar {
            background-color: var(--primary);
            padding: 0.75rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: var(--white);
            font-size: 1.2rem;
            font-weight: bold;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo img {
            height: 60px;
            width: auto;
            object-fit: contain;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .nav-links a, .nav-links button {
            color: var(--white);
            text-decoration: none;
            transition: all 0.3s ease;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 500;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            position: relative;
        }

        .nav-links a:hover, .nav-links button:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .nav-links a:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--white);
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .nav-links a:hover:before {
            width: 100%;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            color: var(--primary-dark);
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
            padding: 0.75rem 1.25rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color 0.3s ease;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-danger {
            background-color: var(--danger);
            color: var(--white);
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .testimoni-table {
            background: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
            font-size: 0.9rem;
        }

        th {
            background: var(--primary-light);
            color: var(--white);
            font-weight: 600;
            position: sticky;
            top: 0;
            padding: 0.6rem;
            font-size: 0.85rem;
        }

        tr:hover {
            background: var(--light-bg);
        }

        /* Mobile-First Responsive Table */
        @media (max-width: 1024px) {
            .testimoni-table {
                overflow-x: auto;
            }

            table {
                min-width: 900px;
            }
        }

        @media (max-width: 768px) {
            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
                width: 100%;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 0.5rem;
                border: 1px solid var(--border);
                border-radius: 6px;
                overflow: hidden;
                background: var(--white);
            }

            tr:hover {
                background: var(--white);
            }

            td {
                padding: 0.4rem;
                position: relative;
                border: none;
                border-bottom: 1px solid #f0f0f0;
                font-size: 0.8rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 0.5rem;
            }

            td:last-child {
                border-bottom: none;
            }

            td:before {
                content: attr(data-label);
                font-weight: 600;
                background: none;
                color: #333;
                font-size: 0.75rem;
                flex-shrink: 0;
                min-width: 0;
            }

            .rating-stars {
                justify-content: flex-end;
            }
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .no-testimoni {
            text-align: center;
            padding: 3rem;
            color: #666;
        }

        .filter-section {
            background: var(--white);
            padding: 1.25rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .filter-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            align-items: end;
        }

        @media (max-width: 768px) {
            .container {
                overflow-x: auto;
            }

            .testimoni-table {
                min-width: 800px;
            }

            .filter-form {
                grid-template-columns: 1fr;
            }
        }

        .rating-stars {
            color: #ffc107;
        }

        .testimoni-text {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Mobile Navigation Styles */
        .hamburger-menu {
            display: none;
            background: none;
            border: none;
            color: var(--white);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
        }

        .hamburger-menu.active + .nav-links {
            display: flex;
        }

        @media (max-width: 768px) {
            .hamburger-menu {
                display: block;
            }

            .nav-links {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: var(--primary-dark);
                flex-direction: column;
                gap: 0;
                padding: 1rem;
                display: none !important;
                z-index: 999;
                border-top: 2px solid var(--white);
            }

            .nav-links.active {
                display: flex !important;
            }

            .nav-links a,
            .nav-links form {
                padding: 0.75rem 0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                width: 100%;
            }

            .nav-links a:last-child,
            .nav-links form:last-child {
                border-bottom: none;
            }

            .nav-links button {
                text-align: left;
                padding: 0.75rem 0;
                width: 100%;
            }

            .nav-container {
                flex-wrap: wrap;
                position: relative;
            }

            .container {
                overflow-x: auto;
            }

            .testimoni-table {
                min-width: 800px;
            }

            .filter-form {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="{{ asset('images/logo/atap_ciater.png') }}" alt="Atap Ciater Logo">
                <span>Atap Ciater - Admin</span>
            </a>
            <button class="hamburger-menu" id="hamburgerBtn">
                <i class="fas fa-bars"></i>
            </button>
            <div class="nav-links" id="navLinks">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.kelola.paket') }}">Kelola Paket</a>
                <a href="{{ route('admin.kelola.addons') }}">Kelola Addons</a>
                <a href="{{ route('admin.kelola.pesanan') }}">Kelola Pesanan</a>
                <a href="{{ route('admin.kelola.libur') }}">Kelola Libur</a>
                <a href="{{ route('admin.kelola.testimoni') }}">Kelola Testimoni</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Kelola Testimoni Pelanggan</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
            </div>
        @endif

        <div class="testimoni-table">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Asal Kota</th>
                        <th>Testimoni</th>
                        <th>Rating</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $testimonial)
                    <tr>
                        <td data-label="Nama">{{ $testimonial->nama }}</td>
                        <td data-label="Asal Kota">{{ $testimonial->asal_kota ?? '-' }}</td>
                        <td class="testimoni-text" data-label="Testimoni" title="{{ $testimonial->testimoni }}">
                            {{ Str::limit($testimonial->testimoni, 50) }}
                        </td>
                        <td data-label="Rating">
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-half-alt' }}"></i>
                                @endfor
                                <span style="margin-left: 0.5rem; color: #666;">({{ $testimonial->rating }})</span>
                            </div>
                        </td>
                        <td data-label="Tanggal">{{ $testimonial->created_at->format('d/m/Y') }}</td>
                        <td data-label="Aksi">
                            <form action="{{ route('admin.testimoni.hapus', $testimonial->id_testimonial) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?')" title="Hapus Testimoni">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="no-testimoni">
                            <i class="fas fa-comment-slash" style="font-size: 4rem; margin-bottom: 1rem; color: #ccc;"></i>
                            <h3>Belum ada testimoni</h3>
                            <p>Testimoni dari pelanggan akan muncul di sini</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const navLinks = document.getElementById('navLinks');

        // Mobile Navigation Toggle
        hamburgerBtn.addEventListener('click', function() {
            navLinks.classList.toggle('active');
            hamburgerBtn.classList.toggle('active');
        });

        // Close menu when clicking on a link
        navLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function() {
                navLinks.classList.remove('active');
                hamburgerBtn.classList.remove('active');
            });
        });
    </script>
</body>
</html>
