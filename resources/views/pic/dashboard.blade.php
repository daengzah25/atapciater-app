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
            background: #fff3cd;
            color: #856404;
        }

        .status-dikonfirmasi {
            background: #d1edff;
            color: #0c5460;
        }

        .status-dibatalkan {
            background: #f8d7da;
            color: #721c24;
        }

        .status-selesai {
            background: #d1f0d1;
            color: #155724;
        }

        .btn-view {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-view:hover {
            background: var(--primary-dark);
        }

        .no-data {
            text-align: center;
            padding: 2rem;
            color: #666;
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
            <a href="{{ route('pic.dashboard') }}" class="logo">
                <i class="fas fa-mountain"></i> Atap Ciater - PIC
            </a>
            <div class="nav-links">
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
                            <button class="btn-view detail-btn" data-id="{{ $order->id_pesanan }}">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="no-data">
                            <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; color: #ccc;"></i>
                            <p>Belum ada pesanan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tambahkan modal detail di akhir file, sebelum </body> -->
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
        // Gunakan event delegation untuk tombol detail
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('click', function(e) {
                if (e.target.closest('.detail-btn')) {
                    const button = e.target.closest('.detail-btn');
                    const idPesanan = button.getAttribute('data-id');
                    showDetail(idPesanan);
                }
            });
        });

        function showDetail(idPesanan) {
            alert('Detail untuk pesanan ' + idPesanan + ' akan ditampilkan di modal/popup (akan diimplementasikan selanjutnya)');

            // Nanti kita akan implementasikan:
            // - Modal untuk menampilkan detail pesanan
            // - AJAX untuk mengambil data detail
            // - Tampilan detail yang lengkap
        }

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
</body>

</html>