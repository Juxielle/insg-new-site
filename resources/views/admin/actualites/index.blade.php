@extends('layouts.admin')

@section('title', 'Gestion des Actualités')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>Actualités</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">Actualités & Publications</h1>
            <p class="admin-header-desc">Ajoutez, modifiez et organisez les articles et communiqués officiels de l'INSG.</p>
        </div>
        <div>
            <a href="{{ route('admin.actualites.create') }}" class="insg-btn insg-btn-primary">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                <span>Nouvelle Actualité</span>
            </a>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="insg-card" style="margin-bottom: 1.25rem;">
        <div class="insg-card-body" style="padding: 1rem 1.5rem;">
            <form method="GET" action="{{ route('admin.actualites.index') }}" style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 220px;">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher par titre ou extrait..." class="insg-input" />
                </div>
                <div style="min-width: 200px;">
                    <select name="category" class="insg-select">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="insg-btn insg-btn-primary insg-btn-sm">Filtrer</button>
                    @if(request('q') || request('category'))
                        <a href="{{ route('admin.actualites.index') }}" class="insg-btn insg-btn-outline insg-btn-sm" style="margin-left: 0.25rem;">Réinitialiser</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">Articles ({{ $actualites->total() }})</h2>
        </div>
        <div class="insg-table-wrapper">
            <table class="insg-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Visuel</th>
                        <th>Titre de l'actualité</th>
                        <th>Catégorie</th>
                        <th style="text-align: center;">Date de publication</th>
                        <th style="text-align: center;">À la une</th>
                        <th style="text-align: right; width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($actualites as $actu)
                        <tr>
                            <td>
                                <img src="{{ $actu->image_url }}" alt="" class="insg-table-thumb" />
                            </td>
                            <td>
                                <a href="{{ route('actualites.show', $actu->slug) }}" target="_blank" style="font-weight: 700; color: var(--admin-primary); text-decoration: none;">
                                    {{ $actu->title }}
                                </a>
                                <div style="font-size: 0.8rem; color: #64748b; margin-top: 0.2rem;">{{ Str::limit($actu->excerpt, 60) }}</div>
                            </td>
                            <td>
                                <span class="insg-badge insg-badge-secondary">{{ $actu->category }}</span>
                            </td>
                            <td style="text-align: center; font-size: 0.85rem; color: #64748b;">
                                {{ $actu->published_at ? $actu->published_at->format('d/m/Y') : 'Brouillon' }}
                            </td>
                            <td style="text-align: center;">
                                <form action="{{ route('admin.actualites.toggle-featured', $actu) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0;">
                                        @if($actu->is_featured)
                                            <span class="insg-badge insg-badge-accent" title="Cliquer pour retirer de la une">À la une</span>
                                        @else
                                            <span class="insg-badge insg-badge-secondary" title="Cliquer pour mettre à la une">Non</span>
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 0.35rem;">
                                    <a href="{{ route('admin.actualites.edit', $actu) }}" class="insg-btn insg-btn-outline insg-btn-sm" title="Modifier">
                                        Modifier
                                    </a>
                                    <form action="{{ route('admin.actualites.destroy', $actu) }}" method="POST" onsubmit="return confirm('Supprimer définitivement cet article ?');" style="display: inline;">
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
                                Aucune actualité trouvée.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($actualites->hasPages())
            <div style="padding: 1rem 1.5rem; border-top: 1px solid var(--admin-border);">
                {{ $actualites->links() }}
            </div>
        @endif
    </div>
@endsection

