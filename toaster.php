<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Style for the toaster alert message */
        .toaster-alert {
            display: none;
            position: fixed;
            top: 90px;
            right: 20px;
            /* background-color: #f0ad4e; */
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            z-index: 9999;
        }
    </style>
</head>
<body>
    <!-- <h1>Welcome to the Example Page!</h1> -->

    <!-- Toaster Alert Container -->
    <div class="toaster-alert" id="toaster"></div>

    <!-- Button to trigger the toaster alert -->
    <!-- <button class="btn btn-primary" onclick="showToaster()">Show Toaster Alert</button> -->

    <!-- <script src="script.js"></script> -->
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
    }, 4000); // 4 seconds
}

</script>