import urllib.request
import re

urls = [
    '/',
    '/a-propos',
    '/campus',
    '/admissions',
    '/entreprises-et-partenaires',
    '/formations',
    '/actualites',
    '/evenements',
    '/contact',
    '/faculte-de-droit',
    '/iaelyon-school-of-management',
    '/achat-management-industriel-qualite',
    '/alternance',
    '/assurance-banque',
    '/histoire',
    '/gouvernance',
    '/organisation',
    '/chiffres-cles',
]

base = 'http://insg-gabon2.test'

print(f"{'URL':40} | {'Status':6} | {'#page':5} | {'#deco':5} | {'#zone':5} | {'#contenu':8} | {'#menu_sec':9}")
print("-" * 90)

for u in urls:
    full_url = base + u
    try:
        req = urllib.request.Request(full_url, headers={'User-Agent': 'Mozilla/5.0'})
        with urllib.request.urlopen(req, timeout=10) as resp:
            code = resp.getcode()
            html = resp.read().decode('utf-8', errors='ignore')
            has_page = 'id="page"' in html
            has_deco = 'id="page_deco"' in html
            has_zone = 'id="zone_navigation"' in html
            has_contenu = 'id="contenu-encadres"' in html
            has_menu_sec = 'id="menu_secondaire"' in html
            print(f"{u:40} | {code:6} | {str(has_page):5} | {str(has_deco):5} | {str(has_zone):5} | {str(has_contenu):8} | {str(has_menu_sec):9}")
    except Exception as e:
        print(f"{u:40} | ERROR: {e}")

