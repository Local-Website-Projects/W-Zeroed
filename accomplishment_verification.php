<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$inserted_at = date("Y-m-d H:i:s");

if(!isset($_GET['id'])){
    echo "
    <script>
    window.location.href = 'Login';
</script>
    ";
} else {
    $id = $_GET['id'];
    $update_reference = $db_handle->insertQuery("update seller_experience_data set reference_status = '1' where seller_experience_id = '$id'");
    $fech_data = $db_handle->runQuery("select * from seller_experience_data where seller_experience_id = '$id'");
}

if(isset($_POST['accomplishment_one'])){
    $update_status = $db_handle->insertQuery("update seller_experience_data set accomplishment_one_status = '1' where seller_experience_id = '$id'");
    if($update_status){
        echo "<script>
                     document.cookie = 'alert = 3;';
                     window.location.href ='Accomplishment-Verification?id=' + $id;
                     </script>";
    } else {
        echo "<script>
                     document.cookie = 'alert = 5;';
                     window.location.href ='Accomplishment-Verification?id=' + $id;
                     </script>";
    }
}

if(isset($_POST['accomplishment_two'])){
    $update_status = $db_handle->insertQuery("update seller_experience_data set accomplishment_two_status = '1' where seller_experience_id = '$id'");
    if($update_status){
        echo "<script>
                     document.cookie = 'alert = 3;';
                     window.location.href ='Accomplishment-Verification?id=' + $id;
                     </script>";
    } else {
        echo "<script>
                     document.cookie = 'alert = 5;';
                     window.location.href ='Accomplishment-Verification?id=' + $id;
                     </script>";
    }
}

if(isset($_POST['accomplishment_three'])){
    $update_status = $db_handle->insertQuery("update seller_experience_data set accomplishment_three_status = '1' where seller_experience_id = '$id'");
    if($update_status){
        echo "<script>
                     document.cookie = 'alert = 3;';
                     window.location.href ='Accomplishment-Verification?id=' + $id;
                     </script>";
    } else {
        echo "<script>
                     document.cookie = 'alert = 5;';
                     window.location.href ='Accomplishment-Verification?id=' + $id;
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
                    <h3 class="heading3 text-center" style="font-size: 24px">Verify Accomplishment</h3>
                    <form class="mt-5 mb-5" action="" method="post">
                        <p>1. <?php echo $fech_data[0]['accomplishment'];?></p>
                        <?php
                        if($fech_data[0]['accomplishment_one_status'] == '1'){
                            ?>
                            <i class="ph ph-seal-check"></i>
                            <?php
                        } else {
                            ?>
                            <div class="flex flex-wrap gap-4 mt-5">
                                <button type="submit" name="accomplishment_one" class="button-main -border">Verify Accomplishment</button>
                            </div>
                            <?php
                        }
                        ?>
                    </form>
                    <form class="mt-5 mb-5" action="" method="post">
                        <p>2. <?php echo $fech_data[0]['accomplishment'];?></p>
                        <?php
                        if($fech_data[0]['accomplishment_two_status'] == '1'){
                            ?>
                            <i class="ph ph-seal-check"></i>
                            <?php
                        } else {
                            ?>
                            <div class="flex flex-wrap gap-4 mt-5">
                                <button type="submit" name="accomplishment_two" class="button-main -border">Verify Accomplishment</button>
                            </div>
                            <?php
                        }
                        ?>
                    </form>
                    <form class="mt-5 mb-5" action="" method="post">
                        <p>3. <?php echo $fech_data[0]['accomplishment_two'];?></p>
                        <?php
                        if($fech_data[0]['accomplishment_three_status'] == '1'){
                            ?>
                            <i class="ph ph-seal-check"></i>
                            <?php
                        } else {
                            ?>
                            <div class="flex flex-wrap gap-4 mt-5">
                                <button type="submit" name="accomplishment_three" class="button-main -border">Verify Accomplishment</button>
                            </div>
                            <?php
                        }
                        ?>

                    </form>
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
