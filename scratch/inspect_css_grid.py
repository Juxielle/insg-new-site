import re

with open('public/assets/css/styles.css', 'r', encoding='utf-8', errors='ignore') as f:
    css = f.read()

terms = ['#page', '#page_deco', '#contenu-encadres', '#avec_nav_avec_encadres', '#sans_nav_sans_encadres', '#avec_nav_sans_encadres', '#encadres', 'colonne_1', 'ligne_1']

for t in terms:
    print(f"=== {t} ===")
    matches = re.findall(r'([^{}]*' + re.escape(t) + r'[^{}]*)\{([^{}]+)\}', css)
    for sel, body in matches[:5]:
        print(f"  {sel.strip()[:60]} -> {body.strip()[:100]}")

