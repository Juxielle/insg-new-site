@extends('layouts.admin')

@section('title', 'Gestion de la Gouvernance')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>Gouvernance</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">Équipe de Direction & Gouvernance</h1>
            <p class="admin-header-desc">Administrez les membres de la direction générale et des départements présentés sur la page À Propos.</p>
        </div>
        <div>
            <a href="{{ route('admin.gouvernances.create') }}" class="insg-btn insg-btn-primary">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                <span>Ajouter un Membre</span>
            </a>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">Membres de la Gouvernance ({{ $membres->count() }})</h2>
        </div>
        <div class="insg-table-wrapper">
            <table class="insg-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">Photo</th>
                        <th>Nom & Titre</th>
                        <th>Fonction / Rôle</th>
                        <th>Pôle / Division</th>
                        <th style="width: 80px; text-align: center;">Ordre</th>
                        <th style="width: 100px; text-align: center;">Statut</th>
                        <th style="width: 180px; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($membres as $m)
                        <tr>
                            <td>
                                <img src="{{ $m->photo_url }}" alt="" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover; border: 1px solid #cbd5e1;" />
                            </td>
                            <td>
                                <strong>{{ $m->name }}</strong>
                                @if($m->quote)
                                    <div style="font-size: 0.775rem; color: #64748b; font-style: italic;">"{{ Str::limit($m->quote, 40) }}"</div>
                                @endif
                            </td>
                            <td>
                                <span class="insg-badge insg-badge-accent">{{ $m->role }}</span>
                            </td>
                            <td style="font-size: 0.85rem; color: #475569;">
                                {{ $m->division ?: 'Direction' }}
                            </td>
                            <td style="text-align: center;">
                                <span class="insg-badge insg-badge-secondary">#{{ $m->order }}</span>
                            </td>
                            <td style="text-align: center;">
                                <form action="{{ route('admin.gouvernances.toggle', $m) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0;">
                                        @if($m->is_active)
                                            <span class="insg-badge insg-badge-success" title="Cliquer pour désactiver">Actif</span>
                                        @else
                                            <span class="insg-badge insg-badge-danger" title="Cliquer pour activer">Inactif</span>
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 0.35rem;">
                                    <a href="{{ route('admin.gouvernances.edit', $m) }}" class="insg-btn insg-btn-outline insg-btn-sm" title="Modifier">
                                        Modifier
                                    </a>
                                    <form action="{{ route('admin.gouvernances.destroy', $m) }}" method="POST" onsubmit="return confirm('Retirer ce membre de la gouvernance ?');" style="display: inline;">
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
                                Aucun membre répertorié.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

