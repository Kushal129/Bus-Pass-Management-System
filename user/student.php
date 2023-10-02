<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bus Pass | User | Student Pass </title>
    <link rel="stylesheet" href="../css/user.css">
    <link rel="icon" type="image/ico" href="../img/buslogo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <form action="../main/1.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <h1>Student Pass Details</h1>
            <hr>
            <label for="id">Application No:</label>
            <input type="text" disabled id="id" name="id" style="cursor: not-allowed;background-color:#efefef;color: #000000;" placeholder="NEW PASS">
            <br><br>
        </div>

        <div class="form-group">
            <label for="Entry_date">Entry Date:</label>
            <input type="date" name="Entry_date" value="<?php echo date('Y-m-d') ?>" readonly style="cursor: not-allowed;background-color:#efefef;color: #000000;">
            <br><br>
            <label for="validate_through">Validate Through:</label>
            <input type="date" id="validate_through" value="<?php echo date('Y-m-d', strtotime('+6 months')) ?>" name="validate_through" readonly style="cursor: not-allowed;background-color:#efefef;color: #000000;">
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
            <input type="text" name="mobileNo" id="mobileNo" maxlength="13" value="" required>
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
            <input type="radio" name="gender" value="M" checked="checked" required>
            <span class="bodytext">Male</span>
            <input type="radio" name="gender" value="F">
            <span class="bodh2ytext">Female</span>
            <input type="radio" name="gender" value="T">
            <span class="bodytext">Transgender</span>
            <span id="gender-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="cast_std">Category: </label>
            <select name="cast_std" id="cast_std" required>
                <option value="">Please Select Cast </option>
                <?php
                $cast_type_qry_s = "select * from cast";
                $cast_type_s = mysqli_query($con, $cast_type_qry_s);
                foreach ($cast_type_s as $key => $cast_s) {
                ?>
                    <option value="<?php echo $cast_s['cast_id'] ?>"><?php echo $cast_s['cast_name'] ?></option>
                <?php
                }
                ?>
            </select>
            <span id="cast_std-error" class="error-message" style="color:red"></span>
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
            <input type="file" name="img_std" id="img_std" accept=".pdf, .jpg, .jpeg, .png" required>
            <p>[Self-attached Passport size Photo Copy. Max size: 300KB]</p>
            <span id="photo-upload-error-student" class="error-message" style="color: red;">PHOTOOOO</span>
            <br><br>

            <label for="address_proof">Select Document for Address Proof:</label>
            <select id="address_proof" name="address_proof" class="error-message" required>
                <option value="--">Please Select Document</option>
                <?php
                $address_proof_qry_s = "SELECT * FROM document_type";
                $add_s = mysqli_query($con, $address_proof_qry_s);
                foreach ($add_s as $key => $add_proof_s) {
                ?>
                    <option value="<?php echo $add_proof_s['id'] ?>"><?php echo $add_proof_s['name'] ?></option>
                <?php
                }
                ?>
            </select>
            <br>
            <span id="address_proof-error" class="error-message" style="color: red;">SELECTTTTTTTTTTTTTTT</span>
            <br><br>

            <label for="student_address_proof_upload">Upload Proof For Address:</label>
            <input type="file" id="student_address_proof_upload" name="student_address_proof_upload" accept=".pdf, .jpg, .jpeg, .png" required>
            <p>[Self-attached size Max size: 200KB]</p>
            <br>
            <span id="address-proof-student-error" class="error-message" style="color: red;">APLOADDDDDDDDDDDD</span>
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
</body>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>


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
                    rs = distance * 13;
                    var multipy = $('#classOfService').val();
                    var passType = $('#passType').val();

                    if (passType === "30") {
                        rs = distance * 13 * multipy;
                    } else if (passType === "90") {
                        rs = distance * 13 * multipy * 3;
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

            const fullnameValue = $('#fullname').val();
            if (fullnameValue === '' || !/^[a-zA-Z ]+$/.test(fullnameValue)) {
                showError('#fullname', 'Please enter a valid Full Name with only letters and spaces.');
            } else {
                clearError('#fullname');
            }

            const mobileNoValue = $('#mobileNo').val();
            if (mobileNoValue === '' || !/^\d{10}$/.test(mobileNoValue)) {
                showError('#mobileNo', 'Please enter a valid 10-digit Phone Number.');
            } else {
                clearError('#mobileNo');
            }
            const addressValue = $('#address').val();
            if (addressValue === '') {
                showError('#address', 'Address is required.');
            } else {
                clearError('#address');
            }

            const dateofBirthValue = $('#dateofBirth').val();
            if (dateofBirthValue === '') {
                showError('#dateofBirth', 'Date of Birth is required.');
            } else {
                clearError('#dateofBirth');
            }

            const castStdValue = $('#cast_std').val();
            if (castStdValue === '') {
                showError('#cast_std', 'Category is required.');
            } else {
                clearError('#cast_std');
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

            const imgStdValue = $('#img_std').val();
            if (imgStdValue === '') {
                alert(1111);
                showError('#photo-upload-error-student', 'Please upload a photo.');
            } else {
                clearError('#photo-upload-error-student');
            }

            const addressProofValue = $('#address_proof').val();
            if (addressProofValue === '--') {
                alert(1222);
                showError('#address_proof-error', 'Please select a Document for Address Proof.');
            } else {
                clearError('#address_proof-error');
            }

            const studentAddressProofValue = $('#student_address_proof_upload').val();
            if (studentAddressProofValue === '') {
                alert(13333331);
                
                showError('#address-proof-student-error', 'Please upload a proof for address.');
            } else {
                clearError('#address-proof-student-error');
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

</html>