import urllib.request

urls = [
    '/formations/licence-pro-finance-comptabilite',
    '/actualites/ceremonie-solennelle-remise-diplomes-2026',
    '/evenements/journee-portes-ouvertes-orientation-2026',
]

base = 'http://insg-gabon2.test'

for u in urls:
    req = urllib.request.Request(base + u, headers={'User-Agent': 'Mozilla/5.0'})
    with urllib.request.urlopen(req, timeout=10) as resp:
        html = resp.read().decode('utf-8', errors='ignore')
        print(f"{u} -> {resp.status}, Encadres: {'id=\"encadres\"' in html}, Page: {'id=\"page\"' in html}")

