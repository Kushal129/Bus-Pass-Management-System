<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bus Pass | User </title>
    <link rel="stylesheet" href="../css/user.css">
    <link rel="icon" type="image/ico" href="../img/buslogo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Boxicons CDN Link -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
   
        <form id="myfrom" action="../main/payment.php" method="POST">
            <h1>Handicap Pass Details</h1>
            <div class="form-group">
                <label for="id">Application No:</label>
                <input type="text" disabled id="id" name="id" style="cursor: not-allowed;background-color:#efefef;color: #000000;" placeholder="NEW PASS">
                <br><br>
            </div>
            <!-- Personal  -->
            <div class="form-group">
                <label for="handicap_fullname">Full Name:</label>
                <input type="text" id="handicap_fullname" name="handicap_fullname" required>
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


                <label for="handicap_address">Address:</label>
                <textarea id="handicap_address" name="handicap_address" rows="4"></textarea>
            </div>

            <!-- Photo -->
            <div class="form-group">
                <label for="handicap_photo">Photo Upload:</label>
                <input type="file" id="handicap_photo" name="handicap_photo" accept=".jpg, .jpeg, .png">
                <p>[Self-attached Passport size Photo Copy. Max size: 200KB.]</p>
                <span id="photo-upload-error" style="color: red;"></span> <br> <br>

                <!-- Nature of Document for Address Proof -->
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
            <div class="form-group">
                <h1>Disability Details</h1>
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
                    <label class="label" for="disability_cert_doc">
                        Disability Certificate<span class="required"> *</span>
                    </label>
                    <div class="textBoxOut">
                        <input type="file" id="disability_cert_doc" name="disability_cert_doc" accept=".jpg, .jpeg, .png, .pdf" required>
                        <div class="note">(Only jpeg, jpg, png, and pdf with size 20 KB to 500 KB allowed)</div>
                        <span id="error_disability_cert_doc" style="color: red;"></span>
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
                <!-- Payment Page -->
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
            ];

            $(".fromPlace, .toPlace").autocomplete({
                source: placesInGujarat,
                minLength: 1,
            });
        });


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