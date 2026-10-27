import re

with open('resources/views/partials/header.blade.php', 'r', encoding='utf-8') as f:
    header = f.read()

links = set(re.findall(r'href="([^"]+)"', header))
clean = sorted([l for l in links if not l.startswith('#') and not l.startswith('javascript:')])

print(f"Total links in header: {len(clean)}")
for l in clean:
    print(" ", l)

