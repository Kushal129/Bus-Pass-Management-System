<?php
session_start();
// print_r($_SESSION);

include_once '../connection.php';
include_once "../toaster.php";

$qry = 'SELECT * FROM price';
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_array($res);
$price = $row['price'];
$passp_id = $_POST['passId'];

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
            passenger.educationp,
            passenger.com_name,
            passenger.com_address
        FROM pass
        INNER JOIN passenger_info ON pass.passenger_id = passenger_info.id
        INNER JOIN users ON passenger_info.user_id = users.id
        LEFT JOIN passenger ON passenger_info.r_id = passenger.id
        WHERE pass.id = $passp_id";

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
    $full_name_p = $row['full_name'];
    $address_p = $row['address'];
    $gender_p = $row['gender'];
    $validate_through_p = $row['validate_through'];
    $dob_p = $row['dob'];
    $user_img_path_p = $row['user_img_path'];
    $phone_number_p = $row['phone_number'];
    $education_p = $row['educationp'];
    $com_name = $row['com_name'];
    $com_address = $row['com_address'];
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

    /* .read[type="text"],
    .read[type="number"],
    .read[type="date"],
    .read textarea {
        cursor: not-allowed !important;
        background-color: #efefef !important;
        color: #000000 !important;
    } */

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

    #verification_p,
    #passanger_address_proof_upload,
    #img_p {
        display: none;
    }
</style>

<body>
    <form action="../main/passformatep.php" method="POST" enctype="multipart/form-data">
        <div class="form-group ">
            <h1>Passanger Pass Details</h1>
            <hr>
            <label for="id">Application No:</label>
            <input type="text" disabled id="id" name="id" class="read" value=" <?php echo $passp_id ?>" placeholder="NEW PASS">
            <br><br>
        </div>

        <div class="form-group read">
            <label for="Entry_date_p">Entry Date:</label>
            <input type="date" name="Entry_date_p" id="Entry_date_p" value="<?php echo date('Y-m-d', strtotime($validate_through_p . '-6 months')) ?>" readonly style="cursor: not-allowed;background-color:#efefef;color: #000000;">
            <br><br>
            <label for="validate_through">Validate Through:</label>
            <input type="date" id="validate_through" value="<?php echo (new DateTime($validate_through_p))->format('Y-m-d'); ?>" name="validate_through" readonly style="cursor: not-allowed;background-color:#efefef;color: #000000;">
            <br><br>
        </div>

        <div class="form-group read">
            <h1>Personal Details</h1>
            <hr>

            <label for="fullnamep">Full Name:</label>
            <input type="text" id="fullnamep" name="fullnamep" readonly style="cursor:not-allowed; background-color:#efefef; color:#000000;" value="<?php echo $full_name_p ?>" required>
            <span id="fullnamep-error" class="error-error-message" style="color:red"></span>
            <br><br>

            <label for="mobileNop">Phone Number:</label>
            <input type="text" name="mobileNop" id="mobileNop" maxlength="10" readonly style="cursor:not-allowed; background-color:#efefef; color:#000000;" value="<?php echo $phone_number_p ?>" required>
            <span id="mobileNop-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="addressp">Address:</label>
            <textarea name="addressp" id="addressp" cols="20" rows="3" style="cursor:not-allowed; background-color:#efefef; color:#000000;" readonly required><?php echo $address_p; ?></textarea>
            <span id="addressp-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="editAddress_p">Do you want to change your address?</label>
            <input type="radio" id="yesEditAddress_p" name="editAddress_p" value="yes" onclick="toggleAddressSections_p('yes')"> Yes
            <input type="radio" id="noEditAddress_p" name="editAddress_p" value="no" onclick="toggleAddressSections_p('no')" checked> No
            <br><br>

            <label for="dateofBirthp">Date of Birth:</label>
            <input type="date" name="dateofBirthp" id="dateofBirthp" value="<?php echo (new DateTime($dob_p))->format('Y-m-d'); ?>" required>
            <span id="dateofBirthp-error" class="error-message" style="color:red"></span>
            <br><br>

            <label>Gender:</label>
            <input type="radio" name="gender" value="Male" <?php echo ($gender_p === "Male") ? 'checked="checked"' : ''; ?> required>
            <span class="bodytext">Male</span>
            <input type="radio" name="gender" value="Female" <?php echo ($gender_p === "Female") ? 'checked="checked"' : ''; ?>>
            <span class="bodytext">Female</span>
            <input type="radio" name="gender" value="Other" <?php echo ($gender_p === "Other") ? 'checked="checked"' : ''; ?>>
            <span class="bodytext">Other</span>
            <span id="gender-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="educationp">Education:</label>
            <select name="educationp" id="educationp" required>
                <option value="--">Please Select Highest Qualification</option>
                <?php
                $educationOptions_p = array(
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
                foreach ($educationOptions_p as $option_p) {
                    $selected_p = ($education_p === $option_p) ? 'selected="selected"' : '';
                    echo "<option value=\"$option_p\" $selected_p>$option_p</option>";
                }
                ?>
            </select>
            <span id="educationp-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="company_name">Company Name:</label>
            <input type="text" id="company_name" name="company_name" value="<?php echo $com_name ?>" required>
            <span id="company_name-error" class="error-message" style="color:red"></span>
            <br><br>

            <label for="Company_address">Company Address:</label>
            <textarea name="Company_address" id="Company_address" cols="20" rows="3" required><?php echo $com_address ?></textarea>
            <span id="Company_address-error" class="error-message" style="color:red"></span>
            <br><br>
        </div>

        <div class="form-group">
            <h1>Proof Details</h1>
            <hr>
            <div class="col-lg-6 col-md-6 col-12" style="display: flex; justify-content: center;">
                <img src="../uploads/user_photo/<?php echo $user_img_path_p; ?>" alt="User Photo" style="width: 300px;height: 250px !important;" class="img-fluid  ">
            </div>
            <label for="img_p">Photo Upload:</label>
            <input type="file" name="img_p" id="img_p" accept=".png, .jpg, .jpeg">
            <label for="img_p" class="custom-file-upload">
                Choose File
            </label>
            <p>[Self-attached Passport size Photo Copy. Max size: 300KB]</p>
            <span id="photo_error_p" class="error-message" style="color: red;"></span>
            <br>
            <div id="addressProofSection_p" style="display: none;">
                <label for="address_proofp">Select Document for Address Proof:</label>
                <select id="address_proofp" name="address_proofp" class="error-message">
                    <option value="--">Please Select Document</option>
                    <?php
                    $address_proof_qry_p = "SELECT * FROM document_type";
                    $add_p = mysqli_query($con, $address_proof_qry_p);
                    foreach ($add_p as $key => $add_proof_p) {
                    ?>
                        <option value="<?php echo $add_proof_p['id'] ?>"><?php echo $add_proof_p['name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <span id="address_errorp" class="error-message" style="color: red;"></span>
                <br><br>

                <label for="passanger_address_proof_upload">Upload Proof For Address:</label>
                <input type="file" id="passanger_address_proof_upload" name="passanger_address_proof_upload" accept=".pdf, .jpg, .jpeg, .png" required>
                <label for="passanger_address_proof_upload" class="custom-file-upload">
                    Choose File
                </label>
                <p>[Self-attached size Max size: 200KB]</p>
                <span id="address_proof_errorp" class="error-message" style="color: red;"></span>
            </div>
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
                $from_qry_p  =  "SELECT * FROM bus_terminals";
                $from_types_p = mysqli_query($con, $from_qry_p);
                foreach ($from_types_p as $key => $from_t_p) {
                ?>
                    <option value="<?php echo $from_t_p['ter_id'] ?>"><?php echo $from_t_p['ter_name'] ?></option>
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
                $from_qry_p  =  "SELECT * FROM bus_terminals";
                $from_types_p = mysqli_query($con, $from_qry_p);
                foreach ($from_types_p as $key => $from_t_p) {
                ?>
                    <option value="<?php echo $from_t_p['ter_id'] ?>"><?php echo $from_t_p['ter_name'] ?></option>
                <?php
                }
                ?>
            </select>
            <span id="toPlace_p-error" class="error-message" style="color: red;"></span>
            <br><br>

            <label for="classOfService_p">Class Of Service:</label>
            <select name="classOfService_p" id="classOfService_p" required>
                <?php
                $bus_type_qry_p  =  "SELECT * FROM bus_type ";
                $bus_types_p = mysqli_query($con, $bus_type_qry_p);
                foreach ($bus_types_p as $key => $bus_t_p) {
                ?>
                    <option value="<?php echo $bus_t_p['price_multiply'] ?>"><?php echo $bus_t_p['bus_name'] ?></option>
                <?php
                }
                ?>
            </select>
            <span id="classOfService_p-error" class="error-message" style="color: red;"></span>
            <br><br>
            <hr>
        </div>
        <div class="form-group bono">
            <label for="verification_p">Upload Document For Verification:</label>
            <br>
            <input type="file" name="verification_p" id="verification_p" accept=".png, .jpg, .jpeg" required>
            <label for="verification_p" class="custom-file-upload">
                Choose File
            </label>
            <p>[Self-attached Passport size Photo Copy. Max size: 300KB]</p>
            <span id="verification_p_error" class="error-message" style="color: red;"></span>
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

<script>
    function toggleAddressSections_p(choice) {
        var addressProofSection_p = document.getElementById('addressProofSection_p');
        var addressTextarea_p = document.getElementById('addressp');

        if (choice === 'yes') {
            addressTextarea_p.removeAttribute('readonly');
            addressTextarea_p.style.cursor = 'auto';
            addressTextarea_p.style.backgroundColor = '#ffffff';
            addressTextarea_p.style.color = '#000000';
            addressProofSection_p.style.display = 'block';
        } else {
            addressTextarea_p.setAttribute('readonly', 'readonly');
            addressTextarea_p.style.cursor = 'not-allowed';
            addressTextarea_p.style.backgroundColor = '#efefef';
            addressTextarea_p.style.color = '#000000';
            addressProofSection_p.style.display = 'none';
        }
    }
</script>
<script>
    $(document).ready(function() {
        <?php
        $formattedDate_p = (new DateTime($validate_through_p))->format('Y-m-d');
        ?>
        var validateThrough_p = "<?php echo $formattedDate_p; ?>";
        var currentDatep = new Date().toISOString().split('T')[0];

        console.log(validateThrough_p);
        console.log(currentDatep);

        if (validateThrough_p < currentDatep) {
            $(document).find('.bono').show();
            $(document).find("#verification_p").attr("disabled", false)
            $(document).find('#Entry_date_p').val(currentDatep);

            var currentDatepPlus6Months = new Date(currentDatep);
            currentDatepPlus6Months.setMonth(currentDatepPlus6Months.getMonth() + 6);

            var formattedDatePlus6Months = currentDatepPlus6Months.toISOString().split('T')[0];
            $(document).find('#Entry_date_p').val(formattedDatePlus6Months);
        } else {
            console.log("hide");
            $(document).find("#verification_p").attr("disabled", true);
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
                    console.log(calculateDistance_p(res[0].lati, res[0].long, res[1].lati, res[1].long));
                    distance_p = Math.ceil(calculateDistance_p(res[0].lati, res[0].long, res[1].lati, res[1].long));
                    rs = distance_p * <?php echo $price ?>;
                    var multipy_p = $('#classOfService_p').val();
                    var passType_p = $('#passType_p').val();

                    if (passType_p === "30") {
                        rs = distance_p * <?php echo $price ?> * multipy_p;
                    } else if (passType_p === "90") {
                        rs = distance_p * <?php echo $price ?> * multipy_p * 3;
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
        const distance_p = R * c;
        return distance_p;
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
        var toDate_pObj = new Date(fromDate_pObj);

        if (passType_p === "30") {
            toDate_pObj.setDate(toDate_pObj.getDate() + 30);
        } else if (passType_p === "90") {
            toDate_pObj.setDate(toDate_pObj.getDate() + 90);
        }

        var year = toDate_pObj.getFullYear();
        var month = String(toDate_pObj.getMonth() + 1).padStart(2, '0');
        var day = String(toDate_pObj.getDate()).padStart(2, '0');

        var toDate_p = year + '-' + month + '-' + day;

        $(document).find("#toDate_p").val(toDate_p);
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
            let isValid = true;

            function showError(elementId, errorMessage) {
                isValid = false;
                $(elementId).text(errorMessage);
            }

            function clearError(elementId) {
                $(elementId).text('');
            }

            const addressValue = $('#addressp').val();
            if (addressValue === '') {
                showError('#addressp-error', 'Address is required.');
            } else {
                clearError('#addressp-error');
            }

            const dateofBirthValue = $('#dateofBirthp').val();
            if (dateofBirthValue === '') {
                showError('#dateofBirthp-error', 'Date of Birth is required.');
            } else {
                clearError('#dateofBirthp-error');
            }

            const castStdValue = $('#cast_p').val();
            if (castStdValue === '') {
                showError('#cast_p-error', 'Category is required.');
            } else {
                clearError('#cast_p-error');

            }

            const educationpValue = $('#educationp').val();
            if (educationpValue === '--') {
                showError('#educationp-error', 'Education is required.');
            } else {
                clearError('#educationp-error');
            }

            const companyNameValue = $('#company_name').val();
            if (companyNameValue === '') {
                showError('#company_name-error', 'Company Name is required.');
            } else {
                clearError('#company_name-error');
            }

            const companyressValue = $('#Company_address').val();
            if (companyressValue === '') {
                showError('#Company_address-error', 'Company Address is required.');
            } else {
                clearError('#Company_address-error');
            }


            const passangerproofimg = $('#passanger_address_proof_upload').val();
            if (passangerproofimg === '') {
                showError('#address_proof_errorp', 'Please upload a Document for Address Proof.');
            } else {
                clearError('#address_proof_errorp');
            }

            const addressProofValue = $('#address_proofp').val();
            if (addressProofValue === '--') {
                showError('#address_errorp', 'Please select a Document for Address Proof.');
            } else {
                clearError('#address_errorp');
            }


            const fromPlace_pValue = $('#fromPlace_p').val();
            if (fromPlace_pValue === '' || fromPlace_pValue === ' ') {
                showError('#fromPlace_p-error', 'Please select a From Place.');
            } else {
                clearError('#fromPlace_p-error');
            }

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

                // if (!allowedFormats.includes(file.type)) {
                //     displayError(photoErrorElement, 'Please upload an image in PNG, JPG, or JPEG format.');
                //     imgStdInput.val('');
                // } else
                if (file.size < minFileSize) {
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
        const addressProofErrorElement = $('#address_proof_errorp');

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
                    displayError(addressProofErrorElement, 'Please upload a file that is at least 20KB in size.'); // Corrected error message
                    addressProofInput.val('');
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
        const addressProofInput = $('#verification_p');
        const addressProofErrorElement = $('#verification_p_error');

        addressProofInput.on('change', function() {
            const file = this.files[0];

            if (file) {
                const allowedFormats = ['application/pdf', 'image/jpg', 'image/jpeg', 'image/png'];
                const maxFileSize = 200 * 1024;
                const minFileSize = 20 * 1024;

                // if (!allowedFormats.includes(file.type)) {
                //     displayError(addressProofErrorElement, 'Please upload a PDF, JPG, JPEG, or PNG file.');
                //     addressProofInput.val('');
                // } else
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