<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        .hp_head {
            background-color: #000000;
            font-family: Eras Bold ITC;
            z-index: 1;
            position: absolute;
            text-align: center;
            width: 100%;
            height:10%
        }
        .navbar1{
            width: 100%;
            position: absolute;
            margin-top: 0%;
        }
        .navbar1 ul{
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
            /* background-color: #ddd; */
            opacity: 1;
            /* color: black; */
        }
        .navbar1 li{
            float: left;
        }

        .navbar1 a.active {
            background-color: #ddd;
            color: black;
            opacity: 1;

        }
        /* button:hover{
            opacity: 1;
            width: 50%;
        } */
    </style>
</head>

<body style="margin: 0%;">

<div class="hp_head" style="margin-top: 0%;">
    <a href="proj.php">
        <img src="photos for project/Screenshot__111_-removebg-preview.png" alt="" height="80" width="250" align="center"  style="margin-top:-0.5%; margin-left:0%; position: static;">
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


<a href="proj.php">
    <img class="hp_logo" src="photos for project/Screenshot__113_-removebg-preview.png" alt="" height="95" width="120" align="left"  style="margin-top:-1%; margin-left:0%;z-index:1; position: absolute;">
</a>

<?php
// Database connection
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'human finder';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$successMessage = ""; // Initialize success message variable

if(isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Prepare and execute SQL query to fetch user details
    $sql = "SELECT * FROM parents WHERE p_sno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // $sql = "SELECT * FROM users WHERE p_sno = ?";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("i", $userId);
    // $stmt->execute();
    // $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user details
        $user = $result->fetch_assoc();
        ?>
        <div class="profile" align="center"  style="border: 12px solid #ccc; margin-top:8%; padding-bottom: 1%; position: absolute; width: 98.3%;">
            <h1 >CHILD DETAILS</h1><br>
            <div class="cimg">
                <img src="<?= $user['pc_image'] ?>" alt="<?= $user['pc_name'] ?>" height="370px" style="border: 6px solid #ccc; margin-left: 5%; margin-right: 8%;margin-top:0%; margin-bottom: 5%; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);" align="left">
            </div>
            <div class="details"  align="left" style="margin-top:-2%;">
                <h2><?= $user['pc_name'] ?></h2>
                <p><strong>Age: </strong><?= $user['pc_age'] ?></p>
                <p><strong>MISSING DATE: </strong><?= $user['missing_date'] ?></p>
                <p><strong>SHIRT COLOR: </strong><?= $user['pc_shirt_color'] ?></p>
                <p><strong>PANT COLOR: </strong><?= $user['pc_pant_color'] ?></p>
                <p><strong>GENDER: </strong><?= $user['pc_gender'] ?></p>
                <p><strong>IDENTIFICATIONS: </strong><?= $user['pc_identifications'] ?></p>
                <p><strong>MY NAME: </strong><?= $user['p_name'] ?></p>
                <p><strong> MY NUMBER: </strong><?= $user['p_phone'] ?></p>
                <p><strong>MY ADDRESS: </strong><?= $user['p_address'] ?></p>
                <p><strong>EXTRA INFORMATION: </strong><?= $user['pc_extra_info'] ?></p>
                <p><strong>CALL:  </strong>&nbsp;&nbsp;&nbsp;<a href=""><img id="callButton" src="photos for project/phone_logo.png" width="20"></a></p>
                <!-- <form method="post">
                    <button type="submit" name="delete">Delete</button>
                </form> -->
            </div>
        </div>
        <?php
        if(isset($_POST['delete'])) {
            // Insert data into another table
            $sql_move = "INSERT INTO success_data (s_name, s_age, s_shirt_color, s_pant_color, s_gender, s_identifications, sop_name, sop_phone, sop_address, s_extra_info,s_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,current_timestamp())";
            $stmt_move = $conn->prepare($sql_move);
            $stmt_move->bind_param("sissssssss", $user['pc_name'], $user['pc_age'], $user['pc_shirt_color'], $user['pc_pant_color'], $user['pc_gender'], $user['pc_identifications'], $user['p_name'], $user['p_phone'], $user['p_address'], $user['pc_extra_info']);
            if ($stmt_move->execute()) {
                $stmt_move->close();
        
                // Delete data from the current table
                $sql_delete = "DELETE FROM parents WHERE p_sno = ?";
                $stmt_delete = $conn->prepare($sql_delete);
                $stmt_delete->bind_param("i", $userId);
                if ($stmt_delete->execute()) {
                    $stmt_delete->close();
                    header("Location: delete note.php"); // Redirect to note.php after successful deletion
                    exit(); // Ensure no further code is executed after redirection
                } else {
                    $successMessage = "Error deleting data: " . $stmt_delete->error; // Set error message
                }
            } else {
                $successMessage = "Error moving data: " . $stmt_move->error; // Set error message
            }
        }
        

    } else {
        $successMessage = 'User not found.';
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
} else {
    $successMessage = 'User ID not provided.';
}
?>

<!-- Display success message -->
<?php echo $successMessage; 
$phoneNumber = $user['p_phone'];
?>

<script>
    function high(x) {
        x.style.opacity=2;
        x.style.width="50%";
    }
    function low(x) {
        x.style.opacity=0.5;
        x.style.width="40%";
    }
    document.getElementById("callButton").addEventListener("click", function() {
        // Replace 'phoneNumber' with the actual phone number you want to call
        var phoneNumber ="<?php echo $phoneNumber; ?>";
        window.location.href = "tel:" + phoneNumber;
    });
</script>

</body>
</html>
