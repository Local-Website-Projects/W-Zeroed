<?php
session_start();
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$inserted_at = date("Y-m-d H:i:s");

if(isset($_GET['job'])){
    $job_id = $_GET['job'];
    $fetch_data = $db_handle->runQuery("select * from seller_experience_data where seller_experience_id = '$job_id'");
    $user_id = $fetch_data[0]['user_id'];
    $start_date = $fetch_data[0]['start_date'];
    $start_date = new DateTime($start_date);
    $start_date = $start_date->format('d M, Y');
    if($fetch_data[0]['end_date'] == '0000-00-00'){
        $end_date = 'Working till now.';
    } else{
        $end_date = $fetch_data[0]['end_date'];
        $end_date = new DateTime($end_date);
        $end_date = $end_date->format('d M, Y');
    }
    $fetch_personal_data = $db_handle->runQuery("select first_name, last_name, contact_email from seller_personal_information where user_id = '$user_id'");
    $subject = "Request for job experience verification";
    $messege = "<html>
     <body style='background-color: #eee; font-size: 16px;'>
     <div style='max-width: 600px; min-width: 200px; background-color: #ffffff; padding: 20px; margin: auto;'>
         <p style='text-align: center;color:#29a9e1;font-weight:bold'>Job Experience Verification</p>
         <p>Dear {$fetch_data[0]['name_job']}</p>
         <div style='color:black;text-align: left'>
             <p>{$fetch_personal_data[0]['first_name']} {$fetch_personal_data[0]['last_name']}, contact email: {$fetch_personal_data[0]['contact_email']} has requested you to
             verify his/her job experience. The datails are:</p>
             <p>Designation: {$fetch_data[0]['job_designation']}</p>
             <p>Company Name: {$fetch_data[0]['company_name']}</p>
             <p>Company Website: {$fetch_data[0]['company_website']}</p>
             <p>Start Date: {$start_date}</p>
             <p>Start Date: {$end_date}</p>
             <p>If you want to verify this job experience please click on the following verify button: <a href='https://dotest.click/Job-Experience-Verification?id={$job_id}' target='_blank'>Verify</a></p>
         </div>
     </div>

     </body>
     </html>";

    $sender_name   = 'Zeroed';
    $sender_email  = 'zeroedinnovation@gmail.com';      // Sender's Gmail
    $username      = 'zeroedinnovation@gmail.com';      // Same as sender_email
    $password      = 'tlga ulhb btps jdxu';         // App Password from Google

    $receiver_email1 = $fetch_data[0]['email_job'];

    $mail = new PHPMailer(true);

    try {
        // Set mailer to use SMTP
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";  // SMTP server
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
                echo "<script>
                     document.cookie = 'alert = 3;';
                     window.location.href ='Seller-Profile';
                     </script>";

        }
    } catch (Exception $e) {
        echo "<script>
            alert('Error sending email');
             </script>";
        exit;
    }
} else{
    echo "
    <script>
    window.location.href = 'Login';
</script>
    ";
}