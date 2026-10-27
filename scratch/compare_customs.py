with open('assets/css/custom.css', 'rb') as f1, open('public/assets/css/custom.css', 'rb') as f2:
    print("Identical:", f1.read() == f2.read())

