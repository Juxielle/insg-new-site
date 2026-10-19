<!DOCTYPE html>
<html class="no-js html" xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Institut National des Sciences de Gestion - INSG Gabon | Libreville')</title>
    <meta name="description" content="@yield('meta_description', 'Institut National des Sciences de Gestion (INSG) Gabon - Établissement public d\'enseignement supérieur de référence en sciences managériales et de gestion à Libreville.')" />

    <!-- Open Graph / Meta -->
    <meta property="og:title" content="@yield('title', 'Institut National des Sciences de Gestion - INSG Gabon')" />
    <meta property="og:description" content="@yield('meta_description', 'L\'INSG Gabon forme les cadres et dirigeants de demain en gestion, finance, marketing et management.')" />
    <meta property="og:site_name" content="INSG Gabon" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('assets/images/insg-logo.png') }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/insg-logo.png') }}" />

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/print.css') }}" media="print">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}?v={{ filemtime(public_path('assets/css/styles.css')) }}">
    <link rel="stylesheet" href="{{ asset('assets/css/index_style.css') }}?v={{ filemtime(public_path('assets/css/index_style.css')) }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ filemtime(public_path('assets/css/custom.css')) }}">

    <style>
        /* Flash message alerts */
        .insg-flash-container {
            max-width: 1200px;
            margin: 1rem auto;
            padding: 0 1.5rem;
        }
        .insg-alert {
            padding: 1rem 1.25rem;
            border-radius: 4px;
            margin-bottom: 1rem;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .insg-alert--success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border-left: 5px solid #2e7d32;
        }
        .insg-alert--error {
            background-color: #ffebee;
            color: #c62828;
            border-left: 5px solid #c62828;
        }
    </style>

    @stack('styles')

    <script type="text/javascript">var html = document.getElementsByTagName('html')[0]; html.className = html.className.replace('no-js', 'js');</script>
</head>
<body id="body" class="fiche {{ Route::is('home') ? 'ficheaccueil accueil' : 'pagelibre rubrique' }} site_principal" data-toggle="#menu_principal .active, .header_toogle .active, .menu_toggle .active, #call-to-actions .active" data-toggle-bubble>

    @include('partials.header')

    {{-- Flash Notifications --}}
    @if(session('success'))
        <div class="insg-flash-container">
            <div class="insg-alert insg-alert--success" role="alert">
                <span>{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.style.display='none';" style="background:none;border:none;cursor:pointer;font-weight:bold;color:#2e7d32;">&times;</button>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="insg-flash-container">
            <div class="insg-alert insg-alert--error" role="alert">
                <span>{{ session('error') }}</span>
                <button type="button" onclick="this.parentElement.style.display='none';" style="background:none;border:none;cursor:pointer;font-weight:bold;color:#c62828;">&times;</button>
            </div>
        </div>
    @endif

    {{-- Main Page Content --}}
    @yield('content')

    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>

