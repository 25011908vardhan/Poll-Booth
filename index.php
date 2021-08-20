<?php
session_start();
if(!isset($_SESSION['username']))
{
    ?><script>alert("You are Logged Out!");</script>
    <?php
header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
    <!-- <video src="bgvideo.mp4" autoplay muted loop id="bgvideo"></video> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaina+2:wght@500&display=swap" rel="stylesheet">
</head>
<body id="body">
    <!-- <img src="bgnew.jpg" alt="Cool Image :)" id='bgimg'> -->
        <nav class="navbar">
            <ul>
                <li><button class="btn" ><a href="index.php"> Home </a></button></li>
                <li><button class="btn" ><a href="polls.php">Polls</a></button></li>
                <li><button class="btn" id="teams"  ><a href="#"> Teams </a></button></li>
                <li><button class="btn" ><a href="dashboard.php">Dashboard</a></button></li>
                <li><button class="btn" id='logout'><a href="logout.php"> Logout </a></button></li>
                
            </ul>
         </nav>
         <div class="msg">
             Welcome To The Online Poll Booth <?php echo strtoupper($_SESSION['username']);?>
         </div>
<!-- <script src="logic.js"></script> -->
</body>
</html>