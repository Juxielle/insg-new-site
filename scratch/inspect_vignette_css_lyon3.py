with open('scratch/univ_lyon3_actu.html', 'r', encoding='utf-8', errors='ignore') as f:
    html = f.read()

import re
matches = re.findall(r'[^{}]*vignette[^{}]*\{[^{}]*\}', html)
for m in matches:
    print(m)

