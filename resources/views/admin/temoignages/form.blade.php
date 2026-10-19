@extends('layouts.admin')

@section('title', $temoignage->exists ? 'Modifier un Témoignage' : 'Nouveau Témoignage')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <a href="{{ route('admin.temoignages.index') }}">Témoignages</a>
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>{{ $temoignage->exists ? 'Modifier' : 'Nouveau' }}</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">{{ $temoignage->exists ? 'Modifier le Témoignage' : 'Nouveau Témoignage' }}</h1>
            <p class="admin-header-desc">Saisissez le parcours et la citation du diplômé ou partenaire.</p>
        </div>
        <div>
            <a href="{{ route('admin.temoignages.index') }}" class="insg-btn insg-btn-outline">
                &larr; Retour à la liste
            </a>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">{{ $temoignage->exists ? 'Éditer : ' . $temoignage->name : 'Nouveau retour d\'expérience' }}</h2>
        </div>
        <div class="insg-card-body">
            <form action="{{ $temoignage->exists ? route('admin.temoignages.update', $temoignage) : route('admin.temoignages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($temoignage->exists)
                    @method('PUT')
                @endif

                <div class="insg-form-grid">
                    <div class="insg-form-group">
                        <label class="insg-label" for="name">Nom & Prénom de l'intervenant <span class="required">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $temoignage->name) }}" required class="insg-input" placeholder="Ex: Marc Kevin OBIANG" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="role">Poste / Fonction actuelle en entreprise <span class="required">*</span></label>
                        <input type="text" id="role" name="role" value="{{ old('role', $temoignage->role) }}" required class="insg-input" placeholder="Ex: Directeur Financier Adjoint - BGFIBank Gabon" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="promotion">Promotion / Filière d'origine</label>
                        <input type="text" id="promotion" name="promotion" value="{{ old('promotion', $temoignage->promotion) }}" class="insg-input" placeholder="Ex: Promotion Master Audit 2021" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="rating">Note attribuée (Étoiles) <span class="required">*</span></label>
                        <select id="rating" name="rating" required class="insg-select">
                            <option value="5" {{ old('rating', $temoignage->rating ?? 5) == 5 ? 'selected' : '' }}>5 étoiles (★★★★★ - Exceptionnel)</option>
                            <option value="4" {{ old('rating', $temoignage->rating) == 4 ? 'selected' : '' }}>4 étoiles (★★★★☆ - Très bien)</option>
                            <option value="3" {{ old('rating', $temoignage->rating) == 3 ? 'selected' : '' }}>3 étoiles (★★★☆☆ - Bien)</option>
                        </select>
                    </div>

                    <div class="insg-form-group full-width">
                        <label class="insg-label" for="content">Texte du témoignage <span class="required">*</span></label>
                        <textarea id="content" name="content" required class="insg-textarea" style="min-height: 120px;" placeholder="Ex: Mon passage à l'INSG a été le tremplin de ma carrière professionnelle. La rigueur des enseignants et le réseau ont fait la différence...">{{ old('content', $temoignage->content) }}</textarea>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="avatar_file">Photo de profil (Fichier)</label>
                        <input type="file" id="avatar_file" name="avatar_file" accept="image/*" class="insg-input" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="avatar">OU Chemin de l'avatar existant</label>
                        <input type="text" id="avatar" name="avatar" value="{{ old('avatar', $temoignage->avatar) }}" class="insg-input" placeholder="assets/images/directeur-1.png" />
                    </div>

                    @if($temoignage->avatar)
                        <div class="insg-form-group full-width">
                            <label class="insg-label">Photo actuelle :</label>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <img src="{{ $temoignage->avatar_url }}" alt="Aperçu" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 1px solid #cbd5e1;" />
                                <span style="font-size: 0.85rem; color: #64748b;">{{ $temoignage->avatar }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="insg-form-group">
                        <label class="insg-label" for="order">Ordre d'affichage <span class="required">*</span></label>
                        <input type="number" id="order" name="order" value="{{ old('order', $temoignage->order ?? 1) }}" required min="0" class="insg-input" />
                    </div>

                    <div class="insg-form-group" style="display: flex; align-items: center; padding-top: 1.5rem;">
                        <label class="insg-switch-label">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $temoignage->is_featured ?? true) ? 'checked' : '' }} />
                            <span>Mettre ce témoignage en avant sur la page d'accueil</span>
                        </label>
                    </div>
                </div>

                <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; gap: 0.75rem;">
                    <button type="submit" class="insg-btn insg-btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ $temoignage->exists ? 'Enregistrer les modifications' : 'Ajouter le témoignage' }}</span>
                    </button>
                    <a href="{{ route('admin.temoignages.index') }}" class="insg-btn insg-btn-outline">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection

