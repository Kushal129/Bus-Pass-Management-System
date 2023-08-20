<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>

        .toaster-alert {
            display: none;
            position: fixed;
            top: 90px;
            right: 20px;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            z-index: 9999;
        }
    </style>
</head>
<body>


    <!-- Toaster Alert Container -->
    <div class="toaster-alert" id="toaster"></div>

</body>
</html>
<script>
    // JavaScript code to show the toaster alert
function showToaster(mes , bcolor) {
    var message = mes; // Your message here
    var toaster = document.getElementById("toaster");
    toaster.innerText = message;
    toaster.style.display = "block";
    toaster.style.backgroundColor = bcolor;

    setTimeout(function () {
        toaster.style.display = "none";
    }, 4000); 
}

</script>