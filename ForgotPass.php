<?php

use PHPMailer\PHPMailer\SMTP;

session_start();

include 'connection.php';
include 'toaster.php';

if (isset($_POST["verify_otp"])) {
    $enteredOtp = $_POST["otp"];
    $mail = $_SESSION['temp_mail'];

    //  get the new otp from database
    $qry = "SELECT otp FROM otps where email = '$mail' limit 1";
    $storedOtp = mysqli_fetch_assoc(mysqli_query($con, $qry))['otp'];
    // verify otp with user otp

    if ($enteredOtp == $storedOtp) {
        // OTP is valid, update user's password
        $newPassword = $_POST["new_password"];
        // Perform database update here (update user's password based on email or user ID)

        $qry = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $con->prepare($qry);
        $stmt->bind_param("ss", $password, $email);

        $email = $_SESSION['temp_mail'];
        $password = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt->execute();
        // Clear the OTP session
        unset($_SESSION['temp_mail']);
        echo "Password reset successful!";

        // delete the otp  from table

        $qry = "DELETE FROM otps WHERE email = '$email'";
    mysqli_query($con, $qry);

        // redirection
        header("Location:index.php");
    } else {
        unset($_SESSION['temp_mail']);
        echo "Invalid OTP. Please try again.";
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

                <div class="content">
                    <div class="input-field">
                        <input type="email" placeholder="Enter Email" name="email" id="mail_send_otp" autocomplete="no">
                    </div>
                </div>
                <button onclick="sendOTP()">Send OTP</button>
                <!-- </form> -->
            </div>

            <form id="verifyOtpForm" style="display:none;" method="post">
                <div class="content">
                    <div class="input-field">
                        <input type="text" placeholder="Enter OTP" name="otp" required>
                    </div>
                    <div class="input-field">
                        <input type="password" placeholder="Enter New Password" name="new_password" required>
                    </div>
                </div>
                <button type="submit" name="verify_otp">Verify OTP and Set New Password</button>
            </form>
        </div>
        <!-- <script>
            // Show OTP form on successful OTP request
            document.getElementById('otpRequestForm').addEventListener('submit', function() {
                document.getElementById('otpRequestForm').style.display = 'none';
                document.getElementById('verifyOtpForm').style.display = 'block';
            });
        </script> -->

        <script>
            function sendOTP() {
                console.log('SendOTP');
                email = $('#mail_send_otp').val();
                $.ajax({
                    method: 'POST',
                    url: 'sendotp.php',
                    data: {
                        email: email
                    },
                    success: function(res) {
                        if(res === 0){
                            console.log("invaild user");
                            showToaster("invaild user" , "red");
                        }else{
                            document.getElementById('otpRequestForm').style.display = 'none';
                            document.getElementById('verifyOtpForm').style.display = 'block';
                        }

                    }
                });
            }
        </script>
</body>

</html>