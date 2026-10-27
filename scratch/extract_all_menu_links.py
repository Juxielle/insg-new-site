import re

with open('resources/views/partials/header.blade.php', 'r', encoding='utf-8') as f:
    text = f.read()

# 1. Secondary Menu: acces_directs
acces_pos = text.find('id="acces_directs"')
acces_end = text.find('id="menu_principal"')
acces_section = text[acces_pos:acces_end]

# Extract links from acces-1 and acces-2
acces1_pos = acces_section.find('data-toggle-id="acces-1"')
acces2_pos = acces_section.find('data-toggle-id="acces-2"')
acces3_pos = acces_section.find('data-toggle-id="acces-3"')

acces1_links = re.findall(r'href="([^"]+)"', acces_section[acces1_pos:acces2_pos])
acces2_links = re.findall(r'href="([^"]+)"', acces_section[acces2_pos:acces3_pos if acces3_pos != -1 else len(acces_section)])

# 2. Main Menu: menu_principal
menu_pos = text.find('id="menu_principal"')
# Find end of desktop menu_principal (before mobile menu / recherche)
menu_end = text.find('id="recherche-simple"')
if menu_end == -1:
    menu_end = text.find('class="menu-mobile"')
if menu_end == -1:
    menu_end = len(text)
main_section = text[menu_pos:menu_end]
main_links = re.findall(r'href="([^"]+)"', main_section)

# Filter out anchors or javascript
def clean_links(link_list):
    res = []
    for l in link_list:
        l = l.strip()
        if not l.startswith('#') and not l.startswith('javascript:'):
            res.append(l)
    return sorted(list(set(res)))

print("=== MENU SECONDAIRE: ACCES-1 (Départements & Cycles) ===")
for l in clean_links(acces1_links):
    print(" ", l)

print("\n=== MENU SECONDAIRE: ACCES-2 (Filières de Gestion) ===")
for l in clean_links(acces2_links):
    print(" ", l)

print(f"\n=== MENU PRINCIPAL (Institut, Formations, Recherche, Entreprises, International, Campus) ({len(clean_links(main_links))} links) ===")
for l in clean_links(main_links):
    print(" ", l)

