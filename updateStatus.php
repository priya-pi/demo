<?php

include 'config.php';

$status= $_GET['status'];
$id = $_GET['id'];

$server = isset($_GET['server']) && $_GET['server'] == true ? true : false;

$update = "update book set status='$status' where id='$id'";
$con = mysqli_query($conn,$update);

$data =[];
if ($con) {

    if($server) {

        $data['statusServer'] = true;
        $data['statusMsg'] = "serverStatus change Successfully";
        echo json_encode($data);

    }else{  
        
        $_SESSION['statusDisplay'] = true;
        $_SESSION['msgDisplay'] = "displayStatus change Successfully";
        return true;
    }
    
}

?>
 