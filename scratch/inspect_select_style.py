import sys
import codecs
sys.stdout = codecs.getwriter('utf-8')(sys.stdout.detach())

with open('public/assets/css/styles.css', 'r', encoding='utf-8', errors='ignore') as f:
    txt = f.read()
import re
for m in re.finditer(r'([^{}]*select_style[^{}]*)\{([^{}]+)\}', txt):
    print("Selector:", m.group(1).strip()[:80])
    print("Body:", m.group(2).strip()[:100])
    print("---")

