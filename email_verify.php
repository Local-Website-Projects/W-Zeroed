<?php
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$inserted_at = date("Y-m-d H:i:s");

if (!isset($_GET['email'])) {
    echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='Login';
                </script>";
}
if(isset($_POST['verification'])){
    $fetch_code = $db_handle->runQuery("select verification_code from sellers where email='" . $_GET['email'] . "' and status='0'");
    if($fetch_code > 0){
        $update_status = $db_handle->insertQuery("update sellers set status='1' where email='" . $_GET['email'] . "'");
        if($update_status){
            echo "<script>
                document.cookie = 'alert = 4;';
                window.location.href='Login';
                </script>";
        } else{
            echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='Login';
                </script>";
        }
    } else {
        echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='Login';
                </script>";
    }
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

<!-- Breadcrumb -->
<section class="breadcrumb">
    <div class="breadcrumb_inner relative sm:mt-20 mt-16 lg:py-20 py-14">
        <div class="breadcrumb_bg absolute top-0 left-0 w-full h-full">
            <img src="assets/images/components/breadcrumb_candidate.webp" alt="breadcrumb_candidate" class="w-full h-full object-cover" />
        </div>
        <div class="container relative h-full">
            <div class="breadcrumb_content flex flex-col items-start justify-center xl:w-[1000px] lg:w-[848px] md:w-5/6 w-full h-full">
                <div class="list_breadcrumb flex items-center gap-2 animate animate_top" style="--i: 1">
                    <a href="Home" class="caption1 text-white">Home</a>
                    <span class="caption1 text-white opacity-40">/</span>
                    <span class="caption1 text-white opacity-60">Email Verification</span>
                </div>
                <h3 class="heading3 text-white mt-2 animate animate_top" style="--i: 2">Email Verification</h3>
            </div>
        </div>
    </div>
</section>

<!-- Form Login -->
<section class="form_login lg:py-20 sm:py-14 py-10">
    <div class="container flex items-center justify-center">
        <div class="content sm:w-[448px] w-full">
            <h3 class="heading3 text-center">Log In</h3>
            <form class="form mt-6" method="post" action="#">
                <div class="form-group">
                    <label>Please Enter 6 digit verification code *</label>
                    <input type="text" name="v_code" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" placeholder="6 digit code" autocomplete="off" required />
                </div>
                <div class="block-button mt-6">
                    <button class="button-main bg-primary w-full text-center" name="verification" type="submit">Verify</button>
                </div>
                <div class="navigate flex items-center justify-center gap-2 mt-6">
                    <span class="text-surface1">Not registered yet?</span>
                    <a class="text-button hover:underline" href="Register">Sign Up</a>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include ('include/footer.php');?>



<?php include ('include/mobile_menu.php');?>

<?php include ('include/script.php');?>
</body>

</html>
