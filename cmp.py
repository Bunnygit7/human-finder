import mysql.connector
import face_recognition
import sys
import os

# Retrieve arguments
uploaded_image_path = sys.argv[1]
p_sno = int(sys.argv[2])

# Connect to the MySQL database
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="human finder"
)

cursor = db.cursor()

# Function to load an image from a file path and get its face encoding
def get_face_encoding_from_path(image_path):
    if not os.path.exists(image_path):
        return None
    image = face_recognition.load_image_file(image_path)
    face_encodings = face_recognition.face_encodings(image)
    return face_encodings[0] if face_encodings else None

# Fetch the gender of the uploaded image
cursor.execute("SELECT pc_gender FROM parents WHERE p_sno=%s", (p_sno,))
uploaded_gender = cursor.fetchone()

if uploaded_gender is None:
    print("Parent ID not found.")
    sys.exit()

uploaded_gender = uploaded_gender[0]

# Fetch image paths and genders from the outsiders table
cursor.execute("SELECT o_sno, oc_image, oc_gender FROM outsiders")
outsiders = cursor.fetchall()

# Load the uploaded image and get its face encoding
uploaded_encoding = get_face_encoding_from_path(uploaded_image_path)

if uploaded_encoding is None:
    print("No face detected in the uploaded image.")
    sys.exit()

# Compare each outsider's image with the uploaded image, filtering by gender
matches = []
non_matches = []
for o_sno, oc_image, oc_gender in outsiders:
    if oc_gender != uploaded_gender:
        continue
    
    oc_img_path = 'images/outsiders/' + oc_image
    oc_encoding = get_face_encoding_from_path(oc_img_path)

    if oc_encoding is not None:
        # Compare the face encodings
        results = face_recognition.compare_faces([uploaded_encoding], oc_encoding, tolerance=0)
        if results[0]:  # If there's a match
            matches.append(o_sno)
        else:
            non_matches.append(o_sno)

# Insert matches into the match_table
for o_sno in matches:
    match_sql = "INSERT INTO match_table (p_sno, o_sno) VALUES (%s, %s)"
    cursor.execute(match_sql, (p_sno, o_sno))

# Insert non-matches into the not_match table
for o_sno in non_matches:
    not_match_sql = "INSERT INTO not_match (p_sno, o_sno) VALUES (%s, %s)"
    cursor.execute(not_match_sql, (p_sno, o_sno))

db.commit()
print(f"Matches found and inserted into match_table: {matches}")
print(f"Non-matches found and inserted into not_match_table: {non_matches}")

# Close the database connection
cursor.close()
db.close()
