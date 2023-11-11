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

if (isset($_FILES["verification_p"])) {
    $filenamevp = date('Ymd') . rand(0, 10000) . basename($_FILES["verification_p"]["name"]);
    $targetFilevp = $uploadsDirectory_very_p . $filenamevp;
    if (move_uploaded_file($_FILES["verification_p"]["tmp_name"], $targetFilevp)) {
        $companyproof = $filenamevp;
    } else {
        die("Sorry, there was an error uploading your file.");
    }
} else {
    die("Student address proof upload is missing.");
}

$pass_id = $_SESSION['user_id'];
$educationp = $_POST['educationp'];
$company_name = $_POST['company_name'];
$Company_address = $_POST['Company_address'];

$educationp = mysqli_real_escape_string($con, $educationp);
$company_name = mysqli_real_escape_string($con, $company_name);
$Company_address = mysqli_real_escape_string($con, $Company_address);

$qry = "INSERT INTO passenger (educationp, com_name, com_address , letter_pass ) VALUES ('$educationp', '$company_name', '$Company_address' ,'$companyproof' )";
mysqli_query($con, $qry);
$pasangerInsertedId = mysqli_insert_id($con);
$NewpassangerInsertedId = $pasangerInsertedId;

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
$role = "Passenger";
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
    $newPassId = mysqli_insert_id($con);

    $psgupdate = "UPDATE passenger SET pass_id = $newPassId WHERE id = $NewpassangerInsertedId";
    mysqli_query($con, $psgupdate);

    $fid = $_SESSION['user_id'];
    $updateUserImgQuery = "UPDATE users SET user_img_path='$user_img_path' WHERE id=$fid";
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
            color: #fff;
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