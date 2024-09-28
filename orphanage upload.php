<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>note</title>
</head>
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
<body>
<?php
// Specify the folder to store uploaded images
$upload_folder = "images/orphanage qr/";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $target_file = $upload_folder . basename($_FILES["orf_qr"]["name"]);

     // Move the uploaded file to the specified folder
     move_uploaded_file($_FILES["orf_qr"]["tmp_name"], $target_file);
    // Database connection parameters
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'human finder';

    // Create connection
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    // $conn = new mysqli($server, $username, $db_password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO orphanage (orf_qr,orf_name, orf_address, orf_man_name, orf_phone, orf_acc_name, orf_acc_no, orf_ifsc, orf_username, orf_pass) VALUES (?,?, ?, ?, ?, ?, ?, ?,?,?)");
    $stmt->bind_param("ssssssssss",$orf_qr, $orf_name, $orf_address, $orf_man_name, $orf_phone, $orf_acc_name, $orf_acc_no, $orf_ifsc, $orf_username,$orf_pass);

    // Set parameters and execute
     // Store image URL and associated data in the database
    $orf_qr = $target_file;
    $orf_name = $_POST['orf_name'];
    $orf_address = $_POST['orf_address'];
    $orf_man_name = $_POST['orf_man_name'];
    $orf_phone = $_POST['orf_phone'];
    $orf_acc_name = $_POST['orf_acc_name'];
    $orf_acc_no = $_POST['orf_acc_no'];
    $orf_ifsc = $_POST['orf_ifsc'];
    $orf_username = $_POST['orf_username'];
    $orf_pass = $_POST['orf_pass'];

    if ($stmt->execute()) {
        // echo "New record inserted successfully";
        ?>
        <div class=s_note align="center">
        <h1>Thank you for taking a step ahead!!</h1>
        <br><h2>The details of the orphanage are successfully registered!! <br>
        Click here to return to <a href="orphanage.php">orphanage page</a></h2>
    </div>
</body>
<?php
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
</html>
