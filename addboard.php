<?php
include 'config.php';
if (isset($_GET['id'])) {
    if (!empty($_POST['head']) && !empty($_POST['detail']) && !empty($_POST['type'])) {
        $user = $_SESSION['username'];
        $head = $_POST['head'];
        $detail = $_POST['detail'];
        $type = $_POST['type'];
        $date = date("Y-m-d");
        $sql = "SELECT * FROM `user` WHERE `username` = '$user'";
        $mysql = mysqli_query($conn, $sql);
        $infouser = mysqli_fetch_array($mysql);
        $iduser = $infouser['id_user'];
        $sql = "INSERT INTO `board`(`id_board`, `b_name`, `detail`, `id_user`, `b_time`, `b_type`) 
                        VALUES ('','$head','$detail','$iduser','$date','$type')";
        $mysql = mysqli_query($conn, $sql);
        if ($mysql) {
            echo "เพิ่มข้อมูลเสร็จแล้ว";
        } else {
            echo "เพิ่มข้อมูลไม่สำเร็จ";
        }
    }
    else{
        echo "กรองข้อมูลให้ครบ";
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
        table {
            margin: auto;
        }
    </style>
</head>

<body>
    <form action="?id=1" method="POST" id="addboard">
        <table border="1">
            <tr>
                <td><input type="text" name="head"></td>
            </tr>
            <tr>
                <td><textarea form="addboard" name="detail" rows="15" cols="50"></textarea></td>
            </tr>
            <tr>
                <td><select name="type">
                        <option value="ดราม่า">ดราม่า</option>
                        <option value="18+">18+</option>
                    </select></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="ตั้งกระทู้">
                    <a href="index.php"><input type="button" value="กลับ"></a>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>