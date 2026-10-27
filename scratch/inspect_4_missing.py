for name in ['centre-interuniversitaire-histoire-archeologie-litteratures-des-mondes-chretiens-et-musulmans-medievaux.html', 'histoire-et-sources-des-mondes-antiques.html', 'plateforme-pedagogique.html', 'universite-de-lyon.html']:
    with open('html_static/' + name, 'r', encoding='utf-8', errors='ignore') as f:
        print(f"=== {name} ===")
        print(f.read()[:500])

