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
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                    <i class='bx bx-edit'></i>
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
                <img src="../img/admin.ico" class="pro-img" id="user-avatar" alt="User Avatar">
                <div class="profile-text"><?php echo $row['full_name']; ?></div>
            </div>

            <select name="" id="">
                <option value="">New Pass </option>
                <option value="">ReNew Pass </option>
            </select>
            <button class="logout-btn" id="logout-btn" onclick="logout()">Logout</button>
        </div>
        <div class="cards">
            <!-- Generate New Pass Card -->
            <div class="card" style="width: 10rem;" id="new_pass">
                <div class="card-body">
                    <h5 class="card-title">Generate New Pass</h5>
                    <i class='bx bx-user'></i>
                </div>
            </div>

            <!-- Re-New Pass Card -->
            <div class="card" style="width: 10rem;">
                <div class="card-body">
                    <h5 class="card-title">Re-New Pass</h5>
                    <i class='bx bx-user'></i>
                </div>
            </div>
        </div>

        <!-- Pass Page -->
        <div class="Pass-Page" style="display: none;">
            <h1>Select Pass Category</h1>
            <select name="category" id="category">
                <option value="">Select</option>
                <option value="Student">Student</option>
                <option value="Passenger">Passenger</option>
                <option value="Handicap">Handicap</option>
            </select>
        </div>

        <div class="down-container">
            <div class="container">
                <!-- Student form -->
                <div class="form" id="StudentForm">
                    <h1>Student Pass Details</h1>
                    <form action="#" method="POST">
                        <!-- Application No -->
                        <div class="form-group">
                            <label for="id">Application No:</label>
                            <input type="text" disabled="disabled" id="id" name="id" style="cursor: not-allowed;" >

                            <br><br>
                        </div>

                        <!-- Entry Date, Pass Type, Validate Through -->
                        <div class="form-group">
                            <label for="entryDate">Entry Date:</label>aajni date 
                            <input type="date" name="dateofBirth" id="dateofBirth" placeholder="NEW PASS" disabled="disabled" style="cursor: not-allowed;" >
                            <br><br>
                            <label for="passType">Pass Type:</label>
                            <select name="passType">
                                <option value="--" selected="selected">--</option>
                                <option value="30">Monthly</option>
                                <option value="90">Quarterly</option>
                            </select>
                            <br><br>
                            <label for="validate_through">Validate Through:</label>by defot 6 motn
                            <input type="date" id="validate_through" name="validate_through" disabled="disabled" style="cursor: not-allowed;">

                            <br><br>
                        </div>

                        <hr>

                        <!-- Personal Details -->
                        <h1>Personal Details</h1>

                        <div class="form-group">
                            <label for="fullname">Full Name:</label>
                            <input type="text" id="fullname" name="fullname">

                            <br><br>

                            <label for="mobileNo">Phone Number:</label>
                            <input type="text" name="mobileNo" maxlength="13" value="">

                            <br><br>

                            <label for="address">Address:</label>
                            <textarea name="address" id="address" cols="20" rows="3"></textarea>



                            <br><br>
                            <label for="dateofBirth">Date of Birth:</label>
                            <input type="date" name="dateofBirth" id="dateofBirth">


                            <br><br>
                            <label for="age">Age:</label>
                            <input type="text" name="age" maxlength="6" value="">


                            <br><br>
                            <label>Gender:</label>
                            <input type="radio" name="gender" value="M" checked="checked">
                            <span class="bodytext">Male</span>
                            <input type="radio" name="gender" value="F">
                            <span class="bodytext">Female</span>
                            <input type="radio" name="gender" value="T">
                            <span class="bodytext">Transgender</span>

                            <br><br>

                            <label for="category1">Category:</label>
                            <select name="category1">
                                <option value="--" selected="selected">--</option>
                                <option value="1">General</option>
                                <option value="2">SCBC</option>
                                <option value="3">ST</option>
                                <option value="4">SC</option>
                            </select>

                            <br><br>

                            <label for="adhar_number">Adhar Number:</label>
                            <input type="text" id="adhar_number" name="adhar_number">


                            <br><br>
                            <label for="education">Education:</label>
                            <select name="education">
                                <option value="">Please Select Highest Qualification</option>
                                <option value="1">Primary</option>
                                <option value="2">Middle/Higher Primary</option>
                                <option value="3">Senior Secondary</option>
                                <option value="4">Higher Secondary</option>
                                <option value="5">Diploma</option>
                                <option value="6">Graduate</option>
                                <option value="7">PG Diploma</option>
                                <option value="8">Post Graduate</option>
                                <option value="9">Doctorate</option>
                                <option value="10">Illiterate</option>
                            </select>

                            <br><br>

                            <label for="photoDoc">Photo Upload:</label>
                            <input type="file" name="photoDoc" id="filename1">
                            <p>[Self-attached Passport size Photo Copy. Size less than 1 MB.]</p>


                            <br><br>
                        </div>

                        <hr>

                        <!-- Institute Details -->
                        <h1>Institute Details</h1>

                        <div class="form-group">
                            <label for="institute_name">Institute Name:</label>
                            <input type="text" id="institute_name" name="institute_name">


                            <br><br>
                            <label for="institute_address">Institute Address:</label>
                            <textarea name="institute_address" id="institute_address" cols="20" rows="3"></textarea>
                            <br><br>

                            <label for="fromDate">From Date:</label>
                            <input type="date" name="fromDate" id="fromDate">


                            <br><br>
                            <label for="toDate">To Date:</label>
                            <input type="date" name="toDate" id="toDate" disabled="disabled">


                            <br><br>
                            <label for="fromPlace">From Place:</label>
                            <input type="text" id="fromPlace" name="fromPlace" style="width: 260px;" placeholder="Select karse surat" autocomplete="off">


                            <br><br>
                            <label for="toPlace">To Place:</label>
                            <input type="text" id="toPlace" name="toPlace" style="width: 260px;" placeholder="Bardoli sudhi" autocomplete="off">


                            <br><br>
                            <label for="classOfService">Class Of Service:</label>
                            <select name="classOfService">
                                <option value="--" selected="selected">--</option>
                                <option value="1">LOCAL</option>
                                <option value="2">EXPRESS</option>
                                <option value="3">GURJARNAGRI</option>
                            </select>

                            <br><br>
                            <!-- Payment Page -->

                            <button class="btn-payment" id="paymentButton" type="button">Click to Pay</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#new_pass').click(function() {
                $('.Pass-Page').fadeIn();
            });

            $('#category').change(function() {
                var selectedCategory = $(this).val();
                $('.down-container .form').hide();
                $('#' + selectedCategory + 'Form').show();
            });

            // ----------------------------------------------------------------
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
</body>

</html>