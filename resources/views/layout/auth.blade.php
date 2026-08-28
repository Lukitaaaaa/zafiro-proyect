<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Zafiro') }}</title>
    
    <link rel="icon" href="{{ asset('images/logo-zafiro.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(8, 15, 27, 0.85), rgba(15, 23, 42, 0.9)), 
                        url('{{ asset('images/blue-mountains-3-qhd.jpg') }}') center/cover no-repeat fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1.5rem 1rem;
        }

        .auth-container {
            width: 100%;
            max-width: 440px;
            margin: auto;
        }

        .auth-card {
            background: rgba(15, 23, 42, 0.72);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 24px;
            padding: 2.25rem 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6), 
                        0 0 35px rgba(56, 189, 248, 0.08);
            position: relative;
            overflow: hidden;
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #2563eb, #38bdf8, #06b6d4);
        }

        .brand-header {
            text-align: center;
            margin-bottom: 1.75rem;
        }

        .brand-logo {
            width: 56px;
            height: 56px;
            margin: 0 auto 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            background: rgba(37, 99, 235, 0.15);
            border: 1px solid rgba(56, 189, 248, 0.3);
            box-shadow: 0 8px 16px rgba(14, 165, 233, 0.2);
            padding: 8px;
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .brand-title {
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #f8fafc;
            margin-bottom: 0.3rem;
        }

        .brand-subtitle {
            font-size: 0.88rem;
            color: #94a3b8;
        }

        /* Inputs & Labels styling */
        .auth-card .form-label {
            color: #cbd5e1;
            font-weight: 500;
            font-size: 0.875rem;
            margin-bottom: 0.4rem;
        }

        .auth-card .form-control {
            background-color: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            color: #f8fafc !important;
            border-radius: 12px;
            padding: 0.7rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .auth-card .form-control:focus {
            background-color: rgba(255, 255, 255, 0.08) !important;
            border-color: #38bdf8 !important;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2) !important;
            color: #ffffff !important;
        }

        .auth-card .form-control::placeholder {
            color: #64748b !important;
            opacity: 0.8;
        }

        .auth-card .form-control:read-only {
            background-color: rgba(255, 255, 255, 0.02) !important;
            color: #94a3b8 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        /* Primary Button */
        .btn-auth-primary {
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            border: none;
            color: #ffffff;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.75rem 1.25rem;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-auth-primary:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #0369a1 100%);
            transform: translateY(-1.5px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.5);
            color: #ffffff;
        }

        .btn-auth-primary:active {
            transform: translateY(0);
        }

        /* Links */
        .auth-link {
            color: #38bdf8;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .auth-link:hover {
            color: #7dd3fc;
            text-decoration: underline;
        }

        .auth-muted-text {
            color: #94a3b8;
            font-size: 0.875rem;
        }

        /* Alerts */
        .auth-card .alert {
            border-radius: 12px;
            font-size: 0.875rem;
            padding: 0.75rem 1rem;
            border: 1px solid transparent;
            margin-bottom: 1.25rem;
        }

        .auth-card .alert-success {
            background: rgba(16, 185, 129, 0.15);
            border-color: rgba(16, 185, 129, 0.3);
            color: #6ee7b7;
        }

        .auth-card .alert-danger {
            background: rgba(239, 68, 68, 0.15);
            border-color: rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }
    </style>
</head>

<body>
    <div class="auth-container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>