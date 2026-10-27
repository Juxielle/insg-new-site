with open('html_static/gouvernance.html', 'r', encoding='utf-8', errors='ignore') as fp:
    c = fp.read()

import re
m = re.search(r'<main\b[^>]*id=["\']page["\'][^>]*>(.*?)</main>', c, re.DOTALL)
if m:
    content = m.group(1)
    tokens = re.finditer(r'(<div[^>]*>|</div>)', content)
    depth = 0
    for match in tokens:
        t = match.group(0)
        if t.startswith('</div'):
            depth -= 1
            # print(f"depth {depth:2}: {t}")
        else:
            print(f"depth {depth:2} -> {depth+1:2}: {t[:50]}")
            depth += 1

