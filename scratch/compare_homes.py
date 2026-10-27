import re

with open('scratch/univ_lyon3_home.html', 'r', encoding='utf-8') as f:
    lyon_home = f.read()

with open('resources/views/pages/home.blade.php', 'r', encoding='utf-8') as f:
    insg_home = f.read()

# Extract main from lyon
m_lyon = re.search(r'<main\b[^>]*>(.*?)</main>', lyon_home, re.DOTALL)
m_insg = re.search(r'<main\b[^>]*>(.*?)</main>', insg_home, re.DOTALL)

print("=== LYON 3 HOME MAIN ===")
if m_lyon:
    lines = [l.strip() for l in m_lyon.group(1).splitlines() if l.strip()]
    print("Total lines in <main>:", len(lines))
    # print all div ids and classes
    tags = re.findall(r'<div\b[^>]*>', m_lyon.group(1))
    print("Divs count:", len(tags))
    print("First 15 divs in lyon home:")
    for t in tags[:15]:
        print(" ", t)

print("\n=== INSG HOME MAIN ===")
if m_insg:
    tags_insg = re.findall(r'<div\b[^>]*>', m_insg.group(1))
    print("Divs count:", len(tags_insg))
    print("First 15 divs in insg home:")
    for t in tags_insg[:15]:
        print(" ", t)

