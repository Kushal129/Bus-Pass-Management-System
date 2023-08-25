<?php
$host = "localhost";
$username = "root";
$password = ""; // 
$database = "buspassms";

$con = mysqli_connect($host, $username, $password, $database);
if (mysqli_connect_errno()) {
    echo "<script>alert('Cannot connect to the database');</script>";
}?>


