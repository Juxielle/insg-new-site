with open('public/assets/css/styles.css', 'r', encoding='utf-8', errors='ignore') as f:
    styles_css = f.read()

import re
pos = 0
for term in ['header_cols', 'banniere__logo', 'navigation-principale', 'zone_navigation', 'menu_secondaire', 'fil_ariane', 'contenu-encadres']:
    m = re.search(r'([^{}]*' + term + r'[^{}]*)\{([^{}]+)\}', styles_css)
    if m:
        print(f"=== {term} in styles.css ===")
        print("Selector:", m.group(1).strip()[:100])
        print("Body:", m.group(2).strip()[:150])

