<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Human Finder</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            background-color: black;
            justify-content: space-around;
            padding: 5% 5%;
            width: 202%;
    margin-left: -57%;
        }
        .item {
            width: 200px;
            height: 250px;
            margin: 1%;
            background-color: white;
            padding: 2%;
            border-radius: 2%;
            margin-bottom: 5%;

        }
        .item img {
            /* width: 100%;
            height: -webkit-fill-available; */
            /* margin-left: 5%; */
            object-fit: cover;
            /* margin-top: -13%; */
    margin-bottom: 20%;
    border-radius: 10%;
        }
        h4{
          margin-top: -20%;
        }
        /* .custom-tooltip {
  --bs-tooltip-bg: var(--bd-violet-bg);
  --bs-tooltip-color: var(--bs-white);
} */

    /* top navbar */

.navbar1{
            width: 100%;
            position: absolute;
            margin-top: -4.9%;
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
        button:hover{
            opacity: 1;
            width: 50%;
        }



        /* Style the content */


        .content {
            margin-top: 10px;
            display: flex;
            flex-wrap: wrap;
            background-color: black;
            justify-content: space-around;
            padding: 5% 5%;
            margin-bottom: -32%;
        }



        /* Style the items */


        .item {
            float: left;
            margin: 10px;
            padding: 16px;
        }

        .item img {
            width: 200px;
            height: 200px;
        }


        /* search bar */



        .search-container {
            margin-bottom: 0%;
            margin-top: 2%;
            margin-left: 0%;
            /* position: absolute; */
            width: 100%;
         
        }

        .search-container input[type=text] {
            padding: 10px;
            margin-top: 10px;
            width: 203%;
            border: none;
            border-radius: 5px;
            margin-left: -53%;

        }

        .search-container button {
            padding: 10px;
            margin-top: 10px;
            background: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-container button:hover {
            background: #ddd;
            color: black;
        }



    /* below nav bar */


    .navbar2 {
            background-color: #333;
            overflow: hidden;
            margin-left: -55%;
            margin-top: 2%;
            width: 210%;
            
        }


        .navbar2 a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar2 a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Style the active button */
        .navbar2 a.active {
            background-color:  #ddd;
            color: black;
        }

        .hp_head
        {
             background-color: #000000;
    
            z-index: 1;
            text-align: center;
            width: 100%;
            height:10%;
            cursor: pointer;
        }
        .hp_logo{
            cursor: pointer;
            /* z-index: 3; */
            margin-top:-6%;
             margin-left:0%;
              position: absolute;
        }
        .account_logo {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        /* .hp_logos{
            position: absolute;
            background-color: #000000;
            margin-left:-26%;
            margin-top: 1.3%;
        } */

       
    </style>
    
    
</head>


<body style="margin: 0%; background-color: black;">

<div class="hp_head" style="margin-top: 0%;">
<a href="proj.php">
<img src="photos for project/Screenshot__111_-removebg-preview.png" alt="" height="80" width="250" align="center">
</a>
    </div>
   
     
    <!--##################### nav bar ##################-->

    <div class="navigation-container">
    <nav class="navbar1">
        <ul>
            <li><a href="proj.php" id="homeLink" class="nav-link active">HOME</a></li>
            <li><a href="orphanage.php" class="nav-link">ORPHANAGE LIST</a></li>
            <li><a href="#" class="nav-link">NEWS</a></li>
            <li><a href="#" class="nav-link">BEWARE</a></li>
            <li><a href="about us.php" class="nav-link">ABOUT US</a></li>
        </ul>
    </nav>
    </div>
      <!-- #################################################  ACCOUNT LOGO #################################################### -->
    <!-- Account logo -->
    <a href="<?php echo isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ? 'profile.php' : 'login.php'; ?>">
        <img src="photos for project/acc_logo-removebg-preview.png" alt="Account Logo" class="account_logo" height="50" width="50">
    </a>
      <!-- ################################################## HOMEPAGE LOGO ################################################### -->
     
    <a href="proj.php">
      <img class="hp_logo" src="photos for project/Screenshot__113_-removebg-preview.png" alt="" height="95" width="120" align="left">
    </a>


         <!--#################################### backbround moving images ##################################################################-->
    <img  class="hp_bg" src="photos for project/ezgif.com-speed (1).gif" alt="">
    
   

    <!-- #################################################### buttons #########################################################-->

<div class="hp_frm" style="margin-bottom: -25%;">
        <form action="parents report form.php">
          <button class="hp_btn">PARENTS</button><br>
        </form>

        <form action="outsiders report form.php">
        <button align="center"class="hp_btn">OUTSIDERS</button><br>
        </form>
      
      <!-- ################################################## SEARCH BAR ################################################### -->

      <!-- <a href="proj.php">
      <img class="hp_logos" src="photos for project/Screenshot__113_-removebg-preview.png" alt="" height="43" width="50" align="left">
    </a> -->

    <div class="search-container">
        <input type="text" id="searchInput" onkeyup="filterItems()" placeholder="Search...">
    </div>

      <!-- ##################################################################################################### -->


    <div class="navbar2">
        <a href="?category=parents" <?php if(!isset($_GET['category'])  || (isset($_GET['category']) && $_GET['category'] === 'parents')) echo 'class="active"'; ?>>Parents</a>
        <a href="?category=outsiders" <?php if(isset($_GET['category']) && $_GET['category'] === 'outsiders') echo 'class="active"'; ?>>Outsiders</a>
    </div>
    <div class="container">
      <div class="content" id="itemsContainer">

      <!-- ##################################################################################################### -->
      
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
        
          // Check which category is selected
          $category = isset($_GET['category']) ? $_GET['category'] : 'parents';
        
          // Fetching data based on the selected category
          if ($category === 'parents') {
            $sql = "SELECT * FROM parents ORDER BY p_sno DESC";
          } elseif ($category === 'outsiders') {
            $sql = "SELECT * FROM outsiders ORDER BY o_sno DESC";
          }
        
          $result = $conn->query($sql);
        
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  $image = ($category === 'parents') ? $row['pc_image'] : $row['oc_image'];
                  $name = ($category === 'parents') ? $row['pc_name'] : $row['oc_name'];
                  $age = ($category === 'parents') ? $row['pc_age'] : $row['oc_age'];
                  $id = ($category === 'parents') ? $row['p_sno'] : $row['o_sno'];
              
                  // Displaying data
                  echo '<a href="' . $category . ' display.php?id=' . $id . '" style="text-decoration: none;"><div class="item">';
                  echo '<img src="' . $image . '" alt="Image">';
                  echo '<h4 align="center" style="color:black;">' . $name . '</h4>';
                  echo '<br><br><h4 align="center" style="color:black;">' . $age . '</h4>';
                  echo '</div></a>';
              }
          } else {
            echo "<div style='color:red'><h1>";
              echo "Zero profiles.";
              echo "</h1></div>";
          }
        
          // Closing connection
          $conn->close();
          ?>
      <!-- ##################################################################################################### -->

      </div>
    </div>

      <!-- ##################################################################################################### -->

  <script>
    function filterItems() {
        var input, filter, container, items, item, i, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        container = document.getElementById('itemsContainer');
        items = container.getElementsByClassName('item');

        for (i = 0; i < items.length; i++) {
            item = items[i];
            txtValue = item.textContent || item.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        }
    }

  </script> 
</body>
</html>