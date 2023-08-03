<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>

    <link rel="icon" type="image/ico" href="img/buslogo.png">
    <link rel="stylesheet" href="css/forgotpass.css">

    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
        crossorigin="anonymous"></script>

    <!-- ========================== form bg =========================== -->
</head>

<body>

<div class="Forgot-form">
    <?php
    if (isset($_POST["request_otp"])) {
        // Generate a random 6-digit OTP
        $otp = rand(100000, 999999);

        // Send the OTP to the user's email
        $to = $_POST["email"];
        $subject = "Your OTP Code";
        $message = "Your OTP code is: $otp";
        mail($to, $subject, $message);

        // Store the OTP in a session
        session_start();
        $_SESSION["otp"] = $otp;

        echo "<h1>OTP Sent</h1>";
    } else {
    ?>
    <div class="Forgot-form">
        <form id="otpRequestForm" method="POST" action="otppage.php">
            <h1>Forgot Password</h1>

            <div class="content">
                <div class="input-field">
                    <input type="email" placeholder="Enter Email" name="email" autocomplete="no">
                </div>
            </div>
            <button type="submit" name="request_otp">Send OTP</button>
        </form>

        <form id="verifyOtpForm" style="display:none;" method="post" action="verify_otp.php">
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
    <?php
    }
    ?>
    <script>
        // Show OTP form on successful OTP request
        document.getElementById('otpRequestForm').addEventListener('submit', function () {
            document.getElementById('otpRequestForm').style.display = 'none';
            document.getElementById('verifyOtpForm').style.display = 'block';
        });
    </script>

</body>

</html>
