with open('public/assets/css/custom.css', 'r', encoding='utf-8', errors='ignore') as f:
    lines = f.readlines()

for i in range(50, 80):
    print(f"{i+1:3}: {lines[i].rstrip()}")

