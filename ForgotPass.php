<?php

use PHPMailer\PHPMailer\SMTP;

session_start();

include 'connection.php';
include 'toaster.php';

if (isset($_POST["verify_otp"])) {
    $enteredOtp = $_POST["otp"];
    $mail = $_SESSION['temp_mail'];

    // Get the new OTP from the database
    $qry = "SELECT otp FROM otps where email = '$mail' limit 3";
    $storedOtp = mysqli_fetch_assoc(mysqli_query($con, $qry))['otp'];

    // Verify OTP with user OTP
    if ($enteredOtp == $storedOtp) {
        // OTP is valid, proceed to update user's password
        $newPassword = $_POST["new_password"];
        $confirmNewPassword = $_POST["confirm_new_password"];

        if ($newPassword !== $confirmNewPassword) {
            echo '<script>showToaster("Passwords do not match." , "red")</script>';
            header("#verifyOtpForm");
            exit();
        }

        // Hash the new password for security
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update user's password in the database
        $qry = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $con->prepare($qry);
        $stmt->bind_param("ss", $hashedPassword, $mail);
        $stmt->execute();

        // Clear the OTP session
        unset($_SESSION['temp_mail']);

        // Delete the OTP from the table
        $qry = "DELETE FROM otps WHERE email = '$mail'";
        mysqli_query($con, $qry);

        // Display success message and redirect
        echo '<script>showToaster("Password reset successful!" , "green")</script>';
        header("Location: index.php?popup=login&msg=true");
        exit();
    } else {
        unset($_SESSION['temp_mail']);
        echo '<script>showToaster("Invalid OTP. Please try again." , "red")</script>';
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>

    <link rel="icon" type="image/ico" href="img/buslogo.png">
    <link rel="stylesheet" href="css/forgotpass.css">

    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- ========================== form bg =========================== -->
</head>

<body>

    <div class="Forgot-form">
        <!-- <form id="otpRequestForm"> -->
        <div id="otpRequestForm">

            <h1>Forgot Password</h1>
            <hr>
            <div class="content">
                <div class="input-field">
                    <input type="email" placeholder="Enter Email" name="email" id="mail_send_otp" autocomplete="no">
                </div>
            </div>
            <button onclick="sendOTP()">Send OTP</button>
            <button>
                <a href="index.php" style="text-decoration: none; color: black;">Home</a>
            </button>
            
        </div>

        <form id="verifyOtpForm" style="display:none;" method="post">
            <div class="content">
                <div class="input-field">
                    <input type="text" placeholder="Enter OTP" name="otp" required>
                </div>
                <div class="input-field">
                    <input type="password" placeholder="Enter New Password" name="new_password" required>
                </div>
                <div class="input-field">
                    <input type="password" placeholder="Confirm New Password" name="confirm_new_password" required>
                    <i class="show-password-icon fa-solid fa-eye" onclick="togglePasswordVisibility('login_password', this)"></i>
                </div>
            </div>
            <button type="submit" name="verify_otp">Verify OTP and Set New Password</button>
        </form>
        <div class="bus">
                <marquee behavior="" direction="right" scrollamount="20" style="margin-bottom: -5px; padding:0;">
                    <img class="ml-1 bus" src="img/travel.png" style="max-width: 150px;">
                </marquee>
            </div>
    <script>
        function sendOTP() {
            //console.log ma dekhai
            console.log('SendOTP');
            email = $('#mail_send_otp').val();
            $.ajax({
                method: 'POST',
                url: 'sendotp.php',
                data: {
                    email: email
                },
                success: function(res) {
                    if (res === 0) {
                        // console.log("invaild user");
                        showToaster("invaild user", "red");
                    } else {
                        document.getElementById('otpRequestForm').style.display = 'none';
                        document.getElementById('verifyOtpForm').style.display = 'block';
                    }
                }
            });
        }

        // show password 
        function togglePasswordVisibility(fieldId, icon) {
            var passwordField = document.getElementById(fieldId);
            var iconElement = icon.querySelector(".show-password-icon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }

            setTimeout(function() {
                passwordField.type = "password";
            }, 2000);
        }
    </script>
</body>

</html>