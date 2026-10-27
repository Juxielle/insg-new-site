with open('html_static/faculte-de-droit.html', 'r', encoding='utf-8', errors='ignore') as f:
    text = f.read()

pos_zone = text.find('id="zone_navigation"')
pos_contenu = text.find('id="contenu-encadres"')
print("=== faculte-de-droit zone_navigation ===")
print(text[pos_zone:pos_contenu])

with open('html_static/achat-management-industriel-qualite.html', 'r', encoding='utf-8', errors='ignore') as f:
    text2 = f.read()

pos_zone2 = text2.find('id="zone_navigation"')
pos_contenu2 = text2.find('id="contenu-encadres"')
print("=== achat-management zone_navigation ===")
print(text2[pos_zone2:pos_contenu2])

