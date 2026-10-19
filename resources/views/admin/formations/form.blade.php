@extends('layouts.admin')

@section('title', $formation->exists ? 'Modifier une Formation' : 'Nouvelle Formation')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <a href="{{ route('admin.formations.index') }}">Formations</a>
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>{{ $formation->exists ? 'Modifier' : 'Nouvelle' }}</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">{{ $formation->exists ? 'Modifier la Formation' : 'Nouvelle Formation' }}</h1>
            <p class="admin-header-desc">Définissez les objectifs, débouchés et programmes de la filière.</p>
        </div>
        <div>
            <a href="{{ route('admin.formations.index') }}" class="insg-btn insg-btn-outline">
                &larr; Retour à la liste
            </a>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">{{ $formation->exists ? 'Éditer : ' . $formation->title : 'Fiche de la nouvelle formation' }}</h2>
        </div>
        <div class="insg-card-body">
            <form action="{{ $formation->exists ? route('admin.formations.update', $formation) : route('admin.formations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($formation->exists)
                    @method('PUT')
                @endif

                <div class="insg-form-grid">
                    <div class="insg-form-group full-width">
                        <label class="insg-label" for="title">Intitulé complet du diplôme <span class="required">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $formation->title) }}" required class="insg-input" placeholder="Ex: Master Professionnel Audit et Contrôle de Gestion" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="level">Niveau / Grade académique <span class="required">*</span></label>
                        <select id="level" name="level" required class="insg-select">
                            <option value="BTS" {{ old('level', $formation->level) == 'BTS' ? 'selected' : '' }}>BTS (Bac+2)</option>
                            <option value="Licence Pro" {{ old('level', $formation->level) == 'Licence Pro' ? 'selected' : '' }}>Licence Professionnelle (Bac+3)</option>
                            <option value="Master Pro" {{ old('level', $formation->level) == 'Master Pro' ? 'selected' : '' }}>Master Professionnel (Bac+5)</option>
                            <option value="Doctorat" {{ old('level', $formation->level) == 'Doctorat' ? 'selected' : '' }}>Doctorat / Recherche</option>
                            <option value="Formation Continue" {{ old('level', $formation->level) == 'Formation Continue' ? 'selected' : '' }}>Formation Continue / Certifiante</option>
                        </select>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="department">Département académique de rattachement <span class="required">*</span></label>
                        <input type="text" id="department" name="department" value="{{ old('department', $formation->department) }}" required class="insg-input" placeholder="Ex: Finance & Comptabilité, Marketing & Commerce..." list="dep-suggestions" />
                        <datalist id="dep-suggestions">
                            <option value="Finance & Comptabilité">
                            <option value="Marketing & Commerce">
                            <option value="Management & RH">
                            <option value="Logistique & Transport">
                            <option value="Management & Stratégie">
                            <option value="Informatique de Gestion">
                        </datalist>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="duration">Durée des études <span class="required">*</span></label>
                        <input type="text" id="duration" name="duration" value="{{ old('duration', $formation->duration ?? '3 ans (6 semestres)') }}" required class="insg-input" placeholder="Ex: 2 ans (4 semestres)" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="slug">Identifiant URL (Slug optionnel)</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $formation->slug) }}" class="insg-input" placeholder="Laisser vide pour génération automatique" />
                    </div>

                    <div class="insg-form-group full-width">
                        <label class="insg-label" for="summary">Résumé court de la formation <span class="required">*</span></label>
                        <textarea id="summary" name="summary" required class="insg-textarea" style="min-height: 80px;" placeholder="Bref aperçu affiché dans les listings...">{{ old('summary', $formation->summary) }}</textarea>
                    </div>

                    <div class="insg-form-group full-width">
                        <label class="insg-label" for="description">Présentation détaillée du cursus <span class="required">*</span></label>
                        <textarea id="description" name="description" required class="insg-textarea" style="min-height: 160px;" placeholder="Objectifs pédagogiques, compétences visées, corps professoral...">{{ old('description', $formation->description) }}</textarea>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="admission_requirements">Conditions d'accès et prérequis</label>
                        <textarea id="admission_requirements" name="admission_requirements" class="insg-textarea" style="min-height: 100px;" placeholder="Ex: Baccalauréat séries B, C, D ou diplôme Bac+3. Sélection sur concours...">{{ old('admission_requirements', $formation->admission_requirements) }}</textarea>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="career_opportunities">Débouchés professionnels & métiers</label>
                        <textarea id="career_opportunities" name="career_opportunities" class="insg-textarea" style="min-height: 100px;" placeholder="Ex: Directeur Financier, Auditeur interne, Contrôleur de gestion...">{{ old('career_opportunities', $formation->career_opportunities) }}</textarea>
                    </div>

                    <div class="insg-form-group full-width">
                        <label class="insg-label" for="curriculum">Axes du programme d'enseignement</label>
                        <textarea id="curriculum" name="curriculum" class="insg-textarea" style="min-height: 100px;" placeholder="Ex: Normes comptables OHADA, Analyse financière, Droit fiscal, Mathématiques de gestion...">{{ old('curriculum', $formation->curriculum) }}</textarea>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="image_file">Image d'illustration (Fichier)</label>
                        <input type="file" id="image_file" name="image_file" accept="image/*" class="insg-input" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="image">OU Chemin d'image existante</label>
                        <input type="text" id="image" name="image" value="{{ old('image', $formation->image) }}" class="insg-input" placeholder="assets/images/insg-back-4.jpeg" />
                    </div>

                    @if($formation->image)
                        <div class="insg-form-group full-width">
                            <label class="insg-label">Image actuelle :</label>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <img src="{{ $formation->image_url }}" alt="Aperçu" style="max-height: 120px; border-radius: 6px; border: 1px solid #cbd5e1;" />
                                <span style="font-size: 0.85rem; color: #64748b;">{{ $formation->image }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="insg-form-group full-width" style="padding-top: 1rem;">
                        <label class="insg-switch-label">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $formation->is_active ?? true) ? 'checked' : '' }} />
                            <span>Formation active et visible au catalogue en ligne</span>
                        </label>
                    </div>
                </div>

                <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; gap: 0.75rem;">
                    <button type="submit" class="insg-btn insg-btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ $formation->exists ? 'Enregistrer les modifications' : 'Créer la formation' }}</span>
                    </button>
                    <a href="{{ route('admin.formations.index') }}" class="insg-btn insg-btn-outline">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection

