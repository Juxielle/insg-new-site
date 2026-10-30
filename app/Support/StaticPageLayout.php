<?php

namespace App\Support;

use DOMDocument;
use DOMNode;
use DOMXPath;

class StaticPageLayout
{
    /** Restore the layout metadata lost when importing only a document's main. */
    public static function extract(string $html): array
    {
        $document = new DOMDocument;
        $previous = libxml_use_internal_errors(true);
        try {
            $document->loadHTML('<?xml encoding="UTF-8">'.$html, LIBXML_NONET | LIBXML_NOERROR | LIBXML_NOWARNING);
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previous);
        }
        $xpath = new DOMXPath($document);
        $page = $xpath->query('//*[@id="page"]')->item(0);
        $standard = $page && $xpath->query('.//*[@id="page_deco"]', $page)->length;

        if ($standard) {
            $body = '<main id="page">'.self::children($document, $page).'</main>';
        } else {
            // External templates use other structures; keep their content, not
            // a second document, header, navigation or footer inside our page.
            $content = $xpath->query('//*[@id="region-main"] | //*[@id="main-wrapper"]')->item(0)
                ?? $page
                ?? $xpath->query('//main | //*[@role="main"]')->item(0)
                ?? $document->getElementsByTagName('body')->item(0);
            if ($content) {
                foreach (iterator_to_array($xpath->query('.//header | .//footer | .//nav | .//script | .//*[@id="pied_page"] | .//*[@id="retour_haut_page"]', $content)) as $extra) {
                    $extra->parentNode?->removeChild($extra);
                }
                foreach (iterator_to_array($xpath->query('.//main', $content)) as $nestedMain) {
                    $section = $document->createElement('div');
                    foreach ($nestedMain->attributes as $attribute) {
                        $section->setAttribute($attribute->name, $attribute->value);
                    }
                    while ($nestedMain->firstChild) {
                        $section->appendChild($nestedMain->firstChild);
                    }
                    $nestedMain->parentNode?->replaceChild($section, $nestedMain);
                }
            }
            $body = '<main id="page"><div id="page_deco"><div id="contenu-encadres">'
                .'<div id="sans_nav_sans_encadres" class="contenu" role="main"><div class="insg-legacy-content">'
                .($content ? self::children($document, $content) : '')
                .'</div></div></div><div class="separateur"></div></div></main>';
        }

        $landing = $standard && str_contains($body, 'layout__simple-grid--siteCom');

        // Per-page proportions were defined in the original head (e.g. 60/40),
        // rather than the shared stylesheet. Restore only these layout rules.
        $widths = [];
        foreach ($xpath->query('//head/style') as $style) {
            preg_match_all('/\.ligne_(\d+)\s*>\s*\.colonne_(\d+)\s*\{\s*width\s*:\s*(\d+(?:\.\d+)?)%\s*;?\s*\}/i', $style->textContent, $matches, PREG_SET_ORDER);
            foreach ($matches as $match) {
                $widths[$match[1].':'.$match[2]] = '#page .ligne_'.$match[1].' > .colonne_'.$match[2].'{width:'.$match[3].'% !important;}';
            }
        }

        return [
            'html' => $body,
            'landing' => $landing,
            'css' => $widths ? '@media screen and (min-width:50em){'.implode('', $widths).'}' : '',
        ];
    }

    private static function children(DOMDocument $document, DOMNode $element): string
    {
        $html = '';
        foreach ($element->childNodes as $child) {
            $html .= $document->saveHTML($child);
        }

        return $html;
    }
}
