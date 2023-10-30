<?php
session_start();

include '../connection.php';
include_once '../toaster.php';

if (!isset($_SESSION['username'])) {
    header('location:../index.php');
    exit;
} else {
    $checkEmailQuery = "SELECT * FROM users WHERE email=?";
    $stmt = $con->prepare($checkEmailQuery);
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $role = $row['role'];
    if (!$role) {
        header("Location:../index.php");
        exit;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bus Pass | Profile </title>
    <link rel="stylesheet" href="../css/user.css">
    <link rel="icon" type="image/ico" href="../img/buslogo.png">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>
    .down-container {
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    label {
        display: block;
        font-size: 16px;
        margin-bottom: 8px;
    }

    input[type="password"] {
        background-color: #ffffe2;
        width: 30%;
        padding: 12px;
        margin-bottom: 20px;
        border: 1px solid #dddb3a;
        border-radius: 5px;
        font-size: 17px;
    }
    input[type="text"] {
        background-color: #ffffe2;
        width: 30%;
        padding: 12px;
        margin-bottom: 20px;
        border: 1px solid #dddb3a;
        border-radius: 5px;
        font-size: 17px;
    }

    .error {
        font-size: 14px;
        display: block;
        color: red;
    }

    .btn-cg {
        background-color: black;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-cg:hover {
        background-color: #434343;
    }
</style>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <div class="logo_name">B P M S</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="../user/user.php">
                    <i class='bx bx-comment-edit'></i>
                    <span class="links_name">Generate Pass</span>
                </a>
                <span class="tooltip">Generate Pass</span>
            </li>
            <li>
                <a href="../user/Managepass.php">
                    <i class='bx bx-credit-card-front'></i>
                    <span class="links_name">Manage Pass</span>
                </a>
                <span class="tooltip">Manage Pass</span>
            </li>
            <li>
                <a href="../user/manageprofile.php">
                    <i class='bx bx-user-circle'></i>
                    <span class="links_name">Manage Profile</span>
                </a>
                <span class="tooltip">Manage Profile</span>
            </li>
            <li>
                <a href="../user/changepass.php">
                    <i class='bx bx-edit'></i>
                    <span class="links_name">Change Password</span>
                </a>
                <span class="tooltip">Change Password</span>
            </li>
            <li>
                <a href="../user/userreport.php">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Reports</span>
                </a>
                <span class="tooltip">Reports</span>
            </li>
        </ul>
    </div>

    <section class="home-section">
        <div class="head">
            <div class="profile">
            <img src="<?php echo $user_img_path; ?>" class="pro-img" id="user-avatar" alt="User Avatar">
                <div class="profile-text"><?php echo $row['full_name']; ?></div>
            </div>
            <button class="logout-btn" id="logout-btn" onclick="logout()">Logout</button>
        </div>
        <form method="POST" id="password-form">
            <div class="form-group">
                <div class="down-container">
                    <h1 style="font-size: 2rem;">Change Password</h1>
                    <hr>
                    <label for="new-pass">Enter New Password</label>

                    <input type="password" class="cgshowpass" name="newpass" id="newpass" required  style="width: 30%;">
                    <i class="bx bx-hide" id="toggle-password" style="cursor: pointer;"></i>


                    <label for="renew-pass">Re-Enter New Password</label>
                    <input type="password" class="cgshowpass" name="renewpass" id="renewpass" required  style="width: 30%; margin-right: 1.3rem;" >
                    <span id="renewpass-error" class="error" style="color: red;"></span>
                    <br><br>
                    <button type="submit" class="btn-cg" value="Update Password">Update Password</button>
                </div>
            </div>
        </form>
    </section>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");

    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        menuBtnChange();
    });

    function menuBtnChange() {
        if (sidebar.classList.contains("open")) {
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else {
            closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
    }
</script>
<script>
    function logout() {

        window.location.href = '../logout.php';
    }

    document.getElementById('logout-btn').addEventListener('click', logout);
</script>

<script>
    $(document).ready(function() {
        $("#password-form").submit(function(e) {
            e.preventDefault();

            let newPassword = $("#newpass").val();
            let reNewPassword = $("#renewpass").val();

            $(".error").text("");

            if (newPassword !== reNewPassword) {
                $("#renewpass-error").text("Passwords do not match.");
                return;
            }

            $.ajax({
                type: "POST",
                url: "updatepass.php",
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response);

                    $("#newpass").val("");
                    $("#renewpass").val("");

                    let responseParts = response.split(":");
                    if (responseParts.length === 2) {
                        let status = responseParts[0].trim();
                        let message = responseParts[1].trim();
                        if (status === "success") {
                            showToaster(message, "green");
                        } else {
                            showToaster(message, "red");
                        }
                    } else {
                        showToaster("Invalid response from the server. Please try again.", "orange");
                    }
                },
                error: function() {
                    showToaster("An error occurred during the AJAX request", "red");
                }
            });

        });
    });
</script>

<script>
    $("#toggle-password").click(function() {
        const passwordInput = $(".cgshowpass");
        const icon = $(this);

        if (passwordInput.attr("type") === "password") {
            passwordInput.attr("type", "text");
            icon.removeClass("bx-hide").addClass("bx-show");

            setTimeout(function() {
                passwordInput.attr("type", "password");
                icon.removeClass("bx-show").addClass("bx-hide");
            }, 3000);
        }
    });
</script>