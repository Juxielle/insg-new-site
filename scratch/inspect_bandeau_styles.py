with open('scratch/univ_lyon3_alternance.html', 'r', encoding='utf-8') as f:
    text = f.read()

import re
matches = re.findall(r'[^\n;\{\}]*#bandeau[^\n;\{\}]*\{[^\}]*\}', text)
print("Inline styles matching #bandeau in alternance:")
for m in matches:
    print(m)

# Also check styles.css for #bandeau
with open('public/assets/css/styles.css', 'r', encoding='utf-8', errors='ignore') as f:
    styles_css = f.read()

matches_styles = re.findall(r'([^\{\}]*#bandeau[^\{\}]*)\{([^\{\}]+)\}', styles_css)
print("\nrules in styles.css for #bandeau:")
for sel, b in matches_styles:
    print(sel, "->", b)

