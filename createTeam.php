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
    <title>Create Team</title>
    <link rel="stylesheet" href="createTeam.css">
    <link rel="stylesheet" href="home.css">
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
        .ucmsg{
            position:absolute;
            font-size:40px;
            color:black;
            top:10%;
            left:50%;
            transform: translate(-50%,-10%);
        }
        .form{
            position: absolute;
            top:80%;
        }
        .add{
            border-radius:15px;
            box-shadow:1px 1px 8px red;
        }
        .add:hover{
            cursor:pointer;
        }
    </style>
</head>
<body>
    <!-- <img src="bg2.jpg" alt="Cool BG Image" id='img'> -->
    <!-- <img src="bgnew.jpg" alt="Cool Image :)" id='bgimg'> -->
    <nav class="navbar">
            <ul>
            <li><button class="btn" ><a href="admin.php"> Home </a></button></li>
                <li><button class="btn" ><a href="createPoll.php"> Create Poll </a></button></li>
                <li><button class="btn" id="create"   ><a href="createTeam.php"> Create Team </a></button></li>
                <li><button class="btn" ><a href="dashboard.php"> Dashboard </a> </button></li>
                <li><button class="btn" id='logout'><a href="logout.php"> Logout </a></button></li>
            </ul>
         </nav>
         <div class="ucmsg">Under Construction</div>
    <div class="table">
        <table id="userData">
            <thead>
                <tr>
                    <th>Sr.no</th>
                   <th>Username</th>
                   <th>EmailId</th>
                   <th>Options</th>
                </tr>
            </thead>
            <tbody>
                 
            <?php
                  
                  include 'config.php';
                  $choose= "select * from registration"; 
                  $query=mysqli_query($con,$choose);
                  $nums=mysqli_num_rows($query);
                  while($result=mysqli_fetch_array($query))
                  {
                      ?><tr>
                          <td><?php echo $result['id'];?></td>
                          <td><?php echo $result['name'];?></td>
                          <td><?php echo $result['email'];?></td>
                          <td class='opt'><img src="add-user.png" alt="+" class='add' id=<?php echo $result['id'] ?> ></td>
                      </tr>
                      <?php
    
                  }
               
            ?> 
            </tbody>
        </table>
    </div>
    <form action="" method="POST" class='form' autocomplete=off>
        <!-- <button class="btn" id="finalCreate">CREATE</button> -->
        <!-- <input type="text" name="teamName" placeholder='Team Name' class='btn'>
        <input type="submit" name='submit' class='btn'> -->
    </form>
</body>
<script>
    var num=<?php echo mysqli_num_rows($query)?>;
        var add=document.getElementsByClassName('add');
        var userid=new Array(num+1);
        for(let ind=0;ind<num+1;ind++) userid[ind]=0;
for(let i=0;i<add.length;i++)
{
    add[i].addEventListener("click",()=>{
        if(add[i].style.backgroundColor=="yellowgreen")
        {
            add[i].style.backgroundColor="rgb(204, 34, 34)";
            add[i].style.boxShadow="1px 1px 8px red";
            userid[add[i].id]=0;
        }
        else
        {
            add[i].style.backgroundColor="yellowgreen";
            add[i].style.boxShadow="1px 1px 8px green";
            userid[add[i].id]=1;


        }
        console.log(add[i].id);
        
    })
}
console.log(userid.length);
console.log(userid);
    </script>
    <div class="hidden">
        <form action="" method="Post" id='hide'>
        <script>
             for(let i=0;i<userid.length;i++)
             {
                 if(userid[i]!=0)
                 {
                     var x= createElement("Input");
                     x.setAttribute("type","")
                 }
             }
            </script>
        </form>
    </div>
    
</html>