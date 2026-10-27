import re

for name in ['centre-interuniversitaire-histoire-archeologie-litteratures-des-mondes-chretiens-et-musulmans-medievaux.html', 'histoire-et-sources-des-mondes-antiques.html', 'plateforme-pedagogique.html', 'universite-de-lyon.html']:
    with open('html_static/' + name, 'r', encoding='utf-8', errors='ignore') as f:
        html = f.read()
    m = re.search(r'<main[^>]*>.*?</main>', html, re.DOTALL)
    print(f"=== {name} ===")
    if m:
        print(m.group(0)[:400])
    else:
        print("No main, body:")
        m2 = re.search(r'<body[^>]*>(.*?)</body>', html, re.DOTALL)
        if m2:
            print(m2.group(1)[:400])

