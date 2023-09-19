<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bus Pass | User </title>
    <link rel="stylesheet" href="../css/user.css">
    <link rel="icon" type="image/ico" href="../img/buslogo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <form action="../main/payment.php" method="POST">
        <!-- Application No -->
        <div class="form-group">
            <h1>Student Pass Details</h1>
            <hr>
            <label for="id">Application No:</label>
            <input type="text" disabled id="id" name="id" style="cursor: not-allowed;background-color:#efefef;color: #000000;" placeholder="NEW PASS">
            <br><br>
        </div>

        <!-- Entry Date, Pass Type, Validate Through -->
        <div class="form-group">
            <label for="entryDate">Entry Date:</label>
            <input type="date" name="Entrydate" value="<?php echo date('Y-m-d') ?>" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">
            <br><br>
            <label for="validate_through">Validate Through:</label>
            <input type="date" id="validate_through" value="<?php echo date('Y-m-d', strtotime('+6 months')) ?>" name="validate_through" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">
            <br><br>
        </div>

        <!-- Personal Details -->
        <div class="form-group">
            <h1>Personal Details</h1>
            <hr>

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

            <label for="institute_name">Institute Name:</label>
            <input type="text" id="institute_name" name="institute_name">
            <br><br>

            <label for="institute_address">Institute Address:</label>
            <textarea name="institute_address" id="institute_address" cols="20" rows="3"></textarea>
            <br><br>


        </div>
        <div class="form-group">
            <h1>Prof Details</h1>
            <hr>
            <label for="img_std">Photo Upload:</label>
            <input type="file" name="img_std" id="img_std" accept=".jpg, .jpeg, .png">
            <p>[Self-attached Passport size Photo Copy. Max size: 200KB]</p>
            <span id="photo-upload-error-student" style="color: red;"></span>


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
            <span id="address-proof-error-student" style="color: red;"></span>

        </div>
        <div class="form-group">
            <h1>Location Details</h1>
            <hr>
            <label for="passType">Pass Type:</label>
            <select name="passType" id="passType">
                <option value="30" selected>Monthly</option>
                <option value="90">Quarterly</option>
            </select>
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
            <select name="classOfService" id="classOfService">
                <option value="1" selected>LOCAL</option>
                <option value="1.3">EXPRESS</option>
                <option value="1.5">GURJARNAGRI</option>
            </select>
            <br><br>
            <hr>
        </div>
        <div class="form-group">
            <h2> Payment </h2>
            <hr>
            <input type="text" placeholder="Pay Amount.." id="pay-value" disabled>
            <br><br>
            <input class="btn-submit" type="button" value="Submit and Proceed to Payment" id="paymentButton" onclick="redirectToPayment()">
        </div>
    </form>
</body>
<script>
    $(document).ready(function() {
        $('.form').hide();

        function showForm(selectedCategory) {
            $('#' + selectedCategory + 'Form').show();
        }

        $('#new_pass').click(function() {
            $('.pass-page-container').show();

            var selectedCategory = $('#category option:first').val();
            console.log("Selected Category:", selectedCategory);

            showForm(selectedCategory);
        });

        $('#category').change(function() {
            var selectedCategory = $(this).val();
            console.log("Selected Category:", selectedCategory);
            $('.form').hide();

            showForm(selectedCategory);
            console.log("Displaying Form:", $('#' + selectedCategory + 'Form'));
        });


        var defaultCategory = $('#category').val();
        showForm(defaultCategory);
    });
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

        function logout() {
            window.location.href = '../logout.php';
        }

        document.getElementById('logout-btn').addEventListener('click', logout);

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
            "Bardoli",
        ];

        $(".fromPlace, .toPlace").autocomplete({
            source: placesInGujarat,
            minLength: 1,
        });
    });

    $(".fromPlace, .toPlace").change(function() {
        var from = $('.fromPlace').val();
        var to = $('.toPlace').val();

        if (from != '' && to != '') {
            $.ajax({
                type: 'post',
                url: 'get_geo_loc.php',
                dataType: 'json',
                data: {
                    from: from,
                    to: to,
                },
                success: function(res) {
                    console.log(calculateDistance(res[0].lati, res[0].long, res[1].lati, res[1].long));
                    distance = Math.ceil(calculateDistance(res[0].lati, res[0].long, res[1].lati, res[1].long));
                    rs = distance * 13;
                    var multipy = $('#classOfService').val();
                    $("#pay-value").val(Math.ceil(rs * multipy));
                }
            })
        }

    })

    $('#classOfService').change(function() {
        // rs = distance * 13;
        // var multipy = $('#classOfService').val();
        // $("#pay-value").val(Math.ceil(rs * multipy));

        function calculatePassAmount() {
            var passType = $('#passType').val();
            var multipy = $('#classOfService').val();
            var rs = 0;

            if (passType === "30") {
                rs = distance * 13 * multipy;
            } else if (passType === "90") {
                rs = distance * 13 * multipy * 3;
            }

            $("#pay-value").val(Math.ceil(rs));
        }
        $("#paymentButton").click(function() {
            calculatePassAmount();
        });

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
    // ------------------------------------------------------------------


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

<script>
    $(document).ready(function() {
        function addFileInputValidation(inputId, errorId, maxSizeKB, allowedExtensions) {
            $(inputId).on('change', function() {
                const fileInput = $(this);
                const errorElement = $(errorId);
                const file = fileInput[0].files[0];

                if (!file) {
                    errorElement.text('No file selected');
                    return;
                }

                const fileSizeKB = file.size / 1024;
                if (fileSizeKB > maxSizeKB) {
                    errorElement.text('File size exceeds the maximum allowed (' + maxSizeKB + 'KB)');
                    fileInput.val('');
                    return;
                }

                const fileExtension = file.name.split('.').pop().toLowerCase();
                if (!allowedExtensions.includes(fileExtension)) {
                    errorElement.text('Invalid file type. Allowed: ' + allowedExtensions.join(', '));
                    fileInput.val('');
                    return;
                }

                errorElement.text('');
            });
        }

        addFileInputValidation('#img_std', '#photo-upload-error-student', 500, ['jpg', 'jpeg', 'png']);
        addFileInputValidation('#student_address_proof_upload', '#address-proof-error-student', 500, ['jpg', 'jpeg', 'png']);
    });
</script>


<script>
    function redirectToPayment() {
        window.location.href = "../main/payment.php";
    }
</script>

</html>