<?php
session_start();
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
    <meta name="description" content="Zeroed - Job Board & Recruiting Marketplace" />
    <title>Zeroed - Job Board & Recruiting Marketplace</title>
    <?php include ('include/css.php');?>
</head>

<body class="lg:overflow-hidden">
<!-- Header -->
<?php include ('include/header.php');?>

<div class="dashboard_main overflow-hidden lg:w-screen lg:h-screen flex sm:pt-20 pt-16">
    <?php include ("include/sidebar_user.php");?>

    <div class="dashboard_profile scrollbar_custom w-full bg-surface">
        <div class="container h-fit lg:pt-15 lg:pb-30 max-lg:py-12 max-sm:py-8">
            <?php
            $fetch_profile = $db_handle->runQuery("select first_name, last_name, city, state, country, contact_email, contact_no,profile_image,country_code from seller_personal_information where user_id = '$seller'");
            ?>
            <div class="profile_block overflow-hidden flex max-lg:flex-col-reverse gap-y-10 w-full mt-7.5">
                <div class="left lg:w-[70.5%] h-[calc(100vh-100px)] overflow-y-auto pr-4">

                    <!--personal information starts here-->
                    <ul class="list_related flex flex-col md:gap-7.5 gap-6 w-full mt-5">
                        <li class="jobs_item px-6 py-5 rounded-lg bg-white shadow-md duration-300 hover:shadow-xl" style="background: #00c5ff;">
                            <div class="jobs_info flex gap-4 w-full border-b border-line" style="border: unset">
                                <div class="jobs_content flex items-center justify-between gap-2 w-full">
                                    <div  class="jobs_detail flex-col gap-0.5 duration-300 hover:text-primary">
                                        <h5 class="heading5"><?php echo $fetch_profile[0]['first_name'].' '.$fetch_profile[0]['last_name'];?></h5>
                                        <div class="flex flex-wrap items-center gap-5 gap-y-1">
                                            <div class="jobs_address -style-1" style="color: #fff">
                                                <span class="ph ph-map-pin text-lg"></span>
                                                <span class="address caption1 align-top"><?php echo $fetch_profile[0]['city'].' '.$fetch_profile[0]['state'].', '.$fetch_profile[0]['country'];?></span>
                                            </div>
                                            <div class="jobs_date" style="color: #fff;font-size: 12px">
                                                <span class="ph ph-phone text-lg"></span>
                                                <span class="date caption1 align-top"><a href="callto:<?php echo $fetch_profile[0]['contact_no'];?>"><?php echo $fetch_profile[0]['country_code']; ?> <?php echo $fetch_profile[0]['contact_no'];?></a></span>
                                            </div>
                                            <div class="jobs_date" style="color: #fff;font-size: 12px">
                                                <span class="ph ph-envelope-simple-open text-lg"></span>
                                                <span class="date caption1 align-top"><a href="mailto:<?php echo $fetch_profile[0]['contact_email'];?>"><?php echo $fetch_profile[0]['contact_email'];?></a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="overflow-hidden flex-shrink-0 w-32 h-32">
                                    <img src="<?php echo $fetch_profile[0]['profile_image'];?>" alt="seller profile image" class="jobs_avatar w-full h-full object-cover">
                                </a>
                            </div>
                        </li>
                    </ul>
                    <!--personal information ends here-->

                    <!--skills section starts-->
                    <div class="projects w-full overflow-hidden p-8 mt-7.5 rounded-lg bg-white shadow-sm">
                        <h5 class="heading5">Skills</h5>
                        <ul class="list_project grid grid-cols-1 sm:gap-7.5 gap-5 mt-5">
                            <?php
                            $fetch_core_skils = $db_handle->runQuery("SELECT cs.core_skill, s.core_skill as skill_name FROM `skills` as s,`seller_core_skills` as cs WHERE s.skill_id = cs.core_skill and cs.user_id = '$seller'");
                            $fetch_core_skils_no = $db_handle->numRows("SELECT cs.core_skill, s.core_skill as skill_name FROM `skills` as s,`seller_core_skills` as cs WHERE s.skill_id = cs.core_skill and cs.user_id = '$seller'");
                            for ($i=0; $i<$fetch_core_skils_no; $i++) {
                                ?>
                                <li class="project_item py-5 px-6 rounded-lg bg-white duration-300 shadow-md">
                                    <div class="project_innner flex max-sm:flex-col justify-between xl:gap-9 gap-6 h-full">
                                        <div class="project_info">
                                            <p class="project_name heading6 duration-300 hover:underline"><?php echo $fetch_core_skils[$i]['skill_name'];?></p>
                                            <div class="list_tag flex items-center gap-2.5 flex-wrap mt-3">
                                                <?php
                                                $fetch_sub_skills = $db_handle->runQuery("SELECT sub_skill, s_skill_file FROM `seller_sub_skills`WHERE core_skill_id = {$fetch_core_skils[$i]['core_skill']} AND user_id = '$seller'");
                                                $fetch_sub_skills_no = $db_handle->numRows("SELECT sub_skill, s_skill_file FROM `seller_sub_skills`WHERE core_skill_id = {$fetch_core_skils[$i]['core_skill']} AND user_id = '$seller'");
                                                for ($j=0; $j<$fetch_sub_skills_no; $j++) {
                                                    ?>
                                                    <p class="project_tag tag bg-surface caption1 hover:text-white hover:bg-primary"><?php echo $fetch_sub_skills[$j]['sub_skill'];?>
                                                        <?php
                                                        if($fetch_sub_skills[$j]['s_skill_file'] != "") {
                                                            ?>
                                                            <i class="ph ph-seal-check"></i>
                                                            <?php
                                                        }
                                                        ?>
                                                    </p>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>

                        </ul>
                    </div>
                    <!--skills section ends-->

                    <!--experience section-->
                    <div class="experience w-full overflow-hidden p-8 mt-7.5 rounded-lg bg-white shadow-sm">
                        <h5 class="heading5">Experience</h5>
                        <ul class="list flex flex-col gap-7 mt-5">
                            <?php
                            $fetch_exp = $db_handle->runQuery("SELECT * FROM `seller_experience_data` where user_id = '$seller'");
                            $fetch_exp_no = $db_handle->numRows("SELECT * FROM `seller_experience_data` where user_id = '$seller'");
                            for ($i=0; $i<$fetch_exp_no; $i++) {
                                ?>
                                <li>
                                    <div class="flex items-center gap-4 mb-1">
                                        <p class="project_name heading6 duration-300"><?php echo $fetch_exp[$i]['job_designation'];?></p>
                                        <span class="time text-xs font-semibold uppercase"><?php
                                            $date = new DateTime($fetch_exp[$i]['start_date']);
                                            echo $date->format('M, Y');
                                            ?> - <?php
                                            $end_date = $fetch_exp[$i]['end_date'];

                                            if ($end_date == '0000-00-00') {
                                                echo ' Present';
                                            } else {
                                                $date = new DateTime($end_date);
                                                echo $date->format('M, Y');
                                            }
                                            ?></span>
                                    </div>
                                    <strong style="color: #00c5ff;" class="position text-button"><?php echo $fetch_exp[$i]['company_name'];?></strong>
                                    <a href="
                                    <?php
                                    $url = $fetch_exp[$i]['company_website'];
                                    if (!filter_var($url, FILTER_VALIDATE_URL)) {
                                        // If the URL doesn't start with http:// or https://, prepend https://
                                        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                                            $url = "https://" . $url;
                                        }
                                    }
                                    echo $url;
                                    ?>" target="_blank"><p class="desc text-secondary mt-1" style="color: #00c5ff;"><?php echo $fetch_exp[$i]['company_website'];?></p></a>
                                    <?php
                                    if($fetch_exp[$i]['accomplishment'] != null){
                                        ?>
                                        <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['accomplishment'];?>
                                            <?php
                                            if( $fetch_exp[$i]['accomplishment_one_status'] == '1'){
                                                ?>
                                                <i class="ph ph-seal-check"></i>
                                                <?php
                                            }
                                            ?></p>
                                        <?php
                                    }
                                    if($fetch_exp[$i]['accomplishment_two'] != null){
                                        ?>
                                        <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['accomplishment_two'];?>
                                            <?php
                                            if( $fetch_exp[$i]['accomplishment_two_status'] == '1'){
                                                ?>
                                                <i class="ph ph-seal-check"></i>
                                                <?php
                                            }
                                            ?></p>
                                        <?php
                                    }
                                    if($fetch_exp[$i]['accomplishment_three'] != null){
                                        ?>
                                        <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['accomplishment_three'];?>
                                            <?php
                                            if( $fetch_exp[$i]['accomplishment_three_status'] == '1'){
                                                ?>
                                                <i class="ph ph-seal-check"></i>
                                                <?php
                                            }
                                            ?>
                                        </p>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    if($fetch_exp[$i]['email'] != null){
                                    ?>
                                    <h4 style="font-size: 20px; font-weight: bold; color: #00c5ff;" class="mt-5">Reference Verification Data: <?php
                                        if( $fetch_exp[$i]['reference_status'] == '1'){
                                            ?>
                                            <i class="ph ph-seal-check"></i>
                                            <?php
                                        }
                                        ?>
                                    </h4>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['reporting_manager'];?></p>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['designation'];?></p>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['name'];?></p>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['email'];?></p>
                                        ?>
                                        <?php
                                    }

                                    if($fetch_exp[$i]['email_job'] != null) {
                                    ?>
                                    <h4 style="font-size: 20px; font-weight: bold; color: #00c5ff;" class="mt-5">Experience Verification Data:
                                        <?php
                                        if( $fetch_exp[$i]['job_experience_status'] == '1'){
                                            ?>
                                            <i class="ph ph-seal-check"></i>
                                            <?php
                                        }
                                        ?>
                                    </h4>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['reporting_manager_job'];?></p>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['designation_job'];?></p>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['name_job'];?></p>
                                    <p class="desc text-secondary mt-1"><?php echo $fetch_exp[$i]['email_job'];?></p>
                                        <?php
                                    }
                                    ?>
                                </li>
                                <hr>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>


                    <!--education part start-->
                    <div class="jobs w-full overflow-hidden p-8 mt-7.5 rounded-lg bg-white shadow-sm">
                        <h5 class="heading5">Education</h5>
                        <ul class="list_related flex flex-col md:gap-7.5 gap-6 w-full mt-5">
                            <?php
                            $fetch_global_education = $db_handle->runQuery("SELECT * FROM `seller_global_education`,field_of_study WHERE seller_global_education.global_field_of_study = field_of_study.field_study_id and user_id='$seller'");
                            $fetch_global_education_no = $db_handle->numRows("SELECT * FROM `seller_global_education`,field_of_study WHERE seller_global_education.global_field_of_study = field_of_study.field_study_id and user_id='$seller'");

                            for ($i=0;$i<$fetch_global_education_no;$i++){
                                ?>
                                <li class="jobs_item px-6 py-5 rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                    <div class="jobs_info flex gap-4 w-full pb-4 border-b border-line">
                                        <div class="jobs_content flex items-center justify-between gap-2 w-full">
                                            <a href="javascript:void(0);" class="jobs_detail flex flex-col gap-0.5 duration-300 hover:text-primary" style="cursor: default;">
                                            <span class="jobs_company text-sm font-semibold text-primary"><?php echo $fetch_global_education[$i]['global_level_of_education'];?>
                                                <?php
                                                if($fetch_global_education[$i]['global_certificate_no'] != null){
                                                    ?>
                                                    <i class="ph ph-seal-check"></i>
                                                    <?php
                                                }
                                                ?></span>
                                                <strong class="jobs_name text-title -style-1"><?php echo $fetch_global_education[0]['field_study'];?></strong>
                                                <div class="flex flex-wrap items-center gap-5 gap-y-1">
                                                    <div class="jobs_address -style-1 text-secondary">
                                                        <span class="ph ph-graduation-cap text-lg"></span>
                                                        <span class="address caption1 align-top"><?php echo $fetch_global_education[$i]['global_university'];?></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="jobs_more_info flex flex-wrap items-center justify-between gap-3 pt-4">
                                        <div class="jobs_price">
                                            <span class="price text-title">GPA: <?php echo $fetch_global_education[$i]['global_gpa'];?></span>
                                        </div>
                                    </div>
                                </li>
                                <?php
                            }

                            $fetch_canadian_education = $db_handle->runQuery("SELECT can_level_of_education,university_name, canadian_city_name, study_field, can_gpa,canadian_certificate_number FROM `seller_canadian_education`,`universities`,`canadian_city`,`field_of_study_canadian` WHERE seller_canadian_education.can_field_of_study = field_of_study_canadian.field_study_can_id AND seller_canadian_education.can_college = universities.university_id AND canadian_city.canadian_city_id = seller_canadian_education.can_location AND seller_canadian_education.user_id = '$seller'");
                            $fetch_canadian_education_no = $db_handle->numRows("SELECT can_level_of_education,university_name, canadian_city_name, study_field, can_gpa,canadian_certificate_number FROM `seller_canadian_education`,`universities`,`canadian_city`,`field_of_study_canadian` WHERE seller_canadian_education.can_field_of_study = field_of_study_canadian.field_study_can_id AND seller_canadian_education.can_college = universities.university_id AND canadian_city.canadian_city_id = seller_canadian_education.can_location AND seller_canadian_education.user_id = '$seller'");

                            for ($i = 0; $i < $fetch_canadian_education_no; $i++){
                                ?>
                                <li class="jobs_item px-6 py-5 rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                    <div class="jobs_info flex gap-4 w-full pb-4 border-b border-line">
                                        <div class="jobs_content flex items-center justify-between gap-2 w-full">
                                            <a href="#" class="jobs_detail flex flex-col gap-0.5 duration-300 hover:text-primary">
                                            <span class="jobs_company text-sm font-semibold text-primary"><?php echo $fetch_canadian_education[$i]['can_level_of_education'];?>
                                                <?php
                                                if($fetch_canadian_education[$i]['canadian_certificate_number'] != null)
                                                {
                                                    ?>
                                                    <i class="ph ph-seal-check"></i>
                                                    <?php
                                                }
                                                ?></span>
                                                <strong class="jobs_name text-title -style-1"><?php echo $fetch_canadian_education[$i]['study_field'];?></strong>
                                                <div class="flex flex-wrap items-center gap-5 gap-y-1">
                                                    <div class="jobs_address -style-1 text-secondary">
                                                        <span class="ph ph-graduation-cap text-lg"></span>
                                                        <span class="address caption1 align-top"><?php echo $fetch_canadian_education[$i]['university_name'];?></span>
                                                    </div>
                                                    <div class="jobs_date text-secondary">
                                                        <span class="ph ph-map-pin-line text-lg"></span>
                                                        <span class="date caption1 align-top"><?php echo $fetch_canadian_education[$i]['canadian_city_name'];?></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="jobs_more_info flex flex-wrap items-center justify-between gap-3 pt-4">
                                        <div class="jobs_price">
                                            <span class="price text-title">GPA: <?php echo $fetch_canadian_education[$i]['can_gpa'];?></span>
                                        </div>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <!--<button type="button" class="w-full h-12 px-4 mt-2 button-main -border mt-5" onclick="copyURL()">Copy URL</button>-->
                        <script>
                            function copyURL() {
                                navigator.clipboard.writeText("www.zeroed.one/IHM-View?seller=<?php
                                    $fetch_exp = $db_handle->runQuery("SELECT * FROM `sellers` where seller_id = '$seller'");
                                    $fetch_exp_no = $db_handle->numRows("SELECT * FROM `sellers` where seller_id = '$seller'");
                                    for ($i=0; $i<$fetch_exp_no; $i++) {
                                        echo $fetch_exp[$i]['unique_id'];
                                    }
                                    ?>");
                                alert('URL Copied');
                            }
                        </script>
                    </div>
                    <!--education part end-->


                </div>
                <div class="right flex-shrink-0 lg:w-[29.5%] lg:pl-7.5">
                    <div class="sticky top-5 w-full">
                        <div class="list_social mt-7.5 rounded-lg bg-white shadow-sm">
                            <?php
                            $fetch_exp = $db_handle->runQuery("SELECT * FROM `seller_video` where user_id = '$seller'");
                            $fetch_exp_no = $db_handle->numRows("SELECT * FROM `seller_video` where user_id = '$seller'");
                            for ($i=0; $i<$fetch_exp_no; $i++) {
                                ?>
                                <iframe src="videos/<?php echo $fetch_exp[$i]['video_src'];?>" style="height: 800px; width: 100%"></iframe>
                                <?php
                            }
                            ?>
                        </div>

                    </div>
                </div>

                <!-- Button to Open Popup -->
                <button id="openPopup" class="fixed bottom-5 right-5 z-[1000] bg-blue-500 text-white p-4 rounded-full shadow-lg hover:bg-blue-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 15h6M21 12c0 4.418-4.03 8-9 8-1.61 0-3.14-.385-4.45-1.06L3 21l1.16-4.69C2.84 15.135 3 13.596 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </button>


                <!-- Popup Container -->
                <div id="popupContainer" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[1000] hidden">
                    <!-- Popup Box -->
                    <div class="relative bg-white w-full max-w-lg p-8 rounded-lg shadow-lg">
                        <!-- Close Button -->
                        <button id="closePopup" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-2xl">&times;</button>

                        <!-- Contact Form -->
                        <div class="list_social rounded-lg">
                            <form class="form_change grid grid-cols-2 gap-5 w-full p-10 rounded-lg bg-white shadow-sm" action="Insert" method="POST">
                                <div class="email col-span-full flex flex-col">
                                    <label for="full_name" class="w-fit">Your Name: <span class="text-red">*</span></label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="full_name" name="full_name" type="text" placeholder="Your Name..." required>
                                </div>

                                <div class="email col-span-full flex flex-col">
                                    <label for="email" class="w-fit">Your Company Email: <span class="text-red">*</span></label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg company-email" id="email" type="email" name="email" placeholder="Your Company Email..." required>
                                    <small class="error-message text-red-500 hidden">Please enter a valid company email.</small>
                                </div>

                                <div class="email col-span-full flex flex-col">
                                    <label for="message" class="w-fit">Your Message: <span class="text-red">*</span></label>
                                    <div class="quick-messages mt-2 space-x-2">
                                        <button type="button" class="quick-msg bg-gray-200 px-3 py-1 rounded-lg mt-3">I am interested in your services.</button>
                                        <button type="button" class="quick-msg bg-gray-200 px-3 py-1 rounded-lg mt-3">Can we schedule a meeting?</button>
                                        <button type="button" class="quick-msg bg-gray-200 px-3 py-1 rounded-lg mt-3">Hi <?php echo $fetch_profile[0]['first_name'].' '.$fetch_profile[0]['last_name'];?>, email your resume at (put your email address here)</button>
                                    </div>
                                    <textarea class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="message" name="message" required></textarea>
                                </div>

                                <input type="hidden" value="<?php echo $seller; ?>" name="seller_id">
                                <input type="hidden" value="<?php echo $_GET['seller']; ?>" name="seller_unique">

                                <div class="block_btn col-span-full flex flex-col">
                                    <button class="w-full button-main btn_change_password" type="submit" name="send_seller_email" id="submitBtn">Send Email</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- JavaScript for Popup Toggle -->
                <script>
                    document.getElementById('openPopup').addEventListener('click', function() {
                        document.getElementById('popupContainer').classList.remove('hidden');
                    });

                    document.getElementById('closePopup').addEventListener('click', function() {
                        document.getElementById('popupContainer').classList.add('hidden');
                    });

                    document.getElementById('popupContainer').addEventListener('click', function(event) {
                        if (event.target === this) {
                            this.classList.add('hidden');
                        }
                    });
                </script>

                <script>
                    function copyURL() {
                        navigator.clipboard.writeText("https://zeroed.one/IHM-View?seller=<?php
                            $fetch_exp = $db_handle->runQuery("SELECT * FROM `sellers` where seller_id = '$seller'");
                            $fetch_exp_no = $db_handle->numRows("SELECT * FROM `sellers` where seller_id = '$seller'");
                            for ($i=0; $i<$fetch_exp_no; $i++) {
                                echo $fetch_exp[$i]['unique_id'];
                            }
                            ?>");
                        alert('URL Copied');
                    }
                </script>
            </div>
        </div>
        <?php
        include ('include/dashboard_footer.php');
        ?>
    </div>
</div>

<!-- Menu mobile -->
<?php include ("include/mobile_menu.php");?>

<!-- Modal -->
<?php include ('include/modal.php');?>


<?php include ('include/script.php');?>

<script>
    // Predefined message filling
    document.querySelectorAll('.quick-msg').forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('message').value = button.textContent;
        });
    });

    // Email validation for company domain
    const emailInput = document.querySelector('.company-email');
    const submitBtn = document.getElementById('submitBtn');
    const errorMessage = document.querySelector('.error-message');

    emailInput.addEventListener('input', function() {
        const email = this.value.trim();  // Trim any extra spaces
        const domain = email.split('@')[1]?.toLowerCase();  // Convert the domain to lowercase
        const blockedDomains = ['gmail.com', 'yahoo.com','hotmail.com','yandex.com']; // List of domains that are NOT allowed

        if (domain && !blockedDomains.includes(domain)) {
            errorMessage.classList.add('hidden');
            submitBtn.disabled = false;
        } else {
            errorMessage.classList.remove('hidden');
            submitBtn.disabled = true;
        }
    });
</script>
</body>
</html>
