@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>Tableau de bord</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">Tableau de Bord</h1>
            <p class="admin-header-desc">Supervision et mise à jour des contenus dynamiques du portail INSG Gabon.</p>
        </div>
        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
            <a href="{{ route('admin.slides.create') }}" class="insg-btn insg-btn-outline">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                <span>Nouveau Slide</span>
            </a>
            <a href="{{ route('admin.actualites.create') }}" class="insg-btn insg-btn-primary">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                <span>Nouvelle Actualité</span>
            </a>
            <a href="{{ route('admin.formations.create') }}" class="insg-btn insg-btn-accent">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                <span>Nouvelle Formation</span>
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="insg-dashboard-grid">
        <a href="{{ route('admin.slides.index') }}" style="text-decoration:none; color:inherit;">
            <div class="insg-stat-card insg-stat-card--accent">
                <div class="insg-stat-val">{{ $stats['slides_count'] }}</div>
                <div class="insg-stat-label">Slides Carrousel</div>
                <div class="insg-stat-desc">{{ $stats['slides_active'] }} actifs sur la page d'accueil</div>
            </div>
        </a>

        <a href="{{ route('admin.actualites.index') }}" style="text-decoration:none; color:inherit;">
            <div class="insg-stat-card">
                <div class="insg-stat-val">{{ $stats['actualites_count'] }}</div>
                <div class="insg-stat-label">Actualités</div>
                <div class="insg-stat-desc">{{ $stats['actualites_featured'] }} articles mis à la une</div>
            </div>
        </a>

        <a href="{{ route('admin.formations.index') }}" style="text-decoration:none; color:inherit;">
            <div class="insg-stat-card insg-stat-card--success">
                <div class="insg-stat-val">{{ $stats['formations_count'] }}</div>
                <div class="insg-stat-label">Formations</div>
                <div class="insg-stat-desc">BTS, Licences Pro & Masters Pro</div>
            </div>
        </a>

        <a href="{{ route('admin.evenements.index') }}" style="text-decoration:none; color:inherit;">
            <div class="insg-stat-card insg-stat-card--accent">
                <div class="insg-stat-val">{{ $stats['evenements_count'] }}</div>
                <div class="insg-stat-label">Événements</div>
                <div class="insg-stat-desc">Agenda et cérémonies universitaires</div>
            </div>
        </a>

        <a href="{{ route('admin.statistiques.index') }}" style="text-decoration:none; color:inherit;">
            <div class="insg-stat-card">
                <div class="insg-stat-val">{{ $stats['statistiques_count'] }}</div>
                <div class="insg-stat-label">Chiffres Clés</div>
                <div class="insg-stat-desc">Indicateurs institutionnels</div>
            </div>
        </a>

        <a href="{{ route('admin.temoignages.index') }}" style="text-decoration:none; color:inherit;">
            <div class="insg-stat-card insg-stat-card--warning">
                <div class="insg-stat-val">{{ $stats['temoignages_count'] }}</div>
                <div class="insg-stat-label">Témoignages</div>
                <div class="insg-stat-desc">Avis d'anciens diplômés & partenaires</div>
            </div>
        </a>

        <a href="{{ route('admin.gouvernances.index') }}" style="text-decoration:none; color:inherit;">
            <div class="insg-stat-card">
                <div class="insg-stat-val">{{ $stats['gouvernance_count'] }}</div>
                <div class="insg-stat-label">Gouvernance</div>
                <div class="insg-stat-desc">Direction Générale & Équipe</div>
            </div>
        </a>

        <a href="{{ route('admin.infrastructures.index') }}" style="text-decoration:none; color:inherit;">
            <div class="insg-stat-card insg-stat-card--accent">
                <div class="insg-stat-val">{{ $stats['infrastructures_count'] }}</div>
                <div class="insg-stat-label">Infrastructures</div>
                <div class="insg-stat-desc">Amphis, BU, Labos, Espaces</div>
            </div>
        </a>

        <a href="{{ route('admin.messages.index') }}" style="text-decoration:none; color:inherit;">
            <div class="insg-stat-card {{ $stats['messages_unread'] > 0 ? 'insg-stat-card--warning' : '' }}">
                <div class="insg-stat-val" style="{{ $stats['messages_unread'] > 0 ? 'color: #b45309;' : '' }}">{{ $stats['messages_unread'] }}</div>
                <div class="insg-stat-label">Messages Non Lus</div>
                <div class="insg-stat-desc">{{ $stats['messages_count'] }} messages reçus au total</div>
            </div>
        </a>
    </div>

    <!-- Two Columns Overview -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 1.5rem;">
        
        <!-- Carrousel Slides en ligne -->
        <div class="insg-card">
            <div class="insg-card-header">
                <h2 class="insg-card-title">Slides du Carrousel d'Accueil</h2>
                <a href="{{ route('admin.slides.index') }}" class="insg-btn insg-btn-outline insg-btn-sm">Gérer tout</a>
            </div>
            <div class="insg-table-wrapper">
                <table class="insg-table">
                    <thead>
                        <tr>
                            <th>Visuel</th>
                            <th>Titre & Accroche</th>
                            <th>Ordre</th>
                            <th>Statut</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activeSlides as $slide)
                            <tr>
                                <td>
                                    <img src="{{ $slide->image_url }}" alt="" class="insg-table-thumb" />
                                </td>
                                <td>
                                    <strong>{{ $slide->title }}</strong>
                                    @if($slide->subtitle)
                                        <div style="font-size: 0.8rem; color: #64748b;">{{ Str::limit($slide->subtitle, 45) }}</div>
                                    @endif
                                </td>
                                <td><span class="insg-badge insg-badge-secondary">#{{ $slide->order }}</span></td>
                                <td>
                                    @if($slide->is_active)
                                        <span class="insg-badge insg-badge-success">Actif</span>
                                    @else
                                        <span class="insg-badge insg-badge-danger">Inactif</span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    <a href="{{ route('admin.slides.edit', $slide) }}" class="insg-btn insg-btn-outline insg-btn-sm">Modifier</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; color: #64748b; padding: 1.5rem;">Aucun slide configuré.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Dernières actualités -->
        <div class="insg-card">
            <div class="insg-card-header">
                <h2 class="insg-card-title">Dernières Actualités</h2>
                <a href="{{ route('admin.actualites.index') }}" class="insg-btn insg-btn-outline insg-btn-sm">Toutes les actus</a>
            </div>
            <div class="insg-table-wrapper">
                <table class="insg-table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Date</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestActualites as $actu)
                            <tr>
                                <td>
                                    <strong>{{ Str::limit($actu->title, 40) }}</strong>
                                    @if($actu->is_featured)
                                        <span class="insg-badge insg-badge-accent" style="margin-left: 0.35rem;">À la une</span>
                                    @endif
                                </td>
                                <td><span class="insg-badge insg-badge-secondary">{{ $actu->category }}</span></td>
                                <td style="font-size: 0.825rem; color: #64748b;">{{ $actu->published_at ? $actu->published_at->format('d/m/Y') : '-' }}</td>
                                <td style="text-align: right;">
                                    <a href="{{ route('admin.actualites.edit', $actu) }}" class="insg-btn insg-btn-outline insg-btn-sm">Modifier</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center; color: #64748b; padding: 1.5rem;">Aucun article publié.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Derniers messages reçus -->
        <div class="insg-card" style="grid-column: 1 / -1;">
            <div class="insg-card-header">
                <h2 class="insg-card-title">Derniers Messages de Contact Reçus</h2>
                <a href="{{ route('admin.messages.index') }}" class="insg-btn insg-btn-outline insg-btn-sm">Voir tous les messages</a>
            </div>
            <div class="insg-table-wrapper">
                <table class="insg-table">
                    <thead>
                        <tr>
                            <th>Expéditeur</th>
                            <th>Email</th>
                            <th>Objet</th>
                            <th>Date de réception</th>
                            <th>Statut</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestMessages as $msg)
                            <tr style="{{ !$msg->is_read ? 'background-color: #f0f9ff; font-weight: 600;' : '' }}">
                                <td>{{ $msg->name }}</td>
                                <td><a href="mailto:{{ $msg->email }}" style="color: var(--admin-accent); text-decoration: none;">{{ $msg->email }}</a></td>
                                <td>{{ Str::limit($msg->subject, 50) }}</td>
                                <td style="font-size: 0.85rem; color: #64748b;">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if($msg->is_read)
                                        <span class="insg-badge insg-badge-secondary">Lu</span>
                                    @else
                                        <span class="insg-badge insg-badge-warning">Non lu</span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    <a href="{{ route('admin.messages.show', $msg) }}" class="insg-btn insg-btn-outline insg-btn-sm">Consulter</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; color: #64748b; padding: 1.5rem;">Aucun message de contact pour l'instant.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

