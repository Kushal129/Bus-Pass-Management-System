<?php
session_start();

$user_id = $_SESSION['user_id'];

include_once '../connection.php';

// $qry = 'SELECT *
//         FROM passenger_info AS pi
//         INNER JOIN pass AS p ON pi.id = p.passenger_id ';

$qry = 'SELECT pi.*, p.*, s.Institute_address
        FROM passenger_info AS pi
        INNER JOIN pass AS p ON pi.id = p.passenger_id
        INNER JOIN student AS s ON pi.user_id = s.user_id';

$result = $con->query($qry);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_img_path = $row['user_img_path'];
        $full_name = $row['full_name'];
        $gender = $row['gender'];
        $dob = $row['dob'];
        $bus_type = $row['bus_type'];
        $Institute_address = $row['Institute_address'];
        $start_term_id = $row['start_term_id'];
        $ends_term_id = $row['ends_term_id'];
        $from_date = $row['from_date'];
        $to_date = $row['to_date'];
        $passType = $row['passType'];
    }
}
$query = "SELECT bus_name from bus_type where price_multiply =$bus_type";
$result = mysqli_query($con, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bus_type = $row['bus_name'];
    }
}

$query = "SELECT ter_name from bus_terminals where ter_id=$start_term_id";
$result = mysqli_query($con, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $start_term_id = $row['ter_name'];
    }
}


$query = "SELECT ter_name from bus_terminals where ter_id=$ends_term_id";
$result = mysqli_query($con, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $ends_term_id = $row['ter_name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bus Pass | Your Pass</title>
    <link rel="stylesheet" href="../css/passformate.css">
    <link rel="stylesheet" href="../css/user.css">
    <link rel="icon" type="image/ico" href="../img/buslogo.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f4f4f4;
        }

        .form-group {
            background-color: #f8f9fa;
        }

        button.btn-download_pdf {
            width: 50%;
            padding: 10px;
            background-color: black;
            color: white;
        }

        @media print {
            .btn-download_pdf {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="form-group" id="pdf-content">
        <section>
            <hr>
            <div class="py-2">
                <section class="my-1">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-6">
                                <img src="../img/buslogo.png" class="img-fluid" style="width: 30%;height: 70% !important;" alt="Your image">
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <h2 class="ml-2 mt-3 text-center">Bus Pass Managment System</h2>
                            </div>
                            <div class="col-lg-3 col-md-3 col-6 text-right">
                                <p><strong>User Id: </strong> <?php echo  $user_id ?></p>
                                <p><strong>From Date:</strong> <?php echo date('d-m-Y', strtotime($from_date)); ?></p>
                                <p><strong>To Date:</strong> <?php echo date('d-m-Y', strtotime($to_date)); ?></p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <hr>
            <div class="container-fluid py-2">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12" style="display: flex; justify-content: center;">
                        <img src="../uploads/user_photo/<?php echo $user_img_path; ?>" alt="User Photo" style="width: 300px;height: 250px !important;" class="img-fluid  ">
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <p><strong>Name:</strong> <?php echo $full_name; ?></p>
                        <p><strong>Gender:</strong> <?php echo $gender; ?></p>
                        <p><strong>Date of Birth:</strong> <?php echo date('d-m-Y', strtotime($dob)); ?></p>
                        <hr style="width: 60%!important;">
                        <p><strong>Pass Type:</strong> <?php echo $bus_type; ?></p>
                        <p><strong>Pass Type:</strong> <?php echo $passType; ?></p>

                    </div>
                </div>
            </div>
        </section>
        <hr style="width: 70%;margin-left: 15em;">
        <section class="my-5">
            <div class="container-fluid">
                <div class="row">
                    <div id="qrcode-container" style="display: flex;justify-content: center;width: 40%;height: 250px !important;" class="col-lg-6 col-md-6 col-12">
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <p><strong>From Location:</strong> <?php echo $start_term_id; ?></p>
                        <p><strong>To Location:</strong> <?php echo $ends_term_id; ?></p>
                        <p><strong>Address:</strong> <?php echo $Institute_address; ?></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="form-group mt-2">
        <div class="container-fluid py-2">
            <div class="row">
                <button class="btn-download_pdf col-lg-6 col-md-6 col-12" class="form-group" id="home-button" onclick="redirectToHome()">Home</button>
                <button class="btn-download_pdf col-lg-6 col-md-6 col-12" class="form-group" id="download-pdf-button" onclick="generatePDF()">Download PDF</button>
            </div>
        </div>
</body>

</html>

<script>
    $(document).ready(function() {
        console.log("QR code generation function is executing.");
        const qrData = `
    From Date: <?php echo date('d-m-Y', strtotime($from_date)); ?>
    To Date: <?php echo date('d-m-Y', strtotime($to_date)); ?>
    Name: <?php echo $full_name; ?>
    Gender: <?php echo $gender; ?>
    Pass Type: <?php echo $bus_type; ?>
    Pass Type: <?php echo $passType?>
    From Location: <?php echo $start_term_id; ?>
    To Location: <?php echo $ends_term_id; ?>
`;

        console.log("QR Data:", qrData);

        const qrcodeContainer = document.getElementById("qrcode-container");
        if (qrcodeContainer) {
            const qrcode = new QRCode(qrcodeContainer, {
                text: qrData,
            });
        } else {
            console.error("QR code container not found.");
        }
    });
</script>
<script>
    function redirectToHome() {
        window.location.href = "../user/Managepass.php";
    }
</script>

<script>
    function generatePDF() {
        window.print();
    }
</script>