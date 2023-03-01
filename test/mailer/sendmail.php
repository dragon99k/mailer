<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/phpmailer/src/Exception.php';
require './phpmailer/phpmailer/src/PHPMailer.php';
require './phpmailer/phpmailer/src/SMTP.php';

//Load Composer's autoloader
require './autoload.php';

//get MailData
$email = $_POST['email'];
$content = $_POST['content'];
$mailType = $_POST['mailType'];


$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                                          //Enable verbose debug output
    $mail->isSMTP();                                                                //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                             //Set the SMTP server to send through
    $mail->SMTPAuth = true;
    $mail->Username   = 'example@gmail.com';                                           //SMTP username
    $mail->Password   = 'password';                                             //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                                //Enable implicit TLS encryption
    $mail->Port       = 587;                                                        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->CharSet    = PHPMailer::CHARSET_UTF8;  
    $mail->SMTPKeepAlive = true;
    $mail->Mailer        = 'smtp';
    $mail->Encoding      = "7bit";

    //Recipients
    $mail->setFrom('info@xxx.com', '株式会社XXX');
    $mail->addAddress($email, $_POST['email']);      //Add a recipient
    $mail->addReplyTo('info@example.com', 'Information');

    //Content
    if(strcmp($mailType, "html") == 0)
        $mail->isHTML(true);                                                            //Set email format to HTML
    else $mail->isHTML(false);

    $mail->Subject = 'Test of PHP Mailer';
    $mail->Body    = $content;

    $mail->send();

    echo 'Message has been sent!';
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error:";
}

$mail->smtpClose();



//Create an instance; passing `true` enables exceptions


