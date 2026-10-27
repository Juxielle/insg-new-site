with open('scratch/univ_lyon3_actu.html', 'r', encoding='utf-8', errors='ignore') as f:
    txt = f.read()
import re
m = re.search(r'<main[^>]*>.*?</main>', txt, re.DOTALL)
if m:
    print("Main tag:", m.group(0)[:800])
else:
    print("Main not found, looking for id=page or role=main:")
    m2 = re.search(r'role="main"[^>]*>', txt)
    print("Role main:", m2.group(0) if m2 else 'none')

