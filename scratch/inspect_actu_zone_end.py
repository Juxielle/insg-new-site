with open('scratch/univ_lyon3_actu.html', 'r', encoding='utf-8', errors='ignore') as f:
    txt = f.read()
import re
idx = txt.find('</div><!-- \n\t\t\n\t\t\n\t\t\n\t\t--><div id="fil_ariane">')
if idx == -1:
    idx = txt.find('id="fil_ariane"')
print("Around fil_ariane in actu:")
print(txt[idx-50:idx+600])

idx_zone_end = txt.find('<!-- /#zone_navigation -->')
if idx_zone_end == -1:
    # find closing div of zone_navigation
    idx_zone = txt.find('id="zone_navigation"')
    # find next sibling after zone_navigation
    print("\nNext 1000 chars after fil_ariane:")
    print(txt[idx:idx+1500])

