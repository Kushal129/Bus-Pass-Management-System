<?php
session_start();

include_once 'connection.php';

if (!isset($_SESSION['username'])) {
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
    if ($role) {

        // echo "USER";
        header("Location: index.php");
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
        <a href="/admin-all/admin.php" class="icon-a"><i class="fa fa-dashboard icons"></i>&nbsp;&nbsp;Dashboard</a>
        <a href="/admin-all/Passenger.php" class="icon-a"><i class="fa fa-users icons"></i>&nbsp;&nbsp;Passenger</a>
        <a href="/admin-all/Passes.php" class="icon-a"><i class="fa fa-list icons"></i>&nbsp;&nbsp;Passes</a>
        <a href="/admin-all/Category.php" class="icon-a"><i class="fa fa-bar-chart-o fa-fw icons"></i>&nbsp;&nbsp;Category</a>
        <a href="/admin-all/Search.php" class="icon-a"><i class="fa fa-search icons"></i>&nbsp;&nbsp;Search</a>
        <a href="/admin-all/Report.php" class="icon-a"><i class="fa fa-folder icons"></i>&nbsp;&nbsp;Report of Pass</a>
    </div>

    <button class="navbar-toggler" type="button" onclick="toggleNav()">
        <span class="navbar-toggler-icon">&#9776;</span>
    </button>

    <div class="main-content">
    <div class="head">
            <div class="col-div-6">
                <div class="profile">
                <p class="profile-text">Admin</p>
                    <img src="img/admin.ico" class="pro-img" id="user-avatar" alt="User Avatar">
                </div>
            </div>
            <div class="d-flex w-100 justify-content-end">
                <button class="" id="logout-btn" onclick="logout()">Logout</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- Passes Management Section -->
        <section class="passes">
            <h2>Passes Management</h2>
            <div class="pass-list">
                <ul>
                    <li>Pass 1</li>
                    <li>Pass 2</li>
                    <li>Pass 3</li>
                    <!-- Add more passes as needed -->
                </ul>
            </div>
            <div class="add-pass">
                <h3>Add New Pass</h3>
                <form>
                    <label for="pass-name">Pass Name:</label>
                    <input type="text" id="pass-name" name="pass-name">
                    <button type="submit">Add</button>
                </form>
            </div>
        </section>

        

    <!-- JavaScript to handle the toggle behavior -->
    <script>
        function toggleNav() {
            var sidenav = document.getElementById("mySidenav");
            var navbarToggler = document.querySelector(".navbar-toggler");
            var mainContent = document.querySelector(".main-content");
            if (window.innerWidth <= 757 && window.innerHeight <= 675) {
                if (sidenav.style.width === "100%") {
                    sidenav.style.width = "0";
                    navbarToggler.classList.add("active");
                    mainContent.style.marginLeft = "0";
                } else {
                    sidenav.style.width = "100%";
                    navbarToggler.classList.remove("active");
                    mainContent.style.marginLeft = "100%";
                }
            } else {
                if (sidenav.style.width === "300px") {
                    sidenav.style.width = "0";
                    navbarToggler.classList.add("active");
                    mainContent.style.marginLeft = "0";
                } else {
                    sidenav.style.width = "300px";
                    navbarToggler.classList.remove("active");
                    mainContent.style.marginLeft = "300px";
                }
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
            // For example, show a confirmation dialog before logging out
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