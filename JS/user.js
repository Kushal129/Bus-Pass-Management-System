$(document).ready(function () {
    $('.form').hide();

    function showForm(selectedCategory) {
        $('#' + selectedCategory + 'Form').show();
    }

    $('#new_pass').click(function () {
        $('.pass-page-container').show();

        var selectedCategory = $('#category option:first').val();
        console.log("Selected Category:", selectedCategory);

        showForm(selectedCategory);
    });

    $('#category').change(function () {
        var selectedCategory = $(this).val();
        console.log("Selected Category:", selectedCategory);
        $('.form').hide();

        showForm(selectedCategory);
        console.log("Displaying Form:", $('#' + selectedCategory + 'Form'));
    });

    var defaultCategory = $('#category').val();
    showForm(defaultCategory);
});

$(document).on('change', "#dateofBirth", function () {
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

$(document).on('change', "#fromDate", function () {
    updateToDate();
});

$(document).on('change', "#passType", function () {
    updateToDate();
});


$(document).ready(function () {
    const addFileInputValidation = (inputId, errorId, maxSizeKB) => {
        $(inputId).on('change', function () {
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
    };

    addFileInputValidation('#img_std', '#photo-upload-error-student', 200);
    addFileInputValidation('#student_address_proof_upload', '#address-proof-error-student', 200);

    addFileInputValidation('#img_passenger', '#photo-upload-error-passenger', 200);
    addFileInputValidation('#passenger_address_proof_upload', '#address-proof-error-passenger', 200);

    addFileInputValidation('#handicap_photo', '#photo-upload-error-handicap', 200);
    addFileInputValidation('#handicap_address_proof_upload', '#address-proof-upload-error-handicap', 200);

    addFileInputValidation('#disability_cert_doc_handicap', '#error_disability_cert_doc_handicap', 500);

    $('input[name="have_disability_cert"]').on('change', function () {
        var disabilityCertField = $('.disabilitycert');
        if ($(this).val() === "1") {
            disabilityCertField.show();
        } else {
            disabilityCertField.hide();
        }
    });

    var checkboxes = document.querySelectorAll('input[name="disability_area[]"]');
    var selectedData = document.getElementById('selectedData');

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            updateSelectedData();
        });
    });

    function updateSelectedData() {
        var selectedValues = [];
        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                selectedValues.push(checkbox.value);
            }
        });
        selectedData.value = selectedValues.join(', ');
    }

    function redirectToPayment() {
        window.location.href = "../main/payment.php";
    }
});
