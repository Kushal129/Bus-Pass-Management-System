
<?php
session_start();
require('connection.php');

// Login Form Submit
if (isset($_POST["login_submit"])) {
    $email = $_POST["login_email"];
    $password = $_POST["login_password"];

    // Check if the email exists in the database
    $checkEmailQuery = "SELECT password FROM users WHERE email=?";
    $stmt = $con->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, user is authenticated
            $_SESSION['alert'] = "Login successful.";
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['alert'] = "Invalid password. Please try again.";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['alert'] = "Email not found. Please enter a valid email address.";
        header("Location: index.php");
        exit();
    }
}
?>