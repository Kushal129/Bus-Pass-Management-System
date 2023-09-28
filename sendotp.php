<?php

session_start();

include 'connection.php';
include 'mail_config.php';

$email = $_POST["email"];

    $qry = "SELECT * FROM users WHERE email = '$email'";
    $num = mysqli_num_rows(mysqli_query($con , $qry));

    if ($num != 1) {
      echo "10";
      exit();
  }
  
  $otp = rand(100000, 999999);
  
  $to = $_POST["email"];
  $subject = "Forgot Password Code";
  $message = "<b>Your OTP $otp</b>";
  
  $mail->addAddress($to);
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body = "
      <html>
      <head>
          <style>
          body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding-top: 5px;
            background-color: #fffee8;
            border-radius: 5px;
            box-shadow: 0px 5px 8px rgba(0, 0, 0, 0.7);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        hr{
          background-color: #000000;
          border: none;
          width: 100%;
          height: 1px;
        }
        .otp-code {
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            color: #f00028;
            margin-bottom: 40px;
        }
        .instructions {
            text-align: center;
            font-size: 16px;
            color: #000000;
            margin-bottom: 30px;
        }
        .footer {
            background-color: #faec2f;
            color: rgb(0, 0, 0);
            text-align: center;
            padding: 12px;
            margin-top: 40px;
            

        }
          </style>
      </head>
      <body>
          <div class='container'>
              <div class='header'>
                  <h1>OTP Verification</h1>
                </div>
                <hr>
                <div class='instructions'>
                    <p>Please Use The OTP To Create a New Password</p>
                </div>
              <div class='otp-code'>
                  $message
              </div>
              <div class='footer'>
                &copy; 2023 Bus Pass Managment System.  All rights reserved
              </div>
          </div>
      </body>
      </html>
  ";
  $mail->AltBody = 'Body in plain text for non-HTML mail clients';
  
  try {
      $mail->send();
  
      $user_mail = mysqli_real_escape_string($con, $to);

      $qry = "DELETE FROM otps WHERE email = '$user_mail'";
      mysqli_query($con, $qry);
  
      $qry = "INSERT INTO otps (email, otp) VALUES ('$user_mail', $otp)";
      mysqli_query($con, $qry);
  } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
  }
  
  $_SESSION['temp_mail'] = $to;
  ?>