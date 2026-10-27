import glob
import re

files = glob.glob('resources/views/pages/*.blade.php')

for f in files:
    with open(f, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    m = re.search(r'id=["\']((?:avec|sans)_nav_(?:avec|sans)_encadres)["\']', c)
    has_encadres = 'id="encadres"' in c
    print(f"{f:35} -> Container: {m.group(1) if m else 'NONE':25} | Encadres: {has_encadres}")

