with open('scratch/univ_lyon3_universite.html', 'r', encoding='utf-8', errors='ignore') as f:
    html = f.read()

import re
styles = re.findall(r'<style[^>]*>(.*?)</style>', html, re.DOTALL)
for s in styles:
    if 'colonne_' in s or 'ligne_' in s:
        print("FOUND IN UNIVERSITE:")
        print(s[:1000])

