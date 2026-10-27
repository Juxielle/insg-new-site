with open('html_static/gouvernance.html', 'r', encoding='utf-8', errors='ignore') as fp:
    c = fp.read()

pos = c.find('class="date-miseajour"')
print(c[pos-300:pos+150])

