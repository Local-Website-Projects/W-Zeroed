<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$inserted_at = date("Y-m-d H:i:s");

if(!isset($_GET['seller'])){
    echo "
    <script>
    window.location.href = 'Login';
</script>
    ";
}

if(isset($_POST['code_match'])){
    $email = urldecode($_GET['seller']);
    $fetch_code = $db_handle->runQuery("select verification_code from sellers where email = '$email'");
    $code = $db_handle->checkValue($_POST['code']);
    if($code == $fetch_code[0]['verification_code']){
        echo "<script>
        document.cookie = 'alert = 3;';
        window.location.href = 'Set-Password?seller=" . urlencode($email) . "';
</script>";
    } else {
        echo "<script>
        document.cookie = 'alert = 5;';
        window.location.href = 'Email-Verify?seller=" . urlencode($email) . "';
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
    <title>Zeroed - Forget Password</title>
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
                    <h3 class="heading3 text-center">Forget Password</h3>
                    <form class="form mt-6" method="post" action="">
                        <div class="form-group">
                            <label>Please Enter 6 digit code *</label>
                            <input type="text" name="code" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" placeholder="XXXXXX" autocomplete="off" required />
                        </div>
                        <div class="block-button mt-6">
                            <button class="button-main bg-primary w-full text-center" name="code_match" type="submit">Verify</button>
                        </div>
                        <div class="navigate flex items-center justify-center gap-2 mt-6">
                            <span class="text-surface1">Not registered yet?</span>
                            <a class="text-button hover:underline" href="Register">Sign Up</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section class="form_login lg:py-20 sm:py-14 py-10">
            <div class="container flex items-center justify-center">
                <div class="content sm:w-[448px] w-full">
                    <img src="assets/images/new/login.webp"/>
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
