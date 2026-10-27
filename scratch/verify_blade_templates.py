import os

blade_files = [
    'resources/views/pages/about.blade.php',
    'resources/views/pages/campus.blade.php',
    'resources/views/pages/admissions.blade.php',
    'resources/views/pages/entreprises.blade.php',
    'resources/views/pages/vie-associative.blade.php',
    'resources/views/pages/contact.blade.php',
    'resources/views/formations/index.blade.php',
    'resources/views/formations/show.blade.php',
    'resources/views/actualites/index.blade.php',
    'resources/views/actualites/show.blade.php',
    'resources/views/pages/evenements.blade.php',
    'resources/views/evenements/show.blade.php',
]

for bf in blade_files:
    if not os.path.exists(bf):
        print("Missing file:", bf)
        continue
    with open(bf, 'r', encoding='utf-8') as f:
        text = f.read()
    
    # check structure
    has_main = '<main id="page">' in text
    has_deco = '<div id="page_deco">' in text
    has_banner = "@include('partials.banner'" in text
    has_contenu = '<div id="contenu-encadres">' in text
    has_date = '<div class="date-miseajour">' in text
    has_redacteur = '<div id="redacteur-date-impression"></div>' in text
    has_sep = '<div class="separateur"></div>' in text
    has_main_close = '</main>' in text

    # check div balance in file
    div_open = text.count('<div')
    div_close = text.count('</div')

    print(f"{os.path.basename(bf):30} | main:{int(has_main)} deco:{int(has_deco)} banner:{int(has_banner)} contenu:{int(has_contenu)} date:{int(has_date)} sep:{int(has_sep)} close:{int(has_main_close)} | divs: {div_open}/{div_close}")

