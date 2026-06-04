import mysql.connector

# Connect to your XAMPP/WAMP local database
db = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="myproject"
)

cursor = db.cursor(dictionary=True)

# Fetch groups ordered by votes
cursor.execute("SELECT name, votes FROM user WHERE role=2 ORDER BY votes DESC")
results = cursor.fetchall()

print("==== ELECTION RESULTS ====\n")

if results:
    winner = results[0]
    print(f"🏆 WINNER: {winner['name']} with {winner['votes']} votes!\n")
    
    print("Full Standings:")
    for rank, group in enumerate(results, start=1):
        print(f"{rank}. {group['name']} - {group['votes']} votes")
else:
    print("No groups found.")

db.close()