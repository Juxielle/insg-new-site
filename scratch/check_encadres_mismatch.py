import glob
import re

files = glob.glob('resources/views/**/*.blade.php', recursive=True) + glob.glob('html_static/*.html')

for f in files:
    with open(f, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    has_sans = 'id="avec_nav_sans_encadres"' in c or 'id="sans_nav_sans_encadres"' in c
    has_avec = 'id="avec_nav_avec_encadres"' in c or 'id="sans_nav_avec_encadres"' in c
    has_encadres = 'id="encadres"' in c
    
    if has_sans and has_encadres:
        print(f"MISMATCH (sans_encadres container BUT has encadres block!): {f}")
    if has_avec and not has_encadres:
        print(f"MISMATCH (avec_encadres container BUT NO encadres block!): {f}")

