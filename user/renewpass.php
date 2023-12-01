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
    <title>Bus Pass | Reports </title>
    <link rel="stylesheet" href="../css/user.css">
    <link rel="icon" type="image/ico" href="../img/buslogo.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

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
        <div class="form-group down-container">
            <h1>Re New Pass</h1>
            <hr>
            <select name="category_renew" id="category_renew" class="category_renew">
                <option value="none">Select</option>
                <option value="Student">Student</option>
                <option value="Passenger">Passenger</option>
            </select>
            <br><br>
            <label for="passid">Pass ID:</label>
            <input type="text" id="passid" name="passid" placeholder="Enter Pass Id" required>
            <button class="btn-pmt" type="button" id="findpassid" style="margin-top: 1rem;">Submit</button>
        </div>

        <div class="down-findpass down-container" style="display: none;">
        </div>
    </section>
    <script>
        $(document).ready(function() {

            $("#findpassid").on("click", function() {
                var selectedCategory = $("#category_renew").val();
                var passId = $("#passid").val();

                if (selectedCategory !== "" && passId !== "") {
                    if (selectedCategory === 'Student') {
                        $(".down-findpass").load("../main/renewstd.php" , {
                            passId : passId
                        } , function(res){
                            $(document).find('.down-findpass').show();
                        });
                    } else if (selectedCategory === 'Passenger') {
                        $(".down-findpass").load("../main/renewpsg.php", {
                            passId : passId
                        }, function(res){
                            $(document).find('.down-findpass').show();
                        });
                    }
                } else {
                    alert("Please select a category and enter a Pass ID.");
                    exit;
                }
            });
        });
    </script>
</body>

</html>