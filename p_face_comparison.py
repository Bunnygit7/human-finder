import sys
import face_recognition
import mysql.connector

# Get the uploaded image path, parent sno, and gender from the arguments
uploaded_image_path = sys.argv[1]
p_sno = sys.argv[2]
uploaded_gender = sys.argv[3]

# Connect to the database
db = mysql.connector.connect(
    host='localhost',
    user='root',
    password='',
    database='human finder'
)
cursor = db.cursor()

# Load the uploaded image
uploaded_image = face_recognition.load_image_file(uploaded_image_path)
uploaded_encodings = face_recognition.face_encodings(uploaded_image)

if len(uploaded_encodings) > 0:
    uploaded_encoding = uploaded_encodings[0]
else:
    print("No face found in the uploaded image.")
    sys.exit(1)

# Fetch all images from the outsiders table with the same gender
query = "SELECT o_sno, oc_image FROM outsiders WHERE oc_gender = %s"
cursor.execute(query, (uploaded_gender,))
outsiders = cursor.fetchall()

matched = False

# Compare with each outsider image
for outsider in outsiders:
    o_sno, oc_image_path = outsider
    outsider_image = face_recognition.load_image_file(oc_image_path)
    outsider_encodings = face_recognition.face_encodings(outsider_image)

    if len(outsider_encodings) > 0:
        outsider_encoding = outsider_encodings[0]
        results = face_recognition.compare_faces([uploaded_encoding], outsider_encoding)

        if results[0]:  # If a match is found
            # Store the match in match_table
            cursor.execute("INSERT INTO match_table (o_sno, p_sno) VALUES (%s, %s)", (o_sno, p_sno))
            db.commit()
            matched = True
            print(f"Match found between p_sno {p_sno} and o_sno {o_sno}.")
            break

if not matched:
    print("No match found.")

# Close the database connection
cursor.close()
db.close()
