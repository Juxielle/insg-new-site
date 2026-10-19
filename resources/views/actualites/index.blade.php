@extends('layouts.app')

@section('title', 'Actualités - Institut National des Sciences de Gestion (INSG Gabon)')
@section('meta_description', 'Retrouvez toute l\'actualité de l\'INSG Gabon : rentrée académique, partenariats avec les entreprises, événements scientifiques et vie du campus.')

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Actualités' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_sans_encadres" class="contenu" role="main">
                <h1>Toutes les actualités de l'INSG Gabon</h1>

                <div class="ligne_1">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--0">
                                <div class="paragraphe__contenu--0 toolbox">
                                    <p class="chapo">Restez informé de la vie académique, des concours, des innovations pédagogiques, des partenariats industriels et des grands rendez-vous de l'Institut National des Sciences de Gestion de Libreville.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Filter & Search Bar --}}
                <div class="recherche-actualites-bar">
                    <form action="{{ route('actualites.index') }}" method="get" class="recherche-bar-form">
                        <div class="recherche-bar-form__input">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher par mot-clé..." aria-label="Rechercher par mot-clé" />
                        </div>
                        <div class="recherche-bar-form__select">
                            <span class="select_style">
                                <select name="categorie" id="categorie" aria-label="Filtrer par catégorie">
                                    <option value="">Toutes les catégories</option>
                                    @foreach($categories as $cat)
                                        @if($cat)
                                            <option value="{{ $cat }}" {{ request('categorie') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </span>
                        </div>
                        <div class="recherche-bar-form__actions">
                            <button type="submit" class="button">
                                <span>Filtrer</span>
                            </button>
                            @if(request('q') || request('categorie'))
                                <a href="{{ route('actualites.index') }}" class="recherche-bar-form__reset">Réinitialiser</a>
                            @endif
                        </div>
                    </form>
                </div>

                {{-- News List --}}
                @if($actualites->count() > 0)
                    <ul class="objets actualites avec-date" style="padding: 0; margin: 0;">
                        @foreach($actualites as $act)
                            <x-card-actualite :actualite="$act" />
                        @endforeach
                    </ul>

                    {{-- Pagination --}}
                    <div class="pagination-wrapper" style="margin-top: 2rem;">
                        {{ $actualites->links() }}
                    </div>
                @else
                    <div style="background: #fff; border: 1px dashed #ccc; padding: 2rem; text-align: center; border-radius: 6px; margin: 2rem 0;">
                        <p style="font-size: 1.1rem; color: #555; margin: 0 0 1rem 0;">Aucune actualité ne correspond à vos critères de recherche.</p>
                        <a href="{{ route('actualites.index') }}" class="button" style="display: inline-block;">Voir toutes les actualités</a>
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

