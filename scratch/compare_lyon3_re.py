import re

def analyze_re(path, name):
    with open(path, 'r', encoding='utf-8', errors='ignore') as f:
        text = f.read()

    print(f"\n==================== {name} ====================")
    # html tag
    m_html = re.search(r'<html\b([^>]*)>', text, re.I)
    print("HTML tag:", m_html.group(0) if m_html else "None")

    # body tag
    m_body = re.search(r'<body\b([^>]*)>', text, re.I)
    print("BODY tag:", m_body.group(0) if m_body else "None")

    # stylesheets
    print("\nSTYLESHEETS:")
    links = re.findall(r'<link\b[^>]*rel=[\'"][^\'"]*stylesheet[^\'"]*[^>]*>', text, re.I)
    for l in links:
        print(" ", l.strip())

    # scripts in head
    head = text[:text.find('</head>')] if '</head>' in text else text[:2000]
    scripts = re.findall(r'<script\b[^>]*src=[\'"][^\'"]*[\'"][^>]*>', head, re.I)
    print("\nHEAD SCRIPTS:")
    for s in scripts:
        print(" ", s.strip())

    # main structure
    m_page = re.search(r'<main\b([^>]*)>', text, re.I)
    print("\nMAIN tag:", m_page.group(0) if m_page else "None")

analyze_re('scratch/univ_lyon3_home.html', 'LIVE UNIV LYON 3 HOME')
analyze_re('scratch/univ_lyon3_alternance.html', 'LIVE UNIV LYON 3 ALTERNANCE (INTERIOR)')
analyze_re('scratch/univ_lyon3_universite.html', 'LIVE UNIV LYON 3 UNIVERSITE (INTERIOR)')

