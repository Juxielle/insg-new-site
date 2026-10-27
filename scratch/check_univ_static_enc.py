with open('html_static/l-universite-jean-moulin.html', 'r', encoding='utf-8', errors='ignore') as f:
    html = f.read()

print("encadres in l-universite-jean-moulin.html?", 'id="encadres"' in html)
if 'id="encadres"' in html:
    idx = html.find('id="encadres"')
    print(html[idx:idx+1000])

