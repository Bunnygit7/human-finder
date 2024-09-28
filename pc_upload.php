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
    $filePath = 'images/parents/' . $fileName;

    // Save the file to the server
    if (file_put_contents($filePath, $imgData)) {
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

        // Escape user inputs for security
        $pc_name = $conn->real_escape_string($_POST['pc_name']);
        $pc_age = $conn->real_escape_string($_POST['pc_age']);
        $missing_place = $conn->real_escape_string($_POST['missing_place']);
        $missing_date = $conn->real_escape_string($_POST['missing_date']);
        $pc_shirt_color = $conn->real_escape_string($_POST['pc_shirt_color']);
        $pc_pant_color = $conn->real_escape_string($_POST['pc_pant_color']);
        $pc_gender = $conn->real_escape_string($_POST['pc_gender']);
        $pc_identifications = $conn->real_escape_string($_POST['pc_identifications']);
        $p_name = $conn->real_escape_string($_POST['p_name']);
        $p_phone = $conn->real_escape_string($_POST['p_phone']);
        $p_address = $conn->real_escape_string($_POST['p_address']);
        $pc_extra_info = $conn->real_escape_string($_POST['pc_extra_info']);


        $username = $conn->real_escape_string($_POST['p_name']);
        $password = $conn->real_escape_string($_POST['p_phone']);
        $phone = $conn->real_escape_string($_POST['p_phone']);

        // Check if the user already exists in the 'users' table
        $check_user_query = $conn->prepare("SELECT * FROM users WHERE phone=? AND name=? AND address=?");
        $check_user_query->bind_param("sss", $phone, $p_name, $p_address);
        $check_user_query->execute();
        $result = $check_user_query->get_result();

        if ($result->num_rows == 0) {
            // Insert data into the 'users' table if the user does not exist
            $sql2 = $conn->prepare("INSERT INTO users (username, password, phone, name, address) VALUES (?, ?, ?, ?, ?)");
            $sql2->bind_param("sssss", $username, $password, $phone, $p_name, $p_address);

            if (!$sql2->execute()) {
                echo "Error: " . $sql2->error;
            }
        }


        // Insert data into the 'parents' table
        $sql1 = $conn->prepare("INSERT INTO parents (pc_image, pc_name, pc_age, missing_place, missing_date, pc_shirt_color, pc_pant_color, pc_gender, pc_identifications, p_name, p_phone, p_address, pc_extra_info, p_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, current_timestamp())");
        $sql1->bind_param("sssssssssssss", $filePath, $pc_name, $pc_age, $missing_place, $missing_date, $pc_shirt_color, $pc_pant_color, $pc_gender, $pc_identifications, $p_name, $p_phone, $p_address, $pc_extra_info);

        if ($sql1->execute()) {
            // Get the ID of the newly inserted record in 'parents' table
            $p_sno = $conn->insert_id;

            // Call Python script for face comparison and pass gender
            $pythonScriptPath = 'C:\xampp\htdocs\project\p_face_comparison.py';  // Adjust the path to the Python script
            $command = escapeshellcmd("python3 $pythonScriptPath $filePath $p_sno $pc_gender");
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

        // Close statement and connection
        $sql1->close();
        $sql2->close();
        $check_user_query->close();
        $conn->close();
    } else {
        echo "Failed to upload photo.";
    }
}
?>
