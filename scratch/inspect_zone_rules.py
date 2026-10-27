with open('public/assets/css/styles.css', 'r', encoding='utf-8', errors='ignore') as f:
    text = f.read()

import re
matches = re.findall(r'([^\{\}]*zone_navigation[^\{\}]*)\{([^\{\}]+)\}', text)
for sel, b in matches:
    print(sel.strip(), "->", b.strip())

