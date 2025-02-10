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