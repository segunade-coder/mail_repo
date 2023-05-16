<?php

// Database credentials
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name = "send_mail"; // Database name 

// Connect to server and select database.
$conn = mysqli_connect("$host", "$username", "$password","$db_name") or die(mysqli_error($conn));

if (!$conn){
    $response = array(
        "status"=>false,
        "message"=>"Not connected to database"
    );
    echo json_encode($response);
}

?>