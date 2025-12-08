<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Paket - Atap Ciater</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2e7d32;
            --primary-light: #4caf50;
            --primary-dark: #1b5e20;
            --accent: #ff9800;
            --white: #ffffff;
            --light: #f8f9fa;
            --light-gray: #e9ecef;
            --text: #333333;
            --text-light: #666666;
            --shadow: 0 4px 12px rgba(0,0,0,0.08);
            --shadow-lg: 0 10px 30px rgba(0,0,0,0.12);
            --radius: 12px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--white);
            color: var(--text);
            line-height: 1.6;
            overflow-x: hidden;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            z-index: 1000;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--primary);
            font-weight: 700;
            font-size: 1.4rem;
        }

        .brand-logo {
            height: 45px;
            transition: var(--transition);
        }

        .brand:hover .brand-logo {
            transform: rotate(-5deg);
        }

        .nav-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text);
            cursor: pointer;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .nav-toggle:hover {
            background: var(--light);
        }

        /* Side Navigation */
        .side-nav {
            position: fixed;
            top: 0;
            right: -100%;
            width: 320px;
            height: 100vh;
            background: var(--white);
            z-index: 2000;
            transition: var(--transition);
            box-shadow: -5px 0 25px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        .side-nav.active {
            right: 0;
        }

        .nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            border-bottom: 1px solid var(--light-gray);
        }

        .nav-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text);
            cursor: pointer;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .nav-close:hover {
            background: var(--light);
        }

        .nav-menu {
            padding: 1.5rem 0;
            flex: 1;
            overflow-y: auto;
        }

        .nav-item {
            list-style: none;
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            color: var(--text);
            text-decoration: none;
            transition: var(--transition);
            border-left: 4px solid transparent;
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link.active {
            background: var(--light);
            color: var(--primary);
            border-left-color: var(--primary);
        }

        .nav-icon {
            width: 24px;
            text-align: center;
            font-size: 1.1rem;
        }

        .nav-actions {
            padding: 1.5rem;
            border-top: 1px solid var(--light-gray);
        }

        /* Main Content */
        .main-content {
            margin-top: 80px;
            padding: 2rem 0;
        }

        /* Typography */
        h1 {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1rem;
            color: var(--primary);
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
            color: var(--primary-dark);
        }

        p {
            margin-bottom: 1rem;
            color: var(--text-light);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 0.875rem 2rem;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            cursor: pointer;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
            width: auto;
            max-width: 100%;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: var(--transition);
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
            box-shadow: var(--shadow);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(46,125,50,0.3);
        }

        .btn-secondary {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-secondary:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-3px);
        }

        .btn-accent {
            background: var(--accent);
            color: var(--white);
            box-shadow: var(--shadow);
        }

        .btn-accent:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255,152,0,0.3);
        }

        .btn-white {
            background: var(--white);
            color: var(--primary);
            box-shadow: var(--shadow);
            font-weight: 600;
        }

        .btn-white:hover {
            background: var(--light-gray);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .btn-group {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            justify-content: center;
        }

        /* Section Styles */
        .section {
            padding: 3rem 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title {
            color: var(--primary);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
        }

        .section-subtitle {
            color: var(--text-light);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Packages Grid */
        .packages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .package-card {
            background: var(--white);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            position: relative;
        }

        .package-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .package-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: var(--accent);
            color: var(--white);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 2;
        }

        .package-header {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 3rem;
        }

        /* Images fill the card width and keep their natural aspect ratio.
           Card header height will follow the image's height. */
        .package-header img {
            width: 100%;
            height: auto;
            display: block;
            transition: var(--transition);
        }

        .package-card:hover .package-header img {
            transform: scale(1.02);
        }

        .package-price {
            position: absolute;
            bottom: 1rem;
            right: 1rem;
            background: var(--white);
            color: var(--primary);
            padding: 0.75rem 1.25rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: var(--shadow);
        }

        .package-body {
            padding: 1.5rem;
        }

        .package-title {
            color: var(--primary-dark);
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .package-features {
            list-style: none;
            margin-bottom: 1.5rem;
        }

        .package-features li {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--light-gray);
            font-size: 0.95rem;
            color: var(--text-light);
        }

        .package-features li:last-child {
            border-bottom: none;
        }

        .package-features i {
            color: var(--primary);
            width: 20px;
            text-align: center;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            padding: 3rem 0;
            text-align: center;
            border-radius: var(--radius);
            margin: 3rem 0;
        }

        .cta-section h2 {
            color: var(--white);
            margin-bottom: 1rem;
        }

        .cta-section p {
            color: rgba(255, 255, 255, 0.9);
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        /* Footer */
        .footer {
            background: var(--primary-dark);
            color: rgba(255, 255, 255, 0.9);
            padding: 3rem 0 1rem;
            margin-top: 3rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            color: var(--white);
            font-size: 1.1rem;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .footer-section h3::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 50%;
            height: 3px;
            background: var(--accent);
            border-radius: 2px;
        }

        .footer-section {
            margin-bottom: 1rem;
        }

        .footer-section p {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 1rem;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
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
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .contact-info i {
            width: 24px;
            text-align: center;
            flex-shrink: 0;
            color: var(--accent);
            margin-top: 0.25rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-link {
            width: 44px;
            height: 44px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            text-decoration: none;
            transition: var(--transition);
        }

        .social-link:hover {
            background: var(--accent);
            transform: translateY(-3px);
        }

        .map-container {
            margin-top: 1.5rem;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .map-container iframe {
            width: 100%;
            height: 200px;
            border: none;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
        }

        /* Animations */
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
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive Design */
        @media (max-width: 640px) {
            .container {
                padding: 0 0.875rem;
            }

            h1 {
                font-size: 1.35rem;
                margin-bottom: 0.75rem;
            }

            h2 {
                font-size: 1.1rem;
                margin-bottom: 0.75rem;
            }

            h3 {
                font-size: 0.95rem;
                margin-bottom: 0.5rem;
            }

            p {
                font-size: 0.875rem;
                margin-bottom: 0.75rem;
            }

            .btn {
                padding: 0.65rem 1.5rem;
                font-size: 0.85rem;
                width: 100%;
            }

            .hero-section {
                padding: 3rem 0 2rem;
                min-height: auto;
            }

            .hero-title {
                font-size: 1.4rem;
                margin-bottom: 0.5rem;
            }

            .hero-subtitle {
                font-size: 0.8rem;
                margin-bottom: 1.5rem;
            }

            .section-title {
                font-size: 1.2rem;
                margin-bottom: 1.5rem;
            }

            .search-container {
                margin-bottom: 1.5rem;
            }

            .search-input {
                padding: 0.65rem;
                font-size: 0.85rem;
                border-radius: 6px;
            }

            .search-input::placeholder {
                font-size: 0.8rem;
            }

            .filter-section {
                margin-bottom: 1.5rem;
            }

            .filter-group label {
                font-size: 0.85rem;
            }

            .filter-group input,
            .filter-group select {
                padding: 0.6rem;
                font-size: 0.85rem;
            }

            .packages-grid {
                grid-template-columns: 1fr;
                gap: 0.875rem;
            }

            .package-card {
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            }

            .package-image {
                height: 150px;
                border-radius: 0;
            }

            /* On small screens keep responsive width/ratio (don't force a capped height) */
            .package-header img {
                width: 100%;
                height: auto;
            }

            .package-header {
                padding: 0.75rem;
            }

            .package-body {
                padding: 0.75rem;
            }

            .package-name {
                font-size: 0.9rem;
                margin-bottom: 0.4rem;
                font-weight: 600;
            }

            .package-price {
                font-size: 1.1rem;
                margin-bottom: 0.5rem;
                font-weight: 700;
            }

            .slot-info {
                font-size: 0.75rem;
                margin-bottom: 0.5rem;
            }

            .slot-badge {
                padding: 0.35rem 0.65rem;
                font-size: 0.7rem;
                border-radius: 4px;
            }

            .package-features {
                margin-bottom: 0.75rem;
            }

            .package-features ul li {
                font-size: 0.8rem;
                padding: 0.25rem 0;
                margin-bottom: 0.2rem;
            }

            .package-features i {
                font-size: 0.85rem;
                margin-right: 0.4rem;
                width: 14px;
            }

            .btn-group {
                flex-direction: row;
                gap: 0.5rem;
                margin-top: 0.75rem;
                justify-content: center;
                flex-wrap: wrap;
            }

            .package-card .btn {
                padding: 0.6rem 1rem;
                font-size: 0.8rem;
                width: auto;
                flex: 1;
                min-width: 120px;
            }

            .cta-section .btn {
                padding: 0.6rem 1.5rem;
                font-size: 0.8rem;
                width: auto;
                min-width: 140px;
            }

            .cta-section {
                padding: 1.5rem 1rem;
                margin: 2rem 0;
                border-radius: 8px;
            }

            .cta-section h2 {
                font-size: 1.25rem;
                margin-bottom: 0.5rem;
            }

            .cta-section p {
                font-size: 0.8rem;
                margin-bottom: 1rem;
                line-height: 1.5;
            }

            .main-content {
                margin-top: 70px;
                padding: 1.5rem 0;
                min-height: calc(100vh - 100px);
            }

            .header {
                padding: 0.75rem 0;
            }

            .brand {
                font-size: 1.15rem;
                gap: 0.5rem;
            }

            .brand-logo {
                height: 38px;
            }

            .nav-toggle {
                font-size: 1.3rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 1.25rem;
                margin-bottom: 1.5rem;
            }

            .footer-section {
                margin-bottom: 0.5rem;
            }

            .footer-section h3 {
                font-size: 0.95rem;
                margin-bottom: 0.625rem;
            }

            .footer-section p {
                font-size: 0.8rem;
                margin-bottom: 0.75rem;
            }

            .footer-links li {
                margin-bottom: 0.5rem;
            }

            .footer-links a {
                font-size: 0.8rem;
            }

            .contact-info li {
                font-size: 0.8rem;
                margin-bottom: 0.75rem;
            }

            .social-links {
                gap: 0.75rem;
                margin-top: 1rem;
            }

            .social-link {
                width: 40px;
                height: 40px;
                font-size: 0.95rem;
            }

            .map-container iframe {
                height: 200px;
                border-radius: 6px;
            }

            .footer-bottom {
                padding-top: 1.25rem;
                font-size: 0.75rem;
            }
        }

        @media (min-width: 641px) and (max-width: 768px) {
            .container {
                padding: 0 1rem;
            }

            .hero-title {
                font-size: 1.8rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .packages-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .package-image {
                height: 180px;
            }

            /* Tablet: responsive width + natural aspect ratio */
            .package-header img {
                width: 100%;
                height: auto;
            }

            .package-name {
                font-size: 1rem;
            }

            .package-price {
                font-size: 1.25rem;
            }

            .btn {
                max-width: none;
                padding: 0.75rem 2rem;
                font-size: 0.9rem;
                width: auto;
            }

            .cta-section h2 {
                font-size: 1.5rem;
            }

            .cta-section p {
                font-size: 0.95rem;
            }

            .btn-group {
                flex-direction: row;
                justify-content: center;
                gap: 1rem;
                flex-wrap: wrap;
            }

            .cta-section .btn {
                min-width: 160px;
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }

            .map-container iframe {
                height: 250px;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .packages-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }

            .footer-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (min-width: 1025px) {
            .packages-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 2rem;
            }

            .footer-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .btn {
                width: auto;
                max-width: none;
            }
        }

        /* Utility Classes */
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
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="nav-container">
                <a href="{{ route('landing.page') }}" class="brand">
                    <img src="{{ asset('images/logo/atap_ciater.png') }}" alt="Atap Ciater" class="brand-logo">
                    <span>Atap Ciater</span>
                </a>
                <button class="nav-toggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Side Navigation -->
    <nav class="side-nav">
        <div class="nav-header">
            <a href="{{ route('landing.page') }}" class="brand">
                <img src="{{ asset('images/logo/atap_ciater.png') }}" alt="Atap Ciater" class="brand-logo">
                <span>Atap Ciater</span>
            </a>
            <button class="nav-close">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ route('landing.page') }}" class="nav-link">
                    <i class="fas fa-home nav-icon"></i>
                    Beranda
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('customer.paket') }}" class="nav-link active">
                    <i class="fas fa-campground nav-icon"></i>
                    Paket Camping
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('customer.cektiket') }}" class="nav-link">
                    <i class="fas fa-ticket-alt nav-icon"></i>
                    Cek Tiket
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('landing.page') }}#gallery" class="nav-link">
                    <i class="fas fa-images nav-icon"></i>
                    Galeri
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('landing.page') }}#testimonials" class="nav-link">
                    <i class="fas fa-star nav-icon"></i>
                    Testimoni
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('landing.page') }}#contact" class="nav-link">
                    <i class="fas fa-phone nav-icon"></i>
                    Kontak
                </a>
            </li>
        </ul>

        <div class="nav-actions">
            <a href="{{ route('customer.paket') }}" class="btn btn-primary">
                <i class="fas fa-calendar-plus"></i>
                Booking Sekarang
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="section-header fade-in">
                <h1 class="section-title">Paket Camping</h1>
                <p class="section-subtitle">Pilih paket yang sesuai dengan kebutuhan petualangan Anda</p>
            </div>

            <div class="packages-grid">
                @forelse ($pakets as $paket)
                <div class="package-card fade-in">
                    <div class="package-badge">Tersedia</div>
                    <div class="package-header">
                        @if ($paket->gambar && file_exists(public_path('images/paket_images/' . $paket->gambar)))
                            <img src="{{ asset('images/paket_images/' . $paket->gambar) }}" alt="{{ $paket->nama_paket }}">
                        @else
                            <i class="fas fa-campground"></i>
                        @endif
                        <div class="package-price">Rp {{ number_format($paket->harga, 0, ',', '.') }}</div>
                    </div>
                    <div class="package-body">
                        <h3 class="package-title">{{ $paket->nama_paket }}</h3>
                        <ul class="package-features">
                            <li>
                                <i class="fas fa-users"></i>
                                <span>Slot: {{ $paket->slot }}</span>
                            </li>
                            <li>
                                <i class="fas fa-list"></i>
                                <span>{{ Str::limit($paket->fasilitas, 50) }}</span>
                            </li>
                            <li>
                                <i class="fas fa-info-circle"></i>
                                <span>{{ Str::limit($paket->deskripsi, 50, '...') }}</span>
                            </li>
                        </ul>
                        <a href="{{ route('customer.booking', $paket->id_paket) }}" class="btn btn-primary">
                            <i class="fas fa-calendar-plus"></i>
                            Booking Sekarang
                        </a>
                    </div>
                </div>
                @empty
                <div class="text-center" style="grid-column: 1 / -1; padding: 3rem;">
                    <p style="font-size: 1.1rem; color: var(--text-light);">Tidak ada paket tersedia saat ini</p>
                    <a href="{{ route('landing.page') }}" class="btn btn-secondary" style="margin-top: 1rem;">
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Beranda
                    </a>
                </div>
                @endforelse
            </div>

            <!-- CTA Section -->
            <section class="cta-section fade-in">
                <h2>Masih Bingung Memilih Paket?</h2>
                <p>Hubungi kami untuk konsultasi gratis dan rekomendasi paket terbaik untuk Anda</p>
                <div class="btn-group">
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-white">
                        <i class="fab fa-whatsapp"></i>
                        Chat via WhatsApp
                    </a>
                    <a href="{{ route('landing.page') }}#contact" class="btn btn-white">
                        <i class="fas fa-phone"></i>
                        Hubungi Kami
                    </a>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3>Atap Ciater</h3>
                    <p>Destinasi camping premium dengan pemandangan alam menakjubkan dan fasilitas lengkap untuk pengalaman outdoor terbaik yang tak terlupakan.</p>
                    <div class="social-links">
                        <a href="https://www.instagram.com/atapciater1540mdpl" class="social-link" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://wa.me/6281234567890" class="social-link" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://www.tiktok.com/@atap.ciater1540mdpl" class="social-link" target="_blank">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-section">
                    <h3>Menu Cepat</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('landing.page') }}"><i class="fas fa-chevron-right"></i> Beranda</a></li>
                        <li><a href="{{ route('customer.paket') }}"><i class="fas fa-chevron-right"></i> Paket Camping</a></li>
                        <li><a href="{{ route('customer.cektiket') }}"><i class="fas fa-chevron-right"></i> Cek Tiket</a></li>
                        <li><a href="{{ route('landing.page') }}#gallery"><i class="fas fa-chevron-right"></i> Galeri</a></li>
                        <li><a href="{{ route('landing.page') }}#testimonials"><i class="fas fa-chevron-right"></i> Testimoni</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Kontak Kami</h3>
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

                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7924.035828636533!2d107.63905238757383!3d-6.767669422916325!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e1006851ac13%3A0x414b2f3d18312744!2sAtap%20ciater%20Camping%20Ground!5e0!3m2!1sid!2sid!4v1763351463872!5m2!1sid!2sid"
                            allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 Atap Ciater. Semua Hak Dilindungi. | Dibuat dengan <i class="fas fa-heart" style="color: #ff6b6b;"></i> untuk para pecinta alam</p>
            </div>
        </div>
    </footer>

    <script>
        // Navigation Toggle
        const navToggle = document.querySelector('.nav-toggle');
        const navClose = document.querySelector('.nav-close');
        const sideNav = document.querySelector('.side-nav');

        navToggle.addEventListener('click', () => {
            sideNav.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        navClose.addEventListener('click', () => {
            sideNav.classList.remove('active');
            document.body.style.overflow = 'auto';
        });

        // Close nav when clicking on links
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                sideNav.classList.remove('active');
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
            anchor.addEventListener('click', function (e) {
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
        }, { passive: false });

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
