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
        $phone=$_POST['phone'];
        $password=$_POST['password'];
        $confirm_password=$_POST['confirm_password'];
        if($password===$confirm_password){

        
            $sql1="SELECT * FROM users WHERE username='$username' and phone='$phone' and password='$password'";
            $result1 = $conn->query($sql1);
            if ($result1->num_rows == 0){
                $sql2="INSERT INTO users ( `username`, `password`, `phone`) VALUES ( '$username', '$password', '$phone')";
                // $result2 = $conn->query($sql2);
            
                if ($conn->query($sql2) === TRUE)
                {
                    echo "singup success";
                    header("location:login.php");
                }
                else{
                    echo "failed";
                }
            }
            else{
                echo "Account already exists";
            }
        }else{
            echo "both passwords are not matching";
        }

?>