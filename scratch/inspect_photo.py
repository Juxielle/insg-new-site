with open('public/assets/css/styles.css', 'r', encoding='utf-8', errors='ignore') as f:
    css = f.read()

import re

for m in re.finditer(r'([^{}]*\.photo[^{}]*)\{([^{}]+)\}', css):
    print("Selector:", m.group(1).strip()[:80])
    print("Body:", m.group(2).strip()[:100])
    print("---")

