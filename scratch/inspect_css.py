import os

for f in ['public/assets/css/index_style.css', 'public/assets/css/custom.css', 'public/assets/css/styles.css']:
    if os.path.exists(f):
        print(f"=== {f} (size: {os.path.getsize(f)}) ===")
        with open(f, 'r', encoding='utf-8', errors='ignore') as fp:
            lines = fp.readlines()
        print("First 20 lines:")
        for l in lines[:20]:
            print(" ", l.rstrip())
        print("...\n")

