import glob
import re

files = glob.glob('html_static/*.html')
lyon_links = set()

for f in files:
    with open(f, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    m_links = re.findall(r'href=[\'"](https?://[^\'"]*univ-lyon3\.fr[^\'"]*)[\'"]', c)
    for l in m_links:
        lyon_links.add(l)

print(f"Total Lyon 3 absolute links: {len(lyon_links)}")
for l in sorted(list(lyon_links))[:20]:
    print(" -", l)

