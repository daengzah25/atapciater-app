<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atap Ciater - Camping Ground & Adventure</title>
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

        .btn-white {
            background: var(--white);
            color: var(--primary);
            box-shadow: var(--shadow);
        }

        .btn-white:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
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

        /* === HERO SECTION === */
        .hero {
            min-height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.3)),
            url("{{ asset('images/gallery/atap_ciater1.jpeg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: scroll;
            display: flex;
            justify-content: center;
            padding: 6rem 1rem 2rem;
            text-align: center;
            color: var(--white);
        }

        .hero-content {
            max-width: 400px;
            margin: 0 auto;
            animation: fadeInUp 0.8s ease-out;
        }

        .hero h1 {
            font-size: 2.25rem;
            margin-bottom: 1rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }

        .hero p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            color: rgba(255, 255, 255, 0.9);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .hero-actions {
            position: absolute;
            bottom: 20px;
            /* jarak dari bawah */
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            align-items: center;
        }

        /* === FEATURES SECTION === */
        .section {
            padding: 3rem 1rem;
        }

        .section-title {
            text-align: center;
            margin-bottom: 2rem;
        }

        .section-title h2 {
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }

        .features {
            background: var(--light-bg);
        }

        .features-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            max-width: 400px;
            margin: 0 auto;
        }

        .feature-card {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: var(--white);
            font-size: 1.5rem;
        }

        /* === PACKAGES SECTION === */
        .packages-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            max-width: 400px;
            margin: 0 auto;
        }

        .package-card {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .package-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .package-image {
            height: 160px;
            background: linear-gradient(45deg, var(--primary-light), var(--primary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 2rem;
            position: relative;
            overflow: hidden;
        }

        .package-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .package-content {
            padding: 1.25rem;
        }

        .package-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .package-features {
            list-style: none;
            margin-bottom: 1.5rem;
        }

        .package-features li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border);
            font-size: 0.9rem;
        }

        .package-features li:last-child {
            border-bottom: none;
        }

        .package-features i {
            color: var(--primary-light);
            width: 16px;
        }

        /* === GALLERY SECTION === */
        .gallery {
            background: var(--light-bg);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
            max-width: 400px;
            margin: 0 auto;
        }

        .gallery-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            aspect-ratio: 3/4;
            transition: var(--transition);
            cursor: pointer;
        }

        .gallery-item:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        /* === TESTIMONIALS === */
        .testimonials {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: var(--white);
        }

        .testimonials .section-title h2 {
            color: var(--white);
        }

        .testimonials .section-title p {
            color: rgba(255, 255, 255, 0.8);
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            max-width: 400px;
            margin: 0 auto;
        }

        .testimonial-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }

        .testimonial-text {
            font-style: italic;
            margin-bottom: 1.25rem;
            line-height: 1.6;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .author-avatar {
            width: 45px;
            height: 45px;
            background: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: 700;
            font-size: 0.9rem;
        }

        .author-info h4 {
            margin-bottom: 0.25rem;
            font-size: 1rem;
        }

        .author-info p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
            margin: 0;
        }

        /* === CTA SECTION === */
        .cta {
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            color: var(--white);
            text-align: center;
            padding: 3rem 1rem;
            border-radius: 12px;
            margin: 0.5rem 0.5rem;
        }

        .cta h2 {
            margin-bottom: 1rem;
            font-size: 1.75rem;
        }

        .cta p {
            color: var(--white);
        }

        .cta-actions {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            align-items: center;
            margin-top: 1.5rem;
        }

        /* === FOOTER === */
        .footer {
            background: var(--primary-dark);
            color: var(--white);
            padding: 2rem 1rem 1rem;
            border-radius: 12px;
            margin: 0.5rem 0.5rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            max-width: 400px;
            margin: 0 auto 2rem;
        }

        .footer-col h3 {
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .footer-col p {
            color: var(--white);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .footer-links a:hover {
            color: var(--white);
            padding-left: 0.5rem;
        }

        .contact-info {
            list-style: none;
        }

        .contact-info li {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            margin-bottom: 1rem;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .contact-info i {
            margin-top: 0.125rem;
            width: 16px;
        }

        .social-links {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .social-links a {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .social-links a:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
        }

        .footer-bottom p {
            color: rgba(255, 255, 255, 0.7);
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

            .hero {
                padding: 7rem 2rem 3rem;
                background-attachment: fixed;
            }

            .hero-content {
                max-width: 600px;
            }

            .hero h1 {
                font-size: 3rem;
            }

            .hero-actions {
                flex-direction: row;
                justify-content: center;
            }

            .section {
                padding: 4rem 2rem;
            }

            .features-grid,
            .packages-grid,
            .testimonials-grid {
                grid-template-columns: repeat(2, 1fr);
                max-width: 700px;
                gap: 2rem;
            }

            .gallery-grid {
                grid-template-columns: repeat(3, 1fr);
                max-width: 700px;
                gap: 1rem;
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
                max-width: 700px;
            }
        }

        /* === DESKTOP STYLES === */
        @media (min-width: 1024px) {
            html {
                font-size: 16px;
            }

            .hero {
                padding: 8rem 2rem 4rem;
            }

            .hero-content {
                max-width: 800px;
            }

            .hero h1 {
                font-size: 3.5rem;
            }

            .features-grid {
                grid-template-columns: repeat(4, 1fr);
                max-width: 1200px;
            }

            .packages-grid {
                grid-template-columns: repeat(3, 1fr);
                max-width: 1200px;
            }

            .gallery-grid {
                grid-template-columns: repeat(4, 1fr);
                max-width: 1200px;
                gap: 1.5rem;
            }

            .testimonials-grid {
                grid-template-columns: repeat(3, 1fr);
                max-width: 1200px;
            }

            .footer-grid {
                grid-template-columns: repeat(3, 1fr);
                max-width: 1200px;
            }
        }

        /* === LARGE DESKTOP === */
        @media (min-width: 1440px) {
            .section {
                padding: 5rem 2rem;
            }
        }

        /* === UTILITY CLASSES === */
        .text-center {
            text-align: center;
        }

        .mt-1 {
            margin-top: 1rem;
        }

        .mt-2 {
            margin-top: 2rem;
        }

        .mb-1 {
            margin-bottom: 1rem;
        }

        .mb-2 {
            margin-bottom: 2rem;
        }

        .logo-image {
            height: 40px;
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
                <img src="{{ asset('images/logo/lmdh.png') }}" alt="Atap Ciater" class="logo-image">
                <span>LMDH</span>
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
            <a href="#galeri">
                <i class="fas fa-images"></i> Galeri
            </a>
            <a href="#tentang">
                <i class="fas fa-info-circle"></i> Tentang Kami
            </a>
            <a href="#kontak">
                <i class="fas fa-phone"></i> Kontak
            </a>
        </div>
        <div class="menu-actions">
            <a href="{{ route('customer.paket') }}" class="btn btn-primary">
                <i class="fas fa-calendar-plus"></i> Booking Sekarang
            </a>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Petualangan Alam Terbaik Dimulai Di Sini</h1>
            <p>Nikmati momen tak terlupakan di Atap Ciater dengan pemandangan memukau dan fasilitas premium</p>
            <div class="hero-actions">
                <a href="{{ route('customer.paket') }}" class="btn btn-primary">
                    <i class="fas fa-calendar-plus"></i> Booking Sekarang
                </a>
                <a href="#paket" class="btn btn-primary">
                    <i class="fas fa-campground"></i> Lihat Paket
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section features">
        <div class="section-title fade-in">
            <h2>Kenapa Pilih Atap Ciater?</h2>
            <p>Pengalaman camping terbaik dengan fasilitas unggulan</p>
        </div>
        <div class="features-grid">
            <div class="feature-card fade-in">
                <div class="feature-icon">
                    <i class="fas fa-mountain"></i>
                </div>
                <h3>Pemandangan Eksklusif</h3>
                <p>Nikmati keindahan alam dari ketinggian dengan udara sejuk dan pemandangan memukau</p>
            </div>
            <div class="feature-card fade-in">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Aman & Terjaga</h3>
                <p>Area camping yang aman dengan keamanan 24 jam untuk kenyamanan Anda</p>
            </div>
            <div class="feature-card fade-in">
                <div class="feature-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <h3>Perlengkapan Lengkap</h3>
                <p>Tersedia peralatan camping berkualitas tinggi untuk disewa sesuai kebutuhan</p>
            </div>
            <div class="feature-card fade-in">
                <div class="feature-icon">
                    <i class="fas fa-user-friends"></i>
                </div>
                <h3>Pemandu Profesional</h3>
                <p>Didampingi pemandu wisata berpengalaman untuk pengalaman terbaik</p>
            </div>
        </div>
    </section>

    <!-- Packages Section -->
    <section class="section" id="paket">
        <div class="section-title fade-in">
            <h2>Paket Camping Populer</h2>
            <p>Pilih paket yang sesuai dengan kebutuhan petualangan Anda</p>
        </div>
        <div class="packages-grid">
            @foreach($pakets->take(3) as $paket)
            <div class="package-card fade-in">
                <div class="package-image">
                    @if($paket->gambar && file_exists(public_path('images/paket_images/' . $paket->gambar)))
                    <img src="{{ asset('images/paket_images/' . $paket->gambar) }}" alt="{{ $paket->nama_paket }}">
                    @else
                    <i class="fas fa-campground"></i>
                    @endif
                </div>
                <div class="package-content">
                    <h3>{{ $paket->nama_paket }}</h3>
                    <div class="package-price">Rp {{ number_format($paket->harga, 0, ',', '.') }}</div>
                    <ul class="package-features">
                        <li><i class="fas fa-users"></i> Tersedia {{ $paket->slot }} Slot</li>
                        <li><i class="fas fa-list"></i> {{ Str::limit($paket->fasilitas, 40) }}</li>
                    </ul>
                    <a href="{{ route('customer.paket') }}" class="btn btn-primary">
                        <i class="fas fa-info-circle"></i> Detail & Booking
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-2">
            <a href="{{ route('customer.paket') }}" class="btn btn-secondary">
                <i class="fas fa-list"></i> Lihat Semua Paket
            </a>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="section gallery" id="galeri">
        <div class="section-title fade-in">
            <h2>Galeri Atap Ciater</h2>
            <p>Lihat momen-momen indah di tempat camping kami</p>
        </div>
        <div class="gallery-grid">
            <div class="gallery-item fade-in">
                <img src="{{ asset('images/gallery/atap_ciater1.jpeg') }}" alt="Atap Ciater 1" loading="lazy">
            </div>
            <div class="gallery-item fade-in">
                <img src="{{ asset('images/gallery/atap_ciater2.jpeg') }}" alt="Atap Ciater 2" loading="lazy">
            </div>
            <div class="gallery-item fade-in">
                <img src="{{ asset('images/gallery/atap_ciater3.jpeg') }}" alt="Atap Ciater 3" loading="lazy">
            </div>
            <div class="gallery-item fade-in">
                <img src="{{ asset('images/gallery/atap_ciater4.jpeg') }}" alt="Atap Ciater 4" loading="lazy">
            </div>
            <div class="gallery-item fade-in">
                <img src="{{ asset('images/gallery/atap_ciater5.jpeg') }}" alt="Atap Ciater 5" loading="lazy">
            </div>
            <div class="gallery-item fade-in">
                <img src="{{ asset('images/gallery/atap_ciater6.jpeg') }}" alt="Atap Ciater 6" loading="lazy">
            </div>
            <div class="gallery-item fade-in">
                <img src="{{ asset('images/gallery/atap_ciater7.jpeg') }}" alt="Atap Ciater 7" loading="lazy">
            </div>
            <div class="gallery-item fade-in">
                <img src="{{ asset('images/gallery/atap_ciater8.jpeg') }}" alt="Atap Ciater 8" loading="lazy">
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <h2 class="fade-in">Siap Memulai Petualangan?</h2>
        <p class="fade-in">Jadwalkan pengalaman camping tak terlupakan Anda sekarang</p>
        <div class="cta-actions">
            <a href="{{ route('customer.paket') }}" class="btn btn-white">
                <i class="fas fa-calendar-plus"></i> Booking Sekarang
            </a>
            <a href="{{ route('customer.cektiket') }}" class="btn btn-white">
                <i class="fas fa-ticket-alt"></i> Cek Tiket Saya
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="kontak">
        <div class="footer-grid">
            <div class="footer-col">
                <h3>Atap Ciater</h3>
                <p>Destinasi camping premium dengan pemandangan alam menakjubkan dan fasilitas lengkap untuk pengalaman outdoor terbaik.</p>
                <div class="social-links">
                    <a href="https://www.instagram.com/atapciater1540mdpl"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.tiktok.com/@atap.ciater1540mdpl"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h3>Menu Cepat</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('landing.page') }}">Beranda</a></li>
                    <li><a href="{{ route('customer.paket') }}">Paket Camping</a></li>
                    <li><a href="{{ route('customer.cektiket') }}">Cek Tiket</a></li>
                    <li><a href="#galeri">Galeri</a></li>
                    <li><a href="#tentang">Tentang Kami</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Hubungi Kami</h3>
                <ul class="contact-info">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Jl. Ciater No. 123, Subang, Jawa Barat</span>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        <span>+62 812-3456-7890</span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span>info@atapciater.com</span>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <span>Buka Setiap Hari 24 Jam</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Atap Ciater. Semua Hak Dilindungi.</p>
        </div>
    </footer>

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

        // Smooth Scroll for Anchor Links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
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