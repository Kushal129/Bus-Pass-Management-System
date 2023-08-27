<?php

use PHPMailer\PHPMailer\SMTP;

session_start();
include_once "../connection.php";
include_once "../toaster.php";

if (isset($_POST["verify_otp"])) {
    $enteredOtp = $_POST["otp"];

    $mail = $_SESSION['temp_mail'];

    // Get the new OTP from the database
    $qry = "SELECT otp FROM otps where email = '$mail' limit 1";

    $storedOtp = mysqli_fetch_assoc(mysqli_query($con, $qry))['otp'];

    // Verify OTP with user OTP
    if ($enteredOtp == $storedOtp) {

        $newPassword = $_POST["new_password"];
        $confirmNewPassword = $_POST["confirm_new_password"];

        if ($newPassword !== $confirmNewPassword) {
            echo '<script>showToaster("Passwords do not match." , "red")</script>';
            header("#verifyOtpForm");
            exit();
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $qry = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $con->prepare($qry);
        $stmt->bind_param("ss", $hashedPassword, $mail);
        $stmt->execute();

        unset($_SESSION['temp_mail']);

        $qry = "DELETE FROM otps WHERE email = '$mail'";
        mysqli_query($con, $qry);

        echo '<script>showToaster("Password reset successful!" , "green")</script>';
        header("Location:../index.php?popup=login&msg=true");
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
    <link rel="stylesheet" href="../css/forgotpass.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- ========================== form bg =========================== -->
</head>

<body>

    <div class="Forgot-form">
        <div id="otpRequestForm">
            <h1>Forgot Password</h1>
            <hr>
            <div class="content">
                <div class="input-field">
                    <input type="email" placeholder="Enter Email" name="email" id="mail_send_otp" autocomplete="no">
                </div>
            </div>
            <button class="btn-fr" onclick="sendOTP()">Send OTP</button>
            <button class="btn-fr">
                <a href="../index.php" class="custom-link">Home</a>
            </button>

        </div>
        <!-- //toggle -->
        <form id="verifyOtpForm" style="display:none;" method="post">
            <h1>OTP Verification </h1>
            <hr>
            <div class="content">
                <div class="input-field">
                    <input type="text" placeholder="Enter OTP" name="otp" required>
                </div>
                <div class="input-field">
                    <input type="password" placeholder="Enter New Password" name="new_password" id="new_password" required>
                </div>
                <div class="input-field">
                    <input type="password" placeholder="Confirm New Password" name="confirm_new_password" id="confirm_new_password" required>
                </div>

            </div>

            <button class="btn-fr" type="submit" name="verify_otp">Verify OTP and Set New Password</button>
        </form>


        <script>
            document.getElementById('verifyOtpForm').addEventListener('submit', function(event) {
                var newPassword = document.getElementById('new_password').value;
                var confirmPassword = document.getElementById('confirm_new_password').value;

                if (!validatePassword(newPassword)) {
                    event.preventDefault();
                    showToaster("Password must be at least 8 characters and include a special character.", "red");
                } else if (newPassword !== confirmPassword) {
                    event.preventDefault();
                    showToaster("Passwords do not match.", "red");
                }
            });

            function validatePassword(password) {
                var regex = /^(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\\\/\-])\S{8,}$/;
                return regex.test(password);
            }
        </script>
        <script>
            function sendOTP() {
                console.log('SendOTP');
                email = $('#mail_send_otp').val();

                if (email == '') {
                    return;
                }

                $.ajax({
                    method: 'POST',
                    url: '../sendotp.php',
                    data: {
                        email: email
                    },
                    success: function(res) {
                        console.log(res.trim());
                        if (res == 10) {
                            showToaster("Invaild User", "red");
                        } else {
                            document.getElementById('otpRequestForm').style.display = 'none';
                            document.getElementById('verifyOtpForm').style.display = 'block';
                        }
                    }
                });
            }
        </script>
        
</body>

</html>