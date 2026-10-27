import glob
import re

files = glob.glob('html_static/*.html')
menu_texts = set()

for f in files:
    with open(f, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    m = re.search(r'<div id="menu_secondaire"[^>]*>(.*?)</div>\s*<!--', c, re.DOTALL)
    if m:
        items = re.findall(r'<a\b[^>]*>(.*?)</a>', m.group(1))
        for item in items:
            clean = re.sub(r'<.*?>', '', item).strip()
            if clean:
                menu_texts.add(clean)

for label in sorted(list(menu_texts))[30:]:
    print(" -", label)

