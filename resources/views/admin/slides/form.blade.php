@extends('layouts.admin')

@section('title', $slide->exists ? 'Modifier un Slide' : 'Ajouter un Slide')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <a href="{{ route('admin.slides.index') }}">Carrousel Accueil</a>
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>{{ $slide->exists ? 'Modifier' : 'Nouveau' }}</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">{{ $slide->exists ? 'Modifier le Slide' : 'Ajouter un Slide' }}</h1>
            <p class="admin-header-desc">Complétez les informations pour mettre à jour la diapositive d'accueil.</p>
        </div>
        <div>
            <a href="{{ route('admin.slides.index') }}" class="insg-btn insg-btn-outline">
                &larr; Retour à la liste
            </a>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">{{ $slide->exists ? 'Éditer : ' . $slide->title : 'Informations du nouveau slide' }}</h2>
        </div>
        <div class="insg-card-body">
            <form action="{{ $slide->exists ? route('admin.slides.update', $slide) : route('admin.slides.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($slide->exists)
                    @method('PUT')
                @endif

                <div class="insg-form-grid">
                    <div class="insg-form-group full-width">
                        <label class="insg-label" for="title">Titre principal du slide <span class="required">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $slide->title) }}" required class="insg-input" placeholder="Ex: Excellence académique & Management" />
                        <span class="insg-help">Titre accrocheur affiché en grand sur la bannière d'accueil.</span>
                    </div>

                    <div class="insg-form-group full-width">
                        <label class="insg-label" for="subtitle">Sous-titre / Message d'accompagnement</label>
                        <textarea id="subtitle" name="subtitle" class="insg-textarea" style="min-height: 80px;" placeholder="Ex: L'établissement de référence en sciences de gestion au Gabon...">{{ old('subtitle', $slide->subtitle) }}</textarea>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="image_file">Uploader une nouvelle image (Fichier)</label>
                        <input type="file" id="image_file" name="image_file" accept="image/*" class="insg-input" />
                        <span class="insg-help">Format recommandé : JPG, PNG, WEBP (1920x800px).</span>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="image">OU Chemin / URL d'une image existante</label>
                        <input type="text" id="image" name="image" value="{{ old('image', $slide->image) }}" class="insg-input" placeholder="assets/images/insg-back-1.jpeg" />
                        <span class="insg-help">Chemin relatif (ex: assets/images/...) ou URL externe.</span>
                    </div>

                    @if($slide->image)
                        <div class="insg-form-group full-width">
                            <label class="insg-label">Image actuelle :</label>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <img src="{{ $slide->image_url }}" alt="Aperçu" style="max-height: 120px; border-radius: 6px; border: 1px solid #cbd5e1; box-shadow: 0 2px 4px rgba(0,0,0,0.1);" />
                                <span style="font-size: 0.85rem; color: #64748b;">{{ $slide->image }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="insg-form-group">
                        <label class="insg-label" for="link_url">Lien du bouton d'action</label>
                        <input type="text" id="link_url" name="link_url" value="{{ old('link_url', $slide->link_url) }}" class="insg-input" placeholder="/formations ou https://..." />
                        <span class="insg-help">Lien de destination lors du clic sur le bouton.</span>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="link_text">Intitulé du bouton d'action</label>
                        <input type="text" id="link_text" name="link_text" value="{{ old('link_text', $slide->link_text) }}" class="insg-input" placeholder="Ex: Découvrir nos formations" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="order">Ordre d'affichage <span class="required">*</span></label>
                        <input type="number" id="order" name="order" value="{{ old('order', $slide->order ?? 1) }}" required min="0" class="insg-input" />
                        <span class="insg-help">Les slides sont ordonnés du plus petit au plus grand (1, 2, 3...).</span>
                    </div>

                    <div class="insg-form-group" style="display: flex; align-items: center; padding-top: 1.5rem;">
                        <label class="insg-switch-label">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $slide->is_active ?? true) ? 'checked' : '' }} />
                            <span>Afficher ce slide sur la page d'accueil (Actif)</span>
                        </label>
                    </div>
                </div>

                <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; gap: 0.75rem;">
                    <button type="submit" class="insg-btn insg-btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ $slide->exists ? 'Enregistrer les modifications' : 'Créer le slide' }}</span>
                    </button>
                    <a href="{{ route('admin.slides.index') }}" class="insg-btn insg-btn-outline">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection

