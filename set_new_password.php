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

if(isset($_POST['update_password'])){
    $email = urldecode($_GET['seller']);
    $password = $db_handle->checkValue($_POST['password']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $update_pass = $db_handle->insertQuery("update sellers set password = '$hashedPassword' where email = '$email'");
    if($update_pass){
        echo "
        <script>
        document.cookie = 'alert = 3;';
        window.location.href='Login';
</script>
        ";
    } else{
        echo "
        <script>
        document.cookie = 'alert = 5;';
        window.location.href='Set-Password?seller=" . urlencode($email) . "';
</script>
        ";
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
                    <h3 class="heading3 text-center">Set New Password</h3>
                    <form class="form mt-6" method="post" action="">
                        <div class="form-group">
                            <label>Enter New Password *</label>
                            <input type="password" id="password" name="password" minlength="8" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" placeholder="new password" autocomplete="off" required />
                        </div>
                        <div class="form-group mt-6">
                            <label>Confirm New Password *</label>
                            <input type="password" id="confirm_password" name="confirm_password" minlength="8" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" placeholder="confirm new password" autocomplete="off" required />
                            <small id="message" class="text-red-500 mt-1 hidden"></small>
                        </div>
                        <div class="block-button mt-6">
                            <button class="button-main bg-primary w-full text-center opacity-50 cursor-not-allowed" name="update_password" type="submit" id="submitBtn" disabled>Update Password</button>
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
<script>
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    const submitBtn = document.getElementById('submitBtn');
    const message = document.getElementById('message');

    function validatePasswords() {
        const passVal = password.value;
        const confirmPassVal = confirmPassword.value;

        // Reset button and message by default
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        message.classList.add('hidden');

        if (passVal.length < 8 || confirmPassVal.length < 8) {
            message.textContent = "Password must be at least 8 characters long.";
            message.classList.remove('hidden');
            return;
        }

        if (passVal !== confirmPassVal) {
            message.textContent = "Passwords do not match!";
            message.classList.remove('hidden');
            return;
        }

        // Enable button if both conditions are met
        submitBtn.disabled = false;
        submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        message.classList.add('hidden');
    }

    password.addEventListener('input', validatePasswords);
    confirmPassword.addEventListener('input', validatePasswords);
</script>
</body>

</html>
