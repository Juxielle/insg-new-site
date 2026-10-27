with open('html_static/gouvernance.html', 'r', encoding='utf-8', errors='ignore') as fp:
    c = fp.read()

import re
m = re.search(r'<main\b[^>]*id=["\']page["\'][^>]*>(.*?)</main>', c, re.DOTALL)
if m:
    content = m.group(1)
    # trace div stack
    tokens = re.findall(r'(<div[^>]*>|</div>)', content)
    depth = 0
    for idx, t in enumerate(tokens):
        if t.startswith('</div'):
            depth -= 1
        else:
            depth += 1
        # print if depth seems off near end
        if idx > len(tokens) - 10:
            print(f"Token {idx}: depth={depth} -> {t[:30]}")
    print(f"Final depth: {depth}")

