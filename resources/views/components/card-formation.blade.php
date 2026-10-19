@props(['formation'])

<div class="formation-card" style="background: #ffffff; border: 1px solid #e2e4e8; border-radius: 6px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.04); transition: transform 0.2s ease, box-shadow 0.2s ease; display: flex; flex-direction: column;">
    <div style="height: 140px; background-size: cover; background-position: center; position: relative; background-image: url('{{ $formation->image_url }}');">
        <div style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(31,35,75,0.75) 100%);"></div>
        <div style="position: absolute; top: 12px; left: 12px; display: flex; gap: 8px;">
            <span style="background: var(--uas-couleur-accent, #0091B5); color: #fff; font-size: 0.75rem; font-weight: 700; padding: 3px 8px; border-radius: 3px; text-transform: uppercase;">
                {{ $formation->level }}
            </span>
        </div>
        <div style="position: absolute; bottom: 10px; left: 12px; right: 12px;">
            <span style="color: rgba(255,255,255,0.9); font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                {{ $formation->department }}
            </span>
        </div>
    </div>
    <div style="padding: 1.25rem; flex: 1 1 auto; display: flex; flex-direction: column; justify-content: space-between;">
        <div>
            <h3 style="margin: 0 0 0.75rem 0; font-size: 1.15rem; line-height: 1.35;">
                <a href="{{ route('formations.show', $formation->slug) }}" style="color: var(--uas-couleur-principale, #1f234b); text-decoration: none; font-weight: 700;">
                    {{ $formation->title }}
                </a>
            </h3>

            @if($formation->duration)
                <p style="font-size: 0.85rem; color: #666; margin: 0 0 0.75rem 0; display: flex; align-items: center; gap: 6px;">
                    <strong>Durée :</strong> {{ $formation->duration }}
                </p>
            @endif

            <p style="font-size: 0.9rem; color: #555; line-height: 1.45; margin: 0 0 1rem 0;">
                {{ Str::limit(strip_tags($formation->description), 120) }}
            </p>
        </div>

        <div style="border-top: 1px solid #f0f1f4; padding-top: 0.75rem; margin-top: auto; display: flex; align-items: center; justify-content: space-between;">
            <span style="font-size: 0.8rem; color: #888;">
                {{ $formation->is_featured ? '⭐ Formation d\'excellence' : 'Filière accréditée' }}
            </span>
            <a href="{{ route('formations.show', $formation->slug) }}" class="btn-consulter" style="color: var(--uas-couleur-principale, #1f234b); font-weight: 700; font-size: 0.85rem; text-decoration: none;">
                Consulter &rarr;
            </a>
        </div>
    </div>
</div>

