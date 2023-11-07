<?php 
session_start();
include '../connection.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['newpass'];
    $reenteredPassword = $_POST['renewpass'];
    
    $currentPasswordQuery = "SELECT password FROM users WHERE email = ?";
    $stmt = $con->prepare($currentPasswordQuery);
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $currentHashedPassword  = $row['password'];

    if (password_verify($newPassword, $currentHashedPassword)) {
        echo 'error: New password cannot be the same as the current password.';
        exit;
    }

    if (strlen($newPassword) < 8) {
        echo 'error: Password must be at least 8 characters long.';
        exit;
    }

    if (!preg_match('/[A-Z]/', $newPassword) || !preg_match('/[a-z]/', $newPassword)) {
        echo 'error: Password must contain both uppercase and lowercase letters.';
        exit;
    }

    if (!preg_match('/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/', $newPassword)) {
        echo 'error: Password must contain at least one special character.';
        exit;
    }

    if (!preg_match('/\d/', $newPassword)) {
        echo 'error: Password must contain at least one digit.';
        exit;
    }

    if ($newPassword !== $reenteredPassword) {
        echo 'error: Passwords do not match.';
        exit;
    }
    
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $updatePasswordQuery = "UPDATE users SET password = ? WHERE email = ?";
    $stmt = $con->prepare($updatePasswordQuery);
    $stmt->bind_param("ss", $hashedPassword, $_SESSION['username']);

    if ($stmt->execute()) {
        echo 'success: Password updated successfully.';
        exit;
    } else {
        echo 'error: An error occurred while updating the password.';
        exit;
    }
}
