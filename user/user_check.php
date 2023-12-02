<?php 
include '../connection.php';
$category = $_POST['category'];
$passId = $_POST['passId'];
$qry = "select p.id from passenger_info  pi join pass p  on p.passenger_id = pi.id where pi.role = '$category' and  p.id = $passId";
$run = mysqli_query($con , $qry);
$nums = mysqli_num_rows($run);
echo $nums;
?>