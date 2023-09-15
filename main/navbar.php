<?php
// Login Form Submit

include "mail_config.php";
include "connection.php";
include "toaster.php";

session_abort();
session_start();

if (isset($_POST["login_submit"])) {
    $email = $_POST["login_email"];
    $password = $_POST["login_password"];
    if (empty($password)) {
        echo '<script>showToaster("Please enter your password.", "red")</script>';
        echo '<script>showLoginModal()</script>';
    } else {
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

                $_SESSION['username'] = $email;
                $role = $row['role'];
                // 1 - user and 0 - admin
                if ($role) {
                    // echo "USER";
                    header("Location:user/user.php");
                } else {
                    // echo "ADMIN";
                    header("Location:admin-all/admin.php");
                }
            } else {
                echo '<script>showToaster("Password Incorrect " , "red")</script>';
                echo '<script>showLoginModal()</script>';
            }
        } else {
            echo '<script>showToaster("Email not found. Please enter a valid email address. " , "red")</script>';
            echo '<script>showLoginModal()</script>';
        }
    }
}
if (isset($_POST["submit"])) {
    $full_name = $_POST["full_name"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $validationErrors = array();

    if (!preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $full_name)) {
        $validationErrors[] = "Please enter a valid Full Name. Firstname _ Lastname ";
        echo '<script>window.location.href = "#registrationForm";</script>';
    }
    if (strlen($password) < 8) {
        $validationErrors[] = "Please enter a password with at least 8 characters.";
        echo '<script>window.location.href = "#registrationForm";</script>';
    }

    if (!preg_match('/[0-9]/', $password) || !preg_match('/[!@#$%^&*()_+{}\[\]:;<>,.?~\\\-]/', $password)) {
        $validationErrors[] = "Password must contain at least one number and one special character.";
        echo '<script>window.location.href = "#registrationForm";</script>';
    }

    if (!preg_match('/^[6-9]\d{9}$/', $phone_number)) {
        $validationErrors[] = "Invalid Indian Phone Number. Enter a 10-digit number starting with 6, 7, 8, 9.";
        echo '<script>window.location.href = "#registrationForm";</script>';
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        $validationErrors[] = "Passwords do not match.";
        echo '<script>window.location.href = "#registrationForm";</script>';
    }

    if (!empty($validationErrors)) {
        foreach ($validationErrors as $error) {
            echo '<script>showToaster("' . $error . '", "red")</script>';
        }
    } else {
        // Check if the email already exists in the database
        $checkEmailQuery = "SELECT id FROM users WHERE email=?";
        $stmt = $con->prepare($checkEmailQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<script>showToaster("Email already exists. Please use a different email.", "red")</script>';
            // echo '<script>showRegistrationModal()</script>';
            echo '<script>window.location.href = "#registrationForm";</script>';
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insertQuery = "INSERT INTO users (full_name, phone_number, email, password) VALUES (?, ?, ?, ?)";
            $stmt = $con->prepare($insertQuery);
            $stmt->bind_param("ssss", $full_name, $phone_number, $email, $hashedPassword);

            if ($stmt->execute()) {
                echo '<script>showToaster("Registration successful. You can now log in.", "green")</script>';
                echo '<script>window.location.href = "#loginModal";</script>';

                echo '<script>showLoginModal()</script>';
            } else {
                echo '<script>showToaster("Error while registering. Please try again.", "red")</script>';
                echo '<script>window.location.href = "#registrationForm";</script>';
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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Home</title>
</head>

<body>
    <script>
        function showLoginModal() {
            $("#loginModal").modal('show');
        }

        function showRegistrationModal() {
            $("#registrationForm").modal('show');
        }
    </script>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg " style="background-color: #ffd900;">
        <a class="navbar-brand" href="#"><img src="img/buslogo.png" width="30" height="30" class="d-inline-block align-top" alt></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            </ul>

            <!-- //login button logout button -->
            <?php
            if (!isset($_SESSION['username'])) { ?>
                <button type="button" class="btn-lg" data-toggle="modal" data-target="#loginModal" id="login_btn">Login</button>
            <?php } else { ?>
                <a href="logout.php" class="btn-lg">Logout</a>
            <?php } ?>


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
                                    <input type="email" class="form-control" id="login_email" placeholder="Enter Email" name="login_email" required>
                                </div>
                                <div class="form-group password-container">
                                    <input type="password" class="form-control" id="login_password" placeholder="Enter Password" name="login_password" required>
                                    <i class="show-password-icon fa-solid fa-eye" onclick="togglePasswordVisibility('#login_password', this)"></i>

                                </div>
                                <button type="submit" class="btn-lr btn-block" name="login_submit">Sign In</button>
                            </form>
                            <!-- Registration Form -->

                            <form id="registrationForm" style="display:none;" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="fullName" placeholder=" Firstname Lastname" name="full_name" required>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" id="phoneNumber" placeholder=" Phone Number" name="phone_number" maxlength="10" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="regEmail" placeholder=" Email" name="email">
                                </div>
                                <div class="form-group password-container">
                                    <input type="password" class="form-control login_password" id="regPassword" placeholder=" Password" name="password" required>
                                </div>
                                <div class="form-group password-container">
                                    <input type="password" class="form-control login_password" id="confirmPassword" placeholder=" Confirm Password" name="confirm_password" required>
                                    <i class="show-password-icon fa-solid fa-eye" onclick="togglePasswordVisibility('.login_password', this)"></i>
                                </div>
                                <button type="submit" class="btn-lr btn-block" value="registr" name="submit">Sign
                                    Up</button>
                            </form>
                            <!-- Toggle between Login and Registration forms -->
                            <p class="text-center mt-3 mb-0">
                                <a href="#" id="signupLink">Create an account</a>
                                <a href="main/ForgotPass.php" id="signupLink">ForgotPassword?</a>
                                <a href="#" id="signinLink" class="signinLink" style="display:none;">Already have an account? Sign In</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    </nav>



    <!-- validations  -->

    <script>
        var phoneNumberInput = document.getElementById('phoneNumber');
        phoneNumberInput.addEventListener('input', function(event) {
            var inputValue = event.target.value;
            var numericValue = inputValue.replace(/\D/g, ''); // Remove non-numeric characters
            var maxLength = parseInt(event.target.getAttribute('maxlength'));
            var truncatedValue = numericValue.slice(0, maxLength); // Limit to 10 digits
            event.target.value = truncatedValue;
        });
    </script>


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

        // show password 
        function togglePasswordVisibility(fieldId, icon) {
            var passwordFields = document.querySelectorAll(fieldId);
            console.log(passwordFields);
            var iconElement = icon.querySelector(".show-password-icon");
            passwordFields.forEach(passwordField => {
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                } else {
                    passwordField.type = "password";
                }
                setTimeout(function() {
                    passwordField.type = "password";
                }, 2000);
            });
        }
    </script>


    <script>
        $('#loginForm').validate({
            rules: {
                "email": {
                    'required':true,
                    'email':true,
                },
            },
            messages: {
                'email':{
                    'required':'Email address is required',
                    'email':'Email don\'t have valid Format ',
                }
            }
        })
    </script>

</body>

</html>