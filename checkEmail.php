<?php

include 'config.php';

if(isset($_POST['email']) == true)
{

    $email = $_POST['email'];
    
    $query = "select email from user where email='$email'";
    $con = mysqli_query($conn,$query);
    $arr = mysqli_fetch_assoc($con);
    $row = mysqli_num_rows($con);
    // print_r($row);
    // exit;
    
    // if($row  > 0)
    // {
    //    echo 'email is exist ';
    // }
    // else{   
        
    //     return true;
    // }

    $rowdata = ($row > 0) ? 'true' : 'false';
}

?>  