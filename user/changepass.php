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
    $use_img = $row['user_img_path'];
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
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box !important;
    }

    .form-group {
        align-items: center !important;
        margin-bottom: 20px !important;
        margin: 0rem !important;
        padding: 2rem !important;
        background-color: #ffffff !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
        transition: transform 0.3s, box-shadow 0.5s !important;
    }

    .btn-cg {
        background-color: black;
        color: white;
        width: 100%;
        padding: 8px;
    }

    .toggle-password {
        cursor: pointer;
        display: flex !important;
        justify-content: end !important;
        margin-top: 10px !important;
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
                <!-- <img src="" class="pro-img" id="user-avatar" alt="User Avatar"> -->
                <img class="pro-img" id="user-avatar" alt="User Avatar" src="../uploads/user_photo/<?php echo $use_img; ?>">


                <div class="profile-text"><?php echo $row['full_name']; ?></div>
            </div>
            <button class="logout-btn" id="logout-btn" onclick="logout()">Logout</button>
        </div>
        <form method="POST" id="password-form">
            <section class="my-5">
                <div class="py-5">
                    <h2 class="text-center">Change Password</h2>
                </div>
                <div class="w-50 m-auto">
                    <form action="userinfo.php" method="post">
                        <div class="form-group" class="col-lg-4 col-md-4 col-12">
                            <label for="new-pass">Enter New Password</label>
                            <input type="password" class="form-control cgshowpass" name="newpass" id="newpass" autocomplete="off" required>

                            <label for="renew-pass">Re-Enter New Password</label>
                            <input type="password" class="form-control cgshowpass" name="renewpass" id="renewpass" autocomplete="off" required>
                            <i class="bx bx-hide toggle-password" id="toggle-password" style="cursor: pointer;"></i><br>
                            <span id="renewpass-error" class="error" style="color: red;"></span>
                            <button type="submit" class="btn-cg" value="Update Password">Update Password</button>
                        </div>
                    </form>
                </div>
            </section>
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