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
    <title>Create Poll</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="style.css">
    <!-- <video src="bgvideo.mp4" autoplay muted loop id="bgvideo"></video> -->
    <style>
        html{
    /* As in browser 1rem is approx 16px, we overwrite it as 10px so now 1rem becomes 10px i.e. Ypx=Y/10 rem*/
    font-size:62.5%;

}
@media(max-width:998px)
{
html{
    /* As in browser 1rem is approx 16px, we overwrite it as 10px so now 1rem becomes 10px i.e. Ypx=Y/10 rem*/
    font-size:55%;

}
}
@media(max-width:768px)
{
    html{
        /* As in browser 1rem is approx 16px, we overwrite it as 10px so now 1rem becomes 10px i.e. Ypx=Y/10 rem*/
        font-size:45%;
    
    }

}
@media(max-width:450px)
{
    html{
        /* As in browser 1rem is approx 16px, we overwrite it as 10px so now 1rem becomes 10px i.e. Ypx=Y/10 rem*/
        font-size:35%;
    
    }

}
    #ques{
        height: inherit;
        width: inherit;
    }
    </style>
</head>
<body id="body">
    <!-- <img src="bgnew.jpg" alt="Cool Image :)" id='bgimg'> -->
        <nav class="navbar">
            <ul>
                <li><button class="btn" ><a href="admin.php"> Home </a></button></li>
                <li><button class="btn" ><a href="createPoll.php"> Create Poll </a></button></li>
                <li><button class="btn" id="create"  ><a href="createTeam.php"> Create Team </a></button></li>
                <li><button class="btn" ><a href="dashboard.php"> Dashboard </a> </button></li>
                <li><button class="btn" id='logout'><a href="login.php"> Logout </a></button></li>
                
            </ul>
         </nav>
         <div class="poll">
             <form action="" method='post' class='pollq' autocomplete=off>
              <!-- <input type="textarea" rows="40" cols=60 wrap="soft" name="question" placeholder="Your favourite Color?" id="ques"> -->
               <textarea name="question" id="ques" cols="21" rows="5" placeholder="Your Favourite Color?"></textarea required>
              <input type="text" name="opt1" placeholder="Option 1" class="opt" required>
              <input type="text" name="opt2" placeholder="Option 2" class="opt" required>
              <input type="text" name="opt3" placeholder="Option 3" class="opt" required>
              <input type="text" name="opt4" placeholder="Option 4" class="opt" required>
              <input type="submit" id="submit" name="submit">
             </form>
         </div>
<!-- <script src="logic.js"></script> -->
</body>
</html>
<?php
include "config.php";
$searchForActivePoll="select * from polls where status=1";
    $query=mysqli_query($con,$searchForActivePoll);
    if(mysqli_num_rows($query)>0)
    {
        ?>
        <script>alert("A Poll is already Active!!!");
        location.replace("admin.php");
        </script>
        <?php
        // header('location:admin.php');
    }
else if(isset($_POST['submit']))
{
    
    // $fetchidofpoll=mysqli_query($con,"select * from polls order by id desc limit 0");
    // $idofpoll=mysqli_fetch_array($fetchidofpoll);
    // echo $idofpoll['id'];
    // // var_dump($idofpoll);
    // echo "<hr>";
            $ques=$_POST['question'];
            if(empty($ques))
            {
                ?>
                <script>alert("The Question Can't be empty!");</script>
                <?php
            }
            else
            {
                //Inserting data into POLLS Table
                $opt1=$_POST['opt1'];
                $opt2=$_POST['opt2'];
                $opt3= $_POST['opt3'];
                $opt4=$_POST['opt4'];
               $Insertquery="insert into polls (question,opt1,opt2,opt3,opt4)values('$ques','$opt1','$opt2','$opt3','$opt4')";
               $query=mysqli_query($con,$Insertquery);
               if($query)
               {
                //    $idofpoll=mysqli_query($con,"select id from polls order by id desc limit 1");
                $idofpoll=mysqli_insert_id($con);
                ?>
                <script>alert("Inserted Successfully!");</script>
                <?php
               }
               else
               {
                ?>
                <script>alert("Insertion Failed!");</script>
                <?php
                echo "Error: $Insertquery <br> $con->error";
               }
           
               //Making a new Table for this poll
            $create="create table `".$idofpoll."` (id INT(11) unsigned auto_increment primary key,email varchar(255) not null,response int(5) default 0)";
            if(mysqli_query($con,$create))
             {
                 $usermail=$_SESSION['usermail'];
                ?>
                <script>alert("Table for this poll made successfully!");</script>
                <?php
                $choose= "select * from registration"; 
                $query=mysqli_query($con,$choose);
                $nums=mysqli_num_rows($query);
                while($result=mysqli_fetch_array($query))
                {
                    $mail=$result['email'];
                    $savequery="insert into `$idofpoll`(email) values('$mail')";
                  $executingSaveQuery=mysqli_query($con,$savequery);
                }
             }
            else
             {
                ?>
                <script>alert("Table making failed for this poll :|");</script>
                <?php
                echo "Error creating Table: ".mysqli_error($con);
             }
        
            }
    
mysqli_close($con);
}
?>