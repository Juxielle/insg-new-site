import glob
import re

files = glob.glob('html_static/*.html')
lyon_references = []

for f in files:
    with open(f, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    
    # Check zone_navigation
    m = re.search(r'<div id="zone_navigation".*?</div>\s*<div id="contenu-encadres"', c, re.DOTALL)
    if m:
        zone = m.group(0)
        # Check if Lyon 3 is mentioned in zone_navigation
        if 'univ-lyon3' in zone.lower() or 'lyon 3' in zone.lower() or 'jean moulin' in zone.lower():
            lyon_references.append((f, "Lyon text in zone"))

print(f"Total files with Lyon references in zone_navigation: {len(lyon_references)}")
for f, reason in lyon_references[:10]:
    print(f, reason)

