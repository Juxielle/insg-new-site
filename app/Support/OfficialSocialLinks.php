<?php

namespace App\Support;

class OfficialSocialLinks
{
    /** Normalize institutional profile links without changing article-sharing tools or third-party accounts. */
    public static function normalize(string $html): string
    {
        return preg_replace_callback('~\bhref=([\'"])([^\'"]+)\1~i', function ($match) {
            $url = html_entity_decode($match[2], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            if (preg_match('~/(?:sharer|shareArticle|sharing/share-offsite|intent/|sharer\.php)~i', $url)) {
                return $match[0];
            }
            $network = null;
            if (preg_match('~^/?(facebook|instagram|linkedin|whatsapp|twitter|x)(?:\.html)?/?$~i', $url, $local)) {
                $network = strtolower($local[1]);
            } elseif (preg_match('~^https?://(?:www\.)?(facebook\.com|instagram\.com|linkedin\.com|twitter\.com|x\.com|whatsapp\.com)(/.*)?$~i', $url, $external)) {
                $path = $external[2] ?? '';
                $institutional = $path === '' || $path === '/' || preg_match('~insg|campusbourg|incubateurmanufactory|FC3FormationProfessionnelleContinue|/admin/dashboard|/company/baip-~i', $path);
                if ($institutional) {
                    $network = explode('.', strtolower($external[1]))[0];
                }
            }
            $network = $network === 'twitter' ? 'x' : $network;
            $profile = $network ? config('social_networks.'.$network) : null;

            return $profile ? 'href='.$match[1].htmlspecialchars($profile['url'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8').$match[1] : $match[0];
        }, $html);
    }
}
