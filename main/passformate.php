<?php
session_start();
include_once '../connection.php';

if (!isset($_POST['education'], $_POST['institute_name'], $_POST['institute_address'], $_POST['address_proof'], $_POST['fullname'], $_POST['address'], $_POST['gender'], $_POST['validate_through'], $_POST['dateofBirth'], $_POST['classOfService'], $_POST['fromPlaceStudent'], $_POST['toPlaceStudent'], $_POST['payment_id'], $_POST['fromDate'], $_POST['toDate'])) {
    die("Required fields are missing.");
}

print_r($_POST);



$education = $_POST['education'];
$institute_name = $_POST['institute_name'];
$institute_address = $_POST['institute_address'];

$education = mysqli_real_escape_string($con, $education);
$institute_name = mysqli_real_escape_string($con, $institute_name);
$institute_address = mysqli_real_escape_string($con, $institute_address);

$qry = "INSERT INTO student (education, Institute_name, Institute_address) VALUES ('$education', '$institute_name', '$institute_address')";
mysqli_query($con, $qry);
$studentInsertedId = mysqli_insert_id($con);

$uploadsDirectory = "../uploads/documents/";

if (!file_exists($uploadsDirectory)) {
    mkdir($uploadsDirectory, 0777, true);
}

if (isset($_FILES["student_address_proof_upload"])) {
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
} else {
    die("Student address proof upload is missing.");
}

$full_name = $_POST['fullname'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$role = 0; // static as student
$validate_through = $_POST['validate_through'];
$dob = $_POST['dateofBirth'];
$uploadsDirectory = "../uploads/user_photo/";

if (!file_exists($uploadsDirectory)) {
    mkdir($uploadsDirectory, 0777, true);
}

if (isset($_FILES["img_std"])) {
    $filename = date('Ymd') . rand(0, 10000) . basename($_FILES["img_std"]["name"]);
    $targetFile = $uploadsDirectory . $filename;

    // if (move_uploaded_file($_FILES["student_address_proof_upload"]["tmp_name"], $targetFile)) {
    //     echo "The file " . basename($_FILES["student_address_proof_upload"]["name"]) . " has been uploaded.";
    // } else {
    //     echo "Sorry, there was an error uploading your file.";
    // }
    if (move_uploaded_file($_FILES["img_std"]["tmp_name"], $targetFile)) {
    } else {
        die("Sorry, there was an error uploading your user image.");
    }

    $user_img_path = $filename;

    $qry = "INSERT INTO passenger_info (full_name, address, document_id, gender, role, r_id, user_id, validate_through, dob, user_img_path) 
            VALUES ('$full_name', '$address', $lastInsertedId, '$gender', $role, $studentInsertedId, {$_SESSION['user_id']}, '$validate_through', '$dob', '$user_img_path')";
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
    $passType = $_POST['passType'];

    $qry = "INSERT INTO pass (passenger_id, user_id, bus_type, start_term_id, ends_term_id, payment_id, image_id, from_date, to_date) VALUES 
            ($passenger_id, {$_SESSION['user_id']}, $bus_type, $start_term_id, $ends_term_id, '$payment_id', $image_id, '$from_date', '$to_date')";

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
        pi.user_id = {$_SESSION['user_id']}";

    $result = mysqli_query($con, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $validate_through = $row['validate_through'];
            $user_id = $row['user_id'];
            $full_name = $row['full_name'];
            $dob = $row['dob'];
            $gender = $row['gender'];
            $user_img_path = $row['user_img_path'];
            $role = $row['role'];
            $address = $row['address'];
            // $bus_type = $row['bus_type'];
            // $start_term_id = $row['start_term_id'];
            // $ends_term_id = $row['ends_term_id'];
        }
    }
} else {
    die("User image upload is missing.");
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont,
                Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif,
                Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
        }

        body {
            background-color: #f4f4f4;
        }

        .form-group {
            background-color: #f8f9fa;
        }

        .btn-downloadpdf,
        .btn-downloadpdf *,
        .btn-downloadpdf :after,
        .btn-downloadpdf :before,
        .btn-downloadpdf:after,
        .btn-downloadpdf:before {
            border: 0 solid;
            box-sizing: border-box;
        }

        .btn-downloadpdf {
            -webkit-tap-highlight-color: transparent;
            -webkit-appearance: button;
            background-color: #000;
            background-image: none;
            color: #fff;
            cursor: pointer;
            
            font-size: 100%;
            line-height: 1.5;
            margin: 0;
            -webkit-mask-image: -webkit-radial-gradient(#000, #fff);
            padding: 0;
        }

        .btn-downloadpdf:disabled {
            cursor: default;
        }

        .btn-downloadpdf:-moz-focusring {
            outline: auto;
        }

        .btn-downloadpdf svg {
            display: block;
            vertical-align: middle;
        }

        .btn-downloadpdf [hidden] {
            display: none;
        }

        .btn-downloadpdf {
            width: 100%;
            border-radius: 10px;
            box-sizing: border-box;
            display: block;
            font-weight: 900;
            overflow: hidden;
            padding: 1.2rem 3rem;
            position: relative;
            text-transform: uppercase;
        }

        .btn-downloadpdf .original {
            background: #000000;
            color: #fff;
            display: grid;
            inset: 0;
            place-content: center;
            position: absolute;
            transition: transform 0.2s cubic-bezier(0.87, 0, 0.13, 1);
        }

        .btn-downloadpdf:hover .original {
            transform: translateY(100%);
        }

        .btn-downloadpdf .letters {
            display: inline-flex;
        }

        .btn-downloadpdf span {
            opacity: 0;
            transform: translateY(-15px);
            transition: transform 0.2s cubic-bezier(0.87, 0, 0.13, 1), opacity 0.2s;
        }

        .btn-downloadpdf span:nth-child(2n) {
            transform: translateY(15px);
        }

        .btn-downloadpdf:hover span {
            opacity: 1;
            transform: translateY(0);
        }

        .btn-downloadpdf:hover span:nth-child(2) {
            transition-delay: 0.1s;
        }

        .btn-downloadpdf:hover span:nth-child(3) {
            transition-delay: 0.2s;
        }

        .btn-downloadpdf:hover span:nth-child(4) {
            transition-delay: 0.3s;
        }

        .btn-downloadpdf:hover span:nth-child(5) {
            transition-delay: 0.4s;
        }

        .btn-downloadpdf:hover span:nth-child(6) {
            transition-delay: 0.5s;
        }

        .btn-downloadpdf:hover span:nth-child(7) {
            transition-delay: 0.6s;
        }

        .btn-downloadpdf:hover span:nth-child(8) {
            transition-delay: 0.7s;
        }

        .btn-downloadpdf:hover span:nth-child(9) {
            transition-delay: 0.8s;
        }

        .btn-downloadpdf:hover span:nth-child(10) {
            transition-delay: 0.9s;
        }

        .btn-downloadpdf:hover span:nth-child(11) {
            transition-delay: 1s;
        }

        .btn-downloadpdf:hover span:nth-child(12) {
            transition-delay: 1.1s;
        }

        .btn-downloadpdf:hover span:nth-child(13) {
            transition-delay: 1.2s;
        }
    </style>
</head>

<body>
    <div class="form-group">
        <section>
            <hr>
            <div class="py-2">
                <section class="my-1">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-6">
                                <img src="../img/buslogo.png" class="img-fluid" style="width: 20%;height: 70% !important;" alt="Your image">
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <h2 class="ml-2 mt-3 text-center">Bus Pass Managment System</h2>
                            </div>
                            <div class="col-lg-3 col-md-3 col-6 text-right">
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
                        <!--  QR CODE  -->
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <p><strong>From Location:</strong> <?php echo $start_term_id; ?></p>
                        <p><strong>To Location:</strong> <?php echo $ends_term_id; ?></p>
                        <p><strong>Address:</strong> <?php echo $institute_address; ?></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="form-group mt-2">
        <button class="btn-downloadpdf" class="form-group" id="download-pdf">
            <div class="original">Download PDF</div>
            <div class="letters">
                <span>D</span>
                <span>O</span>
                <span>W</span>
                <span>N</span>
                <span>L</span>
                <span>O</span>
                <span>A</span>
                <span>D</span>
                <span>-</span>
                <span>P</span>
                <span>D</span>
                <span>F</span>
            </div>
        </button>
    </div>
</body>

<script>
    $(document).ready(function() {
        $("#download-pdf").on("click", function() {
            const element = document.body;
            const pdfOptions = {
                margin: 10,
                filename: 'bus_pass.pdf',
                image: {
                    type: 'png',
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

            try {
                html2pdf().from(element).set(pdfOptions).outputPdf(function(pdf) {
                    const blob = pdf.output('blob');
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'bus_pass.pdf';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    URL.revokeObjectURL(url);
                });
            } catch (error) {
                console.error('PDF generation error:', error);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        console.log("QR code generation function is executing.");
        const qrData = `
    From Date: <?php echo date('d-m-Y', strtotime($from_date)); ?>
    To Date: <?php echo date('d-m-Y', strtotime($to_date)); ?>
    Name: <?php echo $full_name; ?>
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



</html>