with open('html_static/faculte-de-droit.html', 'r', encoding='utf-8', errors='ignore') as fp:
    c = fp.read()

p1 = c.find('id="zone_navigation"')
p2 = c.find('id="contenu-encadres"')
print("Between p1 and p2:")
print(c[p1-10:p1+200])
print("...")
print(c[p2-200:p2+50])

