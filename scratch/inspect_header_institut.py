with open('resources/views/partials/header.blade.php', 'r', encoding='utf-8') as f:
    text = f.read()

import re
pos = text.find('data-toggle-id=\'INS-PRES\'')
if pos == -1:
    pos = text.find('INS-PRES')
print("INS-PRES at:", pos)
print(text[pos-100:pos+1500])

