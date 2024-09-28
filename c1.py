import mysql.connector
import face_recognition
import cv2
import numpy as np
import os

# Connect to the MySQL database
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="human finder"
)

cursor = db.cursor()

# Fetch image paths from the outsiders table
cursor.execute("SELECT o_sno, oc_image FROM outsiders")
outsiders = cursor.fetchall()

# Fetch image paths from the parents table
cursor.execute("SELECT p_sno, pc_image FROM parents")
parents = cursor.fetchall()

# Function to load image from a file path and get face encodings
def get_face_encoding_from_path(image_path):
    if not os.path.exists(image_path):
        print(f"Image file not found: {image_path}")
        return None

    # Load the image using face_recognition
    image = face_recognition.load_image_file(image_path)

    # Get face encodings
    face_encodings = face_recognition.face_encodings(image)

    # Return the first face encoding if a face is found, else None
    return face_encodings[0] if face_encodings else None

# Process outsiders' images
outsiders_encodings = []
for o in outsiders:
    oc_sno, oc_image_path = o
    oc_encoding = get_face_encoding_from_path(oc_image_path)
    if oc_encoding is not None:
        outsiders_encodings.append((oc_sno, oc_encoding))
    else:
        print(f"No face found in outsider image: {oc_image_path}")

# Process parents' images
parents_encodings = []
for p in parents:
    p_sno, pc_image_path = p
    p_encoding = get_face_encoding_from_path(pc_image_path)
    if p_encoding is not None:
        parents_encodings.append((p_sno, p_encoding))
    else:
        print(f"No face found in parent image: {pc_image_path}")

# Compare each outsider with each parent
matches = []
for oc_sno, oc_encoding in outsiders_encodings:
    for p_sno, p_encoding in parents_encodings:
        # Compare the face encodings with a tolerance level
        match = face_recognition.compare_faces([oc_encoding], p_encoding, tolerance=0)
        if match[0]:
            matches.append((oc_sno, p_sno))

# Print matching records
if matches:
    for match in matches:
        print(f"Outsider ID: {match[0]} matched with Parent ID: {match[1]}")
else:
    print("No matches found.")

# Close the database connection
db.close()
