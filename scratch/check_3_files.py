for f in ['html_static\\centre-interuniversitaire-histoire-archeologie-litteratures-des-mondes-chretiens-et-musulmans-medievaux.html', 'html_static\\histoire-et-sources-des-mondes-antiques.html', 'html_static\\plateforme-pedagogique.html']:
    with open(f, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    p1 = c.find('id="page"')
    p2 = c.find('</main>', p1)
    print(f"=== {f} ===")
    print(c[p1-10:p1+200])

