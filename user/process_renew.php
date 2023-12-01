<?php
include_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Invalid request method";
    exit();
}

if (!isset($_POST['passid']) || !isset($_POST['category_renew'])) {
    echo "Missing parameters";
    exit();
}

$passId = $_POST['passid'];
$category = $_POST['category_renew'];


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($category === 'Student') {
    $sql = "SELECT * FROM passenger_info WHERE id = '$passId' AND role = 'Student'";
} elseif ($category === 'Passenger') {
    $sql = "SELECT * FROM passenger_info WHERE id = '$passId' AND role = 'Passenger'";
} else {
    echo "Invalid category";
    exit();
}

$result = $con->query($sql);

if (!$result) {
    echo "Query error: " . $con->error;
    exit();
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Name: " . $row['full_name'] . "<br>";
        echo "Role: " . $row['role'] . "<br>";
    }
} else {
    echo "No data found for Pass ID: $passId and Role: $category";
}

$con->close();
?>
