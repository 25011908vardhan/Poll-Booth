<?php
// Starting the session as we have used server in htmlentities to prevent self exploits in php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
      Welcome To The Login Page!
    </div>
    <div class="loginForm">
        <form autocomplete="off" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
       
            <label for="email">EMAIL</label>
            <input type="email" name="email" id="email"  required>
            <label for="pass">PASSWORD</label>
            <input type="password" name="pass" id="lpass" required>
            <input type="submit" value="submit" name="submit" id="submit">
            <br>
            Don't have an Account? <a href="signup.php">Sign Up</a>
        </form>
    </div>
</body>
</html>
<?php
include 'config.php';
$adminEmail="admin@gmail.com";
$adminPass=123;
$enadp=password_hash($adminPass,PASSWORD_BCRYPT);
if(isset($_POST['submit']))
{
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    // $enpass=password_hash($pass,PASSWORD_BCRYPT);
    $emailSearch="select * from registration where email='$email'";
    $emailsearchExecutingquery= mysqli_query($con,$emailSearch);
    $emailcount=mysqli_num_rows($emailsearchExecutingquery);
    if(password_verify($pass,$enadp)&&$email==$adminEmail)
        {
            $_SESSION['username']="Admin";
            ?>
        <script>alert("Admin Login Successful!!!");
    location.replace("admin.php");</script>
        <?php
        }
    else if($emailcount>0)
    {
        $passwithemail= mysqli_fetch_assoc($emailsearchExecutingquery);//Gets an associatiove array of row whose email is found from query
        $foundpass=$passwithemail['password'];
        $_SESSION['username']=$passwithemail['name'];
        $_SESSION['usermail']=$passwithemail['email'];
       
        if(password_verify($pass,$foundpass))
        {
            ?>
        <script>alert("Login Successful!!!");
    location.replace("index.php");</script>
        <?php
        }
        else
        {
            ?>
        <script>alert("Incorrect Password!");</script>
        <?php
        }
    }
    else
    {
        ?>
        <script>alert("Email Id doesn't exists!");</script>
        <?php
    }
}

?>