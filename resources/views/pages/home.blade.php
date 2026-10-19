@extends('layouts.app')

@section('title', 'Institut National des Sciences de Gestion - INSG Gabon | Libreville')
@section('meta_description', 'L\'INSG Gabon est l\'établissement public d\'enseignement supérieur de référence en sciences managériales, finance, comptabilité et marketing à Libreville.')

@section('content')
<main id="page">
    <div id="page_deco">
        <div id="zone_navigation" class="clearfix">
            <div id="menu_secondaire" class="menu_toggle">
                <button class="toggle__menu_secondaire menu_empty" aria-label="Menu secondaire"></button>
            </div>

            <ul id="actions-fiche" class="actions-fiche">
                <li class="actions-fiche__item actions-fiche__item--print">
                    <button title="Imprimer" onclick="window.print(); return false;">
                        <span aria-hidden="true" class="icon icon-print"></span>
                        <span class="actions-fiche__libelle">Imprimer</span>
                    </button>
                </li>
                <li class="actions-fiche__item plier-deplier actions-fiche__item--share">
                    <button class="plier-deplier__bouton" aria-expanded="false">
                        <span aria-hidden="true" class="icon icon-share"></span>
                        <span class="actions-fiche__libelle">Partager</span>
                    </button>
                    <div class="plier-deplier__contenu plier-deplier__contenu--clos partage-reseauxsociaux">
                        <span>Partager cette page</span>
                        <ul>
                            <li class="partage-reseauxsociaux__item">
                                <a rel="nofollow" title="Courriel" href="mailto:?body={{ urlencode(url()->current()) }}&amp;subject=INSG%20Gabon">
                                    <span aria-hidden="true" class="icon icon-envelope"></span>
                                    <span class="actions-fiche__libelle">Envoyer par email</span>
                                </a>
                            </li>
                            <li class="partage-reseauxsociaux__item partage-reseauxsociaux__item--facebook">
                                <a class="js-share-action" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" title="Facebook">
                                    <span aria-hidden="true" class="icon icon-facebook"></span>
                                    <span class="actions-fiche__libelle">Facebook</span>
                                </a>
                            </li>
                            <li class="partage-reseauxsociaux__item partage-reseauxsociaux__item--linkedin">
                                <a class="js-share-action" href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" title="Linkedin">
                                    <span aria-hidden="true" class="icon icon-linkedin"></span>
                                    <span class="actions-fiche__libelle">Linkedin</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

        <div id="contenu-encadres">
            <div id="sans_nav_sans_encadres" class="contenu" role="main">
                <h1>Page d'accueil de l'Institut</h1>

                <div class="layout">
                    <div class="layout layout__simple-grid layout__simple-grid--siteCom js-layout">

                        {{-- Hero Carousel Row --}}
                        <div class="layout__simple-grid__row layout__simple-grid__row-0 scrollable-section" data-section-title="A la Une">
                            <div class="layout__simple-grid__row_wrapper clearfix">
                                <div class="layout__slot layout__slot--filled layout__gridSlot layout__slot--columnspan4 layout__slot--0x0 js-layout__slot">
                                    <div class="card carousellyon3Card">
                                        <div class="carousellyon3Card_wrapper">
                                            <div class="owl-carrousel-carousellyon3" data-animation-speed="5">
                                                @forelse($slides as $index => $slide)
                                                    <div class="carousellyon3__item__wrapper {{ $index === 0 ? 'active' : '' }}">
                                                        <div class="carousellyon3__item" style="background-image:url('{{ $slide->image_url }}');">
                                                            <span class="item_content">
                                                                <a href="{{ $slide->link_url ?? route('formations.index') }}">
                                                                    <h2>{{ $slide->title }}</h2>
                                                                    <p>{{ $slide->subtitle }}</p>
                                                                </a>
                                                                @if($slide->link_url)
                                                                    <a class="en_savoir_plus" href="{{ $slide->link_url }}">{{ $slide->link_text ?? 'En savoir plus' }}</a>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="carousellyon3__item__wrapper active">
                                                        <div class="carousellyon3__item" style="background-image:url('{{ asset('assets/images/1759791578740.jpg.jpeg') }}');">
                                                            <span class="item_content">
                                                                <a href="{{ route('formations.index') }}">
                                                                    <h2>Cérémonie de Remise des Diplômes</h2>
                                                                    <p>L'Institut National des Sciences de Gestion célèbre ses diplômés de Licence et Master professionnel.</p>
                                                                </a>
                                                                <a class="en_savoir_plus" href="{{ route('formations.index') }}">Découvrir nos filières</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endforelse
                                            </div>
                                            <div class="nav_containter"></div>
                                        </div>

                                        <div class="carousellyon3Card_tabs">
                                            <a class="tabs_tab1" href="{{ route('about') }}">
                                                <h2>Excellence &amp; Insertion</h2>
                                                <p>{{ $stats['insertion'] ?? '92%' }} d'insertion professionnelle pour nos {{ $stats['etudiants'] ?? '3 200+' }} étudiants formés chaque année à Libreville.</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Search Formations & Profile Row --}}
                        <div class="layout__simple-grid__row layout__simple-grid__row-2 scrollable-section" data-section-title="Vous êtes">
                            <div class="layout__simple-grid__row_wrapper clearfix"><!--
                                --><div class="layout__slot layout__slot--filled layout__gridSlot layout__slot--columnspan2 layout__slot--2x0 js-layout__slot">
                                    <div class="card rechercheformationlyon3Card">
                                        <form action="{{ route('formations.index') }}" method="get" autocomplete="off">
                                            <div class="rechercheformationlyon3Card_input">
                                                <input type="text" name="search" placeholder="Trouver une formation..." value="{{ request('search') }}" />
                                                <button type="submit" aria-label="Lancer la recherche"></button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="arc arc1"></div>
                                </div><!----><div class="layout__slot layout__slot--filled layout__gridSlot layout__slot--columnspan2 layout__slot--2x2 js-layout__slot">
                                    <div class="card profillyon3Card">
                                        <h2>Vous êtes</h2>
                                        <div class="profil_wrapper clearfix">
                                            <a href="{{ route('admissions') }}">
                                                <span>Futur étudiant</span>
                                            </a>
                                            <a href="{{ route('formations.index') }}">
                                                <span>Étudiant</span>
                                            </a>
                                            <a href="{{ route('entreprises') }}">
                                                <span>Entreprise</span>
                                            </a>
                                            <a href="{{ route('about') }}">
                                                <span>Partenaire</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="arc arc2"></div>
                                </div><!--
                            --></div>
                        </div>

                        {{-- Agenda & Actualités Row --}}
                        <div class="layout__simple-grid__row layout__simple-grid__row-4 scrollable-section" data-section-title="Actualités">
                            <div class="layout__simple-grid__row_wrapper clearfix"><!--
                                --><div class="layout__slot layout__slot--filled layout__gridSlot layout__slot--4x0 js-layout__slot">
                                    <div class="card agendaLyon3Card">
                                        <h2>Agenda</h2>
                                        <div class="card__wrapper">
                                            <ul class="card_liste">
                                                @forelse($upcomingEvents as $evt)
                                                    <x-card-evenement :evenement="$evt" />
                                                @empty
                                                    <li>
                                                        <a href="{{ route('evenements.index') }}" class="card_evnt">
                                                            <span class="day">15</span>
                                                            <span class="month">octobre</span>
                                                        </a>
                                                        <h3><a href="{{ route('evenements.index') }}">Journée Portes Ouvertes 2026 – Campus INSG Libreville</a></h3>
                                                    </li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row2_link row2_link_col1">
                                        <a class="button" href="{{ route('evenements.index') }}">Toutes les dates</a>
                                    </div>
                                </div><!----><div class="layout__slot layout__slot--filled layout__gridSlot layout__slot--columnspan3 layout__slot--4x1 js-layout__slot">
                                    @php
                                        $firstNews = $featuredActualites->first() ?? $recentActualites->first();
                                        $secondNews = $featuredActualites->skip(1)->first() ?? $recentActualites->skip(1)->first();
                                        $thirdNews = $recentActualites->skip(2)->first();
                                    @endphp
                                    <div class="card actualiteLyon3Card"><!--
                                        --><div class="actualiteLyon3Card_col1">
                                            <div class="col1_ligne1"><!--
                                                --><div class="intitule">
                                                    <h2>Actualités</h2>
                                                </div><!--
                                                @if($firstNews)
                                                --><a href="{{ route('actualites.show', $firstNews->slug) }}" class="photo col1_photo1 col_mobile"><span style="background-image:url('{{ $firstNews->image_url }}')"></span></a><!--
                                                --><div class="col_mobile col_desktop-hidden">
                                                    <a href="{{ route('actualites.show', $firstNews->slug) }}">
                                                        @if($firstNews->category)
                                                            <span class="thematique">{{ strtoupper($firstNews->category) }}</span>
                                                        @endif
                                                        <h3>{{ $firstNews->title }}</h3>
                                                        <p>{{ $firstNews->excerpt ?? Str::limit(strip_tags($firstNews->content), 120) }}</p>
                                                    </a>
                                                </div><!--
                                                @endif
                                            --></div>

                                            @if($secondNews)
                                            <div class="col1_ligne2"><!--
                                                --><div class="col1_ligne2_col1 col_mobile">
                                                    <a href="{{ route('actualites.show', $secondNews->slug) }}" class="photo col1_photo2"><span style="background-image:url('{{ $secondNews->image_url }}')"></span></a>
                                                </div><!--
                                                --><div class="col1_ligne2_col2 col_mobile">
                                                    <a href="{{ route('actualites.show', $secondNews->slug) }}">
                                                        @if($secondNews->category)
                                                            <span class="thematique">{{ strtoupper($secondNews->category) }}</span>
                                                        @endif
                                                        <h3>{{ $secondNews->title }}</h3>
                                                        <p>{{ $secondNews->excerpt ?? Str::limit(strip_tags($secondNews->content), 120) }}</p>
                                                    </a>
                                                </div><!--
                                            --></div>
                                            @endif
                                        </div><!--
                                        --><div class="actualiteLyon3Card_col2">
                                            @if($firstNews)
                                            <div class="col2_ligne1 col_mobile-hidden">
                                                <a href="{{ route('actualites.show', $firstNews->slug) }}">
                                                    @if($firstNews->category)
                                                        <span class="thematique">{{ strtoupper($firstNews->category) }}</span>
                                                    @endif
                                                    <h3>{{ $firstNews->title }}</h3>
                                                    <p>{{ $firstNews->excerpt ?? Str::limit(strip_tags($firstNews->content), 150) }}</p>
                                                </a>
                                            </div>
                                            @endif

                                            @if($thirdNews)
                                            <div class="col2_ligne2"><!--
                                                --><a href="{{ route('actualites.show', $thirdNews->slug) }}" class="photo col2_photo1 col_mobile"><span style="background-image:url('{{ $thirdNews->image_url }}')"></span></a><!--
                                                --><a href="{{ route('actualites.show', $thirdNews->slug) }}" class="col_mobile">
                                                    @if($thirdNews->category)
                                                        <span class="thematique">{{ strtoupper($thirdNews->category) }}</span>
                                                    @endif
                                                    <h3>{{ $thirdNews->title }}</h3>
                                                    <p>{{ $thirdNews->excerpt ?? Str::limit(strip_tags($thirdNews->content), 120) }}</p>
                                                </a><!--
                                            --></div>
                                            @endif
                                        </div><!--
                                    --></div>

                                    <div class="row2_link row2_link_col2">
                                        <a class="button" href="{{ route('actualites.index') }}">Toutes les actualités</a>
                                    </div>
                                    <div class="arc arc3"></div>
                                </div><!--
                            --></div>
                        </div>

                        {{-- Stats & Highlights Gallery Row --}}
                        <div class="layout__simple-grid__row layout__simple-grid__row-6 scrollable-section" data-section-title="Galerie">
                            <div class="layout__simple-grid__row_wrapper clearfix"><!--
                                --><div class="layout__slot layout__slot--filled layout__gridSlot layout__slot--columnspan4 layout__slot--6x0 js-layout__slot">
                                    <div class="card galerielyon3Card">
                                        <div class="galerie_bloc bloc1 couleur_couleur1">
                                            <div class="galerie_bloc_wrapper">
                                                <a href="{{ route('about') }}">
                                                    <strong>{{ $stats['enseignants'] ?? '140+' }}</strong>
                                                    <span>enseignants et experts professionnels</span>
                                                </a>
                                                <a href="{{ route('formations.index') }}">
                                                    <strong>{{ $stats['filieres'] ?? '8' }}</strong>
                                                    <span>filières d'excellence</span>
                                                    <img class="no-filter" src="{{ asset('assets/images/cartable_1516879221174-png.png') }}" alt="Filières" />
                                                </a>
                                            </div>
                                        </div>

                                        <div class="galerie_bloc bloc2 photo">
                                            <video autoplay loop muted playsinline poster="{{ asset('assets/images/insg-back-1.jpeg') }}" style="width:100%;height:100%;object-fit:cover;">
                                                <source src="{{ asset('assets/videos/insg-institutionnelle-40s.mp4') }}" type="video/mp4">
                                            </video>
                                        </div>

                                        <div class="galerie_bloc bloc3 couleur_couleur2">
                                            <div class="galerie_bloc_wrapper">
                                                <a href="{{ route('campus') }}">
                                                    <strong>Espace</strong>
                                                    <span>Bibliothèque &amp; Recherche</span>
                                                    <img class="no-filter" src="{{ asset('assets/images/mediatheque_1513157427787-png.png') }}" alt="Médiathèque" />
                                                </a>
                                            </div>
                                        </div>

                                        <div class="galerie_bloc bloc4 photo" style="background-image:url('{{ asset('assets/images/insg-back-3.jpeg') }}')"></div>

                                        <div class="galerie_bloc bloc5 couleur_couleur2">
                                            <div class="galerie_bloc_wrapper">
                                                <a href="{{ route('formations.index') }}">
                                                    <strong>{{ $stats['insertion'] ?? '92%' }}</strong>
                                                    <span>taux d'insertion professionnelle</span>
                                                    <img class="no-filter" src="{{ asset('assets/images/international_1516878194583-png.png') }}" alt="Insertion" />
                                                </a>
                                            </div>
                                        </div>

                                        <div class="galerie_bloc bloc6 photo" style="background-image:url('{{ asset('assets/images/insg-back-5.jpeg') }}')"></div>

                                        <div class="galerie_bloc bloc7 couleur_couleur3">
                                            <div class="galerie_bloc_wrapper">
                                                <a href="{{ route('about') }}">
                                                    <strong>{{ $stats['etudiants'] ?? '3 200+' }}</strong>
                                                    <span>étudiants formés par an</span>
                                                    <img class="no-filter" src="{{ asset('assets/images/etudiants-def2_1516900840094-png.png') }}" alt="Étudiants" />
                                                </a>
                                            </div>
                                        </div>

                                        <div class="galerie_bloc bloc8 photo" style="background-image:url('{{ asset('assets/images/insg-back-6.jpeg') }}')"></div>

                                        <div class="galerie_bloc bloc9 couleur_couleur1">
                                            <div class="galerie_bloc_wrapper">
                                                <a href="{{ route('entreprises') }}">
                                                    <strong>{{ $stats['entreprises'] ?? '42' }}</strong>
                                                    <span>entreprises partenaires</span>
                                                </a>
                                                <a href="{{ route('about') }}">
                                                    <strong>4</strong>
                                                    <span>laboratoires &amp; chaires</span>
                                                    <img class="no-filter" src="{{ asset('assets/images/immeuble_1516878533295-png.png') }}" alt="Laboratoires" />
                                                </a>
                                            </div>
                                        </div>

                                        <div class="galerie_bloc bloc10 couleur_couleur3">
                                            <div class="galerie_bloc_wrapper">
                                                <a href="{{ route('campus') }}">
                                                    <strong>1</strong>
                                                    <span>campus principal (Libreville)</span>
                                                    <img class="no-filter" src="{{ asset('assets/images/localisation-def_1516885789353-png.png') }}" alt="Campus" />
                                                </a>
                                            </div>
                                        </div>

                                        <div class="galerie_bloc bloc11 photo" style="background-image:url('{{ asset('assets/images/directeur-1.png') }}')"></div>

                                        <div class="galerie_bloc bloc12 couleur_couleur2">
                                            <div class="galerie_bloc_wrapper">
                                                <a href="{{ route('vie-associative') }}">
                                                    <strong>{{ $stats['associations'] ?? '15+' }}</strong>
                                                    <span>clubs &amp; associations étudiantes</span>
                                                    <img class="no-filter" src="{{ asset('assets/images/associations_1516897081704-png.png') }}" alt="Associations" />
                                                </a>
                                            </div>
                                        </div>

                                        <div class="galerie_bloc bloc13 photo" style="background-image:url('{{ asset('assets/images/insg-back-9.jpeg') }}')"></div>
                                    </div>
                                </div><!--
                            --></div>
                        </div>
                    </div>
                </div>

                <div class="date-miseajour">Mise &agrave; jour :&nbsp;{{ date('d F Y') }}</div>
                <div id="redacteur-date-impression"></div>
            </div>
        </div>

        <div class="separateur"></div>
    </div>
</main>
@endsection

