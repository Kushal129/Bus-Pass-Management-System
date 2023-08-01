<?php
// Include the database connection file
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $fullName = $_POST['fullName'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['regEmail'];
    $password = $_POST['regPassword'];

    // Check if the email already exists in the database
    $checkEmailQuery = "SELECT id FROM users WHERE email=?";
    $stmt = $conn->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email already exists. Please use a different email.";
    } else {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the "users" table
        $insertQuery = "INSERT INTO users (full_name, phone_number, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssss", $fullName, $phoneNumber, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
$conn->close();
?>
