with open('public/assets/css/custom.css', 'r', encoding='utf-8', errors='ignore') as f:
    text = f.read()

import re
# check for any overrides on main, page, page_deco, contenu, etc.
keywords = ['#page', '#page_deco', '#contenu-encadres', '#contenu', '#zone_navigation', '#menu_secondaire', '.layout', '.card', '.colonne']
for kw in keywords:
    matches = re.findall(r'([^\{\}\n]*' + re.escape(kw) + r'[^\{\}\n]*)\{([^\{\}]+)\}', text)
    if matches:
        print(f"\n=== OVERRIDES FOR {kw} ({len(matches)} rules) ===")
        for sel, b in matches[:5]:
            print(f"  {sel.strip()} -> {b.strip()[:100]}")

