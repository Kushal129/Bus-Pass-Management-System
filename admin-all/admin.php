<?php
session_start();

include_once '../connection.php';

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
    $full_name = $row['full_name'];
    $role = $row['role'];

    if ($role) {
        header("Location:../user/user.php");
        exit;
    }
}


$sql = "SELECT COUNT(*) as pass_count FROM pass";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pass_count = $row['pass_count'];
} else {
    $pass_count = 0;
}

$todayDate = date('Y-m-d');
$sql = "SELECT COUNT(*) as today_pass_count FROM pass WHERE DATE(from_date) = '$todayDate'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $today_pass_count = $row['today_pass_count'];
} else {
    $today_pass_count = 0;
}

$todayDate = date('Y-m-d');
$sevenDaysAgo = date('Y-m-d', strtotime('-7 days'));

$sql = "SELECT COUNT(*) as last_7_days_pass_count FROM pass WHERE DATE(from_date) BETWEEN '$sevenDaysAgo' AND '$todayDate'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_7_days_pass_count = $row['last_7_days_pass_count'];
} else {
    $last_7_days_pass_count = 0;
}


$sql = "SELECT COUNT(*) as std_pass_count FROM student";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $std_pass_count = $row['std_pass_count'];
} else {
    $std_pass_count = 0;
}

$sql = "SELECT COUNT(*) as psg_pass_count FROM passenger";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $psg_pass_count = $row['psg_pass_count'];
} else {
    $psg_pass_count = 0;
}

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Admin Page </title>
    <link rel="stylesheet" href="../css/admin.css">
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
                <a href="../admin-all/admin.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="../admin-all/Passes.php">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">Passes</span>
                </a>
                <span class="tooltip">Passes</span>
            </li>
            <li>
                <a href="../admin-all/Search.php">
                    <i class='bx bx-search'></i>
                    <span class="links_name">Search</span>
                </a>
                <span class="tooltip">Search</span>
            </li>
            <li>
                <a href="../admin-all/Report.php">
                    <i class='bx bx-bar-chart-square'></i>
                    <span class="links_name">Report of Pass</span>
                </a>
                <span class="tooltip">Report of Pass</span>
            </li>
        </ul>
    </div>

    <section class="home-section">
        <div class="head">
            <div class="profile">
                <img src="../img/admin.ico" class="pro-img" id="user-avatar" alt="User Avatar">
                <div class="profile-text"><?php echo $full_name ?></div>
            </div>
            <button class="logout-btn" id="logout-btn" onclick="logout()">Logout</button>
        </div>
        <div class="container">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Total Pass</h5>
                    <p><?php echo $pass_count; ?></p>
                    <i><img src="../img/pass.gif" alt="" style="width: 25px;"></i>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Pass Created Today</h5>
                    <p><?php echo $today_pass_count; ?></p>
                    <i><img src="../img/pass.gif" alt="" style="width: 25px;"></i>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Pass Created in 7 Days</h5>
                    <p><?php echo $last_7_days_pass_count; ?></p>
                    <i><img src="../img/pass.gif" alt="" style="width: 25px;"></i>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card" id="totalPassCard">
                <div class="card-body">
                    <h5 class="card-title">Total Student Pass</h5>
                    <p><?php echo $std_pass_count; ?></p>
                    <i><img src="../img/pass.gif" alt="" style="width: 25px;"></i>
                </div>
            </div>
            <div class="card" id="passengerPassCard">
                <div class="card-body">
                    <h5 class="card-title">Total Passenger Pass</h5>
                    <p><?php echo $psg_pass_count; ?></p>
                    <i class='bx bx-message-square-edit'></i>
                </div>
            </div </div>
    </section>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let searchBtn = document.querySelector(".bx-search");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange();
        });

        searchBtn.addEventListener("click", () => {
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
</body>

</html>