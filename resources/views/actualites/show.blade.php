@extends('layouts.app')

@section('title', $actualite->title . ' - Actualités INSG Gabon')
@section('meta_description', $actualite->excerpt ?? Str::limit(strip_tags($actualite->content), 150))

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => [
            'Actualités' => route('actualites.index'),
            $actualite->title => ''
        ]])

        <div id="contenu-encadres">
            <div id="avec_nav_sans_encadres" class="contenu" role="main">
                
                <div style="margin-bottom: 1rem;">
                    @if($actualite->category)
                        <span style="display: inline-block; background-color: var(--uas-couleur-principale, #1f234b); color: #fff; font-size: 0.8rem; text-transform: uppercase; font-weight: 700; padding: 3px 10px; border-radius: 3px; margin-bottom: 0.75rem;">
                            {{ $actualite->category }}
                        </span>
                    @endif
                    @if($actualite->published_at)
                        <span style="color: #666; font-size: 0.9rem; margin-left: 0.75rem;">
                            Publié le {{ $actualite->formatted_date }}
                        </span>
                    @endif
                </div>

                <h1 style="margin-top: 0; line-height: 1.25;">{{ $actualite->title }}</h1>

                <div class="ligne_1">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            @if($actualite->image)
                                <div style="margin: 1.5rem 0 2rem 0; border-radius: 6px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                    <img src="{{ $actualite->image_url }}" alt="{{ $actualite->title }}" style="width: 100%; max-height: 480px; object-fit: cover; display: block;" />
                                </div>
                            @endif

                            <div class="paragraphe--0">
                                <div class="paragraphe__contenu--0 toolbox">
                                    @if($actualite->excerpt)
                                        <p class="chapo" style="font-size: 1.15rem; font-weight: 500; line-height: 1.6; color: #222; border-left: 4px solid var(--uas-couleur-accent, #0091B5); padding-left: 1rem; margin: 1.5rem 0;">
                                            {{ $actualite->excerpt }}
                                        </p>
                                    @endif

                                    <div class="actualite-body-content" style="font-size: 1.05rem; line-height: 1.8; color: #333; margin: 2rem 0;">
                                        {!! nl2br(e($actualite->content)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Back button & share --}}
                <div style="border-top: 1px solid #e2e4e8; padding-top: 1.5rem; margin: 2.5rem 0 1rem 0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <a href="{{ route('actualites.index') }}" class="button" style="display: inline-block;">
                        &larr; Retour à toutes les actualités
                    </a>
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <span style="font-size: 0.9rem; color: #666; font-weight: 600;">Partager :</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" title="Partager sur Facebook" style="text-decoration: none;">
                            <img src="{{ asset('assets/images/facebook22x32_1512477766977-png.png') }}" alt="Facebook" style="height: 24px; vertical-align: middle;">
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" title="Partager sur LinkedIn" style="text-decoration: none;">
                            <img src="{{ asset('assets/images/linkedin_1511883384553-png.png') }}" alt="LinkedIn" style="height: 24px; vertical-align: middle;">
                        </a>
                        <a href="mailto:?subject={{ urlencode($actualite->title) }}&body={{ urlencode(url()->current()) }}" title="Envoyer par email" style="text-decoration: none;">
                            <span class="icon icon-envelope" style="font-size: 1.25rem; color: var(--uas-couleur-principale, #1f234b);"></span>
                        </a>
                    </div>
                </div>

                {{-- Other Recent News --}}
                @if(isset($recentActualites) && $recentActualites->count() > 0)
                    <div style="margin-top: 3.5rem; border-top: 2px solid var(--uas-couleur-principale, #1f234b); padding-top: 2rem;">
                        <h2 style="font-size: 1.4rem; color: var(--uas-couleur-principale, #1f234b); margin-bottom: 1.5rem;">Autres actualités récentes</h2>
                        <ul class="objets actualites avec-date" style="padding: 0; margin: 0;">
                            @foreach($recentActualites as $recent)
                                <x-card-actualite :actualite="$recent" />
                            @endforeach
                        </ul>
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

