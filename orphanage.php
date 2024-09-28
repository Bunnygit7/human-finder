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
        z-index: 0;
        position: absolute;
        text-align: center;
        width: 100%;
        height:10%
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
            h1{
                margin-top: 10%;
                position: absolute;
                margin-left: 40%;
                color: antiquewhite;
            }
        

            body {
                /* font-family: Arial, sans-serif; */
                margin: 0;
                padding: 0;
            }
        
            a{
                text-decoration: none;
                color: #000000;

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
                z-index: 3;
            }
            h2{
                color: #f1290a;
            }
            /* Styles for the pop-up */
        #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        /* Style for the close button */
        .closeButton {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        .orphanage-container {
                font-family: Arial, sans-serif;

                display: flex;
                flex-wrap: wrap;
                justify-content: space-around; /* Adjust as needed */
            }

            .orphanage-box {
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 10px;
                margin: 10px;
                width: 300px;
                background-color: #f9f9f9;
                margin-top: 20%;
                margin-bottom:-15%;
            }

            .search-container {
                margin-bottom: 0%;
        margin-top: 14%;
        margin-left: 0%;
        position: absolute;
        width: 100%;
            
            }

            .search-container input[type=text] {
                padding: 10px;
        margin-top: 10px;
        width: 95.5%;
        border: none;
        border-radius: 5px;
        margin-left: 1.5%;
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

        </style>
    </head>
    <body style="margin: 0%; background-color:#000000">
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
                <li><a href="#" class="nav-link active">ORPHANAGE LIST</a></li>
                <li><a href="#" class="nav-link">NEWS</a></li>
                <li><a href="#" class="nav-link">BEWARE</a></li>
                <li><a href="about us.php" class="nav-link">ABOUT US</a></li>
            </ul>
        </nav>
        </div>
        <h1>ORPHANAGE LIST</h1>
        <div class="search-container">
            <input type="text" id="searchInput" onkeyup="filterItems()" placeholder="Search...">
        </div>
        <div class="orphanage-container">
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

            // Fetch data from database
            $sql = "SELECT * FROM orphanage ORDER BY s_no DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<div class="orphanage-box"><a href="orphanage details.php?id=' . $row["s_no"] . '">';
                    echo "<h2>" . $row["orf_name"] . "</h2>";
                    echo "<p><strong>Location:</strong> " . $row["orf_address"] . "</p>";
                    echo "<p><strong>Phone:</strong> " . $row["orf_phone"] . "</p>";
                    echo '</a></div>';

                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>

        <div id="popup">
        <span class="closeButton" onclick="closePopup()">&times;</span>

        <h2>Orphanage Registration</h2>
        <p>Click on Register Now if you want to register your orphanage.</p>
        <form action="orphanage register form.php">
            <button>Register Now</button>
        </form>
    </div>

    <script>
        function filterItems() {
            // Declare variables
            var input, filter, container, boxes, title, location, i;
            input = document.getElementById('searchInput');
            filter = input.value.toUpperCase();
            container = document.getElementsByClassName('orphanage-container')[0];
            boxes = container.getElementsByClassName('orphanage-box');

            // Loop through all orphanage boxes, and hide those that don't match the search query
            for (i = 0; i < boxes.length; i++) {
                title = boxes[i].getElementsByTagName('h2')[0];
                location = boxes[i].getElementsByTagName('p')[0];
                if (title.innerHTML.toUpperCase().indexOf(filter) > -1 || location.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    boxes[i].style.display = '';
                } else {
                    boxes[i].style.display = 'none';
                }
            }
        }
        
        // Function to display the pop-up after a delay
        function displayPopup() {
            document.getElementById('popup').style.display = 'block';
        }

        // Function to close the pop-up
        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        // Set timeout to display the pop-up after 3 seconds (adjust as needed)
        setTimeout(displayPopup, 3000);
    </script>
    </body>
    </html>