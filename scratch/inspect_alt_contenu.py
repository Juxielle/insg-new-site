with open('scratch/univ_lyon3_alternance.html', 'r', encoding='utf-8', errors='ignore') as f:
    txt = f.read()
idx = txt.find('id="contenu-encadres"')
print(txt[idx:idx+2000])

