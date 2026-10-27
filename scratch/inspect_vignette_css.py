with open('public/assets/css/styles.css', 'r', encoding='utf-8', errors='ignore') as f:
    text = f.read()

import re
matches = re.findall(r'([^\{\}]*vignette[^\{\}]*)\{([^\{\}]+)\}', text)
for sel, b in matches[:10]:
    print(sel.strip()[:60], "->", b.strip()[:100])

