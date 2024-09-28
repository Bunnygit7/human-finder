<?php
session_start();

// Database connection
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'human finder';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch user ID from the GET parameter
$u_id = isset($_POST['u_id']) ? intval($_POST['u_id']) : null;
$p_sno = isset($_POST['p_sno']) ? intval($_POST['p_sno']) : null;
echo $p_sno;

if ($u_id) {
    // Retrieve existing user data
    $sql1 = "SELECT * FROM users WHERE u_id = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("i", $u_id);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    
    if ($result1->num_rows > 0) {
        $row = $result1->fetch_assoc();
        $name = $row['name'];
        $phone = $row['phone'];
        $address = $row['address'];
        $username = $row['username'];
        $password = $row['password'];
    } else {
        echo "No user found with ID: " . htmlspecialchars($u_id);
        exit();
    }

    $stmt1->close();
} else {
    echo "User ID is not set or invalid.";
    exit();
}

// Handle form submission
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $new_username = $_POST['username'];
    $new_password = $_POST['password'];

    // Hash the new password
    // $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Prepare the SQL statement to update user information
    $sql = "UPDATE users SET name = ?, phone = ?, address = ?, username = ?, password = ? WHERE u_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $phone, $address, $new_username, $new_password, $u_id);

    if ($stmt->execute()) {
        // Update the session with new username and phone number
        $_SESSION['username'] = $new_username;
        $_SESSION['phone'] = $phone;
        
        // Redirect to profile page
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <style>
        body {
            font-family: Arial Rounded MT Bold;
            background-color: #ccc;
        }
        .container {
            display: flex;
            justify-content: space-around;
            font-size: 15px;
            margin-top: -1%;
        }
        .form-block {
            width: 45%;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 50px;
            margin-bottom: 20px;
        }
        .form-block h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: white;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input,
        .form-group textarea {
            width: 90%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 10px;
            opacity: 0.8;
            font-size: 19px;
        }
        
        .submit-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }
        label {
            color: white;
        }
        .bg_img {
            width: 100%;
            height: auto;
            position: absolute;
            z-index: -1;
            margin-top: 4.9%;
            filter: blur(8px);
            -webkit-filter: blur(8px);
        }
        .parents_cap {
            position: relative;
            width: 23%;
            margin-top: 8%;
            margin-bottom: -10%;
            margin-left: 39%;
        }
        .hp_head {
            background-color: #000000;
            font-family: Eras Bold ITC;
            z-index: 1;
            position: absolute;
            text-align: center;
            width: 100%;
            height: 10%;
        }
        .hp_logo {
            z-index: 1;
        }
        .navbar1 {
            width: 100%;
            position: absolute;
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
    </style>
</head>
<body style="margin:0%">

<div class="hp_head" style="margin-top: 0%;">
    <a href="proj.php">
        <img src="photos for project/Screenshot__111_-removebg-preview.png" alt="" height="80" width="250" align="center" style="margin-top:-0.5%; margin-left:0%; position: static;">
    </a>
</div>

<!--##################### nav bar ##################-->

<div class="navigation-container">
    <nav class="navbar1">
        <ul>
            <li><a href="proj.php" id="homeLink" class="nav-link">HOME</a></li>
            <li><a href="orphanage.php" class="nav-link">ORPHANAGE LIST</a></li>
            <li><a href="about_us.php" class="nav-link">ABOUT US</a></li>
        </ul>
    </nav>
</div>

<a href="proj.php">
    <img class="hp_logo" src="photos for project/Screenshot__113_-removebg-preview.png" alt="" height="95" width="120" align="left" style="margin-top:-1%; margin-left:0%; position: absolute;">
</a>
<img class="bg_img" src="photos for project/img1.png" alt="">

<div class="frm" style="margin-top: 10%; position: absolute; width: 100%;">
    <h1 align="center" style="color:White;"></h1>
    <form action="p update.php" method="post">
        <div class="container">
            <div class="form-block">
                <h2 align="center">Your Information</h2>
                <div class="form-group">
                    <label for="name">Your Name:</label>
                    <input type="text" id="name" name="name" required autocomplete="off" value="<?php echo htmlspecialchars($name); ?>">
                </div>
                <div class="form-group">
                    <label for="phone">Your Number:</label>
                    <input type="tel" id="phone" name="phone" required autocomplete="off" value="<?php echo htmlspecialchars($phone); ?>">
                </div>
                <div class="form-group">
                    <label for="username">New Username:</label>
                    <input type="text" id="username" name="username" required autocomplete="off" value="<?php echo htmlspecialchars($username); ?>">
                </div>
                <div class="form-group">
                    <label for="password">New Password:</label>
                    <input type="password" id="password" name="password" required autocomplete="off" value="<?php echo htmlspecialchars($password); ?>">
                </div>
                <div class="form-group">
                    <label for="address">Your Address:</label>
                    <textarea id="address" name="address" rows="8" required autocomplete="off"><?php echo htmlspecialchars($address); ?></textarea>
                </div>
                <input type="hidden" name="u_id" value="<?php echo htmlspecialchars($u_id); ?>">
            </div>
        </div>
        <div align="center">
            <button class="submit-btn" type="submit" name="submit">Submit</button>
        </div>
    </form>
</div>
</body>
</html>
