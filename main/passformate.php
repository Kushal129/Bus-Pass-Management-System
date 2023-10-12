<?php

session_start();
include_once '../connection.php';

print_r($_POST);


$education = $_POST['education'];
$Institute_name = $_POST['institute_name'];
$Institute_address = $_POST['institute_address'];
$qry = "INSERT INTO student (education, Institute_name, Institute_address) VALUES ('$education', '$Institute_name', '$Institute_address')";
mysqli_query($con, $qry);
$studentInsertedId = mysqli_insert_id($con);


$uploadsDirectory = "../uploads/documents/";

if (!file_exists($uploadsDirectory)) {
    mkdir($uploadsDirectory, 0777, true);
}


$filename = date('Ymd') . rand(0, 10000) . basename($_FILES["student_address_proof_upload"]["name"]);
$targetFile = $uploadsDirectory . $filename;
move_uploaded_file($_FILES["student_address_proof_upload"]["tmp_name"], $targetFile);

// if (move_uploaded_file($_FILES["student_address_proof_upload"]["tmp_name"], $targetFile)) {
//     echo "The file " . basename($_FILES["student_address_proof_upload"]["name"]) . " has been uploaded.";
// } else {
//     echo "Sorry, there was an error uploading your file.";
// }

$document_type_id = $_POST['address_proof'];
$document_file_name = $filename;
$qry = "INSERT INTO document (document_type_id, document_file_name) VALUES ($document_type_id, '$document_file_name')";
mysqli_query($con, $qry);
$lastInsertedId = mysqli_insert_id($con);  // give a id for document


$full_name = $_POST['fullname'];
$address = $_POST['address'];
$document_id = $lastInsertedId; // need to fetch
$gender = $_POST['gender'];
$role = 0; // static as student
$r_id = $studentInsertedId; // need to fetch from database based on pervious query,
$user_id = $_SESSION['user_id']; // need to take from session
$validate_through = $_POST['validate_through'];
$dob = $_POST['dateofBirth'];

//user_img_path
// file upload

$uploadsDirectory = "../uploads/user_photo/";

if (!file_exists($uploadsDirectory)) {
    mkdir($uploadsDirectory, 0777, true);
}

$filename = date('Ymd') . rand(0, 10000) . basename($_FILES["img_std"]["name"]);
$targetFile = $uploadsDirectory . $filename;
move_uploaded_file($_FILES["img_std"]["tmp_name"], $targetFile);

$user_img_path = $filename;

$qry = "INSERT INTO passenger_info( full_name, address, document_id, gender, role, r_id, user_id, validate_through, dob, user_img_path) 
VALUES ('$full_name', '$address', $document_id, '$gender', $role, $r_id, $user_id, '$validate_through', '$dob', '$user_img_path')";
mysqli_query($con, $qry);
$pasangerInsertedId = mysqli_insert_id($con);


$passenger_id = $pasangerInsertedId;
$bus_type = $_POST['classOfService'];
$start_term_id = $_POST['fromPlaceStudent'];
$ends_term_id = $_POST['toPlaceStudent'];
$payment_id = $_POST['payment_id'];
$image_id = 1;
$from_date = $_POST['fromDate'];
$to_date = $_POST['toDate'];

$qry = "INSERT INTO pass (passenger_id, user_id, bus_type, start_term_id, ends_term_id, payment_id, image_id, from_date, to_date) VALUES 
( $passenger_id, $user_id, $bus_type, $start_term_id, $ends_term_id, '$payment_id', $image_id, '$from_date', '$to_date') ";

mysqli_query($con, $qry);

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
    pi.user_id = $user_id";


$result = mysqli_query($con, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Access data from the $row variable
        $validate_through = $row['validate_through'];
        $user_id = $row['user_id'];
        $full_name = $row['full_name'];
        $dob = $row['dob'];
        $gender = $row['gender'];
        $user_img_path = $row['user_img_path'];
        $role = $row['role'];
        $address = $row['address'];
        $bus_type = $row['bus_type'];
        $start_term_id = $row['start_term_id'];
        $ends_term_id = $row['ends_term_id'];

        // Display the data as needed in your HTML
    }
}

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

        .passport-photo {
            width: 250px;
            height: 270px;
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
            <!-- <p>From: <span id="fromDate">August 1, 2023</span></p>
            <p>To: <span id="toDate">August 31, 2023</span></p> -->
            <p><strong>From Date:</strong> <?php echo date('d-m-Y', strtotime($from_date)); ?></p>
            <p><strong>To Date:</strong> <?php echo date('d-m-Y', strtotime($to_date)); ?></p>

        </div>
        <div class="grid-container">
            <div class="grid-item item4">
                <img src="../uploads/user_photo/<?php echo $user_img_path; ?>" alt="User Photo" class="passport-photo">
            </div>
            <div class="qr">
                <div id="qr-code"></div>
            </div>
        </div>
        <div class="grid-container">
            <div class="user">
                <h2>User Details</h2>
                <p><strong>Name:</strong> <?php echo $full_name; ?></p>
                <p><strong>Gender:</strong> <?php echo $gender; ?></p>
                <p><strong>Date of Birth:</strong> <?php echo $dob; ?></p>
                <p><strong>Address:</strong> <?php echo $address; ?></p>
                <p><strong>From Date:</strong> <?php echo $from_date; ?></p>
                <p><strong>To Date:</strong> <?php echo $to_date; ?></p>
                <p><strong>Pass Type:</strong> <?php echo $bus_type; ?></p>
                <p><strong>From Location:</strong> <?php echo $start_term_id; ?></p>
                <p><strong>To Location:</strong> <?php echo $ends_term_id; ?></p>
                <p><strong>Pass Days:</strong> <?php echo $passDays; ?></p>
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