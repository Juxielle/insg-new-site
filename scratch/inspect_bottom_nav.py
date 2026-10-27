with open('html_static/gouvernance.html', 'r', encoding='utf-8', errors='ignore') as fp:
    c = fp.read()

pos = c.find('id="navigation"')
if pos != -1:
    print(c[pos-100:pos+500])

