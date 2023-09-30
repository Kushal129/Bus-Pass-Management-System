<?php

require '../connection.php';
$from = $_POST['from'];
$to = $_POST['to'];

$sql = "select * from bus_terminals where ter_id = '$from' or ter_id = '$to' ";
$run = mysqli_query($con, $sql);

$num = mysqli_num_rows($run);

if ($num == 2) {
    $res = array();
    while ($data = mysqli_fetch_assoc($run)) {
        $res[] = $data;
    }
    echo json_encode($res);
}
