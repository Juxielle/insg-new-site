for fname in ['html_static/gouvernance.html', 'html_static/organisation.html', 'html_static/chiffres-cles.html']:
    with open(fname, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    if '</div><!-- #contenu-encadres -->' in c:
        c_fixed = c.replace('</div><!-- #contenu-encadres -->', '</div>\n</div><!-- #contenu-encadres -->')
        with open(fname, 'w', encoding='utf-8') as fp:
            fp.write(c_fixed)
        print(f"Fixed {fname}")
    else:
        print(f"Pattern not found in {fname}")

