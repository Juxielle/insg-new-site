with open('scratch/univ_lyon3_alternance.html', 'r', encoding='utf-8') as f:
    text = f.read()

pos = text.find('<header')
print("LIVE LYON 3 HEADER TAG:")
print(text[pos:pos+300])

# And let's find #bandeau in live lyon 3
pos_bandeau = text.find('id="bandeau"')
print("LIVE LYON 3 BANDEAU:")
print(text[pos_bandeau-50:pos_bandeau+250])

