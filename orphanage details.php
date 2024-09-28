<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>title</title>
    <style>
.hp_head
{
    background-color: #000000;
    font-family: Eras Bold ITC;
    z-index: 1;
    position: absolute;
    text-align: center;
    width: 100%;
    height:10%
}
.hp_logo{
    z-index: 1;
}
        .navbar1{
            width: 100%;
            position: absolute;
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
        body {
            /* font-family: Arial, sans-serif; */
            margin: 0;
            padding: 0;
        }
        .item{
            margin-top: 7%;
    position: absolute;
    margin-left: 30%;
        }
        h1{
            margin-top: 10%;
            margin-left: 41%;
            position: absolute;
        }
        a{
            text-decoration: none;
            color: green;
        }
        </style>
        </head>
        <body style="margin: 0%; background-color:white">
            <div class="hp_head" align="center">
                <!-- <h1 align="center" style="color: white;">HUMAN FINDER</h1>-->
                <a href="proj.php">
           <img src="photos for project/Screenshot__111_-removebg-preview.png" alt="" height="80" width="250" align="center"  style="margin-top:-0.5%; margin-left:0%; position: static;">
           </a>
               </div>
               <a href="proj.php">
              <img class="hp_logo" src="photos for project/Screenshot__113_-removebg-preview.png" alt="" height="95" width="120" align="left"  style="margin-top:-1%; margin-left:0%; position: absolute;">
              </a>
          
                
               <!--##################### nav bar ##################-->
           
               <div class="navigation-container">
               <nav class="navbar1">
                   <ul>
                       <li><a href="proj.php" id="homeLink" class="nav-link">HOME</a></li>
                       <li><a href="orphanage.php" class="nav-link active">ORPHANAGE LIST</a></li>
                       <li><a href="#" class="nav-link">NEWS</a></li>
                       <li><a href="#" class="nav-link">BEWARE</a></li>
                       <li><a href="about us.php" class="nav-link">ABOUT US</a></li>
                   </ul>
               </nav>
               </div>


               <h1>Orphanage Details</h1>


              
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "human finder";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get orphanage ID from the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch orphanage details based on ID
    $sql = "SELECT * FROM orphanage WHERE s_no = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of the orphanage
        $row = $result->fetch_assoc();
        ?>
            
        <div class="profile"  style="border: 12px solid #ccc;margin-top:8%; padding-bottom: 0%; position: absolute; width: 98.3%;font-family: Arial, sans-serif;   ">
            <div class="cimg">
                <img src="<?= $row['orf_qr'] ?>" alt="" height="370px" style="border: 0px solid #ccc; margin-left: 60%; margin-right: 8%;margin-top:7%; margin-bottom: 5%; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);" align="left">
            </div>
                <?php    
                echo "<div class='item'>";
                    echo "<h2>" . $row["orf_name"] . "</h2>";
                    echo "<p><strong>Location:</strong> " . $row["orf_address"] . "</p>";
                    echo "<p><strong>Phone:</strong> " . $row["orf_phone"] . "</p>";
                    echo "<p><strong>Guardian:</strong> " . $row["orf_man_name"] . "</p>";
                    echo "<p><strong>Number:</strong> " . $row["orf_phone"] . "</p>";
                    echo "<p><strong>Acc Name:</strong> " . $row["orf_acc_name"] . "</p>";
                    echo "<p><strong>Acc No:</strong> " . $row["orf_acc_no"] . "</p>";
                    echo "<p><strong>IFSC Code:</strong> " . $row["orf_ifsc"] . "</p>";
                    // echo "<p><strong>IFSC Code:</strong> " . $row["orf_qr"] . "</p>";
                    echo "<h2 style='margin-left:29%;'><a href='tel:". $row['orf_phone'] ."'>call</a></h2>";
                echo "</div>";
        echo "</div>";
    } else {
        echo "Orphanage not found";
    }
} else {
    echo "Orphanage ID not provided";
}

$conn->close();
?>

            </body>
            </html>