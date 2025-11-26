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
            padding: 1rem 0;
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
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 1.25rem;
            align-items: center;
        }

        .nav-links a, .nav-links button {
            color: var(--white);
            text-decoration: none;
            transition: opacity 0.3s ease;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .nav-links a:hover, .nav-links button:hover {
            opacity: 0.85;
        }

        .nav-links a.current {
            font-weight: 700;
            text-decoration: underline;
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

        .btn-success {
            background-color: var(--success);
            color: var(--white);
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-right: 0.5rem;
        }

        .btn-success:hover {
            background-color: #218838;
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
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        th {
            background: var(--primary-light);
            color: var(--white);
            font-weight: 600;
            position: sticky;
            top: 0;
        }

        tr:hover {
            background: var(--light-bg);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: var(--white);
            margin: 5% auto;
            padding: 2rem;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--primary-light);
        }

        .modal-title {
            color: var(--primary-dark);
            margin: 0;
        }

        .close {
            color: #aaa;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            background: none;
            border: none;
        }

        .close:hover {
            color: var(--text);
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        input, textarea, select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--primary);
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

        .status-approved {
            color: var(--success);
            font-weight: bold;
        }

        .status-pending {
            color: var(--warning);
            font-weight: bold;
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
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <i class="fas fa-mountain"></i> Atap Ciater - Admin
            </a>
            <div class="nav-links">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.kelola.paket') }}">Kelola Paket</a>
                <a href="{{ route('admin.kelola.addons') }}">Kelola Addons</a>
                <a href="{{ route('admin.kelola.pesanan') }}">Kelola Pesanan</a>
                <a href="{{ route('admin.kelola.libur') }}">Kelola Libur</a>
                <a href="{{ route('admin.kelola.testimoni') }}" class="current">Kelola Testimoni</a>
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

        <div class="filter-section">
            <h3 style="margin-bottom: 1rem; color: var(--primary-dark);">Filter Testimoni</h3>
            <form method="GET" action="{{ route('admin.kelola.testimoni') }}" class="filter-form">
                <div class="form-group">
                    <label for="filter_status">Status</label>
                    <select id="filter_status" name="filter_status">
                        <option value="">Semua Status</option>
                        <option value="approved" {{ request('filter_status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="pending" {{ request('filter_status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="filter_rating">Rating</label>
                    <select id="filter_rating" name="filter_rating">
                        <option value="">Semua Rating</option>
                        <option value="5" {{ request('filter_rating') == '5' ? 'selected' : '' }}>5 Bintang</option>
                        <option value="4" {{ request('filter_rating') == '4' ? 'selected' : '' }}>4 Bintang</option>
                        <option value="3" {{ request('filter_rating') == '3' ? 'selected' : '' }}>3 Bintang</option>
                        <option value="2" {{ request('filter_rating') == '2' ? 'selected' : '' }}>2 Bintang</option>
                        <option value="1" {{ request('filter_rating') == '1' ? 'selected' : '' }}>1 Bintang</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn-primary" style="width: 100%;">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>

                <div class="form-group">
                    <a href="{{ route('admin.kelola.testimoni') }}" class="btn-primary" style="display: block; text-align: center; background-color: #6c757d;">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="testimoni-table">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Asal Kota</th>
                        <th>Testimoni</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $testimonial)
                    <tr>
                        <td>{{ $testimonial->nama }}</td>
                        <td>{{ $testimonial->asal_kota ?? '-' }}</td>
                        <td class="testimoni-text" title="{{ $testimonial->testimoni }}">
                            {{ Str::limit($testimonial->testimoni, 50) }}
                        </td>
                        <td>
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-half-alt' }}"></i>
                                @endfor
                                <span style="margin-left: 0.5rem; color: #666;">({{ $testimonial->rating }})</span>
                            </div>
                        </td>
                        <td>
                            @if($testimonial->is_approved)
                                <span class="status-approved">
                                    <i class="fas fa-check-circle"></i> Disetujui
                                </span>
                            @else
                                <span class="status-pending">
                                    <i class="fas fa-clock"></i> Menunggu
                                </span>
                            @endif
                        </td>
                        <td>{{ $testimonial->created_at->format('d/m/Y') }}</td>
                        <td>
                            @if(!$testimonial->is_approved)
                            <form action="{{ route('admin.testimoni.approve', $testimonial->id_testimonial) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn-success" title="Setujui Testimoni">
                                    <i class="fas fa-check"></i> Setujui
                                </button>
                            </form>
                            @endif
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
                        <td colspan="7" class="no-testimoni">
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
        // Filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Add any JavaScript functionality needed
        });
    </script>
</body>
</html>
