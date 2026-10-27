with open('scratch/univ_lyon3_alternance.html', 'r', encoding='utf-8', errors='ignore') as f:
    txt = f.read()
import re
m = re.search(r'<header[^>]*>', txt)
print("Header tag:", m.group(0) if m else 'not found')
m2 = re.search(r'<div id="bandeau"[^>]*>', txt)
print("Bandeau tag:", m2.group(0) if m2 else 'not found')
m3 = re.search(r'<header.*?</header>', txt, re.DOTALL)
if m3:
    print("Header length:", len(m3.group(0)))

