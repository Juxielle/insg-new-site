with open('resources/views/partials/header.blade.php', 'r', encoding='utf-8') as f:
    text = f.read()

pos = text.find('<header')
print("HEADER TAG:")
print(text[pos:pos+300])

