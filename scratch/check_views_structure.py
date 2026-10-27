import glob
import os

view_files = glob.glob('resources/views/**/*.blade.php', recursive=True)

print(f"Total Blade views: {len(view_files)}")
print("\nChecking public pages (excluding admin and partials):")

for vf in sorted(view_files):
    if 'admin' in vf or 'partials' in vf or 'layouts' in vf:
        continue
    with open(vf, 'r', encoding='utf-8') as f:
        content = f.read()
    
    has_main_page = '<main id="page"' in content or 'id="page"' in content
    has_page_deco = 'id="page_deco"' in content
    has_zone_nav = 'id="zone_navigation"' in content
    has_contenu_encadres = 'id="contenu-encadres"' in content
    has_banner = 'partials.banner' in content
    has_date = 'date-miseajour' in content
    has_separateur = 'separateur' in content

    rel = os.path.relpath(vf, 'resources/views')
    print(f"{rel:35} | page:{int(has_main_page)} deco:{int(has_page_deco)} zone:{int(has_zone_nav)} banner:{int(has_banner)} contenu:{int(has_contenu_encadres)} date:{int(has_date)} sep:{int(has_separateur)}")

