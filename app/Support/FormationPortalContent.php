<?php

namespace App\Support;

use DOMDocument;
use DOMXPath;

class FormationPortalContent
{
    /** Reuse the imported portal shell, images and widgets with reviewed course information. */
    public static function apply(string $html, string $slug): string
    {
        $selection = match ($slug) {
            'departement-gestion-appliquee' => ['department', 'Gestion Appliquée (GA)', 'Département Gestion Appliquée (GA)'],
            'departement-marketing-affaires-internationales' => ['department', 'Marketing et Affaires Internationales (MAI)', 'Département Marketing et Affaires Internationales (MAI)'],
            'cycle-bts' => ['level', 'BTS', 'Cycle BTS'],
            'cycle-master' => ['masters', '', 'Cycle Master Professionnel et Recherche'],
            default => null,
        };
        if (! $selection) {
            return $html;
        }
        $groups = array_values(array_filter(InitialFormationCatalogue::data()['groups'], fn ($group) =>
            $selection[0] === 'masters'
                ? in_array($group['level'], ['Master Pro', 'Master Recherche'])
                : $group[$selection[0]] === $selection[1]
        ));
        $document = new DOMDocument;
        @$document->loadHTML('<?xml encoding="UTF-8">'.$html, LIBXML_NONET | LIBXML_NOERROR | LIBXML_NOWARNING);
        $xpath = new DOMXPath($document);
        $heading = $xpath->query('//main//h1')->item(0);
        if ($heading) {
            $heading->nodeValue = $selection[2];
        }
        $hero = $xpath->query('//*[contains(concat(" ", normalize-space(@class), " "), " carousellyon3Card ")]')->item(0);
        if ($hero) {
            foreach ($xpath->query('.//h2', $hero) as $i => $title) {
                $group = $groups[$i % count($groups)];
                $title->nodeValue = $group['label'];
            }
            foreach ($xpath->query('.//p', $hero) as $paragraph) {
                $paragraph->nodeValue = 'Découvrez les parcours de formation initiale de l’INSG et préparez votre candidature.';
            }
            foreach ($xpath->query('.//a', $hero) as $link) {
                $link->setAttribute('href', '#formations-initiales');
            }
        }
        // Keep the mosaic design while replacing the imported institution's figures.
        $figures = [
            ['2', 'départements — formation initiale'], ['26', 'parcours — formation initiale'],
            ['5', 'filières BTS — formation initiale'], ['6', 'Licences professionnelles classiques'],
            ['6', 'Licences double compétence'], ['3', 'parcours de Licence fondamentale'],
            ['5', 'Masters professionnels — formation initiale'], ['1', 'Master Recherche avec l’UOB'],
            ['UOB', 'partenaire du Master Recherche'],
        ];
        foreach ($xpath->query('//*[contains(concat(" ", normalize-space(@class), " "), " galerie_bloc_wrapper ")]/a[strong]') as $i => $tile) {
            [$value, $label] = $figures[$i % count($figures)];
            $xpath->query('./strong', $tile)->item(0)->nodeValue = $value;
            $caption = $xpath->query('./span', $tile)->item(0);
            if ($caption) {
                $caption->nodeValue = $label;
            }
            $tile->setAttribute('href', '/formations');
        }
        // The existing grid and carousel remain in place. Add the catalogue in a full-width editorial row.
        $grid = $xpath->query('//*[contains(concat(" ", normalize-space(@class), " "), " layout__simple-grid--siteCom ")]')->item(0);
        if ($grid) {
            $row = $document->createElement('div');
            $row->setAttribute('class', 'layout__simple-grid__row insg-initial-catalogue');
            $fragmentDocument = new DOMDocument;
            $catalogueTitle = $selection[2];
            @$fragmentDocument->loadHTML('<?xml encoding="UTF-8"><div id="catalogue-fragment" class="layout__simple-grid__row_wrapper clearfix">'.view('formations.initial-catalogue', compact('groups', 'catalogueTitle'))->render().'</div>', LIBXML_NONET | LIBXML_NOERROR | LIBXML_NOWARNING);
            $row->appendChild($document->importNode($fragmentDocument->getElementById('catalogue-fragment'), true));
            $firstRow = $xpath->query('./div', $grid)->item(0);
            $grid->insertBefore($row, $firstRow?->nextSibling);
        }
        $main = $document->getElementsByTagName('main')->item(0);

        return $main ? $document->saveHTML($main) : $html;
    }
}
