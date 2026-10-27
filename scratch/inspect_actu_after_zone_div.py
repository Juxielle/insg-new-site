with open('scratch/univ_lyon3_actu.html', 'r', encoding='utf-8', errors='ignore') as f:
    txt = f.read()
idx = txt.find('id="actions-fiche"')
idx_end = txt.find('</div>', idx)
print("After zone_navigation closing div in actu:")
print(txt[idx_end:idx_end+1500])

