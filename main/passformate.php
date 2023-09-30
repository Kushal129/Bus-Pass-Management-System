<?php 

include '../connection.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bus Pass | Your Pass</title>
    <link rel="stylesheet" href="../css/user.css">
    <link rel="icon" type="image/ico" href="../img/buslogo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .grid-container {
            display: grid;
        }

        .item1 {
            height: 55px;
            width: 55px;
            grid-column: 1 / span 2;
            grid-row: 1;
        }

        .item2 {
            align-items: center;
            justify-content: center;
            grid-column: 3;
            grid-row: 1 / span 2;
            display: flex;
            margin-right: 17rem;
        }

        .item3 {
            margin-left: 44rem;
        }

        .item4 {
            height: 55px;
            width: 55px;
            grid-column: 1 / span 2;
            grid-row: 1;
        }

        .item5 {
            align-items: center;
            justify-content: center;
            grid-column: 3;
            grid-row: 1 / span 2;
            display: flex;
            margin-right: 17rem;
        }

        .bus-pass {
            width: 60%;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #333;
        }

        .user {
            margin-top: 5rem;
        }

        .img-logo {
            width: 55px;
            height: 55px;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid black;
        }

        .qr {
            margin-left: 40rem;
            margin-top: 22px;
        }
    </style>
</head>

<body>
    <div class="bus-pass" id="content">
        <div class="grid-container">
            <div class="grid-item item1">
                <img src="../img/buslogo.png" alt="Bus Logo" class="img-logo">
            </div>
            <div class="grid-item item2">
                <h1>Bus Pass</h1>
            </div>
        </div>
        <hr>
        <div class="grid-item item3">
            <p>From: <span id="fromDate">August 1, 2023</span></p>
            <p>To: <span id="toDate">August 31, 2023</span></p>
        </div>
        <div class="grid-container">
            <div class="grid-item item4">
                <img src="../img/admin.ico" alt="User Photo">
            </div>
            <div class="qr">
                <div id="qr-code"></div>
            </div>
        </div>
        <div class="grid-container">
            <div class="user">
                <h2>User Details</h2>
                <p><strong>Name:</strong> Kushal Haresbhai Pipaliya </p>
                <p><strong>From Location:</strong> Surat </p>
                <p><strong>To Location:</strong> Bardoli </p>
                <p><strong>Pass Days:</strong> 30 days</p>
                <p><strong>Pass Type:</strong> Express</p>
                <p><strong>Institute Name:</strong> UTU </p>
            </div>
        </div>
    </div>
    <button id="download-pdf">Download PDF</button>
    <script>
        document.getElementById('download-pdf').addEventListener('click', () => {
            const element = document.getElementById('content');
            const options = {
                filename: 'BusPass.pdf',
                margin: 0,
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            };

            html2pdf().set(options).from(element).save();
        });

        document.addEventListener("DOMContentLoaded", function() {
            var userDetails = {
                name: "Kushal Hareshbhai Pipaliya",
                fromLocation: "Surat",
                toLocation: "Bardoli",
                passDays: "30 days",
                passType: "Express",
                instituteName: "UTU"
            };

            var userDetailsJSON = JSON.stringify(userDetails);

            var qrcode = new QRCode(document.getElementById("qr-code"), {
                text: userDetailsJSON,
                width: 200,
                height: 200
            });
        });
    </script>
</body>

</html>