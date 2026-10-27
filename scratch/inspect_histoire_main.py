with open('html_static/histoire.html', 'r', encoding='utf-8', errors='ignore') as f:
    html = f.read()

import re
print("contenu-encadres in histoire.html?", 'contenu-encadres' in html)
print("avec_nav in histoire.html?", 'avec_nav' in html)
print("encadres in histoire.html?", 'encadres' in html)

m = re.findall(r'<main.*?</main>', html, re.DOTALL)
print(f"Number of <main> tags in histoire.html: {len(m)}")
for i, tag in enumerate(m):
    print(f"Main {i} length: {len(tag)}")

