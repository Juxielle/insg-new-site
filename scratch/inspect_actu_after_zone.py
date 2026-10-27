with open('scratch/univ_lyon3_actu.html', 'r', encoding='utf-8', errors='ignore') as f:
    txt = f.read()
import re
idx = txt.find('id="zone_navigation"')
print("After zone_navigation in actu:")
print(txt[idx:idx+2000])

