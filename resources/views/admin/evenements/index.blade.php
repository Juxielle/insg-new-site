@extends('layouts.admin')

@section('title', 'Gestion des Événements')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>Événements</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">Agenda & Événements</h1>
            <p class="admin-header-desc">Planifiez les colloques, salons, remises de diplômes et manifestations de la vie universitaire.</p>
        </div>
        <div>
            <a href="{{ route('admin.evenements.create') }}" class="insg-btn insg-btn-primary">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                <span>Ajouter un Événement</span>
            </a>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">Événements ({{ $evenements->total() }})</h2>
        </div>
        <div class="insg-table-wrapper">
            <table class="insg-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Visuel</th>
                        <th>Intitulé de l'événement</th>
                        <th>Période</th>
                        <th>Lieu</th>
                        <th>Organisateur</th>
                        <th style="text-align: right; width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($evenements as $e)
                        <tr>
                            <td>
                                <img src="{{ $e->image_url }}" alt="" class="insg-table-thumb" />
                            </td>
                            <td>
                                <a href="{{ route('evenements.show', $e->slug) }}" target="_blank" style="font-weight: 700; color: var(--admin-primary); text-decoration: none;">
                                    {{ $e->title }}
                                </a>
                                <div style="font-size: 0.8rem; color: #64748b; margin-top: 0.2rem;">{{ Str::limit($e->summary, 50) }}</div>
                            </td>
                            <td>
                                <span class="insg-badge insg-badge-accent">{{ $e->formatted_period }}</span>
                            </td>
                            <td style="font-size: 0.85rem; color: #475569;">{{ $e->location }}</td>
                            <td style="font-size: 0.85rem; color: #64748b;">{{ $e->organizer ?: 'INSG' }}</td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 0.35rem;">
                                    <a href="{{ route('admin.evenements.edit', $e) }}" class="insg-btn insg-btn-outline insg-btn-sm" title="Modifier">
                                        Modifier
                                    </a>
                                    <form action="{{ route('admin.evenements.destroy', $e) }}" method="POST" onsubmit="return confirm('Supprimer cet événement ?');" style="display: inline;">
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
                                Aucun événement planifié.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($evenements->hasPages())
            <div style="padding: 1rem 1.5rem; border-top: 1px solid var(--admin-border);">
                {{ $evenements->links() }}
            </div>
        @endif
    </div>
@endsection

