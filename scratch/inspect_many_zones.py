import glob
import re

files_to_check = [
    'html_static/faculte-de-droit.html',
    'html_static/iaelyon-school-of-management.html',
    'html_static/achat-management-industriel-qualite.html',
    'html_static/alternance.html',
    'html_static/assurance-banque.html',
    'html_static/histoire.html',
    'html_static/gouvernance.html',
    'html_static/organisation.html',
    'html_static/chiffres-cles.html',
    'html_static/pole-reussite-3.html',
    'html_static/campus-de-bourg-en-bresse.html',
]

for f in files_to_check:
    with open(f, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    m_nav = re.search(r'<div id="zone_navigation".*?</div>\s*<!--.*?-->\s*(?=<div id="contenu-encadres")', c, re.DOTALL)
    print(f"\n==================== {f} ====================")
    if m_nav:
        print(m_nav.group(0)[:500])
    else:
        print("zone_navigation not matched cleanly")

