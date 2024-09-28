<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$phone = $_SESSION['phone'];

// Database connection
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'human finder';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
function moveAndDelete($conn, $table, $sno_field, $sno_value) {
    // Delete dependent rows first (if any)
    $sql_delete_dependents = "DELETE FROM match_table WHERE $sno_field = ?";
    $stmt_delete_dependents = $conn->prepare($sql_delete_dependents);
    if (!$stmt_delete_dependents) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt_delete_dependents->bind_param("i", $sno_value);
    if (!$stmt_delete_dependents->execute()) {
        die("Error deleting dependent data: " . $stmt_delete_dependents->error);
    }
    $stmt_delete_dependents->close();

    // Prepare the correct insert query for the 'parents' table
    if ($table == 'parents') {
        $sql_move = "INSERT INTO success_data (s_name, s_age, s_shirt_color, s_pant_color, s_gender, s_identifications, sop_name, sop_phone, sop_address, s_extra_info, s_date) 
                     SELECT pc_name, pc_age, pc_shirt_color, pc_pant_color, pc_gender, pc_identifications, p_name, p_phone, p_address, pc_extra_info, CURRENT_TIMESTAMP 
                     FROM parents WHERE p_sno = ?";
    } else {
        $sql_move = "INSERT INTO success_data (s_name, s_age, s_shirt_color, s_pant_color, s_gender, s_identifications, sop_name, sop_phone, sop_address, s_extra_info, s_date) 
                     SELECT oc_name, oc_age, oc_shirt_color, oc_pant_color, oc_gender, oc_identifications, o_name, o_phone, o_address, oc_extra_info, CURRENT_TIMESTAMP 
                     FROM outsiders WHERE o_sno = ?";
    }

    $stmt_move = $conn->prepare($sql_move);
    if (!$stmt_move) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt_move->bind_param("i", $sno_value);
    if ($stmt_move->execute()) {
        $stmt_move->close();

        // Prepare the delete query for the original table
        $sql_delete = "DELETE FROM $table WHERE $sno_field = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        if (!$stmt_delete) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt_delete->bind_param("i", $sno_value);
        if ($stmt_delete->execute()) {
            $stmt_delete->close();
            displaySuccessMessage();
        } else {
            die("Error deleting data: " . $stmt_delete->error);
        }
    } else {
        die("Error moving data: " . $stmt_move->error);
    }
}



function displaySuccessMessage() {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Note</title>
        <style>
            .s_note {
                background-color: aqua;
                margin-top: 15%;
                position: absolute;
                margin-left: 30%;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            a {
                text-decoration: none;
                color: blue;
            }
            a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class='s_note' align='center'>
            <h1>Thank you for taking a step ahead</h1>
            <h2>The details of the child have been successfully deleted.</h2>
            <p>Click here to return to the <a href='proj.php'>home page</a> or <a href='profile.php'>profile</a></p>
        </div>
    </body>
    </html>";
    exit();
}

// Handle delete requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['pcdelete'])) {
        $p_sno = $_POST['p_sno'];
        moveAndDelete($conn, 'parents', 'p_sno', $p_sno);
    } elseif (isset($_POST['ocdelete'])) {
        $o_sno = $_POST['o_sno'];
        moveAndDelete($conn, 'outsiders', 'o_sno', $o_sno);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <style>
        .navbar1 {
            width: 100%;
            position: absolute;
            margin-top: -4.9%;
        }
        .navbar1 ul {
            list-style-type: none;
            background-color: black;
            opacity: 0.6;
            padding: 0px;
            margin-top: 4.8%;
            overflow: hidden;
        }
        .navbar1 a {
            opacity: 0.6;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 15px;
            text-decoration: none;
        }
        .navbar1 a:hover {
            opacity: 1;
        }
        .navbar1 li {
            float: left;
        }
        .navbar1 a.active {
            background-color: #ddd;
            color: black;
            opacity: 1;
        }
        .hp_head {
            background-color: #000000;
            z-index: 1;
            text-align: center;
            width: 100%;
            height: 10%;
            cursor: pointer;
        }
        .hp_logo {
            cursor: pointer;
            margin-top: -6%;
            margin-left: 0%;
            position: absolute;
        }
        .account_logo {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .modal {
            display: none; /* Initially hidden */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            justify-content: center;
            align-items: center;
            /* padding-top: 100px; */
        }
        .modal-content {
            /* background-color:rgba(0, 0, 0, 0.5); */
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 700px;
            position: relative;
        }
        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #000;
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
            color: white;
        }
        .close:hover {
            color: red;
        }
        .result-block {
            background-color: #f9f9f9;
            border-radius: 15px;
            padding: 20px;
            margin: 20px;
            display: flex;
            align-items: center;
        }
        .result-block img {
            margin-right: 20px;
            border-radius: 10px;
        }
        .result-content {
            flex: 1;
        }
        .dynamic-content {
            padding: 20px;
        }
    </style>
</head>
<body style="margin: 0%; background-color:antiquewhite;">

<div class="hp_head" style="margin-top: 0%;">
    <a href="proj.php">
        <img src="photos for project/Screenshot__111_-removebg-preview.png" alt="" height="80" width="250" align="center">
    </a>
</div>

<div class="navigation-container">
    <nav class="navbar1">
        <ul>
            <li><a href="proj.php" id="homeLink" class="nav-link">HOME</a></li>
            <li><a href="orphanage.php" class="nav-link">ORPHANAGE LIST</a></li>
            <li><a href="#" class="nav-link">NEWS</a></li>
            <li><a href="#" class="nav-link">BEWARE</a></li>
            <li><a href="about us.php" class="nav-link">ABOUT US</a></li>
        </ul>
    </nav>
</div>

<a href="<?php echo isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ? 'profile.php' : 'login.php'; ?>">
    <img src="photos for project/acc_logo-removebg-preview.png" alt="Account Logo" class="account_logo" height="50" width="50">
</a>

<a href="proj.php">
    <img class="hp_logo" src="photos for project/Screenshot__113_-removebg-preview.png" alt="" height="95" width="120" align="left">
</a>

<div class="left_block" style="background-color:#000000; width:18%; margin-top: 3.1%; color:antiquewhite; height: 100vh;">
    <?php
    // Retrieve user information based on phone number from session
    $stmt = $conn->prepare("SELECT * FROM users WHERE phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();
   

    

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
            echo "<div style='position: absolute; margin-top: 0%; margin-left: 3%;'>";
            echo "<h1 align='center'>" . htmlspecialchars($row['name']) . "<br></h1>";
            echo "<h1 align='center'>" . htmlspecialchars($row['phone']) . "<br></h1>";
            echo "<h1 align='center'>" . htmlspecialchars($row['address']) . "<br></h1>";
            echo "</div>";
            
            ?>
            <form action="p update.php" method="post" enctype="multipart/form-data" style="position: absolute; margin-top: 35%; margin-left: 12%;">
            <!-- Hidden input to pass p_sno value -->
            <input type="hidden" name="u_id" value="<?php echo htmlspecialchars($row['u_id']); ?>">
            <input type="submit" value="Edit">
            </form>
            <?php
        }
    } else {
        echo "No user found.";
    }
    $stmt->close();
    ?>

    <!-- <form id="notificationsForm" style="position: absolute; margin-top: 20%; margin-left: 1%;">
        <input type="button" value="Notifications" onclick="openModal()">
    </form> -->

    <form action="logout.php" method="post" style="position: absolute; margin-top: 35%; margin-left: 1%;">
        <input type="submit" value="Logout">
    </form>

    

</div>

<div class="right_block" style="background-color:antiquewhite; width: auto; margin-left: 18.5%; margin-top: -717px; margin-right: 7px; border-radius: 21px;">
    <?php
    // Flag to check if any records are displayed
    $recordsDisplayed = false;

    
function displayRecord($record, $type, $showDeleteButton = false) {
    global $recordsDisplayed;
    $recordsDisplayed = true; // Set flag to true when a record is displayed

    // Display the record details safely
    $image = isset($record[$type . '_image']) ? htmlspecialchars($record[$type . '_image']) : 'default_image.png';
    $name = isset($record[$type . '_name']) ? htmlspecialchars($record[$type . '_name']) : 'Unknown';
    $age = isset($record[$type . '_age']) ? htmlspecialchars($record[$type . '_age']) : 'Unknown';
    $gender = isset($record[$type . '_gender']) ? htmlspecialchars($record[$type . '_gender']) : 'Unknown';
    $date = $type === 'pc' ? (isset($record['missing_date']) ? htmlspecialchars($record['missing_date']) : 'Unknown') : (isset($record['found_date']) ? htmlspecialchars($record['found_date']) : 'Unknown');
    $shirtColor = isset($record[$type . '_shirt_color']) ? htmlspecialchars($record[$type . '_shirt_color']) : 'Unknown';
    $pantColor = isset($record[$type . '_pant_color']) ? htmlspecialchars($record[$type . '_pant_color']) : 'Unknown';
    $identifications = isset($record[$type . '_identifications']) ? htmlspecialchars($record[$type . '_identifications']) : 'None';
    $extraInfo = isset($record[$type . '_extra_info']) ? htmlspecialchars($record[$type . '_extra_info']) : 'None';
    $phone = $type === 'pc' ? (isset($record['p_phone']) ? htmlspecialchars($record['p_phone']) : 'N/A') : (isset($record['o_phone']) ? htmlspecialchars($record['o_phone']) : 'N/A');

    echo "<div class='result-block'>";
    echo "<img src='{$image}' height='300' width='300'>";
    echo "<div class='result-content'>";
    echo "<h1>{$name}</h1>";
    echo "<p>Age: {$age}</p>";
    echo "<p>Gender: {$gender}</p>";
    echo "<p><strong>" . ($type === 'pc' ? 'Missing' : 'Found') . " Date:</strong> {$date}</p>";
    echo "<p><strong>Shirt Color:</strong> {$shirtColor}</p>";
    echo "<p><strong>Pant Color:</strong> {$pantColor}</p>";
    echo "<p><strong>Identifications:</strong> {$identifications}</p>";
    echo "<p><strong>Extra Information:</strong> {$extraInfo}</p>";
    echo "<p><strong>Phone Number:</strong> <a href='tel:{$phone}'>{$phone}</a></p>";

    // Display the delete button only if $showDeleteButton is true
    if ($showDeleteButton) {
        // Ensure the array has the correct key before trying to use it
        if ($type === 'pc' && isset($record['p_sno'])) {
            $id = $record['p_sno'];
            $inputName = 'p_sno'; // Input name for parents
        } elseif ($type === 'oc' && isset($record['o_sno'])) {
            $id = $record['o_sno'];
            $inputName = 'o_sno'; // Input name for outsiders
        } else {
            $id = null;
        }

        if ($id !== null) {
            echo "<form method='post' style='display:inline; margin-right:10px;'>";
            echo "<input type='hidden' name='{$inputName}' value='" . htmlspecialchars($id) . "'>";
            echo "<button type='submit' name='{$type}delete'>Delete</button>";
            echo "</form>";
        }
    }

    echo "</div>"; // result-content
    echo "</div>"; // result-block
}



    function displayMatchingRecord($stmt, $matchType) {
        global $recordsDisplayed;
        $stmt->execute();
        $result_match = $stmt->get_result();
        if ($result_match->num_rows > 0) {
            echo "<h2 style='margin-top: 50px;'>Matching Record:</h2>";
            while ($match = $result_match->fetch_assoc()) {
                $recordsDisplayed = true; // Set flag to true when a matching record is displayed
                displayRecord($match, $matchType, false); // Do not show delete button for matching records
            }
        } else {
            echo "<p>No matching record(s) found yet.</p>";
        }
        $stmt->close();
    }

    // Retrieve user information based on phone number from session
    $stmt = $conn->prepare("SELECT * FROM parents WHERE p_phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $p_sno = $row['p_sno'];
            displayRecord($row, 'pc', true); // Show delete button for parent record

            // Retrieve matching records
            $sql_match = "SELECT * FROM outsiders WHERE o_sno=(SELECT o_sno from match_table WHERE p_sno=?)";
            $stmt_match = $conn->prepare($sql_match);
            $stmt_match->bind_param("i", $p_sno);
            displayMatchingRecord($stmt_match, 'oc');
        }
    }

    // Retrieve outsider information
    $o_stmt = $conn->prepare("SELECT * FROM outsiders WHERE o_phone = ?");
    $o_stmt->bind_param("s", $phone);
    $o_stmt->execute();
    $o_result = $o_stmt->get_result();

    if ($o_result->num_rows > 0) {
        while ($row = $o_result->fetch_assoc()) {
            $o_sno = $row['o_sno'];
            displayRecord($row, 'oc', true); // Show delete button for outsider record

            // Retrieve matching records
            $sql_match = "SELECT * FROM parents WHERE p_sno=(SELECT p_sno from match_table WHERE o_sno=?)";
            $stmt_match = $conn->prepare($sql_match);
            $stmt_match->bind_param("i", $o_sno);
            displayMatchingRecord($stmt_match, 'pc');
        }
    }

    // Display "No cases found" only if no records have been displayed
    if (!$recordsDisplayed) {
        echo "<h2 style='text-align: center; margin-top: 100px;'>No cases Registered.</h2>";
    }

    $stmt->close();
    $o_stmt->close();
    $conn->close();
?>





    <!-- Popup Modal for Notifications -->
    <div id="notificationsModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="dynamicContent" class="dynamic-content">
                Notifications content will be loaded here
            </div>
        </div>
    </div> 

    <!-- Modal Structure for Images -->
    <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeImageModal()">&times;</span>
            <img class="modal-content" id="fullImage">
            <div id="caption"></div>
        </div>
    </div> 

     <script>
    function openModal() {
        var modal = document.getElementById("notificationsModal");
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'notifications.php', true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                // Display the content
                var dynamicContent = document.getElementById('dynamicContent');
                dynamicContent.innerHTML = xhr.responseText;
                modal.style.display = 'flex';
            } else {
                console.error('Error loading notifications');
            }
        };
        xhr.onerror = function() {
            console.error('Request failed');
        };
        xhr.send();
    }

    function closeModal() {
        document.getElementById("notificationsModal").style.display = "none";
    }

    function closeImageModal() {
        document.getElementById("imageModal").style.display = "none";
    }

    // Get the modal for images
    var modalImg = document.getElementById("fullImage");
    var captionText = document.getElementById("caption");

    // Handle multiple images
    document.querySelectorAll('.result-block img').forEach(function(img) {
        img.onclick = function() {
            var modal = document.getElementById("imageModal");
            modal.style.display = "flex";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }
    });

    // Get the <span> element that closes the image modal
    var span = document.getElementsByClassName("close")[1];
    span.onclick = function() { 
        closeImageModal();
    }
    </script> 
</div>

</body>
</html>
