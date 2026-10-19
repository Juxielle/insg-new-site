@extends('layouts.admin')

@section('title', $infrastructure->exists ? 'Modifier une Infrastructure' : 'Nouvelle Infrastructure')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <a href="{{ route('admin.infrastructures.index') }}">Infrastructures</a>
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>{{ $infrastructure->exists ? 'Modifier' : 'Nouvelle' }}</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">{{ $infrastructure->exists ? 'Modifier l\'Infrastructure' : 'Nouvelle Infrastructure' }}</h1>
            <p class="admin-header-desc">Présentez les équipements, capacités et atouts de l'infrastructure.</p>
        </div>
        <div>
            <a href="{{ route('admin.infrastructures.index') }}" class="insg-btn insg-btn-outline">
                &larr; Retour à la liste
            </a>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">{{ $infrastructure->exists ? 'Éditer : ' . $infrastructure->name : 'Nouvel aménagement de campus' }}</h2>
        </div>
        <div class="insg-card-body">
            <form action="{{ $infrastructure->exists ? route('admin.infrastructures.update', $infrastructure) : route('admin.infrastructures.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($infrastructure->exists)
                    @method('PUT')
                @endif

                <div class="insg-form-grid">
                    <div class="insg-form-group">
                        <label class="insg-label" for="name">Désignation du bâtiment ou de la salle <span class="required">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $infrastructure->name) }}" required class="insg-input" placeholder="Ex: Amphithéâtres connectés & Salles de cours" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="category">Catégorie d'infrastructure <span class="required">*</span></label>
                        <input type="text" id="category" name="category" value="{{ old('category', $infrastructure->category ?? 'Pédagogique') }}" required class="insg-input" placeholder="Ex: Pédagogique, Recherche, Numérique, Vie Étudiante..." list="infra-cat-suggestions" />
                        <datalist id="infra-cat-suggestions">
                            <option value="Pédagogique">
                            <option value="Documentation & Recherche">
                            <option value="Informatique & Numérique">
                            <option value="Entrepreneuriat & Innovation">
                            <option value="Vie de Campus & Sport">
                        </datalist>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="capacity">Capacité d'accueil</label>
                        <input type="text" id="capacity" name="capacity" value="{{ old('capacity', $infrastructure->capacity) }}" class="insg-input" placeholder="Ex: 3 amphithéâtres de 350 places chacun" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="order">Ordre d'affichage <span class="required">*</span></label>
                        <input type="number" id="order" name="order" value="{{ old('order', $infrastructure->order ?? 1) }}" required min="0" class="insg-input" />
                    </div>

                    <div class="insg-form-group full-width">
                        <label class="insg-label" for="description">Description des équipements et services <span class="required">*</span></label>
                        <textarea id="description" name="description" required class="insg-textarea" style="min-height: 120px;" placeholder="Équipements audiovisuels, climatisation, connexion wifi, usage pédagogique...">{{ old('description', $infrastructure->description) }}</textarea>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="image_file">Photo de l'espace (Fichier)</label>
                        <input type="file" id="image_file" name="image_file" accept="image/*" class="insg-input" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="image">OU Chemin existant</label>
                        <input type="text" id="image" name="image" value="{{ old('image', $infrastructure->image) }}" class="insg-input" placeholder="assets/images/insg-back-4.jpeg" />
                    </div>

                    @if($infrastructure->image)
                        <div class="insg-form-group full-width">
                            <label class="insg-label">Photo actuelle :</label>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <img src="{{ $infrastructure->image_url }}" alt="Aperçu" style="max-height: 120px; border-radius: 6px; border: 1px solid #cbd5e1;" />
                                <span style="font-size: 0.85rem; color: #64748b;">{{ $infrastructure->image }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="insg-form-group">
                        <label class="insg-label" for="slug">Identifiant URL (Slug optionnel)</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $infrastructure->slug) }}" class="insg-input" placeholder="Laisser vide pour génération automatique" />
                    </div>

                    <div class="insg-form-group" style="display: flex; align-items: center; padding-top: 1.5rem;">
                        <label class="insg-switch-label">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $infrastructure->is_active ?? true) ? 'checked' : '' }} />
                            <span>Infrastructure active et visible sur le site</span>
                        </label>
                    </div>
                </div>

                <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; gap: 0.75rem;">
                    <button type="submit" class="insg-btn insg-btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ $infrastructure->exists ? 'Enregistrer les modifications' : 'Ajouter l\'infrastructure' }}</span>
                    </button>
                    <a href="{{ route('admin.infrastructures.index') }}" class="insg-btn insg-btn-outline">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection

