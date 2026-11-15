@php($photo = \App\Support\PhotoLibrary::photo($theme, $photoIndex ?? 0))
<figure class="photo" style="margin: 1.5em 0;">
    <img src="{{ asset($photo['path']) }}" alt="{{ $caption }}" width="{{ $photo['width'] }}" height="{{ $photo['height'] }}" loading="lazy" style="display: block; width: 100%; height: auto; max-height: 440px; object-fit: cover;" />
    <figcaption class="legende">{{ $caption }}</figcaption>
</figure>
