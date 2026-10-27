import os

for f in ['html_static/champs-disciplinaires.html', 'html_static/nos-formations.html', 'html_static/formation-initiale.html', 'html_static/candidater-et-s-inscrire.html']:
    print(f, "exists:", os.path.exists(f))
    if os.path.exists(f):
        print("size:", os.path.getsize(f))

