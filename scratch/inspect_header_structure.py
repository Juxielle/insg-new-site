with open('resources/views/partials/header.blade.php', 'r', encoding='utf-8') as f:
    text = f.read()

pos1 = text.find('id="menu_principal"')
pos2 = text.find('menu-mobile', pos1)
if pos2 == -1:
    pos2 = text.find('toggle__menu_mobile', pos1)
print("pos2:", pos2)
print("Snippet after pos1:", text[pos1:pos1+500])
if pos2 != -1:
    print("Snippet around pos2:", text[pos2-100:pos2+200])

