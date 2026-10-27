with open('resources/views/partials/header.blade.php', 'r', encoding='utf-8') as f:
    text = f.read()

pos = 0
while True:
    pos = text.find('menu_principal', pos)
    if pos == -1:
        break
    print(f"Found menu_principal at {pos}:")
    print(text[max(0, pos-100):pos+200])
    print("-" * 50)
    pos += 14

