<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - Atap Ciater</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

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

        /* Form Styles */
        .booking-container {
            max-width: 700px;
            width: 100%;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .booking-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            margin-bottom: 1.5rem;
        }

        .section-title {
            color: var(--primary-dark);
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--primary-light);
        }

        .paket-info {
            background: var(--light);
            padding: 1.25rem;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
        }

        .paket-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }

        .paket-price {
            font-size: 1.5rem;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .slot-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
            color: var(--text-light);
        }

        .slot-info i {
            color: var(--primary);
        }

        /* Form Elements */
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

        small {
            display: block;
            margin-top: 0.5rem;
            color: var(--text-light);
            font-size: 0.85rem;
        }

        /* Addon Styles */
        .addon-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            margin-bottom: 0.75rem;
            transition: var(--transition);
        }

        .addon-item:hover {
            background: var(--light);
            border-color: var(--primary);
        }

        .addon-info {
            flex: 1;
        }

        .addon-name {
            font-weight: 600;
            color: var(--text);
            margin-bottom: 0.25rem;
        }

        .addon-price {
            font-size: 0.9rem;
            color: var(--primary);
            font-weight: 600;
        }

        .addon-stock {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-top: 0.25rem;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border: 1px solid var(--primary);
            background: var(--white);
            color: var(--primary);
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
        }

        .qty-btn:hover {
            background: var(--primary);
            color: var(--white);
        }

        .qty-input {
            width: 50px;
            text-align: center;
            border: 1px solid var(--light-gray);
            padding: 0.5rem !important;
        }

        input[type="number"].qty-input::-webkit-outer-spin-button,
        input[type="number"].qty-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"].qty-input {
            -moz-appearance: textfield;
        }

        /* Payment Methods */
        .payment-methods {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .payment-option {
            padding: 1rem;
            border: 2px solid var(--light-gray);
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
        }

        .payment-option:hover {
            border-color: var(--primary);
            background: rgba(46,125,50,0.05);
        }

        .payment-option.selected {
            border-color: var(--primary);
            background: rgba(46,125,50,0.1);
        }

        .payment-option input {
            display: none;
        }

        .payment-option strong {
            display: block;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }

        .payment-option small {
            color: var(--text-light);
            margin: 0;
        }

        /* Bank Info */
        .bank-info {
            margin-bottom: 1.5rem;
        }

        .bank-card {
            background: var(--light);
            border: 1px solid var(--light-gray);
            border-radius: var(--radius);
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .bank-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .bank-header i {
            color: var(--primary);
            font-size: 1.5rem;
        }

        .bank-name {
            font-weight: 700;
            color: var(--primary-dark);
            font-size: 1.1rem;
        }

        .bank-details {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .bank-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            background: var(--white);
            border-radius: 6px;
        }

        .bank-label {
            font-weight: 500;
            color: var(--text);
        }

        .bank-value {
            font-weight: 600;
            color: var(--primary-dark);
            text-align: right;
        }

        .copy-btn {
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.8rem;
            transition: var(--transition);
            display: inline-flex;
            gap: 0.5rem;
            align-items: center;
        }

        .copy-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .copy-btn.copied {
            background: var(--primary-dark);
        }

        .bank-notice {
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 8px;
            padding: 1rem;
            display: flex;
            gap: 0.75rem;
        }

        .bank-notice i {
            color: #ff9800;
            flex-shrink: 0;
            margin-top: 0.25rem;
        }

        .bank-notice p {
            margin: 0;
            font-size: 0.9rem;
            color: #856404;
        }

        /* Total Section */
        .total-section {
            background: var(--light);
            border: 2px solid var(--primary-light);
            border-radius: var(--radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .total-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }

        .total-final {
            border-top: 2px solid var(--primary-light);
            padding-top: 0.75rem;
            margin-top: 0.75rem;
            font-weight: 700;
            color: var(--primary-dark);
            font-size: 1.1rem;
        }

        /* File Upload */
        .file-upload {
            position: relative;
            margin-bottom: 1rem;
        }

        .file-upload input[type="file"] {
            display: none;
        }

        .file-upload-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: var(--light);
            border: 2px dashed var(--primary);
            border-radius: var(--radius);
            cursor: pointer;
            transition: var(--transition);
        }

        .file-upload-label:hover {
            background: rgba(46,125,50,0.05);
            border-color: var(--primary-dark);
        }

        .file-upload-label i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 0.75rem;
        }

        .file-upload-label span {
            font-weight: 600;
            color: var(--text);
            margin-bottom: 0.25rem;
        }

        .file-upload-label small {
            color: var(--text-light);
            margin: 0;
        }

        .file-name {
            margin-top: 0.75rem;
            padding: 0.75rem;
            background: var(--white);
            border: 1px solid var(--light-gray);
            border-radius: 6px;
            text-align: center;
            font-size: 0.9rem;
            color: var(--text);
            font-weight: 500;
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

        /* Color Classes */
        .text-danger {
            color: #dc3545;
        }

        .text-warning {
            color: #ffc107;
        }

        .text-success {
            color: #28a745;
        }

        .text-muted {
            color: var(--text-light);
        }

        .hidden {
            display: none;
        }

        /* Error Message Styles */
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .alert-danger {
            background-color: #ffebee;
            border: 1px solid #ef5350;
            color: #c62828;
        }

        .alert-success {
            background-color: #e8f5e9;
            border: 1px solid #66bb6a;
            color: #2e7d32;
        }

        .alert h4 {
            margin: 0 0 0.5rem 0;
            font-size: 1rem;
            font-weight: 600;
        }

        .alert ul {
            margin: 0;
            padding-left: 1.5rem;
            list-style: disc;
        }

        .alert ul li {
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .container {
                padding: 0 1rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            h2 {
                font-size: 1.3rem;
            }

            h3 {
                font-size: 1rem;
            }

            .btn {
                padding: 0.75rem 1.5rem;
                font-size: 0.9rem;
            }

            .booking-container {
                padding: 0 1rem;
            }

            .booking-card {
                padding: 1rem;
                border-radius: 8px;
            }

            .section-title {
                font-size: 1.1rem;
                margin-bottom: 1rem;
            }

            .paket-info {
                padding: 1rem;
                margin-bottom: 1rem;
            }

            .paket-name {
                font-size: 1rem;
            }

            .paket-price {
                font-size: 1.3rem;
            }

            .form-group {
                margin-bottom: 1rem;
            }

            label {
                font-size: 0.9rem;
                margin-bottom: 0.4rem;
            }

            input, select, textarea {
                padding: 0.75rem;
                font-size: 0.9rem;
            }

            small {
                font-size: 0.8rem;
            }

            .addon-item {
                padding: 0.75rem;
                margin-bottom: 0.5rem;
                flex-direction: column;
                align-items: flex-start;
            }

            .addon-info {
                width: 100%;
                margin-bottom: 0.75rem;
            }

            .addon-name {
                font-size: 0.9rem;
            }

            .addon-price {
                font-size: 0.85rem;
            }

            .quantity-controls {
                width: 100%;
                justify-content: flex-end;
            }

            .qty-btn {
                width: 28px;
                height: 28px;
                font-size: 0.85rem;
            }

            .qty-input {
                width: 45px;
                font-size: 0.85rem;
            }

            .payment-methods {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            .payment-option {
                padding: 0.75rem;
            }

            .payment-option strong {
                font-size: 0.9rem;
            }

            .payment-option small {
                font-size: 0.75rem;
            }

            .bank-card {
                padding: 0.75rem;
                margin-bottom: 0.75rem;
            }

            .bank-header {
                gap: 0.5rem;
                margin-bottom: 0.75rem;
            }

            .bank-header i {
                font-size: 1.2rem;
            }

            .bank-name {
                font-size: 1rem;
            }

            .bank-item {
                padding: 0.5rem;
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .copy-btn {
                padding: 0.4rem 0.75rem;
                font-size: 0.75rem;
                width: 100%;
            }

            .bank-notice {
                padding: 0.75rem;
                gap: 0.5rem;
            }

            .bank-notice i {
                font-size: 1rem;
            }

            .bank-notice p {
                font-size: 0.8rem;
            }

            .total-section {
                padding: 1rem;
                margin-bottom: 1rem;
            }

            .total-line {
                font-size: 0.9rem;
                margin-bottom: 0.5rem;
            }

            .total-final {
                font-size: 1rem;
            }

            .file-upload-label {
                padding: 1.5rem 1rem;
            }

            .file-upload-label i {
                font-size: 2rem;
                margin-bottom: 0.5rem;
            }

            .file-upload-label span {
                font-size: 0.9rem;
            }

            .file-name {
                font-size: 0.85rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .footer-section {
                margin-bottom: 0.5rem;
            }

            .footer-section h3 {
                font-size: 1rem;
            }

            .map-container iframe {
                height: 200px;
            }
        }

        @media (min-width: 768px) {
            .btn {
                width: auto;
                max-width: none;
            }

            .booking-card {
                padding: 2rem;
            }

            .payment-methods {
                grid-template-columns: 1fr 1fr;
            }

            .footer-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .map-container iframe {
                height: 300px;
            }
        }

        @media (min-width: 1024px) {
            .booking-container {
                max-width: 700px;
            }

            .footer-grid {
                grid-template-columns: repeat(4, 1fr);
            }
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
        <div class="booking-container">
            <div class="booking-card fade-in">
                <div style="margin-bottom: 1.5rem;">
                    <a href="{{ route('customer.paket') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; color: var(--primary); text-decoration: none; font-weight: 500; transition: var(--transition);">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Paket
                    </a>
                </div>

                @if($errors->any())
                <div style="background-color: #ffebee; border: 1px solid #ef5350; color: #c62828; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    <h4 style="margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-exclamation-triangle"></i> Terjadi Kesalahan
                    </h4>
                    <ul style="margin: 0; padding-left: 1.5rem;">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <h2 class="section-title">Form Booking</h2>

                <div class="paket-info">
                    <div class="paket-name">{{ $paket->nama_paket }}</div>
                    <div class="paket-price">Rp {{ number_format($paket->harga, 0, ',', '.') }}</div>
                    <div class="slot-info">
                        <i class="fas fa-ticket-alt"></i> Slot Tersedia:
                        <span id="slot-tersedia" class="{{ $paket->slot <= 3 ? 'text-danger' : ($paket->slot <= 10 ? 'text-warning' : 'text-success') }}">
                            {{ $paket->slot }}
                        </span>
                    </div>
                </div>

                <form id="bookingForm" action="{{ route('customer.booking.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_paket" value="{{ $paket->id_paket }}">
                    <input type="hidden" name="harga_paket" value="{{ $paket->harga }}">
                    <input type="hidden" name="nama_paket" value="{{ $paket->nama_paket }}">
                    <input type="hidden" id="harga_paket_value" value="{{ $paket->harga }}">

                    <div class="form-group">
                        <label for="nama_pemesan">Nama Pemesan *</label>
                        <input type="text" id="nama_pemesan" name="nama_pemesan" required placeholder="Masukkan nama lengkap Anda" value="{{ old('nama_pemesan') }}">
                    </div>

                    <div class="form-group">
                        <label for="no_wa">Nomor WhatsApp *</label>
                        <input type="tel" id="no_wa" name="no_wa" required placeholder="Contoh: 081234567890" value="{{ old('no_wa') }}">
                    </div>

                    <div class="form-group">
                        <label for="tanggal_booking">Tanggal Booking *</label>
                        <input type="text" id="tanggal_booking" name="tanggal_booking" required placeholder="Pilih tanggal booking" readonly style="background-color: white; cursor: pointer;" value="{{ old('tanggal_booking') }}">
                        <small>Tanggal libur dan minggu tidak tersedia</small>
                    </div>

                    <div class="form-group">
                        <label for="catatan">Catatan (Opsional)</label>
                        <textarea id="catatan" name="catatan" rows="3" placeholder="Contoh: Ada alergi makanan, dll.">{{ old('catatan') }}</textarea>
                    </div>

                    <h3 class="section-title">Tambahan (Opsional)</h3>

                    <div id="addons-container">
                        @foreach ($addons as $addon)
                            <div class="addon-item" data-addon-id="{{ $addon->id_addons }}" data-addon-price="{{ $addon->harga }}" data-addon-stock="{{ $addon->stok }}">
                                <div class="addon-info">
                                    <div class="addon-name">{{ $addon->nama_addons }}</div>
                                    <div class="addon-price">Rp {{ number_format($addon->harga, 0, ',', '.') }} / unit</div>
                                    <div class="addon-stock">
                                        Stok: <span class="{{ $addon->stok <= 3 ? 'text-danger' : ($addon->stok <= 10 ? 'text-warning' : 'text-success') }}">{{ $addon->stok }}</span>
                                    </div>
                                </div>
                                <div class="quantity-controls">
                                    <button type="button" class="qty-btn minus" data-addon-id="{{ $addon->id_addons }}">-</button>
                                    <input type="number" class="qty-input" id="qty-{{ $addon->id_addons }}" name="addons[{{ $addon->id_addons }}]" value="0" min="0" max="{{ $addon->stok }}" readonly>
                                    <button type="button" class="qty-btn plus" data-addon-id="{{ $addon->id_addons }}">+</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <h3 class="section-title">Metode Pembayaran</h3>

                    <div class="payment-methods">
                        <div class="payment-option" data-method="dp_50%">
                            <input type="radio" id="dp" name="metode_bayar" value="dp_50%" class="hidden">
                            <label for="dp" style="cursor: pointer; margin: 0;">
                                <strong>DP 50%</strong><br>
                                <small>Bayar 50% sekarang</small>
                            </label>
                        </div>
                        <div class="payment-option" data-method="lunas">
                            <input type="radio" id="lunas" name="metode_bayar" value="lunas" class="hidden">
                            <label for="lunas" style="cursor: pointer; margin: 0;">
                                <strong>Lunas</strong><br>
                                <small>Bayar 100% sekarang</small>
                            </label>
                        </div>
                        <div class="payment-option" data-method="full_cash_on_site">
                            <input type="radio" id="full_cash" name="metode_bayar" value="full_cash_on_site" class="hidden">
                            <label for="full_cash" style="cursor: pointer; margin: 0;">
                                <strong>Full Cash di Tempat</strong><br>
                                <small>Bayar 100% saat datang</small>
                            </label>
                        </div>
                    </div>

                    <h3 class="section-title" id="payment-info-title">Informasi Pembayaran</h3>

                    <div class="bank-info" id="bank-info-section">
                        <div class="bank-card">
                            <div class="bank-header">
                                <i class="fas fa-university"></i>
                                <div class="bank-name">Bank BCA</div>
                            </div>
                            <div class="bank-details">
                                <div class="bank-item">
                                    <span class="bank-label">Nomor Rekening:</span>
                                    <span class="bank-value">0551650072</span>
                                    <button class="copy-btn" data-text="0551650072" type="button">
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
                            <i class="fas fa-info-circle"></i>
                            <p><strong>Penting:</strong> Harap transfer sesuai dengan total pembayaran yang tertera di bawah. Simpan bukti transfer untuk diupload.</p>
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

                    <div class="form-group" id="screenshot-section">
                        <label for="screenshot"><span id="screenshot-label">Upload Bukti Pembayaran</span> <span id="required-asterisk">*</span></label>
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

                    <button type="submit" class="btn btn-primary" id="submit-btn">
                        <i class="fas fa-paper-plane"></i> Konfirmasi Booking
                    </button>
                </form>
            </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            const tanggalLibur = @json($tanggalLibur);
            const disabledDates = tanggalLibur.map(date => new Date(date));

            const flatpickrInstance = flatpickr("#tanggal_booking", {
                minDate: "today",
                dateFormat: "Y-m-d",
                locale: "id",
                disable: [
                    function(date) {
                        return date.getDay() === 0;
                    },
                    ...disabledDates
                ],
                onDayCreate: function(dObj, dStr, fp, dayElem) {
                    const dateString = dayElem.dateObj.toISOString().split('T')[0];
                    if (dayElem.dateObj.getDay() === 0) {
                        dayElem.style.backgroundColor = "#ffebee";
                        dayElem.style.color = "#c62828";
                        dayElem.title = "Minggu - Tidak tersedia untuk booking";
                    }
                    if (tanggalLibur.includes(dateString)) {
                        dayElem.style.backgroundColor = "#ffebee";
                        dayElem.style.color = "#c62828";
                        dayElem.title = "Libur - Tidak tersedia untuk booking";
                    }
                }
            });

            // Validasi tanggal pada saat perubahan
            const tanggalInput = document.getElementById('tanggal_booking');
            if (tanggalInput) {
                tanggalInput.addEventListener('change', function() {
                    const selectedDate = this.value;
                    if (selectedDate) {
                        const dateObj = new Date(selectedDate + 'T00:00:00');
                        const dayOfWeek = dateObj.getDay();
                        const dateString = dateObj.toISOString().split('T')[0];
                        if (tanggalLibur.includes(dateString) || dayOfWeek === 0) {
                            alert('Tanggal yang dipilih tidak tersedia. Silakan pilih tanggal lain.');
                            flatpickrInstance.clear();
                            this.value = '';
                        }
                    }
                });
            }
        });

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

        // Data harga paket
        const hargaPaket = parseInt(document.getElementById('harga_paket_value').value);
        let totalTambahan = 0;
        let totalBayar = hargaPaket;
        const displayTambahan = document.getElementById('display-tambahan');
        const displayTotal = document.getElementById('display-total');
        const submitBtn = document.getElementById('submit-btn');

        // Deklarasi global untuk form elements yang akan diakses di berbagai fungsi
        const screenshotSection = document.getElementById('screenshot-section');
        const screenshotInput = document.getElementById('screenshot');
        const bankInfoSection = document.getElementById('bank-info-section');
        const paymentInfoTitle = document.getElementById('payment-info-title');

        function formatRupiah(angka) {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function updateDisplay() {
            displayTambahan.textContent = formatRupiah(totalTambahan);
            displayTotal.textContent = formatRupiah(totalBayar);
        }

        document.querySelectorAll('.qty-btn').forEach(button => {
            button.addEventListener('click', function() {
                const addonId = this.getAttribute('data-addon-id');
                const input = document.getElementById('qty-' + addonId);
                let value = parseInt(input.value);
                const addonItem = document.querySelector(`[data-addon-id="${addonId}"]`);
                const maxStock = parseInt(addonItem.getAttribute('data-addon-stock'));

                if (this.classList.contains('plus')) {
                    if (value < maxStock) {
                        value++;
                    } else {
                        alert('Stok tidak mencukupi! Stok tersedia: ' + maxStock);
                        return;
                    }
                } else if (this.classList.contains('minus')) {
                    if (value > 0) {
                        value--;
                    }
                }
                input.value = value;
                calculateTotal();
            });
        });

        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.payment-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                this.classList.add('selected');
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;
                togglePaymentSection();
                calculateTotal();
            });
        });

        function calculateTotal() {
            totalTambahan = 0;
            document.querySelectorAll('.addon-item').forEach(item => {
                const addonId = item.getAttribute('data-addon-id');
                const addonPrice = parseInt(item.getAttribute('data-addon-price'));
                const input = document.getElementById('qty-' + addonId);
                const quantity = parseInt(input.value);
                totalTambahan += quantity * addonPrice;
            });

            const selectedPayment = document.querySelector('input[name="metode_bayar"]:checked');
            if (selectedPayment) {
                if (selectedPayment.value === 'dp_50%') {
                    totalBayar = Math.floor((hargaPaket + totalTambahan) * 0.5);
                } else if (selectedPayment.value === 'full_cash_on_site') {
                    totalBayar = 0; // Bayar di tempat
                } else {
                    totalBayar = hargaPaket + totalTambahan;
                }
            } else {
                totalBayar = hargaPaket + totalTambahan;
            }
            updateDisplay();
        }

        const fileName = document.getElementById('file-name');
        screenshotInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
            } else {
                fileName.textContent = '';
            }
        });

        // Fungsi untuk toggle payment info dan screenshot section
        function togglePaymentSection() {
            const metodeBayar = document.querySelector('input[name="metode_bayar"]:checked');

            if (metodeBayar && metodeBayar.value === 'full_cash_on_site') {
                // Hide bank info dan payment title untuk Full Cash
                bankInfoSection.style.display = 'none';
                paymentInfoTitle.style.display = 'none';
                // Hide screenshot section untuk Full Cash
                screenshotSection.style.display = 'none';
                // Make screenshot optional
                screenshotInput.removeAttribute('required');
            } else {
                // Show bank info dan payment title untuk metode lain (DP 50% dan Lunas)
                bankInfoSection.style.display = 'block';
                paymentInfoTitle.style.display = 'block';
                // Show screenshot section untuk metode lain
                screenshotSection.style.display = 'block';
                // Make screenshot required untuk metode lain
                screenshotInput.setAttribute('required', 'required');
            }
        }

        // Set initial state - show payment info by default (untuk DP 50% atau Lunas)
        window.addEventListener('load', function() {
            togglePaymentSection();
        });

        // Event listener untuk payment method changes
        document.querySelectorAll('input[name="metode_bayar"]').forEach(radio => {
            radio.addEventListener('change', function() {
                togglePaymentSection();
                calculateTotal();
            });
        });

        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Validasi slot paket
            const slotTersedia = parseInt(document.getElementById('slot-tersedia').textContent);
            if (slotTersedia <= 0) {
                alert('Maaf, slot untuk paket ini sudah habis. Silakan pilih paket lain.');
                return false;
            }

            // Ambil semua nilai form
            const namaPemesan = document.getElementById('nama_pemesan').value.trim();
            const noWa = document.getElementById('no_wa').value.trim();
            const tanggalBooking = document.getElementById('tanggal_booking').value.trim();
            const metodeBayar = document.querySelector('input[name="metode_bayar"]:checked');
            const screenshot = screenshotInput.files[0];

            // Validasi dasar - lengkapi field
            if (!namaPemesan) {
                alert('Nama Pemesan harus diisi!');
                document.getElementById('nama_pemesan').focus();
                return false;
            }

            if (!noWa) {
                alert('Nomor WhatsApp harus diisi!');
                document.getElementById('no_wa').focus();
                return false;
            }

            if (!tanggalBooking) {
                alert('Tanggal Booking harus dipilih!');
                document.getElementById('tanggal_booking').focus();
                return false;
            }

            if (!metodeBayar) {
                alert('Metode Pembayaran harus dipilih!');
                return false;
            }

            // Screenshot hanya required jika bukan full_cash_on_site
            if (metodeBayar.value !== 'full_cash_on_site') {
                if (!screenshot) {
                    alert('Bukti Pembayaran harus diupload!');
                    // Scroll ke screenshot section daripada focus
                    screenshotSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    return false;
                }
                // Validasi ukuran dan tipe file
                if (screenshot.size > 2 * 1024 * 1024) {
                    alert('Ukuran file tidak boleh lebih dari 2MB!');
                    return false;
                }
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!allowedTypes.includes(screenshot.type)) {
                    alert('Format file harus JPG atau PNG!');
                    return false;
                }
            } else {
                // Full Cash - screenshot tidak perlu
                // Lanjut ke validasi berikutnya
            }

            // Validasi format nomor WhatsApp
            const waRegex = /^[0-9]{10,13}$/;
            const waDigits = noWa.replace(/[^0-9]/g, '');
            if (!waRegex.test(waDigits)) {
                alert('Format nomor WhatsApp tidak valid! Gunakan format: 081234567890 (10-13 digit)');
                document.getElementById('no_wa').focus();
                return false;
            }

            // Validasi stok addons
            let stokCukup = true;
            let errorAddon = '';
            document.querySelectorAll('.addon-item').forEach(item => {
                const addonId = item.getAttribute('data-addon-id');
                const input = document.getElementById('qty-' + addonId);
                const quantity = parseInt(input.value) || 0;
                const maxStock = parseInt(item.getAttribute('data-addon-stock'));
                if (quantity > maxStock) {
                    stokCukup = false;
                    const addonName = item.querySelector('.addon-name').textContent;
                    errorAddon = 'Stok untuk ' + addonName + ' tidak mencukupi! Stok tersedia: ' + maxStock;
                }
            });
            if (!stokCukup) {
                alert(errorAddon);
                return false;
            }

            // Disable submit button dan tampilkan loading
            submitBtn.disabled = true;
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

            // Submit form
            setTimeout(() => {
                this.submit();
            }, 300);
        });

        updateDisplay();

        document.querySelectorAll('.copy-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const textToCopy = this.getAttribute('data-text');
                navigator.clipboard.writeText(textToCopy).then(() => {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
                    this.classList.add('copied');
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.classList.remove('copied');
                    }, 2000);
                }).catch(() => {
                    const textArea = document.createElement('textarea');
                    textArea.value = textToCopy;
                    document.body.appendChild(textArea);
                    textArea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textArea);
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

        if ('ontouchstart' in window) {
            document.documentElement.classList.add('touch-device');
        }
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
