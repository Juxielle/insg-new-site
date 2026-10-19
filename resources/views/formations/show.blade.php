@extends('layouts.app')

@section('title', $formation->title . ' - Formations INSG Gabon')
@section('meta_description', Str::limit(strip_tags($formation->description), 155))

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => [
            'Formations' => route('formations.index'),
            $formation->title => ''
        ]])

        <div id="contenu-encadres">
            <div id="avec_nav_sans_encadres" class="contenu" role="main">
                
                {{-- Badges Header --}}
                <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 0.75rem; flex-wrap: wrap;">
                    <span style="background: var(--uas-couleur-accent, #0091B5); color: #fff; font-size: 0.8rem; font-weight: 700; padding: 4px 10px; border-radius: 3px; text-transform: uppercase;">
                        {{ $formation->level }}
                    </span>
                    <span style="background: #eef0f4; color: #333; font-size: 0.8rem; font-weight: 600; padding: 4px 10px; border-radius: 3px; text-transform: uppercase;">
                        {{ $formation->department }}
                    </span>
                    @if($formation->duration)
                        <span style="color: #666; font-size: 0.85rem; margin-left: 0.5rem;">
                            <strong>Durée :</strong> {{ $formation->duration }}
                        </span>
                    @endif
                </div>

                <h1 style="margin-top: 0; line-height: 1.25;">{{ $formation->title }}</h1>

                <div class="ligne_1">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            
                            {{-- Image and Hero --}}
                            <div style="margin: 1.5rem 0 2rem 0; border-radius: 6px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                                <img src="{{ $formation->image_url }}" alt="{{ $formation->title }}" style="width: 100%; max-height: 420px; object-fit: cover; display: block;" />
                            </div>

                            <div class="paragraphe--0">
                                <div class="paragraphe__contenu--0 toolbox">
                                    <div style="display: flex; gap: 2.5rem; align-items: flex-start; flex-wrap: wrap;">
                                        
                                        {{-- Main Details --}}
                                        <div style="flex: 1 1 540px;">
                                            <h2>Présentation de la filière</h2>
                                            <p class="chapo" style="font-size: 1.05rem; line-height: 1.7; color: #333;">
                                                {!! nl2br(e($formation->description)) !!}
                                            </p>

                                            @if($formation->objectives)
                                                <h2 style="margin-top: 2rem;">Objectifs de la formation</h2>
                                                <div style="line-height: 1.7; color: #444;">
                                                    {!! nl2br(e($formation->objectives)) !!}
                                                </div>
                                            @endif

                                            @if($formation->careers)
                                                <h2 style="margin-top: 2rem;">Débouchés professionnels &amp; Métiers</h2>
                                                <div style="line-height: 1.7; color: #444; background: #fbfbfc; border-left: 4px solid var(--uas-couleur-principale, #1f234b); padding: 1rem 1.25rem; border-radius: 0 4px 4px 0;">
                                                    {!! nl2br(e($formation->careers)) !!}
                                                </div>
                                            @endif

                                            @if($formation->prerequisites)
                                                <h2 style="margin-top: 2rem;">Conditions d'admission &amp; Prérequis</h2>
                                                <div style="line-height: 1.7; color: #444;">
                                                    {!! nl2br(e($formation->prerequisites)) !!}
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Sidebar Factsheet --}}
                                        <div style="flex: 0 0 300px; max-width: 100%;">
                                            <div style="background: #f7f8fa; border: 1px solid #e2e4e8; border-radius: 6px; padding: 1.5rem; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                                                <h3 style="margin-top: 0; color: var(--uas-couleur-principale, #1f234b); border-bottom: 2px solid var(--uas-couleur-principale, #1f234b); padding-bottom: 0.5rem; font-size: 1.1rem;">
                                                    Fiche Synthétique
                                                </h3>
                                                <ul style="list-style: none; padding: 0; margin: 1rem 0 1.5rem 0; font-size: 0.9rem; line-height: 1.8;">
                                                    <li><strong>Niveau de sortie :</strong> {{ $formation->level }}</li>
                                                    <li><strong>Département :</strong> {{ $formation->department }}</li>
                                                    <li><strong>Durée :</strong> {{ $formation->duration ?? '3 ans' }}</li>
                                                    <li><strong>Régime :</strong> Formation Initiale / Continue</li>
                                                    <li><strong>Lieu :</strong> Campus Libreville</li>
                                                    <li><strong>Validation :</strong> Diplôme National d'État</li>
                                                </ul>

                                                <a href="{{ route('admissions') }}" class="button" style="display: block; text-align: center; background: var(--uas-couleur-principale, #1f234b); color: #fff; padding: 0.75rem 1rem; border-radius: 4px; text-decoration: none; font-weight: 700; margin-bottom: 0.75rem;">
                                                    Candidater à cette filière &rarr;
                                                </a>
                                                <a href="{{ route('contact') }}" style="display: block; text-align: center; font-size: 0.85rem; color: #555; text-decoration: underline;">
                                                    Poser une question
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Back button --}}
                <div style="border-top: 1px solid #e2e4e8; padding-top: 1.5rem; margin: 2.5rem 0 1rem 0;">
                    <a href="{{ route('formations.index') }}" class="button" style="display: inline-block;">
                        &larr; Retour à l'offre de formations
                    </a>
                </div>

                {{-- Related formations --}}
                @if(isset($relatedFormations) && $relatedFormations->count() > 0)
                    <div style="margin-top: 3.5rem; border-top: 2px solid var(--uas-couleur-principale, #1f234b); padding-top: 2rem;">
                        <h2 style="font-size: 1.4rem; color: var(--uas-couleur-principale, #1f234b); margin-bottom: 1.5rem;">Formations similaires</h2>
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
                            @foreach($relatedFormations as $rf)
                                <x-card-formation :formation="$rf" />
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>

        <div class="date-miseajour">Mise &agrave; jour :&nbsp;{{ date('d F Y') }}</div>
        <div id="redacteur-date-impression"></div>
    </div>
    <div class="separateur"></div>
</main>
@endsection

