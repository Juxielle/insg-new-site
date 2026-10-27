with open('scratch/univ_lyon3_actu.html', 'r', encoding='utf-8', errors='ignore') as f:
    txt = f.read()
import re
print("Form tags:")
for m in re.finditer(r'<form[^>]*>.*?</form>', txt, re.DOTALL):
    print(m.group(0)[:300])
    print("---")

