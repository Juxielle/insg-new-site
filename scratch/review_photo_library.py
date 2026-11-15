import sys,json,math
from pathlib import Path
sys.path.insert(0,str(Path('storage/app/image-tools').resolve()))
from PIL import Image,ImageOps,ImageDraw,ImageFont
import pillow_heif
pillow_heif.register_heif_opener()
root=Path(r'C:\Users\User\Downloads\insg-res');out=Path('storage/app/image-review');out.mkdir(exist_ok=True)
font=ImageFont.truetype('C:/Windows/Fonts/arial.ttf',13)
manifest=[]
for di,d in enumerate(sorted([d for d in root.iterdir() if d.is_dir()])):
 files=sorted([p for p in d.rglob('*') if p.suffix.lower() in ['.jpg','.jpeg','.png','.heic']])
 sheet=Image.new('RGB',(1040,math.ceil(len(files)/4)*192+35),'white');draw=ImageDraw.Draw(sheet);draw.text((8,6),d.name,font=font,fill='black')
 for i,p in enumerate(files):
  try:
   with Image.open(p) as raw:
    im=ImageOps.exif_transpose(raw);size=im.size;im.thumbnail((250,156));im=im.convert('RGB')
    x=(i%4)*260;y=(i//4)*192+35;sheet.paste(im,(x+(260-im.width)//2,y));draw.text((x+5,y+158),f'{di:02d}-{i:02d} {p.name[:23]}',font=font,fill='black')
    manifest.append({'id':f'{di:02d}-{i:02d}','folder':d.name,'source':str(p),'width':size[0],'height':size[1]})
  except Exception as e:print('ERROR',str(p).encode('ascii','backslashreplace').decode(),str(e))
 sheet.save(out/f'sheet-{di:02d}.jpg',quality=85)
 print(di,d.name.encode('ascii','backslashreplace').decode(),len(files),flush=True)
(out/'manifest.json').write_text(json.dumps(manifest,ensure_ascii=False,indent=2),encoding='utf-8')
