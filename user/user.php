<?php
session_start();

include_once 'connection.php';

if (!isset($_SESSION['username'])) {
    // echo "usename not found";
    header('location:index.php');
} else {
    $checkEmailQuery = "SELECT * FROM users WHERE email=?";
    $stmt = $con->prepare($checkEmailQuery);
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $role = $row['role'];
    // echo $role;
    // 1 - user and 0 - admin
    if (!$role) {
        header("Location: admin.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/ico" href="img/buslogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">

    <title>Admin Page</title>
</head>

<body>
    <div id="mySidenav" class="sidenav">
        <!-- side nav -->
        <p class="logo"><span>Bus Pass</span></p>
        <a href="admin.php" class="icon-a"><i class="fa fa-dashboard icons"></i>&nbsp;&nbsp;Genrate Pass </a>
        <a href="Passenger.php" class="icon-a"><i class="fa fa-users icons"></i>&nbsp;&nbsp;Manage Pass </a>
        <a href="Passes.php" class="icon-a"><i class="fa fa-list icons"></i>&nbsp;&nbsp;Manage Profile </a>
        <a href="Category.php" class="icon-a"><i class="fa fa-bar-chart-o fa-fw icons"></i>&nbsp;&nbsp;Reports </a>
    </div>
    <button class="navbar-toggler" type="button" onclick="toggleNav()">
        <span class="navbar-toggler-icon">&#9776;</span>
    </button>

    <div class="main-content">
        <div class="head">
            <div class="col-div-6">
                <div class="profile">
                    <p class="profile-text">   AAAya User nu name   </p>
                    <img src=" USER NI IMAGE " class="pro-img" id="user-avatar" alt="User Avatar">
                </div>
            </div>
            <div class="d-flex w-100 justify-content-end">
                <button class="" id="logout-btn" onclick="logout()">Logout</button>
            </div>

            
            <div class="clearfix"></div>
        </div>
        <div class="dashboard">
            <div class="col-div-3">
                <div class="box">
                    <p> 60<br /><span>New Pass</span></p>
                    <i class="fa fa-users box-icon"></i>
                </div>
            </div>
            <div class="col-div-3">
                <div class="box">
                    <p> 60<br /><span>Re-New Pass</span></p>
                    <i class="fa fa-users box-icon"></i>
                </div>
            </div>
        </div>


    <!-- JavaScript to handle the toggle behavior -->
    <script>
        function toggleNav() {
            var sidenav = document.getElementById("mySidenav");
            var mainContent = document.querySelector(".main-content");
            
            if (sidenav.style.width === "300px") {
                sidenav.style.width = "0";
                mainContent.style.marginLeft = "0";
            } else {
                sidenav.style.width = "300px";
                mainContent.style.marginLeft = "300px";
            }
        }

        // Close the side navigation when clicking outside the dashboard area
        document.addEventListener("click", function(event) {
            var sidenav = document.getElementById("mySidenav");
            var mainContent = document.querySelector(".main-content");
            if (window.innerWidth <= 757 && window.innerHeight <= 675) {
                if (!sidenav.contains(event.target) && !mainContent.contains(event.target)) {
                    sidenav.style.width = "0";
                }
            }
        });

        // Handle toggle behavior on page load and window resize
        window.addEventListener("load", toggleNav);
        window.addEventListener("resize", toggleNav);
    </script>
    <script>
        // Function to handle logout
        function logout() {
            // You can add any additional logic here before redirecting to the logout page

            // var logoutConfirmed = confirm("Are you sure you want to log out?");
            // if (logoutConfirmed) {
            // Redirect to the logout page or any other appropriate page after logout
            // For this example, we will redirect to logout.html
            window.location.href = 'logout.php';
            // }
        }

        // Event listener for the logout button
        document.getElementById('logout-btn').addEventListener('click', logout);
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>