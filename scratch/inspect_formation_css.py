with open('public/assets/css/custom.css', 'r', encoding='utf-8', errors='ignore') as f:
    text = f.read()

import re
pos = text.find('recherche-formations-bar')
if pos != -1:
    print(text[pos-100:pos+800])
else:
    print("recherche-formations-bar not found")

