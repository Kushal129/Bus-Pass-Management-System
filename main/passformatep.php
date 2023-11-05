<?php
session_start();

include_once '../connection.php';

if (!isset($_POST['educationp'], $_POST['company_name'], $_POST['Company_address'], $_POST['address_proofp'], $_POST['fullnamep'], $_POST['addressp'], $_POST['gender'], $_POST['validate_through'], $_POST['dateofBirthp'], $_POST['classOfService_p'], $_POST['fromPlace_p'], $_POST['toPlace_p'], $_POST['payment_id'], $_POST['fromDate_p'], $_POST['toDate_p'])) {
    die("Required fields are missing. passnger passs formate mathi");
}

print_r($_POST);

$user_id = $_SESSION['user_id'];
$educationp = $_POST['educationp'];
$company_name = $_POST['company_name'];
$Company_address = $_POST['Company_address'];

$educationp = mysqli_real_escape_string($con, $educationp);
$company_name = mysqli_real_escape_string($con, $company_name);
$Company_address = mysqli_real_escape_string($con, $Company_address);

$qry = "INSERT INTO passenger (educationp, com_name, com_address ) VALUES ('$educationp', '$company_name', '$Company_address' )";
mysqli_query($con, $qry);
$pasangerInsertedId = mysqli_insert_id($con);

$uploadsDirectory = "../uploads/documents/";

if (!file_exists($uploadsDirectory)) {
    mkdir($uploadsDirectory, 0777, true);
}

if (isset($_FILES["passanger_address_proof_upload"])) {
    $filename = date('Ymd') . rand(0, 10000) . basename($_FILES["passanger_address_proof_upload"]["name"]);
    $targetFile = $uploadsDirectory . $filename;
    if (move_uploaded_file($_FILES["passanger_address_proof_upload"]["tmp_name"], $targetFile)) {
    } else {
        die("Sorry, there was an error uploading your file.");
    }

    $document_type_id = $_POST['address_proofp'];
    $document_file_name = $filename;

    $document_type_id = mysqli_real_escape_string($con, $document_type_id);
    $document_file_name = mysqli_real_escape_string($con, $document_file_name);

    $qry = "INSERT INTO document (document_type_id, document_file_name) VALUES ('$document_type_id', '$document_file_name')";
    mysqli_query($con, $qry);
    $lastInsertedIdp = mysqli_insert_id($con);
} else {
    die("Student address proof upload is missing.");
}

$full_namep = $_POST['fullnamep'];
$addressp = $_POST['addressp'];
$gender = $_POST['gender'];
$role = "passenger";
$validate_through = $_POST['validate_through'];
$dobp = $_POST['dateofBirthp'];
$uploadsDirectory = "../uploads/user_photo/";

if (!file_exists($uploadsDirectory)) {
    mkdir($uploadsDirectory, 0777, true);
}

if (isset($_FILES["img_p"])) {
    $filename = date('Ymd') . rand(0, 10000) . basename($_FILES["img_p"]["name"]);
    $targetFile = $uploadsDirectory . $filename;
    if (move_uploaded_file($_FILES["img_p"]["tmp_name"], $targetFile)) {
    } else {
        die("Sorry, there was an error uploading your user image.");
    }

    $user_img_path = $filename;

    $qry = "INSERT INTO passenger_info (full_name, address, document_id, gender, role, r_id, user_id, validate_through, dob, user_img_path) 
            VALUES ('$full_namep', '$addressp', $lastInsertedIdp, '$gender', '$role', $pasangerInsertedId, {$_SESSION['user_id']}, '$validate_through', '$dobp', '$user_img_path')";
    mysqli_query($con, $qry);
    $pasangerInsertedId = mysqli_insert_id($con);

    $passenger_id = $pasangerInsertedId;
    $bus_type = $_POST['classOfService_p'];
    $start_term_id = $_POST['fromPlace_p'];
    $ends_term_id = $_POST['toPlace_p'];
    $payment_id = $_POST['payment_id'];
    $image_id = 1;
    $from_datep = $_POST['fromDate_p'];
    $to_datep = $_POST['toDate_p'];
    $passType = $_POST['passType_p'];

    $qry = "INSERT INTO pass (passenger_id, user_id,passType ,bus_type, start_term_id, ends_term_id, payment_id, image_id, from_date, to_date) VALUES 
            ($passenger_id, {$_SESSION['user_id']}, $passType ,$bus_type, $start_term_id, $ends_term_id, '$payment_id', $image_id, '$from_datep', '$to_datep')";

    mysqli_query($con, $qry);

    $frussian = $_SESSION['user_id'];
    $updateUserImgQuery = "UPDATE users SET user_img_path='$user_img_path' WHERE id=$frussian";
    mysqli_query($con, $updateUserImgQuery);

    $query = "SELECT
        pi.validate_through,
        pi.gender,
        pi.dob,
        pi.user_img_path,
        pi.role,
        pi.user_id,
        pi.address,
        pi.full_name
    FROM
        passenger_info AS pi
    WHERE
        pi.user_id = {$_SESSION['user_id']}";

    $result = mysqli_query($con, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $full_namep = $row['full_name'];
            $dobp = $row['dob'];
            $validate_through = $row['validate_through'];
            $user_id = $row['user_id'];
            $gender = $row['gender'];
            $user_img_path = $row['user_img_path'];
            $role = $row['role'];
            $address = $row['address'];
        }
    }
} else {
    die("User image upload is missing.");
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
                                <hr>
                                <h4 class="ml-2 mt-3 text-center"><?php echo $role ?></h4>
                            </div>
                            <div class="col-lg-3 col-md-3 col-6 text-right">
                                <p><strong>User Id: </strong> <?php echo  $user_id ?></p>
                                <p><strong>From Date:</strong> <?php echo date('d-m-Y', strtotime($from_datep)); ?></p>
                                <p><strong>To Date:</strong> <?php echo date('d-m-Y', strtotime($to_datep)); ?></p>
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
                        <p><strong>Name:</strong> <?php echo $full_namep; ?></p>
                        <p><strong>Gender:</strong> <?php echo $gender; ?></p>
                        <p><strong>Date of Birth:</strong> <?php echo date('d-m-Y', strtotime($dobp)); ?></p>
                        <hr style="width: 60%!important;">
                        <p><strong>Pass Type:</strong> <?php echo $bus_type; ?></p>
                        <p><strong>Pass Days:</strong> <?php echo $passType; ?></p>
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
                        <p><strong>Address:</strong> <?php echo $Company_address; ?></p>
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
    Pass: <?php echo $role; ?>
    From Date: <?php echo date('d-m-Y', strtotime($from_datep)); ?>
    To Date: <?php echo date('d-m-Y', strtotime($to_datep)); ?>
    Name: <?php echo $full_namep; ?>
    Gender: <?php echo $gender; ?>
    Pass Type: <?php echo $bus_type; ?>
    Pass Days: <?php echo $passType; ?>
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
        window.location.href = "../user/user.php";
    }
</script>

<script>
    function generatePDF() {
        window.print();
    }
</script>