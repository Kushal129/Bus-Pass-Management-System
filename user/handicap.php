<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bus Pass | User | Handicap Pass </title>
    <link rel="stylesheet" href="../css/user.css">
    <link rel="icon" type="image/ico" href="../img/buslogo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <form id="myfrom" action="../main/payment.php" method="POST">
        <div class="form-group">
            <h1>Handicap Pass Details</h1>
            <hr>
            <label for="id">Application No:</label>
            <input type="text" disabled id="id" name="id" style="cursor: not-allowed;background-color:#efefef;color: #000000;" placeholder="NEW PASS">
            <br><br>
        </div>
        <!-- Personal  -->
        <div class="form-group">
            <h1>Personal Details</h1>
            <hr>
            <label for="handicap_fullname">Full Name:</label>
            <input type="text" id="handicap_fullname" name="handicap_fullname" required>
            <br> <br>

            <label for="dateofBirth_handi">Date of Birth:</label>
            <input type="date" name="dateofBirth_handi" id="dateofBirth_handi">
            <br> <br>

            <label for="age_handi">Age:</label>
            <input type="text" id="age_handi" name="age_handi" value="" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">
            <br> <br>

            <label for="gender">Gender :</label>
            <input type="radio" name="gender" value="M" checked="checked"> Male
            <input type="radio" name="gender" value="F"> Female
            <input type="radio" name="gender" value="T"> Transgender
            <br> <br>

            <label for="handicap_phone_number">Phone Number:</label>
            <input type="text" id="handicap_phone_number" name="handicap_phone_number" pattern="[0-9]{10}" required>
            <br><br>
            <label for="handicap_address">Address:</label>
            <textarea id="handicap_address" name="handicap_address" rows="4"></textarea>
        </div>

        <div class="form-group">
            <h1>Proof Details </h1>
            <hr>
            <label for="handicap_photo">Photo Upload:</label>
            <input type="file" id="handicap_photo" name="handicap_photo" accept=".jpg, .jpeg, .png">
            <p>[Self-attached Passport size Photo Copy. Max size: 200KB.]</p>
            <span id="photo-upload-error-handicap" style="color: red;"></span>

            <br>
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
            <br>
            <br>
            <label for="handicap_address_proof_upload">Upload Proof of Correspondence Address:</label>
            <input type="file" id="handicap_address_proof_upload" name="handicap_address_proof_upload" accept=".jpg, .jpeg, .png">
            <p>[Upload proof of correspondence address. Max size: 200KB.]</p>
            <span id="address-proof-upload-error-handicap" style="color: red;"></span>
        </div>

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


        <div class="form-group">
            <br><br>
            <h1>Disability Details</h1>
            <hr>
            <label for="have_disability_cert">Do you have a disability certificate?</label>
            <div class="formFieldBg">
                <div class="regiFieldChk">
                    <input type="radio" id="have_disability_cert_yes" name="have_disability_cert" value="1"> Yes
                </div>
                <div class="regiFieldChk">
                    <input type="radio" id="have_disability_cert_no" name="have_disability_cert" value="0" checked="checked"> No
                </div>
            </div>

            <div class="disabilitycert" style="display: none;">
                <label class="label" for="disability_cert_doc_handicap">
                    Disability Certificate<span class="required"> * </span>
                </label>
                <div class="textBoxOut">
                    <input type="file" id="disability_cert_doc_handicap" name="disability_cert_doc" accept=".jpg, .jpeg, .png, .pdf" required>
                    <div class="note">(Only jpeg, jpg, png, and pdf with size 20 KB to 500 KB allowed)</div>
                    <span id="error_disability_cert_doc_handicap" style="color: red;"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h2>Disability Area</h2>
            <br>
            <div class="textBoxOut" title="Disability Area">
                <div class="multicustomSelectBox multipletype disabilitys_type_withCheckbox">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Abdomen" name="disability_area[]">Abdomen</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="All Four Limbs" name="disability_area[]">All Four Limbs</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Anemia" name="disability_area[]">Anemia</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Apraxia Of Speech" name="disability_area[]">Apraxia Of Speech</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Bilateral Vocal Cord Paralysis" name="disability_area[]">Bilateral Vocal Cord Paralysis</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Bladder" name="disability_area[]">Bladder</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Body Height" name="disability_area[]">Body Height</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Bone Disease" name="disability_area[]">Bone Disease</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Both Ears" name="disability_area[]">Both Ears</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Both Eye" name="disability_area[]">Both Eye</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Both Hand" name="disability_area[]">Both Hand</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Both Leg" name="disability_area[]">Both Leg</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Both Lower Limb" name="disability_area[]">Both Lower Limb</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Both Upper Limb" name="disability_area[]">Both Upper Limb</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Both Upper Limb And Both Lower Limb" name="disability_area[]">Both Upper Limb And Both Lower Limb</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Brain" name="disability_area[]">Brain</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Chest" name="disability_area[]">Chest</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Developmental Disorde" name="disability_area[]">Developmental Disorder</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Dysarthria" name="disability_area[]">Dysarthria</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Ears" name="disability_area[]">Ears</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Elbow" name="disability_area[]">Elbow</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Elbow Spine" name="disability_area[]">Elbow Spine</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Epilepsy" name="disability_area[]">Epilepsy</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Face" name="disability_area[]">Face</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Fingers" name="disability_area[]">Fingers</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Foot" name="disability_area[]">Foot</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Foot Knee" name="disability_area[]">Foot Knee</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Glossectomy" name="disability_area[]">Glossectomy</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Hand Fingers" name="disability_area[]">Hand Fingers</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Head" name="disability_area[]">Head</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Heel" name="disability_area[]">Heel</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Hip" name="disability_area[]">Hip</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Knee" name="disability_area[]">Knee</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Knee Left Leg" name="disability_area[]">Knee Left Leg</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Knee Right Leg" name="disability_area[]">Knee Right Leg</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Laryngectomy" name="disability_area[]">Laryngectomy</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Left Arm" name="disability_area[]">Left Arm</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Left Arm Left Leg" name="disability_area[]">Left Arm Left Leg</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Left Arm Right Arm" name="disability_area[]">Left Arm Right Arm</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Left Arm Right Leg" name="disability_area[]">Left Arm Right Leg</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Left Ear" name="disability_area[]">Left Ear</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Left Eye" name="disability_area[]">Left Eye</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Left Eye Right Eye" name="disability_area[]">Left Eye Right Eye</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Left Hand" name="disability_area[]">Left Hand</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Left Leg" name="disability_area[]">Left Leg</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Left Leg Right Leg" name="disability_area[]">Left Leg Right Leg</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Left Lower Limb" name="disability_area[]">Left Lower Limb</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Left Upper Limb" name="disability_area[]">Left Upper Limb</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Locomotor/oh" name="disability_area[]">Locomotor/oh</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Longitiudinal Deficiencies" name="disability_area[]">Longitiudinal Deficiencies</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Maxillofacial Anomalies" name="disability_area[]">Maxillofacial Anomalies</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Mental Illness" name="disability_area[]">Mental Illness</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Mental Illness (hearing)" name="disability_area[]">Mental Illness (hearing)</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="Mental Illness (iq)" name="disability_area[]">Mental Illness (iq)</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="36" name="disability_area[]">Mental Illness (learning)</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="37" name="disability_area[]">Mental Illness (vision)</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="76" name="disability_area[]">Mental Retardation</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="29" name="disability_area[]">Mind Mental</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="31" name="disability_area[]">Moderate Mind</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="9" name="disability_area[]">Mouth</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="15" name="disability_area[]">Neck</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="8" name="disability_area[]">Nose</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="33" name="disability_area[]">Profound Mental</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="79" name="disability_area[]">Psychological Problems</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="13" name="disability_area[]">Right Arm</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="53" name="disability_area[]">Right Arm Left Leg</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="51" name="disability_area[]">Right Arm Right Leg</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="64" name="disability_area[]">Right Ear</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="7" name="disability_area[]">Right Eye</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="63" name="disability_area[]">Right Hand</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="5" name="disability_area[]">Right Leg</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="45" name="disability_area[]">Right Lower Limb</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="39" name="disability_area[]">Right Upper Limb</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="11" name="disability_area[]">Shoulder</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="23" name="disability_area[]">Spine</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="14" name="disability_area[]">Stomach (pet)</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="10" name="disability_area[]">Throat</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="48" name="disability_area[]">Transverse Deficiencies</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="72" name="disability_area[]">Trunk</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="checkbox" value="47" name="disability_area[]">Whole Body</label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <input type="text" id="selectedData" placeholder="Show Checked Data" readonly>
        </div>

        <div class="form-group">
            <label class="label" for="disability_type">Disability Type<span class="required"> *</span></label>
            <select id="disability_type" name="disability_type" required>
                <option value="1">Physical Disability</option>
                <option value="2">Intellectual Disability</option>
                <option value="3">Visual Disability</option>
                <option value="4">Hearing Disability</option>
                <option value="4">Other</option>
            </select>
        </div>

        <div class="form-group">
            <h1>Location Details</h1>
            <hr>
            <label for="passType_handi">Pass Type:</label>
            <select name="passType_handi" id="passType_handi" required>
                <option value="30" selected>Monthly</option>
                <option value="90">Quarterly</option>
            </select>
            <br><br>

            <label for="fromDate_handi">From Date:</label>
            <input type="date" value="<?php echo date('Y-m-d') ?>" name="fromDate_handi" id="fromDate_handi">
            <br><br>

            <label for="toDate_handi">To Date:</label>
            <input type="date" name="toDate_handi" id="toDate_handi" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">
            <br><br>

            <div class="handi-form">
                <label for="fromPlace_handi">From Place:</label>
                <input type="text" id="fromPlace_handi" class="fromPlace_handi" required>
                <br><br>
                <label for="toPlace_handi">To Place:</label>
                <input type="text" id="toPlace_handi" class="toPlace_handi" required>
            </div>
            <br><br>

            <label for="classOfService_handi">Class Of Service:</label>
            <select name="classOfService_handi" id="classOfService_handi" required>
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
            <input type="text" placeholder="Pay Amount.." id="pay_value_h" disabled style="cursor: not-allowed;background-color:#efefef;color: #000000;">
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

            var selectedCategory = $('#category option:first').val();
            console.log("Selected Category:", selectedCategory);

            showForm(selectedCategory);
        });

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

        $(".fromPlace_handi, .toPlace_handi").autocomplete({
            source: placesInGujarat,
            minLength: 1,
        });
    });


    // ------------------------------------------------------------------

    $(document).ready(function() {
        function calculateAge() {
            var date_handi = $("#dateofBirth_handi").val();
            var dob = new Date(date_handi);

            if (!isNaN(dob.getTime())) {
                var today = new Date();
                var diff = today.getTime() - dob.getTime();
                var age_handi = Math.floor(diff / (1000 * 60 * 60 * 24 * 365));

                $("#age_handi").val(age_handi);
                console.log(age_handi);
            } else {
                $("#age_handi").val('');
                console.log('Invalid date');
            }
        }

        $("#dateofBirth_handi").on('change', calculateAge);
    });
    // ------------------------------------------------------------------

    $(".fromPlace_handi, .toPlace_handi").change(function() {
        calculatePassAmount_handi();
    })

    function calculatePassAmount_handi() {
        var from = $('.fromPlace_handi').val();
        var to = $('.toPlace_handi').val();

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
                    console.log(calculateDistance_h(res[0].lati, res[0].long, res[1].lati, res[1].long));
                    distance = Math.ceil(calculateDistance_h(res[0].lati, res[0].long, res[1].lati, res[1].long));
                    rs = distance * 13;
                    var discount = 0;
                    var multipy = $('#classOfService_handi').val();
                    var passType = $('#passType_handi').val();

                    if (passType === "30") {
                        discount = 0.2
                        rs = distance * 13 * multipy * discount;
                    } else if (passType === "90") {
                        discount = 0.2
                        rs = distance * 13 * multipy * 3 * discount;
                    }
                    $("#pay_value_h").val(Math.ceil(rs) + " Rs/-");
                }
            })
        }

    }

    $('#classOfService_handi').change(function() {
        calculatePassAmount_handi();
    })
    $('#passType_handi').change(function() {
        calculatePassAmount_handi();
    })


    function calculateDistance_h(lat1, lon1, lat2, lon2) {
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

    updateToDate_handi();

    function updateToDate_handi() {
        var passType = $('#passType_handi').val();
        var fromDate = $("#fromDate_handi").val();

        var toDateObj = new Date(fromDate);
        if (passType === "30") {
            toDateObj.setDate(toDateObj.getDate() + 30);
        } else if (passType === "90") {
            toDateObj.setDate(toDateObj.getDate() + 90);
        } else if (passType === "365") {
            toDateObj.setDate(toDateObj.getDate() + 365);
        }

        var year = toDateObj.getFullYear();
        var month = String(toDateObj.getMonth() + 1).padStart(2, '0');
        var day = String(toDateObj.getDate()).padStart(2, '0');

        var toDate = year + '-' + month + '-' + day;

        $("#toDate_handi").val(toDate);
    }

    $(document).on('change', "#fromDate_handi", function() {
        updateToDate_handi();
    });

    $(document).on('change', "#passType_handi", function() {
        updateToDate_handi();
    });
</script>
<script>
    $(document).ready(function() {
        function addFileInputValidation_handi(inputId, errorId, maxSizeKB) {
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

        addFileInputValidation_handi('#handicap_photo', '#photo-upload-error-handicap', 200);
        addFileInputValidation_handi('#handicap_address_proof_upload', '#address-proof-upload-error-handicap', 200);

        addFileInputValidation_handi('#disability_cert_doc_handicap', '#error_disability_cert_doc_handicap', 500);

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