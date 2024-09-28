import sys
import face_recognition
import mysql.connector

# Retrieve the uploaded image path from the command line argument
uploaded_image_path = sys.argv[1]

# Connect to the database
db_connection = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="human finder"
)

cursor = db_connection.cursor()

# Load the uploaded image
uploaded_image = face_recognition.load_image_file(uploaded_image_path)
uploaded_face_encodings = face_recognition.face_encodings(uploaded_image)

if len(uploaded_face_encodings) == 0:
    print("No face found in the uploaded image.")
    sys.exit()

uploaded_face_encoding = uploaded_face_encodings[0]

# Retrieve stored images from the database
cursor.execute("SELECT o_sno, oc_image FROM your_table_name")
records = cursor.fetchall()

matched_records = []
for record in records:
    o_sno, oc_image_path = record
    stored_image = face_recognition.load_image_file(oc_image_path)
    stored_face_encodings = face_recognition.face_encodings(stored_image)
    
    if len(stored_face_encodings) > 0:
        stored_face_encoding = stored_face_encodings[0]
        results = face_recognition.compare_faces([uploaded_face_encoding], stored_face_encoding)
        
        if results[0]:  # If a match is found
            matched_records.append(o_sno)

# Display matched records
if matched_records:
    matched_sno_string = ','.join(str(sno) for sno in matched_records)
    cursor.execute(f"SELECT * FROM your_table_name WHERE o_sno IN ({matched_sno_string})")
    matched_data = cursor.fetchall()
    
    for data in matched_data:
        print(data)  # Display all details of matched records
else:
    print("No matches found.")

# Close the cursor and connection
cursor.close()
db_connection.close()
