@props(['formation'])

<li class="avec_vignette">
    <div class="vignette_deco">
        <a href="{{ route('formations.show', $formation->slug) }}">
            <img class="vignette" src="{{ $formation->image_url }}" alt="{{ $formation->title }}">
        </a>
    </div>
    <div class="vignette_deco2">
        <strong>
            <a href="{{ route('formations.show', $formation->slug) }}" class="lien_interne">
                {{ $formation->title }}
            </a>
        </strong>
        <div class="date">
            <span class="rubrique_actualite">{{ $formation->level }}</span>
            @if($formation->department) &ndash; {{ $formation->department }} @endif
            @if($formation->duration) &ndash; {{ $formation->duration }} @endif
        </div>
        <p>{{ Str::limit(strip_tags($formation->description), 140) }}</p>
    </div>
</li>
