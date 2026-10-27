@props(['actualite'])

<li class="avec_vignette">
    <div class="vignette_deco">
        <a href="{{ route('actualites.show', $actualite->slug) }}">
            <img class="vignette" src="{{ $actualite->image_url }}" alt="{{ $actualite->title }}">
        </a>
    </div>
    <div class="vignette_deco2">
        <strong>
            <a href="{{ route('actualites.show', $actualite->slug) }}" class="lien_interne">
                {{ $actualite->title }}
            </a>
        </strong>
        @if($actualite->published_at)
            <div class="date">
                <span class="date--debut">{{ $actualite->published_at->translatedFormat('d F Y') }}</span>
                @if($actualite->category) &ndash; <span class="rubrique_actualite">{{ $actualite->category }}</span> @endif
            </div>
        @endif
        <p>{{ $actualite->excerpt ?? Str::limit(strip_tags($actualite->content), 140) }}</p>
    </div>
</li>
