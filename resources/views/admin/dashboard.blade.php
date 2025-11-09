<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Atap Ciater</title>
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

        .page-title {
            margin-bottom: 2rem;
            color: var(--primary-dark);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: var(--white);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.5rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .action-card {
            background: var(--white);
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            text-decoration: none;
            color: var(--text);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: var(--text);
        }

        .action-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

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
            background-color: white;
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
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #4caf50;
        }

        .close {
            color: #aaa;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            background: none;
            border: none;
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
        <h1 class="page-title">Dashboard Admin</h1>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-campground"></i>
                </div>
                <div class="stat-number">{{ $totalPaket }}</div>
                <div class="stat-label">Total Paket</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <div class="stat-number">{{ $totalAddons }}</div>
                <div class="stat-label">Total Addons</div>
            </div>

            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="stat-number">{{ $totalPesanan }}</div>
                <div class="stat-label">Total Pesanan</div>
            </div>
        </div>

        <h2 class="page-title">Quick Actions</h2>

        <div class="quick-actions">
            <a href="{{ route('admin.kelola.paket') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-campground"></i>
                </div>
                <h3>Kelola Paket</h3>
                <p>Manage daftar paket camping</p>
            </a>

            <a href="{{ route('admin.kelola.addons') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <h3>Kelola Addons</h3>
                <p>Manage alat sewa & tour guide</p>
            </a>

            <a href="{{ route('admin.kelola.pesanan') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h3>Kelola Pesanan</h3>
                <p>Lihat dan konfirmasi pesanan</p>
            </a>

            <a href="{{ route('admin.kelola.slot') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-check-to-slot"></i>
                </div>
                <h3>Kelola Slot</h3>
                <p>Kelola slot</p>
            </a>
        </div>
    </div>

    <div id="detailModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Detail Pesanan</h2>
                <button class="close" id="closeModalBtn">&times;</button>
            </div>
            <div id="modalBody">
                <!-- Content akan diisi oleh JavaScript -->
            </div>
        </div>
    </div>

</body>
<script>
    const modal = document.getElementById('detailModal');
    const modalBody = document.getElementById('modalBody');
    const closeModalBtn = document.getElementById('closeModalBtn');

    // Event Listeners
    document.addEventListener('DOMContentLoaded', function() {
        closeModalBtn.addEventListener('click', closeModal);

        // Tombol detail pesanan
        document.addEventListener('click', function(e) {
            if (e.target.closest('.detail-btn')) {
                const button = e.target.closest('.detail-btn');
                const idPesanan = button.getAttribute('data-id');
                showDetailPesanan(idPesanan);
            }
        });

        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                closeModal();
            }
        });
    });

    function showDetailPesanan(id) {
        // Untuk PIC, kita akan tampilkan detail sederhana
        // Anda bisa menambahkan AJAX call seperti di admin jika perlu detail lengkap
        const modalContent = `
            <div style="margin-bottom: 1.5rem;">
                <h3 style="color: #1b5e20; margin-bottom: 1rem;">Detail Pesanan #${id}</h3>
                <p>Fitur detail lengkap akan diimplementasikan kemudian.</p>
                <p>Untuk melihat detail lengkap termasuk bukti pembayaran, silakan hubungi admin.</p>
            </div>
            <button class="btn-view" onclick="closeModal()" style="background: #2e7d32; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px; cursor: pointer;">
                <i class="fas fa-times"></i> Tutup
            </button>
        `;

        modalBody.innerHTML = modalContent;
        modal.style.display = 'block';
    }

    function closeModal() {
        modal.style.display = 'none';
    }
</script>

</html>