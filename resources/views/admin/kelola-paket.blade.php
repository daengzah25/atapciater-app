<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Paket - Atap Ciater</title>
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
            gap: 2rem;
            align-items: center;
        }

        .nav-links a,
        .nav-links button {
            color: var(--white);
            text-decoration: none;
            transition: opacity 0.3s ease;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .nav-links a:hover,
        .nav-links button:hover {
            opacity: 0.8;
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
            padding: 0.75rem 1.5rem;
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

        .paket-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }

        .paket-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .paket-card:hover {
            transform: translateY(-5px);
        }

        .paket-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(45deg, var(--primary-light), var(--primary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 3rem;
            position: relative;
            overflow: hidden;
        }

        .paket-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .paket-content {
            padding: 1.5rem;
        }

        .paket-title {
            color: var(--primary-dark);
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }

        .paket-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .paket-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            color: #666;
        }

        .paket-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: var(--white);
            margin: 5% auto;
            padding: 2rem;
            border-radius: 15px;
            width: 90%;
            max-width: 600px;
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
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: var(--primary);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
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

        .image-preview {
            width: 100%;
            height: 200px;
            background: var(--light-bg);
            border: 2px dashed var(--border);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            overflow: hidden;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .no-paket {
            text-align: center;
            padding: 3rem;
            color: #666;
            grid-column: 1 / -1;
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
                <a href="{{ route('admin.kelola.slot') }}">Kelola Slot</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Kelola Daftar Paket</h1>
            <button class="btn-primary" id="tambahPaketBtn">
                <i class="fas fa-plus"></i> Tambah Paket
            </button>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i> Terdapat kesalahan dalam input data.
        </div>
        @endif

        <div class="paket-grid">
            @forelse($pakets as $paket)
            <div class="paket-card">
                <div class="paket-image">
                    @if($paket->gambar && file_exists(public_path('images/paket_images/' . $paket->gambar)))
                    <img src="{{ asset('images/paket_images/' . $paket->gambar) }}" alt="{{ $paket->nama_paket }}">
                    @else
                    <i class="fas fa-campground"></i>
                    @endif
                </div>
                <div class="paket-content">
                    <h3 class="paket-title">{{ $paket->nama_paket }}</h3>
                    <div class="paket-price">Rp {{ number_format($paket->harga, 0, ',', '.') }}</div>
                    <div class="paket-meta">
                        <span><i class="fas fa-users"></i> {{ $paket->slot }} slot</span>
                        <span><i class="fas fa-calendar"></i> {{ $paket->created_at->format('d M Y') }}</span>
                    </div>
                    <p>{{ Str::limit($paket->deskripsi, 100) }}</p>
                    <div class="paket-actions">
                        <button class="btn-edit edit-paket-btn" data-id="{{ $paket->id_paket }}">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <form action="{{ route('admin.paket.hapus', $paket->id_paket) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus paket ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="no-paket">
                <i class="fas fa-campground" style="font-size: 4rem; margin-bottom: 1rem; color: #ccc;"></i>
                <h3>Belum ada paket</h3>
                <p>Tambahkan paket pertama Anda untuk memulai</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Modal untuk Tambah/Edit Paket -->
    <div id="paketModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Tambah Paket Baru</h2>
                <button class="close" id="closeModalBtn">&times;</button>
            </div>
            <form id="paketForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="editId" name="id_paket">

                <div class="form-group">
                    <label for="nama_paket">Nama Paket *</label>
                    <input type="text" id="nama_paket" name="nama_paket" required value="{{ old('nama_paket') }}">
                    @error('nama_paket') <span style="color: red; font-size: 0.9rem;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="slot">Slot Tersedia *</label>
                    <input type="number" id="slot" name="slot" min="1" required value="{{ old('slot') }}">
                    @error('slot') <span style="color: red; font-size: 0.9rem;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="harga">Harga (Rp) *</label>
                    <input type="number" id="harga" name="harga" min="0" required value="{{ old('harga') }}">
                    @error('harga') <span style="color: red; font-size: 0.9rem;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi *</label>
                    <textarea id="deskripsi" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <span style="color: red; font-size: 0.9rem;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="fasilitas">Fasilitas *</label>
                    <textarea id="fasilitas" name="fasilitas" required>{{ old('fasilitas') }}</textarea>
                    @error('fasilitas') <span style="color: red; font-size: 0.9rem;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar Paket</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*">
                    <div class="image-preview" id="imagePreview">
                        <span>Pratinjau gambar akan muncul di sini</span>
                    </div>
                    @error('gambar') <span style="color: red; font-size: 0.9rem;">{{ $message }}</span> @enderror
                    <small>Format: JPG, PNG, JPEG (Maks. 2MB)</small>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn-primary" style="width: 100%;">
                        <i class="fas fa-save"></i> Simpan Paket
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('paketModal');
        const form = document.getElementById('paketForm');
        const modalTitle = document.getElementById('modalTitle');
        const editId = document.getElementById('editId');
        const imagePreview = document.getElementById('imagePreview');
        const tambahPaketBtn = document.getElementById('tambahPaketBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const gambarInput = document.getElementById('gambar');

        // Variabel untuk menyimpan gambar lama saat edit
        let currentImage = null;

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Tombol tambah paket
            tambahPaketBtn.addEventListener('click', openModal);

            // Tombol close modal
            closeModalBtn.addEventListener('click', closeModal);

            // Tombol edit paket - event delegation
            document.addEventListener('click', function(e) {
                if (e.target.closest('.edit-paket-btn')) {
                    const button = e.target.closest('.edit-paket-btn');
                    const idPaket = button.getAttribute('data-id');
                    editPaket(idPaket);
                }
            });

            // Preview gambar
            gambarInput.addEventListener('change', previewImage);

            // Close modal ketika klik di luar modal
            window.addEventListener('click', function(event) {
                if (event.target == modal) {
                    closeModal();
                }
            });

            // Format harga input
            document.getElementById('harga').addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                e.target.value = value;
            });

            // Handle form submission
            form.addEventListener('submit', function(e) {
                // Validasi file size client-side
                const fileInput = document.getElementById('gambar');
                if (fileInput.files.length > 0) {
                    const fileSize = fileInput.files[0].size / 1024 / 1024; // MB
                    if (fileSize > 2) {
                        e.preventDefault();
                        alert('Ukuran file maksimal 2MB!');
                        return false;
                    }
                }

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
            modalTitle.textContent = 'Tambah Paket Baru';
            imagePreview.innerHTML = '<span>Pratinjau gambar akan muncul di sini</span>';
            currentImage = null;

            // Set form action untuk create
            form.action = "{{ route('admin.paket.simpan') }}";

            // Reset file input
            gambarInput.value = '';
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        function editPaket(id) {
            fetch(`/admin/paket/${id}/get`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(paket => {
                    modalTitle.textContent = 'Edit Paket';
                    editId.value = paket.id_paket;
                    document.getElementById('nama_paket').value = paket.nama_paket;
                    document.getElementById('slot').value = paket.slot;
                    document.getElementById('harga').value = paket.harga;
                    document.getElementById('deskripsi').value = paket.deskripsi;
                    document.getElementById('fasilitas').value = paket.fasilitas;

                    // Handle image preview
                    if (paket.gambar) {
                        const imageUrl = `/storage/paket_images/${paket.gambar}`;
                        imagePreview.innerHTML = `<img src="${imageUrl}" alt="${paket.nama_paket}">`;
                        currentImage = paket.gambar;
                    } else {
                        imagePreview.innerHTML = '<span>Pratinjau gambar akan muncul di sini</span>';
                        currentImage = null;
                    }

                    // Set form action untuk update
                    form.action = `/admin/paket/${id}/update`;
                    modal.style.display = 'block';

                    // Reset file input
                    gambarInput.value = '';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data paket');
                });
        }

        function previewImage() {
            const file = gambarInput.files[0];
            if (file) {
                // Validasi tipe file
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!validTypes.includes(file.type)) {
                    alert('Hanya format JPG, PNG, dan JPEG yang diizinkan!');
                    gambarInput.value = '';
                    imagePreview.innerHTML = '<span>Pratinjau gambar akan muncul di sini</span>';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                };
                reader.readAsDataURL(file);
            } else {
                // Jika tidak ada file baru, tampilkan gambar lama (saat edit)
                if (currentImage) {
                    const imageUrl = `/storage/paket_images/${currentImage}`;
                    imagePreview.innerHTML = `<img src="${imageUrl}" alt="Current Image">`;
                } else {
                    imagePreview.innerHTML = '<span>Pratinjau gambar akan muncul di sini</span>';
                }
            }
        }
    </script>
</body>

</html>