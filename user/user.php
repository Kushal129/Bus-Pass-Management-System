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
            <!-- Student form -->
            <div class="form" id="StudentForm" style="display: none;">
                <form action="#" method="POST">
                    <h1>Student Pass Details</h1>
                    <!-- Application No -->
                    <div class="form-group">
                        <label for="id">Application No:</label>
                        <input type="text" disabled id="id" name="id" style="cursor: not-allowed;background-color:#efefef;color: #000000;" placeholder="NEW PASS">
                        <br><br>
                    </div>

                    <!-- Entry Date, Pass Type, Validate Through -->
                    <div class="form-group">
                        <label for="entryDate">Entry Date:</label>
                        <input type="date" name="Entrydate" value="<?php echo date('Y-m-d') ?>" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">
                        <br><br>
                        <label for="passType">Pass Type:</label>
                        <select name="passType" id="passType">
                            <option value="--" selected="selected">--</option>
                            <option value="30">Monthly</option>
                            <option value="90">Quarterly</option>
                        </select>
                        <br><br>
                        <label for="validate_through">Validate Through:</label>
                        <input type="date" id="validate_through" value="<?php echo date('Y-m-d', strtotime('+6 months')) ?>" name="validate_through" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">

                        <br><br>
                    </div>

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
                        <input type="text" id="age" name="age" maxlength="6" value="" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">


                        <br><br>
                        <label>Gender:</label>
                        <input type="radio" name="gender" value="M" checked="checked">
                        <span class="bodytext">Male</span>
                        <input type="radio" name="gender" value="F">
                        <span class="bodh2ytext">Female</span>
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

                        <label for="address_proof">Nature of Document for Address Proof:</label>
                        <select id="address_proof" name="address_proof" class="hasCustomSelect valid">
                            <option value="">Please Select Nature of Document</option>
                            <option value="1">Aadhaar card</option>
                            <option value="2">Address card with photo issued by Deptt. Of Posts, Govt. of India</option>
                            <option value="3">Arms License</option>
                            <option value="4">Cast and Domicile Certificate with address and photo issued by State G</option>
                            <option value="5">Certificate of address having Photo issued by MP/MLA/Group-A Gazetted </option>
                            <option value="6">Certificate of address issued by Village Panchayat head or its equival</option>
                            <option value="7">Certificate of address with photo from Govt. recognized educational in</option>
                            <option value="8">CGHS/ECHS Card</option>
                            <option value="9">Credit Card Statement (not older than last three months)</option>
                            <option value="10">Current Passbook of Post Office/any Schedule Bank</option>
                            <option value="11">Driving License</option>
                            <option value="12">Electricity Bill (not older than last three months)</option>
                            <option value="13">Freedom Fighter Card with address</option>
                            <option value="14">Income Tax Assessment Order</option>
                            <option value="15">Kissan Passbook with address</option>
                            <option value="16">Other (Domicile Certificate)</option>
                            <option value="17">Passport</option>
                            <option value="16">Pensioner's Card with address</option>
                            <option value="17">Photo Identity Card having address (of Central Govt./PSU or State Govt</option>
                            <option value="18">Ration Card</option>
                            <option value="19">Registered Sale/Lease Agreement</option>
                            <option value="20">Sri Lankan Refugees Identity Card</option>
                            <option value="21">Telephone Bill of Fixed line (not older than last three months)</option>
                            <option value="22">Vehicle Registration Certificate</option>
                            <option value="23">Voter Id</option>
                            <option value="24">Water Bill (not older than last three months)</option>
                        </select>
                        <br><br>

                        <label for="student_address_proof_upload">Upload Proof of Correspondence Address:</label>
                        <input type="file" id="student_address_proof_upload" name="student_address_proof_upload" accept=".jpg, .jpeg, .png">
                        <p>[Self-attached Passport size Photo Copy. Max size: 200KB]</p>
                        <span id="address-proof-error" style="color: red;"></span>
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

                        <label for="filename1">Photo Upload:</label>
                        <input type="file" name="filename1" id="filename1" accept=".jpg, .jpeg, .png">
                        <p>[Self-attached Passport size Photo Copy. Max size: 200KB]</p>
                        <span id="photo-upload-error" style="color: red;"></span>
                        <br><br>
                    </div>


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
                        <input type="date" value="<?php echo date('Y-m-d') ?>" name="fromDate" id="fromDate">


                        <br><br>
                        <label for="toDate">To Date:</label>
                        <input type="date" name="toDate" id="toDate" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">
                        <br><br>

                        <div class="student-form">
                            <label for="fromPlaceStudent">From Place:</label>
                            <input type="text" id="fromPlaceStudent" class="fromPlace">
                            <br><br>
                            <label for="toPlaceStudent">To Place:</label>
                            <input type="text" id="toPlaceStudent" class="toPlace">
                        </div>

                        <br><br>
                        <label for="classOfService">Class Of Service:</label>
                        <select name="classOfService">
                            <option value="" selected="selected">--</option>
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

            <div class="form" id="PassengerForm" style="display: none;">
                <!-- Passenger Pass Form Content -->
                <h1>Pasanger Passs </h1>
            </div>

            <!-- Handicap Pass Form -->
            <div class="form" id="HandicapForm">
                <form method="POST">
                    <h1>Handicap Pass Details</h1>
                    <!-- Personal  -->
                    <div class="form-group">
                        <label for="handicap_fullname">Full Name:</label>
                        <input type="text" id="handicap_fullname" name="handicap_fullname" required>
                        <br> <br>
                        <label for="handicap_mother_name">Mother Name:</label>
                        <input type="text" id="handicap_mother_name" name="handicap_mother_name" required>
                        <br> <br>

                        <label for="dateofBirth">Date of Birth:</label>
                        <input type="date" name="dateofBirth" id="dateofBirth">
                        <br> <br>
                        <label for="age">Age:</label>
                        <input type="text" id="age" name="age" maxlength="6" value="" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">
                        <br> <br>

                        <label for="gender">Gender :</label>
                        <input type="radio" name="gender" value="M" checked="checked"> Male
                        <input type="radio" name="gender" value="F"> Female
                        <input type="radio" name="gender" value="T"> Transgender
                        <br> <br>

                        <label for="handicap_phone_number">Phone Number:</label>
                        <input type="text" id="handicap_phone_number" name="handicap_phone_number" pattern="[0-9]{10}" required>
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                        <label for="handicap_category">Category:</label>
                        <select name="handicap_category" id="handicap_category" required>
                            <option value="Divorcee & Widower">Divorcee & Widower</option>
                        </select>
                        <br><br>
                        <!-- Spouse Name  -->
                        <div id="spouse_name_field">
                            <label for="handicap_spouse_name">Spouse Name:</label>
                            <input type="text" id="handicap_spouse_name" name="handicap_spouse_name">
                        </div>
                        <br><br>
                        <!-- Relation with PwD  -->
                        <div id="relation_with_pwd_field">
                            <label for="handicap_relation_with_pwd">Relation with PwD:</label>
                            <input type="text" id="handicap_relation_with_pwd" name="handicap_relation_with_pwd">
                        </div>
                    </div>
                    <!-- Address -->
                    <div class="form-group">
                        <label for="handicap_address">Address:</label>
                        <textarea id="handicap_address" name="handicap_address" rows="4"></textarea>
                    </div>

                    <!-- Photo -->
                    <div class="form-group">
                        <label for="handicap_photo">Photo Upload:</label>
                        <input type="file" id="handicap_photo" name="handicap_photo" accept=".jpg, .jpeg, .png">
                        <p>[Self-attached Passport size Photo Copy. Max size: 200KB.]</p>
                        <span id="photo-upload-error" style="color: red;"></span>

                        <!-- Signature/Thumb/Other Print -->
                        <label for="handicap_signature">Signature/Thumb/Other Print:</label>
                        <input type="file" id="handicap_signature" name="handicap_signature" accept=".jpg, .jpeg, .png">
                        <p>[Upload proof of Signature/Thumb/Other Max size: 200KB.]</p>
                        <span id="signature-upload-error" style="color: red;"></span>
                        <br><br>

                        <!-- Nature of Document for Address Proof -->
                        <label for="address_proof">Nature of Document for Address Proof:</label>
                        <select id="address_proof" name="address_proof" class="hasCustomSelect valid">
                            <option value="">Please Select Nature of Document</option>
                            <option value="1">Aadhaar card</option>
                            <option value="2">Address card with photo issued by Deptt. Of Posts, Govt. of India</option>
                            <option value="3">Arms License</option>
                            <option value="4">Cast and Domicile Certificate with address and photo issued by State G</option>
                            <option value="5">Certificate of address having Photo issued by MP/MLA/Group-A Gazetted </option>
                            <option value="6">Certificate of address issued by Village Panchayat head or its equival</option>
                            <option value="7">Certificate of address with photo from Govt. recognized educational in</option>
                            <option value="8">CGHS/ECHS Card</option>
                            <option value="9">Credit Card Statement (not older than last three months)</option>
                            <option value="10">Current Passbook of Post Office/any Schedule Bank</option>
                            <option value="11">Driving License</option>
                            <option value="12">Electricity Bill (not older than last three months)</option>
                            <option value="13">Freedom Fighter Card with address</option>
                            <option value="14">Income Tax Assessment Order</option>
                            <option value="15">Kissan Passbook with address</option>
                            <option value="16">Other (Domicile Certificate)</option>
                            <option value="17">Passport</option>
                            <option value="16">Pensioner's Card with address</option>
                            <option value="17">Photo Identity Card having address (of Central Govt./PSU or State Govt</option>
                            <option value="18">Ration Card</option>
                            <option value="19">Registered Sale/Lease Agreement</option>
                            <option value="20">Sri Lankan Refugees Identity Card</option>
                            <option value="21">Telephone Bill of Fixed line (not older than last three months)</option>
                            <option value="22">Vehicle Registration Certificate</option>
                            <option value="23">Voter Id</option>
                            <option value="24">Water Bill (not older than last three months)</option>
                        </select>
                        <br><br>

                        <!-- Upload Proof of Correspondence Address -->
                        <label for="handicap_address_proof_upload">Upload Proof of Correspondence Address:</label>
                        <input type="file" id="handicap_address_proof_upload" name="handicap_address_proof_upload" accept=".jpg, .jpeg, .png">
                        <p>[Upload proof of correspondence address. Max size: 200KB.]</p>
                        <span id="address-proof-upload-error" style="color: red;"></span>
                    </div>

                    <!-- Education Details -->
                    <div class="form-group">
                        <label for="handicap_education">Education Details:</label>
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
                    </div>


                    <!-- Form and To  -->
                    <div class="form-group handicapped-form">
                        <label for="fromPlaceHandicapped">From Place:</label>
                        <input type="text" id="fromPlaceHandicapped" class="fromPlace">
                        <br><br>
                        <label for="toPlaceHandicapped">To Place:</label>
                        <input type="text" id="toPlaceHandicapped" class="toPlace">
                    </div>

                    <!-- Disability Details -->
                    <h1>Disability Details</h1>
                    <div class="form-group">
                        <label class="label" for="have_disability_cert">Do you have a disability certificate?</label>
                        <div class="textBoxOut">
                            <div class="formFieldBg">
                                <div class="regiFieldChk">
                                    <input type="radio" id="have_disability_cert_yes" name="have_disability_cert" value="1"> Yes
                                </div>
                                <div class="regiFieldChk">
                                    <input type="radio" id="have_disability_cert_no" name="have_disability_cert" value="0" checked="checked"> No
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="label" for="disability_cert_doc">Disability Certificate<span class="required"> *</span></label>
                        <input type="file" id="disability_cert_doc" name="disability_cert_doc" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label class="label" for="disability_type">Disability Type<span class="required"> *</span></label>
                        <select id="disability_type" name="disability_type" required>
                            <option value="Physical Disability">Physical Disability</option>
                            <option value="Intellectual Disability">Intellectual Disability</option>
                            <option value="Visual Disability">Visual Disability</option>
                            <option value="Hearing Disability">Hearing Disability</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="label" for="disability_percentage">Percentage of Disability<span class="required"> *</span></label>
                        <input type="number" id="disability_percentage" name="disability_percentage" min="1" max="100" required>
                    </div>

                    <div class="form-group">
                        <label class="label" for="disability_description">Brief Description of Disability<span class="required"> *</span></label>
                        <textarea id="disability_description" name="disability_description" rows="4" required></textarea>
                    </div>

                    <!-- Payment Page -->
                    <button class="btn-payment" id="paymentButton" type="button">Click to Pay</button>
                </form>
            </div>
        </div>
    </section>

    <script>
        function addFileInputValidation(inputId, errorId, maxSizeKB) {
            document.getElementById(inputId).addEventListener('change', function() {
                var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                var maxFileSize = maxSizeKB * 1024; // maxSizeKB in bytes
                var errorMessage = '';

                if (!allowedExtensions.exec(this.value)) {
                    errorMessage = 'Please upload a valid JPG or PNG image.';
                    this.value = '';
                } else if (this.files[0] && this.files[0].size > maxFileSize) {
                    errorMessage = 'Image size exceeds the ' + maxSizeKB + 'KB limit.';
                    this.value = '';
                }
                document.getElementById(errorId).textContent = errorMessage;
            });
        }

        addFileInputValidation('handicap_photo', 'photo-upload-error', 200);
        addFileInputValidation('handicap_signature', 'signature-upload-error', 200);
        addFileInputValidation('handicap_address_proof_upload', 'address-proof-upload-error', 200);
    </script>

    <script>
        $(document).ready(function() {
            $('.form').hide();

            $('#category').change(function() {
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

            // Logout function
            function logout() {
                window.location.href = '../logout.php';
            }

            document.getElementById('logout-btn').addEventListener('click', logout);

            // Show Pass-Page and handle pass type selection
            $('#new_pass').click(function() {
                $('.pass-page-container').show();
            });

            // Handle pass type selection
            $('#category').change(function() {
                var selectedCategory = $(this).val();
                console.log("Selected Category:", selectedCategory);

                // Hide all forms
                $('.form').hide();

                // Show the form for the selected pass type
                $('#' + selectedCategory + 'Form').show();
            });
        });

        // ---------------------------------------------------------------

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
                "Bhuj",
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
            ];

            $(".fromPlace, .toPlace").autocomplete({
                source: placesInGujarat,
                minLength: 1,
            });
        });


        // ------------------------------------------------------------------


        // Logout function
        function logout() {
            window.location.href = '../logout.php';
        }

        document.getElementById('logout-btn').addEventListener('click', logout);

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
                // Add 30 days for Monthly
                toDateObj.setDate(toDateObj.getDate() + 30);
            } else if (passType === "90") {
                // Add 90 days for Quarterly
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

</body>

</html>