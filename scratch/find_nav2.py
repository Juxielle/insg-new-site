with open('resources/views/partials/header.blade.php', 'r', encoding='utf-8') as f:
    lines = f.readlines()

for i in range(145, min(250, len(lines))):
    line = lines[i]
    if any(k in line.lower() for k in ['<nav', 'menu_principal', 'acces_directs', 'menu__level', 'institut', 'formation', 'recherche', 'entreprises', 'international', 'campus']):
        print(f"Line {i+1}: {line.strip()[:100]}")

