<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PIC - Atap Ciater</title>
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
            --warning: #ffc107;
            --info: #17a2b8;
            --danger: #dc3545;
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

        .nav-links a,
        .nav-links button {
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

        .nav-links a:hover,
        .nav-links button:hover {
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

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .page-title {
            margin-bottom: 2rem;
            color: var(--primary-dark);
        }

        /* Mobile-First Card Design untuk Pesanan */
        .pesanan-list {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .pesanan-card {
            background: var(--white);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            border-left: 4px solid var(--primary);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .pesanan-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .pesanan-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }

        .pesanan-id {
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 1.1rem;
        }

        .status-badge {
            display: inline-block;
            padding: 0.35rem 0.85rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-menunggu-konfirmasi {
            background: var(--warning);
            color: #856404;
        }

        .status-dikonfirmasi {
            background: var(--info);
            color: white;
        }

        .status-dibatalkan {
            background: var(--danger);
            color: white;
        }

        .status-selesai {
            background: var(--success);
            color: white;
        }

        .pesanan-info {
            display: grid;
            gap: 0.8rem;
            margin-bottom: 1.2rem;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.95rem;
        }

        .info-label {
            color: #666;
            font-weight: 500;
        }

        .info-value {
            font-weight: 600;
            color: var(--text);
            text-align: right;
        }

        .pesanan-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .btn-view {
            flex: 1;
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.6rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .btn-view:hover {
            background: var(--primary-dark);
        }

        .no-data {
            text-align: center;
            padding: 3rem 1.5rem;
            color: #666;
        }

        .no-data i {
            font-size: 3rem;
            color: #ccc;
            margin-bottom: 1rem;
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

        .detail-section {
            margin-bottom: 2rem;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--border);
        }

        .detail-label {
            font-weight: 500;
            color: #666;
        }

        .detail-value {
            font-weight: 600;
            text-align: right;
        }

        .bukti-pembayaran-container {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .bukti-pembayaran-controls {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .zoom-btn {
            background-color: var(--primary);
            color: var(--white);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .zoom-btn:hover {
            background-color: var(--primary-dark);
        }

        .zoom-level {
            background-color: var(--light-bg);
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-weight: 600;
            color: var(--text);
        }

        .bukti-pembayaran-wrapper {
            overflow: auto;
            border: 1px solid var(--border);
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            max-height: 500px;
            background: var(--light-bg);
        }

        .bukti-pembayaran-wrapper img {
            border-radius: 8px;
            transition: transform 0.2s ease;
            cursor: grab;
            max-width: 100%;
        }

        .bukti-pembayaran-wrapper img:active {
            cursor: grabbing;
        }

        /* Desktop Responsive */
        @media (min-width: 1024px) {
            .pesanan-list {
                grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
            }
        }

        /* Mobile Navigation Responsive */
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

            .pesanan-card {
                padding: 1.25rem;
            }

            .pesanan-card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .modal-content {
                width: 95%;
                margin: 20% auto;
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('pic.dashboard') }}" class="logo">
                <img src="{{ asset('images/logo/atap_ciater.png') }}" alt="Atap Ciater Logo">
                <span>Atap Ciater - PIC</span>
            </a>
            <button class="hamburger-menu" id="hamburgerBtn">
                <i class="fas fa-bars"></i>
            </button>
            <div class="nav-links" id="navLinks">
                <a href="{{ route('pic.dashboard') }}">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="page-title">Dashboard PIC - Daftar Pesanan</h1>

        <div class="pesanan-list">
            @forelse($pesanan as $order)
            <div class="pesanan-card">
                <div class="pesanan-card-header">
                    <div class="pesanan-id">
                        <i class="fas fa-receipt"></i> {{ $order->id_pesanan }}
                    </div>
                    <span class="status-badge status-{{ str_replace('_', '-', $order->status) }}">
                        {{ ucwords(str_replace('_', ' ', $order->status)) }}
                    </span>
                </div>

                <div class="pesanan-info">
                    <div class="info-row">
                        <span class="info-label">
                            <i class="fas fa-user"></i> Pemesan
                        </span>
                        <span class="info-value">{{ $order->nama_pemesan }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">
                            <i class="fas fa-calendar"></i> Booking
                        </span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($order->tanggal_booking)->translatedFormat('d M Y') }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">
                            <i class="fas fa-box"></i> Paket
                        </span>
                        <span class="info-value">{{ $order->nama_paket }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">
                            <i class="fas fa-money-bill"></i> Total
                        </span>
                        <span class="info-value">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="pesanan-actions">
                    <button class="btn-view detail-btn" data-id="{{ $order->id_pesanan }}">
                        <i class="fas fa-eye"></i> Detail
                    </button>
                </div>
            </div>
            @empty
            <div class="no-data">
                <i class="fas fa-inbox"></i>
                <h3>Belum ada pesanan</h3>
                <p>Pesanan dari customer akan muncul di sini</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Modal untuk Detail Pesanan -->
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

    <script>
        const modal = document.getElementById('detailModal');
        const modalBody = document.getElementById('modalBody');
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
            fetch(`/pic/pesanan/${id}/detail`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(pesanan => {
                    // Format tanggal
                    const tanggalPesan = new Date(pesanan.tanggal_pesan).toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    const tanggalBooking = new Date(pesanan.tanggal_booking).toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });

                    // Hitung total full untuk DP
                    let totalFull = parseInt(pesanan.harga_paket);
                    let addonsHtml = '';

                    if (pesanan.detail_pesanan && pesanan.detail_pesanan.length > 0) {
                        pesanan.detail_pesanan.forEach(detail => {
                            totalFull += parseInt(detail.subtotal);
                            addonsHtml += `
                                <div class="detail-item addon-detail">
                                    <span>${detail.nama_addons} (x${detail.jumlah})</span>
                                    <span>Rp ${formatRupiah(detail.subtotal)}</span>
                                </div>
                            `;
                        });
                    }

                    // Tampilkan informasi pembayaran berdasarkan metode
                    let paymentInfo = '';
                    if (pesanan.metode_bayar === 'dp_50%') {
                        const sisaBayar = totalFull - parseInt(pesanan.total);
                        paymentInfo = `
                            <div class="detail-item">
                                <span class="detail-label">Total Harga:</span>
                                <span class="detail-value">Rp ${formatRupiah(totalFull)}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">DP 50% Dibayar:</span>
                                <span class="detail-value">Rp ${formatRupiah(pesanan.total)}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Sisa Pembayaran:</span>
                                <span class="detail-value">Rp ${formatRupiah(sisaBayar)}</span>
                            </div>
                        `;
                    } else {
                        paymentInfo = `
                            <div class="detail-item">
                                <span class="detail-label">Total Pembayaran:</span>
                                <span class="detail-value">Rp ${formatRupiah(pesanan.total)}</span>
                            </div>
                        `;
                    }

                    const modalContent = `
                        <div class="detail-section">
                            <h3 style="color: var(--primary-dark); margin-bottom: 1rem;">Informasi Pemesan</h3>
                            <div class="detail-item">
                                <span class="detail-label">ID Pesanan:</span>
                                <span class="detail-value">${pesanan.id_pesanan}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Nama Pemesan:</span>
                                <span class="detail-value">${pesanan.nama_pemesan}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">No. WhatsApp:</span>
                                <span class="detail-value">${pesanan.no_wa}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Tanggal Pesan:</span>
                                <span class="detail-value">${tanggalPesan}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Tanggal Booking:</span>
                                <span class="detail-value">${tanggalBooking}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Status:</span>
                                <span class="detail-value">
                                    <span class="status-badge status-${pesanan.status.replace('_', '-')}">
                                        ${pesanan.status.replace('_', ' ').toUpperCase()}
                                    </span>
                                </span>
                            </div>
                        </div>

                        <div class="detail-section">
                            <h3 style="color: var(--primary-dark); margin-bottom: 1rem;">Detail Pesanan</h3>
                            <div class="detail-item">
                                <span class="detail-label">Paket:</span>
                                <span class="detail-value">${pesanan.nama_paket}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Harga Paket:</span>
                                <span class="detail-value">Rp ${formatRupiah(pesanan.harga_paket)}</span>
                            </div>
                            ${addonsHtml}
                            <div class="detail-item">
                                <span class="detail-label">Metode Bayar:</span>
                                <span class="detail-value">${pesanan.metode_bayar === 'dp_50%' ? 'DP 50%' : 'LUNAS'}</span>
                            </div>
                            ${paymentInfo}
                        </div>

                        ${pesanan.catatan ? `
                        <div class="detail-section">
                            <h3 style="color: var(--primary-dark); margin-bottom: 1rem;">Catatan</h3>
                            <p style="background: var(--light-bg); padding: 1rem; border-radius: 8px;">${pesanan.catatan}</p>
                        </div>
                        ` : ''}

                        <div class="detail-section">
                            <h3 style="color: var(--primary-dark); margin-bottom: 1rem;">Bukti Pembayaran</h3>
                            ${pesanan.screenshot ?
                                `<div class="bukti-pembayaran-container">
                                    <div class="bukti-pembayaran-controls">
                                        <button class="zoom-btn" onclick="zoomImage(this, -0.2)">
                                            <i class="fas fa-minus"></i> Zoom Out
                                        </button>
                                        <span class="zoom-level"><span id="zoomPercentage">100</span>%</span>
                                        <button class="zoom-btn" onclick="zoomImage(this, 0.2)">
                                            <i class="fas fa-plus"></i> Zoom In
                                        </button>
                                        <button class="zoom-btn" onclick="resetZoom(this)">
                                            <i class="fas fa-redo"></i> Reset
                                        </button>
                                    </div>
                                    <div class="bukti-pembayaran-wrapper">
                                        <img src="/bukti_pembayaran/${pesanan.screenshot}"
                                            alt="Bukti Pembayaran"
                                            class="zoomable-image"
                                            style="max-width: none; transform: scale(1);"
                                            onerror="handleImageError(this)"
                                            onload="handleImageLoad(this)">
                                    </div>
                                </div>` :
                                `<div style="background: #f8f9fa; padding: 2rem; border-radius: 10px; text-align: center;">
                                    <i class="fas fa-image" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
                                    <p>Belum ada bukti pembayaran</p>
                                </div>`
                            }
                        </div>

                        <div class="detail-section">
                            <button class="btn-view" onclick="closeModal()" style="width: 100%; margin-top: 1rem;">
                                <i class="fas fa-times"></i> Tutup
                            </button>
                        </div>
                    `;

                    modalBody.innerHTML = modalContent;
                    modal.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil detail pesanan');
                });
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Zoom functionality
        let currentZoom = 1;

        function zoomImage(button, zoomDelta) {
            const img = document.querySelector('.zoomable-image');
            if (!img) return;

            currentZoom += zoomDelta;
            currentZoom = Math.max(0.5, Math.min(currentZoom, 3)); // Min 50%, Max 300%

            img.style.transform = `scale(${currentZoom})`;
            document.getElementById('zoomPercentage').textContent = Math.round(currentZoom * 100);
        }

        function resetZoom(button) {
            const img = document.querySelector('.zoomable-image');
            if (!img) return;

            currentZoom = 1;
            img.style.transform = 'scale(1)';
            document.getElementById('zoomPercentage').textContent = '100';
        }

        function handleImageError(imgEl) {
            const container = imgEl.closest('.bukti-pembayaran-container');
            if (container) {
                container.style.display = 'none';
            }
        }

        function handleImageLoad(imgEl) {
            // Image loaded successfully
        }
    </script>
</body>

</html>
