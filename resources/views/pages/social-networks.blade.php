@extends('layouts.app')

@section('title', 'Réseaux sociaux officiels de l’INSG')
@section('content')
<main id="page"><div id="page_deco">
    @include('partials.banner', ['breadcrumbs' => ['Réseaux sociaux' => '']])
    <div id="contenu-encadres"><div id="avec_nav_sans_encadres" class="contenu" role="main">
        <h1>Les réseaux sociaux officiels de l’INSG</h1>
        <div class="ligne_1"><div class="colonne_1"><div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
            <p class="chapo">Retrouvez les actualités de l’INSG sur ses comptes officiels.</p>
            <ul>
                @foreach(config('social_networks') as $network)
                    <li><a class="lien_externe" href="{{ $network['url'] }}" target="_blank" rel="noopener noreferrer">{{ $network['label'] }}</a></li>
                @endforeach
            </ul>
        </div></div></div></div></div>
    </div></div>
</div><div class="separateur"></div></main>
@endsection
