with open('scratch/univ_lyon3_actu.html', 'r', encoding='utf-8') as f:
    text = f.read()

import re
pos = text.find('id="contenu-encadres"')
print("=== LIVE UNIV LYON 3 /actualites ===")
print(text[pos:pos+3500])

