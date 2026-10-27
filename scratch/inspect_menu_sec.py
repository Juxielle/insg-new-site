import re

with open('html_static/alternance.html', 'r', encoding='utf-8', errors='ignore') as f:
    c = f.read()

m = re.search(r'<div id="menu_secondaire"[^>]*>(.*?)</div>\s*<!--', c, re.DOTALL)
if m:
    print("=== alternance.html menu_secondaire ===")
    print(m.group(1)[:1000])

