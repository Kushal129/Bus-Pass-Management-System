
<!-- // $servername = "localhost";
// $username = "root";
// $password = ""; 
// $dbname = "buspassms"; 

// Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }


// =================== new ================== -->

<?php
$host = "localhost";
$username = "root";
$password = ""; // Use your actual database password here
$database = "buspassms";

$con = mysqli_connect($host, $username, $password, $database);
if (mysqli_connect_errno()) {
    echo "<script>alert('Cannot connect to the database');</script>";
}// } else {
//     echo "<script>alert('Connected successfully');</script>";
// }
?>


