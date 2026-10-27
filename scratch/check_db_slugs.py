import sqlite3

conn = sqlite3.connect('database/database.sqlite')
cursor = conn.cursor()

print("=== FORMATIONS ===")
for row in cursor.execute("SELECT id, title, slug FROM formations LIMIT 5"):
    print(row)

print("\n=== ACTUALITES ===")
for row in cursor.execute("SELECT id, title, slug FROM actualites LIMIT 5"):
    print(row)

print("\n=== EVENEMENTS ===")
for row in cursor.execute("SELECT id, title, slug FROM evenements LIMIT 5"):
    print(row)

