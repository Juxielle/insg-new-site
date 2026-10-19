@extends('layouts.admin')

@section('title', $evenement->exists ? 'Modifier un Événement' : 'Nouvel Événement')

@section('breadcrumbs')
    <span class="admin-breadcrumb-sep">&gt;</span>
    <a href="{{ route('admin.evenements.index') }}">Événements</a>
    <span class="admin-breadcrumb-sep">&gt;</span>
    <span>{{ $evenement->exists ? 'Modifier' : 'Nouveau' }}</span>
@endsection

@section('content')
    <div class="admin-header">
        <div>
            <h1 class="admin-header-title">{{ $evenement->exists ? 'Modifier l\'Événement' : 'Nouvel Événement' }}</h1>
            <p class="admin-header-desc">Renseignez les dates, le programme et les détails de l'événement.</p>
        </div>
        <div>
            <a href="{{ route('admin.evenements.index') }}" class="insg-btn insg-btn-outline">
                &larr; Retour à la liste
            </a>
        </div>
    </div>

    <div class="insg-card">
        <div class="insg-card-header">
            <h2 class="insg-card-title">{{ $evenement->exists ? 'Éditer : ' . $evenement->title : 'Formulaire de planification' }}</h2>
        </div>
        <div class="insg-card-body">
            <form action="{{ $evenement->exists ? route('admin.evenements.update', $evenement) : route('admin.evenements.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($evenement->exists)
                    @method('PUT')
                @endif

                <div class="insg-form-grid">
                    <div class="insg-form-group full-width">
                        <label class="insg-label" for="title">Titre de l'événement <span class="required">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $evenement->title) }}" required class="insg-input" placeholder="Ex: Journée Portes Ouvertes & Orientation 2026" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="date_start">Date et heure de début <span class="required">*</span></label>
                        <input type="datetime-local" id="date_start" name="date_start" value="{{ old('date_start', $evenement->date_start ? $evenement->date_start->format('Y-m-d\TH:i') : '') }}" required class="insg-input" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="date_end">Date et heure de fin</label>
                        <input type="datetime-local" id="date_end" name="date_end" value="{{ old('date_end', $evenement->date_end ? $evenement->date_end->format('Y-m-d\TH:i') : '') }}" class="insg-input" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="location">Lieu / Salle <span class="required">*</span></label>
                        <input type="text" id="location" name="location" value="{{ old('location', $evenement->location ?? 'Campus INSG, Libreville') }}" required class="insg-input" placeholder="Ex: Amphithéâtre d'Honneur, Campus Libreville" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="organizer">Organisateur</label>
                        <input type="text" id="organizer" name="organizer" value="{{ old('organizer', $evenement->organizer ?? 'Direction des Études et Scolarité') }}" class="insg-input" placeholder="Ex: Direction Générale, BDE, LAREG..." />
                    </div>

                    <div class="insg-form-group full-width">
                        <label class="insg-label" for="summary">Résumé court <span class="required">*</span></label>
                        <textarea id="summary" name="summary" required class="insg-textarea" style="min-height: 80px;" placeholder="Bref aperçu affiché sur l'agenda...">{{ old('summary', $evenement->summary) }}</textarea>
                    </div>

                    <div class="insg-form-group full-width">
                        <label class="insg-label" for="description">Description détaillée <span class="required">*</span></label>
                        <textarea id="description" name="description" required class="insg-textarea" style="min-height: 160px;" placeholder="Programme des interventions, intervenants, modalités de participation...">{{ old('description', $evenement->description) }}</textarea>
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="image_file">Affiche / Photo (Fichier)</label>
                        <input type="file" id="image_file" name="image_file" accept="image/*" class="insg-input" />
                    </div>

                    <div class="insg-form-group">
                        <label class="insg-label" for="image">OU Chemin existant</label>
                        <input type="text" id="image" name="image" value="{{ old('image', $evenement->image) }}" class="insg-input" placeholder="assets/images/insg-back-8.jpeg" />
                    </div>

                    @if($evenement->image)
                        <div class="insg-form-group full-width">
                            <label class="insg-label">Visuel actuel :</label>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <img src="{{ $evenement->image_url }}" alt="Aperçu" style="max-height: 120px; border-radius: 6px; border: 1px solid #cbd5e1;" />
                                <span style="font-size: 0.85rem; color: #64748b;">{{ $evenement->image }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="insg-form-group">
                        <label class="insg-label" for="slug">Identifiant URL (Slug optionnel)</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $evenement->slug) }}" class="insg-input" placeholder="Laisser vide pour génération automatique" />
                    </div>
                </div>

                <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; gap: 0.75rem;">
                    <button type="submit" class="insg-btn insg-btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ $evenement->exists ? 'Enregistrer les modifications' : 'Programmer l\'événement' }}</span>
                    </button>
                    <a href="{{ route('admin.evenements.index') }}" class="insg-btn insg-btn-outline">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection

