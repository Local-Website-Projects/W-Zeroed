<?php
session_start();
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$inserted_at = date("Y-m-d H:i:s");

if(isset($_POST['candidate_signup'])){
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $email = $db_handle->checkValue($_POST['email']);
    $password = $db_handle->checkValue($_POST['password']);

    $check_email = $db_handle->numRows("select * from sellers where email = '$email'");

    if($check_email == 0){
        $randomNumber = random_int(100000, 999999);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insert = $db_handle->insertQuery("INSERT INTO `sellers`(`email`, `password`, `verification_code`, `inserted_at`) VALUES ('$email','$hashedPassword','$randomNumber','$inserted_at')");
        if($insert){
            echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='Verify-Email?email=$email';
                </script>";
        } else {
            echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='Login';
                </script>";
        }

        /* $subject = "Email Verification";
         $messege = "<html>
     <body style='background-color: #eee; font-size: 16px;'>
     <div style='max-width: 600px; min-width: 200px; background-color: #ffffff; padding: 20px; margin: auto;'>

         <p style='text-align: center;color:#29a9e1;font-weight:bold'>Email verification code.</p>

         <div style='color:black;text-align: left'>
             <p>Dear,</p>
             <p>Thank you for successfully registering to the Zeroed.</p>
             <p>Your 6 digit code for email verification is: $randomNumber</p>
         </div>
     </div>

     </body>
     </html>";

         $sender_name = "Zeroed";
         $sender_email = "";
         $username = "";
         $password = "";

         $receiver_email1 = $email;

         $mail = new PHPMailer(true);

         try {
             // Set mailer to use SMTP
             $mail->isSMTP();
             $mail->Host = "smtp.hostinger.com";  // SMTP server
             $mail->SMTPAuth = true;
             $mail->SMTPSecure = 'ssl';
             $mail->Port = 465;

             // Sender information
             $mail->setFrom($sender_email, $sender_name);
             $mail->Username = $username;
             $mail->Password = $password;
             $mail->CharSet = 'UTF-8';

             // Set email subject and body
             $mail->Subject = $subject;
             $mail->msgHTML($messege);  // HTML formatted message

             // Send to first email address
             $mail->addAddress($receiver_email1);
             if ($mail->send()) {
                 $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                 $insert = $db_handle->insertQuery("INSERT INTO `sellers`(`email`, `password`, `verification_code`, `inserted_at`) VALUES ('$email','$hashedPassword','$randomNumber','$inserted_at')");
                 if($insert){
                     echo "<script>
                     document.cookie = 'alert = 3;';
                     window.location.href='Verify-Password';
                     </script>";
                 } else {
                     echo "<script>
                     document.cookie = 'alert = 5;';
                     window.location.href='Login';
                     </script>";
                 }
             }
         } catch (Exception $e) {
             echo "<script>
            alert('Error sending email');
             </script>";
             exit;
         }*/
    } else {
        echo "<script>
    document.cookie = 'alert = 5;';
    window.location.href='Register';
</script>";
    }
}

