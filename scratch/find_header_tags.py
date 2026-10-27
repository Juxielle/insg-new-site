with open('resources/views/partials/header.blade.php', 'r', encoding='utf-8') as f:
    text = f.read()

print("header length:", len(text))
pos1 = text.find('navigation-principale')
print("pos navigation-principale:", pos1)
pos2 = text.find('acces-1')
print("pos acces-1:", pos2)
pos3 = text.find('Départements & Cycles')
if pos3 == -1:
    pos3 = text.find('cycle')
print("pos Dépts:", pos3)
if pos1 != -1:
    print(text[pos1-50:pos1+150])

