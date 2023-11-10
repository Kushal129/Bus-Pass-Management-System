<?php 

include_once '../connection.php';

$status = $_GET['status'];
$pass_id = $_GET['pass_id'];

$qry = "UPDATE pass SET is_verify = $status  WHERE id = $pass_id"; 
mysqli_query($con , $qry);

header('location: Search.php');
?>