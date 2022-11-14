<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "carpark";
$connection = mysqli_connect($host,$user,$pass,$database);
if(mysqli_connect_errno()){
    echo "Cannot connect to Database :"  .mysqli_connect_error();
}


?>

