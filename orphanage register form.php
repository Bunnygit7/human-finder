<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parents Child Report</title>
    <style>
        body {
            font-family: Arial Rounded MT Bold;
            background-color: grey;
        }
        .container {
            display: flex;
            justify-content: space-around;
            font-size: 15px;
        }
        .form-block {
            width: 45%;
            padding: 35px;
            border: 1px solid #ccc;
            border-radius: 50px;
            margin-bottom: 20px;
            margin-top: -1%;
            margin-left: 18%;
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
        .form-group input {
            width: 90%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 10px;
            opacity: 0.2;
            font-size: 19px;
   
   
        }
        .form-group input:hover{
            opacity: 0.8;
        }
        .form-group textarea {
            width: 90%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 10px;
            resize: vertical;
            opacity: 0.2;
            font-size: 19px;
        }
        .form-group textarea:hover{
            opacity: 0.8;
        }
        .submit-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 53%;
            margin-left: -44%;
            position: absolute; 
        }

        label
        {
            color: white;
        }
        .bg_img
        {
            width: 100%;
            height: auto;
            position: absolute;
            z-index: -1;
            margin-top: 4.5%;
            filter: blur(8px);
            -webkit-filter: blur(8px);
 /* margin-left: -62.1%;  */

        }
        .parents_cap{
            position: relative;
            width: 23%;
            margin-top: 10%;
            margin-bottom: -10%;
            margin-left: 39%;
        }
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
        .in{
            color: white;
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
            margin-top: 4.6%;
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
        .navbar1 li{
            float: left;
        }

        .navbar1 a.active {
            background-color: #ddd;
            color: black;
            opacity: 1;

        }
        .orf{
            position: absolute;
            width: 40%;
            color:antiquewhite;
            margin-top: 5%;
            margin-bottom: -10%;
            margin-left: 37%;
        }

    </style>
</head>
<body style="margin:0%">

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

     <!-- #########################################################-->
    <a href="proj.php">
    <img class="hp_logo" src="photos for project/Screenshot__113_-removebg-preview.png" alt="" height="95" width="120" align="left"  style="margin-top:-1%; margin-left:0%; position: absolute;">
    </a>
    <img class="bg_img" src="photos for project/img1.png" alt="">

    <!-- <img class="parents_cap" src="photos for project/par-removebg-preview.png" alt=""> -->
        <h1 class="orf">Orphanage registration form</h1>
    <div class="frm" style="margin-top: 10%; position: absolute; width: 100%; " >



    <!-- #############################################################################################################################################
    ----------------------------------------------------------form-------------------------------------------------------------------------------
    #############################################################################################################################################-->

<form action="orphanage upload.php" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="form-block">
          
            
            <div class="form-group">
                <label for="orf_name">Name of the Orphanage:*</label>
                <input type="text" id="orf_name" name="orf_name" required autocomplete="off"> 
            </div>

            <!-- address of Orphanage -->
            <div class="form-group">
        <label for="orf_address">Address:*</label>
        <textarea id="orf_address" name="orf_address" rows="3" required autocomplete="off"></textarea>
        <br></div>

    
            <div class="form-group">
                <label for="orf_man_name">Your Name:*</label>
                <input type="text" id="orf_man_name" name="orf_man_name" required autocomplete="off">
            </div>

            <div class="form-group">
                <label for="orf_phone">Your Number:*</label>
                <input type="tel" id="orf_phone" name="orf_phone" required autocomplete="off">
            </div>
        
        
            <div class="form-group">
        <label for="orf_acc_name">Account name:</label>
        <input type="text" id="orf_acc_name" name="orf_acc_name" autocomplete="off">
        <br></div>
        <div class="form-group">
        <label for="orf_acc_no">Account number:</label>
        <input type="number" id="orf_acc_no" name="orf_acc_no" autocomplete="off">
        <br></div>
        
        <div class="form-group">
        <label for="orf_ifsc">IFSC code:</label>
        <input type="text" id="orf_ifsc" name="orf_ifsc" autocomplete="off">
        <br></div>

        <div class="form-group">
        <label for="orf_username">Username:*</label>
        <input type="text" id="orf_username" name="orf_username" required autocomplete="off">
        <br></div>

        <div class="form-group">
        <label for="orf_pass">Password:*</label>
        <input type="text" id="orf_pass" name="orf_pass" required autocomplete="off">
        <br></div>

        <div class="form-group">
                <label for="orf_qr">Upload Qr:</label>
                <input class="in" type="file" id="orf_qr" name="orf_qr">
        </div>    
    </div>
        <div align="center"><button class="submit-btn" type="submit">Submit</button></div>
</form>
    </div>
    <script>

  </script> 
</body>
</html>
