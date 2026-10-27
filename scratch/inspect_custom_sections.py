with open('public/assets/css/custom.css', 'r', encoding='utf-8', errors='ignore') as f:
    text = f.read()

import re
headers = re.findall(r'/\*+[\s\S]*?\*+/', text)
for h in headers[:30]:
    if len(h) < 200:
        print(h.strip())

