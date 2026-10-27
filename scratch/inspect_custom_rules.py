with open('public/assets/css/custom.css', 'r', encoding='utf-8', errors='ignore') as f:
    custom_css = f.read()

import re
rules = re.findall(r'([^\{\}\n]+)\{([^\{\}]+)\}', custom_css)
print(f"Total CSS rules in custom.css: {len(rules)}")

# Check rules touching layout, page, main, contenu, header, bandeau
layout_rules = []
for sel, body in rules:
    sel = sel.strip()
    if any(k in sel for k in ['#page', '#contenu', '#zone_navigation', '#menu_secondaire', '#bandeau', '.layout', 'body', 'header', '.colonne']):
        layout_rules.append((sel, body.strip()[:60]))

print(f"Rules touching core layout: {len(layout_rules)}")
for sel, b in layout_rules[:30]:
    print(f"  {sel} -> {b}")

