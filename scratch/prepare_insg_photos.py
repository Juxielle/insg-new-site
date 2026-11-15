import sys,json,unicodedata,re
from pathlib import Path
sys.path.insert(0,str(Path('storage/app/image-tools').resolve()))
from PIL import Image,ImageOps
import pillow_heif
pillow_heif.register_heif_opener()
manifest=json.loads(Path('storage/app/image-review/manifest.json').read_text(encoding='utf-8'));byid={p['id']:p for p in manifest}
selection={
'institution':['11-05','11-00','11-01','11-04'],
'diplomes':['05-04','05-03','05-09','05-14','05-21'],
'orientation':['13-02','13-00','13-03','13-06'],
'entreprises':['00-02','00-01','00-05','01-02','01-13','01-18'],
'partenariat-magt':['14-03','14-02','14-05'],
'recherche':['02-00','02-02','02-05','02-04'],
'conferences':['04-00','04-04','04-07','04-02'],
'intelligence-artificielle':['03-06','03-05','03-09'],
'agroalimentaire':['06-06','06-10','06-14'],
'incubateur':['07-00','07-01','07-02'],
'laboratoire':['08-16','08-18','08-14','08-03'],
'vie-etudiante':['10-00','10-01','10-07','09-07','09-06'],
'sport':['15-13','15-19','15-20','15-47'],
'campus':['12-08','12-10','08-11'],
}
for n in ['assets/images/reportages','public/assets/images/reportages']:Path(n).mkdir(parents=True,exist_ok=True)
library={}
for group,ids in selection.items():
 library[group]=[]
 for i,ident in enumerate(ids):
  source=byid[ident];filename=f'{group}-{i+1:02d}.webp';rel='assets/images/reportages/'+filename
  with Image.open(source['source']) as raw:
   im=ImageOps.exif_transpose(raw).convert('RGB');im.thumbnail((1920,1440),Image.Resampling.LANCZOS)
   im.save(rel,'WEBP',quality=84,method=6)
   Path('public/'+rel).write_bytes(Path(rel).read_bytes())
   library[group].append({'path':rel,'source_folder':source['folder'],'source_file':Path(source['source']).name,'width':im.width,'height':im.height,'bytes':Path(rel).stat().st_size})
 print(group,len(ids),flush=True)
Path('resources/content/phototheque-insg.json').write_text(json.dumps(library,ensure_ascii=False,indent=2)+'\n',encoding='utf-8')
