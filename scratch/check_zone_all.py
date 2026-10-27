import glob

files = glob.glob('html_static/*.html')
missing_zone = []

for f in files:
    with open(f, 'r', encoding='utf-8', errors='ignore') as fp:
        c = fp.read()
    if 'id="zone_navigation"' not in c:
        missing_zone.append(f)

print(f"Total files: {len(files)}")
print(f"Files without zone_navigation: {len(missing_zone)}")
if missing_zone:
    print("Files without zone_navigation:")
    for f in missing_zone:
        print(" -", f)

