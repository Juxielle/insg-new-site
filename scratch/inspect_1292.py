with open('public/assets/css/styles.css', 'r', encoding='utf-8', errors='ignore') as f:
    css = f.read()

import re

# find all media queries with 1292px
matches = re.finditer(r'@media[^{]*1292px[^{]*\{', css)
for m in matches:
    start = m.start()
    # find matching closing bracket
    bracket_count = 0
    end = start
    for i in range(m.end() - 1, len(css)):
        if css[i] == '{':
            bracket_count += 1
        elif css[i] == '}':
            bracket_count -= 1
            if bracket_count == 0:
                end = i + 1
                break
    block = css[start:end]
    if '#page_deco' in block or '#contenu' in block:
        print("1292px MEDIA QUERY BLOCK:")
        print(block[:800])
        print("...")

