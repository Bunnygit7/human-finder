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
        $username=$_POST['username'];
        $password=$_POST['password'];
        $sql2="SELECT * FROM users WHERE username='$username' and password='$password'";

        $result = $conn->query($sql2);
        if ($result->num_rows == 1)
        {session_start();
            echo "login success";
            header("location:profile.php");
        }
        else{
            echo "Invalid";
        }

?>