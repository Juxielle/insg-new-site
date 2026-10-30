@php
    $currentRoute = Route::currentRouteName() ?? '';
    $currentPath = trim(request()->path(), '/');

    // Determine current rubric / section
    $rubric = 'general';
    if (Route::is('about') || in_array($currentPath, ['a-propos', 'histoire', 'gouvernance', 'organisation', 'chiffres-cles', 'grands-projets', 'fondation', 'textes-statutaires', 'conseils', 'arretes', 'equipe-presidentielle'])) {
        $rubric = 'institut';
    } elseif (Route::is('formations.*') || Route::is('admissions') || in_array($currentPath, ['formations', 'admissions', 'candidater-et-s-inscrire', 'alternance', 'orientation-insertion-professionnelle'])) {
        $rubric = 'formations';
    } elseif (Route::is('campus') || Route::is('vie-associative') || in_array($currentPath, ['campus', 'vie-associative', 'culture-1', 'sport-1', 'sante-social', 'restauration', 'transports', 'logement'])) {
        $rubric = 'campus';
    } elseif (Route::is('entreprises') || in_array($currentPath, ['entreprises', 'entreprises-et-partenaires', 'former-ses-collaborateurs', 'recruter-ses-collaborateurs', 'verser-la-taxe-dapprentissage', 'marches-publics'])) {
        $rubric = 'entreprises';
    } elseif (Route::is('actualites.*') || Route::is('evenements.*') || in_array($currentPath, ['actualites', 'evenements', 'projet-detablissement-2021-2026'])) {
        $rubric = 'actualites';
    }
@endphp

<div id="zone_navigation" class="clearfix">
    <div id="menu_secondaire" class="menu_toggle">
        <button class="toggle__menu_secondaire" data-toggle="[data-toggle-id='menusecondaire']" type="button" aria-label="Menu secondaire"></button>
        <ul data-toggle-id="menusecondaire" class="menu_toggle__menu menu__lvl1" data-toggle-target>
            @if($rubric === 'institut')
                <li class="{{ Route::is('about') || $currentPath === 'a-propos' ? 'menu_secondaire-actif' : '' }}">
                    <a href="{{ route('about') }}" class="type_rubrique_0001">L'Institut National des Sciences de Gestion</a>
                    <ul class="menu__lvl2">
                        <li class="{{ $currentPath === 'histoire' ? 'sousmenu_secondaire-actif' : '' }}"><a href="/histoire" class="type_rubrique_0001">Histoire</a></li>
                    </ul>
                </li>
                <li class="{{ $currentPath === 'gouvernance' ? 'menu_secondaire-actif' : '' }}"><a href="/gouvernance" class="type_rubrique_0001">Gouvernance</a></li>
                <li class="{{ $currentPath === 'organisation' ? 'menu_secondaire-actif' : '' }}"><a href="/organisation" class="type_rubrique_0001">Organisation</a></li>
                <li class="{{ $currentPath === 'chiffres-cles' ? 'menu_secondaire-actif' : '' }}"><a href="/chiffres-cles" class="type_rubrique_0001">Chiffres clés</a></li>
                <li class="{{ Route::is('campus') || $currentPath === 'campus' ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('campus') }}" class="type_rubrique_0001">Nos campus</a></li>
                <li class="{{ $currentPath === 'grands-projets' ? 'menu_secondaire-actif' : '' }}"><a href="/grands-projets" class="type_rubrique_0001">Grands projets</a></li>
                <li class="{{ $currentPath === 'fondation' ? 'menu_secondaire-actif' : '' }}"><a href="/fondation" class="type_rubrique_0001">Fondation INSG</a></li>
                <li class="{{ $currentPath === 'textes-statutaires' ? 'menu_secondaire-actif' : '' }}"><a href="/textes-statutaires" class="type_rubrique_0001">Textes statutaires</a></li>
                <li class="{{ Route::is('actualites.*') ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('actualites.index') }}" class="type_rubrique_0001">Actualités</a></li>
            @elseif($rubric === 'formations')
                <li class="{{ Route::is('formations.index') ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('formations.index') }}" class="type_rubrique_0001">Nos formations</a></li>
                <li class="{{ Route::is('admissions') || $currentPath === 'admissions' || $currentPath === 'candidater-et-s-inscrire' ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('admissions') }}" class="type_rubrique_0001">Candidater et s'inscrire</a></li>
                <li class="{{ $currentPath === 'cycle-bts' ? 'menu_secondaire-actif' : '' }}"><a href="/cycle-bts" class="type_rubrique_0001">Cycle BTS Professionnalisant</a></li>
                <li class="{{ request('level') === 'Licence' ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('formations.index', ['level' => 'Licence']) }}" class="type_rubrique_0001">Licences Professionnelles</a></li>
                <li class="{{ request('level') === 'Master' ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('formations.index', ['level' => 'Master']) }}" class="type_rubrique_0001">Masters Professionnels & MBA</a></li>
                <li class="{{ $currentPath === 'alternance' ? 'menu_secondaire-actif' : '' }}"><a href="/alternance" class="type_rubrique_0001">Formation Continue & Alternance</a></li>
                <li class="{{ $currentPath === 'orientation-insertion-professionnelle' ? 'menu_secondaire-actif' : '' }}"><a href="/orientation-insertion-professionnelle" class="type_rubrique_0001">Orientation & Insertion</a></li>
            @elseif($rubric === 'campus')
                <li class="{{ Route::is('campus') || $currentPath === 'campus' ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('campus') }}" class="type_rubrique_0001">Nos campus</a></li>
                <li class="{{ Route::is('vie-associative') || $currentPath === 'vie-associative' ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('vie-associative') }}" class="type_rubrique_0001">Vie associative & Clubs</a></li>
                <li class="{{ $currentPath === 'culture-1' ? 'menu_secondaire-actif' : '' }}"><a href="/culture-1" class="type_rubrique_0001">Culture</a></li>
                <li class="{{ $currentPath === 'sport-1' ? 'menu_secondaire-actif' : '' }}"><a href="/sport-1" class="type_rubrique_0001">Sport</a></li>
                <li class="{{ $currentPath === 'sante-social' ? 'menu_secondaire-actif' : '' }}"><a href="/sante-social" class="type_rubrique_0001">Santé & Social</a></li>
                <li class="{{ $currentPath === 'restauration' ? 'menu_secondaire-actif' : '' }}"><a href="/restauration" class="type_rubrique_0001">Restauration</a></li>
                <li class="{{ $currentPath === 'logement' ? 'menu_secondaire-actif' : '' }}"><a href="/logement" class="type_rubrique_0001">Logement</a></li>
                <li class="{{ $currentPath === 'transports' ? 'menu_secondaire-actif' : '' }}"><a href="/transports" class="type_rubrique_0001">Transports</a></li>
            @elseif($rubric === 'entreprises')
                <li class="{{ Route::is('entreprises') || $currentPath === 'entreprises' || $currentPath === 'entreprises-et-partenaires' ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('entreprises') }}" class="type_rubrique_0001">Relations Entreprises & Partenariats</a></li>
                <li class="{{ $currentPath === 'former-ses-collaborateurs' ? 'menu_secondaire-actif' : '' }}"><a href="/former-ses-collaborateurs" class="type_rubrique_0001">Former ses collaborateurs</a></li>
                <li class="{{ $currentPath === 'recruter-ses-collaborateurs' ? 'menu_secondaire-actif' : '' }}"><a href="/recruter-ses-collaborateurs" class="type_rubrique_0001">Recruter ses collaborateurs</a></li>
                <li class="{{ $currentPath === 'verser-la-taxe-dapprentissage' ? 'menu_secondaire-actif' : '' }}"><a href="/verser-la-taxe-dapprentissage" class="type_rubrique_0001">Verser la taxe d'apprentissage</a></li>
                <li class="{{ $currentPath === 'marches-publics' ? 'menu_secondaire-actif' : '' }}"><a href="/marches-publics" class="type_rubrique_0001">Marchés Publics</a></li>
            @elseif($rubric === 'actualites')
                <li class="{{ Route::is('actualites.*') ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('actualites.index') }}" class="type_rubrique_0001">Toute l'actualité</a></li>
                <li class="{{ Route::is('evenements.*') ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('evenements.index') }}" class="type_rubrique_0001">Agenda & Événements</a></li>
                <li class="{{ $currentPath === 'projet-detablissement-2021-2026' ? 'menu_secondaire-actif' : '' }}"><a href="/projet-detablissement-2021-2026" class="type_rubrique_0001">Projet d'établissement 2021-2026</a></li>
            @else
                <li class="{{ Route::is('about') ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('about') }}" class="type_rubrique_0001">L'Institut</a></li>
                <li class="{{ Route::is('formations.*') ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('formations.index') }}" class="type_rubrique_0001">Formations</a></li>
                <li class="{{ Route::is('admissions') ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('admissions') }}" class="type_rubrique_0001">Admissions</a></li>
                <li class="{{ Route::is('campus') ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('campus') }}" class="type_rubrique_0001">Campus Libreville</a></li>
                <li class="{{ Route::is('vie-associative') ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('vie-associative') }}" class="type_rubrique_0001">Vie Associative</a></li>
                <li class="{{ Route::is('entreprises') ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('entreprises') }}" class="type_rubrique_0001">Entreprises &amp; Partenaires</a></li>
                <li class="{{ Route::is('actualites.*') ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('actualites.index') }}" class="type_rubrique_0001">Actualités</a></li>
                <li class="{{ Route::is('contact') ? 'menu_secondaire-actif' : '' }}"><a href="{{ route('contact') }}" class="type_rubrique_0001">Contact</a></li>
            @endif
        </ul>
    </div>

    <p id="fil_ariane">
        <a href="{{ route('home') }}">Accueil</a>
        @if(isset($breadcrumbs) && is_array($breadcrumbs))
            @foreach($breadcrumbs as $label => $link)
                <span class="separateur">&gt;</span>
                @if(!$loop->last && $link)
                    <a href="{{ $link }}">{{ $label }}</a>
                @else
                    <span>{{ is_string($label) && !is_numeric($label) ? $label : $link }}</span>
                @endif
            @endforeach
        @endif
    </p>

    <ul id="actions-fiche" class="actions-fiche">
        <li class="actions-fiche__item actions-fiche__item--print">
            <button title="Imprimer" onclick="window.print(); return false;">
                <span aria-hidden="true" class="icon icon-print"></span>
                <span class="actions-fiche__libelle">Imprimer</span>
            </button>
        </li>
    </ul>
</div>
