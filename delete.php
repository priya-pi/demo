<?php

include 'config.php';

$deleteId = $_GET['delete_id'];

$server = isset($_GET['server']) && $_GET['server'] == true ? true : false;
    
$query = "DELETE FROM book where id='$deleteId'";
$con = mysqli_query($conn,$query);

$data =[];
if($con){

    if($server) {

        $data['deleteServer'] = true;
        $data['serverMsg'] = "deleted serverside sussefully";
        echo json_encode($data);
    }

    $_SESSION['delete'] = true;
    $_SESSION['delmsg'] = "deleted sussefully";
    return true;

}

?>