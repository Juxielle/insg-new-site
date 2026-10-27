for fname in ['html_static/gouvernance.html', 'html_static/organisation.html', 'html_static/chiffres-cles.html']:
    with open(fname, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    c_fixed = c.replace('</div><!-- #contenu-encadres -->', '</div></div><!-- #contenu-encadres -->')
    import re
    m = re.search(r'<main\b[^>]*id=["\']page["\'][^>]*>(.*?)</main>', c_fixed, re.DOTALL)
    if m:
        content = m.group(1)
        o = content.count('<div')
        cl = content.count('</div')
        print(f"{fname}: open={o}, close={cl}, diff={o-cl}")

