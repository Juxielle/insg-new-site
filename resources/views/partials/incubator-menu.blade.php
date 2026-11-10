<li class="menu__level__item item__level--0 menu__level__item--first-column">
    <button class="libelle" type="button" data-toggle="[data-toggle-id='INS-INCUBATEUR']" data-toggle-group="menus">Incubateur</button>
    <button class="toggler" data-toggle="[data-toggle-id='INS-INCUBATEUR']" data-toggle-group="menus-toggler" type="button" aria-label="Afficher les sous-menus Incubateur">
        <span class="icon-expand_more more"></span>
        <span class="icon-expand_less less"></span>
    </button>
    <div class="menu__level menu__level--1" data-toggle-id="INS-INCUBATEUR">
        <div><div class="menu__level__items"><ul>
            @foreach(json_decode(file_get_contents(resource_path('content/incubateur.json')), true) as $slug => $page)
                <li class="menu__level__item item__level--1 menu__level__item--first-column">
                    <a class="libelle link type_rubrique_0001" href="{{ route('incubateur.page', $slug) }}">{{ $page['label'] }}</a>
                </li>
            @endforeach
        </ul></div></div>
    </div>
</li>
