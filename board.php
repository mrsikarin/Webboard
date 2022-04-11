<?php
include 'config.php';


if (isset($_GET['idboard'])) {
    $idboad = $_GET['idboard'];
}
$sql = "SELECT * FROM `board` WHERE `id_board` = '$idboad'";
$mysql = mysqli_query($conn, $sql);
$infoboard = mysqli_fetch_array($mysql);




if (isset($_GET['id'])) {
    if (!empty($_POST['detail_com'])) {
        $user = $_SESSION['username'];
        $sql = "SELECT * FROM `user` WHERE `username` = '$user'";
        $mysql = mysqli_query($conn, $sql);
        $infouser = mysqli_fetch_array($mysql);
        $iduser = $infouser['id_user'];


        $detail = $_POST['detail_com'];
        $date = date("Y-m-d");
        $sql = "INSERT INTO `comment`(`id_com`, `com_detail`, `id_user`, `id_board`, `com_date`)
                        VALUES ('','$detail','$iduser','$idboad','$date')";
        $mysql = mysqli_query($conn, $sql);
        if ($mysql) {
            header("Location:board.php?idboard=$idboad");
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
    <title>Document</title>
    <style>
        table {
            width: 80%;
            height: 100px;
            margin: auto;
        }
    </style>
</head>

<body>
    <table border="1">
        <tr>
            <td>
                <table border="1">
                    <tr>
                        <td><?php echo $infoboard['b_name']; ?>...........ประเภท: <?php echo $infoboard['b_type']; ?>.......วันที่: <?php echo $infoboard['b_time']; ?></td>
                    </tr>
                    <tr>
                        <td style="height: 100px;"><?php echo $infoboard['detail']; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <form action="?idboard=<?php echo $idboad; ?>&id=1" method="POST" id="com">
                    <table border="1">
                        <tr>
                            <td><textarea form="com" name="detail_com" rows="15" cols="50"></textarea></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="ตอบ">
                                <a href="index.php"><input type="button" value="กลับ"></a>
                            </td>

                        </tr>
                    </table>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <table border="1">
                    <?php
                    $sql = "SELECT * FROM `comment` WHERE `id_board` = '$idboad'";
                    $mysql = mysqli_query($conn, $sql);
                    if ($mysql) {
                        while ($listcomment = mysqli_fetch_array($mysql)) {
                            $id = $listcomment['id_user'];
                            $nsql = "SELECT * FROM `user` WHERE id_user = '$id' ";
                            $mynsql = mysqli_query($conn, $nsql);
                            $name = mysqli_fetch_array($mynsql);

                    ?>
                            <tr>
                                <td style="width: 10%;">
                
                                    <h3>ผู้ตอบ :</h3>
                                </td>
                                <td style="width: 90%;"><?php
                                                        echo $name['full-name'];
                                                        echo "วันที่ :";
                                                        echo $listcomment['com_date']; ?></td>
                            </tr>
                            <tr>
                                <td><h4>เนื้อหา :</h4></td>
                                <td><?php echo $listcomment['com_detail']; ?></td>
                            </tr>

                    <?php }
                    } ?>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>