<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Tiket - Atap Ciater</title>
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
            min-height: calc(100vh - 200px);
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
            gap: 0.75rem;
            padding: 0.875rem 2rem;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            cursor: pointer;
            font-size: 1rem;
            justify-content: center;
            position: relative;
            overflow: hidden;
            width: 100%;
            max-width: 300px;
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

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }

        /* Form Styles */
        .form-container {
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .form-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            margin-bottom: 1.5rem;
        }

        .form-title {
            color: var(--primary-dark);
            font-size: 1.75rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text);
            font-size: 0.95rem;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 0.875rem;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            font-size: 0.95rem;
            font-family: 'Poppins', sans-serif;
            transition: var(--transition);
            background: var(--white);
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(46,125,50,0.1);
        }

        /* Alert Styles */
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert i {
            flex-shrink: 0;
            margin-top: 0.25rem;
        }

        /* Ticket Result */
        .ticket-result {
            margin-top: 2rem;
        }

        .ticket-card {
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            color: white;
            border-radius: var(--radius);
            padding: 1.5rem;
            box-shadow: var(--shadow-lg);
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
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-menunggu {
            background: #fff3cd;
            color: #856404;
        }

        .status-dikonfirmasi {
            background: #cfe2ff;
            color: #084298;
        }

        .status-dibatalkan {
            background: #f8d7da;
            color: #842029;
        }

        .status-selesai {
            background: #d1e7dd;
            color: #0f5132;
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
            font-size: 0.9rem;
        }

        .no-ticket {
            text-align: center;
            padding: 2rem 1rem;
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

            .btn {
                padding: 0.65rem 1.5rem;
                font-size: 0.85rem;
                width: 100%;
            }

            .main-content {
                margin-top: 70px;
                padding: 1rem 0;
                min-height: calc(100vh - 200px);
            }

            .form-container {
                padding: 0 0;
                max-width: 100%;
            }

            .form-card {
                padding: 1rem;
                border-radius: 8px;
                margin-bottom: 1rem;
            }

            .form-title {
                font-size: 1.1rem;
                margin-bottom: 0.75rem;
                font-weight: 600;
            }

            .form-group {
                margin-bottom: 0.9rem;
            }

            label {
                font-size: 0.85rem;
                margin-bottom: 0.35rem;
                font-weight: 600;
            }

            input, select, textarea {
                padding: 0.65rem;
                font-size: 0.85rem;
                border-radius: 6px;
            }

            small {
                font-size: 0.75rem;
                margin-top: 0.3rem;
            }

            .alert {
                padding: 0.75rem;
                margin-bottom: 1rem;
                border-radius: 6px;
                font-size: 0.85rem;
            }

            .alert i {
                font-size: 0.95rem;
                margin-right: 0.5rem;
            }

            .alert h4 {
                font-size: 0.9rem;
                margin-bottom: 0.35rem;
            }

            .ticket-result {
                margin-top: 1.5rem;
            }

            .ticket-card {
                padding: 1rem;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            }

            .ticket-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
                margin-bottom: 0.75rem;
                padding-bottom: 0.75rem;
            }

            .ticket-id {
                font-size: 0.95rem;
                font-weight: 600;
            }

            .ticket-status {
                width: 100%;
            }

            .status-badge {
                padding: 0.4rem 0.75rem;
                font-size: 0.75rem;
                border-radius: 4px;
                display: inline-block;
            }

            .ticket-details {
                grid-template-columns: 1fr;
                gap: 0;
                margin-bottom: 0.75rem;
            }

            .detail-item {
                flex-direction: row;
                align-items: flex-start;
                justify-content: space-between;
                font-size: 0.8rem;
                padding: 0.65rem 0;
                border-bottom: 1px solid #eee;
            }

            .detail-label {
                font-weight: 500;
                font-size: 0.8rem;
            }

            .detail-value {
                font-weight: 600;
                font-size: 0.85rem;
                text-align: right;
            }

            .addon-section {
                margin-top: 0.75rem;
                padding-top: 0.75rem;
                border-top: 1px solid #eee;
            }

            .addon-section h4 {
                font-size: 0.85rem;
                margin-bottom: 0.5rem;
                font-weight: 600;
            }

            .addon-item {
                font-size: 0.8rem;
                padding: 0.4rem 0;
                margin-bottom: 0.3rem;
            }

            .btn-group {
                flex-direction: column;
                gap: 0.5rem;
                margin-top: 1rem;
            }

            .btn-group .btn {
                width: 100%;
                padding: 0.6rem 1.5rem;
                font-size: 0.8rem;
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

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 1.25rem;
                margin-bottom: 1.5rem;
            }

            .footer-section h3 {
                font-size: 0.95rem;
                margin-bottom: 0.625rem;
            }

            .footer-section p {
                font-size: 0.8rem;
                margin-bottom: 0.75rem;
            }

            .footer-links a {
                font-size: 0.8rem;
            }

            .contact-info li {
                font-size: 0.8rem;
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

            h1 {
                font-size: 1.6rem;
            }

            h2 {
                font-size: 1.35rem;
            }

            .form-card {
                padding: 1.5rem;
            }

            .form-title {
                font-size: 1.2rem;
            }

            label {
                font-size: 0.9rem;
            }

            input, select, textarea {
                padding: 0.8rem;
                font-size: 0.9rem;
            }

            .ticket-card {
                padding: 1.5rem;
            }

            .detail-item {
                font-size: 0.9rem;
                padding: 0.75rem 0;
            }

            .detail-label {
                font-size: 0.85rem;
            }

            .detail-value {
                font-size: 0.95rem;
            }

            .btn {
                max-width: none;
                padding: 0.75rem 2rem;
                font-size: 0.9rem;
            }

            .btn-group {
                flex-direction: row;
                justify-content: center;
                gap: 1rem;
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
            .form-container {
                max-width: 600px;
            }

            .footer-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (min-width: 1025px) {
            .form-container {
                max-width: 650px;
            }

            .footer-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .btn {
                width: auto;
                max-width: none;
            }

            .btn-group {
                flex-direction: row;
                justify-content: center;
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
                <a href="{{ route('customer.paket') }}" class="nav-link">
                    <i class="fas fa-campground nav-icon"></i>
                    Paket Camping
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('customer.cektiket') }}" class="nav-link active">
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
        <div class="form-container">
            <div class="form-card fade-in">
                <h1 class="form-title">Cek Tiket Anda</h1>

                @if ($errors->has('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>{{ $errors->first('error') }}</div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                @endif

                <form method="POST" action="{{ route('customer.cektiket.proses') }}" class="fade-in">
                    @csrf

                    <div class="form-group">
                        <label for="id_pesanan">ID Pesanan</label>
                        <input
                            type="text"
                            id="id_pesanan"
                            name="id_pesanan"
                            placeholder="Masukkan nomor ID pesanan Anda"
                            required
                            value="{{ old('id_pesanan') }}"
                        >
                        @error('id_pesanan')
                            <small style="color: var(--primary-dark);">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        Cari Tiket
                    </button>
                </form>

                <p style="text-align: center; margin-top: 1.5rem; font-size: 0.9rem;">
                    Belum ada pesanan? <a href="{{ route('customer.paket') }}" style="color: var(--primary); text-decoration: none; font-weight: 600;">Booking sekarang</a>
                </p>
            </div>

            @if (isset($pesanan) && $pesanan)
            <div class="ticket-result fade-in">
                <div class="ticket-card">
                    <div class="ticket-header">
                        <div class="ticket-id">#{{ $pesanan->id_pesanan }}</div>
                        <span class="ticket-status status-{{ strtolower(str_replace(' ', '', $pesanan->status)) }}">
                            {{ $pesanan->status }}
                        </span>
                    </div>

                    <div class="ticket-details">
                        <div class="detail-item">
                            <span class="detail-label">Nama Pemesan</span>
                            <span class="detail-value">{{ $pesanan->nama_pemesan }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Nomor Telepon</span>
                            <span class="detail-value">{{ $pesanan->no_wa }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Paket</span>
                            <span class="detail-value">{{ $pesanan->nama_paket }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Tanggal Camping</span>
                            <span class="detail-value">{{ \Carbon\Carbon::parse($pesanan->tanggal_booking)->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Total Bayar</span>
                            <span class="detail-value">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                        </div>

                        @if (count($pesanan->detailPesanan) > 0)
                        <div class="addon-list">
                            <div style="font-weight: 600; padding: 0.75rem; margin-bottom: 0.75rem; border-top: 1px solid rgba(255,255,255,0.2);">
                                Addon yang dipilih:
                            </div>
                            @foreach($pesanan->detailPesanan as $detail)
                            <div class="addon-item">
                                <span>{{ $detail->nama_addons }} ({{ $detail->jumlah }}x)</span>
                                <span>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr; gap: 0.75rem;">
                    <a href="{{ route('customer.cektiket') }}" class="btn btn-secondary">
                        <i class="fas fa-search"></i>
                        Cek Tiket Lain
                    </a>
                    <a href="{{ route('customer.paket') }}" class="btn btn-primary">
                        <i class="fas fa-calendar-plus"></i>
                        Booking Paket Lain
                    </a>
                </div>
            </div>
            @endif
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
