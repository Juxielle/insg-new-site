with open('scratch/univ_lyon3_alternance.html', 'r', encoding='utf-8') as f:
    text = f.read()

pos1 = text.find('<header')
pos2 = text.find('</header>')
print("LIVE HEADER FROM univ-lyon3.fr:")
print(text[pos1:pos2+9])

