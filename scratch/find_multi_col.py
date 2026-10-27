import glob
import re

files = glob.glob('html_static/*.html') + glob.glob('resources/views/**/*.blade.php', recursive=True)

for f in files:
    with open(f, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    cols = re.findall(r'class="[^"]*colonne_[^"]*"', c)
    if any('colonne_2' in col or 'colonne_3' in col for col in cols):
        print(f"{f}: has {set(cols)}")

