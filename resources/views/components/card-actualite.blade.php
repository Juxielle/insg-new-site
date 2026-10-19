@props(['actualite'])

<li class="avec_vignette actualite-item-card" style="list-style: none; margin-bottom: 2rem; border-bottom: 1px solid #e2e4e8; padding-bottom: 1.5rem; display: flex; gap: 1.5rem; align-items: flex-start; flex-wrap: wrap;">
    <div class="vignette_deco" style="flex: 0 0 240px; max-width: 100%;">
        <a href="{{ route('actualites.show', $actualite->slug) }}">
            <img class="vignette" src="{{ $actualite->image_url }}" alt="{{ $actualite->title }}" style="width: 100%; height: 160px; object-fit: cover; border-radius: 4px; display: block;">
        </a>
    </div>
    <div class="vignette_deco2" style="flex: 1 1 320px;">
        @if($actualite->category)
            <span class="actualite-badge" style="display: inline-block; background-color: var(--uas-couleur-principale, #1f234b); color: #fff; font-size: 0.75rem; text-transform: uppercase; font-weight: 600; padding: 2px 8px; border-radius: 3px; margin-bottom: 0.5rem;">
                {{ $actualite->category }}
            </span>
        @endif
        
        <h3 style="margin: 0.25rem 0 0.5rem 0; font-size: 1.25rem; line-height: 1.3;">
            <a href="{{ route('actualites.show', $actualite->slug) }}" class="lien_interne" style="color: var(--uas-couleur-principale, #1f234b); text-decoration: none; font-weight: 700;">
                {{ $actualite->title }}
            </a>
        </h3>

        @if($actualite->published_at)
            <div class="date" style="font-size: 0.85rem; color: #767676; margin-bottom: 0.75rem;">
                <span class="date--debut">{{ $actualite->formatted_date }}</span>
            </div>
        @endif

        <p class="actualite-excerpt" style="font-size: 0.95rem; line-height: 1.5; color: #444; margin: 0 0 1rem 0;">
            {{ $actualite->excerpt ?? Str::limit(strip_tags($actualite->content), 140) }}
        </p>

        <a href="{{ route('actualites.show', $actualite->slug) }}" class="en_savoir_plus" style="display: inline-block; font-weight: 600; font-size: 0.9rem; color: var(--uas-couleur-principale, #1f234b);">
            Lire l'article &rarr;
        </a>
    </div>
</li>

