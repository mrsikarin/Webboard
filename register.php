<?php

include 'config.php';

if (isset($_GET['id']) && !empty($_POST['user']) && !empty($_POST['pass'])&& !empty($_POST['sex'])&& !empty($_POST['email'])) {
    $username = $_POST['user'];
    $pass = $_POST['pass'];
    $fulln = $_POST['fulln'];
    $sex = $_POST['sex'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $img = $_FILES['imagesProfile']['name'];
    print_r($img);

    $sql = "SELECT * FROM `user` WHERE `username` = '$username'";
    $mysql = mysqli_query($conn, $sql);
    if ($mysql) {
        if (mysqli_num_rows($mysql) < 1) {
            if (move_uploaded_file($_FILES['imagesProfile']['tmp_name'], "img/" . $img)) {
                $sql = "INSERT INTO `user` (`id_user`, `username`, `pass`, `full-name`, `sex`, `email`, `tel`, `images`) VALUES 
                                          (NULL, '$username', '$pass', '$fulln', '$sex', '$email', '$tel', '$img');";
                $mysql = mysqli_query($conn,$sql);
                if($mysql)
                {
                    echo "เพิ่มข้อมูลเสร็จแล้ว";
                }
            }
        }
    } else {
        echo "ทำรายการอีกครั้ง";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div.test1 {
            margin: auto;
            background-color: red;
            align-self: center;
        }
    </style>


</head>

<body>

    <div class="formRegis">
        <form action="?id=1" method="POST" enctype="multipart/form-data">
            <input type="text" name="user">
            <input type="password" name="pass">
            <input type="text" name="fulln">
            <select name="sex">
                <option value="เพศ" selected>--เพศ--</option>
                <option value="ชาย">ชาย</option>
                <option value="หญิง">หญิง</option>
            </select>
            <input type="text" name="email">
            <input type="text" name="tel">
            <input type="file" name="imagesProfile">
            <input type="submit" value="สมัคร"><a href="login.php"><input type="button" value="กลับ"></a>
        </form>
    </div>

</body>

</html>