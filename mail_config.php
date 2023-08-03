
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer();
try {
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = 'db31672e24c341';
    $mail->Password = '550f9030710df7';

    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
} catch (Exception $e) {
    $e->getMessage();
}
?>
