<?php

namespace App\Support;

use Illuminate\Support\Str;

class PhotoLibrary
{
    public static function all(): array
    {
        static $photos;

        return $photos ??= json_decode(file_get_contents(resource_path('content/phototheque-insg.json')), true, 512, JSON_THROW_ON_ERROR);
    }

    public static function photo(string $theme, int $index = 0): array
    {
        $photos = self::all()[$theme] ?? self::all()['institution'];

        return $photos[$index % count($photos)];
    }

    public static function theme(string $context): string
    {
        $context = strtolower(Str::ascii($context));
        return match (true) {
            str_contains($context, 'incubateur/recherche') => 'recherche',
            (bool) preg_match('/agro|\bmea\b|gemp|mines-et-petrole/', $context) => 'agroalimentaire',
            (bool) preg_match('/intelligence|artificielle|numerique|digital/', $context) => 'intelligence-artificielle',
            (bool) preg_match('/informatique|laboratoire|inauguration|salles-connectees/', $context) => 'laboratoire',
            (bool) preg_match('/sport|tournoi|football/', $context) => 'sport',
            (bool) preg_match('/incubat|entrepren|bourg-en-bresse/', $context) => 'incubateur',
            (bool) preg_match('/magt|moov/', $context) => 'partenariat-magt',
            (bool) preg_match('/diplom|laureat|alumni/', $context) => 'diplomes',
            (bool) preg_match('/admission|concours|inscription|orientation|portes-ouvertes/', $context) => 'orientation',
            (bool) preg_match('/integration|vie-|associati|culture|restauration|logement|sante-social/', $context) => 'vie-etudiante',
            (bool) preg_match('/entrepris|partenair|partenariat|recrut|emploi|stage|commerce|marketing|commercial|affaires-internationales/', $context) => 'entreprises',
            (bool) preg_match('/recherche|colloque|science-ouverte|cooperation|international/', $context) => 'recherche',
            (bool) preg_match('/formation|cycle|gestion-appliquee|conference|bibliotheque/', $context) => 'conferences',
            (bool) preg_match('/campus|infrastructure|plan-d-acces/', $context) => 'campus',
            default => 'institution',
        };
    }

    public static function forContext(string $context, int $index = 0): string
    {
        return self::photo(self::theme($context), $index)['path'];
    }

    /** Replace only the old generic photographs; retain icons, logos and named portraits. */
    public static function replaceLegacyPhotos(string $html, string $context): string
    {
        $index = 0;
        return preg_replace_callback(
            '~(?:/?assets/images/)(?:insg-back-\d+\.jpeg|175979157\d+\.jpg\.jpeg|rentree\.png)~',
            function () use ($context, &$index) {
                return '/'.self::forContext($context, $index++);
            },
            $html
        );
    }
}
