import urllib.request
import re

urls = [
    '/',
    '/a-propos',
    '/campus',
    '/admissions',
    '/entreprises-et-partenaires',
    '/formations',
    '/formations/licence-professionnelle-finance-comptabilite',
    '/actualites',
    '/actualites/ceremonie-de-remise-des-diplomes-promotion-2025-2026',
    '/evenements',
    '/evenements/journee-portes-ouvertes-2026',
    '/contact',
    '/vie-associative',
    '/histoire',
    '/gouvernance',
    '/organisation',
    '/chiffres-cles',
    '/alternance',
    '/faculte-de-droit',
]

base = 'http://insg-gabon2.test'

print(f"{'URL':55} | {'Status':6} | {'Encadres':8} | {'H1':3} | {'Images missing src':18}")
print("-" * 105)

for u in urls:
    try:
        req = urllib.request.Request(base + u, headers={'User-Agent': 'Mozilla/5.0'})
        with urllib.request.urlopen(req, timeout=10) as resp:
            html = resp.read().decode('utf-8', errors='ignore')
            has_encadres = 'id="encadres"' in html
            has_h1 = '<h1' in html
            # Check broken img tags (src="" or src="undefined" or src="null")
            broken_imgs = re.findall(r'<img[^>]*src=[\'"]([^\'"]*)[\'"]', html)
            bad_imgs = [img for img in broken_imgs if not img or img.strip() == '' or 'undefined' in img or 'null' in img]
            
            print(f"{u:55} | {resp.status:6} | {str(has_encadres):8} | {str(has_h1):3} | {len(bad_imgs):18}")
    except Exception as e:
        print(f"{u:55} | ERROR: {e}")

