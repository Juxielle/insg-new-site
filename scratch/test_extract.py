def extract_body(rawHtml):
    posStart = rawHtml.find('id="contenu-encadres"')
    if posStart != -1:
        divStart = rawHtml.rfind('<div', 0, posStart)
        posDate = rawHtml.find('class="date-miseajour"', posStart)
        if posDate != -1:
            divEnd = rawHtml.rfind('</div>', 0, posDate)
            bodyContent = rawHtml[divStart:divEnd]
        else:
            posMainEnd = rawHtml.find('</main>', posStart)
            bodyContent = rawHtml[divStart:posMainEnd if posMainEnd != -1 else len(rawHtml)]
    else:
        bodyContent = "FALLBACK"
    return bodyContent

for f in ['html_static/faculte-de-droit.html', 'html_static/iaelyon-school-of-management.html', 'html_static/achat-management-industriel-qualite.html']:
    with open(f, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    b = extract_body(c)
    print(f"=== {f} ===")
    print("Length:", len(b))
    print("Start:", repr(b[:100]))
    print("End:", repr(b[-100:]))
    # Count opening and closing divs
    open_divs = b.count('<div')
    close_divs = b.count('</div')
    print(f"Div balance: open={open_divs}, close={close_divs}, diff={open_divs - close_divs}")

