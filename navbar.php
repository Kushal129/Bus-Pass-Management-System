<?php
// Login Form Submit

include 'mail_config.php';

if (isset($_POST["login_submit"])) {
    $email = $_POST["login_email"];
    $password = $_POST["login_password"];

    // Check if the email exists in the database
    $checkEmailQuery = "SELECT * FROM users WHERE email=?";
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


            $_SESSION['username'] = $email;
            echo '<script>showToaster("Welcome  ,$username" , "green")</script>';
            $role = $row['role'];
            // echo $role;
            // 1 - user and 0 - admin
            if ($role) {
                // echo "USER";
                header("Location: user.php");
            } else {
                // echo "ADMIN";
                header("Location: admin.php");
            }
            // exit();
        } else {
            echo '<script>showToaster("Password Incorrect " , "red")</script>';
            echo '<script>showLoginModal()</script>';

            // header("location:index.php");
            // exit();
        }
    } else {
        // $_SESSION['alert'] = "Email not found. Please enter a valid email address.";
        // header("Location: navbar.php");
        echo '<script>showToaster("Email not found " "red")</script>';
        echo '<script>showLoginModal()</script>';

    }
}

if (isset($_POST["submit"])) 
{
    $full_name = $_POST["full_name"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $error = array();

    if (empty($full_name) || empty($phone_number) || empty($email) || empty($password)) {
        array_push($error, "All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($error, "Please enter a valid email address.");
    }

    if (strlen($password) < 8) {
        array_push($error, "Please enter a password with at least 8 characters.");
    }

    if (count($error) > 0) {
        foreach ($error as $errorMsg) {
            echo "<div class='alert alert-danger'>$errorMsg</div>";
        }
    } else {
        // Check if the email already exists in the database
        $checkEmailQuery = "SELECT id FROM users WHERE email=?";
        $stmt = $con->prepare($checkEmailQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // echo "<div class='alert alert-danger'>Email already exists. Please use a different email.</div>";
            echo '<script>showToaster("Email already exists. Please use a different email. " , "red")</script>';
            echo '<script>showRegistrationModal()</script>';


        } else {
            // Hash the password for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // Insert data into the "users" table
            $insertQuery = "INSERT INTO users (full_name, phone_number, email, password) VALUES (?, ?, ?, ?)";
            $stmt = $con->prepare($insertQuery);
            $stmt->bind_param("ssss", $full_name, $phone_number, $email, $hashedPassword);

            if ($stmt->execute()) {
            // echo "<div class='alert alert-success'>Registration successful. You can now log in.</div>";
            echo '<script>showToaster("Registration successful. You can now log in " , "Green")</script>';
            echo '<script>showRegistrationModal()</script>';


            } else {
                // echo "<div class='alert alert-danger'>Error while registering. Please try again later.</div>";
            echo '<script>showToaster("Error while registering. Please try again " , "red")</script>';
            echo '<script>showRegistrationModal()</script>';

            }
        }
    }
}

$con->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/modalpoppup.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Home</title>
    <script>
    function showLoginModal() {
        $("#loginModal").modal('show');
    }

    function showRegistrationModal() {
        $("#registrationForm").modal('show');
    }
    </script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-warning ">
        <a class="navbar-brand" href="#"><img src="img/buslogo.png" width="30" height="30"
                class="d-inline-block align-top" alt></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Pass</a>
                        <a class="dropdown-item" href="#">Payment</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>

            <?php
            if (!isset($_SESSION['username'])) { ?>
            <button type="button" class="btn-lg" data-toggle="modal" data-target="#loginModal">Login</button>
            <?php } else { ?>
            <a href="logout.php" class="btn-lg">Logout</a>
            <?php } ?>

            <!-- Bootstrap Modal -->

            <!-- Login and Registration Modal -->
            <div class="modal fade" id="loginModal" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="loginModalLabel">Login</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Login Form -->
                            <form id="loginForm" method="post">
                                <div class="form-group">
                                    <input type="email" class="form-control" id="login_email" placeholder="Enter Email"
                                        name="login_email">
                                </div>
                                <div class="form-group password-container">
                                    <input type="password" class="form-control" id="login_password"
                                        placeholder="Enter Password" name="login_password">
                                    <i class="show-password-icon fa-solid fa-eye" onclick="togglePasswordVisibility('login_password', this)"></i>
                                    <!-- <button class="btn  btn-small btn-primary" onclick="sendOTP()">Send OTP</button> -->
                                </div>
                                <!-- <div class="form-group otp-container" id="otp_field">
                                    <input type="text" class="form-control" id="login_otp"
                                        placeholder="Enter OTP" name="otp">
                                </div> -->
                                <button type="submit" class="btn-lr btn-block" name="login_submit">Sign In</button>
                            </form>
                            <!-- Registration Form -->

                            <form id="registrationForm" style="display:none;" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="fullName" placeholder="Full Name"
                                        name="full_name">
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" id="phoneNumber" placeholder="Phone Number"
                                        name="phone_number">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="regEmail" placeholder="Email"
                                        name="email">
                                </div>
                                <div class="form-group password-container">
                                    <input type="password" class="form-control" id="regPassword" placeholder="Password"
                                        name="password">
                                    <i class="show-password-icon fa-solid fa-eye"
                                        onclick="togglePassword('regPassword', this)"></i>
                                </div>
                                <button type="submit" class="btn-lr btn-block" value="registr" name="submit">Sign
                                    Up</button>
                            </form>
                            <!-- Toggle between Login and Registration forms -->
                            <p class="text-center mt-3 mb-0">
                                <a href="#" id="signupLink">Create an account</a>
                                <a href="ForgotPass.php" id="signupLink">ForgotPassword?</a>
                                <a href="#" id="signinLink" style="display:none;">Already have an account? Sign In</a>

                            </p>
                        </div>
                    </div>
                </div>
            </div>

    </nav>

    <!-- Main content -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
    // Toggle between Login and Registration forms
    document.getElementById('signupLink').addEventListener('click', function() {
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('registrationForm').style.display = 'block';
        document.getElementById('signinLink').style.display = 'block';
        document.getElementById('loginModalLabel').innerText = 'Registration';
        this.style.display = 'none';
    });

    document.getElementById('signinLink').addEventListener('click', function() {
        document.getElementById('loginForm').style.display = 'block';
        document.getElementById('registrationForm').style.display = 'none';
        document.getElementById('signupLink').style.display = 'block';
        document.getElementById('loginModalLabel').innerText = 'Login';
        this.style.display = 'none';
    });

    // show password in L&R
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
        }, 5000); // Hide the password after 5 seconds
    }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>