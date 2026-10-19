@extends('layouts.admin')

@section('title', 'Détail du Message')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <a href="{{ route('admin.messages.index') }}">Messages de contact</a>
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>Détail</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">Message de {{ $message->name }}</h1>
            <p class="admin-header-desc">Reçu le {{ $message->created_at->format('d/m/Y à H:i') }}</p>
        </div>
        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('admin.messages.index') }}" class="insg-btn insg-btn-outline">
                &larr; Retour à la boîte
            </a>
            <a href="mailto:{{ $message->email }}?subject=Re: {{ rawurlencode($message->subject) }}" class="insg-btn insg-btn-primary">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span>Répondre par email</span>
            </a>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">{{ $message->subject }}</h2>
            <div style="display: flex; gap: 0.5rem; align-items: center;">
                <form action="{{ route('admin.messages.toggle-read', $message) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="insg-btn insg-btn-outline insg-btn-sm">
                        {{ $message->is_read ? 'Marquer comme non lu' : 'Marquer comme lu' }}
                    </button>
                </form>

                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Supprimer définitivement ce message ?');" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="insg-btn insg-btn-danger insg-btn-sm">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
        <div class="insg-card-body">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; background: #f8fafc; padding: 1.25rem; border-radius: 6px; margin-bottom: 1.5rem; border: 1px solid #e2e8f0;">
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: #64748b; font-weight: 700; display: block;">Expéditeur</span>
                    <strong style="font-size: 1rem; color: #1e293b;">{{ $message->name }}</strong>
                </div>
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: #64748b; font-weight: 700; display: block;">Email</span>
                    <a href="mailto:{{ $message->email }}" style="color: var(--admin-accent); font-weight: 600;">{{ $message->email }}</a>
                </div>
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: #64748b; font-weight: 700; display: block;">Téléphone</span>
                    <span style="color: #1e293b;">{{ $message->phone ?: 'Non renseigné' }}</span>
                </div>
                <div>
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: #64748b; font-weight: 700; display: block;">Date d'envoi</span>
                    <span style="color: #1e293b;">{{ $message->created_at->translatedFormat('d F Y à H:i') }}</span>
                </div>
            </div>

            <div style="font-size: 0.95rem; line-height: 1.7; color: #1e293b; background: #ffffff; padding: 1.5rem; border-radius: 6px; border: 1px solid #cbd5e1; white-space: pre-wrap;">{{ $message->message }}</div>
        </div>
    </div>
@endsection

