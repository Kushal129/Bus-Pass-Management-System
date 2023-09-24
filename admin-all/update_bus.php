<?php
include_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $bus_id = $_POST['bus_id'];
    $bus_name = $_POST['bus_name'];
    $price_multiply = $_POST['price_multiply'];

    $sql = "UPDATE bus_type SET bus_name = '$bus_name', price_multiply = '$price_multiply' WHERE bus_id = $bus_id";

    $result = mysqli_query($con, $sql);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Data updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
