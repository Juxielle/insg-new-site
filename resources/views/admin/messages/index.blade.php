@extends('layouts.admin')

@section('title', 'Boîte de Réception des Messages')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>Messages de contact</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">Messages de Contact</h1>
            <p class="admin-header-desc">Consultez les demandes d'information, admissions et messages envoyés depuis le site web.</p>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="insg-card" style="margin-bottom: 1.25rem;">
        <div class="insg-card-body" style="padding: 1rem 1.5rem;">
            <form method="GET" action="{{ route('admin.messages.index') }}" style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 260px;">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher par nom, email, objet ou mot-clé..." class="insg-input" />
                </div>
                <div>
                    <button type="submit" class="insg-btn insg-btn-primary insg-btn-sm">Rechercher</button>
                    @if(request('q'))
                        <a href="{{ route('admin.messages.index') }}" class="insg-btn insg-btn-outline insg-btn-sm" style="margin-left: 0.25rem;">Réinitialiser</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">Boîte de Réception ({{ $messages->total() }})</h2>
        </div>
        <div class="insg-table-wrapper">
            <table class="insg-table">
                <thead>
                    <tr>
                        <th style="width: 90px; text-align: center;">Statut</th>
                        <th>Expéditeur</th>
                        <th>Email & Téléphone</th>
                        <th>Objet</th>
                        <th style="width: 140px;">Date</th>
                        <th style="text-align: right; width: 160px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                        <tr style="{{ !$msg->is_read ? 'background-color: #f0fdf4; font-weight: 600;' : '' }}">
                            <td style="text-align: center;">
                                @if($msg->is_read)
                                    <span class="insg-badge insg-badge-secondary">Lu</span>
                                @else
                                    <span class="insg-badge insg-badge-warning">Nouveau</span>
                                @endif
                            </td>
                            <td>
                                <strong style="color: var(--admin-primary);">{{ $msg->name }}</strong>
                            </td>
                            <td>
                                <div><a href="mailto:{{ $msg->email }}" style="color: var(--admin-accent); text-decoration: none;">{{ $msg->email }}</a></div>
                                @if($msg->phone)
                                    <div style="font-size: 0.8rem; color: #64748b;">{{ $msg->phone }}</div>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.messages.show', $msg) }}" style="color: inherit; text-decoration: none;">
                                    {{ Str::limit($msg->subject, 60) }}
                                </a>
                            </td>
                            <td style="font-size: 0.825rem; color: #64748b;">
                                {{ $msg->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 0.35rem;">
                                    <a href="{{ route('admin.messages.show', $msg) }}" class="insg-btn insg-btn-outline insg-btn-sm" title="Lire le message">
                                        Consulter
                                    </a>
                                    <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Supprimer ce message ?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="insg-btn insg-btn-danger insg-btn-sm" title="Supprimer">
                                            &times;
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: #64748b; padding: 2.5rem;">
                                Aucun message dans la boîte de réception.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div style="padding: 1rem 1.5rem; border-top: 1px solid var(--admin-border);">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
@endsection

