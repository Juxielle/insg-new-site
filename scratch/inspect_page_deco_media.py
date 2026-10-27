with open('public/assets/css/styles.css', 'r', encoding='utf-8', errors='ignore') as f:
    css = f.read()

import re
pos = css.find('#page_deco')
while pos != -1:
    last_media = css.rfind('@media', 0, pos)
    last_close = css.rfind('}', 0, pos)
    media_info = "NO MEDIA"
    if last_media > last_close:
        media_info = css[last_media:css.find('{', last_media)].strip()
    end = css.find('}', pos)
    print(f"[{media_info}] {css[pos:end+1]}")
    pos = css.find('#page_deco', pos + 1)

