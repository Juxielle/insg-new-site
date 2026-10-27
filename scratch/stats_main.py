import glob
import re

files = glob.glob('html_static/*.html')
stats = {
    'total': len(files),
    'has_main_page': 0,
    'has_page_deco': 0,
    'has_zone_nav': 0,
    'has_contenu_encadres': 0,
    'has_date': 0,
    'has_separateur': 0,
}

for f in files:
    with open(f, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    
    m = re.search(r'<main\b[^>]*id=["\']page["\'][^>]*>(.*?)</main>', c, re.DOTALL)
    if m:
        stats['has_main_page'] += 1
        inner = m.group(1)
        if 'id="page_deco"' in inner:
            stats['has_page_deco'] += 1
        if 'id="zone_navigation"' in inner:
            stats['has_zone_nav'] += 1
        if 'id="contenu-encadres"' in inner:
            stats['has_contenu_encadres'] += 1
        if 'class="date-miseajour"' in inner:
            stats['has_date'] += 1
        if 'class="separateur"' in inner:
            stats['has_separateur'] += 1

print("Stats across all static files:")
for k, v in stats.items():
    print(f" {k:22}: {v} / {len(files)}")

