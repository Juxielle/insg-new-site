import glob
import re

files = glob.glob('html_static/*.html')
print(f"Total static pages: {len(files)}")

for f in files:
    with open(f, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    
    # check if has id="page"
    has_page = 'id="page"' in c
    has_deco = 'id="page_deco"' in c
    has_contenu = 'id="contenu-encadres"' in c
    
    # check which container
    m_cont = re.search(r'id=["\']((?:avec|sans)_nav_(?:avec|sans)_encadres)["\']', c)
    container = m_cont.group(1) if m_cont else "NONE"
    
    has_encadres = 'id="encadres"' in c
    
    if not has_page or not has_deco or not has_contenu:
        print(f"Structure missing in {f}: page={has_page}, deco={has_deco}, contenu={has_contenu}")
    
    if "avec_encadres" in container and not has_encadres:
        print(f"Container avec_encadres but NO encadres in {f}")
    elif "sans_encadres" in container and has_encadres:
        print(f"Container sans_encadres but HAS encadres in {f}")
    elif container == "NONE":
        print(f"No nav container in {f}")

