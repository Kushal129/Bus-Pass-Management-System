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
        <a href="#" class="icon-a"><i class="fa fa-dashboard icons"></i>&nbsp;&nbsp;Dashboard</a>
        <a href="#" class="icon-a"><i class="fa fa-users icons"></i>&nbsp;&nbsp;Passenger</a>
        <a href="#" class="icon-a"><i class="fa fa-list icons"></i>&nbsp;&nbsp;Passes</a>
        <a href="#" class="icon-a"><i class="fa fa-bar-chart-o fa-fw icons"></i>&nbsp;&nbsp;Category</a>
        <a href="#" class="icon-a"><i class="fa fa-search icons"></i>&nbsp;&nbsp;Search</a>
        <a href="#" class="icon-a"><i class="fa fa-folder icons"></i>&nbsp;&nbsp;Report of Pass</a>
    </div>

    <button class="navbar-toggler" type="button" onclick="toggleNav()">
        <span class="navbar-toggler-icon">&#9776;</span>
    </button>

    <div class="main-content">
        <div class="head">
            <div class="col-div-6">
                <div class="profile">
                    <p class="profile-text">Admin <span class="user-role" id="user-role">Administrator</span></p>
                    <img src="img/admin.ico" class="pro-img" id="user-avatar" alt="User Avatar">
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
                    <p> 60<br /><span>Total Pass</span></p>
                    <i class="fa fa-users box-icon"></i>
                </div>
            </div>
            <div class="col-div-3">
                <div class="box">
                    <p> 60<br /><span>Total Category</span></p>
                    <i class="fa fa-users box-icon"></i>
                </div>
            </div>
            <div class="col-div-3">
                <div class="box">
                    <p> 60<br /><span>Pass Created Today</span></p>
                    <i class="fa fa-users box-icon"></i>
                </div>
            </div>
            <div class="col-div-3">
                <div class="box">
                    <p> 60<br /><span>Pass Created in 7 Days</span></p>
                    <i class="fa fa-users box-icon"></i>
                </div>
            </div>
        </div>

        <!-- Passenger Management Section -->
        <section class="passenger">
            <h2>Passenger Management</h2>
            <div class="passenger-list">
                <ul>
                    <li>Passenger 1</li>
                    <li>Passenger 2</li>
                    <li>Passenger 3</li>
                    <!-- Add more passengers as needed -->
                </ul>
            </div>
            <div class="add-passenger">
                <h3>Add New Passenger</h3>
                <form>
                    <label for="passenger-name">Passenger Name:</label>
                    <input type="text" id="passenger-name" name="passenger-name">
                    <button type="submit">Add</button>
                </form>
            </div>
        </section>

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

        <!-- Category Management Section -->
        <section class="category">
            <h2>Category Management</h2>
            <div class="category-list">
                <ul>
                    <li>Category 1</li>
                    <li>Category 2</li>
                    <li>Category 3</li>
                    <!-- Add more categories as needed -->
                </ul>
            </div>
            <div class="add-category">
                <h3>Add New Category</h3>
                <form>
                    <label for="category-name">Category Name:</label>
                    <input type="text" id="category-name" name="category-name">
                    <button type="submit">Add</button>
                </form>
            </div>
        </section>

        <!-- Search Section -->
        <section class="search">
            <h2>Search</h2>
            <div class="search-form">
                <form>
                    <label for="search-passenger">Search Passenger:</label>
                    <input type="text" id="search-passenger" name="search-passenger">
                    <button type="submit">Search</button>
                </form>
            </div>
        </section>

        <!-- Report Section -->
        <section class="report">
            <h2>Report of Pass</h2>
            <div class="report-table">
                <table>
                    <thead>
                        <tr>
                            <th>Passenger Name</th>
                            <th>Pass Type</th>
                            <th>Category</th>
                            <th>Validity</th>
                            <!-- Add more table headers as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Passenger 1</td>
                            <td>Monthly Pass</td>
                            <td>General</td>
                            <td>30 Days</td>
                            <!-- Add more table data rows as needed -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

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