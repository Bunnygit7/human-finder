# Import necessary libraries
import face_recognition
import os
import sys

def find_matching_images(reference_image_path, images_directory):
    # Load the reference image and get its encoding
    reference_image = face_recognition.load_image_file(reference_image_path)
    reference_encodings = face_recognition.face_encodings(reference_image)

    if len(reference_encodings) == 0:
        print("No face found in the reference image.")
        return []

    reference_encoding = reference_encodings[0]
    matched_images = []

    # Loop through all images in the directory
    for filename in os.listdir(images_directory):
        image_path = os.path.join(images_directory, filename)
        if os.path.isfile(image_path):
            # Load each image and get its encoding
            image = face_recognition.load_image_file(image_path)
            encodings = face_recognition.face_encodings(image)

            # If the image contains a face, compare it
            if len(encodings) > 0:
                match = face_recognition.compare_faces([reference_encoding], encodings[0], tolerance=0.6)

                # If a match is found, add to the matched images list
                if match[0]:
                    matched_images.append(filename)

    return matched_images

if __name__ == "__main__":
    # Accept paths from command-line arguments
    if len(sys.argv) != 3:
        print("Usage: python script.py <reference_image_path> <images_directory>")
        sys.exit(1)

    reference_image_path = sys.argv[1]
    images_directory = sys.argv[2]
    matched_images = find_matching_images(reference_image_path, images_directory)

    # Print matched image filenames
    if matched_images:
        print("\n".join(matched_images))
    else:
        print("No matches found.")
