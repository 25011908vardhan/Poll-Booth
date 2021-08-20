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
    <title>Active Polls</title>
    <link rel="stylesheet" href="home.css">
    <!-- <video src="bgvideo.mp4" autoplay muted loop id="bgvideo"></video> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaina+2:wght@500&display=swap" rel="stylesheet">
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
        h3{
            text-align:center;
            font-size: 2.8rem;
            color: yellow !important;
        }
        .ques{
            color:greenyellow;
            text-align: center;
        }
        .activepolls{

            display: inline-block;
             border:0.2rem solid black;
            color:gray;
            margin:3.0rem;
            padding:1.0rem;

            font-size:2.0rem;
            border-top-left-radius: 3.0rem;
    border-bottom-right-radius: 3.0rem;
    background-color:rgba(100,100,100, 0.212);
    /* width:50%; */
}
.polls{
            /* text-align:center; */
            position:absolute;
            border: 0.2rem solid red;
            border-radius: 2.0rem;
            /* margin-right:20px; */
            top:50%;
            left:50%;
            transform: translate(-50%,-50%);
            padding: 2.0rem;
            
        }
        .pollnum{
            font-size:2rem;
            background-color: rgba(100, 0, 0, 0.212);
            color: orange;
            text-align: center;
            width:100%;
            border-radius:1.0rem;
            padding:0.5rem;
            /* text-align: center; */
        }
        .pollnum:hover{
            cursor: default;
        }
        .vote{
            border-radius: 1.0rem;
            font-size:2.5rem;
            background-color:lightgreen;
            text-align:center;
            padding: 0.5rem;
            margin-top:1.0rem;
            width:100%;
            
        }
        .vote:hover{
            cursor: pointer;
        }
        /* .voted{
            visibility:hidden;
        } */
        .votesubmit{
            border-radius:1.0rem;
            width:100%;
            /* background-color:rgba(94, 230, 128, 0.1); */
            text-align:center;
        }
        input[type='radio']:after {
        width: 1.0rem;
        height: 1.0rem;
        border-radius: 1.0rem;
        top: -0.2rem;
        left: -0.1rem;
        position: relative;
        background-color: #d1d3d1;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 0.2rem solid white;
    }

    input[type='radio']:checked:after {
        width: 1.0rem;
        height: 1.0rem;
        border-radius: 1.0rem;
        top: -0.2rem;
        left: -0.1rem;
        position: relative;
        background-color: hotpink;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 0.2rem solid white;
    }
    </style>
    
</head>
<body id="body">
    <!-- <img src="bgnew.jpg" alt="Cool Image :)" id='bgimg'> -->
        <nav class="navbar">
            <ul>
                <li><button class="btn" ><a href="index.php"> Home </a></button></li>
                <li><button class="btn" ><a href="polls.php">Polls</a></button></li>
                <li><button class="btn" id="teams"  ><a href="#"> Teams </a></button></li>
                <li><button class="btn" ><a href="dashboard.php"> Dashboard  </a></button></li>
                <li><button class="btn" id='logout'><a href="logout.php"> Logout </a></button></li>
            </ul>
         </nav>
         <div class="polls">
             <?php
             include 'config.php';
             $usermail=$_SESSION['usermail'];
             $active= "select * from polls where status=1"; 
             $query=mysqli_query($con,$active);
             $nums=mysqli_num_rows($query);
             $result=mysqli_fetch_array($query);
            //  $canvote="select status from `$result['id']' where email='$usermail'";
             if($nums==1)
             {
                           $pollno=$result['id'];
                        //    $canvote="select * from `$pollno` where email='$usermail'";
                        //    $canvote=mysqli_query($con,$canvote);
                        //    $canvote=mysqli_fetch_assoc($canvote);
                        //    $canvote=$canvote['status'];
                        //    echo $canvote;
                        echo "<h3 style='color: Orange'>Active Polls</h3><br>";
                        echo "<hr>";
                        ?>
                        
                        
                        <div class="activepolls">
                          <form action="" method="post">
                              <input type="text" 
                               class="pollnum"
                              name="pollNumber" value="Poll <?php echo $result['id']?>"><br><br>
                          <div class="ques"><?php echo $result['question'];?><br><br></div> 
                          <label>
                    <input type="radio" name="opt"  class="opt"value="1"/> <?php
                             echo $result['opt1'];?><br/>
                          </label>

                          <label >
                    <input type="radio" name="opt" class="opt" value="2"/>     <?php
                             echo $result['opt2'];?><br />
                          </label>

                          <label>
                    <input type="radio" name="opt" class="opt" value="3"/>  <?php
                             echo $result['opt3'];?><br />
                          </label>
                          <label>
                    <input type="radio" name="opt" class="opt" value="4"/>
                    <?php
                             echo $result['opt4'];?><br />

                          </label>
                    <div class="votesubmit">
                        <input type='submit' name="submit" value='Vote' class="vote"/>
                    </div>
                    </form>
                             
                            </div>
                          <?php
                      }
                      else{
                        // echo "<h3>Ended Polls</h3><br>";
                         ?>
                      <div class="noactive" style="color:yellow; font-size:2.5rem;">
                          NO ACTIVE POLLS YET!
                    </div>
                         <?php 
                      }
                  
             ?>
             <?php
             if(isset($_POST['submit']))
             {
                 $pollno=$_POST['pollNumber'];
                 $pollno=(int)str_replace("Poll ",'',$pollno);
                 $selectforPollNO="select * from `$pollno` where email='$usermail'";
                 $execSelectForPollNoQuery=mysqli_query($con,$selectforPollNO);
                 $re=mysqli_fetch_assoc($execSelectForPollNoQuery);
                 if($re['response']==0)
                 $canvote=1;
                 else
                 $canvote=0;
                 if($canvote==1)
                 {
                //  var_dump($pollno);
                 
                //  echo "<br>".$pollno."<br>";
                 if(isset($_POST['opt']))
                 {$opted=$_POST['opt'];
                  $savequery="update `$pollno` set response= '$opted' where email='$usermail'";
                  $executingSaveQuery=mysqli_query($con,$savequery);
                  if($executingSaveQuery)
                  {
                    ?>
                <script>
                alert("Vote Submitted Successfully!");
                // location.reload();
                </script>
                    <?php
                  }
                  else
                  {
                    ?>
                    <script>alert("Voting Failed 1st Else");</script>
                    <?php
                    echo "Error from 1st else: ".mysqli_error($con);
                  }
                }
                else
                {
                    ?>
                    <script>alert("Voting Failed Outermost else");</script>
                    <?php
                    
                }
                //  print_r($_POST);
              }
              else
              {
                ?>
                <script>
                    var vote=document.getElementsByClassName('vote');
                    vote[0].value="Voted";
                    vote[0].style.backgroundColor="grey";
                    vote[0].style.cursor="not-allowed";
                    vote[0].disabled=true;
                    alert("Already Voted");
                </script>
                <?php
              }
            }
            
            mysqli_close($con);
             ?>
         </div>
         </body>
</html>