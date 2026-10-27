with open('public/assets/css/custom.css', 'r', encoding='utf-8', errors='ignore') as f:
    text = f.read()

import re
headers = re.findall(r'/\*+\s*={5,}[\s\S]*?\*+/', text)
for h in headers:
    print(h.strip())

