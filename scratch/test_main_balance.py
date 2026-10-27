with open('html_static/faculte-de-droit.html', 'r', encoding='utf-8', errors='ignore') as fp:
    c = fp.read()

pos1 = c.find('<main id="page">')
pos2 = c.find('</main>', pos1)
main_block = c[pos1:pos2+7]

print("Length of main_block:", len(main_block))
print("Div open:", main_block.count('<div'))
print("Div close:", main_block.count('</div'))
print("Main open:", main_block.count('<main'))
print("Main close:", main_block.count('</main'))

