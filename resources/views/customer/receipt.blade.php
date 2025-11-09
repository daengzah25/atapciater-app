<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt - Atap Ciater</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* === MOBILE FIRST VARIABLES === */
        :root {
            --primary: #2e7d32;
            --primary-light: #4caf50;
            --primary-dark: #1b5e20;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --text: #333333;
            --text-light: #666666;
            --border: #e0e0e0;
            --success: #388e3c;
            --warning: #ffc107;
            --info: #17a2b8;
            --shadow: 0 2px 8px rgba(0,0,0,0.1);
            --transition: all 0.3s ease;
        }
        
        /* === RESET & BASE STYLES === */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html {
            scroll-behavior: smooth;
            font-size: 14px; /* Base font size for mobile */
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--text);
            line-height: 1.5;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        img {
            max-width: 100%;
            height: auto;
        }
        
        /* === TYPOGRAPHY === */
        h1 {
            font-size: 1.75rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0.5rem;
        }
        
        h2 {
            font-size: 1.5rem;
            font-weight: 600;
            line-height: 1.3;
            margin-bottom: 1rem;
        }
        
        h3 {
            font-size: 1.25rem;
            font-weight: 600;
            line-height: 1.4;
            margin-bottom: 0.75rem;
        }
        
        p {
            margin-bottom: 1rem;
            color: var(--text-light);
        }
        
        /* === BUTTONS === */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem 1.5rem;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
            font-size: 0.9rem;
            width: 100%;
            max-width: 280px;
            margin: 0.25rem auto;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            color: var(--white);
            box-shadow: var(--shadow);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
        }
        
        .btn-secondary {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }
        
        .btn-secondary:hover {
            background: var(--primary);
            color: var(--white);
        }
        
        .btn-whatsapp {
            background: #25D366;
            color: white;
            box-shadow: var(--shadow);
        }
        
        .btn-whatsapp:hover {
            background: #128C7E;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
        }
        
        /* === RECEIPT CONTAINER === */
        .receipt-container {
            max-width: 500px;
            width: 100%;
        }
        
        .receipt-card {
            background: var(--white);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            margin-bottom: 1.5rem;
            animation: fadeInUp 0.8s ease-out;
        }
        
        .receipt-header {
            text-align: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--primary-light);
        }
        
        .success-icon {
            width: 70px;
            height: 70px;
            background: var(--success);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.75rem;
            box-shadow: 0 4px 12px rgba(56, 142, 60, 0.3);
        }
        
        .receipt-title {
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }
        
        .receipt-subtitle {
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        /* === INFO SECTION === */
        .info-section {
            margin-bottom: 1.5rem;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--border);
        }
        
        .info-label {
            font-weight: 500;
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        .info-value {
            font-weight: 600;
            text-align: right;
            font-size: 0.9rem;
        }
        
        /* === DETAIL SECTION === */
        .detail-section {
            background: var(--light-bg);
            border-radius: 10px;
            padding: 1.25rem;
            margin-bottom: 1.5rem;
        }
        
        .detail-title {
            color: var(--primary-dark);
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        
        .addon-detail {
            padding-left: 0.75rem;
            color: var(--text-light);
        }
        
        /* === STATUS BADGE === */
        .status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
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
            background: #dc3545;
            color: white;
        }
        
        .status-selesai {
            background: var(--success);
            color: white;
        }
        
        /* === TOTAL SECTION === */
        .total-section {
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            color: white;
            border-radius: 10px;
            padding: 1.25rem;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .total-label {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }
        
        .total-amount {
            font-size: 1.75rem;
            font-weight: bold;
        }
        
        /* === ACTION BUTTONS === */
        .action-buttons {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }
        
        .whatsapp-notification {
            background: rgba(37, 211, 102, 0.1);
            border: 1px solid rgba(37, 211, 102, 0.3);
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
            margin-bottom: 0.75rem;
        }
        
        .whatsapp-notification i {
            color: #25D366;
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }
        
        .whatsapp-notification p {
            margin: 0;
            color: #25D366;
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        /* === ANIMATIONS === */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* === TABLET STYLES === */
        @media (min-width: 768px) {
            html {
                font-size: 15px;
            }
            
            .btn {
                width: auto;
                margin: 0.25rem;
            }
            
            .receipt-card {
                padding: 2rem;
            }
            
            .action-buttons {
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
            }
            
            .whatsapp-notification {
                grid-column: 1 / -1;
                margin-bottom: 0;
            }
        }
        
        /* === DESKTOP STYLES === */
        @media (min-width: 1024px) {
            html {
                font-size: 16px;
            }
            
            .receipt-container {
                max-width: 550px;
            }
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <div class="receipt-card">
            <div class="receipt-header">
                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h1 class="receipt-title">Booking Berhasil!</h1>
                <p class="receipt-subtitle">Terima kasih telah memesan di Atap Ciater</p>
            </div>

            <div class="info-section">
                <div class="info-item">
                    <span class="info-label">ID Pesanan</span>
                    <span class="info-value">{{ $pesanan->id_pesanan }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Nama Pemesan</span>
                    <span class="info-value">{{ $pesanan->nama_pemesan }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Tanggal Booking</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($pesanan->tanggal_booking)->format('d F Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">No. WhatsApp</span>
                    <span class="info-value">{{ $pesanan->no_wa }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status</span>
                    <span class="info-value">
                        <span class="status-badge status-{{ str_replace('_', '-', $pesanan->status) }}">
                            {{ ucwords(str_replace('_', ' ', $pesanan->status)) }}
                        </span>
                    </span>
                </div>
            </div>

            <div class="detail-section">
                <h3 class="detail-title">Detail Pesanan</h3>

                <div class="detail-item">
                    <span>{{ $pesanan->nama_paket }}</span>
                    <span>Rp {{ number_format($pesanan->harga_paket, 0, ',', '.') }}</span>
                </div>

                @foreach($pesanan->detailPesanan as $detail)
                <div class="detail-item addon-detail">
                    <span>{{ $detail->nama_addons }} (x{{ $detail->jumlah }})</span>
                    <span>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                </div>
                @endforeach
                
                <!-- Tambahkan informasi total full dan sisa bayar untuk DP -->
                @php
                $totalFull = $pesanan->harga_paket;
                foreach($pesanan->detailPesanan as $detail) {
                $totalFull += $detail->subtotal;
                }
                @endphp

                @if($pesanan->metode_bayar == 'dp_50%')
                <div class="detail-item" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--border);">
                    <span><strong>Total Harga:</strong></span>
                    <span><strong>Rp {{ number_format($totalFull, 0, ',', '.') }}</strong></span>
                </div>
                <div class="detail-item">
                    <span>DP 50% yang Dibayar:</span>
                    <span>Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                </div>
                <div class="detail-item">
                    <span>Sisa Pembayaran:</span>
                    <span>Rp {{ number_format($totalFull - $pesanan->total, 0, ',', '.') }}</span>
                </div>
                <div class="detail-item" style="color: var(--text-light); font-size: 0.85rem;">
                    <span><em>Catatan: Sisa pembayaran dapat dilunasi di tempat saat check-in</em></span>
                </div>
                @endif

                <div class="detail-item" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--border);">
                    <span><strong>Metode Bayar</strong></span>
                    <span><strong>{{ $pesanan->metode_bayar == 'dp_50%' ? 'DP 50%' : 'Lunas' }}</strong></span>
                </div>
            </div>

            <div class="total-section">
                <div class="total-label">Total Pembayaran</div>
                <div class="total-amount">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</div>
            </div>

            <div class="action-buttons">
                <div class="whatsapp-notification">
                    <i class="fab fa-whatsapp"></i>
                    <p>Notifikasi WhatsApp telah dikirim otomatis ke nomor Anda</p>
                </div>
                <a href="{{ route('landing.page') }}" class="btn btn-secondary">
                    <i class="fas fa-home"></i> Kembali ke Home
                </a>
                <a href="{{ route('customer.paket') }}" class="btn btn-primary">
                    <i class="fas fa-campground"></i> Pesan Lagi
                </a>
            </div>
        </div>
    </div>

    <script>
        // Scroll Animations
        const fadeElements = document.querySelectorAll('.fade-in');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        fadeElements.forEach(element => {
            observer.observe(element);
        });

        // Touch Device Optimization
        if ('ontouchstart' in window) {
            document.documentElement.classList.add('touch-device');
        }

        // Prevent Zoom on Double Tap (iOS)
        document.addEventListener('touchstart', function(e) {
            if (e.touches.length > 1) {
                e.preventDefault();
            }
        }, { passive: false });

        let lastTouchEnd = 0;
        document.addEventListener('touchend', function(e) {
            const now = (new Date()).getTime();
            if (now - lastTouchEnd <= 300) {
                e.preventDefault();
            }
            lastTouchEnd = now;
        }, false);

        // Auto-scroll ke atas setelah load
        window.scrollTo(0, 0);
    </script>
</body>

</html>