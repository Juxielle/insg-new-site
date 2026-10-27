with open('scratch/univ_lyon3_actu.html', 'r', encoding='utf-8', errors='ignore') as f:
    html = f.read()

import re
matches = re.findall(r'<li class="avec_vignette">.*?</li>', html, re.DOTALL)
for m in matches[:3]:
    print("ITEM IN LYON 3:")
    print(m)
    print("---")

