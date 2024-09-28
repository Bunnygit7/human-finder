import mysql.connector
import face_recognition
import cv2
import os

# Connect to the MySQL database
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="human finder"
)

cursor = db.cursor()

# Fetch image paths and genders from the outsiders table
cursor.execute("SELECT o_sno, oc_image, oc_gender FROM outsiders")
outsiders = cursor.fetchall()

# Fetch image paths and genders from the parents table
cursor.execute("SELECT p_sno, pc_image, pc_gender FROM parents")
parents = cursor.fetchall()

# Function to load an image from a file path and get its face encoding
def get_face_encoding_from_path(image_path):
    # Check if the file exists
    if not os.path.exists(image_path):
        print(f"Image path not found: {image_path}")
        return None

    # Load the image from the file path
    image = face_recognition.load_image_file(image_path)

    # Get face encodings from the image
    face_encodings = face_recognition.face_encodings(image)

    # Return the first face encoding if a face is found, else None
    return face_encodings[0] if face_encodings else None

# Process outsiders and parents images
outsiders_encodings = [(o[0], get_face_encoding_from_path(o[1]), o[2]) for o in outsiders if get_face_encoding_from_path(o[1]) is not None]
parents_encodings = [(p[0], get_face_encoding_from_path(p[1]), p[2]) for p in parents if get_face_encoding_from_path(p[1]) is not None]

# Compare each outsider's image with each parent's image, filtering by gender
matches = []
for oc_sno, oc_encoding, oc_gender in outsiders_encodings:
    for p_sno, p_encoding, pc_gender in parents_encodings:
        # Only compare images if the genders match
        if oc_gender == pc_gender:
            # Compare the face encodings
            results = face_recognition.compare_faces([oc_encoding], p_encoding,tolerance=0)
            if results[0]:  # If there's a match
                matches.append((oc_sno, p_sno))

# Print matching records
for match in matches:
    print(f"Outsider ID: {match[0]} matched with Parent ID: {match[1]}")

# Close the database connection
db.close()
