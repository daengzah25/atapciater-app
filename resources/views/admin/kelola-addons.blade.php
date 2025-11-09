<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Addons - Atap Ciater</title>
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
            gap: 2rem;
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
        
        .addons-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }
        
        .addon-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .addon-card:hover {
            transform: translateY(-5px);
        }
        
        .addon-image {
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
        
        .addon-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .addon-content {
            padding: 1.5rem;
        }
        
        .addon-title {
            color: var(--primary-dark);
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }
        
        .addon-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary);
            margin-bottom: 1rem;
        }
        
        .addon-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            color: #666;
        }
        
        .addon-actions {
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
            background-color: rgba(0,0,0,0.5);
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
        
        .no-addons {
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
            <h1 class="page-title">Kelola Addons</h1>
            <button class="btn-primary" id="tambahAddonBtn">
                <i class="fas fa-plus"></i> Tambah Addon
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

        <div class="addons-grid">
            @forelse($addons as $addon)
            <div class="addon-card">
                <div class="addon-image">
                    @if($addon->gambar && file_exists(public_path('images/addons_images/' . $addon->gambar)))
                        <img src="{{ asset('images/addons_images/' . $addon->gambar) }}" alt="{{ $addon->nama_addons }}">
                    @else
                        <i class="fas fa-tools"></i>
                    @endif
                </div>
                <div class="addon-content">
                    <h3 class="addon-title">{{ $addon->nama_addons }}</h3>
                    <div class="addon-price">Rp {{ number_format($addon->harga, 0, ',', '.') }}</div>
                    <div class="addon-meta">
                        <span><i class="fas fa-box"></i> Stok: {{ $addon->stok }}</span>
                        <span><i class="fas fa-calendar"></i> {{ $addon->created_at->format('d M Y') }}</span>
                    </div>
                    <p>{{ Str::limit($addon->deskripsi, 100) }}</p>
                    <div class="addon-actions">
                        <button class="btn-edit edit-addon-btn" data-id="{{ $addon->id_addons }}">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <form action="{{ route('admin.addon.hapus', $addon->id_addons) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus addon ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="no-addons">
                <i class="fas fa-tools" style="font-size: 4rem; margin-bottom: 1rem; color: #ccc;"></i>
                <h3>Belum ada addons</h3>
                <p>Tambahkan addons pertama Anda untuk memulai</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Modal untuk Tambah/Edit Addon -->
    <div id="addonModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Tambah Addon Baru</h2>
                <button class="close" id="closeModalBtn">&times;</button>
            </div>
            <form id="addonForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="editId" name="id_addons">
                
                <div class="form-group">
                    <label for="nama_addons">Nama Addon *</label>
                    <input type="text" id="nama_addons" name="nama_addons" required>
                </div>
                
                <div class="form-group">
                    <label for="stok">Stok Tersedia *</label>
                    <input type="number" id="stok" name="stok" min="0" required>
                </div>
                
                <div class="form-group">
                    <label for="harga">Harga (Rp) *</label>
                    <input type="number" id="harga" name="harga" min="0" required>
                </div>
                
                <div class="form-group">
                    <label for="deskripsi">Deskripsi *</label>
                    <textarea id="deskripsi" name="deskripsi" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="gambar">Gambar Addon</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*">
                    <div class="image-preview" id="imagePreview">
                        <span>Pratinjau gambar akan muncul di sini</span>
                    </div>
                    <small>Format: JPG, PNG, JPEG (Maks. 2MB)</small>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn-primary" style="width: 100%;">
                        <i class="fas fa-save"></i> Simpan Addon
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('addonModal');
        const form = document.getElementById('addonForm');
        const modalTitle = document.getElementById('modalTitle');
        const editId = document.getElementById('editId');
        const imagePreview = document.getElementById('imagePreview');
        const tambahAddonBtn = document.getElementById('tambahAddonBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const gambarInput = document.getElementById('gambar');

        // Variabel untuk menyimpan gambar lama saat edit
        let currentImage = null;

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Tombol tambah addon
            tambahAddonBtn.addEventListener('click', openModal);
            
            // Tombol close modal
            closeModalBtn.addEventListener('click', closeModal);
            
            // Tombol edit addon - event delegation
            document.addEventListener('click', function(e) {
                if (e.target.closest('.edit-addon-btn')) {
                    const button = e.target.closest('.edit-addon-btn');
                    const idAddon = button.getAttribute('data-id');
                    editAddon(idAddon);
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
            modalTitle.textContent = 'Tambah Addon Baru';
            imagePreview.innerHTML = '<span>Pratinjau gambar akan muncul di sini</span>';
            currentImage = null;
            
            // Set form action untuk create
            form.action = "{{ route('admin.addon.simpan') }}";
            
            // Reset file input
            gambarInput.value = '';
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        function editAddon(id) {
            fetch(`/admin/addons/${id}/get`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(addon => {
                    modalTitle.textContent = 'Edit Addon';
                    editId.value = addon.id_addons;
                    document.getElementById('nama_addons').value = addon.nama_addons;
                    document.getElementById('stok').value = addon.stok;
                    document.getElementById('harga').value = addon.harga;
                    document.getElementById('deskripsi').value = addon.deskripsi;
                    
                    // Handle image preview
                    if (addon.gambar) {
                        const imageUrl = `/images/addons_images/${addon.gambar}`;
                        imagePreview.innerHTML = `<img src="${imageUrl}" alt="${addon.nama_addons}">`;
                        currentImage = addon.gambar;
                    } else {
                        imagePreview.innerHTML = '<span>Pratinjau gambar akan muncul di sini</span>';
                        currentImage = null;
                    }
                    
                    // Set form action untuk update
                    form.action = `/admin/addons/${id}/update`;
                    modal.style.display = 'block';
                    
                    // Reset file input
                    gambarInput.value = '';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data addon');
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
                    const imageUrl = `/images/addons_images/${currentImage}`;
                    imagePreview.innerHTML = `<img src="${imageUrl}" alt="Current Image">`;
                } else {
                    imagePreview.innerHTML = '<span>Pratinjau gambar akan muncul di sini</span>';
                }
            }
        }
    </script>
</body>
</html>