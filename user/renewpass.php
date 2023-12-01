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

        <div class="container">
            <div class="row justify-content-center">
                <div class="card">
                    <div class="card-body text-center" style="padding: 15px;">
                        <h5 class="card-title" style="text-align: center;">RE-NEW PASS</h5>
                        <p>pass id ( data fetch )</p>
                        <p>locaiton s e</p>
                        <p> pass 30 / 90</p>
                        <p>bus_type</p>
                    </div>
                </div>
            </div>
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
            <!-- php for chack  -->
            adasdasdasd
        </div>
    </section>

    <!-- <script>
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
    </script> -->

    <script>
        $(document).ready(function() {

            $("#findpassid").on("click", function() {
                var selectedCategory = $("#category_renew").val();
                var passId = $("#passid").val();

                if (selectedCategory !== "" && passId !== "") {
                    if (selectedCategory === 'Student') {
                        console.log(11111);
                        $(".down-findpass").load("../main/renewstd.php" , {
                            passId : passId
                        } , function(res){
                            $(document).find('.down-findpass').show();
                            // $(document).find('.down-findpass').html(res);
                        });

                        // window.location.href = "../main/renewstd.php";
                    } else if (selectedCategory === 'Passenger') {
                        $(".down-findpass").load("../main/renewpsg.php", {
                            passid: passId
                        }, function(res){
                            $(document).find('.down-findpass').show();
                        });
                    }
                } else {
                    alert("Please select a category and enter a Pass ID.");
                }
            });
        });
    </script>

    <!-- <script>
        document.getElementById('findpassid').addEventListener('click', function() {
            // Get the pass ID entered by the user
            var passId = document.getElementById('passid').value;

            // Check the pass ID in the database (you need to implement this part)
            var passIdFound = checkPassIdInDatabase(passId);

            // Show or hide the 'down-findpass' based on the result
            var downContainer = document.querySelector('.down-findpass');

            if (passIdFound) {
                downContainer.style.display = 'block'; // Show the container
            } else {
                downContainer.style.display = 'none'; // Hide the container
                alert('Pass ID not found'); // Display an error message
            }
        });

        // Simulate checking the pass ID in the database
        function checkPassIdInDatabase(passId) {
            // Replace this with your database query logic
            // Return true if pass ID is found, false otherwise
            return passId === '10'; // Example check for a pass ID '12345'
        }
    </script> -->
</body>

</html>