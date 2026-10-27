with open('public/assets/css/index_style.css', 'r', encoding='utf-8', errors='ignore') as f:
    text = f.read()

print("Length of index_style.css:", len(text))
print("First 1500 chars:")
print(text[:1500])
print("\nLast 1000 chars:")
print(text[-1000:])

