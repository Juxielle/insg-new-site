<!DOCTYPE html>
<html lang="fr" class="js">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Connexion Administration | INSG Gabon</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/insg-logo.png') }}" />

    <!-- Authentic Base Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}?v={{ filemtime(public_path('assets/css/styles.css')) }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ filemtime(public_path('assets/css/custom.css')) }}">

    <style>
        *, *::before, *::after {
            box-sizing: border-box;
        }

        html, body {
            height: 100% !important;
            max-height: 100vh !important;
            overflow: hidden !important;
            margin: 0 !important;
            padding: 0 !important;
            font-family: Roboto, -apple-system, BlinkMacSystemFont, "Segoe UI", Arial, sans-serif !important;
            background-color: #f4f6f9 !important;
            color: #1e293b;
        }

        .login-viewport {
            height: 100vh;
            max-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            overflow: hidden;
            background: radial-gradient(circle at 50% 20%, #ffffff 0%, #f1f5f9 60%, #e2e8f0 100%);
            position: relative;
        }

        /* Subtle top brand bar */
        .login-top-stripe {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #1f234b 0%, #0091B5 100%);
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-top: 4px solid #1f234b;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(31, 35, 75, 0.08), 0 2px 6px rgba(0,0,0,0.04);
            padding: 1.75rem 2rem 1.5rem;
            position: relative;
        }

        .login-brand-header {
            text-align: center;
            margin-bottom: 1.25rem;
        }

        .login-logo {
            height: 52px;
            width: auto;
            margin-bottom: 0.5rem;
            display: inline-block;
        }

        .login-title {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f234b;
            letter-spacing: -0.3px;
            line-height: 1.2;
        }

        .login-subtitle {
            margin: 0.25rem 0 0;
            font-size: 0.8rem;
            color: #64748b;
        }

        .login-form-group {
            margin-bottom: 1rem;
        }

        .login-label {
            display: block;
            margin-bottom: 0.35rem;
            font-weight: 600;
            font-size: 0.85rem;
            color: #334155;
        }

        .login-label .required {
            color: #dc2626;
        }

        .login-input {
            width: 100%;
            padding: 0.65rem 0.85rem;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            font-size: 0.9rem;
            color: #1e293b;
            background: #ffffff;
            font-family: inherit;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .login-input:focus {
            border-color: #0091B5;
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 145, 181, 0.15);
        }

        .login-input.has-error {
            border-color: #dc2626;
        }

        .login-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.15rem;
            font-size: 0.825rem;
            color: #475569;
        }

        .login-remember {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            cursor: pointer;
            user-select: none;
        }

        .login-remember input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #1f234b;
            cursor: pointer;
        }

        .login-btn {
            width: 100%;
            padding: 0.75rem 1rem;
            background: #1f234b;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: background 0.2s, transform 0.1s;
        }

        .login-btn:hover {
            background: #151834;
        }

        .login-btn:active {
            transform: scale(0.99);
        }

        .login-hint {
            margin-top: 1.15rem;
            padding: 0.65rem 0.85rem;
            background: #f8fafc;
            border-left: 3px solid #0091B5;
            border-radius: 4px;
            font-size: 0.775rem;
            color: #475569;
            line-height: 1.45;
        }

        .login-hint code {
            background: #e2e8f0;
            padding: 1px 5px;
            border-radius: 3px;
            font-weight: 600;
            color: #1e293b;
        }

        .login-footer-links {
            text-align: center;
            margin-top: 1rem;
            padding-top: 0.85rem;
            border-top: 1px solid #f1f5f9;
        }

        .login-footer-links a {
            color: #0091B5;
            text-decoration: none;
            font-size: 0.825rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            transition: color 0.2s;
        }

        .login-footer-links a:hover {
            color: #007a99;
            text-decoration: underline;
        }

        /* Alert notifications */
        .login-alert {
            padding: 0.6rem 0.85rem;
            border-radius: 4px;
            font-size: 0.825rem;
            margin-bottom: 1rem;
        }

        .login-alert--danger {
            background: #fee2e2;
            border-left: 3px solid #dc2626;
            color: #991b1b;
        }

        .login-alert--success {
            background: #dcfce7;
            border-left: 3px solid #16a34a;
            color: #166534;
        }
    </style>
</head>
<body>
    <div class="login-viewport">
        <div class="login-top-stripe"></div>

        <div class="login-card">
            <div class="login-brand-header">
                <a href="{{ route('home') }}" title="Retourner à l'accueil du site">
                    <img src="{{ asset('assets/images/insg-logo.png') }}" alt="Logo INSG Gabon" class="login-logo" />
                </a>
                <h1 class="login-title">Administration INSG</h1>
                <p class="login-subtitle">Console de gestion du portail institutionnel</p>
            </div>

            @if(session('success'))
                <div class="login-alert login-alert--success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="login-alert login-alert--danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf

                <div class="login-form-group">
                    <label class="login-label" for="email">
                        Adresse email <span class="required">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email', 'admin@insg-gabon.ga') }}" required autofocus class="login-input {{ $errors->has('email') ? 'has-error' : '' }}" placeholder="admin@insg-gabon.ga" />
                </div>

                <div class="login-form-group">
                    <label class="login-label" for="password">
                        Mot de passe <span class="required">*</span>
                    </label>
                    <input type="password" id="password" name="password" required value="password" class="login-input {{ $errors->has('password') ? 'has-error' : '' }}" placeholder="••••••••" />
                </div>

                <div class="login-options">
                    <label class="login-remember">
                        <input type="checkbox" name="remember" value="1" checked />
                        <span>Se souvenir de moi</span>
                    </label>
                </div>

                <button type="submit" class="login-btn">
                    <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    <span>Se connecter</span>
                </button>
            </form>

            <div class="login-hint">
                <strong>Identifiants de démonstration :</strong><br>
                Email : <code>admin@insg-gabon.ga</code> &bull; Mot de passe : <code>password</code>
            </div>

            <div class="login-footer-links">
                <a href="{{ route('home') }}">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Retourner sur le site public</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
