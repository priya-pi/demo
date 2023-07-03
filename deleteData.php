<?php

include 'config.php';

$deleteId = $_POST['deleteId'];

$query = "DELETE FROM book where id = '$deleteId'";
$con = mysqli_query($conn,$query);

header('location:serverSide.php');  

?>