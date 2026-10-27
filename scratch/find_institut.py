with open('resources/views/partials/header.blade.php', 'r', encoding='utf-8') as f:
    text = f.read()

pos = text.find('Institut')
while pos != -1:
    print("Found Institut at", pos, ":", repr(text[pos-40:pos+80]))
    pos = text.find('Institut', pos+1)
    if pos > 10000:
        break

