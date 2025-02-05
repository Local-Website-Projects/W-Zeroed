<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$inserted_at = date("Y-m-d H:i:s");

if(isset($_SESSION['seller_id'])){
    echo "
    <script>
    window.location.href = 'Seller-Profile';
    </script>
    ";
}

if(isset($_POST['login'])){
    $email = $db_handle->checkValue($_POST['email']);
    $password = $db_handle->checkValue($_POST['password']);

    $fetch_pass = $db_handle->runQuery("select seller_id, password from sellers where email='$email' and status = '1'");
    if(password_verify($password, $fetch_pass[0]['password'])){
        $_SESSION['seller_id'] = $fetch_pass[0]['seller_id'];

        $check_value = $db_handle->numRows("select * from seller_personal_information where user_id = {$_SESSION['seller_id']}");
        if($check_value == 1){
            echo "<script>
                document.cookie = 'alert = 1;';
                window.location.href='Seller-Profile';
                </script>";
        } else {
            echo "<script>
                document.cookie = 'alert = 1;';
                window.location.href='Set-Profile';
                </script>";
        }
    }else {
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

        <div class="container flex items-center justify-center min-h-screen mt-5" style="height: 100vh;">
            <!-- Form Login -->
            <div class="grid sm:grid-cols-2 mt-5">
                <section class="form_login lg:py-20 sm:py-14 py-10">
                    <div class="container flex items-center justify-center">
                        <div class="content sm:w-[448px] w-full">
                            <h3 class="heading3 text-center">Log In</h3>
                            <form class="form mt-6" method="post" action="#">
                                <div class="form-group">
                                    <label>Email address*</label>
                                    <input type="email" name="email" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" placeholder="Email address*" autocomplete="off" required />
                                </div>
                                <div class="form-group mt-6">
                                    <label>Password*</label>
                                    <input type="password" name="password" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" autocomplete="off" required />
                                </div>
                                <div class="flex items-center justify-between mt-6">
                                    <a class="text-primary hover:underline" href="Forget-Password">Forgot password?</a>
                                </div>
                                <div class="block-button mt-6">
                                    <button class="button-main bg-primary w-full text-center" type="submit" name="login">Login</button>
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
