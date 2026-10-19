@extends('layouts.admin')

@section('title', 'Gestion des Chiffres Clés')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>Chiffres Clés</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">Chiffres Clés & Statistiques</h1>
            <p class="admin-header-desc">Modifiez les indicateurs d'impact affichés sur la page d'accueil et la page À Propos.</p>
        </div>
        <div>
            <a href="{{ route('admin.statistiques.create') }}" class="insg-btn insg-btn-primary">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                <span>Ajouter une Statistique</span>
            </a>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">Indicateurs institutionnels ({{ $statistiques->count() }})</h2>
        </div>
        <div class="insg-table-wrapper">
            <table class="insg-table">
                <thead>
                    <tr>
                        <th style="width: 120px;">Valeur affichée</th>
                        <th>Intitulé / Label</th>
                        <th>Identifiant (Clé)</th>
                        <th>Description contextuelle</th>
                        <th style="width: 80px; text-align: center;">Ordre</th>
                        <th style="width: 100px; text-align: center;">Statut</th>
                        <th style="width: 180px; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($statistiques as $s)
                        <tr>
                            <td>
                                <strong style="font-size: 1.25rem; color: var(--admin-primary);">{{ $s->value }}</strong>
                            </td>
                            <td>
                                <strong>{{ $s->label }}</strong>
                            </td>
                            <td>
                                <code>{{ $s->key }}</code>
                            </td>
                            <td style="font-size: 0.85rem; color: #64748b;">
                                {{ $s->description ?: '-' }}
                            </td>
                            <td style="text-align: center;">
                                <span class="insg-badge insg-badge-secondary">#{{ $s->order }}</span>
                            </td>
                            <td style="text-align: center;">
                                <form action="{{ route('admin.statistiques.toggle', $s) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0;">
                                        @if($s->is_active)
                                            <span class="insg-badge insg-badge-success" title="Cliquer pour désactiver">Actif</span>
                                        @else
                                            <span class="insg-badge insg-badge-danger" title="Cliquer pour activer">Inactif</span>
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 0.35rem;">
                                    <a href="{{ route('admin.statistiques.edit', $s) }}" class="insg-btn insg-btn-outline insg-btn-sm" title="Modifier">
                                        Modifier
                                    </a>
                                    <form action="{{ route('admin.statistiques.destroy', $s) }}" method="POST" onsubmit="return confirm('Supprimer cette statistique ?');" style="display: inline;">
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
                            <td colspan="7" style="text-align: center; color: #64748b; padding: 2rem;">
                                Aucune statistique configurée.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

