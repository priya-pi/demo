<?php
session_start();

$conn = mysqli_connect("localhost", "root", "Root@123", "demo");
if ($conn) {
    if (!mysqli_select_db($conn, 'demo')) {

        $db = "CREATE DATABASE  demo";
        if (mysqli_query($conn, $db)) {
            mysqli_select_db($conn, 'demo');

        }
    }
} else {
    echo mysqli_connect_error($conn);
}

function pr($row)
{
    $data = '<pre>';
    $data .= print_r($row);
    $data .= '</pre>';
}
