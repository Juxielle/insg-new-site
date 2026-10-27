with open('scratch/univ_lyon3_alternance.html', 'r', encoding='utf-8', errors='ignore') as f:
    txt = f.read()
import re
print("bandeau matches:")
for m in re.finditer(r'#bandeau[^\{]*\{[^\}]*\}', txt):
    print(m.group(0))

print("style tags with bandeau:")
for m in re.finditer(r'<style[^>]*>.*?</style>', txt, re.DOTALL):
    if 'bandeau' in m.group(0):
        print(m.group(0))

