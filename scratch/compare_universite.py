with open('scratch/univ_lyon3_universite.html', 'r', encoding='utf-8') as f:
    live = f.read()

with open('html_static/l-universite-jean-moulin.html', 'r', encoding='utf-8', errors='ignore') as f:
    static = f.read()

import re
live_main = re.search(r'<main\b[^>]*>(.*?)</main>', live, re.DOTALL)
static_main = re.search(r'<main\b[^>]*>(.*?)</main>', static, re.DOTALL)

print("Live univ-lyon3.fr/l-universite-jean-moulin:")
if live_main:
    print("Main length:", len(live_main.group(1)))
    # print first 500 chars
    print(live_main.group(1)[:500])

print("\nhtml_static/l-universite-jean-moulin.html:")
if static_main:
    print("Main length:", len(static_main.group(1)))
    print(static_main.group(1)[:500])

