@extends('layouts.admin')

@section('title', 'Gestion des Partenaires')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>Partenaires</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">Partenaires & Entreprises Associées</h1>
            <p class="admin-header-desc">Administrez les entreprises, banques et institutions partenaires de l'INSG.</p>
        </div>
        <div>
            <a href="{{ route('admin.partenaires.create') }}" class="insg-btn insg-btn-primary">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                <span>Ajouter un Partenaire</span>
            </a>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">Partenaires Officiels ({{ $partenaires->count() }})</h2>
        </div>
        <div class="insg-table-wrapper">
            <table class="insg-table">
                <thead>
                    <tr>
                        <th style="width: 100px;">Logo</th>
                        <th>Raison sociale / Entreprise</th>
                        <th>Secteur d'activité</th>
                        <th>Site internet</th>
                        <th style="width: 80px; text-align: center;">Ordre</th>
                        <th style="width: 180px; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($partenaires as $p)
                        <tr>
                            <td>
                                <img src="{{ $p->logo_url }}" alt="" style="max-height: 38px; max-width: 90px; object-fit: contain; background: #fff; padding: 2px; border: 1px solid #e2e8f0; border-radius: 4px;" />
                            </td>
                            <td>
                                <strong>{{ $p->name }}</strong>
                                @if($p->description)
                                    <div style="font-size: 0.8rem; color: #64748b; margin-top: 0.2rem;">{{ Str::limit($p->description, 50) }}</div>
                                @endif
                            </td>
                            <td>
                                <span class="insg-badge insg-badge-secondary">{{ $p->category }}</span>
                            </td>
                            <td>
                                @if($p->website_url)
                                    <a href="{{ $p->website_url }}" target="_blank" style="font-size: 0.85rem; color: var(--admin-accent); text-decoration: none;">
                                        {{ Str::limit(str_replace(['https://', 'http://'], '', $p->website_url), 25) }} &rarr;
                                    </a>
                                @else
                                    <span style="color: #94a3b8; font-size: 0.8rem;">-</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <span class="insg-badge insg-badge-secondary">#{{ $p->order }}</span>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 0.35rem;">
                                    <a href="{{ route('admin.partenaires.edit', $p) }}" class="insg-btn insg-btn-outline insg-btn-sm" title="Modifier">
                                        Modifier
                                    </a>
                                    <form action="{{ route('admin.partenaires.destroy', $p) }}" method="POST" onsubmit="return confirm('Supprimer ce partenaire ?');" style="display: inline;">
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
                                Aucun partenaire configuré.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

