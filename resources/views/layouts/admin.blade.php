<!DOCTYPE html>
<html lang="fr" class="js">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Administration') | INSG Gabon - Back Office</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/insg-logo.png') }}" />

    <!-- Admin Dedicated Stylesheet (INSG Brand Navy #1f234b & Cyan #0091B5, Isolated from CMS stylesheets) -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}?v={{ filemtime(public_path('assets/css/admin.css')) }}">
    @stack('admin-styles')
</head>
<body class="admin-body">

    @auth
        <!-- Vertical Sidebar -->
        <aside class="admin-sidebar" id="adminSidebar">
            <!-- Sidebar Header -->
            <div class="admin-sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-brand">
                    <img src="{{ asset('assets/images/insg-logo.png') }}" alt="Logo INSG" />
                    <div>
                        <div class="admin-brand-title">INSG GABON</div>
                        <div class="admin-brand-subtitle">Console de Gestion</div>
                    </div>
                </a>
            </div>

            <!-- Sidebar Navigation Menu -->
            <nav class="admin-sidebar-nav">
                <div class="admin-nav-group-title">TABLEAU DE BORD</div>
                <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Vue d'ensemble</span>
                </a>

                <div class="admin-nav-group-title">CONTENUS DU SITE</div>
                <a href="{{ route('admin.slides.index') }}" class="admin-sidebar-link {{ Route::is('admin.slides.*') ? 'active' : '' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>Slides Carrousel</span>
                </a>
                <a href="{{ route('admin.actualites.index') }}" class="admin-sidebar-link {{ Route::is('admin.actualites.*') ? 'active' : '' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <span>Actualités</span>
                </a>
                <a href="{{ route('admin.formations.index') }}" class="admin-sidebar-link {{ Route::is('admin.formations.*') ? 'active' : '' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                    <span>Formations</span>
                </a>
                <a href="{{ route('admin.evenements.index') }}" class="admin-sidebar-link {{ Route::is('admin.evenements.*') ? 'active' : '' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>Événements & Agenda</span>
                </a>

                <div class="admin-nav-group-title">INSTITUTION & CAMPUS</div>
                <a href="{{ route('admin.statistiques.index') }}" class="admin-sidebar-link {{ Route::is('admin.statistiques.*') ? 'active' : '' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    <span>Chiffres Clés</span>
                </a>
                <a href="{{ route('admin.temoignages.index') }}" class="admin-sidebar-link {{ Route::is('admin.temoignages.*') ? 'active' : '' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    <span>Témoignages Alumni</span>
                </a>
                <a href="{{ route('admin.gouvernances.index') }}" class="admin-sidebar-link {{ Route::is('admin.gouvernances.*') ? 'active' : '' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span>Gouvernance</span>
                </a>
                <a href="{{ route('admin.infrastructures.index') }}" class="admin-sidebar-link {{ Route::is('admin.infrastructures.*') ? 'active' : '' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>Infrastructures</span>
                </a>
                <a href="{{ route('admin.partenaires.index') }}" class="admin-sidebar-link {{ Route::is('admin.partenaires.*') ? 'active' : '' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>Partenaires</span>
                </a>

                <div class="admin-nav-group-title">COMMUNICATIONS</div>
                <a href="{{ route('admin.messages.index') }}" class="admin-sidebar-link {{ Route::is('admin.messages.*') ? 'active' : '' }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>Messages Reçus</span>
                    @php $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
                    @if($unreadCount > 0)
                        <span class="admin-sidebar-badge">{{ $unreadCount }}</span>
                    @endif
                </a>
            </nav>

            <!-- Sidebar User / Footer -->
            <div class="admin-sidebar-footer">
                <div class="admin-user-info">
                    <span class="admin-user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    <div class="admin-user-meta">
                        <span class="admin-user-name">{{ Auth::user()->name }}</span>
                        <span class="admin-user-role">Administrateur</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="admin-logout-icon-btn" title="Se déconnecter de l'administration">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </aside>

        <div class="admin-sidebar-backdrop" onclick="document.getElementById('adminSidebar').classList.remove('open');"></div>
    @endauth

    <!-- Main Content Wrap -->
    <div class="admin-main-wrap">
        <!-- Topbar -->
        <header class="admin-topbar">
            <div class="admin-topbar-left">
                @auth
                    <button type="button" class="admin-sidebar-toggle" onclick="document.getElementById('adminSidebar').classList.toggle('open');" title="Menu vertical">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div class="admin-breadcrumb-bar">
                        <a href="{{ route('admin.dashboard') }}">Administration</a>
                        @yield('breadcrumbs')
                    </div>
                @endauth
            </div>

            <div class="admin-topbar-right">
                <a href="{{ route('home') }}" target="_blank" class="admin-view-site" title="Ouvrir le portail public dans un nouvel onglet">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>Voir le site</span>
                </a>
            </div>
        </header>

        <!-- Flash notifications -->
        @if(session('success'))
            <div style="max-width: 1400px; width: 100%; margin: 1.25rem auto 0; padding: 0 1.5rem; box-sizing: border-box;">
                <div class="insg-alert insg-alert--success" style="margin: 0; box-shadow: 0 2px 4px rgba(0,0,0,0.06);">
                    <span style="display:flex; align-items:center; gap:0.5rem;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <strong>Succès :</strong> {{ session('success') }}
                    </span>
                    <button type="button" onclick="this.parentElement.style.display='none';" style="background:none;border:none;cursor:pointer;font-weight:bold;color:#2e7d32;font-size:1.25rem;">&times;</button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div style="max-width: 1400px; width: 100%; margin: 1.25rem auto 0; padding: 0 1.5rem; box-sizing: border-box;">
                <div class="insg-alert insg-alert--error" style="margin: 0; box-shadow: 0 2px 4px rgba(0,0,0,0.06);">
                    <span style="display:flex; align-items:center; gap:0.5rem;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        <strong>Erreur :</strong> {{ session('error') }}
                    </span>
                    <button type="button" onclick="this.parentElement.style.display='none';" style="background:none;border:none;cursor:pointer;font-weight:bold;color:#c62828;font-size:1.25rem;">&times;</button>
                </div>
            </div>
        @endif

        @if(isset($errors) && $errors->any())
            <div style="max-width: 1400px; width: 100%; margin: 1.25rem auto 0; padding: 0 1.5rem; box-sizing: border-box;">
                <div class="insg-alert insg-alert--error" style="margin: 0; box-shadow: 0 2px 4px rgba(0,0,0,0.06); flex-direction: column; align-items: flex-start;">
                    <div style="font-weight: bold; margin-bottom: 0.35rem;">Veuillez corriger les erreurs ci-dessous :</div>
                    <ul style="margin: 0; padding-left: 1.25rem; font-size: 0.875rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Main Page Content -->
        <main class="admin-main">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="admin-footer">
            <div><strong>Institut National des Sciences de Gestion (INSG) Gabon</strong> &bull; Console d'administration &bull; Libreville</div>
        </footer>
    </div>

    @stack('admin-scripts')
</body>
</html>
