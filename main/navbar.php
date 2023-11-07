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
        $checkEmailQuery = "SELECT * FROM users WHERE email=?";
        $stmt = $con->prepare($checkEmailQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row["password"];

            if (password_verify($password, $hashedPassword)) {
                $user_id = $row['id'];
                $_SESSION['username'] = $email;
                $_SESSION['user_id'] = $user_id;
                $role = $row['role'];
                if ($role) {
                    header("Location:user/user.php");
                } else {
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



    if (!empty($validationErrors)) {
        foreach ($validationErrors as $error) {
            echo '<script>showToaster("' . $error . '", "red")</script>';
        }
    } else {
        $checkEmailQuery = "SELECT id FROM users WHERE email=?";
        $stmt = $con->prepare($checkEmailQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<script>showToaster("Email already exists. Please use a different email.", "red")</script>';
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

    <title>Home Page</title>
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
    <nav class="navbar navbar-expand-lg " style="background-color: #ffd900;">
        <a class="navbar-brand" href="#"><img src="img/buslogo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <img src="img/menu.png" alt="Login" width="30" height="30">
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <marquee scrollamount="20" style="font-weight:600; font-size: 2rem; ">Bus Pass Management System </marquee>
            <?php
            if (!isset($_SESSION['username'])) { ?>
                <button type="button" class="btn-lg" data-toggle="modal" data-target="#loginModal" id="login_btn">Login</button>
            <?php } else { ?>
                <a href="logout.php" class="btn-lg">Logout</a>
            <?php } ?>

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
                            <form id="registrationForm" style="display:none;" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="fullName" placeholder="Firstname Lastname" name="full_name" required>
                                    <span id="fullNameError" class="error"></span>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" id="phoneNumber" placeholder="Phone Number" name="phone_number" maxlength="10" required>
                                    <span id="phoneNumberError" class="error"></span>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="regEmail" placeholder="Email" name="email">
                                    <span id="emailError" class="error"></span>
                                </div>
                                <div class="form-group password-container">
                                    <input type="password" class="form-control login_password" id="regPassword" placeholder="Password" name="password" required>
                                    <span id="passwordError" class="error"></span>
                                </div>
                                <div class="form-group password-container">
                                    <input type="password" class="form-control login_password" id="confirmPassword" placeholder="Confirm Password" name="confirm_password" required>
                                    <span id="confirmPasswordError" class="error"></span>
                                    <i class="show-password-icon fa-solid fa-eye" onclick="togglePasswordVisibility('.login_password', this)"></i>
                                </div>
                                <button type="submit" class="btn-lr btn-block" value="registr" name="submit">Sign Up</button>
                            </form>

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

    <script>
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
                    'required': true,
                    'email': true,
                },
            },
            messages: {
                'email': {
                    'required': 'Email address is required',
                    'email': 'Email don\'t have valid Format ',
                }
            }
        })
    </script>
    <script>
        document.getElementById('fullName').addEventListener('input', function() {
            validateFullName();
        });

        document.getElementById('phoneNumber').addEventListener('input', function() {
            validatePhoneNumber();
        });

        document.getElementById('regEmail').addEventListener('input', function() {
            validateEmail();
        });

        document.getElementById('regPassword').addEventListener('input', function() {
            validatePassword();
        });

        document.getElementById('confirmPassword').addEventListener('input', function() {
            validateConfirmPassword();
        });

        function validateFullName() {
            const fullNameInput = document.getElementById('fullName');
            const fullNameError = document.getElementById('fullNameError');
            const fullName = fullNameInput.value;

            if (!/^[A-Za-z]+\s[A-Za-z]+$/.test(fullName)) {
                fullNameError.textContent = "Please enter a valid Full Name. Firstname  Lastname";
            } else {
                fullNameError.textContent = "";
            }
        }

        function validatePhoneNumber() {
            const phoneNumberInput = document.getElementById('phoneNumber');
            const phoneNumberError = document.getElementById('phoneNumberError');
            const phoneNumber = phoneNumberInput.value;

            if (!/^[6-9]\d{9}$/.test(phoneNumber)) {
                phoneNumberError.textContent = "Invalid Indian Phone Number. Enter a 10-digit number starting with 6, 7, 8, 9.";
            } else {
                phoneNumberError.textContent = "";
            }
        }

        function validateEmail() {
            const emailInput = document.getElementById('regEmail');
            const emailError = document.getElementById('emailError');
            const email = emailInput.value;
            const emailPattern = /^[A-Z0-9._%+-]+@(gmail\.com|yahoo\.com)$/i;

            if (!/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i.test(email)) {
                emailError.textContent = "Please enter a valid email address.";
            } else if (!/^[A-Z0-9._%+-]+@(gmail\.com|yahoo\.com)$/i.test(email)) {
                emailError.textContent = "Email must end with either @gmail.com or @yahoo.com.";
            } else if (!/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i.test(email.split('@')[0])) {
                emailError.textContent = "Email must contain characters and numbers before the @ symbol.";
            } else {
                emailError.textContent = "";
            }
        }

        function validatePassword() {
            const passwordInput = document.getElementById('regPassword');
            const passwordError = document.getElementById('passwordError');
            const password = passwordInput.value;

            if (password.length < 8) {
                passwordError.textContent = "Please enter a password with at least 8 characters.";
            } else if (!/[0-9]/.test(password) || !/[!@#$%^&*()_+{}\[\]:;<>,.?~\\\-]/.test(password)) {
                passwordError.textContent = "Password must contain at least one number and one special character.";
            } else {
                passwordError.textContent = "";
            }
        }

        function validateConfirmPassword() {
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const confirmPasswordError = document.getElementById('confirmPasswordError');
            const confirmPassword = confirmPasswordInput.value;
            const passwordInput = document.getElementById('regPassword');
            const password = passwordInput.value;

            if (confirmPassword !== password) {
                confirmPasswordError.textContent = "Passwords do not match.";
            } else {
                confirmPasswordError.textContent = "";
            }
        }
    </script>

</body>

</html>