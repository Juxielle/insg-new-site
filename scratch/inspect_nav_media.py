with open('public/assets/css/styles.css', 'r', encoding='utf-8', errors='ignore') as f:
    css = f.read()

import re

# find all occurrences of avec_nav_avec_encadres with context
for m in re.finditer(r'([^{}]+avec_nav_avec_encadres[^{}]*)\{([^{}]+)\}', css):
    print("MATCH:")
    print("Selector:", m.group(1).strip())
    print("Body:", m.group(2).strip())
    # find enclosing media query if any
    start = m.start()
    last_media = css.rfind('@media', 0, start)
    last_close = css.rfind('}', 0, start)
    if last_media > last_close:
        media_decl = css[last_media:css.find('{', last_media)]
        print("Enclosing media:", media_decl.strip())
    print("---")

