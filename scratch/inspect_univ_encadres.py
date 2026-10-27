with open('scratch/univ_lyon3_universite.html', 'r', encoding='utf-8', errors='ignore') as f:
    html = f.read()

import re
print("Has #encadres in universite.html?", 'id="encadres"' in html)
if 'id="encadres"' in html:
    idx = html.find('id="encadres"')
    print(html[idx:idx+1500])
else:
    print("Has avec_nav_sans_encadres?", 'avec_nav_sans_encadres' in html)
    print("Has avec_nav_avec_encadres?", 'avec_nav_avec_encadres' in html)
