<?php
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$inserted_at = date("Y-m-d H:i:s");

if(!isset($_GET['id'])){
    echo "
    <script>
        alert('You are at the wrong place!');
        window.open('', '_self'); 
        window.close();           
        window.location.href = 'https://google.com'; 
    </script>
    ";
} else{
    $id = $_GET['id'];
    $update_status = $db_handle->insertQuery("update seller_experience_data set job_experience_status = '1' where seller_experience_id = '$id'");
    if($update_status){
        echo "
        <script>
        alert('Thank you for the verification!');
        window.open('', '_self'); 
        window.close();           
        window.location.href = 'https://google.com'; 
</script>
        ";
    } else {
        echo "
        <script>
        alert('Something went wrong! Please try again later!');
        window.open('', '_self'); 
        window.close();           
        window.location.href = 'https://google.com'; 
</script>
        ";
    }
}