import os
import glob

files = glob.glob('html_static/*.html')
print(f"Total html files: {len(files)}")
print("Sample files:", [os.path.basename(f) for f in files[:20]])

