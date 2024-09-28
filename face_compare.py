# face_compare.py
import face_recognition
import sys

def compare_faces(known_image_path, unknown_image_path):
    # Load the images
    known_image = face_recognition.load_image_file(known_image_path)
    unknown_image = face_recognition.load_image_file(unknown_image_path)

    # Get the face encodings
    known_encodings = face_recognition.face_encodings(known_image)
    unknown_encodings = face_recognition.face_encodings(unknown_image)

    if not known_encodings or not unknown_encodings:
        return False

    known_encoding = known_encodings[0]
    unknown_encoding = unknown_encodings[0]

    # Compare faces
    results = face_recognition.compare_faces([known_encoding], unknown_encoding)
    return results[0]

if __name__ == "__main__":
    if len(sys.argv) != 3:
        print("Usage: python3 face_compare.py <known_image> <unknown_image>")
        sys.exit(1)

    known_image_path = sys.argv[1]
    unknown_image_path = sys.argv[2]
    
    match = compare_faces(known_image_path, unknown_image_path)
    print(match)
