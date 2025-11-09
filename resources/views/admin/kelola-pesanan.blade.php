<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - Atap Ciater</title>
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

        /* Navbar and layout widths made consistent with other admin pages */
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

        /* container width aligned with other pages */
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .page-title {
            margin-bottom: 2rem;
            color: var(--primary-dark);
        }

        .pesanan-table {
            background: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
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

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-menunggu {
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

        /* Reuse button styles consistent with other admin pages */
        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-right: 0.5rem;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-danger {
            background-color: var(--danger);
            color: var(--white);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        /* Modal Styles aligned with other pages */
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

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
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

        .bukti-pembayaran {
            text-align: center;
            margin: 2rem 0;
        }

        .bukti-pembayaran img {
            max-width: 100%;
            max-height: 400px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .addon-detail {
            padding-left: 1rem;
            font-size: 0.9rem;
            color: #666;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            justify-content: center;
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

        .no-pesanan {
            text-align: center;
            padding: 3rem;
            color: #666;
        }

        @media (max-width: 768px) {
            .container {
                overflow-x: auto;
            }

            .pesanan-table {
                min-width: 800px;
            }

            .action-buttons {
                flex-direction: column;
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
                <a href="{{ route('admin.kelola.slot') }}">Kelola Slot</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="page-title">Kelola Pesanan</h1>

        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        <div class="pesanan-table">
            <table>
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Nama Pemesan</th>
                        <th>Tanggal Booking</th>
                        <th>Paket</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanan as $order)
                    <tr>
                        <td>{{ $order->id_pesanan }}</td>
                        <td>{{ $order->nama_pemesan }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->tanggal_booking)->translatedFormat('d F Y') }}</td>
                        <td>{{ $order->nama_paket }}</td>
                        <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        <td>
                            <span class="status-badge status-{{ str_replace('_', '-', $order->status) }}">
                                {{ ucwords(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </td>
                        <td>
                            <!-- gunakan kelas yang konsisten dengan halaman lain -->
                            <button class="btn-primary detail-pesanan-btn" data-id="{{ $order->id_pesanan }}">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                            @if($order->status == 'menunggu_konfirmasi')
                            <form action="{{ route('admin.pesanan.update-status', $order->id_pesanan) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="dikonfirmasi">
                                <button type="submit" class="btn-primary" onclick="return confirm('Konfirmasi pesanan ini?')">
                                    <i class="fas fa-check"></i> Konfirmasi
                                </button>
                            </form>
                            <form action="{{ route('admin.pesanan.update-status', $order->id_pesanan) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="dibatalkan">
                                <button type="submit" class="btn-danger" onclick="return confirm('Batalkan pesanan ini?')">
                                    <i class="fas fa-times"></i> Batal
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="no-pesanan">
                            <i class="fas fa-inbox" style="font-size: 4rem; margin-bottom: 1rem; color: #ccc;"></i>
                            <h3>Belum ada pesanan</h3>
                            <p>Semua pesanan dari customer akan muncul di sini</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Tombol close modal
            closeModalBtn.addEventListener('click', closeModal);

            // Tombol detail pesanan - event delegation
            document.addEventListener('click', function(e) {
                if (e.target.closest('.detail-pesanan-btn')) {
                    const button = e.target.closest('.detail-pesanan-btn');
                    const idPesanan = button.getAttribute('data-id');
                    showDetailPesanan(idPesanan);
                }
            });

            // Close modal ketika klik di luar modal
            window.addEventListener('click', function(event) {
                if (event.target == modal) {
                    closeModal();
                }
            });
        });

        function showDetailPesanan(id) {
            fetch(`/admin/pesanan/${id}/detail`)
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
                            <div class="detail-grid">
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

                        <div class="bukti-pembayaran">
                            <h3 style="color: var(--primary-dark); margin-bottom: 1rem;">Bukti Pembayaran</h3>
                            ${pesanan.screenshot ? 
                                `<div class="image-container">
                                    <img src="/bukti_pembayaran/${pesanan.screenshot}" 
                                        alt="Bukti Pembayaran" 
                                        style="max-width: 100%; max-height: 400px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);"
                                        onerror="handleImageError(this, '${pesanan.screenshot}')"
                                        onload="handleImageLoad(this)">
                                    <div class="loading-spinner" style="display: none; text-align: center;">
                                        <i class="fas fa-spinner fa-spin"></i> Memuat gambar...
                                    </div>
                                </div>
                                <div class="image-fallback" style="display: none;">
                                    <div style="background: #f8f9fa; padding: 2rem; border-radius: 10px; text-align: center;">
                                        <i class="fas fa-image" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
                                        <p>Gambar bukti pembayaran tidak ditemukan</p>
                                        <small>File: ${pesanan.screenshot}</small>
                                        <br>
                                        <button onclick="retryLoadImage('${pesanan.screenshot}', this)" 
                                                class="btn-primary" 
                                                style="margin-top: 10px; padding: 5px 15px;">
                                            <i class="fas fa-redo"></i> Coba Lagi
                                        </button>
                                    </div>
                                </div>` : 
                                `<div style="background: #f8f9fa; padding: 2rem; border-radius: 10px; text-align: center;">
                                    <i class="fas fa-image" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
                                    <p>Belum ada bukti pembayaran</p>
                                </div>`
                            }
                        </div>


                        <div class="action-buttons">
                            <button class="btn-primary" onclick="closeModal()">
                                <i class="fas fa-times"></i> Tutup
                            </button>
                        </div>
                    `;

                    modalBody.innerHTML = modalContent;
                    modal.style.display = 'block';

                    // Preload image jika ada (tetap tidak mengubah alur fungsi)
                    if (pesanan.screenshot) {
                        preloadImage(`/bukti_pembayaran/${pesanan.screenshot}`)
                            .catch(err => console.log('Gambar tidak bisa dipreload:', err));
                    }
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

        function preloadImage(src) {
            return new Promise((resolve, reject) => {
                const img = new Image();
                img.onload = () => resolve(img);
                img.onerror = reject;
                img.src = src;
            });
        }

        // helper handlers untuk image (tetap ada agar tidak mengubah fungsi)
        function handleImageError(imgEl, filename) {
            const container = imgEl.closest('.image-container');
            if (container) {
                container.style.display = 'none';
                const fallback = container.parentElement.querySelector('.image-fallback');
                if (fallback) fallback.style.display = 'block';
            }
        }

        function handleImageLoad(imgEl) {
            const spinner = imgEl.parentElement.querySelector('.loading-spinner');
            if (spinner) spinner.style.display = 'none';
        }

        function retryLoadImage(filename, btn) {
            const container = btn.closest('.image-fallback').previousElementSibling;
            if (container) {
                const img = container.querySelector('img');
                if (img) {
                    img.src = `/bukti_pembayaran/${filename}?t=${Date.now()}`;
                    container.style.display = 'block';
                    btn.closest('.image-fallback').style.display = 'none';
                }
            }
        }
    </script>
</body>

</html>