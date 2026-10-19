@extends('layouts.admin')

@section('title', 'Gestion des Témoignages')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>Témoignages</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">Témoignages & Avis Alumni</h1>
            <p class="admin-header-desc">Gérez les retours d'expérience et témoignages d'anciens diplômés et partenaires de l'INSG.</p>
        </div>
        <div>
            <a href="{{ route('admin.temoignages.create') }}" class="insg-btn insg-btn-primary">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                <span>Ajouter un Témoignage</span>
            </a>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">Témoignages ({{ $temoignages->count() }})</h2>
        </div>
        <div class="insg-table-wrapper">
            <table class="insg-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">Photo</th>
                        <th>Nom & Prénom</th>
                        <th>Poste / Rôle & Promotion</th>
                        <th>Contenu de l'avis</th>
                        <th style="width: 80px; text-align: center;">Note</th>
                        <th style="width: 100px; text-align: center;">À la une</th>
                        <th style="width: 180px; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($temoignages as $t)
                        <tr>
                            <td>
                                <img src="{{ $t->avatar_url }}" alt="" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover; border: 1px solid #cbd5e1;" />
                            </td>
                            <td>
                                <strong>{{ $t->name }}</strong>
                            </td>
                            <td>
                                <div style="font-size: 0.85rem; color: #1e293b;">{{ $t->role }}</div>
                                @if($t->promotion)
                                    <span class="insg-badge insg-badge-secondary" style="margin-top: 0.2rem;">{{ $t->promotion }}</span>
                                @endif
                            </td>
                            <td style="font-size: 0.85rem; color: #475569;">
                                <em>"{{ Str::limit($t->content, 80) }}"</em>
                            </td>
                            <td style="text-align: center;">
                                <span style="color: #f59e0b; font-weight: bold;">{{ str_repeat('★', $t->rating) }}</span>
                            </td>
                            <td style="text-align: center;">
                                <form action="{{ route('admin.temoignages.toggle-featured', $t) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0;">
                                        @if($t->is_featured)
                                            <span class="insg-badge insg-badge-accent" title="Cliquer pour retirer de la une">À la une</span>
                                        @else
                                            <span class="insg-badge insg-badge-secondary" title="Cliquer pour mettre à la une">Non</span>
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 0.35rem;">
                                    <a href="{{ route('admin.temoignages.edit', $t) }}" class="insg-btn insg-btn-outline insg-btn-sm" title="Modifier">
                                        Modifier
                                    </a>
                                    <form action="{{ route('admin.temoignages.destroy', $t) }}" method="POST" onsubmit="return confirm('Supprimer ce témoignage ?');" style="display: inline;">
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
                                Aucun témoignage enregistré.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

