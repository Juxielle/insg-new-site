import re

with open('resources/views/partials/header.blade.php', 'r', encoding='utf-8') as f:
    text = f.read()

# Find all hrefs
links = re.findall(r'href="([^"]+)"', text)
unique_links = set()
for l in links:
    l = l.strip()
    if not l.startswith('#') and not l.startswith('javascript:') and not l.startswith('mailto:') and not l.startswith('http'):
        unique_links.add(l)

print(f"Total unique internal links in header: {len(unique_links)}")
for l in sorted(unique_links):
    print(" ", l)

