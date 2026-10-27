import sys
sys.stdout.reconfigure(encoding='utf-8')

with open('html_static/l-universite-jean-moulin.html', 'r', encoding='utf-8', errors='ignore') as f:
    text = f.read()

p1 = text.find('id="zone_navigation"')
p2 = text.find('id="contenu-encadres"')
print(text[p1:p2])

