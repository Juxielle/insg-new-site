@extends('layouts.admin')

@section('title', $actualite->exists ? 'Modifier une Actualité' : 'Nouvelle Actualité')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <a href="{{ route('admin.actualites.index') }}">Actualités</a>
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>{{ $actualite->exists ? 'Modifier' : 'Nouveau' }}</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">{{ $actualite->exists ? 'Modifier l\'Actualité' : 'Nouvelle Actualité' }}</h1>
            <p class="admin-header-desc">Rédigez et publiez un article sur le portail de l'INSG.</p>
        </div>
        <div>
            <a href="{{ route('admin.actualites.index') }}" class="insg-btn insg-btn-outline">
                &larr; Retour à la liste
            </a>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">{{ $actualite->exists ? 'Éditer : ' . $actualite->title : 'Formulaire de publication' }}</h2>
        </div>
        <div class="insg-card-body">
            <form action="{{ $actualite->exists ? route('admin.actualites.update', $actualite) : route('admin.actualites.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($actualite->exists)
                    @method('PUT')
                @endif

                <div class="insg-form-grid">
                    <div class="insg-form-group full-width">
                        <label class="insg-label" for="title">Titre de l'actualité <span class="required">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $actualite->title) }}" required class="insg-input" placeholder="Ex: Cérémonie solennelle de remise des diplômes..." />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="category">Catégorie <span class="required">*</span></label>
                        <input type="text" id="category" name="category" value="{{ old('category', $actualite->category ?? 'Vie académique') }}" required class="insg-input" placeholder="Ex: Vie académique, Admissions, Partenariat..." list="cat-suggestions" />
                        <datalist id="cat-suggestions">
                            <option value="Vie académique">
                            <option value="Admissions">
                            <option value="Partenariat">
                            <option value="Sport & Vie étudiante">
                            <option value="Insertion professionnelle">
                            <option value="Campus & Recherche">
                        </datalist>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="published_at">Date de publication</label>
                        <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at', $actualite->published_at ? $actualite->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}" class="insg-input" />
                    </div>

                    <div class="insg-form-group full-width">
                        <label class="insg-label" for="excerpt">Résumé / Chapeau court <span class="required">*</span></label>
                        <textarea id="excerpt" name="excerpt" required class="insg-textarea" style="min-height: 80px;" placeholder="Bref résumé accrocheur affiché sur la liste et les cartes...">{{ old('excerpt', $actualite->excerpt) }}</textarea>
                    </div>

                    <div class="insg-form-group full-width">
                        <label class="insg-label" for="content">Corps de l'article (Texte complet ou HTML) <span class="required">*</span></label>
                        <textarea id="content" name="content" required class="insg-textarea" style="min-height: 250px;" placeholder="Rédigez l'intégralité de l'article...">{{ old('content', $actualite->content) }}</textarea>
                        <span class="insg-help">Les balises HTML simples (&lt;p&gt;, &lt;strong&gt;, &lt;ul&gt;, etc.) sont prises en charge.</span>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="image_file">Uploader une image de couverture</label>
                        <input type="file" id="image_file" name="image_file" accept="image/*" class="insg-input" />
                        <span class="insg-help">Fichier image recommandé (JPG, PNG, WEBP).</span>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="image">OU Chemin / URL existante</label>
                        <input type="text" id="image" name="image" value="{{ old('image', $actualite->image) }}" class="insg-input" placeholder="assets/images/1759791578740.jpg.jpeg" />
                    </div>

                    @if($actualite->image)
                        <div class="insg-form-group full-width">
                            <label class="insg-label">Image actuelle :</label>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <img src="{{ $actualite->image_url }}" alt="Aperçu" style="max-height: 120px; border-radius: 6px; border: 1px solid #cbd5e1;" />
                                <span style="font-size: 0.85rem; color: #64748b;">{{ $actualite->image }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="insg-form-group">
                        <label class="insg-label" for="slug">Identifiant URL (Slug optionnel)</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $actualite->slug) }}" class="insg-input" placeholder="Laisser vide pour génération automatique" />
                    </div>

                    <div class="insg-form-group" style="display: flex; align-items: center; padding-top: 1.5rem;">
                        <label class="insg-switch-label">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $actualite->is_featured) ? 'checked' : '' }} />
                            <span>Mettre cet article à la une sur l'accueil</span>
                        </label>
                    </div>
                </div>

                <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; gap: 0.75rem;">
                    <button type="submit" class="insg-btn insg-btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ $actualite->exists ? 'Enregistrer les modifications' : 'Publier l\'actualité' }}</span>
                    </button>
                    <a href="{{ route('admin.actualites.index') }}" class="insg-btn insg-btn-outline">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection

