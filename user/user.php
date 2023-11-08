<?php
session_start();

include_once '../connection.php';

if (!isset($_SESSION['username'])) {
    header('location:../index.php');
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
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bus Pass | User</title>
    <link rel="stylesheet" href="../css/user.css">
    <link rel="icon" type="image/ico" href="../img/buslogo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<style>
    .category {
        width: 100%;
        background: #fffef3 !important;
        border: 1px solid black;
        padding: 10px;
        border-radius: 10px;
    }

    .card-body {
        background-color: beige !important;
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
                <img class="pro-img" id="user-avatar" alt="User Avatar" src="../uploads/user_photo/<?php echo $use_img; ?>">
                <div class="profile-text"><?php echo $row['full_name']; ?></div>
            </div>

            <button class="logout-btn" id="logout-btn" onclick="logout()">Logout</button>
        </div>
        <section class="my-5">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="card" id="new_pass">
                            <div class="card-body text-center">
                                <h5 class="card-title">Generate New Pass</h5>
                                <i class='bx bx-user'></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="card" id="renew_pass" onclick="redirectToRenewPass()">
                            <div class="card-body text-center">
                                <h5 class="card-title">Re-New Pass</h5>
                                <i class='bx bx-user'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="downpage d-flex justify-content-center" id="downpage" style="display: none;">
            <div class="Category-down col-lg-4 col-md-4 col-sm-12" style="display: none;">
                <div class="card card-body text-center">
                    <select name="category" id="category" class="category">
                        <option value="">Select</option>
                        <option value="Student">Student</option>
                        <option value="Passenger">Passenger</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="down-container">
        </div>

    </section>
    <script>
        function redirectToRenewPass() {
            window.location.href = '../user/renewpass.php';
        }
        $(document).ready(function() {
            $("#new_pass").click(function() {
                $(".downpage").toggle();
                $(".Category-down").toggle();

                if ($(".downpage").is(":visible")) {
                    $("#category").val("");
                    $(".down-container").empty();
                }
            });

            $("#category").change(function() {
                var selectedCategory = $(this).val();

                if (selectedCategory === "Student") {
                    $(".down-container").load("../user/student.php");

                } else {
                    $(".down-container").empty();
                }
                if (selectedCategory === "Passenger") {
                    $(".down-container").load("../user/passanger.php");
                } else {
                    $(".down-container").empty();
                }
                if (selectedCategory === "Handicap") {
                    $(".down-container").load("../user/handicap.php");
                } else {
                    $(".down-container").empty();
                }
            });

        });
    </script>

    <script>
        $(document).ready(function() {
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

            function logout() {
                window.location.href = '../logout.php';
            }

            document.getElementById('logout-btn').addEventListener('click', logout);
        });
    </script>

    <script>
        function redirectToPayment() {
            window.location.href = "../main/payment.php";
        }
    </script>

</body>

</html>