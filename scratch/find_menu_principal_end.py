with open('resources/views/partials/header.blade.php', 'r', encoding='utf-8') as f:
    text = f.read()

pos1 = text.find('id="menu_principal"')
pos_recherche = text.find('id="recherche-simple"')
pos_mobile = text.find('class="menu-mobile"')
print(f"menu_principal: {pos1}, recherche: {pos_recherche}, mobile: {pos_mobile}")

# find the closing </ul> for menu_principal
end_ul = text.find('</ul><!-- \n    Fin navigation principale', pos1)
if end_ul == -1:
    end_ul = text.find('Fin navigation principale', pos1)
print("end_ul:", end_ul)
if pos1 != -1 and end_ul != -1:
    import re
    main_section = text[pos1:end_ul]
    links = set(re.findall(r'href="([^"]+)"', main_section))
    clean = sorted([l for l in links if not l.startswith('#') and not l.startswith('javascript:')])
    print(f"Desktop Menu Principal link count: {len(clean)}")
    for l in clean:
        print("  P:", l)

