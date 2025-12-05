<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Libur - Atap Ciater</title>
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

        .btn-edit {
            background-color: #ffc107;
            color: var(--text);
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-right: 0.5rem;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .libur-table {
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
            .libur-table {
                overflow-x: auto;
            }

            table {
                min-width: 700px;
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

        .no-libur {
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

            .libur-table {
                min-width: 600px;
            }

            .filter-form {
                grid-template-columns: 1fr;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .btn-primary {
                width: 100%;
                justify-content: center;
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
            <h1 class="page-title">Kelola Tanggal Libur</h1>
            <button class="btn-primary" id="tambahLiburBtn">
                <i class="fas fa-plus"></i> Tambah Libur
            </button>
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

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i> Terdapat kesalahan dalam input data:
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="filter-section">
            <h3 style="margin-bottom: 1rem; color: var(--primary-dark);">Filter Tanggal Libur</h3>
            <form method="GET" action="{{ route('admin.kelola.libur') }}" class="filter-form">
                <div class="form-group">
                    <label for="filter_bulan">Bulan</label>
                    <select id="filter_bulan" name="filter_bulan">
                        <option value="">Semua Bulan</option>
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('filter_bulan') == $i ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="form-group">
                    <label for="filter_tahun">Tahun</label>
                    <select id="filter_tahun" name="filter_tahun">
                        <option value="">Semua Tahun</option>
                        @for($i = date('Y'); $i <= date('Y') + 2; $i++)
                            <option value="{{ $i }}" {{ request('filter_tahun') == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn-primary" style="width: 100%;">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>

                <div class="form-group">
                    <a href="{{ route('admin.kelola.libur') }}" class="btn-primary" style="display: block; text-align: center; background-color: #6c757d;">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="libur-table">
            <table>
                <thead>
                    <tr>
                        <th>ID Libur</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Diperbarui</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($liburs as $libur)
                    <tr>
                        <td data-label="ID Libur">{{ $libur->id_libur }}</td>
                        <td data-label="Tanggal">{{ \Carbon\Carbon::parse($libur->tanggal)->translatedFormat('d F Y') }}</td>
                        <td data-label="Keterangan">{{ $libur->keterangan ?? '-' }}</td>
                        <td data-label="Diperbarui">{{ $libur->updated_at->diffForHumans() }}</td>
                        <td data-label="Aksi">
                            <button class="btn-edit edit-libur-btn" data-id="{{ $libur->id_libur }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form action="{{ route('admin.libur.hapus', $libur->id_libur) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus tanggal libur ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="no-libur">
                            <i class="fas fa-calendar-times" style="font-size: 4rem; margin-bottom: 1rem; color: #ccc;"></i>
                            <h3>Belum ada tanggal libur</h3>
                            <p>Tambahkan tanggal libur pertama Anda</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal untuk Tambah/Edit Libur -->
    <div id="liburModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Tambah Libur Baru</h2>
                <button class="close" id="closeModalBtn">&times;</button>
            </div>
            <form id="liburForm" method="POST">
                @csrf
                <input type="hidden" id="editId" name="id_libur">

                <div class="form-group">
                    <label for="tanggal">Tanggal *</label>
                    <input type="date" id="tanggal" name="tanggal" required min="{{ date('Y-m-d') }}">
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan (Opsional)</label>
                    <input type="text" id="keterangan" name="keterangan" placeholder="Contoh: Libur Nasional, Maintenance, dll.">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn-primary" style="width: 100%;">
                        <i class="fas fa-save"></i> Simpan Libur
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('liburModal');
        const form = document.getElementById('liburForm');
        const modalTitle = document.getElementById('modalTitle');
        const editId = document.getElementById('editId');
        const tambahLiburBtn = document.getElementById('tambahLiburBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
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

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Tombol tambah libur
            tambahLiburBtn.addEventListener('click', openModal);

            // Tombol close modal
            closeModalBtn.addEventListener('click', closeModal);

            // Tombol edit libur - event delegation
            document.addEventListener('click', function(e) {
                if (e.target.closest('.edit-libur-btn')) {
                    const button = e.target.closest('.edit-libur-btn');
                    const idLibur = button.getAttribute('data-id');
                    editLibur(idLibur);
                }
            });

            // Close modal ketika klik di luar modal
            window.addEventListener('click', function(event) {
                if (event.target == modal) {
                    closeModal();
                }
            });

            // Handle form submission
            form.addEventListener('submit', function(e) {
                // Show loading state
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
                submitBtn.disabled = true;
            });
        });

        function openModal() {
            modal.style.display = 'block';
            form.reset();
            editId.value = '';
            modalTitle.textContent = 'Tambah Libur Baru';

            // Set form action untuk create
            form.action = "{{ route('admin.libur.simpan') }}";

            // Set min date untuk hari ini
            document.getElementById('tanggal').min = new Date().toISOString().split('T')[0];
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        function editLibur(id) {
            fetch(`/admin/libur/${id}/get`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(libur => {
                    modalTitle.textContent = 'Edit Libur';
                    editId.value = libur.id_libur;

                    // Format tanggal untuk input date
                    const tanggal = new Date(libur.tanggal);
                    const formattedDate = tanggal.toISOString().split('T')[0];
                    document.getElementById('tanggal').value = formattedDate;

                    document.getElementById('keterangan').value = libur.keterangan || '';

                    // Set form action untuk update
                    form.action = `/admin/libur/${id}/update`;
                    modal.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data libur');
                });
        }
    </script>
</body>
</html>
