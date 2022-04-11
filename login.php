<?php
include 'config.php';

if (isset($_GET['id'])) {
$username = $_POST['user'];
$pass = $_POST['pass'];

   $sql = "SELECT * FROM user WHERE username = '$username'  AND pass = '$pass' ";
   $mysql = mysqli_query($conn,$sql);
   if($mysql)
   {
       if(mysqli_num_rows($mysql) > 0 )
       {
        $_SESSION['username'] = $username; 
        echo "ล็อกอินสำเร็จ";
        header ("Location: index.php");
       }
       else{
        echo "ล็อกอินไม่สำเร็จ";
       }
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>

    <br><br><br><br><br><br><br><br><br><br><br><center><h1> Login </h1></center>

</head>


<body>

<style>
        body {
        background-color: #999999;
        }
        </style>

    <div class="fromlogin">
        <center><form action="?id=1" method="POST">
        Username : <input type="text" name = "user"><br><br>
        Password : <input type="password" name = "pass"><br><br>
        <input type="submit" value="Login">
        <a href="register.php"><input type="button" value="Register"></a>

    </form></center>
    </div>
</body>
</html>