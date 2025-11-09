<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Slot - Atap Ciater</title>
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
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .nav-container {
            /* diselaraskan dengan halaman lain: 1200px */
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

        /* highlight current link consistently via class */
        .nav-links a.current {
            font-weight: 700;
            text-decoration: underline;
        }
        
        .container {
            /* diselaraskan dengan halaman lain: 1200px */
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
        
        .slot-table {
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
        
        .slot-low {
            color: var(--danger);
            font-weight: bold;
        }
        
        .slot-medium {
            color: var(--warning);
            font-weight: bold;
        }
        
        .slot-high {
            color: var(--primary);
            font-weight: bold;
        }
        
        /* Modal Styles (sama konsistensi dengan halaman lain) */
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
        
        .no-slots {
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
            
            .slot-table {
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
                <i class="fas fa-mountain"></i> Atap Ciater - Admin
            </a>
            <div class="nav-links">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.kelola.paket') }}">Kelola Paket</a>
                <a href="{{ route('admin.kelola.addons') }}">Kelola Addons</a>
                <a href="{{ route('admin.kelola.pesanan') }}">Kelola Pesanan</a>
                <!-- dibuat konsisten: tanpa inline style, gunakan class jika perlu -->
                <a href="{{ route('admin.kelola.slot') }}" class="current">Kelola Slot</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Kelola Slot Tersedia</h1>
            <button class="btn-primary" id="tambahSlotBtn">
                <i class="fas fa-plus"></i> Tambah Slot
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
            <h3 style="margin-bottom: 1rem; color: var(--primary-dark);">Filter Slot</h3>
            <form method="GET" action="{{ route('admin.kelola.slot') }}" class="filter-form">
                <div class="form-group">
                    <label for="filter_paket">Paket</label>
                    <select id="filter_paket" name="filter_paket">
                        <option value="">Semua Paket</option>
                        @foreach($pakets as $paket)
                            <option value="{{ $paket->id_paket }}" {{ request('filter_paket') == $paket->id_paket ? 'selected' : '' }}>
                                {{ $paket->nama_paket }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="filter_tanggal">Tanggal</label>
                    <input type="date" id="filter_tanggal" name="filter_tanggal" value="{{ request('filter_tanggal') }}">
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn-primary" style="width: 100%;">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
                
                <div class="form-group">
                    <a href="{{ route('admin.kelola.slot') }}" class="btn-primary" style="display: block; text-align: center; background-color: #6c757d;">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="slot-table">
            <table>
                <thead>
                    <tr>
                        <th>ID Slot</th>
                        <th>Paket</th>
                        <th>Tanggal</th>
                        <th>Slot Tersedia</th>
                        <th>Status</th>
                        <th>Diperbarui</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slots as $slot)
                    <tr>
                        <td>{{ $slot->id_slot }}</td>
                        <td>{{ $slot->paket->nama_paket }}</td>
                        <td>{{ \Carbon\Carbon::parse($slot->tanggal)->translatedFormat('d F Y') }}</td>
                        <td>
                            @if($slot->slot_tersedia <= 5)
                                <span class="slot-low">{{ $slot->slot_tersedia }}</span>
                            @elseif($slot->slot_tersedia <= 15)
                                <span class="slot-medium">{{ $slot->slot_tersedia }}</span>
                            @else
                                <span class="slot-high">{{ $slot->slot_tersedia }}</span>
                            @endif
                        </td>
                        <td>
                            @if($slot->slot_tersedia <= 5)
                                <span style="color: var(--danger); font-weight: bold;">Hampir Habis</span>
                            @elseif($slot->slot_tersedia <= 15)
                                <span style="color: var(--warning); font-weight: bold;">Sedang</span>
                            @else
                                <span style="color: var(--primary); font-weight: bold;">Tersedia</span>
                            @endif
                        </td>
                        <td>{{ $slot->updated_at->diffForHumans() }}</td>
                        <td>
                            <button class="btn-edit edit-slot-btn" data-id="{{ $slot->id_slot }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form action="{{ route('admin.slot.hapus', $slot->id_slot) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus slot ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="no-slots">
                            <i class="fas fa-calendar-times" style="font-size: 4rem; margin-bottom: 1rem; color: #ccc;"></i>
                            <h3>Belum ada slot</h3>
                            <p>Tambahkan slot pertama Anda untuk memulai</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal untuk Tambah/Edit Slot -->
    <div id="slotModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Tambah Slot Baru</h2>
                <button class="close" id="closeModalBtn">&times;</button>
            </div>
            <form id="slotForm" method="POST">
                @csrf
                <input type="hidden" id="editId" name="id_slot">
                
                <div class="form-group">
                    <label for="id_paket">Paket *</label>
                    <select id="id_paket" name="id_paket" required>
                        <option value="">Pilih Paket</option>
                        @foreach($pakets as $paket)
                            <option value="{{ $paket->id_paket }}">{{ $paket->nama_paket }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="tanggal">Tanggal *</label>
                    <input type="date" id="tanggal" name="tanggal" required min="{{ date('Y-m-d') }}">
                </div>
                
                <div class="form-group">
                    <label for="slot_tersedia">Slot Tersedia *</label>
                    <input type="number" id="slot_tersedia" name="slot_tersedia" min="0" required>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn-primary" style="width: 100%;">
                        <i class="fas fa-save"></i> Simpan Slot
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('slotModal');
        const form = document.getElementById('slotForm');
        const modalTitle = document.getElementById('modalTitle');
        const editId = document.getElementById('editId');
        const tambahSlotBtn = document.getElementById('tambahSlotBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Tombol tambah slot
            tambahSlotBtn.addEventListener('click', openModal);
            
            // Tombol close modal
            closeModalBtn.addEventListener('click', closeModal);
            
            // Tombol edit slot - event delegation
            document.addEventListener('click', function(e) {
                if (e.target.closest('.edit-slot-btn')) {
                    const button = e.target.closest('.edit-slot-btn');
                    const idSlot = button.getAttribute('data-id');
                    editSlot(idSlot);
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
            modalTitle.textContent = 'Tambah Slot Baru';
            
            // Set form action untuk create
            form.action = "{{ route('admin.slot.simpan') }}";
            
            // Set min date untuk hari ini
            document.getElementById('tanggal').min = new Date().toISOString().split('T')[0];
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        function editSlot(id) {
            fetch(`/admin/slot/${id}/get`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(slot => {
                    modalTitle.textContent = 'Edit Slot';
                    editId.value = slot.id_slot;
                    document.getElementById('id_paket').value = slot.id_paket;
                    
                    // Format tanggal untuk input date
                    const tanggal = new Date(slot.tanggal);
                    const formattedDate = tanggal.toISOString().split('T')[0];
                    document.getElementById('tanggal').value = formattedDate;
                    
                    document.getElementById('slot_tersedia').value = slot.slot_tersedia;
                    
                    // Set form action untuk update
                    form.action = `/admin/slot/${id}/update`;
                    modal.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data slot');
                });
        }
    </script>
</body>
</html>