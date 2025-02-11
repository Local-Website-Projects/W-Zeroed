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


if(isset($_POST['update_personal_info'])){
    $firstName = $db_handle->checkValue($_POST['first_name']);
    $lastName = $db_handle->checkValue($_POST['last_name']);
    $gender = $db_handle->checkValue($_POST['gender']);
    $nationality = $db_handle->checkValue($_POST['nationality']);
    $country = $db_handle->checkValue($_POST['country']);
    $state = $db_handle->checkValue($_POST['state']);
    $city = $db_handle->checkValue($_POST['city']);
    $country_code = $db_handle->checkValue($_POST['country_code']);
    $contact_number = $db_handle->checkValue($_POST['contact_number']);
    $contact_email = $db_handle->checkValue($_POST['contact_email']);
    $preferred_job_location = $db_handle->checkValue($_POST['preferred_job_location']);

    $image = '';
    $query = '';
    if (!empty($_FILES['profile_image']['name'])) {
        $RandomAccountNumber = mt_rand(1, 99999);
        $file_name = $RandomAccountNumber . "_" . $_FILES['profile_image']['name'];
        $file_size = $_FILES['profile_image']['size'];
        $file_tmp = $_FILES['profile_image']['tmp_name'];

        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if ($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" && $file_type != "gif") {
            $image = '';
        } else {
            move_uploaded_file($file_tmp, "assets/profile_image/" . $file_name);
            $image = "assets/profile_image/" . $file_name;
            $query .= ",`profile_image`='" . $image . "'";
        }
    }

    $update_personal_info = $db_handle->insertQuery("UPDATE `seller_personal_information` SET `first_name`='$firstName',`last_name`='$lastName',`gender`='$gender',`nationality`='$nationality',`country`='$country',`state`='$state',`city`='$city',`contact_no`='$contact_number',`country_code`='$country_code',`contact_email`='$contact_email',`job_preferred_location`='$preferred_job_location',`updated_at`='$inserted_at'" . $query . " WHERE `user_id` = {$_SESSION['seller_id']}");
    if($update_personal_info){
        echo "<script>
        document.cookie = 'alert = 3;';
        window.location.href='Edit-Profile';
    </script>";
    } else {
        echo "<script>
        document.cookie = 'alert = 5;';
        window.location.href='Edit-Profile';
    </script>";
    }
}


if(isset($_POST['update_global_info'])){
    $global_education_id = $_POST['global_education_id'];
    $global_level_of_education = $_POST['global_level_of_education'];
    $global_field_of_study = $_POST['global_field_of_study'];
    $global_gpa = $_POST['global_gpa'];
    $global_university = $_POST['global_university'];
    $accreditation = $_POST['accreditation'];
    $certificate_number = $_POST['certificate_number'];

    for ($i=0; $i < count($global_education_id); $i++) {
        $update_global_study = $db_handle->insertQuery("UPDATE `seller_global_education` SET `global_level_of_education`='$global_level_of_education[$i]',`global_field_of_study`='$global_field_of_study[$i]',`global_gpa`='$global_gpa[$i]',`global_university`='$global_university[$i]',`updated_at`='$inserted_at',`global_accreditation`='$accreditation[$i]',`global_certificate_no`='$certificate_number[$i]' WHERE `seller_global_education_id` = '$global_education_id[$i]'");
        if($update_global_study){
            echo "<script>
                     document.cookie = 'alert = 3;';
                     window.location.href ='Edit-Profile';
                     </script>";
        } else {
            echo "<script>
                     document.cookie = 'alert = 5;';
                     window.location.href='Edit-Profile';
                     </script>";
        }
    }

}


if(isset($_POST['update_canadian_info'])){
    $canadian_edu_id = $_POST['canadian_edu_id'];
    $canadian_level_of_education = $_POST['canadian_level_of_education'];
    $canadian_field_of_study = $_POST['canadian_field_of_study'];
    $canadian_college = $_POST['college'];
    $canadian_study_location = $_POST['canadian_study_location'];
    $canadian_gpa = $_POST['canadian_gpa'];
    $canadian_accreditation = $_POST['canadian_accreditation'];
    $canadian_certificate_number = $_POST['canadian_certificate_number'];

    for($i=0; $i<count($canadian_edu_id); $i++){
        $update_canadian_education = $db_handle->insertQuery("UPDATE `seller_canadian_education` SET `can_level_of_education`='$canadian_level_of_education[$i]',`can_field_of_study`='$canadian_field_of_study[$i]',`can_college`='$canadian_college[$i]',`can_location`='$canadian_study_location[$i]',`can_gpa`='$canadian_gpa[$i]',`canadian_accreditation`='$canadian_accreditation[$i]',`canadian_certificate_number`='$canadian_certificate_number[$i]',`updated_at`='$inserted_at' WHERE `s_can_edu_id`='$canadian_edu_id[$i]'");
        if($update_canadian_education){
            echo "<script>
                     document.cookie = 'alert = 3;';
                     window.location.href ='Edit-Profile';
                     </script>";
        } else {
            echo "<script>
                     document.cookie = 'alert = 5;';
                     window.location.href='Edit-Profile';
                     </script>";
        }
    }
}


if(isset($_POST['update_experience_info'])){
    $till_date = 0;
    $seller_exp_id = $_POST['seller_exp_id'];
    $industry = $_POST['industry'];
    $sub_industry = $_POST['sub_industry'];
    $countries = $_POST['countries'];
    $job_designation = $_POST['job_designation'];
    $company_name = $_POST['company_name'];
    $company_website = $_POST['company_website'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $accomplishment = $_POST['accomplishment'];
    $accomplishment2 = $_POST['accomplishment2'];
    $accomplishment3 = $_POST['accomplishment3'];
    $reporting_manager = $_POST['reporting_manager'];
    $designation = $_POST['designation'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $till_date = $_POST['till_date'];
    $reporting_manager_job = $_POST['reporting_manager_job'];
    $designation_job = $_POST['designation_job'];
    $name_job = $_POST['name_job'];
    $email_job = $_POST['email_job'];

    for($i=0; $i<count($seller_exp_id);$i++){
        if($till_date == 1)
            $end_date = '0000-00-00';
        $update_exp_data = $db_handle->insertQuery("UPDATE `seller_experience_data` SET `industry`='$industry[$i]',`sub_industry`='$sub_industry[$i]',`countries`='$countries[$i]',`job_designation`='$job_designation[$i]',`company_name`='$company_name[$i]',`company_website`='$company_website[$i]',`start_date`='$start_date[$i]',`end_date`='$end_date[$i]',`accomplishment`='$accomplishment[$i]',`accomplishment_two`='$accomplishment2[$i]',`accomplishment_three`='$accomplishment3[$i]',`reporting_manager`='$reporting_manager[$i]',`designation`='$designation[$i]',`name`='$name[$i]',`email`='$email[$i]',`reporting_manager_job`='$reporting_manager_job[$i]',`designation_job`='$designation_job[$i]',`name_job`='$name_job[$i]',`email_job`='$email_job[$i]',`updated_at`='$inserted_at' WHERE `seller_experience_id` = '$seller_exp_id[$i]'");
        if($update_exp_data){
            echo "<script>
                     document.cookie = 'alert = 3;';
                    window.location.href = 'Edit-Profile';
                     </script>";
        } else {
            echo "<script>
                     document.cookie = 'alert = 5;';
                     window.location.href = 'Edit-Profile';
                     </script>";
        }
    }
}

if(isset($_POST['update_career'])){
    $seller_career_id = $db_handle->checkValue($_POST['seller_career_id']);
    $career_role = $db_handle->checkValue($_POST['career_role']);
    $career_industry = $db_handle->checkValue($_POST['career_industry']);
    $noc_number = $db_handle->checkValue($_POST['noc_number']);

    $update_career_goal = $db_handle->insertQuery("UPDATE `seller_career` SET `career_role`='$career_role',`career_industry`='$career_industry',`noc_number`='$noc_number',`updated_at`='$inserted_at' WHERE `seller_career_id`='$seller_career_id'");
    if($update_career_goal){
        echo "<script>
                     document.cookie = 'alert = 3;';
                    window.location.href = 'Edit-Profile';
                     </script>";
    } else {
        echo "<script>
                     document.cookie = 'alert = 5;';
                     window.location.href = 'Edit-Profile';
                     </script>";
    }
}

if(isset($_GET['dlt_id'])){
    $id = $_GET['dlt_id'];
    $fetch_skill_id = $db_handle->runQuery("select core_skill from seller_core_skills where s_core_skill_id = '$id'");
    $skill_id = $fetch_skill_id[0]['core_skill'];
    $dlt_subskills = $db_handle->insertQuery("DELETE FROM `seller_sub_skills` WHERE `core_skill_id` = '$skill_id'");
    $dlt_skill = $db_handle->insertQuery("DELETE FROM `seller_core_skills` WHERE `s_core_skill_id` = '$id'");
    if($dlt_skill){
        echo "<script>
                     document.cookie = 'alert = 3;';
                     window.location.href = 'Edit-Skills';
                     </script>";
    } else {
        echo "<script>
                     document.cookie = 'alert = 5;';
                     window.location.href = 'Edit-Skills';
                     </script>";
    }
}