import urllib.request
import ssl

ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

req = urllib.request.Request(
    'https://www.univ-lyon3.fr/',
    headers={'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'}
)

try:
    with urllib.request.urlopen(req, context=ctx, timeout=15) as resp:
        html = resp.read().decode('utf-8', errors='ignore')
        print("Fetched univ-lyon3.fr successfully! Length:", len(html))
        with open('scratch/univ_lyon3_home.html', 'w', encoding='utf-8') as out:
            out.write(html)
        print("Saved to scratch/univ_lyon3_home.html")
except Exception as e:
    print("Error fetching univ-lyon3.fr:", e)

