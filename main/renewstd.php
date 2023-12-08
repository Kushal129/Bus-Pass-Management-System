<?php
session_start();
// print_r($_SESSION);

include_once '../connection.php';
include_once "../toaster.php";

$qry = 'SELECT * FROM price';
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_array($res);
$price = $row['price'];
$pass_id = $_POST['passId'];

$sql = "SELECT 
            pass.passType,
            pass.bus_type,
            pass.start_term_id,
            pass.ends_term_id,
            pass.image_id,
            pass.from_date,
            pass.to_date,
            passenger_info.full_name,
            passenger_info.address,
            passenger_info.gender,
            passenger_info.validate_through,
            passenger_info.dob,
            passenger_info.user_img_path,
            users.phone_number,
            student.education,
            student.Institute_name,
            student.Institute_address
        FROM pass
        INNER JOIN passenger_info ON pass.passenger_id = passenger_info.id
        INNER JOIN users ON passenger_info.user_id = users.id
        LEFT JOIN student ON passenger_info.r_id = student.id
        WHERE pass.id = $pass_id";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $passType = $row['passType'];
    $bus_type = $row['bus_type'];
    $start_term_id = $row['start_term_id'];
    $ends_term_id = $row['ends_term_id'];
    $image_id = $row['image_id'];
    $from_date = $row['from_date'];
    $to_date = $row['to_date'];
    $full_name = $row['full_name'];
    $address = $row['address'];
    $gender = $row['gender'];
    $validate_through = $row['validate_through'];
    $dob = $row['dob'];
    $user_img_path = $row['user_img_path'];
    $phone_number = $row['phone_number'];
    $education = $row['education'];
    $institute_name = $row['Institute_name'];
    $institute_address = $row['Institute_address'];
} else {
    echo '<script>alert("Pass ID not found");</script>';
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
<style>
    .custom-file-upload {
        display: flex !important;
        padding: 10px !important;
        background-color: black !important;
        color: white !important;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        width: 9% !important;
    }

    #verification_s,
    #student_address_proof_upload,
    #img_std {
        display: none;
    }
</style>

<body>
    <form action="../main/rpassformatestd.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <h1>Student Pass Details</h1>
            <hr>
            <label for="id">Application No:</label>
            <input type="text" readonly id="id" name="id" value="<?php echo $pass_id ?>" style="cursor: not-allowed;background-color:#efefef;color: #000000;" placeholder="NEW PASS">
            <br><br>
        </div>

        <div class="form-group">
            <label for="Entry_date">Entry Date:</label>
            <input type="date" name="Entry_date" id="Entry_date" value="<?php echo date('Y-m-d', strtotime($validate_through . '-6 months')) ?>" readonly style="cursor: not-allowed;background-color:#efefef;color: #000000;">
            <br><br>
            <label for="validate_through">Validate Through:</label>
            <input type="date" id="validate_through" value="<?php echo (new DateTime($validate_through))->format('Y-m-d'); ?>" name="validate_through" readonly style="cursor: not-allowed;background-color:#efefef;color: #000000;">
            <br><br>
        </div>

        <div class="form-group">
            <h1>Personal Details</h1>
            <hr>

            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" style="cursor: not-allowed;background-color:#efefef;color: #000000;" value="<?php echo $full_name ?>" required>
            <span id="fullname-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="mobileNo">Phone Number:</label>
            <input type="text" name="mobileNo" id="mobileNo" style="cursor: not-allowed;background-color:#efefef;color: #000000;" value="<?php echo $phone_number ?>" maxlength="10" value="" required>
            <span id="mobileNo-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="address">Address:</label>
            <textarea name="address" id="address" cols="20" rows="3" readonly style="cursor:not-allowed; background-color:#efefef; color:#000000;" required><?php echo $address; ?></textarea>
            <span id="address-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="editAddress">Do you want to change your address?</label>
            <input type="radio" id="yesEditAddress" name="editAddress" value="yes" onclick="toggleAddressSections('yes')"> Yes
            <input type="radio" id="noEditAddress" name="editAddress" value="no" onclick="toggleAddressSections('no')" checked> No
            <br><br>

            <label for="dateofBirth">Date of Birth:</label>
            <input type="date" name="dateofBirth" id="dateofBirth" value="<?php echo (new DateTime($dob))->format('Y-m-d'); ?>" required>
            <span id="dateofBirth-error" class="error-message" style="color:red"></span>
            <br><br>
            <label>Gender:</label>
            <input type="radio" name="gender" value="Male" <?php echo ($gender === "Male") ? 'checked="checked"' : ''; ?> required>
            <span class="bodytext">Male</span>
            <input type="radio" name="gender" value="Female" <?php echo ($gender === "Female") ? 'checked="checked"' : ''; ?>>
            <span class="bodytext">Female</span>
            <input type="radio" name="gender" value="Other" <?php echo ($gender === "Other") ? 'checked="checked"' : ''; ?>>
            <span class="bodytext">Other</span>
            <span id="gender-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="education">Education:</label>
            <select name="education" id="education" required>
                <option value="--">Please Select Highest Qualification</option>
                <?php
                $educationOptions = array(
                    "Primary",
                    "Middle/Higher Primary",
                    "Senior Secondary",
                    "Higher Secondary",
                    "Diploma",
                    "Graduate",
                    "PG Diploma",
                    "Post Graduate",
                    "Doctorate",
                    "Illiterate"
                );
                foreach ($educationOptions as $option) {
                    $selected = ($education === $option) ? 'selected="selected"' : '';
                    echo "<option value=\"$option\" $selected>$option</option>";
                }
                ?>
            </select>
            <span id="education-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="institute_name">Institute Name:</label>
            <input type="text" id="institute_name" name="institute_name" value="<?php echo $institute_name ?>" required>
            <span id="institute_name-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="institute_address">Institute Address:</label>
            <textarea name="institute_address" id="institute_address" cols="20" rows="3" required><?php echo $institute_address ?></textarea>
            <span id="institute_address-error" class="error-message" style="color:red"></span>
            <br><br>
        </div>

        <div class="form-group">
            <h1>Proof Details</h1>
            <hr>
            <div class="col-lg-6 col-md-6 col-12" style="display: flex; justify-content: center;">
                <img src="../uploads/user_photo/<?php echo $user_img_path; ?>" alt="User Photo" style="width: 300px;height: 250px !important;" class="img-fluid  ">
            </div>
            <br>
            <label for="img_std">Photo Upload:</label>
            <input type="file" name="img_std" id="img_std" accept=".png, .jpg, .jpeg">
            <label for="img_std" class="custom-file-upload">
                Choose File
            </label>
            <p>[Self-attached Passport size Photo Copy. Max size: 300KB]</p>
            <span id="photo_error" class="error-message" style="color: red;"></span>
            <br>

            <div id="addressProofSection" style="display: none;">
                <label for="address_proof">Select Document for Address Proof:</label>
                <select id="address_proof" name="address_proof" class="error-message">
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
                <span id="address_error" class="error-message" style="color: red;"></span>
                <br><br>

                <label for="student_address_proof_upload">Upload Proof For Address:</label>
                <input type="file" id="student_address_proof_upload" name="student_address_proof_upload" accept=".pdf, .jpg, .jpeg, .png">
                <label for="student_address_proof_upload" class="custom-file-upload">
                    Choose File
                </label>
                <p>[Self-attached size Max size: 200KB]</p>
                <span id="std_address_proof_error" class="error-message" style="color: red;"></span>
            </div>
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
        <div class="form-group bono">
            <label for="verification_s">Upload Document For Verification:</label>
            <br>
            <input type="file" name="verification_s" id="verification_s" accept=".png, .jpg, .jpeg">
            <label for="verification_s" class="custom-file-upload">
                Choose File
            </label>
            <p>[Self-attached Passport size Photo Copy. Max size: 300KB]</p>
            <span id="verification_s_error" class="error-message" style="color: red;"></span>
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

<script>
    function toggleAddressSections(choice) {
        var addressProofSection = document.getElementById('addressProofSection');
        var addressTextarea = document.getElementById('address');

        if (choice === 'yes') {
            addressTextarea.removeAttribute('readonly');
            addressTextarea.style.cursor = 'auto';
            addressTextarea.style.backgroundColor = '#ffffff';
            addressTextarea.style.color = '#000000';
            addressProofSection.style.display = 'block';
        } else {
            addressTextarea.setAttribute('readonly', 'readonly');
            addressTextarea.style.cursor = 'not-allowed';
            addressTextarea.style.backgroundColor = '#efefef';
            addressTextarea.style.color = '#000000';
            addressProofSection.style.display = 'none';
        }
    }
</script>
<script>
    $(document).ready(function() {
        <?php
        $formattedDate = (new DateTime($validate_through))->format('Y-m-d');
        ?>
        var validateThrough = "<?php echo $formattedDate; ?>";
        var currentDate = new Date().toISOString().split('T')[0];

        console.log(validateThrough);
        console.log(currentDate);

        if (validateThrough < currentDate) {
            $(document).find('.bono').show();
            $(document).find("#verification_s").attr("disabled", false)
            $(document).find('#Entry_date').val(currentDate);

            var currentDatePlus6Months = new Date(currentDate);
            currentDatePlus6Months.setMonth(currentDatePlus6Months.getMonth() + 6);

            var formattedDatePlus6Months = currentDatePlus6Months.toISOString().split('T')[0];
            $(document).find('#Entry_date').val(formattedDatePlus6Months);
        } else {
            console.log("hide");
            $(document).find("#verification_s").attr("disabled", true);
            $(document).find('.bono').hide();
        }
    });
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


            const addressProofValue = $('#address_proof').val();
            const EditAddress = $('input[name="editAddress"]:checked').val();
            // alert(EditAddress)
            if (addressProofValue === '--' && EditAddress == 'yes') {
                showError('#address_error', 'Please select a Document for Address Proof.');
            } else {
                clearError('#address_error');
            }

            const studentuploadvalue = $('#student_address_proof_upload').val();
            if (studentuploadvalue === '' && EditAddress == 'yes') {
                showError('#std_address_proof_error', 'Please upload a Document for Address Proof.');
            } else {
                clearError('#std_address_proof_error');
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
        const addressProofInput = $('#student_address_proof_upload');
        const addressProofErrorElement = $('#std_address_proof_error');

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

    $(document).ready(function() {
        const addressProofInput = $('#verification_s');
        const addressProofErrorElement = $('#verification_s_error');

        addressProofInput.on('change', function() {
            const file = this.files[0];

            if (file) {
                const allowedFormats = ['application/pdf', 'image/jpg', 'image/jpeg', 'image/png'];
                const maxFileSize = 200 * 1024;
                const minFileSize = 20 * 1024;

                if (!allowedFormats.includes(file.type)) {
                    displayError(addressProofErrorElement, 'Please upload a PDF, JPG, JPEG, or PNG file.');
                    addressProofInput.val('');
                } else
                if (file.size < minFileSize) {
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