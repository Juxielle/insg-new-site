import sys
sys.stdout.reconfigure(encoding='utf-8')

with open('html_static/l-universite-jean-moulin.html', 'r', encoding='utf-8', errors='ignore') as f:
    text = f.read()

pos = text.find('id="contenu-encadres"')
print("=== html_static/l-universite-jean-moulin.html ===")
print(text[pos:pos+2500])

