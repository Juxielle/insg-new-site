with open('public/assets/css/styles.css', 'r', encoding='utf-8', errors='ignore') as f:
    css = f.read()

import re

pos = css.find('#avec_nav_avec_encadres')
while pos != -1:
    start = pos - 100
    end = pos + 300
    last_media = css.rfind('@media', 0, pos)
    last_close = css.rfind('}', 0, pos)
    media_info = "NO MEDIA"
    if last_media > last_close:
        media_info = css[last_media:css.find('{', last_media)].strip()
    print(f"Pos {pos} [{media_info}]:\n" + css[max(0, start):end] + "\n====================\n")
    pos = css.find('#avec_nav_avec_encadres', pos + 1)

