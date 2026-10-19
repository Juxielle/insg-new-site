@extends('layouts.app')

@section('title', 'Agenda & Événements - INSG Gabon')
@section('meta_description', 'Découvrez les événements, colloques, journées portes ouvertes, conférences et cérémonies officielles de l\'INSG Gabon à Libreville.')

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Agenda & Événements' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_sans_encadres" class="contenu" role="main">
                <h1>Agenda de l'Institut</h1>

                <div class="ligne_1">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--0">
                                <div class="paragraphe__contenu--0 toolbox">
                                    <p class="chapo">Retrouvez l'ensemble des rendez-vous académiques, scientifiques, culturels et professionnels qui rythment l'année universitaire à l'INSG Gabon.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Events Listing --}}
                <div class="card agendaLyon3Card" style="margin-top: 2rem;">
                    <div class="card__wrapper">
                        <ul class="card_liste" style="list-style: none; padding: 0;">
                            @forelse($evenements as $evt)
                                <li style="display: flex; gap: 1.5rem; align-items: flex-start; padding: 1.5rem 0; border-bottom: 1px solid #e2e4e8; flex-wrap: wrap;">
                                    <div class="card_evnt" style="flex: 0 0 75px; text-align: center; background: var(--uas-couleur-principale, #1f234b); color: #fff; padding: 10px 6px; border-radius: 4px;">
                                        <span class="day" style="display: block; font-size: 1.7rem; font-weight: 700; line-height: 1;">{{ $evt->start_date ? $evt->start_date->format('d') : '15' }}</span>
                                        <span class="month" style="display: block; font-size: 0.8rem; text-transform: uppercase; margin-top: 4px;">{{ $evt->start_date ? $evt->start_date->translatedFormat('M') : 'oct.' }}</span>
                                    </div>
                                    <div style="flex: 1 1 400px;">
                                        <h2 style="margin: 0 0 0.5rem 0; font-size: 1.25rem; color: var(--uas-couleur-principale, #1f234b);">
                                            {{ $evt->title }}
                                        </h2>
                                        @if($evt->location)
                                            <p style="margin: 0 0 0.5rem 0; font-size: 0.85rem; color: #666;">
                                                <strong>Lieu :</strong> {{ $evt->location }}
                                            </p>
                                        @endif
                                        @if($evt->description)
                                            <p style="margin: 0; font-size: 0.95rem; line-height: 1.5; color: #444;">
                                                {{ $evt->description }}
                                            </p>
                                        @endif
                                    </div>
                                </li>
                            @empty
                                <li style="padding: 2rem; text-align: center; color: #666;">
                                    Aucun événement à venir pour le moment.
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                {{-- Pagination --}}
                <div class="pagination-wrapper" style="margin-top: 2rem;">
                    {{ $evenements->links() }}
                </div>

            </div>
        </div>

        <div class="date-miseajour">Mise &agrave; jour :&nbsp;{{ date('d F Y') }}</div>
        <div id="redacteur-date-impression"></div>
    </div>
    <div class="separateur"></div>
</main>
@endsection

