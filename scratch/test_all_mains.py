import glob

files = glob.glob('html_static/*.html')
unbalanced = []
missing = []

for f in files:
    with open(f, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    pos1 = c.find('<main id="page">')
    if pos1 == -1:
        pos1 = c.find('<main')
        if pos1 != -1 and 'id="page"' not in c[pos1:pos1+50]:
            pos1 = -1
    if pos1 == -1:
        missing.append(f)
        continue
    pos2 = c.find('</main>', pos1)
    if pos2 == -1:
        missing.append(f)
        continue
    block = c[pos1:pos2+7]
    div_diff = block.count('<div') - block.count('</div')
    if div_diff != 0:
        unbalanced.append((f, div_diff))

print(f"Total files: {len(files)}")
print(f"Missing <main id='page'>...</main>: {len(missing)}")
print(f"Unbalanced <main id='page'>...</main>: {len(unbalanced)}")
if missing:
    print("Missing:", missing)
if unbalanced:
    print("Unbalanced:", unbalanced)

