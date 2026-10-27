import re

with open('scratch/univ_lyon3_alternance.html', 'r', encoding='utf-8') as f:
    lyon = f.read()

with open('scratch/local_alternance.html', 'r', encoding='utf-8') as f:
    local = f.read()

def get_tag_content(html, tag):
    m = re.search(r'<' + tag + r'\b[^>]*>(.*?)</' + tag + r'>', html, re.DOTALL | re.I)
    return m.group(1) if m else None

lyon_main = get_tag_content(lyon, 'main')
local_main = get_tag_content(local, 'main')

print(f"Lyon <main> length: {len(lyon_main) if lyon_main else 0}")
print(f"Local <main> length: {len(local_main) if local_main else 0}")

# Compare structure of <main>
def extract_structure(html):
    # return list of opening tags with id and class
    return re.findall(r'<([a-zA-Z0-9]+)([^>]*)>', html)

lyon_struct = [(t, dict(re.findall(r'(\w+)=["\']([^"\']+)["\']', attrs))) for t, attrs in extract_structure(lyon_main)[:40]]
local_struct = [(t, dict(re.findall(r'(\w+)=["\']([^"\']+)["\']', attrs))) for t, attrs in extract_structure(local_main)[:40]]

print("\n--- FIRST 20 TAGS IN LYON MAIN ---")
for t, attrs in lyon_struct[:20]:
    print(f"  <{t} id='{attrs.get('id', '')}' class='{attrs.get('class', '')}'>")

print("\n--- FIRST 20 TAGS IN LOCAL MAIN ---")
for t, attrs in local_struct[:20]:
    print(f"  <{t} id='{attrs.get('id', '')}' class='{attrs.get('class', '')}'>")

