<?php
session_start();

$error = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'human finder';

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // Password is correct, set session variables
        $_SESSION['username'] = $row['username'];
        $_SESSION['phone'] = $row['phone'];
        $_SESSION['loggedin'] = true;

        // Redirect to profile page or any other page
        header("Location: profile.php");
        exit;
    } else {
        // Invalid username or password
        $error = 2;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            
            
        }
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }
        .error {
            color: red;
            
            
        }
    </style>
</head>
<body>

<?php
if ($error == 2) {
    echo "<div class='error'><h4>Username or password is incorrect</h4></div>";
}
?>

<div class="login-container">
    <h2>Login</h2>
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="Username" required autocomplete="off">
        <input type="password" name="password" placeholder="Password" required autocomplete="off">
        <small>Don't have an account? <a href="signin.php">Sign in</a></small>
        <input type="submit" value="Login">
    </form>
</div>

</body>
</html>
