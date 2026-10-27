import re

with open('resources/views/partials/header.blade.php', 'r', encoding='utf-8') as f:
    header = f.read()

# 1. Menu principal: #navigation-principale
nav_princ_m = re.search(r'<nav id="navigation-principale".*?</nav>', header, re.DOTALL)
principal_links = set()
if nav_princ_m:
    links = re.findall(r'href="([^"]+)"', nav_princ_m.group(0))
    for l in links:
        if not l.startswith('#') and not l.startswith('javascript:'):
            principal_links.add(l)

# 2. Menu secondaire: #acces_directs
acces_m = re.search(r'<div id="acces_directs".*?</div>\s*<!--\s*Fin accès directs', header, re.DOTALL)
if not acces_m:
    acces_m = re.search(r'<div id="acces_directs".*?id="navigation-principale"', header, re.DOTALL)

secondary_links = set()
if acces_m:
    links = re.findall(r'href="([^"]+)"', acces_m.group(0))
    for l in links:
        if not l.startswith('#') and not l.startswith('javascript:'):
            secondary_links.add(l)

print(f"Principal links count: {len(principal_links)}")
for l in sorted(principal_links):
    print("  P:", l)

print(f"\nSecondary links count: {len(secondary_links)}")
for l in sorted(secondary_links):
    print("  S:", l)

