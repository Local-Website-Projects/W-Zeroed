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
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="FreelanHub - Job Board & Freelance Marketplace" />
    <title>Zeroed - Login</title>
    <?php include ('include/css.php');?>
</head>

<body>
<!-- Header -->
<?php include ('include/header.php');?>

<div class="container flex items-center justify-center min-h-screen mt-5" style="height: 100vh;">
    <!-- Form Login -->
    <div class="grid sm:grid-cols-2 mt-5">
        <section class="form_login lg:py-20 sm:py-14 py-10">
            <div class="container flex items-center justify-center">
                <div class="content sm:w-[448px] w-full">
                    <h3 class="heading3 text-center" style="font-size: 24px">Thank you for completing the verification</h3>
                    <p style="text-align: center">If you are done here, please close this page. </p>

                </div>
            </div>
        </section>
        <section class="form_login lg:py-20 sm:py-14 py-10">
            <div class="container flex items-center justify-center">
                <div class="content sm:w-[448px] w-full">
                    <img src="assets/images/avatar/verification.png"/>
                </div>
            </div>
        </section>
    </div>
</div>


<?php include ('include/mobile_menu.php');?>

<?php include ('include/script.php');?>

<script>
    console.log(alert);
</script>
</body>

</html>