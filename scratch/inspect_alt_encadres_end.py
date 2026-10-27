with open('scratch/univ_lyon3_alternance.html', 'r', encoding='utf-8', errors='ignore') as f:
    txt = f.read()

import re
idx = txt.find('id="contenu-encadres"')
idx_end = txt.find('</main>', idx)
print(txt[idx:idx+300])
print("...")
print(txt[idx_end-400:idx_end+50])

