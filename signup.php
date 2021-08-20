<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaina+2:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="bgImg">
    <img src="bgn.jpg" alt="Bg Image" id="bg">
    </div>
    <div class="msg">
      Welcome To The Signup Page!
    </div>
    <div class="signupForm">
        <form autocomplete="off" action="" method="POST">
            
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Example" required>
            <label for="email">EMAIL</label>
            <input type="email" name="email" id="email" placeholder="example@gmail.com" required>
            <label for="pass">PASSWORD</label>

            <img src="eyecloseN.png" alt="show password" class='passtoggle' id="show" width="27" height="20">
            
            <input type="password" name="pass" id="pass" placeholder="example" required > 
            <label for="cpass">CONFIRM PASSWORD</label>
            <!-- <img src="eyeclose.jpg" alt="show password" class='passtoggle' id="show" width="20" height="20"> -->
            <input type="password" name="cpass" id="cpass" placeholder="example" required>
            <input type="submit" value="submit" name="submit" id="submit">
            <br>
            <p>Already Signed Up? <a href="login.php">Login</a></p>
        </form>
    </div>
    <script src="logic.js"></script>
</body>
</html>
<?php
include 'config.php';
?>
<?php
if(isset($_POST['submit']))
{
$name=$_POST['name'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$enpass=password_hash($pass,PASSWORD_BCRYPT);
$cpass=$_POST['cpass'];
$encpass=password_hash($cpass,PASSWORD_BCRYPT);
$emailcheck= "select * from registration where email='$email'";
$emailcheckquery= mysqli_query($con,$emailcheck);
if(mysqli_num_rows($emailcheckquery)>0)
{
    ?>
    <script>alert("Email already exists!");</script>
    <?php

}
else
{
    if($pass==$cpass)
    {
        $insertquery="insert into registration(name,email,password,cpassword) values('$name','$email','$enpass','$encpass')";
        $insertqueryExecution= mysqli_query($con,$insertquery);
        if($insertqueryExecution)
        {
            ?>
            <script>alert("Inserted Successful!!!");
            window.location="http://localhost/PollBooth/login.php"
        </script>
            
            <?php
        }
        else{
        ?>
            <script>alert("Insertion Failed!");</script>
            <?php
        }

    }
    else
    {
        ?>
    <script>alert("Passwords don't match!");</script>
    <?php

    }

}
}
?>