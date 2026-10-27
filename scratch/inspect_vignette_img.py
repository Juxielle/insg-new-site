with open('public/assets/css/styles.css', 'r', encoding='utf-8', errors='ignore') as f:
    css = f.read()

import re

for m in re.finditer(r'([^{}]*vignette_deco[^{}]*img[^{}]*)\{([^{}]+)\}', css):
    print("MATCH IMG:")
    print("Selector:", m.group(1).strip())
    print("Body:", m.group(2).strip())

