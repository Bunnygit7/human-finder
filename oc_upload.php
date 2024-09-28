<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decode the base64 encoded image
    $img = $_POST['photo'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $imgData = base64_decode($img);

    // Generate a unique file name
    $fileName = uniqid() . '.png';

    // Specify the folder to save the uploaded image
    $filePath = 'images/outsiders/' . $fileName;

    // Save the file to the server
    if (file_put_contents($filePath, $imgData)) {
        // echo "Photo uploaded successfully: " . $filePath;
        
        // Database connection
        $db_host = 'localhost';
        $db_username = 'root';
        $db_password = '';
        $db_name = 'human finder';
        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $oc_name = $conn->real_escape_string($_POST['oc_name']);
        $oc_age = $conn->real_escape_string($_POST['oc_age']);
        $found_place = $conn->real_escape_string($_POST['found_place']);
        $found_date = $conn->real_escape_string($_POST['found_date']);
        $oc_shirt_color = $conn->real_escape_string($_POST['oc_shirt_color']);
        $oc_pant_color = $conn->real_escape_string($_POST['oc_pant_color']);
        $oc_gender = $conn->real_escape_string($_POST['oc_gender']);
        $oc_identifications = $conn->real_escape_string($_POST['oc_identifications']);
        $o_name = $conn->real_escape_string($_POST['o_name']);
        $o_phone = $conn->real_escape_string($_POST['o_phone']);
        $o_address = $conn->real_escape_string($_POST['o_address']);
        $oc_extra_info = $conn->real_escape_string($_POST['oc_extra_info']);

        $username = $conn->real_escape_string($_POST['o_name']);
        $password = $conn->real_escape_string($_POST['o_phone']);
        $phone = $conn->real_escape_string($_POST['o_phone']);

        // Check if the user already exists in the 'users' table
        $check_user_query = $conn->prepare("SELECT * FROM users WHERE phone=? AND name=? AND address=?");
        $check_user_query->bind_param("sss", $phone, $o_name, $o_address);
        $check_user_query->execute();
        $result = $check_user_query->get_result();

        if ($result->num_rows == 0) {
            // Insert data into the 'users' table if the user does not exist
            $sql2 = $conn->prepare("INSERT INTO users (username, password, phone, name, address) VALUES (?, ?, ?, ?, ?)");
            $sql2->bind_param("sssss", $username, $password, $phone, $o_name, $o_address);

            if (!$sql2->execute()) {
                echo "Error: " . $sql2->error;
            }
        }

        // Insert data into the 'outsiders' table
        $sql1 = $conn->prepare("INSERT INTO outsiders (oc_image, oc_name, oc_age, found_place, found_date, oc_shirt_color, oc_pant_color, oc_gender, oc_identifications, o_name, o_phone, o_address, oc_extra_info, o_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, current_timestamp())");
        $sql1->bind_param("sssssssssssss", $filePath, $oc_name, $oc_age, $found_place, $found_date, $oc_shirt_color, $oc_pant_color, $oc_gender, $oc_identifications, $o_name, $o_phone, $o_address, $oc_extra_info);

        if ($sql1->execute()) {

            // Get the ID of the newly inserted record in 'parents' table
            $o_sno = $conn->insert_id;

            // Call Python script for face comparison and pass gender
            $pythonScriptPath = 'C:\xampp\htdocs\project\o_face_comparison.py';  // Adjust the path to the Python script
            $command = escapeshellcmd("python3 $pythonScriptPath $filePath $o_sno $oc_gender");
            $output = shell_exec($command);

            if ($output === NULL) {
                echo "Error executing face comparison.";
            } else {
                echo $output;
                 // Success message
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
                    <h2>The details of the child have been successfully registered.</h2>
                    <p>Click here to return to the <a href='proj.php'>home page</a></p>
                </div>
            </body>
            </html>";
            }
        } else {
            echo "Error: " . $sql1->error;
        }

        // Close statements and connection
        $sql1->close();
        $sql2->close();
        $check_user_query->close();
        $conn->close();
    } else {
        echo "Failed to upload photo.";
    }
}
?>
