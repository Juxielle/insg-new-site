with open('scratch/univ_lyon3_universite.html', 'r', encoding='utf-8') as f:
    text = f.read()

import re
pos = text.find('id="contenu-encadres"')
pos_end = text.find('class="date-miseajour"')
print("=== LIVE UNIV LYON 3 /l-universite-jean-moulin ===")
print(text[pos:pos+3000])

