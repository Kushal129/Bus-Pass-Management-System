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
    <form action="../main/passformatep.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <h1>Passanger Pass Details</h1>
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

            <label for="fullnamep">Full Name:</label>
            <input type="text" id="fullnamep" name="fullnamep" required>
            <span id="fullnamep-error" class="error-error-message" style="color:red"></span>
            <br><br>

            <label for="mobileNop">Phone Number:</label>
            <input type="text" name="mobileNop" id="mobileNop" maxlength="10" value="" required>
            <span id="mobileNop-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="addressp">Address:</label>
            <textarea name="addressp" id="addressp" cols="20" rows="3" required></textarea>
            <span id="addressp-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="dateofBirthp">Date of Birth:</label>
            <input type="date" name="dateofBirthp" id="dateofBirthp" required>
            <span id="dateofBirthp-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="age_p">Age:</label>
            <input type="text" id="age_p" name="age_p" value="" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">
            <span id="age_p-error" class="error-message" style="color:red"></span>
            <br><br>

            <label>Gender:</label>
            <input type="radio" name="gender" value="Male" checked="checked" required>
            <span class="bodytext">Male</span>
            <input type="radio" name="gender" value="Female">
            <span class="bodh2ytext">Female</span>
            <input type="radio" name="gender" value="Other">
            <span class="bodytext">Other</span>
            <span id="genderp-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="cast_p">Category: </label>
            <select name="cast_p" id="cast_p" required>
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
            <span id="cast_p-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="educationp">Education:</label>
            <select name="educationp" id="educationp" required>
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
            <span id="educationp-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="company_name">Company Name:</label>
            <input type="text" id="company_name" name="company_name" required>
            <span id="company_name-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="Company_address">Company Address:</label>
            <textarea name="Company_address" id="Company_address" cols="20" rows="3" required></textarea>
            <span id="Company_address-error" class="error-message" style="color:red"></span>
            <br><br>
        </div>

        <div class="form-group">
            <h1>Proof Details</h1>
            <hr>
            <label for="img_p">Photo Upload:</label>
            <input type="file" name="img_p" id="img_p" accept=".png, .jpg, .jpeg" required>
            <p>[Self-attached Passport size Photo Copy. Max size: 300KB]</p>
            <span id="photo_error_p" class="error-message" style="color: red;"></span>
            <br>

            <label for="address_proofp">Select Document for Address Proof:</label>
            <select id="address_proofp" name="address_proofp" class="error-message" required>
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
            <span id="address_errorp" class="error-message" style="color: red;"></span>
            <br><br>

            <label for="passanger_address_proof_upload">Upload Proof For Address:</label>
            <input type="file" id="passanger_address_proof_upload" name="passanger_address_proof_upload" accept=".pdf, .jpg, .jpeg, .png" required>
            <p>[Self-attached size Max size: 200KB]</p>
            <span id="address_proof_errorp" class="error-message" style="color: red;"></span>
            <br>
        </div>

        <div class="form-group">
            <h1>Location Details</h1>
            <hr>
            <label for="passType_p">Pass Type:</label>
            <select name="passType_p" id="passType_p" required>
                <option value="30" selected>Monthly</option>
                <option value="90">Quarterly</option>
            </select>
            <br><br>

            <label for="fromDate_p">From Date:</label>
            <input type="date" value="<?php echo date('Y-m-d') ?>" name="fromDate_p" id="fromDate_p">
            <br><br>

            <label for="toDate_p">To Date:</label>
            <input type="date" name="toDate_p" id="toDate_p" style="cursor:not-allowed; background-color:#efefef; color:#000000;">
            <br><br>


            <label for="fromPlace_p">From Place:</label>
            <select name="fromPlace_p" id="fromPlace_p" class="fromPlace_p" required>
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
            <span id="fromPlace_p-error" class="error-message" style="color: red;"></span>
            <br><br>

            <label for="toPlace_p">To Place:</label>
            <select name="toPlace_p" id="toPlace_p" class="toPlace_p" required>
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
            <span id="toPlace_p-error" class="error-message" style="color: red;"></span>
            <br><br>

            <label for="classOfService_p">Class Of Service:</label>
            <select name="classOfService_p" id="classOfService_p" required>
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
            <span id="classOfService_p-error" class="error-message" style="color: red;"></span>
            <br><br>
            <hr>
        </div>

        <div class="form-group">
            <h2> Payment </h2>
            <hr>
            <input type="text" placeholder="Pay Amount.." id="pay-value_p" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">
            <br>
            <input type="text" placeholder="Payment ID " id="payment_id_lbl_p" readonly name="payment_id" style="cursor: not-allowed;background-color:#efefef;color: #000000;">

            <br><br>
            <div class="btn-paynow btn-pmt" id="paynow_p" onclick="pay_now_p()">Pay Now</div>
            <button class="btn-pmt" type="submit" id="paymentButton_p">Submit and Proceed </button>
        </div>
    </form>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>


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

        $(".fromPlace_p, .toPlace_p").autocomplete({
            source: placesInGujarat,
            minLength: 1,
        });
    });

    $(".fromPlace_p, .toPlace_p").change(function() {
        calculatePassAmount_p();
    })

    function calculatePassAmount_p() {
        var from = $(document).find('#fromPlace_p').val();
        var to = $(document).find('#toPlace_p').val();

        console.log(from, to);

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
                    console.log(111111111);
                    console.log(calculateDistance_p(res[0].lati, res[0].long, res[1].lati, res[1].long));
                    distance = Math.ceil(calculateDistance_p(res[0].lati, res[0].long, res[1].lati, res[1].long));
                    rs = distance * <?php echo $price ?>
                    var multipy = $('#classOfService_p').val();
                    var passType_p = $('#passType_p').val();

                    if (passType_p === "30") {
                        rs = distance * <?php echo $price ?> * multipy;
                    } else if (passType_p === "90") {
                        rs = distance * <?php echo $price ?> * multipy * 3;
                    }

                    $("#pay-value_p").val(Math.ceil(rs) + " Rs/-");
                }
            })
        } else {
            $("#pay-value_p").val(0 + " Rs/-");
        }

    }

    $('#classOfService_p').change(function() {
        calculatePassAmount_p();
    })
    $('#passType_p').change(function() {
        calculatePassAmount_p();
    })

    function calculateDistance_p(lat1, lon1, lat2, lon2) {
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

    $(document).on('change', "#dateofBirthp", function() {
        var date = $(document).find("#dateofBirthp").val();
        var dob = new Date(date);

        var today = new Date();
        var diff = today.getTime() - dob.getTime();
        var age = Math.floor(diff / (1000 * 60 * 60 * 24 * 365));

        $(document).find("#age_p").val(age);
        console.log(age);
    });

    updateToDate_p();

    function updateToDate_p() {
        var passType_p = $('#passType_p').val();
        var fromDate_p = $("#fromDate_p").val();

        if (passType_p === "--" || fromDate_p === " ") {
            return;
        }

        var fromDate_pObj = new Date(fromDate_p);
        var toDateObj = new Date(fromDate_pObj);

        if (passType_p === "30") {
            toDateObj.setDate(toDateObj.getDate() + 30);
        } else if (passType_p === "90") {
            toDateObj.setDate(toDateObj.getDate() + 90);
        }

        var year = toDateObj.getFullYear();
        var month = String(toDateObj.getMonth() + 1).padStart(2, '0');
        var day = String(toDateObj.getDate()).padStart(2, '0');

        var toDate = year + '-' + month + '-' + day;

        $(document).find("#toDate_p").val(toDate);
    }

    $(document).on('change', "#fromDate_p", function() {
        updateToDate_p();
    });

    $(document).on('change', "#passType_p", function() {
        updateToDate_p();
    });
</script>
<script>
    $(document).ready(function() {
        $('#paymentButton_p').hide();
        $('#payment_id_lbl_p').hide();

        function validateForm() {
            // Initialize a flag to check if the form is valid
            let isValid = true;

            // Helper function to show an error message
            function showError(elementId, errorMessage) {
                isValid = false;
                $(elementId).text(errorMessage);
            }

            // Helper function to clear an error message
            function clearError(elementId) {
                $(elementId).text('');
            }

            // Full Name Validation
            const fullnameValue = $('#fullnamep').val();
            if (fullnameValue === '' || /[^A-Za-z\s]/.test(fullnameValue)) {
                showError('#fullnamep-error', 'Please enter a valid Full Name with only letters and spaces.');
            } else {
                clearError('#fullnamep-error');
            }

            // Phone Number Validation
            const mobileNoValue = $('#mobileNop').val();
            if (mobileNoValue === '' || !/^\d{10}$/.test(mobileNoValue)) {
                showError('#mobileNop-error', 'Please enter a valid 10-digit Phone Number.');
            } else {
                clearError('#mobileNop-error');
            }

            // Address Validation
            const addressValue = $('#addressp').val();
            if (addressValue === '') {
                showError('#addressp-error', 'Address is required.');
            } else {
                clearError('#addressp-error');
            }

            // Date of Birth Validation
            const dateofBirthValue = $('#dateofBirthp').val();
            if (dateofBirthValue === '') {
                showError('#dateofBirthp-error', 'Date of Birth is required.');
            } else {
                clearError('#dateofBirthp-error');
            }

            // Category (Cast) Validation
            const castStdValue = $('#cast_p').val();
            if (castStdValue === '') {
                showError('#cast_p-error', 'Category is required.');
            } else {
                clearError('#cast_p-error');
            }

            // Education Validation
            const educationpValue = $('#educationp').val();
            if (educationpValue === '--') {
                showError('#educationp-error', 'Education is required.');
            } else {
                clearError('#educationp-error');
            }

            // Company Name Validation
            const instituteNameValue = $('#company_name').val();
            if (instituteNameValue === '') {
                showError('#company_name-error', 'Company Name is required.');
            } else {
                clearError('#company_name-error');
            }

            // Company Address Validation
            const instituteAddressValue = $('#Company_address').val();
            if (instituteAddressValue === '') {
                showError('#Company_address-error', 'Company Address is required.');
            } else {
                clearError('#Company_address-error');
            }

            // Address Proof Validation
            const addressProofValue = $('#address_proofp').val();
            if (addressProofValue === '--') {
                showError('#address_errorp', 'Please select a Document for Address Proof.');
            } else {
                clearError('#address_errorp');
            }

            // Address Proof Upload Validation
            const studentAddressProofValue = $('#passanger_address_proof_upload').val();
            if (studentAddressProofValue === '') {
                showError('#address_proof_errorp', 'Please upload a proof for address.');
            } else {
                clearError('#address_proof_errorp');
            }

            // From Place Validation
            const fromPlace_pValue = $('#fromPlace_p').val();
            if (fromPlace_pValue === '' || fromPlace_pValue === ' ') {
                showError('#fromPlace_p-error', 'Please select a From Place.');
            } else {
                clearError('#fromPlace_p-error');
            }

            // To Place Validation
            const toPlace_pValue = $('#toPlace_p').val();
            if (toPlace_pValue === '' || toPlace_pValue === ' ') {
                showError('#toPlace_p-error', 'Please select a To Place.');
            } else {
                clearError('#toPlace_p-error');
            }

            if (!isValid) {
                alert('Please fill in all required fields and correct any errors.');
            }
            return isValid;

        }

        window.pay_now_p = function() {
            if (validateForm()) {
                var amtWithSuffix = $('#pay-value_p').val();
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

                            $('#paynow_p').hide();
                            $('#payment_id_lbl_p').val(response.razorpay_payment_id);
                            $('#paymentButton_p').show();

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
        const imgStdInput = $('#img_p');
        const photoErrorElement = $('#photo_error_p');

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
        const addressProofInput = $('#passanger_address_proof_upload');
        const addressProofErrorElement = $('#address_proof_error');

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

</html>