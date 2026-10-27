with open('html_static/chiffres-cles.html', 'r', encoding='utf-8', errors='ignore') as fp:
    c = fp.read()

pos1 = c.find('<main id="page">')
pos2 = c.find('</main>', pos1)
print(c[pos2-200:pos2+20])

