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
    <meta name="description" content="Zeroed - Job Board & Recruiting Marketplace" />
    <title>Zeroed - Login</title>
    <?php include ('include/css.php');?>
</head>

<body>
<!-- Header -->
<?php include ('include/header.php');?>

<!-- Breadcrumb -->
<div class="container flex items-center justify-center min-h-screen mt-5" style="height: 100vh;">
    <div class="grid sm:grid-cols-2 mt-5">
        <div class="container flex items-center justify-center mt-5">
            <div class="content sm:w-[448px] w-full align-middle">
                <h3 class="heading3">Welcome to Zeroed!</h3>
                <h4 class="heading4">Get Hiring Ready</h4>
                <!-- <h4 class="lg:mt-20 heading4"> <span style="font-size: 18px; font-weight: bold">
                     Grab attention on hiring managers with your verified skills,
                         work experience and video intro.
                 </span></h4>-->
                <h3 class="mt-5 heading4"> <span style="font-size: 18px; font-weight: bold">
                        Sign up today to claim the launch offer!
                    </span></h3>
                <h3 class="mt-5 heading4"> <span style="font-size: 18px; font-weight: bold">
                        1 month free trial
                    </span></h3>
            </div>
        </div>
        <section class="form_register lg:py-20 sm:py-14 py-10">
            <div class="container flex items-center justify-center">
                <div class="content sm:w-[448px] w-full">
                    <div id="candidate" class="tab_list active" role="tabpanel" aria-labelledby="tab_candidate" aria-hidden="false">
                        <form class="form mt-6" method="post" action="Insert">
                            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required/>
                            <div class="form-group">
                                <label>Please Enter 6 digit verification code *</label>
                                <input type="text" name="v_code" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" placeholder="6 digit code" autocomplete="off" required />
                            </div>
                            <div class="block-button mt-6">
                                <button class="button-main bg-primary w-full text-center" name="verify" type="submit">Verify</button>
                            </div>
                            <div class="navigate flex items-center justify-center gap-2 mt-6">
                                <span class="text-surface1">Not registered yet?</span>
                                <a class="text-button hover:underline" href="Register">Sign Up</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Form Login -->
<!--<section class="form_login lg:py-20 sm:py-14 py-10">
    <div class="container flex items-center justify-center">
        <div class="content sm:w-[448px] w-full">
            <h3 class="heading3 text-center">Verify Email</h3>
            <form class="form mt-6" method="post" action="Insert">
                <input type="hidden" name="email" value="<?php /*echo $_GET['email']; */?>" required/>
                <div class="form-group">
                    <label>Please Enter 6 digit verification code *</label>
                    <input type="text" name="v_code" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" placeholder="6 digit code" autocomplete="off" required />
                </div>
                <div class="block-button mt-6">
                    <button class="button-main bg-primary w-full text-center" name="verify" type="submit">Verify</button>
                </div>
                <div class="navigate flex items-center justify-center gap-2 mt-6">
                    <span class="text-surface1">Not registered yet?</span>
                    <a class="text-button hover:underline" href="Register">Sign Up</a>
                </div>
            </form>
        </div>
    </div>
</section>-->

<?php include ('include/footer.php');?>



<?php include ('include/mobile_menu.php');?>

<?php include ('include/script.php');?>
</body>

</html>
