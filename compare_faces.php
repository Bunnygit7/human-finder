<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "human finder";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch parent records
$sql = "SELECT * FROM parents"; // Adjust this query as needed
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $parent_image_path = $row['pc_image'];

        // Query to find matching outsiders
        $sql_match = "SELECT * FROM outsiders"; // Adjust this query as needed
        $stmt_match = $conn->prepare($sql_match);
        $stmt_match->execute();
        $result_match = $stmt_match->get_result();

        while ($match = $result_match->fetch_assoc()) {
            $outsider_image_path = $match['oc_image'];

            // Compare faces using Python script
            $command = escapeshellcmd("python3 face_compare.py " . escapeshellarg($parent_image_path) . " " . escapeshellarg($outsider_image_path));
            $output = exec($command);

            if ($output == 'True') {
                echo "<h2 style='margin-top: 50px;'>Matching Record(s):</h2>";
                echo "<div class='result-block'>";
                echo "<img src='" . htmlspecialchars($match['oc_image']) . "' height='300' width='300'>";
                echo "<div class='result-content'>";
                echo "<h3>" . htmlspecialchars($match['oc_name']) . "</h3>";
                echo "<p>Age: " . htmlspecialchars($match['oc_age']) . "</p>";
                echo "<p>Gender: " . htmlspecialchars($match['oc_gender']) . "</p>";
                echo "<p><strong>Found Date:</strong> " . htmlspecialchars($match['found_date']) . "</p>";
                echo "<p><strong>Shirt Color:</strong> " . htmlspecialchars($match['oc_shirt_color']) . "</p>";
                echo "<p><strong>Pant Color:</strong> " . htmlspecialchars($match['oc_pant_color']) . "</p>";
                echo "<p><strong>Identifications:</strong> " . htmlspecialchars($match['oc_identifications']) . "</p>";
                echo "<p><strong>Extra Information:</strong> " . htmlspecialchars($match['oc_extra_info']) . "</p>";
                echo "<p><strong>Outsider's name:</strong> " . htmlspecialchars($match['o_name']) . "</p>";
                echo "<p><strong>Outsider's address:</strong> " . htmlspecialchars($match['o_address']) . "</p>";
                echo "<p><strong>Outsider's no:</strong> <a href='tel:" . htmlspecialchars($match['o_phone']) . "'>" . htmlspecialchars($match['o_phone']) . "<a></p>";
                echo "</div>"; // result-content
                echo "</div>"; // result-block
            }
        }
    }
} else {
    echo "No records found.";
}

$conn->close();
?>
