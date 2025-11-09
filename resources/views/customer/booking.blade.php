<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - Atap Ciater</title>
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
            --error: #d32f2f;
            --success: #388e3c;
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

        .breadcrumb {
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }

        .breadcrumb a {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .breadcrumb a:hover {
            color: var(--primary-dark);
        }

        .booking-card {
            background: var(--white);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            margin-bottom: 1.5rem;
        }

        .section-title {
            color: var(--primary-dark);
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--primary-light);
            font-size: 1.25rem;
        }

        .paket-info {
            background: var(--light-bg);
            padding: 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        .paket-name {
            font-size: 1.1rem;
            font-weight: bold;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }

        .paket-price {
            font-size: 1.25rem;
            color: var(--primary);
            font-weight: bold;
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

        input,
        select,
        textarea {
            width: 100%;
            padding: 0.875rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.95rem;
            transition: var(--transition);
            background: var(--white);
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
        }

        /* === ADDON STYLES === */
        .addon-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            margin-bottom: 0.75rem;
            transition: var(--transition);
        }

        .addon-item:hover {
            border-color: var(--primary-light);
        }

        .addon-info {
            flex: 1;
        }

        .addon-name {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .addon-price {
            color: var(--primary);
            font-size: 0.9rem;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .qty-btn {
            width: 35px;
            height: 35px;
            border: 1px solid var(--border);
            background: var(--white);
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .qty-btn:active {
            background: var(--light-bg);
            transform: scale(0.95);
        }

        .qty-input {
            width: 50px;
            text-align: center;
            font-weight: 500;
        }

        /* === PAYMENT METHODS === */
        .payment-methods {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .payment-option {
            border: 2px solid var(--border);
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .payment-option.selected {
            border-color: var(--primary);
            background-color: rgba(46, 125, 50, 0.05);
        }

        .payment-option strong {
            display: block;
            margin-bottom: 0.25rem;
        }

        .payment-option small {
            color: var(--text-light);
        }

        .hidden {
            display: none;
        }

        /* === BANK INFO === */
        .bank-info {
            margin-bottom: 1.5rem;
        }

        .bank-card {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 1rem;
            box-shadow: 0 5px 15px rgba(46, 125, 50, 0.3);
        }

        .bank-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .bank-header i {
            font-size: 1.75rem;
        }

        .bank-name {
            font-size: 1.1rem;
            font-weight: bold;
        }

        .bank-details {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .bank-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .bank-label {
            font-weight: 500;
            min-width: 120px;
            font-size: 0.9rem;
        }

        .bank-value {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            flex: 1;
            font-size: 0.9rem;
        }

        .copy-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.5);
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
        }

        .copy-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .copy-btn.copied {
            background: var(--primary-light);
            border-color: var(--primary-light);
        }

        .bank-notice {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 10px;
            padding: 1rem;
            color: #856404;
            font-size: 0.9rem;
        }

        .bank-notice i {
            color: #856404;
            margin-right: 0.5rem;
        }

        /* === TOTAL SECTION === */
        .total-section {
            background: var(--light-bg);
            padding: 1.25rem;
            border-radius: 10px;
            margin: 1.5rem 0;
        }

        .total-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .total-final {
            font-size: 1.1rem;
            font-weight: bold;
            color: var(--primary);
            border-top: 1px solid var(--border);
            padding-top: 0.5rem;
            margin-top: 0.5rem;
        }

        /* === FILE UPLOAD === */
        .file-upload {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .file-upload input[type="file"] {
            position: absolute;
            left: -9999px;
        }

        .file-upload-label {
            display: block;
            padding: 1rem;
            border: 2px dashed var(--border);
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .file-upload-label:hover {
            border-color: var(--primary-light);
            background: rgba(76, 175, 80, 0.05);
        }

        .file-upload-label i {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .file-upload-label span {
            display: block;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .file-upload-label small {
            color: var(--text-light);
        }

        .file-name {
            margin-top: 0.5rem;
            font-size: 0.9rem;
            color: var(--primary);
            font-weight: 500;
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

            .payment-methods {
                grid-template-columns: 1fr 1fr;
            }

            .bank-item {
                flex-direction: row;
                align-items: center;
            }

            .copy-btn {
                align-self: auto;
                justify-content: center;
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
            <div class="breadcrumb">
                <a href="{{ route('customer.paket') }}"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Paket</a>
            </div>

            <div class="booking-card fade-in">
                <h2 class="section-title">Form Booking</h2>

                <div class="paket-info">
                    <div class="paket-name">{{ $paket->nama_paket }}</div>
                    <div class="paket-price">Rp {{ number_format($paket->harga, 0, ',', '.') }}</div>
                </div>

                <form id="bookingForm" action="{{ route('customer.booking.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_paket" value="{{ $paket->id_paket }}">
                    <input type="hidden" name="harga_paket" value="{{ $paket->harga }}">
                    <input type="hidden" name="nama_paket" value="{{ $paket->nama_paket }}">

                    <!-- Tambahkan ini untuk JavaScript -->
                    <input type="hidden" id="harga_paket_value" value="{{ $paket->harga }}">

                    <div class="form-group">
                        <label for="nama_pemesan">Nama Pemesan *</label>
                        <input type="text" id="nama_pemesan" name="nama_pemesan" required>
                    </div>

                    <div class="form-group">
                        <label for="no_wa">Nomor WhatsApp *</label>
                        <input type="tel" id="no_wa" name="no_wa" required placeholder="Contoh: 081234567890">
                    </div>

                    <div class="form-group">
                        <label for="tanggal_booking">Tanggal Booking *</label>
                        <select id="tanggal_booking" name="tanggal_booking" required>
                            <option value="">Pilih Tanggal</option>
                            @foreach($slots as $slot)
                            <option value="{{ $slot->tanggal }}" data-slot-tersedia="{{ $slot->slot_tersedia }}">
                                {{ \Carbon\Carbon::parse($slot->tanggal)->format('d F Y') }} (Tersedia: {{ $slot->slot_tersedia }} slot)
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="catatan">Catatan (Opsional)</label>
                        <textarea id="catatan" name="catatan" rows="3" placeholder="Contoh: Ada alergi makanan, dll."></textarea>
                    </div>

                    <h3 class="section-title">Tambahan (Opsional)</h3>

                    <div id="addons-container">
                        @foreach($addons as $addon)
                        <div class="addon-item" data-addon-id="{{ $addon->id_addons }}" data-addon-price="{{ $addon->harga }}" data-addon-stock="{{ $addon->stok }}">
                            <div class="addon-info">
                                <div class="addon-name">{{ $addon->nama_addons }}</div>
                                <div class="addon-price">Rp {{ number_format($addon->harga, 0, ',', '.') }} / unit</div>
                            </div>
                            <div class="quantity-controls">
                                <button type="button" class="qty-btn minus" data-addon-id="{{ $addon->id_addons }}">-</button>
                                <input type="number" class="qty-input" id="qty-{{ $addon->id_addons }}"
                                    name="addons[{{ $addon->id_addons }}]" value="0" min="0" max="{{ $addon->stok }}" readonly>
                                <button type="button" class="qty-btn plus" data-addon-id="{{ $addon->id_addons }}">+</button>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <h3 class="section-title">Metode Pembayaran</h3>

                    <div class="payment-methods">
                        <div class="payment-option" data-method="dp_50%">
                            <input type="radio" id="dp" name="metode_bayar" value="dp_50%" class="hidden">
                            <label for="dp" style="cursor: pointer;">
                                <strong>DP 50%</strong><br>
                                <small>Bayar 50% sekarang</small>
                            </label>
                        </div>
                        <div class="payment-option" data-method="lunas">
                            <input type="radio" id="lunas" name="metode_bayar" value="lunas" class="hidden">
                            <label for="lunas" style="cursor: pointer;">
                                <strong>Lunas</strong><br>
                                <small>Bayar 100% sekarang</small>
                            </label>
                        </div>
                    </div>

                    <!-- Tambahkan setelah section Metode Pembayaran -->
                    <h3 class="section-title">Informasi Pembayaran</h3>

                    <div class="bank-info">
                        <div class="bank-card">
                            <div class="bank-header">
                                <i class="fas fa-university"></i>
                                <div class="bank-name">Bank BCA</div>
                            </div>
                            <div class="bank-details">
                                <div class="bank-item">
                                    <span class="bank-label">Nomor Rekening:</span>
                                    <span class="bank-value">0551650072</span>
                                    <button class="copy-btn" data-text="123456789012">
                                        <i class="fas fa-copy"></i> Salin
                                    </button>
                                </div>
                                <div class="bank-item">
                                    <span class="bank-label">Atas Nama:</span>
                                    <span class="bank-value">Ridwan Ismail</span>
                                </div>
                            </div>
                        </div>

                        <div class="bank-notice">
                            <p><i class="fas fa-info-circle"></i> <strong>Penting:</strong> Harap transfer sesuai dengan total pembayaran yang tertera di bawah. Simpan bukti transfer untuk diupload.</p>
                        </div>
                    </div>

                    <div class="total-section">
                        <div class="total-line">
                            <span>Harga Paket:</span>
                            <span id="display-harga-paket">Rp {{ number_format($paket->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="total-line">
                            <span>Tambahan:</span>
                            <span id="display-tambahan">Rp 0</span>
                        </div>
                        <div class="total-line total-final">
                            <span>Total Pembayaran:</span>
                            <span id="display-total">Rp {{ number_format($paket->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="screenshot">Upload Bukti Pembayaran *</label>
                        <div class="file-upload">
                            <input type="file" id="screenshot" name="screenshot" accept="image/*" required>
                            <label for="screenshot" class="file-upload-label">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>Pilih File Bukti Pembayaran</span>
                                <small>Format: JPG, PNG (Maks. 2MB)</small>
                            </label>
                            <div class="file-name" id="file-name"></div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" id="submit-btn" style="width: 100%;">
                        <i class="fas fa-paper-plane"></i> Konfirmasi Booking
                    </button>
                </form>
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

        // Data harga paket dari hidden input
        const hargaPaket = parseInt(document.getElementById('harga_paket_value').value);

        // Variabel untuk perhitungan
        let totalTambahan = 0;
        let totalBayar = hargaPaket;

        // Elemen untuk display
        const displayTambahan = document.getElementById('display-tambahan');
        const displayTotal = document.getElementById('display-total');
        const submitBtn = document.getElementById('submit-btn');

        // Format Rupiah
        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Update display
        function updateDisplay() {
            displayTambahan.textContent = 'Rp ' + formatRupiah(totalTambahan);
            displayTotal.textContent = 'Rp ' + formatRupiah(totalBayar);
        }

        // Quantity controls
        document.querySelectorAll('.qty-btn').forEach(button => {
            button.addEventListener('click', function() {
                const addonId = this.getAttribute('data-addon-id');
                const input = document.getElementById('qty-' + addonId);
                let value = parseInt(input.value);

                // Dapatkan harga dari data attribute
                const addonItem = document.querySelector(`[data-addon-id="${addonId}"]`);
                const addonPrice = parseInt(addonItem.getAttribute('data-addon-price'));

                if (this.classList.contains('plus')) {
                    if (value < parseInt(input.max)) {
                        value++;
                    }
                } else if (this.classList.contains('minus')) {
                    if (value > 0) {
                        value--;
                    }
                }

                input.value = value;

                // Update perhitungan
                calculateTotal();
            });
        });

        // Payment method selection
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function() {
                // Remove selected class from all options
                document.querySelectorAll('.payment-option').forEach(opt => {
                    opt.classList.remove('selected');
                });

                // Add selected class to clicked option
                this.classList.add('selected');

                // Check the radio button
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;

                // Update perhitungan
                calculateTotal();
            });
        });

        // Calculate total
        function calculateTotal() {
            totalTambahan = 0;

            // Hitung total addons dari data attributes
            document.querySelectorAll('.addon-item').forEach(item => {
                const addonId = item.getAttribute('data-addon-id');
                const addonPrice = parseInt(item.getAttribute('data-addon-price'));
                const input = document.getElementById('qty-' + addonId);
                const quantity = parseInt(input.value);

                totalTambahan += quantity * addonPrice;
            });

            // Hitung total bayar berdasarkan metode pembayaran
            const selectedPayment = document.querySelector('input[name="metode_bayar"]:checked');
            if (selectedPayment) {
                if (selectedPayment.value === 'dp_50%') {
                    totalBayar = Math.floor((hargaPaket + totalTambahan) * 0.5);
                } else {
                    totalBayar = hargaPaket + totalTambahan;
                }
            } else {
                totalBayar = hargaPaket + totalTambahan;
            }

            updateDisplay();
        }

        // File upload display
        const fileInput = document.getElementById('screenshot');
        const fileName = document.getElementById('file-name');

        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
            } else {
                fileName.textContent = '';
            }
        });

        // Form submission
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Validasi dasar
            const namaPemesan = document.getElementById('nama_pemesan').value;
            const noWa = document.getElementById('no_wa').value;
            const tanggalBooking = document.getElementById('tanggal_booking').value;
            const metodeBayar = document.querySelector('input[name="metode_bayar"]:checked');
            const screenshot = document.getElementById('screenshot').files[0];

            if (!namaPemesan || !noWa || !tanggalBooking || !metodeBayar || !screenshot) {
                alert('Harap lengkapi semua field yang wajib diisi!');
                return;
            }

            // Validasi format nomor WhatsApp
            const waRegex = /^[0-9]{10,13}$/;
            if (!waRegex.test(noWa.replace(/[^0-9]/g, ''))) {
                alert('Format nomor WhatsApp tidak valid!');
                return;
            }

            // Validasi ukuran file
            if (screenshot.size > 2 * 1024 * 1024) { // 2MB
                alert('Ukuran file maksimal 2MB!');
                return;
            }

            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

            // Submit form
            this.submit();
        });

        // Initialize display
        updateDisplay();

        // Copy to clipboard function
        document.querySelectorAll('.copy-btn').forEach(button => {
            button.addEventListener('click', function() {
                const textToCopy = this.getAttribute('data-text');

                // Menggunakan Clipboard API
                navigator.clipboard.writeText(textToCopy).then(() => {
                    // Ubah tampilan tombol sementara
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
                    this.classList.add('copied');

                    // Kembalikan ke keadaan semula setelah 2 detik
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.classList.remove('copied');
                    }, 2000);
                }).catch(err => {
                    // Fallback untuk browser lama
                    const textArea = document.createElement('textarea');
                    textArea.value = textToCopy;
                    document.body.appendChild(textArea);
                    textArea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textArea);

                    // Ubah tampilan tombol sementara
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
                    this.classList.add('copied');

                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.classList.remove('copied');
                    }, 2000);
                });
            });
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