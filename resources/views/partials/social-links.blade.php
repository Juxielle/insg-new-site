<div class="reseaux-sociaux">
    <h2>Suivez-nous</h2>
    <ul class="reseaux-sociaux__liste">
        @foreach(config('social_networks') as $network)
            <li class="reseaux-sociaux__item">
                <a href="{{ $network['url'] }}" target="_blank" rel="noopener noreferrer" class="reseaux-sociaux__type-rubrique_0004" title="{{ $network['label'] }} de l’INSG (nouvel onglet)">
                    <img src="{{ asset($network['icon']) }}" alt="{{ $network['label'] }}" style="width: auto; height: 32px;" />
                </a>
            </li>
        @endforeach
    </ul>
</div>
