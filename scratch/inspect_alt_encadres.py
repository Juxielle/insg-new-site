with open('scratch/univ_lyon3_alternance.html', 'r', encoding='utf-8', errors='ignore') as f:
    txt = f.read()
import re
idx = txt.find('id="encadres"')
print(txt[idx-20:idx+2000])

