with open('html_static/histoire.html', 'r', encoding='utf-8', errors='ignore') as f:
    html = f.read()

import re
m = re.search(r'<main[^>]*>.*?</main>', html, re.DOTALL)
if m:
    print("Found <main> in histoire.html:")
    print(m.group(0)[:600])
    print("...")
    print(m.group(0)[-300:])
else:
    print("No <main> in histoire.html")
    m2 = re.search(r'<body[^>]*>(.*?)</body>', html, re.DOTALL)
    if m2:
        print("Body content:")
        print(m2.group(1)[:600])

