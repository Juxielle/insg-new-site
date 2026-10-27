import urllib.request
import ssl

ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

urls = [
    ('scratch/univ_lyon3_alternance.html', 'https://www.univ-lyon3.fr/alternance'),
    ('scratch/univ_lyon3_actu.html', 'https://www.univ-lyon3.fr/actualites'),
    ('scratch/univ_lyon3_universite.html', 'https://www.univ-lyon3.fr/l-universite-jean-moulin'),
    ('scratch/univ_lyon3_formations.html', 'https://www.univ-lyon3.fr/formation'),
]

for out_path, url in urls:
    try:
        req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'})
        with urllib.request.urlopen(req, context=ctx, timeout=15) as resp:
            content = resp.read().decode('utf-8', errors='ignore')
            with open(out_path, 'w', encoding='utf-8') as f:
                f.write(content)
            print(f"Saved {url} -> {out_path} ({len(content)} bytes)")
    except Exception as e:
        print(f"Error fetching {url}: {e}")

