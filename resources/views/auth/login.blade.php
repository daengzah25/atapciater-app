<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Atap Ciater</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2e7d32;
            --primary-light: #4caf50;
            --primary-dark: #1b5e20;
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

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary-light), var(--primary-dark));
            color: var(--text);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .login-container {
            max-width: 400px;
            width: 100%;
        }

        .login-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 2rem;
            box-shadow: var(--shadow-lg);
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }



        .logo-wrapper img {
            height: 300px;
            width: auto;
            object-fit: contain;
        }

        .login-header h1 {
            color: var(--primary-dark);
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .login-header p {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .password-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            font-size: 1rem;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            transition: var(--transition);
        }

        .password-toggle:hover {
            color: var(--primary);
        }

        input[type="password"],
        input[type="text"] {
            padding-right: 3rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text);
            font-size: 0.95rem;
        }

        input {
            width: 100%;
            padding: 0.875rem;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            font-size: 0.95rem;
            transition: var(--transition);
            background: var(--white);
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(46,125,50,0.1);
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
            padding: 0.875rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: var(--transition);
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(46,125,50,0.3);
        }

        .errors {
            background: #ffebee;
            border: 1px solid #f44336;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            color: #c62828;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .errors::before {
            content: '⚠️';
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .errors ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .errors li {
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .errors li:last-child {
            margin-bottom: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-card {
                padding: 1.5rem;
            }

            .login-header h1 {
                font-size: 1.5rem;
            }

            .login-header p {
                font-size: 0.9rem;
            }

            input {
                padding: 0.75rem;
                font-size: 0.9rem;
            }

            .btn-primary {
                padding: 0.75rem;
                font-size: 0.95rem;
            }

            .form-group {
                margin-bottom: 1.25rem;
            }

            label {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0.5rem;
            }

            .login-container {
                max-width: 100%;
            }

            .login-card {
                padding: 1.25rem;
                border-radius: 8px;
            }

            .login-header {
                margin-bottom: 1.5rem;
            }

            .login-header h1 {
                font-size: 1.25rem;
                margin-bottom: 0.25rem;
            }

            .login-header p {
                font-size: 0.8rem;
            }

            .form-group {
                margin-bottom: 1rem;
            }

            label {
                font-size: 0.85rem;
                margin-bottom: 0.4rem;
            }

            input {
                padding: 0.65rem;
                font-size: 0.85rem;
            }

            input:focus {
                box-shadow: 0 0 0 2px rgba(46,125,50,0.08);
            }

            .btn-primary {
                padding: 0.65rem;
                font-size: 0.9rem;
                gap: 0.3rem;
            }

            .btn-primary:hover {
                transform: translateY(-1px);
            }

            .errors {
                padding: 0.75rem;
                margin-bottom: 0.75rem;
                gap: 0.5rem;
            }

            .errors li {
                font-size: 0.85rem;
                margin-bottom: 0.3rem;
            }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-wrapper">
                    <img src="{{ asset('images/logo/atap_ciater.png') }}" alt="Atap Ciater">
                </div>
                <h1>Atap Ciater</h1>
                <p>Silakan login untuk melanjutkan</p>
            </div>

            @if($errors->any())
                <div class="errors">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" required>
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleBtn = document.querySelector('.password-toggle i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleBtn.classList.remove('fa-eye');
                toggleBtn.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleBtn.classList.remove('fa-eye-slash');
                toggleBtn.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
