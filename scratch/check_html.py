import os
import glob
import re

files = [
    'html_static/faculte-de-droit.html',
    'html_static/iaelyon-school-of-management.html',
    'html_static/accompagnement-du-service-de-la-recherche.html',
    'html_static/achat-management-industriel-qualite.html',
    'html_static/alternance.html'
]

for filename in files:
    with open(filename, 'r', encoding='utf-8', errors='ignore') as f:
        text = f.read()

    pos_page = text.find('id="page"')
    pos_main_open = text.rfind('<main', 0, pos_page) if pos_page != -1 else -1
    pos_main_close = text.find('</main>', pos_page) if pos_page != -1 else -1

    print(f"\n=== {os.path.basename(filename)} ===")
    print(f"main_open: {pos_main_open}, page: {pos_page}, main_close: {pos_main_close}")
    if pos_main_open != -1 and pos_main_close != -1:
        main_chunk = text[pos_main_open:pos_main_close+7]
        print("Length of <main>...</main>:", len(main_chunk))
        # check if it has page_deco, zone_navigation, fil_ariane, menu_secondaire, actions-fiche, contenu-encadres
        has_page_deco = 'id="page_deco"' in main_chunk
        has_zone_nav = 'id="zone_navigation"' in main_chunk
        has_fil_ariane = 'id="fil_ariane"' in main_chunk
        has_menu_sec = 'id="menu_secondaire"' in main_chunk
        has_actions = 'id="actions-fiche"' in main_chunk or 'actions-fiche' in main_chunk
        has_contenu = 'id="contenu-encadres"' in main_chunk
        has_date = 'class="date-miseajour"' in main_chunk
        has_separateur = 'class="separateur"' in main_chunk
        print(f" deco:{has_page_deco}, zone:{has_zone_nav}, fil:{has_fil_ariane}, menu_sec:{has_menu_sec}, actions:{has_actions}, contenu:{has_contenu}, date:{has_date}, sep:{has_separateur}")

