<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$inserted_at = date("Y-m-d H:i:s");

if(!isset($_SESSION['seller_id'])) {
    echo "
    <script>
    window.location.href='Login'
</script>
    ";
}

if(isset($_POST['update_password'])){
    $password = $db_handle->checkValue($_POST['password']);
    $new_pass = $db_handle->checkValue($_POST['new_pass']);

    $fetch_password = $db_handle->runQuery("select * from sellers where seller_id= {$_SESSION['seller_id']}");

    if(password_verify($password, $fetch_password[0]['password'])){
        $hashedPassword = password_hash($new_pass, PASSWORD_DEFAULT);
        $update_pass = $db_handle->insertQuery("UPDATE `sellers` SET `password`='$hashedPassword' WHERE `seller_id` = {$_SESSION['seller_id']}");
        if($update_pass){
            echo "<script>
                     document.cookie = 'alert = 3;';
                     window.location.href='Update-Password';
                     </script>";
        } else {
            echo "<script>
                     document.cookie = 'alert = 5;';
                     window.location.href='Update-Password';
                     </script>";
        }
    } else {
        echo "<script>
                     document.cookie = 'alert = 5;';
                     window.location.href='Update-Password';
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
    <title>FreelanHub - Job Board & Freelance Marketplace</title>
    <?php include ('include/css.php');?>
</head>

<body class="lg:overflow-hidden">
<!-- Header -->
<?php include ('include/header.php');?>

<div class="dashboard_payouts scrollbar_custom w-full bg-surface">
    <div class="mt-5 dashboard_main overflow-hidden lg:w-screen lg:h-screen flex sm:pt-20 pt-16">
        <div class="dashboard_profile scrollbar_custom w-full bg-surface">
            <div class="container list_category p-6 mt-7.5 rounded-lg bg-white">
                <h5 class="heading5">Reset Password</h5>
                <form class="form grid sm:grid-cols-1 gap-5 mt-5" action="" method="post">
                    <div class="code">
                        <label for="code">Type previous password <span class="text-red">*</span></label>
                        <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" name="password" id="code" type="password" placeholder="Enter previous password" required autocomplete="off">
                    </div>
                    <div class="address">
                        <label for="address">Type new password <span class="text-red">*</span></label>
                        <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" name="new_pass" id="password" type="password" placeholder="Enter new password" required autocomplete="off" minlength="8">
                    </div>
                    <div class="city">
                        <label for="city">Confirm New Password <span class="text-red">*</span></label>
                        <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" name="confirm_new_pass" id="confirm_password" type="password" placeholder="Confirm New Password" required autocomplete="off">
                        <span class="mt-3" id="alert"></span>
                    </div>
                    <div class="flex items-center col-span-full gap-5 mt-1">
                        <button class="button-main -border" id="submitButton" type="submit" name="update_password" disabled>Update Password</button>
                    </div>
                </form>
            </div>
            <?php
            include ('include/dashboard_footer.php');
            ?>
        </div>
    </div>
</div>


<!-- Menu mobile -->
<?php include ("include/mobile_menu.php");?>

<!-- Modal -->
<?php include ('include/modal.php');?>


<?php include ('include/script.php');?>

<script>
    // Get references to the input fields and button
    const newPasswordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const alertMessage = document.getElementById('alert');
    const submitButton = document.getElementById('submitButton');

    // Function to validate the password fields
    function validatePasswords() {
        const newPassword = newPasswordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        // Check if the new password is at least 8 characters
        if (newPassword.length < 8) {
            alertMessage.textContent = 'Password must be at least 8 characters.';
            alertMessage.style.display = 'block';
            submitButton.disabled = true;
            return;
        }

        // Check if the passwords match
        if (newPassword !== confirmPassword) {
            alertMessage.textContent = 'The password and confirm password do not match.';
            alertMessage.style.display = 'block';
            submitButton.disabled = true;
        } else {
            alertMessage.style.display = 'none';
            submitButton.disabled = false;
        }
    }

    // Add event listeners to the password fields
    newPasswordInput.addEventListener('input', validatePasswords);
    confirmPasswordInput.addEventListener('input', validatePasswords);
</script>
</body>
</html>
