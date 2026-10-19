<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SafeSvg implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || trim($value) === '') {
            return;
        }

        $dangerous = '/<(script|foreignObject|iframe|object|embed|style)\b|\bon\w+\s*=|\b(?:href|xlink:href)\s*=|javascript:|data:|url\s*\(/i';
        if (preg_match($dangerous, $value)) {
            $fail('Le fichier SVG sélectionné contient du contenu non autorisé.');

            return;
        }

        preg_match_all('/<\/?\s*([a-zA-Z][\w:-]*)\b/', $value, $matches);
        if ($matches[1] === []) {
            $fail('Veuillez sélectionner ou importer une icône SVG valide.');

            return;
        }
        $allowed = ['svg', 'g', 'path', 'rect', 'circle', 'ellipse', 'line', 'polyline', 'polygon'];
        foreach ($matches[1] as $tag) {
            if (! in_array(strtolower($tag), $allowed, true)) {
                $fail('Le fichier ne contient pas un SVG pris en charge.');

                return;
            }
        }
    }
}
