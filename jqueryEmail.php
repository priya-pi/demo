<?php

include 'config.php';
include 'header.php';

$email1 = $_GET['email'];

$qu = "select * from user where email='$email1'";
$co = mysqli_query($conn, $qu);
$arr1 = mysqli_num_rows($co);

if($arr1 > 0)
{
    echo 'false';
}else{
    // echo 'true';
}


?>