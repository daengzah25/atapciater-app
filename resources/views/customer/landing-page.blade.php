<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atap Ciater - Camping Ground & Adventure</title>
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

        .btn-white {
            background: var(--white);
            color: var(--primary);
            box-shadow: var(--shadow);
        }

        .btn-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255,255,255,0.3);
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

        .btn-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        /* Main Content */
        .main-content {
            margin-top: 80px;
        }

        /* Hero Section */
        .hero {
            position: relative;
            min-height: 85vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, rgba(46,125,50,0.85), rgba(27,94,32,0.9)),
                        url("{{ asset('images/gallery/atap_ciater1.jpeg') }}");
            background-size: cover;
            background-position: center;
            color: var(--white);
            padding: 4rem 0;
            overflow: hidden;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: linear-gradient(transparent, var(--white));
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        /* Section Styles */
        .section {
            padding: 5rem 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
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

        /* Features Section */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: var(--white);
            padding: 2.5rem 2rem;
            border-radius: var(--radius);
            text-align: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--white);
            font-size: 1.75rem;
            transition: var(--transition);
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        /* Packages Section */
        .packages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2.5rem;
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
            height: 220px;
            position: relative;
            overflow: hidden;
        }

        .package-header img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .package-card:hover .package-header img {
            transform: scale(1.05);
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
            font-size: 1.25rem;
            box-shadow: var(--shadow);
        }

        .package-body {
            padding: 2rem;
        }

        .package-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .package-features {
            list-style: none;
            margin: 1.5rem 0;
        }

        .package-features li {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--light-gray);
        }

        .package-features li:last-child {
            border-bottom: none;
        }

        .package-features i {
            color: var(--primary);
            width: 20px;
        }

        /* Gallery Section */
        .gallery-section {
            background: var(--light);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .gallery-item {
            border-radius: var(--radius);
            overflow: hidden;
            aspect-ratio: 4/3;
            position: relative;
            cursor: pointer;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.7));
            color: var(--white);
            padding: 1.5rem;
            transform: translateY(100%);
            transition: var(--transition);
        }

        .gallery-item:hover .gallery-overlay {
            transform: translateY(0);
        }

        /* Testimonials Section */
        .testimonials-section {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .testimonials-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .testimonials-section .section-title {
            color: var(--white);
        }

        .testimonials-section .section-subtitle {
            color: rgba(255,255,255,0.8);
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            position: relative;
            z-index: 1;
        }

        .testimonial-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: var(--radius);
            backdrop-filter: blur(10px);
            transition: var(--transition);
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .testimonial-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            background: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: 700;
            font-size: 1.1rem;
        }

        .author-info h4 {
            margin-bottom: 0.25rem;
            font-size: 1.1rem;
        }

        .author-info p {
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
            margin: 0;
        }

        .rating {
            color: var(--accent);
            font-size: 0.9rem;
        }

        .testimonial-text {
            font-style: italic;
            line-height: 1.7;
            position: relative;
            padding-left: 1.5rem;
        }

        .testimonial-text::before {
            content: '"';
            position: absolute;
            left: 0;
            top: -0.5rem;
            font-size: 3rem;
            color: rgba(255,255,255,0.3);
            font-family: Georgia, serif;
            line-height: 1;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            color: var(--white);
            padding: 5rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .cta-content {
            position: relative;
            z-index: 1;
            max-width: 700px;
            margin: 0 auto;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .cta-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
        }

        /* Testimonial Form */
        .testimonial-form-container {
            max-width: 600px;
            margin: 4rem auto 0;
            background: var(--white);
            padding: 3rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            position: relative;
            z-index: 1;
        }

        .form-title {
            text-align: center;
            color: var(--primary);
            margin-bottom: 2rem;
            font-size: 1.75rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text);
        }

        .form-control {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid var(--light-gray);
            border-radius: var(--radius);
            font-size: 1rem;
            transition: var(--transition);
            font-family: inherit;
        }

        .form-control:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(46,125,50,0.1);
        }

        .rating-input {
            display: flex;
            gap: 0.5rem;
            margin: 1rem 0;
        }

        .star {
            font-size: 2rem;
            color: #ddd;
            cursor: pointer;
            transition: var(--transition);
        }

        .star:hover,
        .star.active {
            color: var(--accent);
            transform: scale(1.1);
        }

        .alert {
            padding: 1rem 1.25rem;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Footer */
        .footer {
            background: var(--primary-dark);
            color: var(--white);
            padding: 4rem 0 2rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-section h3 {
            margin-bottom: 1.5rem;
            font-size: 1.25rem;
            position: relative;
            display: inline-block;
        }

        .footer-section h3::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--accent);
            border-radius: 2px;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a:hover {
            color: var(--white);
            transform: translateX(5px);
        }

        .contact-info {
            list-style: none;
        }

        .contact-info li {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.25rem;
            color: rgba(255,255,255,0.7);
        }

        .contact-info i {
            margin-top: 0.25rem;
            width: 20px;
            color: var(--accent);
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-link {
            width: 44px;
            height: 44px;
            background: rgba(255,255,255,0.1);
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

            .hero-section {
                padding: 5rem 0 4rem;
                min-height: auto;
            }

            .hero-title {
                font-size: 1.5rem;
                line-height: 1.3;
                margin-bottom: 0.75rem;
            }

            .hero-subtitle {
                font-size: 0.85rem;
                margin-bottom: 1.5rem;
                line-height: 1.5;
            }

            .section {
                padding: 2.5rem 0;
            }

            .section-title {
                font-size: 1.25rem;
                margin-bottom: 1.5rem;
            }

            .section-subtitle {
                font-size: 0.85rem;
                margin-bottom: 1.5rem;
            }

            .feature-grid {
                grid-template-columns: 1fr;
                gap: 0.875rem;
            }

            .feature-card {
                padding: 1rem;
                margin: 0;
                border-radius: 8px;
            }

            .feature-card i {
                font-size: 1.75rem;
                margin-bottom: 0.5rem;
            }

            .feature-card h3 {
                font-size: 0.9rem;
                margin-bottom: 0.5rem;
            }

            .feature-card p {
                font-size: 0.8rem;
            }

            .package-grid {
                grid-template-columns: 1fr;
                gap: 0.875rem;
            }

            .package-card {
                padding: 1rem;
                margin: 0;
                border-radius: 8px;
            }

            .package-card h3 {
                font-size: 0.95rem;
                margin-bottom: 0.5rem;
            }

            .package-price {
                font-size: 1.1rem;
                margin-bottom: 0.5rem;
            }

            .package-card p {
                font-size: 0.8rem;
                margin-bottom: 0.4rem;
            }

            .package-card ul li {
                font-size: 0.75rem;
                margin-bottom: 0.3rem;
            }

            .package-card .slot-badge {
                font-size: 0.75rem;
                padding: 0.35rem 0.75rem;
                margin-top: 0.5rem;
            }

            .btn-group {
                flex-direction: column;
                align-items: center;
                gap: 0.75rem;
                margin-top: 1rem;
            }

            .btn {
                width: 100%;
                max-width: 100%;
                padding: 0.65rem 1.5rem;
                font-size: 0.85rem;
            }

            .gallery-grid {
                grid-template-columns: 1fr 1fr;
                gap: 0.75rem;
            }

            .gallery-item {
                border-radius: 6px;
                height: 140px;
            }

            .testimonial-grid {
                grid-template-columns: 1fr;
                gap: 0.875rem;
            }

            .testimonial-card {
                padding: 1rem;
                border-radius: 8px;
            }

            .testimonial-text {
                font-size: 0.8rem;
                margin-bottom: 0.75rem;
                line-height: 1.5;
            }

            .testimonial-author {
                font-size: 0.85rem;
                font-weight: 600;
            }

            .testimonial-city {
                font-size: 0.75rem;
            }

            .rating-display {
                font-size: 0.75rem;
            }

            .testimonial-form-container {
                padding: 1rem;
                border-radius: 8px;
            }

            .form-group {
                margin-bottom: 0.75rem;
            }

            .form-group label {
                font-size: 0.85rem;
                margin-bottom: 0.3rem;
            }

            .form-group input,
            .form-group textarea {
                padding: 0.6rem;
                font-size: 0.85rem;
                border-radius: 6px;
            }

            .rating-input {
                gap: 0.4rem;
                margin-bottom: 0.75rem;
            }

            .star {
                font-size: 1.25rem;
            }

            .contact-info {
                margin-bottom: 1.5rem;
            }

            .contact-info li {
                font-size: 0.8rem;
                margin-bottom: 0.75rem;
                gap: 0.75rem;
            }

            .contact-info i {
                font-size: 1rem;
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

            .footer-links li {
                margin-bottom: 0.5rem;
            }

            .footer-links a {
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

            .brand {
                font-size: 1.15rem;
                gap: 0.5rem;
            }

            .brand-logo {
                height: 38px;
            }

            .header {
                padding: 0.75rem 0;
            }

            .side-nav {
                width: 280px;
            }

            .nav-item {
                margin-bottom: 0.3rem;
            }

            .nav-link {
                padding: 0.75rem 1.25rem;
                font-size: 0.9rem;
            }
        }

        @media (min-width: 641px) and (max-width: 768px) {
            .container {
                padding: 0 1rem;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 0.95rem;
            }

            .section-title {
                font-size: 1.6rem;
            }

            .feature-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .package-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .gallery-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 0.875rem;
            }

            .gallery-item {
                height: 160px;
            }

            .testimonial-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .btn {
                max-width: none;
                padding: 0.75rem 2rem;
            }

            .btn-group {
                flex-direction: row;
                justify-content: center;
                gap: 1rem;
            }

            .testimonial-form-container {
                padding: 1.75rem;
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }

            .map-container iframe {
                height: 250px;
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
                <a href="{{ route('landing.page') }}" class="nav-link active">
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
                <a href="#gallery" class="nav-link">
                    <i class="fas fa-images nav-icon"></i>
                    Galeri
                </a>
            </li>
            <li class="nav-item">
                <a href="#testimonials" class="nav-link">
                    <i class="fas fa-star nav-icon"></i>
                    Testimoni
                </a>
            </li>
            <li class="nav-item">
                <a href="#contact" class="nav-link">
                    <i class="fas fa-phone nav-icon"></i>
                    Kontak
                </a>
            </li>
        </ul>

        <div class="nav-actions">
            <a href="{{ route('customer.paket') }}" class="btn btn-primary btn-block">
                <i class="fas fa-calendar-plus"></i>
                Booking Sekarang
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-badge">
                        <i class="fas fa-campground"></i>
                        <span>Destinasi Camping Terbaik di Ciater</span>
                    </div>
                    <h1 class="hero-title">Petualangan Alam Terbaik Dimulai Di Sini</h1>
                    <p class="hero-subtitle">Nikmati momen tak terlupakan di Atap Ciater dengan pemandangan memukau, fasilitas premium, dan pengalaman camping yang aman dan nyaman</p>
                    <div class="btn-group">
                        <a href="{{ route('customer.paket') }}" class="btn btn-accent">
                            <i class="fas fa-calendar-plus"></i>
                            Booking Sekarang
                        </a>
                        <a href="#packages" class="btn btn-white">
                            <i class="fas fa-campground"></i>
                            Lihat Paket
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Kenapa Pilih Atap Ciater?</h2>
                    <p class="section-subtitle">Pengalaman camping terbaik dengan fasilitas unggulan dan pelayanan profesional</p>
                </div>

                <div class="features-grid">
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-mountain"></i>
                        </div>
                        <h3>Pemandangan Eksklusif</h3>
                        <p>Nikmati keindahan alam dari ketinggian dengan udara sejuk dan pemandangan memukau yang tidak akan Anda temukan di tempat lain</p>
                    </div>

                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>Aman & Terjaga</h3>
                        <p>Area camping yang aman dengan keamanan 24 jam dan fasilitas keselamatan lengkap untuk kenyamanan dan ketenangan Anda</p>
                    </div>

                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h3>Perlengkapan Lengkap</h3>
                        <p>Tersedia peralatan camping berkualitas tinggi untuk disewa sesuai kebutuhan, dari tenda hingga perlengkapan masak</p>
                    </div>

                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <h3>Pemandu Profesional</h3>
                        <p>Didampingi pemandu wisata berpengalaman yang siap membantu dan memandu Anda untuk pengalaman terbaik</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Packages Section -->
        <section id="packages" class="section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Paket Camping Populer</h2>
                    <p class="section-subtitle">Pilih paket yang sesuai dengan kebutuhan petualangan Anda</p>
                </div>

                <div class="packages-grid">
                    @foreach ($pakets->take(3) as $paket)
                    <div class="package-card fade-in">
                        <div class="package-badge">Populer</div>
                        <div class="package-header">
                            @if ($paket->gambar && file_exists(public_path('images/paket_images/' . $paket->gambar)))
                                <img src="{{ asset('images/paket_images/' . $paket->gambar) }}" alt="{{ $paket->nama_paket }}">
                            @else
                                <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: white; font-size: 3rem; background: linear-gradient(135deg, var(--primary), var(--primary-dark));">
                                    <i class="fas fa-campground"></i>
                                </div>
                            @endif
                            <div class="package-price">Rp {{ number_format($paket->harga, 0, ',', '.') }}</div>
                        </div>
                        <div class="package-body">
                            <h3 class="package-title">{{ $paket->nama_paket }}</h3>
                            <ul class="package-features">
                                <li>
                                    <i class="fas fa-users"></i>
                                    <span>Tersedia {{ $paket->slot }} Slot</span>
                                </li>
                                <li>
                                    <i class="fas fa-list"></i>
                                    <span>{{ Str::limit($paket->fasilitas, 40) }}</span>
                                </li>
                            </ul>
                            <a href="{{ route('customer.paket') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-info-circle"></i>
                                Detail & Booking
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="text-center mt-2">
                    <a href="{{ route('customer.paket') }}" class="btn btn-secondary">
                        <i class="fas fa-list"></i>
                        Lihat Semua Paket
                    </a>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <section id="gallery" class="section gallery-section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Galeri Atap Ciater</h2>
                    <p class="section-subtitle">Lihat momen-momen indah di tempat camping kami</p>
                </div>

                <div class="gallery-grid">
                    @for($i = 1; $i <= 8; $i++)
                    <div class="gallery-item fade-in">
                        <img src="{{ asset('images/gallery/atap_ciater' . $i . '.jpeg') }}" alt="Atap Ciater {{ $i }}" loading="lazy">
                        <div class="gallery-overlay">
                            <h4>Atap Ciater {{ $i }}</h4>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="container">
                <div class="cta-content">
                    <h2 class="cta-title">Siap Memulai Petualangan?</h2>
                    <p class="cta-subtitle">Jadwalkan pengalaman camping tak terlupakan Anda sekarang dan nikmati momen berharga di alam terbuka</p>
                    <div class="btn-group">
                        <a href="{{ route('customer.paket') }}" class="btn btn-white">
                            <i class="fas fa-calendar-plus"></i>
                            Booking Sekarang
                        </a>
                        <a href="{{ route('customer.cektiket') }}" class="btn btn-secondary">
                            <i class="fas fa-ticket-alt"></i>
                            Cek Tiket Saya
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials" class="section testimonials-section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Testimoni Pelanggan</h2>
                    <p class="section-subtitle">Apa kata mereka tentang pengalaman camping di Atap Ciater</p>
                </div>

                <div class="testimonials-grid">
                    @foreach ($testimonials as $testimonial)
                    <div class="testimonial-card fade-in">
                        <div class="testimonial-header">
                            <div class="testimonial-author">
                                <div class="author-avatar">
                                    {{ substr($testimonial->nama, 0, 1) }}
                                </div>
                                <div class="author-info">
                                    <h4>{{ $testimonial->nama }}</h4>
                                    <p>{{ $testimonial->asal_kota ?: 'Tidak disebutkan' }}</p>
                                </div>
                            </div>
                            <div class="rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-half-alt' }}"></i>
                                @endfor
                            </div>
                        </div>
                        <p class="testimonial-text">{{ $testimonial->testimoni }}</p>
                        <small style="display: block; margin-top: 1rem; opacity: 0.7;">
                            {{ \Carbon\Carbon::parse($testimonial->created_at)->translatedFormat('d F Y') }}
                        </small>
                    </div>
                    @endforeach
                </div>

                <!-- Testimonial Form -->
                <div class="testimonial-form-container fade-in">
                    <h3 class="form-title">Beri Testimoni Anda</h3>

                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-error">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <strong>Terdapat kesalahan:</strong>
                                <ul style="margin: 0.5rem 0 0 1rem;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('testimonial.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Nama *</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required placeholder="Masukkan nama lengkap Anda">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Asal Kota</label>
                            <input type="text" name="asal_kota" class="form-control" value="{{ old('asal_kota') }}" placeholder="Kota asal Anda">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Rating *</label>
                            <div class="rating-input">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="star {{ $i <= old('rating', 5) ? 'active' : '' }}" data-rating="{{ $i }}">
                                        <i class="fas fa-star"></i>
                                    </span>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="ratingInput" value="{{ old('rating', 5) }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Testimoni *</label>
                            <textarea name="testimoni" class="form-control" rows="4" required placeholder="Bagikan pengalaman Anda camping di Atap Ciater...">{{ old('testimoni') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-paper-plane"></i>
                            Kirim Testimoni
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3>Atap Ciater</h3>
                    <p>Destinasi camping premium dengan pemandangan alam menakjubkan dan fasilitas lengkap untuk pengalaman outdoor terbaik yang tak terlupakan.</p>
                    <div class="social-links">
                        <a href="https://www.instagram.com/atapciater1540mdpl" class="social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://www.tiktok.com/@atap.ciater1540mdpl" class="social-link">
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
                        <li><a href="#gallery"><i class="fas fa-chevron-right"></i> Galeri</a></li>
                        <li><a href="#testimonials"><i class="fas fa-chevron-right"></i> Testimoni</a></li>
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

        // Rating Stars
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('ratingInput');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.getAttribute('data-rating');
                ratingInput.value = rating;

                stars.forEach(s => {
                    const starRating = s.getAttribute('data-rating');
                    s.classList.toggle('active', starRating <= rating);
                });
            });

            star.addEventListener('mouseover', function() {
                const rating = this.getAttribute('data-rating');
                stars.forEach(s => {
                    const starRating = s.getAttribute('data-rating');
                    s.classList.toggle('active', starRating <= rating);
                });
            });
        });

        // Reset stars on mouse leave (except for selected rating)
        document.querySelector('.rating-input').addEventListener('mouseleave', () => {
            const currentRating = ratingInput.value;
            stars.forEach(s => {
                const starRating = s.getAttribute('data-rating');
                s.classList.toggle('active', starRating <= currentRating);
            });
        });

        // Smooth scrolling for anchor links
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

        // Scroll animations
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

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.style.background = 'rgba(255, 255, 255, 0.98)';
                header.style.boxShadow = '0 5px 20px rgba(0,0,0,0.1)';
            } else {
                header.style.background = 'rgba(255, 255, 255, 0.95)';
                header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.05)';
            }
        });

        // Add loading animation to buttons
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', function(e) {
                if (this.getAttribute('href') && !this.classList.contains('no-loading')) {
                    e.preventDefault();
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memuat...';
                    this.disabled = true;

                    setTimeout(() => {
                        window.location.href = this.getAttribute('href');
                    }, 800);
                }
            });
        });
    </script>
</body>

</html>
