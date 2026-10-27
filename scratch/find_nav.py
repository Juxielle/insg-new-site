with open('resources/views/partials/header.blade.php', 'r', encoding='utf-8') as f:
    lines = f.readlines()

for i, line in enumerate(lines[:150]):
    if any(k in line.lower() for k in ['<nav', 'menu_principal', 'acces_directs', 'menu', 'formation', 'recherche']):
        print(f"Line {i+1}: {line.strip()[:100]}")

