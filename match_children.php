<?php
// Paths to Python executable and the Python script
$pythonExecutable = '/usr/bin/python3';  // Adjust the path to your Python installation
$pythonScript = '/path/to/match_children.py';  // Adjust to where you saved the Python script

// Paths to the reference image and the directory containing child images
$referenceImagePath = 'path/to/reference_image.jpg';  // Replace with actual path to reference image
$imagesDirectory = 'path/to/child_images/';  // Replace with the actual path to the images directory

// Prepare the command to run the Python script
$command = escapeshellcmd("$pythonExecutable $pythonScript $referenceImagePath $imagesDirectory");
$output = shell_exec($command);

// Convert the output into an array
$matchedImages = explode("\n", trim($output));

// Display matched records
echo "<h3>Matched Records:</h3>";
if (!empty($matchedImages[0]) && $matchedImages[0] != "No matches found.") {
    foreach ($matchedImages as $image) {
        echo "<p><img src='$imagesDirectory$image' alt='$image' style='width:100px;height:auto;'></p>";  // Display each matched image
    }
} else {
    echo "<p>No matches found.</p>";
}
?>
