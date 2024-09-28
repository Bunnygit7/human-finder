import sys
import face_recognition
import mysql.connector

# Get the uploaded image path, outsiders sno, and gender from the arguments
uploaded_image_path = sys.argv[1]
o_sno = sys.argv[2]
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

# Fetch all images from the parents table with the same gender
query = "SELECT p_sno, pc_image FROM parents WHERE pc_gender = %s"
cursor.execute(query, (uploaded_gender,))
parents = cursor.fetchall()

matched = False

# Compare with each parents image
for parent in parents:
    p_sno, pc_image_path = parent
    parent_image = face_recognition.load_image_file(pc_image_path)
    parent_encodings = face_recognition.face_encodings(parent_image)

    if len(parent_encodings) > 0:
        parent_encoding = parent_encodings[0]
        results = face_recognition.compare_faces([uploaded_encoding], parent_encoding)

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
