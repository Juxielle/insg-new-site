import re

with open('scratch/univ_lyon3_home.html', 'r', encoding='utf-8') as f:
    html = f.read()

links = set(re.findall(r'href=[\'"](https?://www\.univ-lyon3\.fr/[^\'"]*)[\'"]', html))
for l in sorted(list(links))[:20]:
    print(" -", l)

