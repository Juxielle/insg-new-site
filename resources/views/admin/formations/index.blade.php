@extends('layouts.admin')

@section('title', 'Gestion des Formations')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>Formations</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">Offres de Formation</h1>
            <p class="admin-header-desc">Administrez les cursus académiques de l'INSG (BTS, Licences Professionnelles, Masters Professionnels).</p>
        </div>
        <div>
            <a href="{{ route('admin.formations.create') }}" class="insg-btn insg-btn-primary">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                <span>Ajouter une Formation</span>
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="insg-card" style="margin-bottom: 1.25rem;">
        <div class="insg-card-body" style="padding: 1rem 1.5rem;">
            <form method="GET" action="{{ route('admin.formations.index') }}" style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 220px;">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher par filière ou département..." class="insg-input" />
                </div>
                <div style="min-width: 180px;">
                    <select name="level" class="insg-select">
                        <option value="">Tous les niveaux</option>
                        @foreach($levels as $lvl)
                            <option value="{{ $lvl }}" {{ request('level') == $lvl ? 'selected' : '' }}>{{ $lvl }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="insg-btn insg-btn-primary insg-btn-sm">Filtrer</button>
                    @if(request('q') || request('level'))
                        <a href="{{ route('admin.formations.index') }}" class="insg-btn insg-btn-outline insg-btn-sm" style="margin-left: 0.25rem;">Réinitialiser</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">Formations Répertoriées ({{ $formations->total() }})</h2>
        </div>
        <div class="insg-table-wrapper">
            <table class="insg-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Visuel</th>
                        <th>Intitulé du programme</th>
                        <th>Niveau</th>
                        <th>Département</th>
                        <th>Durée</th>
                        <th style="text-align: center;">Statut</th>
                        <th style="text-align: right; width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($formations as $f)
                        <tr>
                            <td>
                                <img src="{{ $f->image_url }}" alt="" class="insg-table-thumb" />
                            </td>
                            <td>
                                <a href="{{ route('formations.show', $f->slug) }}" target="_blank" style="font-weight: 700; color: var(--admin-primary); text-decoration: none;">
                                    {{ $f->title }}
                                </a>
                                <div style="font-size: 0.8rem; color: #64748b; margin-top: 0.2rem;">{{ Str::limit($f->summary, 50) }}</div>
                            </td>
                            <td><span class="insg-badge insg-badge-accent">{{ $f->level }}</span></td>
                            <td style="font-size: 0.85rem; color: #475569;">{{ $f->department }}</td>
                            <td style="font-size: 0.85rem; color: #64748b;">{{ $f->duration }}</td>
                            <td style="text-align: center;">
                                <form action="{{ route('admin.formations.toggle', $f) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0;">
                                        @if($f->is_active)
                                            <span class="insg-badge insg-badge-success" title="Cliquer pour désactiver">Actif</span>
                                        @else
                                            <span class="insg-badge insg-badge-danger" title="Cliquer pour activer">Inactif</span>
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 0.35rem;">
                                    <a href="{{ route('admin.formations.edit', $f) }}" class="insg-btn insg-btn-outline insg-btn-sm" title="Modifier">
                                        Modifier
                                    </a>
                                    <form action="{{ route('admin.formations.destroy', $f) }}" method="POST" onsubmit="return confirm('Supprimer cette formation ?');" style="display: inline;">
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
                                Aucune formation trouvée.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($formations->hasPages())
            <div style="padding: 1rem 1.5rem; border-top: 1px solid var(--admin-border);">
                {{ $formations->links() }}
            </div>
        @endif
    </div>
@endsection

