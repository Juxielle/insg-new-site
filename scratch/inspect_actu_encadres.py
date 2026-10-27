with open('scratch/univ_lyon3_actu.html', 'r', encoding='utf-8', errors='ignore') as f:
    txt = f.read()
import re
print("Encadres in actu:")
m = re.search(r'<aside id="encadres"[^>]*>.*?</aside>', txt, re.DOTALL)
if m:
    print(m.group(0)[:1500])
else:
    print("None")

