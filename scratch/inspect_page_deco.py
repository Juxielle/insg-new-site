with open('public/assets/css/styles.css', 'r', encoding='utf-8', errors='ignore') as f:
    styles_css = f.read()

import re
matches = re.findall(r'([^\{\}]*#page_deco[^\{\}]*)\{([^\{\}]+)\}', styles_css)
print("=== #page_deco in styles.css ===")
for sel, b in matches:
    print(sel.strip(), "->", b.strip())

matches_page = re.findall(r'([^\{\}]*main#page[^\{\}]*|#page(?![_\-])[^\{\}]*)\{([^\{\}]+)\}', styles_css)
print("\n=== #page in styles.css ===")
for sel, b in matches_page[:10]:
    print(sel.strip(), "->", b.strip())

