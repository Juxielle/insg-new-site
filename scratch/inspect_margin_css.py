with open('public/assets/css/custom.css', 'r', encoding='utf-8', errors='ignore') as f:
    text = f.read()

pos = text.find('margin-left: -6.7em')
if pos != -1:
    print(text[pos-200:pos+300])

