with open('public/assets/css/custom.css', 'r', encoding='utf-8', errors='ignore') as f:
    lines = f.readlines()

for idx, l in enumerate(lines[:120]):
    print(f"{idx+1:3}: {l.rstrip()}")

