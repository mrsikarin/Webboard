<?php

$conn = new mysqli("127.0.0.1","root","","webboard");

if($conn->connect_error){
    echo "ไม่สามารถเชื่อมได้";
}
session_start();
?>