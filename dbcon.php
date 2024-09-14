<?php
$localhost = "localhost";
$username= "root";
$password = "";
$db_name = "school_system";

$conn = mysqli_connect($localhost,
                    $username,
                    $password,
                    $db_name);

if($conn->connect_error){
    die("Connection Error ". $conn->connect_error);
}

?> 