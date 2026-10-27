with open('public/assets/css/styles.css', 'r', encoding='utf-8', errors='ignore') as f:
    css = f.read()

import re

# find #encadres rules not in @media (min-width: 980px)
for m in re.finditer(r'([^{}]*#encadres[^{}]*)\{([^{}]+)\}', css):
    pos = m.start()
    last_media = css.rfind('@media', 0, pos)
    last_close = css.rfind('}', 0, pos)
    media = "NONE"
    if last_media > last_close:
        media = css[last_media:css.find('{', last_media)].strip()
    print(f"[{media}] {m.group(1).strip()[:60]} -> {m.group(2).strip()[:100]}")

