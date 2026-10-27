from bs4 import BeautifulSoup
import re

def analyze(path, name):
    with open(path, 'r', encoding='utf-8', errors='ignore') as f:
        soup = BeautifulSoup(f.read(), 'html.parser')
    
    print(f"\n==================== {name} ====================")
    html_tag = soup.find('html')
    print("HTML class:", html_tag.get('class') if html_tag else None)
    
    body_tag = soup.find('body')
    print("BODY id:", body_tag.get('id') if body_tag else None)
    print("BODY class:", body_tag.get('class') if body_tag else None)
    print("BODY data attributes:", {k: v for k, v in body_tag.attrs.items() if k.startswith('data-')} if body_tag else None)

    # Stylesheets
    print("\nSTYLESHEETS:")
    for link in soup.find_all('link', rel=lambda x: x and 'stylesheet' in x):
        print("  -", link.get('href'), "| media:", link.get('media'))

    # Top-level children inside body
    print("\nBODY DIRECT CHILDREN TAGS/IDS:")
    for child in body_tag.find_all(recursive=False):
        print(f"  <{child.name} id='{child.get('id')}' class='{child.get('class')}'>")

analyze('scratch/univ_lyon3_home.html', 'LIVE UNIV LYON 3 HOME')
analyze('scratch/univ_lyon3_alternance.html', 'LIVE UNIV LYON 3 ALTERNANCE (INTERIOR)')

