@extends('layouts.admin')

@section('title', $partenaire->exists ? 'Modifier un Partenaire' : 'Nouveau Partenaire')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <a href="{{ route('admin.partenaires.index') }}">Partenaires</a>
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>{{ $partenaire->exists ? 'Modifier' : 'Nouveau' }}</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">{{ $partenaire->exists ? 'Modifier le Partenaire' : 'Nouveau Partenaire' }}</h1>
            <p class="admin-header-desc">Renseignez la fiche entreprise, le logo et les liens institutionnels.</p>
        </div>
        <div>
            <a href="{{ route('admin.partenaires.index') }}" class="insg-btn insg-btn-outline">
                &larr; Retour à la liste
            </a>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">{{ $partenaire->exists ? 'Éditer : ' . $partenaire->name : 'Nouveau partenariat' }}</h2>
        </div>
        <div class="insg-card-body">
            <form action="{{ $partenaire->exists ? route('admin.partenaires.update', $partenaire) : route('admin.partenaires.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($partenaire->exists)
                    @method('PUT')
                @endif

                <div class="insg-form-grid">
                    <div class="insg-form-group">
                        <label class="insg-label" for="name">Nom de l'entreprise ou organisme <span class="required">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $partenaire->name) }}" required class="insg-input" placeholder="Ex: BGFI Bank, TotalEnergies, CNSS Gabon..." />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="category">Secteur / Domaine d'activité <span class="required">*</span></label>
                        <input type="text" id="category" name="category" value="{{ old('category', $partenaire->category ?? 'Bancaire & Finance') }}" required class="insg-input" placeholder="Ex: Bancaire & Finance, Télécommunications, Énergie..." list="part-cat-suggestions" />
                        <datalist id="part-cat-suggestions">
                            <option value="Bancaire & Finance">
                            <option value="Institutionnel & Prévoyance">
                            <option value="Télécommunications & Numérique">
                            <option value="Énergie & Industrie">
                            <option value="Transport & Logistique">
                            <option value="Audit & Conseil">
                        </datalist>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="website_url">Site internet officiel</label>
                        <input type="url" id="website_url" name="website_url" value="{{ old('website_url', $partenaire->website_url) }}" class="insg-input" placeholder="https://www.entreprise.com" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="order">Ordre d'affichage <span class="required">*</span></label>
                        <input type="number" id="order" name="order" value="{{ old('order', $partenaire->order ?? 1) }}" required min="0" class="insg-input" />
                    </div>

                    <div class="insg-form-group full-width">
                        <label class="insg-label" for="description">Description du partenariat / Actions conjointes</label>
                        <textarea id="description" name="description" class="insg-textarea" style="min-height: 80px;" placeholder="Ex: Accueil de stagiaires, bourses d'excellence, parrainage de promotions...">{{ old('description', $partenaire->description) }}</textarea>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="logo_file">Logo de l'entreprise (Fichier)</label>
                        <input type="file" id="logo_file" name="logo_file" accept="image/*" class="insg-input" />
                        <span class="insg-help">Format PNG avec fond transparent de préférence.</span>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="logo">OU Chemin du logo existant</label>
                        <input type="text" id="logo" name="logo" value="{{ old('logo', $partenaire->logo) }}" class="insg-input" placeholder="assets/images/partners/bgfi.png" />
                    </div>

                    @if($partenaire->logo)
                        <div class="insg-form-group full-width">
                            <label class="insg-label">Logo actuel :</label>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <img src="{{ $partenaire->logo_url }}" alt="Aperçu" style="max-height: 50px; background: #fff; padding: 4px; border-radius: 4px; border: 1px solid #cbd5e1;" />
                                <span style="font-size: 0.85rem; color: #64748b;">{{ $partenaire->logo }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="insg-form-group">
                        <label class="insg-label" for="slug">Identifiant URL (Slug optionnel)</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $partenaire->slug) }}" class="insg-input" placeholder="Laisser vide pour génération automatique" />
                    </div>
                </div>

                <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; gap: 0.75rem;">
                    <button type="submit" class="insg-btn insg-btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ $partenaire->exists ? 'Enregistrer les modifications' : 'Ajouter le partenaire' }}</span>
                    </button>
                    <a href="{{ route('admin.partenaires.index') }}" class="insg-btn insg-btn-outline">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection

