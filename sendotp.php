<?php

session_start();

include 'connection.php';
include 'mail_config.php';

$email = $_POST["email"];

    $qry = "SELECT * FROM users WHERE email = '$email'";
    $num = mysqli_num_rows(mysqli_query($con , $qry));

    if ($num != 1 ){
        echo "0";
        exit();
    } 

  // Generate a random 6-digit OTP
  $otp = rand(100000, 999999);

  // Send the OTP to the user's email
  $to = $_POST["email"];
  $subject = "Your Lgin Code";
  $message = "Your OTP code is: $otp";
  // mail("", $subject, $message);



  $mail->setFrom('from@gfg.com', 'Name');           // Set sender of the mail
  $mail->addAddress($to);           // Add a recipient
  // $mail->addAddress('receiver2@gfg.com', 'Name');   // Name is optional

  $mail->isHTML(true);
  $mail->Subject = "$subject";
  $mail->Body    = "OTP  <b> $otp</b>!";
  $mail->AltBody = 'Body in plain text for non-HTML mail clients';

  $mail->send();

  $user_mail = $to ;
try {
    $qry = "DELETE FROM otps WHERE email = '$user_mail'";
    mysqli_query($con, $qry);

    $qry = "insert into otps (email, otp) values('$user_mail' , $otp )";
    mysqli_query($con, $qry);
}
catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}
  // echo "<h1>OTP Sent</h1>";

$_SESSION['temp_mail'] = $to;

?>