<?php include 'config.php';

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM `user` WHERE `username` = '$username'";
    $mysql = mysqli_query($conn, $sql);
    if ($mysql) {
        $infouser = mysqli_fetch_array($mysql);
    } else {
        header("Location: login.php");
    }
} else {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOARD</title>

    <style>
        table {
            width: 80%;
            height: 100px;
            margin: auto;
        }

        td.Profile {
            width: 30%;
        }

        td.detail {
            width: 70%;
        }
    </style>
</head>

<body>
    <table border="1">
        <tr>
            <td class="Profile">
                <table border="1">
                    <tr>
                        <td><img src="img/<?php echo $infouser['images'] ?>" width="100px" height="100px"></td>
                    </tr>
                    <tr>
                        <td> <?php echo $infouser['full-name'] ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $_SESSION['username'] ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $infouser['sex'] ?></td>
                    </tr>
                </table>
                <a href="addboard.php"><input type="button" value="ตั้งกระทู้"></a>
                <a href="logout.php"><input type="button" value="ออกระบบ"></a>
            </td>

            <td class="detail">

                <table border="1">
                    <tr>
                        <th>ชื่อ</th>
                        <th>วันที่</th>
                        <th>ชื่อผู้เขียน</th>
                        <th>ประเภท</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM `board`";
                    $mysql = mysqli_query($conn, $sql);
                    while ($infoboard = mysqli_fetch_array($mysql)) {
                        $id = $infoboard['id_user'];
                        $nsql = "SELECT * FROM `user` WHERE id_user = '$id' ";
                        $mynsql = mysqli_query($conn, $nsql);
                        $name = mysqli_fetch_array($mynsql);
                    ?>
                        
                            <tr>
                                <td>
                                <a href="board.php?idboard=<?php echo $infoboard['id_board'] ?>"><?php echo $infoboard['b_name'];  ?> </a>
                                </td>
                                <td>
                                    <?php echo $infoboard['b_time'];  ?>
                                </td>
                                <td>
                                    <?php echo $name['full-name'];  ?>
                                </td>
                                <td>
                                    <?php echo $infoboard['b_type'];  ?>
                                </td>
                            </tr>
                       
                    <?php } ?>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>