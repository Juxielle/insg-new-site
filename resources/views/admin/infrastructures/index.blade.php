@extends('layouts.admin')

@section('title', 'Gestion des Infrastructures')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>Infrastructures</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">Infrastructures & Espaces Campus</h1>
            <p class="admin-header-desc">Administrez les amphithéâtres, laboratoires, bibliothèques et espaces de vie présentés sur la page Campus.</p>
        </div>
        <div>
            <a href="{{ route('admin.infrastructures.create') }}" class="insg-btn insg-btn-primary">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                <span>Ajouter une Infrastructure</span>
            </a>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">Infrastructures Répertoriées ({{ $infrastructures->count() }})</h2>
        </div>
        <div class="insg-table-wrapper">
            <table class="insg-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Visuel</th>
                        <th>Nom de l'espace</th>
                        <th>Catégorie</th>
                        <th>Capacité d'accueil</th>
                        <th>Description succincte</th>
                        <th style="width: 80px; text-align: center;">Ordre</th>
                        <th style="width: 100px; text-align: center;">Statut</th>
                        <th style="width: 180px; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($infrastructures as $infra)
                        <tr>
                            <td>
                                <img src="{{ $infra->image_url }}" alt="" class="insg-table-thumb" />
                            </td>
                            <td>
                                <strong>{{ $infra->name }}</strong>
                            </td>
                            <td>
                                <span class="insg-badge insg-badge-accent">{{ $infra->category }}</span>
                            </td>
                            <td style="font-size: 0.85rem; color: #475569;">
                                {{ $infra->capacity ?: 'N/A' }}
                            </td>
                            <td style="font-size: 0.825rem; color: #64748b;">
                                {{ Str::limit($infra->description, 50) }}
                            </td>
                            <td style="text-align: center;">
                                <span class="insg-badge insg-badge-secondary">#{{ $infra->order }}</span>
                            </td>
                            <td style="text-align: center;">
                                <form action="{{ route('admin.infrastructures.toggle', $infra) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0;">
                                        @if($infra->is_active)
                                            <span class="insg-badge insg-badge-success" title="Cliquer pour désactiver">Actif</span>
                                        @else
                                            <span class="insg-badge insg-badge-danger" title="Cliquer pour activer">Inactif</span>
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 0.35rem;">
                                    <a href="{{ route('admin.infrastructures.edit', $infra) }}" class="insg-btn insg-btn-outline insg-btn-sm" title="Modifier">
                                        Modifier
                                    </a>
                                    <form action="{{ route('admin.infrastructures.destroy', $infra) }}" method="POST" onsubmit="return confirm('Supprimer cette infrastructure ?');" style="display: inline;">
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
                            <td colspan="8" style="text-align: center; color: #64748b; padding: 2rem;">
                                Aucune infrastructure configurée.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

