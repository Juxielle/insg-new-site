@extends('layouts.admin')

@section('title', 'Gestion du Carrousel Accueil')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>Carrousel Accueil</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">Carrousel Accueil (Slides)</h1>
            <p class="admin-header-desc">Gérez les grandes diapositives hero affichées sur la page d'accueil de l'INSG.</p>
        </div>
        <div>
            <a href="{{ route('admin.slides.create') }}" class="insg-btn insg-btn-primary">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                <span>Ajouter un Slide</span>
            </a>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">Liste des Slides ({{ $slides->count() }})</h2>
        </div>
        <div class="insg-table-wrapper">
            <table class="insg-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Aperçu</th>
                        <th>Titre & Sous-titre</th>
                        <th>Bouton d'action</th>
                        <th style="width: 80px; text-align: center;">Ordre</th>
                        <th style="width: 100px; text-align: center;">Statut</th>
                        <th style="width: 200px; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slides as $slide)
                        <tr>
                            <td>
                                <img src="{{ $slide->image_url }}" alt="" class="insg-table-thumb" />
                            </td>
                            <td>
                                <strong>{{ $slide->title }}</strong>
                                @if($slide->subtitle)
                                    <div style="font-size: 0.825rem; color: #64748b; margin-top: 0.2rem;">{{ $slide->subtitle }}</div>
                                @endif
                            </td>
                            <td>
                                @if($slide->link_url)
                                    <a href="{{ $slide->link_url }}" target="_blank" style="font-size: 0.85rem; color: var(--admin-accent); text-decoration: none;">
                                        {{ $slide->link_text ?: 'En savoir plus' }} &rarr;
                                    </a>
                                @else
                                    <span style="color: #94a3b8; font-size: 0.8rem;">Aucun</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <span class="insg-badge insg-badge-secondary">#{{ $slide->order }}</span>
                            </td>
                            <td style="text-align: center;">
                                <form action="{{ route('admin.slides.toggle', $slide) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0;">
                                        @if($slide->is_active)
                                            <span class="insg-badge insg-badge-success" title="Cliquer pour désactiver">Actif</span>
                                        @else
                                            <span class="insg-badge insg-badge-danger" title="Cliquer pour activer">Inactif</span>
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 0.35rem;">
                                    <a href="{{ route('admin.slides.edit', $slide) }}" class="insg-btn insg-btn-outline insg-btn-sm" title="Modifier">
                                        Modifier
                                    </a>
                                    <form action="{{ route('admin.slides.destroy', $slide) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce slide ?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="insg-btn insg-btn-danger insg-btn-sm" title="Supprimer">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: #64748b; padding: 2rem;">
                                Aucun slide configuré pour le moment.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

