<?php

include 'config.php';

$id = $_GET['id'];

$sql = "select * from book where id=$id";
$data = mysqli_query($conn, $sql);
$arr = mysqli_fetch_assoc($data);

echo json_encode($arr);

?>