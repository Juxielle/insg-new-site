with open('html_static/faculte-de-droit.html', 'r', encoding='utf-8', errors='ignore') as fp:
    c = fp.read()

p2 = c.find('id="contenu-encadres"')
p3 = c.find('</main>', p2)
print("After contenu-encadres up to </main>:")
print(c[p3-400:p3+7])

