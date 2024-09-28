import cv2
import face_recognition
import mysql.connector
import os

# Function to fetch image paths from the MySQL database
def fetch_image_paths_from_db():
    # Connect to the MySQL database
    conn = mysql.connector.connect(
        host="localhost",  # Replace with your MySQL server host
        user="root",  # Replace with your MySQL username
        password="",  # Replace with your MySQL password
        database="human finder"  # Replace with your MySQL database name
    )
    cursor = conn.cursor()

    # Assuming there's a table named 'images' with a column 'path'
    cursor.execute("SELECT pc_image FROM parents")
    image_paths = cursor.fetchall()

    conn.close()

    # Flatten the list of tuples to a list of paths
    return [path[0] for path in image_paths]

# Load the target image
target_img = cv2.imread("images/parents/66cd8c39f40a4.png")
target_rgb_img = cv2.cvtColor(target_img, cv2.COLOR_BGR2RGB)
target_img_encoding = face_recognition.face_encodings(target_rgb_img)[0]

# Fetch image paths from the MySQL database
image_paths = fetch_image_paths_from_db()

# Loop through each image path
for img_path in image_paths:
    # Load the current image
    img = cv2.imread(img_path)
    
    # Check if the image is loaded successfully
    if img is None:
        print(f"Image at {img_path} could not be loaded.")
        continue

    # Convert the image to RGB format
    rgb_img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
    
    # Get the face encoding for the current image
    img_encodings = face_recognition.face_encodings(rgb_img)
    
    # If no faces are found in the image, skip to the next one
    if len(img_encodings) == 0:
        print(f"No face found in image at {img_path}.")
        continue
    
    # Compare the target image encoding with the current image encoding
    result = face_recognition.compare_faces([target_img_encoding], img_encodings[0])
    
    # If the result is True, display the matched image
    if result[0]:
        print(f"Match found in image at {img_path}.")
        cv2.imshow(f"Matched Image - {os.path.basename(img_path)}", img)
        cv2.waitKey(0)  # Display the image until a key is pressed
        cv2.destroyAllWindows()  # Close the image window after the key press

