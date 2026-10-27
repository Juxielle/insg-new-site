import glob
import re

files = glob.glob('html_static/*.html')
has_nonempty_menu_sec = []

for f in files:
    with open(f, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    m = re.search(r'<div id="menu_secondaire"[^>]*>(.*?)</div>', c, re.DOTALL)
    if m:
        content = m.group(1)
        if '<ul' in content or '<li' in content:
            has_nonempty_menu_sec.append(f)

print(f"Files with non-empty menu_secondaire: {len(has_nonempty_menu_sec)}")
for f in has_nonempty_menu_sec[:15]:
    print(" -", f)

