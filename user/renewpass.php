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
            <select name="category" id="category" class="category">
                <option value="">Select</option>
                <option value="Student">Student</option>
                <option value="Passenger">Passenger</option>
            </select>
            <br><br>
            <label for="passid">Pass ID:</label>
            <input type="text" id="passid" name="passid" placeholder="Enter Pass Id">
            <button class="btn-pmt" type="button" id="findpassid" style="margin-top: 1rem;">Submit</button>
        </div>

        <div class="down-findpass down-container" style="display: none;">
            <form action="../main/passformate.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="Entry_date">Entry Date:</label>
                    <input type="date" name="Entry_date" value="<?php echo date('Y-m-d') ?>" readonly style="cursor: not-allowed;background-color:#efefef;color: #000000;">
                    <br><br>
                    <label for="validate_through">Validate Through:</label>
                    <input type="date" id="validate_through" readonly value="<?php echo date('Y-m-d', strtotime('+6 months')) ?>" name="validate_through" readonly style="cursor: not-allowed;background-color:#efefef;color: #000000;">
                    <br><br>
                </div>


                <div class="form-group">
                    <h1>Personal Details</h1>
                    <hr>
                    <label for="fullname">Full Name:</label>
                    <input type="text" id="fullname" name="fullname" required>
                    <span id="fullname-error" class="error-message" style="color:red"></span>
                    <br><br>

                    <label for="mobileNo">Phone Number:</label>
                    <input type="text" name="mobileNo" id="mobileNo" maxlength="10" value="" required>
                    <span id="mobileNo-error" class="error-message" style="color:red"></span>
                    <br><br>

                    <label for="address">Address:</label>
                    <textarea name="address" id="address" cols="20" rows="3" required></textarea>
                    <span id="address-error" class="error-message" style="color:red"></span>
                    <br><br>

                    <label for="dateofBirth">Date of Birth:</label>
                    <input type="date" name="dateofBirth" id="dateofBirth" required>
                    <span id="dateofBirth-error" class="error-message" style="color:red"></span>
                    <br><br>

                    <label for="age_std">Age:</label>
                    <input type="text" id="age_std" name="age_std" value="" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">
                    <span id="age_std-error" class="error-message" style="color:red"></span>
                    <br><br>

                    <label>Gender:</label>
                    <input type="radio" name="gender" value="Male" checked="checked" required>
                    <span class="bodytext">Male</span>
                    <input type="radio" name="gender" value="Female">
                    <span class="bodh2ytext">Female</span>
                    <input type="radio" name="gender" value="Other">
                    <span class="bodytext">Other</span>
                    <span id="gender-error" class="error-message" style="color:red"></span>
                    <br><br>

                    <label for="education">Education:</label>
                    <select name="education" id="education" required>
                        <option value="--">Please Select Highest Qualification</option>
                        <option value="Primary">Primary</option>
                        <option value="Middle/Higher Primary">Middle/Higher Primary</option>
                        <option value="Senior Secondary">Senior Secondary</option>
                        <option value="Higher Secondary">Higher Secondary</option>
                        <option value="Diploma">Diploma</option>
                        <option value="Graduate">Graduate</option>
                        <option value="PG Diploma">PG Diploma</option>
                        <option value="Post Graduate">Post Graduate</option>
                        <option value="Doctorate">Doctorate</option>
                        <option value="Illiterate">Illiterate</option>
                    </select>
                    <span id="education-error" class="error-message" style="color:red"></span>
                    <br><br>

                    <label for="institute_name">Institute Name:</label>
                    <input type="text" id="institute_name" name="institute_name" required>
                    <span id="institute_name-error" class="error-message" style="color:red"></span>
                    <br><br>

                    <label for="institute_address">Institute Address:</label>
                    <textarea name="institute_address" id="institute_address" cols="20" rows="3" required></textarea>
                    <span id="institute_address-error" class="error-message" style="color:red"></span>
                    <br><br>
                </div>

                <div class="form-group">
                    <h1>Proof Details</h1>
                    <hr>
                    <label for="img_std">Photo Upload:</label>
                    <input type="file" name="img_std" id="img_std" accept=".png, .jpg, .jpeg" required>
                    <p>[Self-attached Passport size Photo Copy. Max size: 300KB]</p>
                    <span id="photo_error" class="error-message" style="color: red;"></span>
                    <br>
                    <label for="verification">Upload Document For Verification:</label>
                    <input type="file" name="verification" id="verification" accept=".png, .jpg, .jpeg" required>
                    <p>[Self-attached Passport size Photo Copy. Max size: 300KB]</p>
                    <span id="verification_error" class="error-message" style="color: red;"></span>
                    <br>
                </div>

                <div class="form-group">
                    <h1>Location Details</h1>
                    <hr>
                    <label for="passType">Pass Type:</label>
                    <select name="passType" id="passType" required>
                        <option value="30" selected>Monthly</option>
                        <option value="90">Quarterly</option>
                    </select>

                    <br><br>

                    <label for="fromDate">From Date:</label>
                    <input type="date" value="<?php echo date('Y-m-d') ?>" name="fromDate" id="fromDate">
                    <br><br>

                    <label for="toDate">To Date:</label>
                    <input type="date" name="toDate" id="toDate" style="cursor:not-allowed; background-color:#efefef; color:#000000;">
                    <br><br>

                    <div class="student-form">
                        <label for="fromPlaceStudent">From Place:</label>
                        <select name="fromPlaceStudent" id="fromPlaceStudent" class="fromPlace" required>
                            <option value=" ">Select From Location</option>
                            <?php
                            $from_qry_s  =  "SELECT * FROM bus_terminals";
                            $from_types_s = mysqli_query($con, $from_qry_s);
                            foreach ($from_types_s as $key => $from_t_s) {
                            ?>
                                <option value="<?php echo $from_t_s['ter_id'] ?>"><?php echo $from_t_s['ter_name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <span id="fromPlaceStudent-error" class="error-message" style="color: red;"></span>
                        <br><br>

                        <label for="toPlaceStudent">To Place:</label>
                        <select name="toPlaceStudent" id="toPlaceStudent" class="toPlace" required>
                            <option value=" ">Select To Location</option>
                            <?php
                            $from_qry_s  =  "SELECT * FROM bus_terminals";
                            $from_types_s = mysqli_query($con, $from_qry_s);
                            foreach ($from_types_s as $key => $from_t_s) {
                            ?>
                                <option value="<?php echo $from_t_s['ter_id'] ?>"><?php echo $from_t_s['ter_name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <span id="toPlaceStudent-error" class="error-message" style="color: red;"></span>
                    </div>
                    <br><br>

                    <label for="classOfService">Class Of Service:</label>
                    <select name="classOfService" id="classOfService" required>
                        <?php
                        $bus_type_qry_s  =  "SELECT * FROM bus_type ";
                        $bus_types_s = mysqli_query($con, $bus_type_qry_s);
                        foreach ($bus_types_s as $key => $bus_t_s) {
                        ?>
                            <option value="<?php echo $bus_t_s['price_multiply'] ?>"><?php echo $bus_t_s['bus_name'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <span id="classOfService-error" class="error-message" style="color: red;"></span>
                    <br><br>
                    <hr>
                </div>
                <div class="form-group">
                    <h2> Payment </h2>
                    <hr>
                    <input type="text" placeholder="Pay Amount.." id="pay-value" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">
                    <br>
                    <input type="text" placeholder="Payment ID " id="payment_id_lbl" readonly name="payment_id" style="cursor: not-allowed;background-color:#efefef;color: #000000;">

                    <br><br>
                    <div class="btn-paynow btn-pmt" id="paynow" onclick="pay_now()">Pay Now</div>
                    <button class="btn-pmt" type="submit" id="paymentButton">Submit and Proceed </button>
                </div>
            </form>
        </div>
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

        $(function() {
            var placesInGujarat = [
                "Ahmedabad",
                "Vadodara",
                "Surat",
                "Rajkot",
                "Gandhinagar",
                "Bhavnagar",
                "Jamnagar",
                "Junagadh",
                "Anand",
                "Bharuch",
                "Nadiad",
                "Mehsana",
                "Gandhidham",
                "Porbandar",
                "Navsari",
                "Veraval",
                "Ankleshwar",
                "Morbi",
                "Surendranagar",
                "Godhra",
                "Palanpur",
                "Valsad",
                "Bhuj",
                "Bardoli",
                "Vapi",
                "Amreli",
                "Himatnagar",
                "Dahod",
                "Botad",
                "Keshod",
                "Visnagar",
                "Mangrol",
                "Wadhwan",
                "Modasa",
                "Jetpur",
                "Dhoraji",
                "Kalol",
                "Dholka",
                "Dhandhuka",
                "Kadi",
                "Thangadh",
                "Unjha",
                "Siddhpur",
                "Mansa",
                "Limbdi",
                "Borsad",
                "Halvad",
                "Rajula",
                "Mahuva",
                "Kutch",
                "Palitana",
                "Kapadvanj",
                "Lunawada",
                "Viramgam",
                "Visavadar",
                "Wankaner",
                "Padra",
                "Dabhoi",
                "Buhari",
            ];

            $(".fromPlace, .toPlace").autocomplete({
                source: placesInGujarat,
                minLength: 1,
            });
        });

        $(".fromPlace, .toPlace").change(function() {
            calculatePassAmount();
        })

        function calculatePassAmount() {
            var from = $('.fromPlace').val();
            var to = $('.toPlace').val();


            if (from != '' && to != '' && from != to) {
                $.ajax({
                    type: 'post',
                    url: 'get_geo_loc.php',
                    dataType: 'json',
                    data: {
                        from: from,
                        to: to,
                    },
                    success: function(res) {
                        rs = 0;
                        console.log(calculateDistance(res[0].lati, res[0].long, res[1].lati, res[1].long));
                        distance = Math.ceil(calculateDistance(res[0].lati, res[0].long, res[1].lati, res[1].long));
                        rs = distance * <?php echo $price ?>;
                        var multipy = $('#classOfService').val();
                        var passType = $('#passType').val();

                        if (passType === "30") {
                            rs = distance * <?php echo $price ?> * multipy;
                        } else if (passType === "90") {
                            rs = distance * <?php echo $price ?> * multipy * 3;
                        }

                        $("#pay-value").val(Math.ceil(rs) + " Rs/-");
                    }
                })
            } else {
                $("#pay-value").val(0 + " Rs/-");
            }

        }

        $('#classOfService').change(function() {
            calculatePassAmount();
        })
        $('#passType').change(function() {
            calculatePassAmount();
        })

        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371;
            const dLat = (lat2 - lat1) * (Math.PI / 180);
            const dLon = (lon2 - lon1) * (Math.PI / 180);
            const a =
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * (Math.PI / 180)) *
                Math.cos(lat2 * (Math.PI / 180)) *
                Math.sin(dLon / 2) *
                Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            const distance = R * c;
            return distance;
        }

        $(document).on('change', "#dateofBirth", function() {
            var date = $(document).find("#dateofBirth").val();
            var dob = new Date(date);

            var today = new Date();
            var diff = today.getTime() - dob.getTime();
            var age = Math.floor(diff / (1000 * 60 * 60 * 24 * 365));

            $(document).find("#age_std").val(age);
            console.log(age);
        });

        updateToDate();

        function updateToDate() {
            var passType = $('#passType').val();
            var fromDate = $("#fromDate").val();

            if (passType === "--" || fromDate === " ") {
                return;
            }

            var fromDateObj = new Date(fromDate);
            var toDate_sObj = new Date(fromDateObj);

            if (passType === "30") {
                toDate_sObj.setDate(toDate_sObj.getDate() + 30);
            } else if (passType === "90") {
                toDate_sObj.setDate(toDate_sObj.getDate() + 90);
            }

            var year = toDate_sObj.getFullYear();
            var month = String(toDate_sObj.getMonth() + 1).padStart(2, '0');
            var day = String(toDate_sObj.getDate()).padStart(2, '0');

            var toDate_s = year + '-' + month + '-' + day;

            $(document).find("#toDate").val(toDate_s);
        }

        $(document).on('change', "#fromDate", function() {
            updateToDate();
        });

        $(document).on('change', "#passType", function() {
            updateToDate();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#paymentButton').hide();
            $('#payment_id_lbl').hide();

            function validateForm() {
                let isValid = true;

                function showError(fieldId, errorMessage) {
                    const errorSpan = $(fieldId + '-error');
                    errorSpan.text(errorMessage);
                    errorSpan.show();
                    isValid = false;
                }

                function clearError(fieldId) {
                    const errorSpan = $(fieldId + '-error');
                    errorSpan.text('');
                    errorSpan.hide();
                }


                const educationValue = $('#education').val();
                if (educationValue === '--') {
                    showError('#education', 'Education is required.');
                } else {
                    clearError('#education');
                }

                const instituteNameValue = $('#institute_name').val();
                if (instituteNameValue === '') {
                    showError('#institute_name', 'Institute Name is required.');
                } else {
                    clearError('#institute_name');
                }

                const instituteAddressValue = $('#institute_address').val();
                if (instituteAddressValue === '') {
                    showError('#institute_address', 'Institute Address is required.');
                } else {
                    clearError('#institute_address');
                }

                const studentimgValue = $('#img_std').val();
                if (studentimgValue === '') {
                    showError('#photo_error', 'Please upload a proof for address.');
                } else {
                    clearError('#photo_error');
                }

                const addressProofValue = $('#verification').val();
                if (addressProofValue === '--') {
                    showError('#verification_error', 'Please select a Document for Address Proof.');
                } else {
                    clearError('#verification_error');
                }


                const fromPlaceStudentValue = $('#fromPlaceStudent').val();
                if (fromPlaceStudentValue === '' || fromPlaceStudentValue === ' ') {
                    showError('#fromPlaceStudent', 'Please select a From Place.');
                } else {
                    clearError('#fromPlaceStudent');
                }

                const toPlaceStudentValue = $('#toPlaceStudent').val();
                if (toPlaceStudentValue === '' || toPlaceStudentValue === ' ') {
                    showError('#toPlaceStudent', 'Please select a To Place.');
                } else {
                    clearError('#toPlaceStudent');
                }

                if (!isValid) {
                    alert('Please fill in all required fields and correct any errors.');
                }
                return isValid;
            }

            window.pay_now = function() {
                if (validateForm()) {
                    var amtWithSuffix = $('#pay-value').val();
                    var amt = parseInt(amtWithSuffix.match(/\d+/)[0], 10);
                    console.log(amt);

                    var options = {
                        "key": "rzp_test_qScTznNfxHjAQP",
                        "amount": amt * 100,
                        "currency": "INR",
                        "name": "BUS PASS ",
                        "description": "Your Pass Payment ",
                        "image": "../img/buslogo.png",

                        "handler": function(response) {
                            console.log(response.razorpay_payment_id);
                            if (response.razorpay_payment_id) {

                                $('#paynow').hide();
                                $('#payment_id_lbl').val(response.razorpay_payment_id);
                                $('#paymentButton').show();

                            }
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                }
            };
        });
    </script>
    <script>
        $(document).ready(function() {
            const imgStdInput = $('#img_std');
            const photoErrorElement = $('#photo_error');

            imgStdInput.on('change', function() {
                const file = this.files[0];

                if (file) {
                    const allowedFormats = ['image/png', 'image/jpeg', 'image/jpg'];
                    const maxFileSize = 300 * 1024;
                    const minFileSize = 50 * 1024;

                    if (!allowedFormats.includes(file.type)) {
                        displayError(photoErrorElement, 'Please upload an image in PNG, JPG, or JPEG format.');
                        imgStdInput.val('');
                    } else if (file.size < minFileSize) {
                        displayError(photoErrorElement, 'Please upload an image that is at least 50KB in size.');
                        imgStdInput.val('');
                    } else if (file.size > maxFileSize) {
                        displayError(photoErrorElement, 'Please upload an image that is no more than 300KB in size.');
                        imgStdInput.val('');
                    } else {
                        clearError(photoErrorElement);
                    }

                } else {
                    clearError(photoErrorElement);
                }
            });
        });

        $(document).ready(function() {
            const addressProofInput = $('#verification');
            const addressProofErrorElement = $('#verification_error');

            addressProofInput.on('change', function() {
                const file = this.files[0];

                if (file) {
                    const allowedFormats = ['application/pdf', 'image/jpg', 'image/jpeg', 'image/png'];
                    const maxFileSize = 200 * 1024;
                    const minFileSize = 20 * 1024;

                    if (!allowedFormats.includes(file.type)) {
                        displayError(addressProofErrorElement, 'Please upload a PDF, JPG, JPEG, or PNG file.');
                        addressProofInput.val('');
                    } else if (file.size < minFileSize) {
                        displayError(photoErrorElement, 'Please upload an image that is at least 50KB in size.');
                        imgStdInput.val('');
                    } else if (file.size > maxFileSize) {
                        displayError(addressProofErrorElement, 'Please upload a file that is no more than 200KB in size.');
                        addressProofInput.val('');
                    } else {
                        clearError(addressProofErrorElement);
                    }
                } else {
                    clearError(addressProofErrorElement);
                }
            });
        });

        function displayError(element, message) {
            element.text(message);
        }

        function clearError(element) {
            element.text('');
        }
    </script>

    <script>
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
            return passId === '12345'; // Example check for a pass ID '12345'
        }
    </script>
</body>

</html>