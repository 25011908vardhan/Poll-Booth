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
    <link rel="stylesheet" href="style.css">
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
    #ques{
        height: inherit;
        width: inherit;
    }
    th{
       font-size: 2.8rem; 
       color: greenyellow;
    }
    #pollresult{
        position:absolute;
            border: 0.2rem solid red;
            border-radius: 2.0rem;
            top:55%;
            left:50%;
            transform: translate(-55%,-50%);
            padding: 1.5rem;
            visibility:hidden;
            font-size:2.0rem;
            width:50%;
    }
    .ques{
        color:orange;
        text-align:center;
    }
    .opt{
        color:white;
        /* display:inline-block; */
        /* vertical-align:top; */
    }
    .btn{
        text-align:center;
    }
    .voteper{
      color: violet;
      display:inline-block;
    }
    .btnclose{
        margin-top:1rem;
        border: 0.2rem solid black;
        border-radius: 10px;
        text-align:center;
        font-size: 3rem;
        background-color:red;
    }
    .btnclose:hover{
     cursor:pointer;
    }
    /* .table{
        margin:50px,10px,0px,10px;
    } */
    </style>
</head>
<body id="body">
    <!-- <img src="bgnew.jpg" alt="Cool Image :)" id='bgimg'> -->
        <nav class="navbar">
            <ul>
                <li><button class="btn" ><a href="<?php if($_SESSION['username']=="Admin") {echo "admin.php";} else {echo "index.php";}?>"> Home </a></button></li>
                <li><button class="btn" ><a href="<?php if($_SESSION['username']=="Admin") {echo "createPoll.php";} else {echo "polls.php";}?>"> <?php if($_SESSION['username']=="Admin") {echo "Create Poll";} else {echo "Polls";}?> </a></button></li>
                <li><button class="btn" id="create"  ><a href="<?php if($_SESSION['username']=="Admin") {echo "createTeam.php";} else {echo "#";}?>"> <?php if($_SESSION['username']=="Admin") {echo "Create Team";} else {echo "Teams";}?> </a></button></li>
                <li><button class="btn" ><a href="dashboard.php"> Dashboard </a></button></li>
                <li><button class="btn" id='logout'><a href="logout.php"> Logout </a></button></li>
            </ul>
         </nav>
         
         <!-- <div class="polls"> -->
         <!-- <div class="table"> -->
        <table id="pollData">
            <thead>
                <tr>
                    <th>Poll.no</th>
                   <th>Status</th>
                   <th>View</th>
                </tr>
            </thead>
            <tbody>
                 
            <?php
                  
                  include 'config.php';
                  $choose= "select * from polls"; 
                  $query=mysqli_query($con,$choose);
                  $nums=mysqli_num_rows($query);
                  while($result=mysqli_fetch_array($query))
                  {
                      ?><tr>
                          <td><?php echo $result['id']; $pollid=$result['id'];?></td>
                          <td><?php if($result['status']) echo "ACTIVE";else echo "ENDED";?></td>
                          <td><?php  if($result['status']==1&&$_SESSION['username']=='Admin'){echo "<form method='POST'>
             <input type='submit' name='submit' class='btn' value='END'>
         </form>"; $activepollid=$result['id'];} else{echo"<form method='POST'>
            <input type='submit' name='$pollid' class='btn' value='RESULT'>
        </form>";}?></td>
                      </tr>
                      <?php
    
                  }
               
            ?> 
            </tbody>
        </table>
         <!-- </div>
                </div> -->

         
<!-- <script src="logic.js"></script> -->
        <?php
        if(isset($_POST['submit']))
        {echo $activepollid;
           $updatestatus="update polls set status=0 where id='$activepollid'";
           $query=mysqli_query($con,$updatestatus);
           if($query)
           {
               ?>
               <script>
                   alert("Poll Ended!");
               </script>
               <?php
               header('location:dashboard.php');
           }
        }
        $choose= "select * from polls where status=0"; 
                  $query=mysqli_query($con,$choose);
                  $nums=mysqli_num_rows($query);
        while($result=mysqli_fetch_array($query))
        {    $presentPollId=$result['id'];
            if(isset($_POST[ $presentPollId]))
            {
                $count1=0;$count2=0;$count3=0;$count4=0;
                $selectqry="select * from `$presentPollId`";
                $Execselectqry=mysqli_query($con,$selectqry);
                while($fetched=mysqli_fetch_assoc($Execselectqry))
                {
                    if($fetched['response']==1)
                    $count1++;
                    else if($fetched['response']==2)
                    $count2++;
                    else if($fetched['response']==3)
                    $count3++;
                    else if($fetched['response']==4)
                    $count4++;
                }
                $total=$count1+$count2+$count3+$count4;
                $per1=floor(($count1*100)/$total);
                $per2=floor(($count2*100)/$total);
                $per3=floor(($count3*100)/$total);
                $per4=floor(($count4*100)/$total);

                ?><div id="pollresult" style="visibility:hidden;">
                    <div class="ques">Q.&nbsp;<?php echo ucwords($result['question']);?></div> <br><hr><br>
                    <div class="opt">1.&nbsp;<?php echo ucwords($result['opt1']);?></div> <?php echo" <div class='voteper'>Votes:  $per1% </div>&nbsp;&nbsp;&nbsp";?><img src="blue.jpg" alt="" style="display:inline-block" width=<?php echo 1.5*$per1+5 ;?> height=22rem> <br>
                    <div class="opt">2.&nbsp;<?php echo ucwords($result['opt2']);?></div> <?php echo" <div class='voteper'>Votes:  $per2% </div>&nbsp;&nbsp;&nbsp";?><img src="green.png" alt="" style="display:inline-block" width=<?php echo 1.5*$per2+5;?> height=22rem> <br>
                    <div class="opt">3.&nbsp;<?php echo ucwords($result['opt3']);?></div> <?php echo" <div class='voteper'>Votes:  $per3% </div>&nbsp;&nbsp;&nbsp";?><img src="red.jpg" alt="" style="display:inline-block" width=<?php echo 1.5*$per3+5;?> height=22rem> <br>
                    <div class="opt">4.&nbsp;<?php echo ucwords($result['opt4']);?></div> <?php echo" <div class='voteper'>Votes:  $per4% </div>&nbsp;&nbsp;&nbsp";?><img src="yellow.png" alt="" style="display:inline-block" width=<?php echo 1.5*$per4+5;?> height=22rem> <br>
                    <div class="btnclose" id="closeres">Close</div>

                </div>
                <script>
                    var pollRes=document.getElementById('pollresult');
                    var closeres=document.getElementById('closeres');
                    var table=document.getElementById('pollData');
                    table.style.visibility="hidden";
                    
                    pollRes.style.visibility="visible";
                    closeres.addEventListener("click",()=>{
                        pollRes.style.visibility="hidden";
                    table.style.visibility="visible";

                    })
                </script>
                <?php
                break;
            }
        
        }

        ?>;

</script>
</body>
</html>