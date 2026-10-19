@extends('layouts.admin')

@section('title', $statistique->exists ? 'Modifier une Statistique' : 'Nouvelle Statistique')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <a href="{{ route('admin.statistiques.index') }}">Chiffres Clés</a>
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>{{ $statistique->exists ? 'Modifier' : 'Nouvelle' }}</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">{{ $statistique->exists ? 'Modifier la Statistique' : 'Nouvelle Statistique' }}</h1>
            <p class="admin-header-desc">Renseignez la valeur chiffrée et son libellé explicatif.</p>
        </div>
        <div>
            <a href="{{ route('admin.statistiques.index') }}" class="insg-btn insg-btn-outline">
                &larr; Retour à la liste
            </a>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">{{ $statistique->exists ? 'Éditer : ' . $statistique->label : 'Nouvel indicateur' }}</h2>
        </div>
        <div class="insg-card-body">
            <form action="{{ $statistique->exists ? route('admin.statistiques.update', $statistique) : route('admin.statistiques.store') }}" method="POST">
                @csrf
                @if($statistique->exists)
                    @method('PUT')
                @endif

                <div class="insg-form-grid">
                    <div class="insg-form-group">
                        <label class="insg-label" for="value">Valeur chiffrée <span class="required">*</span></label>
                        <input type="text" id="value" name="value" value="{{ old('value', $statistique->value) }}" required class="insg-input" placeholder="Ex: 3 200+, 92%, 40+, 8..." />
                        <span class="insg-help">Le grand nombre ou pourcentage mis en avant.</span>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="label">Libellé / Titre de l'indicateur <span class="required">*</span></label>
                        <input type="text" id="label" name="label" value="{{ old('label', $statistique->label) }}" required class="insg-input" placeholder="Ex: Étudiants formés chaque année" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="key">Clé unique système <span class="required">*</span></label>
                        <input type="text" id="key" name="key" value="{{ old('key', $statistique->key) }}" required class="insg-input" placeholder="Ex: etudiants, insertion_pro, enseignants..." />
                        <span class="insg-help">Identifiant sans espaces utilisé par les templates.</span>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="order">Ordre d'affichage <span class="required">*</span></label>
                        <input type="number" id="order" name="order" value="{{ old('order', $statistique->order ?? 1) }}" required min="0" class="insg-input" />
                    </div>

                    <div class="insg-form-group full-width">
                        <label class="insg-label" for="description">Description contextuelle complémentaire</label>
                        <textarea id="description" name="description" class="insg-textarea" style="min-height: 80px;" placeholder="Ex: Taux moyen d'embauche de nos diplômés dans les 6 mois...">{{ old('description', $statistique->description) }}</textarea>
                    </div>

                    <div class="insg-form-group full-width" style="padding-top: 1rem;">
                        <label class="insg-switch-label">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $statistique->is_active ?? true) ? 'checked' : '' }} />
                            <span>Indicateur actif et affiché sur le front-end</span>
                        </label>
                    </div>
                </div>

                <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; gap: 0.75rem;">
                    <button type="submit" class="insg-btn insg-btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ $statistique->exists ? 'Enregistrer les modifications' : 'Créer la statistique' }}</span>
                    </button>
                    <a href="{{ route('admin.statistiques.index') }}" class="insg-btn insg-btn-outline">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection

