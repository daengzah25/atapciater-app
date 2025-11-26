<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Tiket - Atap Ciater</title>
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
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
            --success: #28a745;
            --shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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
            font-size: 14px;
            /* Base font size for mobile */
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: var(--white);
            color: var(--text);
            line-height: 1.5;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        /* === TYPOGRAPHY === */
        h1 {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        h2 {
            font-size: 1.75rem;
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

        /* === MOBILE NAVIGATION === */
        .mobile-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            z-index: 1000;
            padding: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .mobile-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-dark);
            font-weight: 700;
            font-size: 1.1rem;
            text-decoration: none;
        }

        .logo i {
            color: var(--primary);
        }

        .menu-toggle {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: var(--text);
            cursor: pointer;
            padding: 0.25rem;
        }

        .mobile-menu {
            position: fixed;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100vh;
            background: var(--white);
            z-index: 2000;
            transition: var(--transition);
            padding: 1rem;
            display: flex;
            flex-direction: column;
        }

        .mobile-menu.active {
            left: 0;
        }

        .menu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
            margin-bottom: 1rem;
        }

        .close-menu {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: var(--text);
            cursor: pointer;
        }

        .mobile-nav-links {
            display: flex;
            flex-direction: column;
            gap: 0;
            flex: 1;
        }

        .mobile-nav-links a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            border-bottom: 1px solid var(--border);
            transition: var(--transition);
        }

        .mobile-nav-links a:hover {
            background: var(--light-bg);
            color: var(--primary);
            padding-left: 1.5rem;
        }

        .mobile-nav-links a i {
            width: 20px;
            text-align: center;
        }

        .menu-actions {
            padding: 1rem 0;
            border-top: 1px solid var(--border);
        }

        /* === PAGE CONTENT === */
        .page-content {
            margin-top: 60px;
            padding: 1rem;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .cek-tiket-card {
            background: var(--white);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            margin-bottom: 1.5rem;
        }

        .page-title {
            text-align: center;
            margin-bottom: 1.5rem;
            color: var(--primary-dark);
        }

        /* === FORM STYLES === */
        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text);
        }

        input {
            width: 100%;
            padding: 0.875rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.95rem;
            transition: var(--transition);
            background: var(--white);
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
        }

        /* === ALERT STYLES === */
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* === TICKET RESULT === */
        .ticket-result {
            margin-top: 2rem;
        }

        .ticket-card {
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            color: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            margin-bottom: 1.5rem;
        }

        .ticket-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .ticket-id {
            font-size: 1.75rem;
            font-weight: bold;
            margin-bottom: 0.75rem;
        }

        .ticket-status {
            display: inline-block;
            padding: 0.5rem 1.25rem;
            border-radius: 20px;
            font-size: 0.85rem;
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

        .ticket-details {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
        }

        .detail-label {
            font-weight: 500;
            font-size: 0.9rem;
        }

        .detail-value {
            font-weight: 600;
            text-align: right;
            font-size: 0.9rem;
        }

        .addon-list {
            margin-top: 1rem;
        }

        .addon-item {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .no-ticket {
            text-align: center;
            padding: 2rem;
            color: var(--text-light);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .back-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* === ANIMATIONS === */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
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

            .page-content {
                padding: 2rem;
            }

            .container {
                max-width: 700px;
            }

            .ticket-details {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* === DESKTOP STYLES === */
        @media (min-width: 1024px) {
            html {
                font-size: 16px;
            }

            .page-content {
                padding: 2rem;
            }

            .container {
                max-width: 800px;
            }
        }

        .logo-image {
            height: 40px;
            /* Sesuaikan dengan kebutuhan */
            width: auto;
            transition: var(--transition);
        }

        /* Untuk mobile menu */
        .mobile-menu .logo-image {
            height: 40px;
        }
    </style>
</head>

<body>
    <!-- Mobile Navigation -->
    <header class="mobile-header">
        <nav class="mobile-nav">
            <a href="{{ route('landing.page') }}" class="logo">
                <img src="{{ asset('images/logo/atap_ciater.png') }}" alt="Atap Ciater" class="logo-image">
                <span>Atap Ciater</span>
            </a>
            <button class="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </nav>
    </header>

    <!-- Mobile Menu -->
    <div class="mobile-menu">
        <div class="menu-header">
            <a href="{{ route('landing.page') }}" class="logo">
                <img src="{{ asset('images/logo/atap_ciater.png') }}" alt="Atap Ciater" class="logo-image">
                <span>Atap Ciater</span>
            </a>
            <button class="close-menu">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="mobile-nav-links">
            <a href="{{ route('landing.page') }}">
                <i class="fas fa-home"></i> Beranda
            </a>
            <a href="{{ route('customer.paket') }}">
                <i class="fas fa-campground"></i> Paket Camping
            </a>
            <a href="{{ route('customer.cektiket') }}">
                <i class="fas fa-ticket-alt"></i> Cek Tiket
            </a>
            <a href="#">
                <i class="fas fa-phone"></i> Kontak
            </a>
        </div>
        <div class="menu-actions">
            <a href="{{ route('customer.paket') }}" class="btn btn-primary">
                <i class="fas fa-calendar-plus"></i> Booking Sekarang
            </a>
        </div>
    </div>

    <!-- Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="cek-tiket-card fade-in">
                <h1 class="page-title">Cek Status Tiket</h1>

                @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}
                </div>
                @endif

                <form method="POST" action="{{ route('customer.cektiket.proses') }}">
                    @csrf
                    <div class="form-group">
                        <label for="id_pesanan">Masukkan ID Pesanan (6 digit)</label>
                        <input type="number" id="id_pesanan" name="id_pesanan" value="{{ old('id_pesanan') }}" required min="100000" max="999999" placeholder="Contoh: 123456">
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <i class="fas fa-search"></i> Cek Status
                    </button>
                </form>

                @if(isset($pesanan))
                <div class="ticket-result fade-in">
                    <div class="ticket-card">
                        <div class="ticket-header">
                            <div class="ticket-id">#{{ $pesanan->id_pesanan }}</div>
                            <span class="ticket-status status-{{ str_replace('_', '-', $pesanan->status) }}">
                                {{ ucwords(str_replace('_', ' ', $pesanan->status)) }}
                            </span>
                        </div>

                        <div class="ticket-details">
                            <div class="detail-item">
                                <span class="detail-label">Nama Pemesan</span>
                                <span class="detail-value">{{ $pesanan->nama_pemesan }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Tanggal Booking</span>
                                <span class="detail-value">{{ \Carbon\Carbon::parse($pesanan->tanggal_booking)->translatedFormat('l, d F Y') }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Paket</span>
                                <span class="detail-value">{{ $pesanan->nama_paket }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Metode Bayar</span>
                                <span class="detail-value">{{ $pesanan->metode_bayar == 'dp_50%' ? 'DP 50%' : 'Lunas' }}</span>
                            </div>
                        </div>

                        @if($pesanan->detailPesanan->count() > 0)
                        <div class="addon-list">
                            <h3 style="margin-bottom: 1rem; text-align: center;">Tambahan</h3>
                            @foreach($pesanan->detailPesanan as $detail)
                            <div class="addon-item">
                                <span>{{ $detail->nama_addons }} (x{{ $detail->jumlah }})</span>
                                <span>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <div class="detail-item" style="margin-top: 1.5rem; background: rgba(255,255,255,0.2);">
                            <span class="detail-label">Total Pembayaran</span>
                            <span class="detail-value" style="font-size: 1.1rem;">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <a href="{{ route('customer.cektiket') }}" class="back-link">
                        <i class="fas fa-arrow-left"></i> Cek Tiket Lainnya
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Mobile Menu Functionality
        const menuToggle = document.querySelector('.menu-toggle');
        const closeMenu = document.querySelector('.close-menu');
        const mobileMenu = document.querySelector('.mobile-menu');
        const mobileLinks = document.querySelectorAll('.mobile-nav-links a');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        closeMenu.addEventListener('click', () => {
            mobileMenu.classList.remove('active');
            document.body.style.overflow = 'auto';
        });

        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                document.body.style.overflow = 'auto';
            });
        });

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

        // Format input ID Pesanan
        document.getElementById('id_pesanan').addEventListener('input', function(e) {
            if (this.value.length > 6) {
                this.value = this.value.slice(0, 6);
            }
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
        }, {
            passive: false
        });

        let lastTouchEnd = 0;
        document.addEventListener('touchend', function(e) {
            const now = (new Date()).getTime();
            if (now - lastTouchEnd <= 300) {
                e.preventDefault();
            }
            lastTouchEnd = now;
        }, false);
    </script>
</body>

</html>