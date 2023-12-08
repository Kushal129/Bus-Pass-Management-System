<?php
session_start();

include_once '../connection.php';

if (!isset($_POST['educationp'], $_POST['company_name'], $_POST['Company_address'], $_POST['address_proofp'], $_POST['fullnamep'], $_POST['addressp'], $_POST['gender'], $_POST['validate_through'], $_POST['dateofBirthp'], $_POST['classOfService_p'], $_POST['fromPlace_p'], $_POST['toPlace_p'], $_POST['payment_id'], $_POST['fromDate_p'], $_POST['toDate_p'])) {
    die("Required fields are missing. passnger passs formate mathi");
}

// print_r($_POST);

$uploadsDirectory_very_p = "../uploads/company/";

if (!file_exists($uploadsDirectory_very_p)) {
    mkdir($uploadsDirectory_very_p, 0777, true);
}

$psgletter = null;
if (isset($_FILES["verification_p"])) {
    $filenamevp = date('Ymd') . rand(0, 10000) . basename($_FILES["verification_p"]["name"]);
    $targetFilevp = $uploadsDirectory_very_p . $filenamevp;
    if (move_uploaded_file($_FILES["verification_p"]["tmp_name"], $targetFilevp)) {
        $companyproof = $filenamevp;
    } else {
        die("Sorry, there was an error uploading your file.");
    }
}

// $passp_id = $_POST['id'];

$qry_psg_fetch = "select pi.r_id from pass p join passenger_info pi on p.passenger_id = pi.id limit 1";
$run = mysqli_fetch_array(mysqli_query($con, $qry_psg_fetch));
$passenger_id =  $run[0];
$educationp = $_POST['educationp'];
$company_name = $_POST['company_name'];
$Company_address = $_POST['Company_address'];

$educationp = mysqli_real_escape_string($con, $educationp);
$company_name = mysqli_real_escape_string($con, $company_name);
$Company_address = mysqli_real_escape_string($con, $Company_address);

// $qry = "INSERT INTO passenger (educationp, com_name, com_address , letter_pass ) VALUES ('$educationp', '$company_name', '$Company_address' ,'$companyproof' )";
$qry = "UPDATE passenger SET 
educationp = '$educationp',
    com_name = '$company_name',
    com_address = '$Company_address'";
if ($psgletter != null) {
    $qry .= ",letter_pass = '$companyproof'";
}

$qry .= "WHERE id = $passenger_id";

mysqli_query($con, $qry);
$pasangerUpdatedId = $passenger_id;

$NewpassangerUpdatedId = $pasangerUpdatedId;


$uploadsDirectory = "../uploads/documents/";

if (!file_exists($uploadsDirectory)) {
    mkdir($uploadsDirectory, 0777, true);
}
$lastInsertedId_p = null;
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
    $lastInsertedId_pp = mysqli_insert_id($con);
}

$full_namep = $_POST['fullnamep'];
$addressp = $_POST['addressp'];
$gender = $_POST['gender'];
$role = "Passenger";
$validate_through = $_POST['validate_through'];
$dobp = $_POST['dateofBirthp'];
$uploadsDirectory = "../uploads/user_photo/";

if (!file_exists($uploadsDirectory)) {
    mkdir($uploadsDirectory, 0777, true);
}
$user_img_path = null;
if (isset($_FILES["img_p"]) && $_FILES["img_p"]["name"] != null) {
    $filename = date('Ymd') . rand(0, 10000) . basename($_FILES["img_p"]["name"]);
    $targetFile = $uploadsDirectory . $filename;
    if (move_uploaded_file($_FILES["img_p"]["tmp_name"], $targetFile)) {
    } else {
        die("Sorry, there was an error uploading your user image.");
    }

    $user_img_path = $filename;
}
// $qry = "INSERT INTO passenger_info (full_name, address, document_id, gender, role, r_id, user_id, validate_through, dob, user_img_path) 
//         VALUES ('$full_namep', '$addressp', $lastInsertedId_pp, '$gender', '$role', $pasangerInsertedId, {$_SESSION['user_id']}, '$validate_through', '$dobp', '$user_img_path')";
// mysqli_query($con, $qry);
$qry = "UPDATE passenger_info SET 
        full_name = '$full_namep',
        address = '$addressp',";
if ($lastInsertedId_p != null) {
    $qry .= "document_id = $lastInsertedId_p,";
}
$qry .= "gender = '$gender',
        role = '$role',
        r_id = $pasangerUpdatedId,
        user_id = {$_SESSION['user_id']},
        validate_through = '$validate_through',
        dob = '$dobp'";
if ($user_img_path != null) {
    $qry .= ",user_img_path = '$user_img_path'";
}

$qry .= "WHERE r_id = $passenger_id and role = 'Passenger'";
mysqli_query($con, $qry);

$qry = "select id from passenger_info where r_id = $passenger_id and role = 'Passenger'";
$passenger_info_data = mysqli_fetch_array(mysqli_query($con, $qry));


$passenger_id = $passenger_info_data['id'];
$bus_type = $_POST['classOfService_p'];
$start_term_id = $_POST['fromPlace_p'];
$ends_term_id = $_POST['toPlace_p'];
$payment_id = $_POST['payment_id'];
$image_id = 2;
$from_datep = $_POST['fromDate_p'];
$to_datep = $_POST['toDate_p'];
$passType = $_POST['passType_p'];

$qry = "INSERT INTO pass (passenger_id, user_id,passType ,bus_type, start_term_id, ends_term_id, payment_id, image_id, from_date, to_date) VALUES 
            ($passenger_id, {$_SESSION['user_id']}, $passType ,$bus_type, $start_term_id, $ends_term_id, '$payment_id', $image_id, '$from_datep', '$to_datep')";

mysqli_query($con, $qry);
$newPassId = mysqli_insert_id($con);

// $psgupdate = "UPDATE passenger SET passp_id = $newPassId WHERE id = $NewpassangerInsertedId";
// mysqli_query($con, $psgupdate);
if ($user_img_path != null) {
    $fid = $_SESSION['user_id'];
    $updateUserImgQuery = "UPDATE users SET user_img_path='$user_img_path' WHERE id=$fid";
    mysqli_query($con, $updateUserImgQuery);
}

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
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        .bus {
            width: 25%;
        }

        .success-message {
            text-align: center;
            margin: 20px 0;
            animation: fadeIn 2s ease-in-out 1s forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .logo-container {
            opacity: 0;
            animation: logoAnimation 2s ease-in-out 1s forwards;
        }

        @keyframes logoAnimation {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                transform: scale(1.2);
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .logo-animation {
            width: 150px;
            height: auto;
        }

        .redirect-button {
            display: flex;
            justify-content: center;
            padding: 10px 20px;
            background-color: rgb(0, 0, 0);
            color: #fff !important;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .redirect-button:hover {
            background-color: rgb(36, 36, 36);
            color: rgb(255, 255, 255);
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="form-group">
        <div class="marquee-container">
            <marquee class="marquee" scrollamount="20" direction="right">
                <img class="bus" src="../img/travel.png" style="float: left;">
            </marquee>
        </div>

        <div class="success-message">
            <h1>Pass Request Submitted Successfully</h1>
            <div class="logo-container" id="logoContainer">
                <img class="logo-animation" src="../img/tik.gif" alt="True">
            </div>
        </div>
        <a onclick="redirectToHome()" class="redirect-button">Go Home</a>
    </div>
</body>

</html>

<script>
    function redirectToHome() {
        window.location.href = "../user/user.php";
    }
</script>
<script>
    function logout() {
        window.location.href = '../logout.php';
    }
    document.getElementById('logout-btn').addEventListener('click', logout);
</script>