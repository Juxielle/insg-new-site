import glob
import re

files = glob.glob('html_static/*.html')
has_bandeau_in_main = []

for f in files:
    with open(f, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    m = re.search(r'<main\b[^>]*id=["\']page["\'][^>]*>(.*?)</main>', c, re.DOTALL)
    if m:
        if 'id="bandeau"' in m.group(1):
            has_bandeau_in_main.append(f)

print(f"Files with id='bandeau' inside <main id='page'>: {len(has_bandeau_in_main)}")
if has_bandeau_in_main:
    print(has_bandeau_in_main[:5])

