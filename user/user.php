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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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

            <button class="logout-btn" id="logout-btn" onclick="logout()">Logout</button>
        </div>
        <div class="cards">
            <!-- Generate New Pass Card -->
            <div class="card" id="new_pass">
                <div class="card-body">
                    <h5 class="card-title">Generate New Pass</h5>
                    <i class='bx bx-user'></i>
                </div>
            </div>

            <!-- Re-New Pass Card -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Re-New Pass</h5>
                    <i class='bx bx-user'></i>
                </div>
            </div>
        </div>

        <!-- Pass Page -->
        <div class="pass-page-container" style="display: none;">
            <div class="Pass-Page">
                <span>Select Pass Category</span>
                <select name="category" id="category">
                    <option value="">Select</option>
                    <option value="Student">Student</option>
                    <option value="Passenger">Passenger</option>
                    <option value="Handicap">Handicap</option>
                </select>
            </div>
        </div>

        <div class="down-container">
            <div class="form" id="StudentForm" style="display: none;">
                <?php include '../user/student.php';
                ?>

            </div>
            <!-- Passenger Form -->
            <div class="form" id="PassengerForm" style="display: none;">
                <?php include '../user/passanger.php'; ?>
            </div>

            <!-- Handicap Form -->
            <div class="form" id="HandicapForm" style="display: none;">
                <?php include '../user/handicap.php'; ?>
            </div>
        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(document).ready(function() {
            $('.form').hide();

            function showForm(selectedCategory) {
                $('#' + selectedCategory + 'Form').show();
            }

            $('#new_pass').click(function() {
                $('.pass-page-container').show();

                var selectedCategory = $('#categorySelect option:first').val();
                console.log("Selected Category:", selectedCategory);

                showForm(selectedCategory);
            });

            $('#categorySelect').change(function() {
                var selectedCategory = $(this).val();
                console.log("Selected Category:", selectedCategory);
                $('.form').hide();

                showForm(selectedCategory);
                console.log("Displaying Form:", $('#' + selectedCategory + 'Form'));
            });

            var defaultCategory = $('#categorySelect').val();
            showForm(defaultCategory);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.form').hide();

            $('#categorySelect').change(function() {
                var selectedCategory = $(this).val();
                console.log("Selected Category:", selectedCategory);

                $('.form').hide();

                $('#' + selectedCategory + 'Form').show();
                console.log("Displaying Form:", $('#' + selectedCategory + 'Form'));
            });

            // Toggle sidebar
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
        $(function() {
            var placesInGujarat = [
                "Ahmedabad",
                "Vadodara",
                "Surat",

            ];

            $(".fromPlace, .toPlace").autocomplete({
                source: placesInGujarat,
                minLength: 1,
            });
        });
    </script>

    <script>
        $(document).on('change', "#dateofBirth", function() {
            var date = $(document).find("#dateofBirth").val();
            var dob = new Date(date);

            var today = new Date();
            var diff = today.getTime() - dob.getTime();
            var age = Math.floor(diff / (1000 * 60 * 60 * 24 * 365));

            $(document).find("#age").val(age);
            console.log(age);
        });

        updateToDate();

        function updateToDate() {
            var passType = $('#passType').val();
            var fromDate = $("#fromDate").val();

            if (passType === "--" || fromDate === "") {
                return;
            }

            var fromDateObj = new Date(fromDate);
            var toDateObj = new Date(fromDateObj);

            if (passType === "30") {
                toDateObj.setDate(toDateObj.getDate() + 30);
            } else if (passType === "90") {
                toDateObj.setDate(toDateObj.getDate() + 90);
            }

            var year = toDateObj.getFullYear();
            var month = String(toDateObj.getMonth() + 1).padStart(2, '0');
            var day = String(toDateObj.getDate()).padStart(2, '0');

            var toDate = year + '-' + month + '-' + day;

            $(document).find("#toDate").val(toDate);
        }

        $(document).on('change', "#fromDate", function() {
            updateToDate();
        });

        $(document).on('change', "#passType", function() {
            updateToDate();
        });
    </script>


    <script>
        $('input[name="have_disability_cert"]').on('change', function() {
            var disabilityCertField = $('.disabilitycert');
            if ($(this).val() === "1") {
                disabilityCertField.show();
            } else {
                disabilityCertField.hide();
            }
        });
    </script>

    <script>
        var checkboxes = document.querySelectorAll('input[name="disability_area[]"]');
        var selectedData = document.getElementById('selectedData');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                updateSelectedData();
            });
        });

        function updateSelectedData() {
            var selectedValues = [];
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    selectedValues.push(checkbox.value);
                }
            });
            selectedData.value = selectedValues.join(', ');
        }
    </script>

    <script>
        function redirectToPayment() {
            window.location.href = "../main/payment.php";
        }
    </script>

</body>

</html>