import urllib.request
import re

test_urls = [
    # Core Main Routes
    '/',
    '/a-propos',
    '/campus',
    '/admissions',
    '/entreprises-et-partenaires',
    '/formations',
    '/actualites',
    '/evenements',
    '/contact',
    '/vie-associative',

    # Secondary Menu: acces-1 (Départements & Cycles INSG)
    '/faculte-de-droit',
    '/faculte-de-philosophie',
    '/faculte-des-humanites-lettres-et-societes-1',
    '/faculte-des-langues',
    '/iaelyon-school-of-management',
    '/iut-jean-moulin',
    '/laboratoire-de-recherche-historique-rhone-alpes',
    '/centre-lyonnais-d-histoire-du-droit-et-de-la-pensee-politique',
    '/equipe-lyonnaise-en-information-et-communication',
    '/campus-de-bourg-en-bresse',
    '/pole-reussite-3',
    '/bibliotheques-universitaires-3',

    # Secondary Menu: acces-2 (Filières de Gestion INSG)
    '/achat-management-industriel-qualite',
    '/assurance-banque',
    '/entrepreneuriat-innovation',
    '/finance-controle-audit-comptabilite',
    '/gestion',
    '/international-interculturel-langues',
    '/management-ressources-humaines',
    '/marketing-vente',
    '/numerique-systemes-d-information',

    # Main Menu: Key institutional & academic sub-pages
    '/histoire',
    '/gouvernance',
    '/organisation',
    '/chiffres-cles',
    '/grands-projets',
    '/fondation',
    '/textes-statutaires',
    '/alternance',
    '/orientation-insertion-professionnelle',
    '/reussir-ses-etudes',
    '/former-ses-collaborateurs',
    '/recruter-ses-collaborateurs',
]

base = 'http://insg-gabon2.test'

print(f"{'URL':42} | {'HTTP':4} | {'#page':5} | {'#deco':5} | {'#contenu':8} | {'#divs':9} | {'html_links':10}")
print("=" * 95)

all_ok = True

for u in test_urls:
    full_url = base + u
    try:
        req = urllib.request.Request(full_url, headers={'User-Agent': 'Mozilla/5.0'})
        with urllib.request.urlopen(req, timeout=10) as resp:
            code = resp.getcode()
            html = resp.read().decode('utf-8', errors='ignore')
            has_page = 'id="page"' in html
            has_deco = 'id="page_deco"' in html
            has_contenu = 'id="contenu-encadres"' in html
            
            # Count divs inside <main>
            main_m = re.search(r'<main\b[^>]*>(.*?)</main>', html, re.DOTALL)
            if main_m:
                main_chunk = main_m.group(1)
                open_div = main_chunk.count('<div')
                close_div = main_chunk.count('</div')
                div_status = f"{open_div}/{close_div}"
                is_balanced = (open_div == close_div)
            else:
                div_status = "no_main"
                is_balanced = False

            # Check if any .html links remain inside <main>
            raw_html_links = re.findall(r'href=[\'"][a-zA-Z0-9_\-]+\.html[\'"]', main_chunk if main_m else html)
            html_link_count = len(raw_html_links)

            status_char = "OK" if (code == 200 and has_page and has_deco and has_contenu and is_balanced and html_link_count == 0) else "WARN"
            if status_char != "OK":
                all_ok = False

            print(f"{u:42} | {code:4} | {str(has_page):5} | {str(has_deco):5} | {str(has_contenu):8} | {div_status:9} | {html_link_count:10} | {status_char}")
    except Exception as e:
        print(f"{u:42} | ERROR: {e}")
        all_ok = False

print("=" * 95)
print(f"Overall Result: {'ALL PAGES PERFECT' if all_ok else 'SOME WARNINGS DETECTED'}")

