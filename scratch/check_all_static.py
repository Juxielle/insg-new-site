import glob
import re

files = glob.glob('html_static/*.html')
missing_main = []
missing_contenu = []

for f in files:
    with open(f, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    if 'id="page"' not in c:
        missing_main.append(f)
    if 'id="contenu-encadres"' not in c:
        missing_contenu.append(f)

print(f"Total files: {len(files)}")
print(f"Files missing id='page': {len(missing_main)}")
if missing_main:
    print("Missing id=page:", missing_main)
print(f"Files missing id='contenu-encadres': {len(missing_contenu)}")
if missing_contenu:
    print("Missing id=contenu-encadres:", missing_contenu)

