for fname in ['html_static/gouvernance.html', 'html_static/organisation.html', 'html_static/chiffres-cles.html']:
    with open(fname, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    p = c.find('</div><!-- #contenu-encadres -->')
    print(f"=== {fname} ===")
    print(c[p-150:p+35])

