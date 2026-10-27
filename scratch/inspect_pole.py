for f in ['html_static/pole-reussite-3.html', 'html_static/centre-lyonnais-d-histoire-du-droit-et-de-la-pensee-politique.html']:
    with open(f, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    p_page = c.find('id="page"')
    p_main = c.find('<main')
    print(f"=== {f} ===")
    print("id=page pos:", p_page)
    print("main pos:", p_main)
    if p_page != -1:
        print(c[p_page-20:p_page+250])

