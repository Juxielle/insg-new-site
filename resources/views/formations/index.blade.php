@extends('layouts.app')

@section('title', 'Offre de Formations - BTS, Licences & Masters | INSG Gabon')
@section('meta_description', 'Découvrez les filières et diplômes d\'excellence de l\'INSG Gabon : Finance, Comptabilité, Contrôle & Audit, Marketing, Commerce International, Management des RH.')

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Formations' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_sans_encadres" class="contenu" role="main">
                <h1>Nos Formations d'Excellence</h1>

                <div class="ligne_1">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--0">
                                <div class="paragraphe__contenu--0 toolbox">
                                    <p class="chapo">L'Institut National des Sciences de Gestion propose un éventail complet de diplômes d'État et de titres professionnels homologués, orientés vers l'employabilité immédiate, l'éthique managériale et la performance en entreprise.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Filter & Search Form --}}
                <div class="recherche-formations-bar">
                    <form action="{{ route('formations.index') }}" method="get" class="recherche-bar-form">
                        <div class="recherche-bar-form__input">
                            <input type="text" name="q" value="{{ request('q') ?? request('search') }}" placeholder="Rechercher une formation..." aria-label="Rechercher une formation" />
                        </div>

                        <div class="recherche-bar-form__select">
                            <span class="select_style">
                                <select name="niveau" id="niveau" aria-label="Filtrer par niveau">
                                    <option value="">Tous les niveaux</option>
                                    @foreach($niveaux as $niv)
                                        @if($niv)
                                            <option value="{{ $niv }}" {{ (request('niveau') == $niv || request('level') == $niv) ? 'selected' : '' }}>{{ $niv }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </span>
                        </div>

                        <div class="recherche-bar-form__select">
                            <span class="select_style">
                                <select name="departement" id="departement" aria-label="Filtrer par département">
                                    <option value="">Tous les départements</option>
                                    @foreach($departements as $dept)
                                        @if($dept)
                                            <option value="{{ $dept }}" {{ (request('departement') == $dept || request('department') == $dept) ? 'selected' : '' }}>{{ $dept }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </span>
                        </div>

                        <div class="recherche-bar-form__actions">
                            <button type="submit" class="button">
                                <span>Rechercher</span>
                            </button>
                            @if(request('q') || request('niveau') || request('departement') || request('level') || request('search'))
                                <a href="{{ route('formations.index') }}" class="recherche-bar-form__reset">Réinitialiser</a>
                            @endif
                        </div>
                    </form>
                </div>

                {{-- Level quick tabs --}}
                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 2rem;">
                    <a href="{{ route('formations.index') }}" style="padding: 6px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; text-decoration: none; {{ (!request('niveau') && !request('level')) ? 'background: var(--uas-couleur-principale, #1f234b); color: #fff;' : 'background: #eef0f4; color: #333;' }}">
                        Toutes les formations
                    </a>
                    <a href="{{ route('formations.index', ['level' => 'Licence']) }}" style="padding: 6px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; text-decoration: none; {{ (request('niveau') == 'Licence' || request('level') == 'Licence') ? 'background: var(--uas-couleur-principale, #1f234b); color: #fff;' : 'background: #eef0f4; color: #333;' }}">
                        Licences Professionnelles (Bac+3)
                    </a>
                    <a href="{{ route('formations.index', ['level' => 'Master']) }}" style="padding: 6px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; text-decoration: none; {{ (request('niveau') == 'Master' || request('level') == 'Master') ? 'background: var(--uas-couleur-principale, #1f234b); color: #fff;' : 'background: #eef0f4; color: #333;' }}">
                        Masters Spécialisés (Bac+5)
                    </a>
                    <a href="{{ route('formations.index', ['level' => 'BTS']) }}" style="padding: 6px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; text-decoration: none; {{ (request('niveau') == 'BTS' || request('level') == 'BTS') ? 'background: var(--uas-couleur-principale, #1f234b); color: #fff;' : 'background: #eef0f4; color: #333;' }}">
                        BTS (Bac+2)
                    </a>
                </div>

                {{-- Formations Grid --}}
                @if($formations->count() > 0)
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(310px, 1fr)); gap: 1.75rem;">
                        @foreach($formations as $formation)
                            <x-card-formation :formation="$formation" />
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="pagination-wrapper" style="margin-top: 2.5rem;">
                        {{ $formations->links() }}
                    </div>
                @else
                    <div style="background: #fff; border: 1px dashed #ccc; padding: 2rem; text-align: center; border-radius: 6px; margin: 2rem 0;">
                        <p style="font-size: 1.1rem; color: #555; margin: 0 0 1rem 0;">Aucune formation ne correspond aux critères sélectionnés.</p>
                        <a href="{{ route('formations.index') }}" class="button" style="display: inline-block;">Voir toutes les formations</a>
                    </div>
                @endif

                {{-- Admission Callout --}}
                <div style="background: linear-gradient(135deg, var(--uas-couleur-principale, #1f234b) 0%, #151834 100%); color: #fff; padding: 2rem; border-radius: 8px; margin-top: 3.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
                    <div>
                        <h2 style="color: #fff; margin: 0 0 0.5rem 0; font-size: 1.35rem;">Prêt à intégrer l'INSG Gabon ?</h2>
                        <p style="color: rgba(255,255,255,0.85); margin: 0; font-size: 0.95rem;">Consultez les dates des concours d'entrée, les conditions d'admission et le dossier de candidature.</p>
                    </div>
                    <div>
                        <a href="{{ route('admissions') }}" class="button" style="background: #fff; color: var(--uas-couleur-principale, #1f234b); font-weight: 700; border: none; padding: 0.75rem 1.5rem;">
                            Modalités d'admission &rarr;
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <div class="date-miseajour">Mise &agrave; jour :&nbsp;{{ date('d F Y') }}</div>
        <div id="redacteur-date-impression"></div>
    </div>
    <div class="separateur"></div>
</main>
@endsection

