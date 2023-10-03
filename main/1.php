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
$user_id = $_SESSION['user_id'] ; // need to take from session
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
mysqli_query($con,$qry);
$pasangerInsertedId = mysqli_insert_id($con);  


$passenger_id = $pasangerInsertedId;
$bus_type = $_POST['classOfService'];
$start_term_id = $_POST['fromPlaceStudent'];
$ends_term_id = $_POST['toPlaceStudent'];
$payment_id = $_POST['payment_id'];
$image_id = 1;

$qry = "INSERT INTO pass (passenger_id, user_id, bus_type, start_term_id, ends_term_id, payment_id, image_id) VALUES 
( $passenger_id, $user_id, $bus_type, $start_term_id, $ends_term_id, $payment_id, $image_id) ";
mysqli_query($con,$qry);