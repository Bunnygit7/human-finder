<?php
$matching=0;
$accexists=0;
$queryfail=0;
// Database connection
if($_SERVER['REQUEST_METHOD']=='POST'){
        $db_host = 'localhost';
        $db_username = 'root';
        $db_password = '';
        $db_name = 'human finder';

        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $username=$_POST['username'];
        $name=$_POST['name'];
        $address=$_POST['address'];
        $phone=$_POST['phone'];
        $password=$_POST['password'];
        $confirm_password=$_POST['confirm_password'];
        if($password===$confirm_password){

        
            $sql1="SELECT * FROM users WHERE username='$username' and phone='$phone' and password='$password'";
            $result1 = $conn->query($sql1);
            if ($result1->num_rows == 0){
                $hashed_password=password_hash($_POST['password'], PASSWORD_BCRYPT);

                $sql2="INSERT INTO users ( `username`, `password`, `phone`, `name`,`address`) VALUES ( '$username', '$password', '$phone', '$name', '$address')";
                // $result2 = $conn->query($sql2);
            
                if ($conn->query($sql2) === TRUE)
                {
                    echo "singup success";
                    header("location:login.php");
                }
                else{
                    // echo "Query failed";
                    $queryfail=1;
                }
            }
            else{
                // echo "Account already exists";
                $accexists=1;
            }
        }else{
            // echo "both passwords are not matching";
            $matching=1;
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
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
        .signup-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 25%;
        }
        input[type="text"],
        input[type="password"],
        input[type="tel"],
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
        .error{
            color:red;
            margin-top:-45%;
            margin-left: -80%;
            position: fixed;
        }
    </style>
</head>
<body>
<?php
if($queryfail){
    echo "<div class='error'><h4>Query Failed</h4></div>";
}
if($accexists){
    echo "<div class='error'><h4>Account already exists</h4></div>";
}
if($matching){
    echo "<div class='error'><h4>both passwords are not matching</h4></div>";
}

?>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form action="signin.php" method="post">
            <input type="text" name="name" placeholder="Name" required>
            <input type="text" name="address" placeholder="Address" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="tel" name="phone" placeholder="Mobile Number" pattern="[0-9]{10}" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <input type="submit" value="Sign Up">
        </form>
    </div>
</body>
</html>
