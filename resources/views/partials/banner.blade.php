<div id="zone_navigation" class="clearfix">
    <div id="menu_secondaire" class="menu_toggle">
        <button class="toggle__menu_secondaire" data-toggle="[data-toggle-id='menusecondaire']" type="button" aria-label="Menu secondaire"></button>
        <ul data-toggle-id="menusecondaire" class="menu_toggle__menu menu__lvl1" data-toggle-target>
            <li class="{{ Route::is('about') ? 'menu_secondaire-actif' : '' }}">
                <a href="{{ route('about') }}" class="type_rubrique_0001">L'Institut</a>
            </li>
            <li class="{{ Route::is('formations.*') ? 'menu_secondaire-actif' : '' }}">
                <a href="{{ route('formations.index') }}" class="type_rubrique_0001">Formations</a>
            </li>
            <li class="{{ Route::is('admissions') ? 'menu_secondaire-actif' : '' }}">
                <a href="{{ route('admissions') }}" class="type_rubrique_0001">Admissions</a>
            </li>
            <li class="{{ Route::is('campus') ? 'menu_secondaire-actif' : '' }}">
                <a href="{{ route('campus') }}" class="type_rubrique_0001">Campus Libreville</a>
            </li>
            <li class="{{ Route::is('vie-associative') ? 'menu_secondaire-actif' : '' }}">
                <a href="{{ route('vie-associative') }}" class="type_rubrique_0001">Vie Associative</a>
            </li>
            <li class="{{ Route::is('entreprises') ? 'menu_secondaire-actif' : '' }}">
                <a href="{{ route('entreprises') }}" class="type_rubrique_0001">Entreprises &amp; Partenaires</a>
            </li>
            <li class="{{ Route::is('actualites.*') ? 'menu_secondaire-actif' : '' }}">
                <a href="{{ route('actualites.index') }}" class="type_rubrique_0001">Actualités</a>
            </li>
            <li class="{{ Route::is('contact') ? 'menu_secondaire-actif' : '' }}">
                <a href="{{ route('contact') }}" class="type_rubrique_0001">Contact</a>
            </li>
        </ul>
    </div>

    <p id="fil_ariane">
        <a href="{{ route('home') }}">Accueil</a>
        @if(isset($breadcrumbs) && is_array($breadcrumbs))
            @foreach($breadcrumbs as $label => $link)
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

