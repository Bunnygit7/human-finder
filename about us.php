<p?php

?>
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
            margin-top: 8%;
            position: absolute;
            margin-left: 44.5%;
            color: antiquewhite;
        }
        .college h1{
            margin-top: 11%;
            position: absolute;
            margin-left: 35%;
            color: antiquewhite;
        }
        .college h3{
            margin-top: 13.5%;
            position: absolute;
            margin-left: 45%;
            color: antiquewhite;
        }
        .college img{
            position: absolute;
            margin-top: 10%;
            margin-left: 27%;
            width: 7%;
            height:auto
        }
        .shiva{
            position: absolute;
            margin-top: 18%;
            margin-left: 10%;
        }
        
        
        
        .details img{
            object-fit: cover; 
    border-radius: 20%;
        }
        .details a{
            text-decoration: none;
            color: antiquewhite;

        }
        
        
        
        h2{
            position: absolute;
            margin-top: 5%;
            color: antiquewhite;
            margin-left: 15%;
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
        .description{
            position: absolute;
            margin-top: 11%;

        }
        .hf{
            color:#f1290a;
        }
        .bg_img{
            width: 100%;
            height: auto;
            position: absolute;
            z-index: -1;
            
            filter: blur(8px);
            -webkit-filter: blur(11px);
        }
        .hp_logos{
            position: absolute;
            z-index: -1;
            filter: blur(8px);
            -webkit-filter: blur(7px);
            margin-left: 28%;
            margin-top: 7%;

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
               <li><a href="orphanage.php" class="nav-link">ORPHANAGE LIST</a></li>
               <li><a href="#" class="nav-link">NEWS</a></li>
               <li><a href="#" class="nav-link">BEWARE</a></li>
               <li><a href="#" class="nav-link active">ABOUT US</a></li>
           </ul>
       </nav>
       </div>
       <h1>ABOUT US</h1>
       <div class="description">
        <img class="bg_img" src="photos for project\d.png" alt="">
        <a href="proj.php">
      <img class="hp_logos" src="photos for project/Screenshot__113_-removebg-preview.png" alt="" height="500" width="600" align="left">
    </a>
       <p style="color:#f2f2f2; font-size:xx-large">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="hf">Human Finder</span> is a web-based platform developed with the primary aim of assisting in the
search for missing children. In today's world, where cases of missing children are unfortunately
not uncommon, there exists a critical need for effective tools and platforms to aid in their
recovery. <span class="hf">Human Finder</span> seeks to address this need by providing a centralized and accessible
hub where concerned individuals, communities, law enforcement agencies, and non-profit
organizations can come together to collaborate in the search efforts.</p>
<p style="color:#f2f2f2; font-size:xx-large">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="hf">Human Finder</span> is designed to be user-friendly and intuitive, catering to a diverse
range of users, including those with varying levels of technological proficiency. Through its
streamlined interface and robust features, the platform enables users to report sightings of
missing children, share relevant information and updates, coordinate search efforts, and offer
support to affected families.</p>
<p style="color:#f2f2f2; font-size:xx-large">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="hf">Human Finder</span> operates on the principle of inclusivity and community-driven
action. It recognizes the importance of fostering a sense of solidarity and shared responsibility
among individuals and communities affected by the issue of missing children. Through its
platform, Human Finder seeks to mobilize collective efforts towards a common goal: <span class="hf">bringing
missing children home safely.</span></p>
<p style="color:#f2f2f2; font-size:xx-large">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="hf">Human Finder</span> represents a significant step forward in the fight against child
abduction and trafficking. By providing a comprehensive and accessible platform for reporting
and responding to cases of missing children, <span class="hf">Human Finder</span> aims to make a tangible difference
in the lives of affected families and communities. As the project continues to evolve and grow,
we remain committed to our mission of leveraging technology for the greater good and bringing
hope to those in need.</p>


       </div>
       




       
    <!-- <div class="details">
       <div class="shiva">
        <img src="photos for project/shiva prasad.JPG" alt="" width="300" height="300"><br>
       <h2>B.SHIVA PRASAD</h2><br><br>
       <h2><a href="mailto:bunnybathula0@gmail.com">E-mail</a></h2> <br><br>
       <h2><a href="tel:+917396450954">7396450954</a></h2> 

    </div>    -->
</body>
</html>
