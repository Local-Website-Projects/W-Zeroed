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




/*insert the set_profile data*/
if(isset($_POST['set_profile'])){
    // Start transaction
    $db_handle->startTransaction();

    try {
        $seller_id = $_SESSION['seller_id'];
        $first_name = $db_handle->checkValue($_POST['first_name']);
        $last_name = $db_handle->checkValue($_POST['last_name']);
        $gender = $db_handle->checkValue($_POST['gender']);
        $nationality = $db_handle->checkValue($_POST['nationality']);
        $country = $db_handle->checkValue($_POST['country']);
        $state = $db_handle->checkValue($_POST['state']);
        $city = $db_handle->checkValue($_POST['city']);
        $country_code = $db_handle->checkValue($_POST['country_code']);
        $contact_number = $db_handle->checkValue($_POST['contact_number']);
        $contact_email = $db_handle->checkValue($_POST['contact_email']);
        $job_location = $db_handle->checkValue($_POST['job_location']);
        $global_level_of_education = $db_handle->checkValue($_POST['global_level_of_education']);
        $global_field_of_study = $db_handle->checkValue($_POST['global_field_of_study']);
        $global_gpa = $db_handle->checkValue($_POST['global_gpa']);
        $canadian_level_of_education = $db_handle->checkValue($_POST['canadian_level_of_education']);
        $canadian_field_of_study = $db_handle->checkValue($_POST['canadian_field_of_study']);
        $canadian_college = $db_handle->checkValue($_POST['college']);
        $canadian_study_location = $db_handle->checkValue($_POST['canadian_study_location']);
        $canadian_gpa = $db_handle->checkValue($_POST['canadian_gpa']);

        $image = '';

        if (!empty($_FILES['profile_image']['name'])) {
            $RandomAccountNumber = mt_rand(1, 99999);
            $file_name = $RandomAccountNumber . "_" . $_FILES['profile_image']['name'];
            $file_size = $_FILES['profile_image']['size'];
            $file_tmp  = $_FILES['profile_image']['tmp_name'];

            $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            if ($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg") {
                $attach_files = '';
                echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='Set-Profile';
                </script>";

            } else {
                move_uploaded_file($file_tmp, "assets/profile_image/" . $file_name);
                $image = "assets/profile_image/" . $file_name;
            }
        }

        $insert_personal_value = $db_handle->insertQuery("INSERT INTO `seller_personal_information`(`user_id`, `first_name`, `last_name`, `profile_image`, `gender`, `nationality`, `country`, `state`, `city`, `contact_no`, `country_code`, `contact_email`, `job_preferred_location`, `inserted_at`) VALUES ('$seller_id','$first_name','$last_name','$image','$gender','$nationality','$country','$state','$city','$contact_number','$country_code','$contact_email','$job_location','$inserted_at')");
        if (!$insert_personal_value) {
            throw new Exception("Error inserting dynamic field data.");
        }

        $insert_global_education = $db_handle->insertQuery("INSERT INTO `seller_global_education`(`user_id`, `global_level_of_education`, `global_field_of_study`, `global_gpa`, `inserted_at`) VALUES ('$seller_id','$global_level_of_education','$global_field_of_study','$global_gpa','$inserted_at')");
        if (!$insert_global_education) {
            throw new Exception("Error inserting dynamic field data.");
        }

        $insert_canadian_education = $db_handle->insertQuery("INSERT INTO `seller_canadian_education`(`user_id`, `can_level_of_education`, `can_field_of_study`, `can_college`, `can_location`, `can_gpa`, `inserted_at`) VALUES ('$seller_id','$canadian_level_of_education','$canadian_field_of_study','$canadian_college','$canadian_study_location','$canadian_gpa','$inserted_at')");
        if (!$insert_canadian_education) {
            throw new Exception("Error inserting dynamic field data.");
        }



        // Commit transaction
        $db_handle->commitTransaction();

        // Redirect with success message
        echo "<script>
        document.cookie = 'alert = 3;';
        window.location.href='Seller-Profile';
    </script>";
    } catch (Exception $e) {
        // Rollback transaction on error
        $db_handle->rollbackTransaction();

        // Redirect with error message
        echo "<script>
        document.cookie = 'alert = 5;';
        window.location.href='Set-Profile';
    </script>";
    }
    /*function uploadFile($file, $targetDir) {
    $fileName = basename($file['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Validate file type and size
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mov'];
    if (!in_array($fileType, $allowedTypes)) {
        throw new Exception("Invalid file type.");
    }
    if ($file['size'] > 10 * 1024 * 1024) { // 10MB limit
        throw new Exception("File size exceeds limit.");
    }

    // Upload file
    if (!move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        throw new Exception("Error uploading file.");
    }

    return $targetFilePath;
}*/
}

