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

    function generateUniqueRandomString($length = 12) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        $maxIndex = strlen($characters) - 1;

        // Add a timestamp to ensure uniqueness
        $timestamp = microtime(true);  // Get the current timestamp with microsecond precision

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $maxIndex)];
        }

        // Combine the timestamp with the random string for uniqueness
        return substr(md5($randomString . $timestamp), 0, $length);  // Optional: Return only the first 12 chars
    }

    if($check_email == 0){
        $unique_id = generateUniqueRandomString();
        $randomNumber = random_int(100000, 999999);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insert = $db_handle->insertQuery("INSERT INTO `sellers`(`email`, `password`, `verification_code`, `inserted_at`,`unique_id`) VALUES ('$email','$hashedPassword','$randomNumber','$inserted_at','$unique_id')");
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
        /*personal information*/
        $seller_id = $_SESSION['seller_id'];
        $first_name = $db_handle->checkValue($_POST['first_name']);
        $last_name = $db_handle->checkValue($_POST['last_name']);
        $gender = $db_handle->checkValue($_POST['gender']);
        $nationality = $db_handle->checkValue($_POST['nationality']);
        $country = $db_handle->checkValue($_POST['country']);
        $state = $db_handle->checkValue($_POST['state_name']);
        $city = $db_handle->checkValue($_POST['city_name']);
        $country_code = $db_handle->checkValue($_POST['country_code']);
        $contact_number = $db_handle->checkValue($_POST['contact_number']);
        $contact_email = $db_handle->checkValue($_POST['contact_email']);
        $preferred_job_location = $db_handle->checkValue($_POST['preferred_job_location']);

        /*global education section*/
        $global_level_of_education = $db_handle->checkValue($_POST['global_level_of_education']);
        $global_field_of_study = $db_handle->checkValue($_POST['global_field_of_study']);
        $global_gpa = $db_handle->checkValue($_POST['global_gpa']);

        /*canadian education section*/
        $canadian_level_of_education = $db_handle->checkValue($_POST['canadian_level_of_education']);
        $canadian_field_of_study = $db_handle->checkValue($_POST['canadian_field_of_study']);
        $canadian_college = $db_handle->checkValue($_POST['college']);
        $canadian_study_location = $db_handle->checkValue($_POST['canadian_study_location']);
        $canadian_gpa = $db_handle->checkValue($_POST['canadian_gpa']);

        /*Skills section*/
        $core_skill_one = $db_handle->checkValue($_POST['core_skill_one']);
        $core_skill_two = $db_handle->checkValue($_POST['core_skill_two']);
        $core_skill_three = $db_handle->checkValue($_POST['core_skill_three']);

        $sub_skills_one = $_POST['sub_skills_one'];
        $sub_skills_one = explode(',', $sub_skills_one);
        $sub_skills_one = array_map('trim', $sub_skills_one);

        $sub_skills_two = $_POST['sub_skills_two'];
        $sub_skills_two = explode(',', $sub_skills_two);
        $sub_skills_two = array_map('trim', $sub_skills_two);

        $sub_skills_three = $_POST['sub_skills_three'];
        $sub_skills_three = explode(',', $sub_skills_three);
        $sub_skills_three = array_map('trim', $sub_skills_three);

        /*job experience section*/
        $industry = $_POST['industry'];
        $sub_industry = $_POST['sub_industry'];
        $countries = $_POST['countries'];
        $job_location = $_POST['job_location'];
        $company_name = $_POST['company_name'];
        $company_website = $_POST['company_website'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $accomplishment = $_POST['accomplishment'];
        $reporting_manager = $_POST['reporting_manager'];
        $designation = $_POST['designation'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $till_date = $_POST['till_date'];


        /*career section*/
        $career_role = $db_handle->checkValue($_POST['career_role']);
        $career_industry = $db_handle->checkValue($_POST['career_industry']);
        $noc_number = $db_handle->checkValue($_POST['noc_number']);


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

        $insert_personal_value = $db_handle->insertQuery("INSERT INTO `seller_personal_information`(`user_id`, `first_name`, `last_name`, `profile_image`, `gender`, `nationality`, `country`, `state`, `city`, `contact_no`, `country_code`, `contact_email`, `job_preferred_location`, `inserted_at`) VALUES ('$seller_id','$first_name','$last_name','$image','$gender','$nationality','$country','$state','$city','$contact_number','$country_code','$contact_email','$preferred_job_location','$inserted_at')");
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

        $insert_skill_one = $db_handle->insertQuery("INSERT INTO `seller_core_skills`(`user_id`, `core_skill`, `inserted_at`) VALUES ('$seller_id','$core_skill_one','$inserted_at')");
        if (!$insert_skill_one) {
            throw new Exception("Error inserting dynamic field data.");
        } else{
            foreach ($sub_skills_one as $s_skill_one){
                $subSkillValue = preg_replace('/[\s\(\)]+/', '_', $s_skill_one);
                $subSkillValue = preg_replace('/[!#$^&*()+=\[\]{};\'":\\\\|,.<>\/?]+/', '\\\\$0', $subSkillValue);
                $file_subskill = '';
                if (!empty($_FILES[$subSkillValue]['name'])) {
                    $RandomAccountNumber = mt_rand(1, 99999);
                    $file_name = $RandomAccountNumber . "_" . $_FILES[$subSkillValue]['name'];
                    $file_size = $_FILES[$subSkillValue]['size'];
                    $file_tmp  = $_FILES[$subSkillValue]['tmp_name'];

                    $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                    move_uploaded_file($file_tmp, "assets/sub_skills/" . $file_name);
                    $file_subskill = "assets/sub_skills/" . $file_name;
                    }
                $insert_sub_skill = $db_handle->insertQuery("INSERT INTO `seller_sub_skills`(`user_id`, `core_skill_id`, `sub_skill`, `s_skill_file`, `inserted_at`) VALUES ('$seller_id','$core_skill_one','$s_skill_one','$file_subskill','$inserted_at')");
                if (!$insert_sub_skill) {
                    throw new Exception("Error inserting dynamic field data.");
                    }
                }
        }

        if($core_skill_two != null){
            $insert_skill_two = $db_handle->insertQuery("INSERT INTO `seller_core_skills`(`user_id`, `core_skill`, `inserted_at`) VALUES ('$seller_id','$core_skill_two','$inserted_at')");
            if (!$insert_skill_two) {
                throw new Exception("Error inserting dynamic field data.");
            } else{
                foreach ($sub_skills_two as $s_skill_two){
                    $subSkillValue = preg_replace('/[\s\(\)]+/', '_', $s_skill_two);
                    $subSkillValue = preg_replace('/[!#$^&*()+=\[\]{};\'":\\\\|,.<>\/?]+/', '\\\\$0', $subSkillValue);
                    $file_subskill = '';
                    if (!empty($_FILES[$subSkillValue]['name'])) {
                        $RandomAccountNumber = mt_rand(1, 99999);
                        $file_name = $RandomAccountNumber . "_" . $_FILES[$subSkillValue]['name'];
                        $file_size = $_FILES[$subSkillValue]['size'];
                        $file_tmp  = $_FILES[$subSkillValue]['tmp_name'];

                        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                        move_uploaded_file($file_tmp, "assets/sub_skills/" . $file_name);
                        $file_subskill = "assets/sub_skills/" . $file_name;
                    }
                    $insert_sub_skill = $db_handle->insertQuery("INSERT INTO `seller_sub_skills`(`user_id`, `core_skill_id`, `sub_skill`, `s_skill_file`, `inserted_at`) VALUES ('$seller_id','$core_skill_two','$s_skill_two','$file_subskill','$inserted_at')");
                    if (!$insert_sub_skill) {
                        throw new Exception("Error inserting dynamic field data.");
                    }
                }
            }
        }

        if($core_skill_three != null){
            $insert_skill_three = $db_handle->insertQuery("INSERT INTO `seller_core_skills`(`user_id`, `core_skill`, `inserted_at`) VALUES ('$seller_id','$core_skill_three','$inserted_at')");
            if (!$insert_skill_three) {
                throw new Exception("Error inserting dynamic field data.");
            } else{
                foreach ($insert_skill_three as $s_skill_three){
                    $subSkillValue = preg_replace('/[\s\(\)]+/', '_', $s_skill_three);
                    $subSkillValue = preg_replace('/[!#$^&*()+=\[\]{};\'":\\\\|,.<>\/?]+/', '\\\\$0', $subSkillValue);
                    $file_subskill = '';
                    if (!empty($_FILES[$subSkillValue]['name'])) {
                        $RandomAccountNumber = mt_rand(1, 99999);
                        $file_name = $RandomAccountNumber . "_" . $_FILES[$subSkillValue]['name'];
                        $file_size = $_FILES[$subSkillValue]['size'];
                        $file_tmp  = $_FILES[$subSkillValue]['tmp_name'];

                        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                        move_uploaded_file($file_tmp, "assets/sub_skills/" . $file_name);
                        $file_subskill = "assets/sub_skills/" . $file_name;
                    }
                    $insert_sub_skill = $db_handle->insertQuery("INSERT INTO `seller_sub_skills`(`user_id`, `core_skill_id`, `sub_skill`, `s_skill_file`, `inserted_at`) VALUES ('$seller_id','$core_skill_three','$s_skill_three','$file_subskill','$inserted_at')");
                    if (!$insert_sub_skill) {
                        throw new Exception("Error inserting dynamic field data.");
                    }
                }
            }
        }

        for ($i= 0; $i<count($industry); $i++) {
            if($till_date == 1){
                $end_date = '';
            }
            $insert_experience = $db_handle->insertQuery("INSERT INTO `seller_experience_data`(`user_id`, `industry`, `sub_industry`, `countries`, `job_designation`, `company_name`, `company_website`, `start_date`,`end_date`, `accomplishment`, `reporting_manager`, `designation`, `name`, `email`, `inserted_at`) VALUES ('$seller_id','$industry[$i]','$sub_industry[$i]','$countries[$i]','$job_location[$i]','$company_name[$i]','$company_website[$i]','$start_date[$i]','$end_date[$i]','$accomplishment[$i]','$reporting_manager[$i]','$designation[$i]','$name[$i]','$email[$i]','$inserted_at[$i]')");
            if (!$insert_experience) {
                throw new Exception("Error inserting dynamic field data.");
            }
        }


        $insert_career = $db_handle->insertQuery("INSERT INTO `seller_career`(`seller_id`, `career_role`, `career_industry`, `noc_number`, `inserted_at`) VALUES ('$seller_id','$career_role','$career_industry','$noc_number','$inserted_at')");
        if (!$insert_career) {
            throw new Exception("Error inserting dynamic field data.");
        }
        $db_handle->commitTransaction();
        echo "<script>
        document.cookie = 'alert = 3;';
        window.location.href='Seller-Profile';
    </script>";
    } catch (Exception $e) {
        $db_handle->rollbackTransaction();
        echo "<script>
        document.cookie = 'alert = 5;';
        window.location.href='Set-Profile';
    </script>";
    }
}



/*send email to the seller*/
if(isset($_POST['send_seller_email'])){
    $full_name = $db_handle->checkValue($_POST['full_name']);
    $email = $db_handle->checkValue($_POST['email']);
    $message_seller = $db_handle->checkValue($_POST['message']);
    $seller_id = $db_handle->checkValue($_POST['seller_id']);
    $seller_unique = $db_handle->checkValue($_POST['seller_unique']);
    $insert_seller_message = $db_handle->insertQuery("INSERT INTO `seller_messages`(`seller_id`, `full_name`, `sender_email`, `message`, `inserted_at`) VALUES ('$seller_id','$full_name','$email','$message_seller','$inserted_at')");

    $fetch_seller_email = $db_handle->runQuery("select email from sellers where seller_id = '$seller_id'");
    $receiver_email1 = $fetch_seller_email[0]['email'];

    if ($insert_seller_message) {
        echo "<script>
             document.cookie = 'alert=3;';
             window.location.href = 'Seller-Guest-View?seller=' + '" . $seller_unique . "';
          </script>";
    } else {
        echo "<script>
             document.cookie = 'alert=5;';
             window.location.href = 'Seller-Guest-View?seller=' + '" . $seller_unique . "';
          </script>";
    }

    /*$subject = "New Query for Recruiter";
         $messege = "<html>
     <body style='background-color: #eee; font-size: 16px;'>
     <div style='max-width: 600px; min-width: 200px; background-color: #ffffff; padding: 20px; margin: auto;'>

         <p style='text-align: center;color:#29a9e1;font-weight:bold'>Email verification code.</p>

         <div style='color:black;text-align: left'>
             <p>Recruiter Name : $full_name</p>
             <p>Recruiter Email : $email</p>
             <p>Message : $message_seller</p>
         </div>
     </div>

     </body>
     </html>";

         $sender_name = "Zeroed";
         $sender_email = "";
         $username = "";
         $password = "";

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
                     window.location.href='Seller-Guest-View';
                     </script>";
                 } else {
                     echo "<script>
                     document.cookie = 'alert = 5;';
                     window.location.href='Seller-Guest-View';
                     </script>";
                 }
             }
         } catch (Exception $e) {
             echo "<script>
            alert('Error sending email');
             </script>";
             exit;
         }*/
}