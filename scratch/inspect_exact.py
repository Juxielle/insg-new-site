with open('html_static/gouvernance.html', 'r', encoding='utf-8', errors='ignore') as fp:
    c = fp.read()
p = c.find('<!-- #contenu-encadres -->')
print(repr(c[p-50:p+30]))

