@extends('layouts.admin')

@section('title', $membre->exists ? 'Modifier un Membre' : 'Nouveau Membre de la Gouvernance')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <a href="{{ route('admin.gouvernances.index') }}">Gouvernance</a>
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>{{ $membre->exists ? 'Modifier' : 'Nouveau' }}</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">{{ $membre->exists ? 'Modifier le Membre' : 'Nouveau Membre de la Gouvernance' }}</h1>
            <p class="admin-header-desc">Renseignez l'identité, le poste et la biographie ou citation du responsable.</p>
        </div>
        <div>
            <a href="{{ route('admin.gouvernances.index') }}" class="insg-btn insg-btn-outline">
                &larr; Retour à la liste
            </a>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">{{ $membre->exists ? 'Éditer : ' . $membre->name : 'Fiche du responsable' }}</h2>
        </div>
        <div class="insg-card-body">
            <form action="{{ $membre->exists ? route('admin.gouvernances.update', $membre) : route('admin.gouvernances.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($membre->exists)
                    @method('PUT')
                @endif

                <div class="insg-form-grid">
                    <div class="insg-form-group">
                        <label class="insg-label" for="name">Nom complet & Titre académique <span class="required">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $membre->name) }}" required class="insg-input" placeholder="Ex: Pr. Murielle Natacha M'BOUNA" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="role">Fonction administrative / Rôle <span class="required">*</span></label>
                        <input type="text" id="role" name="role" value="{{ old('role', $membre->role) }}" required class="insg-input" placeholder="Ex: Directrice Générale, Secrétaire Général..." />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="division">Direction ou Pôle</label>
                        <input type="text" id="division" name="division" value="{{ old('division', $membre->division) }}" class="insg-input" placeholder="Ex: Direction Générale, Direction Académique, Secrétariat Général..." />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="order">Ordre d'apparition <span class="required">*</span></label>
                        <input type="number" id="order" name="order" value="{{ old('order', $membre->order ?? 1) }}" required min="0" class="insg-input" />
                    </div>

                    <div class="insg-form-group full-width">
                        <label class="insg-label" for="quote">Citation / Mot de la direction</label>
                        <textarea id="quote" name="quote" class="insg-textarea" style="min-height: 80px;" placeholder="Ex: Former les leaders de demain avec rigueur, éthique et esprit d'innovation...">{{ old('quote', $membre->quote) }}</textarea>
                    </div>

                    <div class="insg-form-group full-width">
                        <label class="insg-label" for="bio">Biographie / Parcours professionnel et académique</label>
                        <textarea id="bio" name="bio" class="insg-textarea" style="min-height: 120px;" placeholder="Titres, parcours de recherche, responsabilités antérieures...">{{ old('bio', $membre->bio) }}</textarea>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="photo_file">Photo officielle (Fichier)</label>
                        <input type="file" id="photo_file" name="photo_file" accept="image/*" class="insg-input" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="photo">OU Chemin de la photo existante</label>
                        <input type="text" id="photo" name="photo" value="{{ old('photo', $membre->photo) }}" class="insg-input" placeholder="assets/images/directeur-1.png" />
                    </div>

                    @if($membre->photo)
                        <div class="insg-form-group full-width">
                            <label class="insg-label">Photo actuelle :</label>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <img src="{{ $membre->photo_url }}" alt="Aperçu" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 1px solid #cbd5e1;" />
                                <span style="font-size: 0.85rem; color: #64748b;">{{ $membre->photo }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="insg-form-group full-width" style="padding-top: 1rem;">
                        <label class="insg-switch-label">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $membre->is_active ?? true) ? 'checked' : '' }} />
                            <span>Membre actif et visible dans l'organigramme</span>
                        </label>
                    </div>
                </div>

                <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; gap: 0.75rem;">
                    <button type="submit" class="insg-btn insg-btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ $membre->exists ? 'Enregistrer les modifications' : 'Ajouter à la gouvernance' }}</span>
                    </button>
                    <a href="{{ route('admin.gouvernances.index') }}" class="insg-btn insg-btn-outline">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection

