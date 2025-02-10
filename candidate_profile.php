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

<div class="dashboard_main overflow-hidden lg:w-screen lg:h-screen flex sm:pt-20 pt-16">
    <?php include ("include/sidebar_user.php");?>

    <div class="dashboard_profile scrollbar_custom w-full bg-surface">
        <div class="container h-fit lg:pt-15 lg:pb-30 max-lg:py-12 max-sm:py-8">
            <button class="btn_open_popup btn_menu_dashboard flex items-center gap-2 min-[1400px]:hidden" data-type="menu_dashboard">
                <span class="ph ph-squares-four text-xl"></span>
                <strong class="text-button">Menu</strong>
            </button>
            <div class="heading flex flex-wrap items-center justify-between gap-4">
                <h4 class="heading4 max-lg:mt-3">Profile</h4>
            </div>
            <div class="profile_block overflow-hidden flex max-lg:flex-col-reverse gap-y-10 w-full mt-7.5">
                <div class="left lg:w-[70.5%] h-[calc(100vh-100px)] overflow-y-auto pr-4">
                    <!--personal information-->
                    <div class="info_overview p-8 rounded-lg bg-white shadow-sm mt-7.5">
                        <?php
                        $fetch_profile = $db_handle->runQuery("select first_name, last_name, city, state, country, contact_email, contact_no,profile_image from seller_personal_information where user_id = {$_SESSION['seller_id']}");
                        ?>
                        <h5 class="heading5"><?php echo $fetch_profile[0]['first_name'].' '.$fetch_profile[0]['last_name'];?></h5>

                        <div class="overflow-hidden flex max-lg:flex-col-reverse gap-y-10 w-full mt-7.5">
                            <div class="left lg:w-[70.5%] pr-4">
                                <ul class="candidates_info pt-1">
                                    <li class="location flex flex-wrap items-center justify-between gap-1 w-full py-4 border-b border-line">
                                        <span class="text-secondary">Location:</span>
                                        <strong class="text-title"><?php echo $fetch_profile[0]['city'].' '.$fetch_profile[0]['state'].', '.$fetch_profile[0]['country'];?></strong>
                                    </li>
                                    <li class="phone flex flex-wrap items-center justify-between gap-1 w-full py-4 border-b border-line">
                                        <span class="text-secondary">Phone:</span>
                                        <strong class="text-title"><?php echo $fetch_profile[0]['contact_no'];?></strong>
                                    </li>
                                    <li class="email flex flex-wrap items-center justify-between gap-1 w-full py-4 border-b border-line">
                                        <span class="text-secondary">Email:</span>
                                        <strong class="text-title"><?php echo $fetch_profile[0]['contact_email'];?></strong>
                                    </li>
                                </ul>
                            </div>
                            <div class="right flex-shrink-0 lg:w-[29.5%] lg:pl-7.5">
                                <div class="w-full flex align-middle justify-center">
                                    <img src="<?php echo $fetch_profile[0]['profile_image'];?>" style="width: auto;height: auto"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--skills information-->
                    <div class="tools p-8 mt-7.5 rounded-lg bg-white shadow-sm">
                        <h5 class="heading5">Skills</h5>
                        <?php
                        $fetch_core_skils = $db_handle->runQuery("SELECT cs.core_skill, s.core_skill as skill_name FROM `skills` as s,`seller_core_skills` as cs WHERE s.skill_id = cs.core_skill and cs.user_id = {$_SESSION['seller_id']}");
                        $fetch_core_skils_no = $db_handle->numRows("SELECT cs.core_skill, s.core_skill as skill_name FROM `skills` as s,`seller_core_skills` as cs WHERE s.skill_id = cs.core_skill and cs.user_id = {$_SESSION['seller_id']}");
                        for ($i=0; $i<$fetch_core_skils_no; $i++) {
                            ?>
                            <h2 style="font-size: 30px; font-weight: bold" class="mt-5 mb-5"><?php echo $fetch_core_skils[$i]['skill_name'];?></h2>
                            <div class="list flex flex-wrap items-center gap-3 mt-5">
                                <?php
                                $fetch_sub_skills = $db_handle->runQuery("SELECT sub_skill, s_skill_file FROM `seller_sub_skills`WHERE core_skill_id = {$fetch_core_skils[$i]['core_skill']} AND user_id = {$_SESSION['seller_id']}");
                                $fetch_sub_skills_no = $db_handle->numRows("SELECT sub_skill, s_skill_file FROM `seller_sub_skills`WHERE core_skill_id = {$fetch_core_skils[$i]['core_skill']} AND user_id = {$_SESSION['seller_id']}");
                                for ($j=0; $j<$fetch_sub_skills_no; $j++) {
                                    ?>
                                    <span class="tag bg-surface caption1"><?php echo $fetch_sub_skills[$j]['sub_skill'];?> <?php
                                        if($fetch_sub_skills[$j]['s_skill_file'] != "") {
                                            ?>
                                            <i class="ph ph-seal-check"></i>
                                            <?php
                                        }
                                        ?></span>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>

                    </div>

                    <!--experience section-->
                    <div class="experience w-full overflow-hidden p-8 mt-7.5 rounded-lg bg-white shadow-sm">
                        <h5 class="heading5">Experience</h5>
                        <ul class="list flex flex-col gap-7 mt-5">
                            <?php
                            $fetch_exp = $db_handle->runQuery("SELECT * FROM `seller_experience_data` where user_id = {$_SESSION['seller_id']}");
                            $fetch_exp_no = $db_handle->numRows("SELECT * FROM `seller_experience_data` where user_id = {$_SESSION['seller_id']}");
                            for ($i=0; $i<$fetch_exp_no; $i++) {
                                ?>
                                <li>
                                    <div class="flex items-center gap-4 mb-1">
                                        <h2 style="font-size: 30px; font-weight: bold" class="mt-5 mb-5"><?php echo $fetch_exp[$i]['job_designation'];?></h2>
                                        <span class="time text-xs font-semibold uppercase"><?php
                                            $date = new DateTime($fetch_exp[$i]['start_date']);
                                            echo $date->format('M, Y');
                                            ?> - <?php
                                            $date = new DateTime($fetch_exp[$i]['end_date']);
                                            echo $date->format('M, Y');
                                            ?></span>
                                    </div>
                                    <strong class="position text-button"><?php echo $fetch_exp[$i]['company_name'];?></strong>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['company_website'];?></p>
                                    <ul class="list flex flex-col gap-7 mt-5 pl-7">
                                        <?php
                                        if($fetch_exp[$i]['accomplishment'] != null){
                                            ?>
                                            <li><?php echo $fetch_exp[$i]['accomplishment'];?></li>
                                            <?php
                                        }
                                        if($fetch_exp[$i]['accomplishment_two'] != null){
                                            ?>
                                            <li><?php echo $fetch_exp[$i]['accomplishment_two'];?></li>
                                            <?php
                                        }
                                        if($fetch_exp[$i]['accomplishment_three'] != null){
                                            ?>
                                            <li><?php echo $fetch_exp[$i]['accomplishment_three'];?></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                    <h4 style="font-size: 20px; font-weight: bold" class="mt-5">Reference Verification Data:</h4>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['reporting_manager'];?></p>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['designation'];?></p>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['name'];?></p>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['email'];?></p>
                                    <div class="flex flex-wrap gap-4 mt-5">
                                        <a href="reference_verification.php?job=<?php echo $fetch_exp[$i]['seller_experience_id'];?>" class="button-main -border">Request Verification</a>
                                    </div>
                                    <h4 style="font-size: 20px; font-weight: bold" class="mt-5">Experience Verification Data:</h4>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['reporting_manager_job'];?></p>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['designation_job'];?></p>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['name_job'];?></p>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['email_job'];?></p>
                                    <div class="flex flex-wrap gap-4 mt-5">
                                        <a href="job_verification.php?job=<?php echo $fetch_exp[$i]['seller_experience_id'];?>" class="button-main -border">Request Verification</a>
                                    </div>
                                </li>
                                <hr>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>

                    <!--educational information-->
                    <div class="education w-full overflow-hidden p-8 mt-7.5 rounded-lg bg-white shadow-sm">
                        <h5 class="heading5">Education</h5>
                        <ul class="list flex flex-col gap-7 mt-5">
                            <?php
                            $fetch_global_education = $db_handle->runQuery("SELECT * FROM `seller_global_education` WHERE user_id={$_SESSION['seller_id']}");
                            $fetch_global_education_no = $db_handle->numRows("SELECT * FROM `seller_global_education` WHERE user_id={$_SESSION['seller_id']}");
                            for ($i=0;$i<$fetch_global_education_no;$i++){
                                ?>
                                    <li>
                                    <div class="flex items-center gap-4 mb-1">
                                        <h2 style="font-size: 30px; font-weight: bold" class="mt-5 mb-5"><?php echo $fetch_global_education[$i]['global_level_of_education'];?>
                                        <?php
                                            if($fetch_global_education[$i]['global_certificate_no'] != null){
                                                ?>
                                                <i class="ph ph-seal-check"></i>
                                                <?php
                                            }
                                            ?>
                                        </h2>
                                        <span class="time caption2">GPA: <?php echo $fetch_global_education[$i]['global_gpa'];?></span>
                                    </div>
                                <strong class="position text-button"><?php echo $fetch_global_education[0]['global_field_of_study'];?></strong>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_global_education[$i]['global_university'];?></p>
                                </li>
                                <?php
                            }
                            ?>
                            <hr class="mt-5 mb-5"/>

                            <?php
                            $fetch_canadian_education = $db_handle->runQuery("SELECT can_level_of_education,university_name, city_name, field_study, can_gpa,canadian_certificate_number FROM `seller_canadian_education`,`universities`,`cities`,`field_of_study` WHERE seller_canadian_education.can_field_of_study = field_of_study.field_study_id AND seller_canadian_education.can_college = universities.university_id AND cities.city_id = seller_canadian_education.can_location AND seller_canadian_education.user_id = {$_SESSION['seller_id']}");
                            $fetch_canadian_education_no = $db_handle->numRows("SELECT can_level_of_education,university_name, city_name, field_study, can_gpa,canadian_certificate_number FROM `seller_canadian_education`,`universities`,`cities`,`field_of_study` WHERE seller_canadian_education.can_field_of_study = field_of_study.field_study_id AND seller_canadian_education.can_college = universities.university_id AND cities.city_id = seller_canadian_education.can_location AND seller_canadian_education.user_id = {$_SESSION['seller_id']}");
                            for($i=0; $i<$fetch_canadian_education_no; $i++){
                                ?>
                                <li>
                                    <div class="flex items-center gap-4 mb-1">
                                        <h2 style="font-size: 30px; font-weight: bold" class="mt-5 mb-5"><?php echo $fetch_canadian_education[$i]['can_level_of_education'];?>
                                            <?php
                                            if($fetch_canadian_education[$i]['canadian_certificate_number'] != null)
                                            {
                                                ?>
                                                <i class="ph ph-seal-check"></i>
                                                <?php
                                            }
                                            ?></h2>
                                        <span class="time caption2">GPA: <?php echo $fetch_canadian_education[$i]['can_gpa'];?></span>
                                    </div>
                                    <strong class="position text-button"><?php echo $fetch_canadian_education[$i]['field_study'];?></strong>
                                    <p class="desc text-secondary mt-1">University/College: <?php echo $fetch_canadian_education[$i]['university_name'];?></p>
                                    <p class="desc text-secondary mt-1">City: <?php echo $fetch_canadian_education[$i]['city_name'];?></p>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <button type="button" class="w-full h-12 px-4 mt-2 button-main -border mt-5" onclick="copyURL()">Copy URL</button>
                    </div>

                </div>
                <div class="right flex-shrink-0 lg:w-[29.5%] lg:pl-7.5">
                    <div class="sticky top-5 w-full">
                        <div class="list_social mt-7.5 rounded-lg bg-white shadow-sm">
                            <?php
                            $fetch_exp = $db_handle->runQuery("SELECT * FROM `seller_video` where user_id = {$_SESSION['seller_id']}");
                            $fetch_exp_no = $db_handle->numRows("SELECT * FROM `seller_video` where user_id = {$_SESSION['seller_id']}");
                            for ($i=0; $i<$fetch_exp_no; $i++) {
                                ?>
                                <iframe src="videos/<?php echo $fetch_exp[$i]['video_src'];?>" style="height: 800px; width: 100%"></iframe>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <script>
                    function copyURL() {
                        navigator.clipboard.writeText("www.dotest.click/Seller-Guest-View?seller=<?php
                            $fetch_exp = $db_handle->runQuery("SELECT * FROM `sellers` where seller_id = {$_SESSION['seller_id']}");
                            $fetch_exp_no = $db_handle->numRows("SELECT * FROM `sellers` where seller_id = {$_SESSION['seller_id']}");
                            for ($i=0; $i<$fetch_exp_no; $i++) {
                                echo $fetch_exp[$i]['unique_id'];
                            }
                            ?>");
                        alert('URL Copied');
                    }
                </script>
            </div>
        </div>
        <div class="lg:fixed bottom-0 left-0 z-[2] lg:pl-[280px] flex items-center justify-center w-full h-15 bg-white duration-300 shadow-md">
            <span class="copyright caption1 text-secondary">©2025 Zeroed. All Rights Reserved</span>
        </div>
    </div>
</div>

<!-- Menu mobile -->
<?php include ("include/mobile_menu.php");?>

<!-- Modal -->
<?php include ('include/modal.php');?>


<?php include ('include/script.php');?>
</body>
</html>
