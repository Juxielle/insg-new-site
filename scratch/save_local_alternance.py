import urllib.request

req = urllib.request.Request('http://insg-gabon2.test/alternance', headers={'User-Agent': 'Mozilla/5.0'})
with urllib.request.urlopen(req) as resp:
    html = resp.read().decode('utf-8')
    with open('scratch/local_alternance.html', 'w', encoding='utf-8') as f:
        f.write(html)
print("Saved local_alternance.html, length:", len(html))

