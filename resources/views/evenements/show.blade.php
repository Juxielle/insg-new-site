@extends('layouts.app')

@section('title', $evenement->title . ' - Événements INSG Gabon')
@section('meta_description', $evenement->summary ?? Str::limit(strip_tags($evenement->description), 150))

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => [
            'Agenda & Événements' => route('evenements.index'),
            $evenement->title => ''
        ]])

        <div id="contenu-encadres">
            <div id="avec_nav_sans_encadres" class="contenu" role="main">
                
                <div style="margin-bottom: 1rem;">
                    @if($evenement->formatted_period)
                        <span style="display: inline-block; background-color: var(--uas-couleur-principale, #1f234b); color: #fff; font-size: 0.85rem; text-transform: uppercase; font-weight: 700; padding: 4px 12px; border-radius: 3px; margin-bottom: 0.75rem;">
                            {{ $evenement->formatted_period }}
                        </span>
                    @endif
                    @if($evenement->location)
                        <span style="color: #555; font-size: 0.95rem; margin-left: 0.75rem;">
                            <span class="icon icon-location" aria-hidden="true"></span> {{ $evenement->location }}
                        </span>
                    @endif
                </div>

                <h1 style="margin-top: 0; line-height: 1.25;">{{ $evenement->title }}</h1>

                <div class="ligne_1">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            @if($evenement->image)
                                <div style="margin: 1.5rem 0 2rem 0; border-radius: 6px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                    <img src="{{ $evenement->image_url }}" alt="{{ $evenement->title }}" style="width: 100%; max-height: 480px; object-fit: cover; display: block;" />
                                </div>
                            @endif

                            <div class="paragraphe--0">
                                <div class="paragraphe__contenu--0 toolbox">
                                    @if($evenement->summary)
                                        <p class="chapo" style="font-size: 1.15rem; font-weight: 500; line-height: 1.6; color: #222; border-left: 4px solid var(--uas-couleur-accent, #0091B5); padding-left: 1rem; margin: 1.5rem 0;">
                                            {{ $evenement->summary }}
                                        </p>
                                    @endif

                                    @if($evenement->organizer)
                                        <p style="font-size: 0.95rem; color: #666; margin-bottom: 1.5rem;">
                                            <strong>Organisateur :</strong> {{ $evenement->organizer }}
                                        </p>
                                    @endif

                                    <div class="evenement-body-content" style="font-size: 1.05rem; line-height: 1.8; color: #333; margin: 2rem 0;">
                                        {!! nl2br(e($evenement->description)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Back button & share --}}
                <div style="border-top: 1px solid #e2e4e8; padding-top: 1.5rem; margin: 2.5rem 0 1rem 0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <a href="{{ route('evenements.index') }}" class="button" style="display: inline-block;">
                        &larr; Retour à l'agenda
                    </a>
                </div>

                <div class="date-miseajour">Mise à jour : {{ date('d F Y') }}</div>
            </div>
        </div>

        <div class="separateur"></div>
    </div>
</main>
@endsection

