<?php
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$inserted_at = date("Y-m-d H:i:s");

function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // IP from shared internet
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // IP passed from proxy or load balancer
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ipList[0]); // Return the first IP in the list
    } else {
        // Direct connection IP
        return $_SERVER['REMOTE_ADDR'];
    }
}

if(isset($_GET['seller'])){
    $get_seller_id = $db_handle->runQuery("select seller_id from sellers where unique_id='".$_GET['seller']."'");
    $seller = $get_seller_id[0]['seller_id'];

    $user_ip = getUserIP();
    $insertView = $db_handle->insertQuery("INSERT INTO `seller_notification`(`seller_id`, `view_ip`, `status`, `viewed_time`) VALUES ('$seller','$user_ip','0', '$inserted_at')");
} else {
    echo "
    <script>
    window.location.href = '404.php';
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
                        $fetch_profile = $db_handle->runQuery("select first_name, last_name, city, state, country, contact_email, contact_no from seller_personal_information where user_id = '$seller'");
                        ?>
                        <h5 class="heading5"><?php echo $fetch_profile[0]['first_name'].' '.$fetch_profile[0]['last_name'];?></h5>
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

                    <!--skills information-->
                    <div class="tools p-8 mt-7.5 rounded-lg bg-white shadow-sm">
                        <?php
                        $fetch_core_skils = $db_handle->runQuery("SELECT cs.core_skill, s.core_skill as skill_name FROM `skills` as s,`seller_core_skills` as cs WHERE s.skill_id = cs.core_skill and cs.user_id = '$seller'");
                        $fetch_core_skils_no = $db_handle->numRows("SELECT cs.core_skill, s.core_skill as skill_name FROM `skills` as s,`seller_core_skills` as cs WHERE s.skill_id = cs.core_skill and cs.user_id = '$seller'");
                        for ($i=0; $i<$fetch_core_skils_no; $i++) {
                            ?>
                            <h5 class="heading5"><?php echo $fetch_core_skils[$i]['skill_name'];?></h5>
                            <div class="list flex flex-wrap items-center gap-3 mt-5">
                                <?php
                                $fetch_sub_skills = $db_handle->runQuery("SELECT sub_skill, s_skill_file FROM `seller_sub_skills`WHERE core_skill_id = {$fetch_core_skils[$i]['core_skill']} AND user_id = '$seller'");
                                $fetch_sub_skills_no = $db_handle->numRows("SELECT sub_skill, s_skill_file FROM `seller_sub_skills`WHERE core_skill_id = {$fetch_core_skils[$i]['core_skill']} AND user_id = '$seller'");
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

                    <!--educational information-->
                    <div class="education w-full overflow-hidden p-8 mt-7.5 rounded-lg bg-white shadow-sm">
                        <h5 class="heading5">Education</h5>
                        <ul class="list flex flex-col gap-7 mt-5 pl-7 border-l border-line">
                            <?php
                            $fetch_global_education = $db_handle->runQuery("SELECT global_level_of_education, global_gpa,field_study FROM `seller_global_education`,`field_of_study` WHERE global_field_of_study = field_study_id and user_id='$seller'");
                            ?>
                            <li>
                                <div class="flex items-center gap-4 mb-1">
                                    <strong class="edu_name text-button-sm"><?php echo $fetch_global_education[0]['global_level_of_education'];?></strong>
                                    <span class="time caption2">GPA: <?php echo $fetch_global_education[0]['global_gpa'];?></span>
                                </div>
                                <strong class="position text-button"><?php echo $fetch_global_education[0]['field_study'];?></strong>
                            </li>

                            <?php
                            $fetch_canadian_education = $db_handle->runQuery("SELECT can_level_of_education,university_name, city_name, field_study, can_gpa FROM `seller_canadian_education`,`universities`,`cities`,`field_of_study` WHERE seller_canadian_education.can_field_of_study = field_of_study.field_study_id AND seller_canadian_education.can_college = universities.university_id AND cities.city_id = seller_canadian_education.can_location AND seller_canadian_education.user_id = '$seller'");
                            ?>
                            <li>
                                <div class="flex items-center gap-4 mb-1">
                                    <strong class="edu_name text-button-sm"><?php echo $fetch_canadian_education[0]['can_level_of_education'];?></strong>
                                    <span class="time caption2">GPA: <?php echo $fetch_canadian_education[0]['can_gpa'];?></span>
                                </div>
                                <strong class="position text-button"><?php echo $fetch_canadian_education[0]['field_study'];?></strong>
                                <p class="desc text-secondary mt-1">University/College: <?php echo $fetch_canadian_education[0]['university_name'];?></p>
                                <p class="desc text-secondary mt-1">City: <?php echo $fetch_canadian_education[0]['city_name'];?></p>
                            </li>
                        </ul>
                    </div>

                    <!--experience section-->
                    <div class="experience w-full overflow-hidden p-8 mt-7.5 rounded-lg bg-white shadow-sm">
                        <h5 class="heading5">Experience</h5>
                        <ul class="list flex flex-col gap-7 mt-5 pl-7 border-l border-line">
                            <?php
                            $fetch_exp = $db_handle->runQuery("SELECT * FROM `seller_experience_data` where user_id = '$seller'");
                            $fetch_exp_no = $db_handle->numRows("SELECT * FROM `seller_experience_data` where user_id = '$seller'");
                            for ($i=0; $i<$fetch_exp_no; $i++) {
                                ?>
                                <li>
                                    <div class="flex items-center gap-4 mb-1">
                                        <strong class="company_name text-button-sm"><?php echo $fetch_exp[$i]['company_name'];?></strong>
                                        <span class="time text-xs font-semibold uppercase"><?php
                                            $date = new DateTime($fetch_exp[$i]['start_date']);
                                            echo $date->format('M, Y');
                                            ?> - <?php
                                            $date = new DateTime($fetch_exp[$i]['end_date']);
                                            echo $date->format('M, Y');
                                            ?></span>
                                    </div>
                                    <strong class="position text-button"><?php echo $fetch_exp[$i]['job_designation'];?></strong>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['accomplishment'];?></p>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="right flex-shrink-0 lg:w-[29.5%] lg:pl-7.5">
                        <div class="sticky top-5 w-full">
                            <div class="list_social mt-7.5 rounded-lg bg-white shadow-sm">
                                <iframe src="assets/video/Snapinsta.mp4" style="height: 800px; width: 100%"></iframe>
                            </div>
                            <form class="form_change grid grid-cols-2 gap-5 w-full p-10 mt-7.5 rounded-lg bg-white shadow-sm" action="Insert" method="POST">
                                <div class="email col-span-full flex flex-col">
                                    <label for="email" class="w-fit">Your Name: <span class="text-red">*</span></label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="email" name="full_name" type="text" placeholder="Your Name..." required="">
                                </div>
                                <div class="email col-span-full flex flex-col">
                                    <label for="email" class="w-fit">Your Email: <span class="text-red">*</span></label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="email" type="email" name="email" placeholder="Your Email..." required="">
                                </div>
                                <div class="email col-span-full flex flex-col">
                                    <label for="email" class="w-fit">Your Message: <span class="text-red">*</span></label>
                                    <textarea class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="email" name="message" type="text"required=""></textarea>
                                </div>
                                <input type="hidden" value="<?php echo $seller;?>" name="seller_id">
                                <input type="hidden" value="<?php echo $_GET['seller'];?>" name="seller_unique">
                                <div class="block_btn col-span-full flex flex-col">
                                    <button class="w-full button-main btn_change_password" type="submit" name="send_seller_email">Send Email</button>
                                </div>
                            </form>
                        </div>
                    </div>

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
