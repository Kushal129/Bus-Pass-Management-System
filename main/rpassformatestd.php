<?php
session_start();

include_once '../connection.php';

// print_r($_POST);
if (!isset($_POST['education'], $_POST['institute_name'], $_POST['institute_address'], $_POST['address_proof'], $_POST['fullname'], $_POST['address'], $_POST['gender'], $_POST['validate_through'], $_POST['dateofBirth'], $_POST['classOfService'], $_POST['fromPlaceStudent'], $_POST['toPlaceStudent'], $_POST['payment_id'], $_POST['fromDate'], $_POST['toDate'])) {
    die("Required fields are missing. std pass formate mathi");
}



$uploadsDirectory_very = "../uploads/bonofide/";

if (!file_exists($uploadsDirectory_very)) {
    mkdir($uploadsDirectory_very, 0777, true);
}

$stdbonofide = null;
if (isset($_FILES["verification_s"])) {
    $filenamev = date('Ymd') . rand(0, 10000) . basename($_FILES["verification_s"]["name"]);
    $targetFilev = $uploadsDirectory_very . $filenamev;
    if (move_uploaded_file($_FILES["verification_s"]["tmp_name"], $targetFilev)) {
        $stdbonofide = $filenamev;
    } else {
        die("Sorry, there was an error uploading your file.");
    }
}

$pass_id = $_POST['id'];

$qry_stu_fetch = "select pi.r_id from pass p join passenger_info pi on p.passenger_id = pi.id limit 1";
$run = mysqli_fetch_array(mysqli_query($con, $qry_stu_fetch));
$student_id =  $run[0];
$education = $_POST['education'];
$institute_name = $_POST['institute_name'];
$institute_address = $_POST['institute_address'];

$education = mysqli_real_escape_string($con, $education);
$institute_name = mysqli_real_escape_string($con, $institute_name);
$institute_address = mysqli_real_escape_string($con, $institute_address);

// $qry = "INSERT INTO student (education, Institute_name, Institute_address , bono_pass) VALUES ('$education', '$institute_name', '$institute_address','$stdbonofide')";
$qry = "UPDATE student SET
            education = '$education',
            Institute_name = '$institute_name',
            Institute_address = '$institute_address'";
if ($stdbonofide != null) {
    $qry .= ",bono_pass = '$stdbonofide'";
}

$qry .= "WHERE id = $student_id";

mysqli_query($con, $qry);
$studentUpdatedId = $student_id;

$NewstudentUpdatedId = $studentUpdatedId;

$uploadsDirectory = "../uploads/documents/";


if (!file_exists($uploadsDirectory)) {
    mkdir($uploadsDirectory, 0777, true);
}
$lastInsertedId = null;
if (isset($_FILES["student_address_proof_upload"]) && $_POST['editAddress'] != 'no') {
    $filename = date('Ymd') . rand(0, 10000) . basename($_FILES["student_address_proof_upload"]["name"]);
    $targetFile = $uploadsDirectory . $filename;
    if (move_uploaded_file($_FILES["student_address_proof_upload"]["tmp_name"], $targetFile)) {
    } else {
        die("Sorry, there was an error uploading your file.");
    }

    $document_type_id = $_POST['address_proof'];
    $document_file_name = $filename;

    $document_type_id = mysqli_real_escape_string($con, $document_type_id);
    $document_file_name = mysqli_real_escape_string($con, $document_file_name);

    $qry = "INSERT INTO document (document_type_id, document_file_name) VALUES ('$document_type_id', '$document_file_name')";
    mysqli_query($con, $qry);
    $lastInsertedId = mysqli_insert_id($con);
}

$full_name = $_POST['fullname'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$role = "Student";
$validate_through = $_POST['validate_through'];
$dob = $_POST['dateofBirth'];
$uploadsDirectory = "../uploads/user_photo/";

if (!file_exists($uploadsDirectory)) {
    mkdir($uploadsDirectory, 0777, true);
}
$user_img_path = null;
if (isset($_FILES["img_std"]) && $_FILES["img_std"]["name"] != null) {
    $filename = date('Ymd') . rand(0, 10000) . basename($_FILES["img_std"]["name"]);
    $targetFile = $uploadsDirectory . $filename;
    if (move_uploaded_file($_FILES["img_std"]["tmp_name"], $targetFile)) {
    } else {
        die("Sorry, there was an error uploading your user image.");
    }

    $user_img_path = $filename;
}

// $qry = "INSERT INTO passenger_info (full_name, address, document_id, gender, role, r_id, user_id, validate_through, dob, user_img_path) 
//         VALUES ('$full_name', '$address', $lastInsertedId, '$gender', '$role', $studentUpdatedId, {$_SESSION['user_id']}, '$validate_through', '$dob', '$user_img_path')";
// mysqli_query($con, $qry);
$qry = "UPDATE passenger_info SET
            full_name = '$full_name',
            address = '$address', ";
if ($lastInsertedId != null) {
    $qry .= "document_id = $lastInsertedId,";
}
$qry .= "gender = '$gender',
            role = '$role',
            r_id = $studentUpdatedId,
            user_id = {$_SESSION['user_id']},
            validate_through = '$validate_through',
            dob = '$dob'";
if ($user_img_path != null) {
    $qry  .= ",user_img_path = '$user_img_path'";
}
$qry .= "WHERE r_id = $student_id and role = 'Student'";
mysqli_query($con, $qry);

$qry = "select id from passenger_info where r_id = $student_id and role = 'Student'";
$passenger_info_data = mysqli_fetch_array(mysqli_query($con, $qry));

$passenger_id = $passenger_info_data['id'];
$bus_type = $_POST['classOfService'];
$start_term_id = $_POST['fromPlaceStudent'];
$ends_term_id = $_POST['toPlaceStudent'];
$payment_id = $_POST['payment_id'];
$image_id = 1;
$from_date = $_POST['fromDate'];
$to_date = $_POST['toDate'];
$passType = $_POST['passType'];

$qry = "INSERT INTO pass (passenger_id, user_id,passType ,bus_type, start_term_id, ends_term_id, payment_id, image_id, from_date, to_date) VALUES 
            ($passenger_id, {$_SESSION['user_id']}, $passType ,$bus_type, $start_term_id, $ends_term_id, '$payment_id', $image_id, '$from_date', '$to_date')";

mysqli_query($con, $qry);
$newPassId = mysqli_insert_id($con);


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

// if ($result) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         $user_id = $row['user_id'];
//         $full_name = $row['full_name'];
//         $dob = $row['dob'];
//         $gender = $row['gender'];
//         $validate_through = $row['validate_through'];
//         $user_img_path = $row['user_img_path'];
//         $role = $row['role'];
//         $address = $row['address'];
//     }
// }


// $query = "SELECT bus_name from bus_type where price_multiply =$bus_type";
// $result = mysqli_query($con, $query);
// if ($result) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         $bus_type = $row['bus_name'];
//     }
// }

// $query = "SELECT ter_name from bus_terminals where ter_id=$start_term_id";
// $result = mysqli_query($con, $query);
// if ($result) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         $start_term_id = $row['ter_name'];
//     }
// }


// $query = "SELECT ter_name from bus_terminals where ter_id=$ends_term_id";
// $result = mysqli_query($con, $query);
// if ($result) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         $ends_term_id = $row['ter_name'];
//     }
// }

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
            background-color: black;
            color: white !important;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .redirect-button:hover {
            background-color: #161617;
            color: white;
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