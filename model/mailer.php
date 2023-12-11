<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/vendor/autoload.php";

$mail = new PHPMailer(true);

// Cấu hình để hiển thị lỗi chi tiết
$mail->SMTPDebug = SMTP::DEBUG_SERVER;

// Sử dụng SMTP
$mail->isSMTP();
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;											
$mail->Host	 = 'smtp.gmail.com';					
$mail->SMTPAuth = true;							
$mail->Username = 'user@example.com';				
$mail->Password = 'password';						
$mail->SMTPSecure = 'tls';							
$mail->Port	 = 587;
$mail->isHTML(true);								


return $mail;