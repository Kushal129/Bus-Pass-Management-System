<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bus Pass | User | Passenger Pass </title>
    <link rel="stylesheet" href="../css/user.css">
    <link rel="icon" type="image/ico" href="../img/buslogo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <form action="../main/payment.php" method="POST">
        <div class="form-group">
            <h1>Passenger Pass Details</h1>
            <hr>
            <label for="id">Application No:</label>
            <input type="text" disabled id="id" name="id" style="cursor: not-allowed;background-color:#efefef;color: #000000;" placeholder="NEW PASS">
            <br><br>
        </div>

        <div class="form-group">
            <label for="entryDate">Entry Date:</label>
            <input type="date" name="Entrydate" value="<?php echo date('Y-m-d') ?>" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">
            <br><br>
            <label for="validate_through">Validate Through:</label>
            <input type="date" id="validate_through" value="<?php echo date('Y-m-d', strtotime('+6 months')) ?>" name="validate_through" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">

            <br><br>
        </div>

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
            <label for="dateofBirth_passanger">Date of Birth:</label>
            <input type="date" name="dateofBirth_passanger" id="dateofBirth_passanger">

            <br><br>
            <label for="age_passanger">Age:</label>
            <input type="text" id="age_passanger" name="age_passanger" value="" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">

            <br><br>
            <label>Gender:</label>
            <input type="radio" name="gender" value="M" checked="checked">
            <span class="bodytext">Male</span>
            <input type="radio" name="gender" value="F">
            <span class="bodh2ytext">Female</span>
            <input type="radio" name="gender" value="T">
            <span class="bodytext">Transgender</span>

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

            <label for="cast_p">Category:</label>
            <select name="cast_p" id="cast_p" required>
                <?php
                $cast_type_qry_p = "select * from cast";
                $cast_type_p = mysqli_query($con, $cast_type_qry_p);
                foreach ($cast_type_p as $key => $cast_p) {
                ?>
                    <option value="">Please Select Cast </option>
                    <option value="<?php echo $cast_p['cast_id'] ?>"><?php echo $cast_p['cast_name'] ?></option>
                <?php
                }
                ?>
            </select>
            <br><br>
        </div>
        <div class="form-group">
            <label for="img_passenger">Photo Upload:</label>
            <input type="file" name="img_passenger" id="img_passenger" accept=".jpg, .jpeg, .png">
            <p>[Self-attached Passport size Photo Copy. Max size: 200KB]</p>
            <span id="photo-upload-error-passenger" style="color: red;"></span>

            <br><br>
            <label for="address_proof">Select Document for Address Proof:</label>
            <select id="address_proof" name="address_proof" class="hasCustomSelect valid">
                <?php
                $address_proof_qry_p = "SELECT * FROM document_type";
                $add_p = mysqli_query($con, $address_proof_qry_p);
                foreach ($add_p as $key => $add_proof_p) {
                ?>
                    <option value="">Please Select Document</option>
                    <option value="<?php echo $add_proof_p['id'] ?>"><?php echo $add_proof_p['name'] ?></option>
                <?php
                }
                ?>
            </select>
            <br><br>
            <label for="passenger_address_proof_upload">Upload Proof of Correspondence Address:</label>
            <input type="file" id="passenger_address_proof_upload" name="passenger_address_proof_upload" accept=".jpg, .jpeg, .png">
            <p>[Self-attached Passport size Photo Copy. Max size: 200KB]</p>
            <span id="address-proof-error-passenger" style="color: red;"></span>

        </div>

        <div class="form-group">
            <h1>Company Details</h1>
            <hr>
            <label for="institute_name">Company Name:</label>
            <input type="text" id="institute_name" name="institute_name">
            <br><br>
            <label for="institute_address">Company Address:</label>
            <textarea name="institute_address" id="institute_address" cols="20" rows="3"></textarea>
            <br><br>
        </div>
        <div class="form-group">
            <label for="passType_p">Pass Type:</label>
            <select name="passType_p" id="passType_p">
                <option value="30" selected>Monthly</option>
                <option value="90">Quarterly</option>
            </select>
            <br><br>
            <label for="fromDate_p">From Date:</label>
            <input type="date" value="<?php echo date('Y-m-d') ?>" name="fromDate_p" id="fromDate_p">

            <br><br>
            <label for="toDate_passanger">To Date:</label>
            <input type="date" name="toDate_passanger" id="toDate_passanger" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">
            <br><br>

            <label for="fromPlace_handi">From Place:</label>
            <input type="text" id="fromPlace_handi" class="fromPlace_h">
            <br><br>
            <label for="toPlace_handi">To Place:</label>
            <input type="text" id="toPlace_handi" class="toPlace_h">

            <br><br>
            <label for="classOfService_p">Class Of Service:</label>
            <select name="classOfService_p" id="classOfService_p">
                <?php
                $bus_type_qry_p = "select * from bus_type";
                $bus_types_p = mysqli_query($con, $bus_type_qry_p);
                foreach ($bus_types_p as $key => $bus_t_p) {
                ?>
                    <option value="<?php echo $bus_t_p['price_multiply'] ?>"><?php echo $bus_t_p['bus_name'] ?></option>
                <?php
                }
                ?>
            </select>
            <br><br>
            <hr>
        </div>
        <div class="form-group">
            <h2> Payment </h2>
            <hr>
            <input type="text" placeholder="Pay Amount.." id="pay-value_p" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">
            <br><br>
            <button class="btn-pmt" id="paymentButton">Submit and Proceed to Payment</button>
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

        $('#category_p').change(function() {
            var selectedCategory = $(this).val();
            console.log("Selected Category:", selectedCategory);

            $('.form').hide();

            $('#category_p' + selectedCategory + 'Form').show();
            console.log("Displaying Form:", $('#category_p' + selectedCategory + 'Form'));
        });

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
        ];

        $(".fromPlace_h, .toPlace_h").autocomplete({
            source: placesInGujarat,
            minLength: 1,
        });
    });


    // ------------------------------------------------------------------


    $(".fromPlace_h , .toPlace_h").change(function() {
        calculatePassAmount_p();
    })

    function calculatePassAmount_p() {
        var from = $('.fromPlace_h').val();
        var to = $('.toPlace_h').val();

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
                    console.log(calculateDistance_p(res[0].lati, res[0].long, res[1].lati, res[1].long));
                    distance = Math.ceil(calculateDistance_p(res[0].lati, res[0].long, res[1].lati, res[1].long));
                    rs = distance * 13;
                    var multipy = $('#classOfService_p').val();
                    var passType_p = $('#passType_p').val();

                    if (passType_p === "30") {
                        rs = distance * 13 * multipy;
                    } else if (passType_p === "90") {
                        rs = distance * 13 * multipy * 3;
                    }
                    $("#pay-value_p").val(Math.ceil(rs) + " Rs/-");
                }
            })
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


    // ------------------------------------------------------------------


    $(document).on('change', "#dateofBirth_passanger", function() {
        var date = $(document).find("#dateofBirth_passanger").val();
        var dob = new Date(date);

        var today = new Date();
        var diff = today.getTime() - dob.getTime();
        var age = Math.floor(diff / (1000 * 60 * 60 * 24 * 365));

        $(document).find("#age_passanger").val(age);
        console.log(age);
    });

    updateToDate_passanger();

    function updateToDate_passanger() {
        var passType = $('#passType_p').val();
        var fromDate = $("#fromDate_p").val();

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

        var toDate_passanger = year + '-' + month + '-' + day;

        $(document).find("#toDate_passanger").val(toDate_passanger);
    }

    $(document).on('change', "#fromDate_p", function() {
        updateToDate_passanger();
    });

    $(document).on('change', "#passType_p", function() {
        updateToDate_passanger();
    });
</script>
<script>
    $(document).ready(function() {
        function addFileInputValidation_pas(inputId, errorId, maxSizeKB) {
            $(inputId).on('change', function() {
                const file = this.files[0];
                const errorElement = $(errorId);

                if (!file) {
                    errorElement.text('No file selected');
                    return;
                }

                const allowedExtensions = /\.(jpg|jpeg|png)$/i;
                if (!allowedExtensions.test(file.name)) {
                    errorElement.text('Invalid file type. Allowed: JPG, JPEG, PNG');
                    this.value = '';
                    return;
                }

                const maxFileSize = maxSizeKB * 1024;
                if (file.size > maxFileSize) {
                    errorElement.text('File size exceeds the maximum allowed (' + maxSizeKB + 'KB)');
                    this.value = '';
                    return;
                }
                errorElement.text('');
            });
        }

        addFileInputValidation_pas('#img_passenger', '#photo-upload-error-passenger', 200);
        addFileInputValidation_pas('#passenger_address_proof_upload', '#address-proof-error-passenger', 200);


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

</html>