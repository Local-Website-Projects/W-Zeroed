<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$inserted_at = date("Y-m-d H:i:s");
if(!isset($_SESSION['seller_id'])){
    echo "
    <script>
    window.location.href='Login'
</script>
    ";
}

function autoload_libphonenumber($class) {
    // Set the base directory to point directly to the src folder
    $base_dir = __DIR__ . '/libphonenumber/src/'; // __DIR__ ensures we're working from the current directory

    // Convert the namespace to a file path (e.g., libphonenumber\PhoneNumberUtil to PhoneNumberUtil.php)
    // Replace the namespace separator `\` with `/` and remove the `libphonenumber` part
    $class = str_replace('libphonenumber\\', '', $class);  // Remove the `libphonenumber` namespace part

    // Construct the full path to the class file
    $file = $base_dir . str_replace('\\', '/', $class) . '.php';

    // Check if the file exists and include it, else show an error
    if (file_exists($file)) {
        require_once $file;
    } else {
        echo "Class file not found: " . $file; // Debug message to find the missing file
    }
}

spl_autoload_register('autoload_libphonenumber');

// Include libphonenumber classes manually using autoloader
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;

// Initialize phone number utility
$phoneUtil = PhoneNumberUtil::getInstance();

// Initialize variables
$validationMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get country code and contact number from the form
    $country_code = $_POST['country_code'];
    $contact_number = $_POST['contact_number'];

    try {
        // Parse the phone number
        $number = $phoneUtil->parse($contact_number, $country_code);

        // Check if the phone number is valid
        if ($phoneUtil->isValidNumber($number)) {
            $validationMessage = "Phone number is valid!";
        } else {
            $validationMessage = "Phone number is invalid!";
        }
    } catch (Exception $e) {
        // If there is an error in parsing the phone number
        $validationMessage = "Error parsing phone number: " . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Zeroed - Job Board & Freelance Marketplace" />
    <title>Zeroed - Set Profile</title>
    <?php include ('include/css.php');?>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery (required for Select2) -->
    <script src="assets/js/jquery.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        .sub-skill-item {
            padding: 10px;
            margin: 5px;
            background-color: #f0f0f0;
            cursor: pointer;
            border-radius: 5px;
            display: inline-block;
        }
        .sub-skill-item:hover {
            background-color: #d0d0d0;
        }
        .selected-tags {
            margin-top: 20px;
        }
        .tag {
            display: inline-block;
            background-color: #00c5ff;
            color: white;
            padding: 5px 10px;
            margin: 5px;
            border-radius: 5px;
        }
        .tag .remove {
            cursor: pointer;
            margin-left: 10px;
        }
        .remove_btn {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .remove_btn:hover {
            background-color: #ff1a1a;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 26px;
            position: absolute;
            top: 18px;
            right: 1px;
            width: 20px;
        }

        .select2-container--default .select2-selection--single {
            margin-top: 8px !important;
            height: 47px !important;
            border: 1px solid #e4e4e4 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 28px;
            margin-top: 7px !important;
        }
    </style>
</head>

<body class="lg:overflow-hidden">
<!-- Header -->
<?php include ('include/header.php');?>

<div class="dashboard_main overflow-hidden lg:w-screen flex sm:pt-20 pt-16">

    <div class="dashboard_payouts scrollbar_custom w-full bg-surface">
        <div class="container h-fit lg:pt-15 lg:pb-30 max-lg:py-12 max-sm:py-8">
            <button class="btn_open_popup btn_menu_dashboard flex items-center gap-2 lg:hidden" data-type="menu_dashboard">
                <span class="ph ph-squares-four text-xl"></span>
            </button>
            <div class="list_category p-6 mt-7.5 rounded-lg bg-white">

                <h5 class="heading5" style="margin-top: 0 !important;">Personal Information</h5>
                <form class="form" method="post" action="Insert" enctype="multipart/form-data">
                    <!--personal information section start-->
                    <div class="grid sm:grid-cols-3 gap-3">
                        <div class="firstName">
                            <label for="firstName">First name <span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="firstName" type="text" placeholder="Enter first name" autocomplete="off" name="first_name" required />
                        </div>
                        <div class="lastName">
                            <label for="lastName">Last name <span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="lastName" type="text" placeholder="Enter last name" autocomplete="off" name="last_name" required />
                        </div>
                        <div class="profile">
                            <label for="profile">Profile Image<span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="profile" type="file" name="profile_image" required />
                        </div>
                        <div class="gender">
                            <label for="gender">Gender <span class="text-red">* </span></label><br/>
                            <input class="px-4 mt-2 border-line rounded-lg" id="gender" type="radio" name="gender" value="male" required />
                            <label for="gender" style="padding-right: 20px;">Male</label>
                            <input class="px-4 mt-2 border-line rounded-lg" id="gender" type="radio" name="gender" value="female" required />
                            <label for="gender" style="padding-right: 20px;">Female</label>
                            <input class="px-4 mt-2 border-line rounded-lg" id="gender" type="radio" name="gender" value="Other" required />
                            <label for="gender" style="padding-right: 20px;">Other</label>
                        </div>
                        <div class="nationality">
                            <label>Nationality <span class="text-red">*</span></label>
                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity))" id="mySelect2" name="nationality" required>
                                <option disabled selected>Please select your nationality</option>
                                <?php
                                $fetch_country = $db_handle->runQuery("SELECT id,nationality FROM countries");
                                foreach($fetch_country as $country){
                                    ?>
                                    <option value="<?php echo $country['id'];?>" <?php if ($country['id'] == 32) echo "selected"?>><?php echo $country['nationality'];?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="country">
                            <label>Country <span class="text-red">*</span></label>
                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg country_select" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity))" onchange="loadStates()" name="country" required>
                                <option selected>Please select your country</option>
                            </select>
                        </div>
                        <div class="state">
                            <label>State / Province <span class="text-red">*</span></label>
                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg state_select" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity))" onchange="loadCities()" name="state">
                                <option selected>Please select state</option>
                            </select>
                            <!-- Hidden field to store the full state name -->
                            <input type="hidden" id="stateName" name="state_name">
                        </div>
                        <div class="city">
                            <label>Current City <span class="text-red">*</span></label>
                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg city_select" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity))" name="city">
                                <option selected>Please select city</option>
                            </select>
                            <!-- Hidden field to store the full city name -->
                            <input type="hidden" id="cityName" name="city_name">
                        </div>

                        <div class="contactno">
                            <label for="contactno">Contact No <span class="text-red">*</span></label>
                            <div class="flex space-x-2">
                                <select class="h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity)); width: 40%" name="country_code" required>
                                    <option selected>Code</option>
                                    <option value="+93" <?php echo isset($country_code) && $country_code == 'AF' ? 'selected' : ''; ?>>AF (+93)</option>
                                    <option value="+355" <?php echo isset($country_code) && $country_code == 'AL' ? 'selected' : ''; ?>>AL (+355)</option>
                                    <option value="+213" <?php echo isset($country_code) && $country_code == 'DZ' ? 'selected' : ''; ?>>DZ (+213)</option>
                                    <option value="+376" <?php echo isset($country_code) && $country_code == 'AD' ? 'selected' : ''; ?>>AD (+376)</option>
                                    <option value="+244" <?php echo isset($country_code) && $country_code == 'AO' ? 'selected' : ''; ?>>AO (+244)</option>
                                    <option value="+1-268" <?php echo isset($country_code) && $country_code == 'AG' ? 'selected' : ''; ?>>AG (+1-268)</option>
                                    <option value="+54" <?php echo isset($country_code) && $country_code == 'AR' ? 'selected' : ''; ?>>AR (+54)</option>
                                    <option value="+374" <?php echo isset($country_code) && $country_code == 'AM' ? 'selected' : ''; ?>>AM (+374)</option>
                                    <option value="+61" <?php echo isset($country_code) && $country_code == 'AU' ? 'selected' : ''; ?>>AU (+61)</option>
                                    <option value="+43" <?php echo isset($country_code) && $country_code == 'AT' ? 'selected' : ''; ?>>AT (+43)</option>
                                    <option value="+994" <?php echo isset($country_code) && $country_code == 'AZ' ? 'selected' : ''; ?>>AZ (+994)</option>
                                    <option value="+1-242" <?php echo isset($country_code) && $country_code == 'BS' ? 'selected' : ''; ?>>BS (+1-242)</option>
                                    <option value="+973" <?php echo isset($country_code) && $country_code == 'BH' ? 'selected' : ''; ?>>BH (+973)</option>
                                    <option value="+880" <?php echo isset($country_code) && $country_code == 'BD' ? 'selected' : ''; ?>>BD (+880)</option>
                                    <option value="+1-246" <?php echo isset($country_code) && $country_code == 'BB' ? 'selected' : ''; ?>>BB (+1-246)</option>
                                    <option value="+375" <?php echo isset($country_code) && $country_code == 'BY' ? 'selected' : ''; ?>>BY (+375)</option>
                                    <option value="+32" <?php echo isset($country_code) && $country_code == 'BE' ? 'selected' : ''; ?>>BE (+32)</option>
                                    <option value="+501" <?php echo isset($country_code) && $country_code == 'BZ' ? 'selected' : ''; ?>>BZ (+501)</option>
                                    <option value="+229" <?php echo isset($country_code) && $country_code == 'BJ' ? 'selected' : ''; ?>>BJ (+229)</option>
                                    <option value="+975" <?php echo isset($country_code) && $country_code == 'BT' ? 'selected' : ''; ?>>BT (+975)</option>
                                    <option value="+591" <?php echo isset($country_code) && $country_code == 'BO' ? 'selected' : ''; ?>>BO (+591)</option>
                                    <option value="+387" <?php echo isset($country_code) && $country_code == 'BA' ? 'selected' : ''; ?>>BA (+387)</option>
                                    <option value="+267" <?php echo isset($country_code) && $country_code == 'BW' ? 'selected' : ''; ?>>BW (+267)</option>
                                    <option value="+55" <?php echo isset($country_code) && $country_code == 'BR' ? 'selected' : ''; ?>>BR (+55)</option>
                                    <option value="+673" <?php echo isset($country_code) && $country_code == 'BN' ? 'selected' : ''; ?>>BN (+673)</option>
                                    <option value="+359" <?php echo isset($country_code) && $country_code == 'BG' ? 'selected' : ''; ?>>BG (+359)</option>
                                    <option value="+226" <?php echo isset($country_code) && $country_code == 'BF' ? 'selected' : ''; ?>>BF (+226)</option>
                                    <option value="+257" <?php echo isset($country_code) && $country_code == 'BI' ? 'selected' : ''; ?>>BI (+257)</option>
                                    <option value="+238" <?php echo isset($country_code) && $country_code == 'CV' ? 'selected' : ''; ?>>CV (+238)</option>
                                    <option value="+855" <?php echo isset($country_code) && $country_code == 'KH' ? 'selected' : ''; ?>>KH (+855)</option>
                                    <option value="+237" <?php echo isset($country_code) && $country_code == 'CM' ? 'selected' : ''; ?>>CM (+237)</option>
                                    <option value="+1" <?php echo isset($country_code) && $country_code == 'CA' ? 'selected' : ''; ?>>CA (+1)</option>
                                    <option value="+236" <?php echo isset($country_code) && $country_code == 'CF' ? 'selected' : ''; ?>>CF (+236)</option>
                                    <option value="+235" <?php echo isset($country_code) && $country_code == 'TD' ? 'selected' : ''; ?>>TD (+235)</option>
                                    <option value="+56" <?php echo isset($country_code) && $country_code == 'CL' ? 'selected' : ''; ?>>CL (+56)</option>
                                    <option value="+86" <?php echo isset($country_code) && $country_code == 'CN' ? 'selected' : ''; ?>>CN (+86)</option>
                                    <option value="+57" <?php echo isset($country_code) && $country_code == 'CO' ? 'selected' : ''; ?>>CO (+57)</option>
                                    <option value="+269" <?php echo isset($country_code) && $country_code == 'KM' ? 'selected' : ''; ?>>KM (+269)</option>
                                    <option value="+243" <?php echo isset($country_code) && $country_code == 'CD' ? 'selected' : ''; ?>>CD (+243)</option>
                                    <option value="+242" <?php echo isset($country_code) && $country_code == 'CG' ? 'selected' : ''; ?>>CG (+242)</option>
                                    <option value="+506" <?php echo isset($country_code) && $country_code == 'CR' ? 'selected' : ''; ?>>CR (+506)</option>
                                    <option value="+225" <?php echo isset($country_code) && $country_code == 'CI' ? 'selected' : ''; ?>>CI (+225)</option>
                                    <option value="+385" <?php echo isset($country_code) && $country_code == 'HR' ? 'selected' : ''; ?>>HR (+385)</option>
                                    <option value="+53" <?php echo isset($country_code) && $country_code == 'CU' ? 'selected' : ''; ?>>CU (+53)</option>
                                    <option value="+357" <?php echo isset($country_code) && $country_code == 'CY' ? 'selected' : ''; ?>>CY (+357)</option>
                                    <option value="+420" <?php echo isset($country_code) && $country_code == 'CZ' ? 'selected' : ''; ?>>CZ (+420)</option>
                                    <option value="+45" <?php echo isset($country_code) && $country_code == 'DK' ? 'selected' : ''; ?>>DK (+45)</option>
                                    <option value="+253" <?php echo isset($country_code) && $country_code == 'DJ' ? 'selected' : ''; ?>>DJ (+253)</option>
                                    <option value="+1-767" <?php echo isset($country_code) && $country_code == 'DM' ? 'selected' : ''; ?>>DM (+1-767)</option>
                                    <option value="+1-809" <?php echo isset($country_code) && $country_code == 'DO' ? 'selected' : ''; ?>>DO (+1-809)</option>
                                    <option value="+670" <?php echo isset($country_code) && $country_code == 'TL' ? 'selected' : ''; ?>>TL (+670)</option>
                                    <option value="+593" <?php echo isset($country_code) && $country_code == 'EC' ? 'selected' : ''; ?>>EC (+593)</option>
                                    <option value="+20" <?php echo isset($country_code) && $country_code == 'EG' ? 'selected' : ''; ?>>EG (+20)</option>
                                    <option value="+503" <?php echo isset($country_code) && $country_code == 'SV' ? 'selected' : ''; ?>>SV (+503)</option>
                                    <option value="+240" <?php echo isset($country_code) && $country_code == 'GQ' ? 'selected' : ''; ?>>GQ (+240)</option>
                                    <option value="+291" <?php echo isset($country_code) && $country_code == 'ER' ? 'selected' : ''; ?>>ER (+291)</option>
                                    <option value="+372" <?php echo isset($country_code) && $country_code == 'EE' ? 'selected' : ''; ?>>EE (+372)</option>
                                    <option value="+268" <?php echo isset($country_code) && $country_code == 'SZ' ? 'selected' : ''; ?>>SZ (+268)</option>
                                    <option value="+251" <?php echo isset($country_code) && $country_code == 'ET' ? 'selected' : ''; ?>>ET (+251)</option>
                                    <option value="+679" <?php echo isset($country_code) && $country_code == 'FJ' ? 'selected' : ''; ?>>FJ (+679)</option>
                                    <option value="+358" <?php echo isset($country_code) && $country_code == 'FI' ? 'selected' : ''; ?>>FI (+358)</option>
                                    <option value="+33" <?php echo isset($country_code) && $country_code == 'FR' ? 'selected' : ''; ?>>FR (+33)</option>
                                    <option value="+241" <?php echo isset($country_code) && $country_code == 'GA' ? 'selected' : ''; ?>>GA (+241)</option>
                                    <option value="+220" <?php echo isset($country_code) && $country_code == 'GM' ? 'selected' : ''; ?>>GM (+220)</option>
                                    <option value="+995" <?php echo isset($country_code) && $country_code == 'GE' ? 'selected' : ''; ?>>GE (+995)</option>
                                    <option value="+49" <?php echo isset($country_code) && $country_code == 'DE' ? 'selected' : ''; ?>>DE (+49)</option>
                                    <option value="+233" <?php echo isset($country_code) && $country_code == 'GH' ? 'selected' : ''; ?>>GH (+233)</option>
                                    <option value="+30" <?php echo isset($country_code) && $country_code == 'GR' ? 'selected' : ''; ?>>GR (+30)</option>
                                    <option value="+1-473" <?php echo isset($country_code) && $country_code == 'GD' ? 'selected' : ''; ?>>GD (+1-473)</option>
                                    <option value="+502" <?php echo isset($country_code) && $country_code == 'GT' ? 'selected' : ''; ?>>GT (+502)</option>
                                    <option value="+224" <?php echo isset($country_code) && $country_code == 'GN' ? 'selected' : ''; ?>>GN (+224)</option>
                                    <option value="+245" <?php echo isset($country_code) && $country_code == 'GW' ? 'selected' : ''; ?>>GW (+245)</option>
                                    <option value="+592" <?php echo isset($country_code) && $country_code == 'GY' ? 'selected' : ''; ?>>GY (+592)</option>
                                    <option value="+509" <?php echo isset($country_code) && $country_code == 'HT' ? 'selected' : ''; ?>>HT (+509)</option>
                                    <option value="+504" <?php echo isset($country_code) && $country_code == 'HN' ? 'selected' : ''; ?>>HN (+504)</option>
                                    <option value="+36" <?php echo isset($country_code) && $country_code == 'HU' ? 'selected' : ''; ?>>HU (+36)</option>
                                    <option value="+354" <?php echo isset($country_code) && $country_code == 'IS' ? 'selected' : ''; ?>>IS (+354)</option>
                                    <option value="+91" <?php echo isset($country_code) && $country_code == 'IN' ? 'selected' : ''; ?>>IN (+91)</option>
                                    <option value="+62" <?php echo isset($country_code) && $country_code == 'ID' ? 'selected' : ''; ?>>ID (+62)</option>
                                    <option value="+98" <?php echo isset($country_code) && $country_code == 'IR' ? 'selected' : ''; ?>>IR (+98)</option>
                                    <option value="+964" <?php echo isset($country_code) && $country_code == 'IQ' ? 'selected' : ''; ?>>IQ (+964)</option>
                                    <option value="+353" <?php echo isset($country_code) && $country_code == 'IE' ? 'selected' : ''; ?>>IE (+353)</option>
                                    <option value="+972" <?php echo isset($country_code) && $country_code == 'IL' ? 'selected' : ''; ?>>IL (+972)</option>
                                    <option value="+39" <?php echo isset($country_code) && $country_code == 'IT' ? 'selected' : ''; ?>>IT (+39)</option>
                                    <option value="+1-876" <?php echo isset($country_code) && $country_code == 'JM' ? 'selected' : ''; ?>>JM (+1-876)</option>
                                    <option value="+81" <?php echo isset($country_code) && $country_code == 'JP' ? 'selected' : ''; ?>>JP (+81)</option>
                                    <option value="+962" <?php echo isset($country_code) && $country_code == 'JO' ? 'selected' : ''; ?>>JO (+962)</option>
                                    <option value="+7" <?php echo isset($country_code) && $country_code == 'KZ' ? 'selected' : ''; ?>>KZ (+7)</option>
                                    <option value="+254" <?php echo isset($country_code) && $country_code == 'KE' ? 'selected' : ''; ?>>KE (+254)</option>
                                    <option value="+686" <?php echo isset($country_code) && $country_code == 'KI' ? 'selected' : ''; ?>>KI (+686)</option>
                                    <option value="+850" <?php echo isset($country_code) && $country_code == 'KP' ? 'selected' : ''; ?>>KP (+850)</option>
                                    <option value="+82" <?php echo isset($country_code) && $country_code == 'KR' ? 'selected' : ''; ?>>KR (+82)</option>
                                    <option value="+383" <?php echo isset($country_code) && $country_code == 'XK' ? 'selected' : ''; ?>>XK (+383)</option>
                                    <option value="+965" <?php echo isset($country_code) && $country_code == 'KW' ? 'selected' : ''; ?>>KW (+965)</option>
                                    <option value="+996" <?php echo isset($country_code) && $country_code == 'KG' ? 'selected' : ''; ?>>KG (+996)</option>
                                    <option value="+856" <?php echo isset($country_code) && $country_code == 'LA' ? 'selected' : ''; ?>>LA (+856)</option>
                                    <option value="+371" <?php echo isset($country_code) && $country_code == 'LV' ? 'selected' : ''; ?>>LV (+371)</option>
                                    <option value="+961" <?php echo isset($country_code) && $country_code == 'LB' ? 'selected' : ''; ?>>LB (+961)</option>
                                    <option value="+266" <?php echo isset($country_code) && $country_code == 'LS' ? 'selected' : ''; ?>>LS (+266)</option>
                                    <option value="+231" <?php echo isset($country_code) && $country_code == 'LR' ? 'selected' : ''; ?>>LR (+231)</option>
                                    <option value="+218" <?php echo isset($country_code) && $country_code == 'LY' ? 'selected' : ''; ?>>LY (+218)</option>
                                    <option value="+423" <?php echo isset($country_code) && $country_code == 'LI' ? 'selected' : ''; ?>>LI (+423)</option>
                                    <option value="+370" <?php echo isset($country_code) && $country_code == 'LT' ? 'selected' : ''; ?>>LT (+370)</option>
                                    <option value="+352" <?php echo isset($country_code) && $country_code == 'LU' ? 'selected' : ''; ?>>LU (+352)</option>
                                    <option value="+261" <?php echo isset($country_code) && $country_code == 'MG' ? 'selected' : ''; ?>>MG (+261)</option>
                                    <option value="+265" <?php echo isset($country_code) && $country_code == 'MW' ? 'selected' : ''; ?>>MW (+265)</option>
                                    <option value="+60" <?php echo isset($country_code) && $country_code == 'MY' ? 'selected' : ''; ?>>MY (+60)</option>
                                    <option value="+960" <?php echo isset($country_code) && $country_code == 'MV' ? 'selected' : ''; ?>>MV (+960)</option>
                                    <option value="+223" <?php echo isset($country_code) && $country_code == 'ML' ? 'selected' : ''; ?>>ML (+223)</option>
                                    <option value="+356" <?php echo isset($country_code) && $country_code == 'MT' ? 'selected' : ''; ?>>MT (+356)</option>
                                    <option value="+692" <?php echo isset($country_code) && $country_code == 'MH' ? 'selected' : ''; ?>>MH (+692)</option>
                                    <option value="+222" <?php echo isset($country_code) && $country_code == 'MR' ? 'selected' : ''; ?>>MR (+222)</option>
                                    <option value="+230" <?php echo isset($country_code) && $country_code == 'MU' ? 'selected' : ''; ?>>MU (+230)</option>
                                    <option value="+52" <?php echo isset($country_code) && $country_code == 'MX' ? 'selected' : ''; ?>>MX (+52)</option>
                                    <option value="+691" <?php echo isset($country_code) && $country_code == 'FM' ? 'selected' : ''; ?>>FM (+691)</option>
                                    <option value="+373" <?php echo isset($country_code) && $country_code == 'MD' ? 'selected' : ''; ?>>MD (+373)</option>
                                    <option value="+377" <?php echo isset($country_code) && $country_code == 'MC' ? 'selected' : ''; ?>>MC (+377)</option>
                                    <option value="+976" <?php echo isset($country_code) && $country_code == 'MN' ? 'selected' : ''; ?>>MN (+976)</option>
                                    <option value="+382" <?php echo isset($country_code) && $country_code == 'ME' ? 'selected' : ''; ?>>ME (+382)</option>
                                    <option value="+212" <?php echo isset($country_code) && $country_code == 'MA' ? 'selected' : ''; ?>>MA (+212)</option>
                                    <option value="+258" <?php echo isset($country_code) && $country_code == 'MZ' ? 'selected' : ''; ?>>MZ (+258)</option>
                                    <option value="+95" <?php echo isset($country_code) && $country_code == 'MM' ? 'selected' : ''; ?>>MM (+95)</option>
                                    <option value="+264" <?php echo isset($country_code) && $country_code == 'NA' ? 'selected' : ''; ?>>NA (+264)</option>
                                    <option value="+674" <?php echo isset($country_code) && $country_code == 'NR' ? 'selected' : ''; ?>>NR (+674)</option>
                                    <option value="+977" <?php echo isset($country_code) && $country_code == 'NP' ? 'selected' : ''; ?>>NP (+977)</option>
                                    <option value="+31" <?php echo isset($country_code) && $country_code == 'NL' ? 'selected' : ''; ?>>NL (+31)</option>
                                    <option value="+64" <?php echo isset($country_code) && $country_code == 'NZ' ? 'selected' : ''; ?>>NZ (+64)</option>
                                    <option value="+505" <?php echo isset($country_code) && $country_code == 'NI' ? 'selected' : ''; ?>>NI (+505)</option>
                                    <option value="+227" <?php echo isset($country_code) && $country_code == 'NE' ? 'selected' : ''; ?>>NE (+227)</option>
                                    <option value="+234" <?php echo isset($country_code) && $country_code == 'NG' ? 'selected' : ''; ?>>NG (+234)</option>
                                    <option value="+389" <?php echo isset($country_code) && $country_code == 'MK' ? 'selected' : ''; ?>>MK (+389)</option>
                                    <option value="+47" <?php echo isset($country_code) && $country_code == 'NO' ? 'selected' : ''; ?>>NO (+47)</option>
                                    <option value="+968" <?php echo isset($country_code) && $country_code == 'OM' ? 'selected' : ''; ?>>OM (+968)</option>
                                    <option value="+92" <?php echo isset($country_code) && $country_code == 'PK' ? 'selected' : ''; ?>>PK (+92)</option>
                                    <option value="+680" <?php echo isset($country_code) && $country_code == 'PW' ? 'selected' : ''; ?>>PW (+680)</option>
                                    <option value="+507" <?php echo isset($country_code) && $country_code == 'PA' ? 'selected' : ''; ?>>PA (+507)</option>
                                    <option value="+675" <?php echo isset($country_code) && $country_code == 'PG' ? 'selected' : ''; ?>>PG (+675)</option>
                                    <option value="+595" <?php echo isset($country_code) && $country_code == 'PY' ? 'selected' : ''; ?>>PY (+595)</option>
                                    <option value="+51" <?php echo isset($country_code) && $country_code == 'PE' ? 'selected' : ''; ?>>PE (+51)</option>
                                    <option value="+63" <?php echo isset($country_code) && $country_code == 'PH' ? 'selected' : ''; ?>>PH (+63)</option>
                                    <option value="+48" <?php echo isset($country_code) && $country_code == 'PL' ? 'selected' : ''; ?>>PL (+48)</option>
                                    <option value="+351" <?php echo isset($country_code) && $country_code == 'PT' ? 'selected' : ''; ?>>PT (+351)</option>
                                    <option value="+974" <?php echo isset($country_code) && $country_code == 'QA' ? 'selected' : ''; ?>>QA (+974)</option>
                                    <option value="+40" <?php echo isset($country_code) && $country_code == 'RO' ? 'selected' : ''; ?>>RO (+40)</option>
                                    <option value="+7" <?php echo isset($country_code) && $country_code == 'RU' ? 'selected' : ''; ?>>RU (+7)</option>
                                    <option value="+250" <?php echo isset($country_code) && $country_code == 'RW' ? 'selected' : ''; ?>>RW (+250)</option>
                                    <option value="+1 869" <?php echo isset($country_code) && $country_code == 'KN' ? 'selected' : ''; ?>>KN (+1 869)</option>
                                    <option value="+1 758" <?php echo isset($country_code) && $country_code == 'LC' ? 'selected' : ''; ?>>LC (+1 758)</option>
                                    <option value="+1 784" <?php echo isset($country_code) && $country_code == 'VC' ? 'selected' : ''; ?>>VC (+1 784)</option>
                                    <option value="+685" <?php echo isset($country_code) && $country_code == 'WS' ? 'selected' : ''; ?>>WS (+685)</option>
                                    <option value="+378" <?php echo isset($country_code) && $country_code == 'SM' ? 'selected' : ''; ?>>SM (+378)</option>
                                    <option value="+239" <?php echo isset($country_code) && $country_code == 'ST' ? 'selected' : ''; ?>>ST (+239)</option>
                                    <option value="+966" <?php echo isset($country_code) && $country_code == 'SA' ? 'selected' : ''; ?>>SA (+966)</option>
                                    <option value="+221" <?php echo isset($country_code) && $country_code == 'SN' ? 'selected' : ''; ?>>SN (+221)</option>
                                    <option value="+381" <?php echo isset($country_code) && $country_code == 'RS' ? 'selected' : ''; ?>>RS (+381)</option>
                                    <option value="+248" <?php echo isset($country_code) && $country_code == 'SC' ? 'selected' : ''; ?>>SC (+248)</option>
                                    <option value="+232" <?php echo isset($country_code) && $country_code == 'SL' ? 'selected' : ''; ?>>SL (+232)</option>
                                    <option value="+65" <?php echo isset($country_code) && $country_code == 'SG' ? 'selected' : ''; ?>>SG (+65)</option>
                                    <option value="+421" <?php echo isset($country_code) && $country_code == 'SK' ? 'selected' : ''; ?>>SK (+421)</option>
                                    <option value="+386" <?php echo isset($country_code) && $country_code == 'SI' ? 'selected' : ''; ?>>SI (+386)</option>
                                    <option value="+677" <?php echo isset($country_code) && $country_code == 'SB' ? 'selected' : ''; ?>>SB (+677)</option>
                                    <option value="+252" <?php echo isset($country_code) && $country_code == 'SO' ? 'selected' : ''; ?>>SO (+252)</option>
                                    <option value="+27" <?php echo isset($country_code) && $country_code == 'ZA' ? 'selected' : ''; ?>>ZA (+27)</option>
                                    <option value="+34" <?php echo isset($country_code) && $country_code == 'ES' ? 'selected' : ''; ?>>ES (+34)</option>
                                    <option value="+94" <?php echo isset($country_code) && $country_code == 'LK' ? 'selected' : ''; ?>>LK (+94)</option>
                                    <option value="+249" <?php echo isset($country_code) && $country_code == 'SD' ? 'selected' : ''; ?>>SD (+249)</option>
                                    <option value="+211" <?php echo isset($country_code) && $country_code == 'SS' ? 'selected' : ''; ?>>SS (+211)</option>
                                    <option value="+597" <?php echo isset($country_code) && $country_code == 'SR' ? 'selected' : ''; ?>>SR (+597)</option>
                                    <option value="+46" <?php echo isset($country_code) && $country_code == 'SE' ? 'selected' : ''; ?>>SE (+46)</option>
                                    <option value="+41" <?php echo isset($country_code) && $country_code == 'CH' ? 'selected' : ''; ?>>CH (+41)</option>
                                    <option value="+963" <?php echo isset($country_code) && $country_code == 'SY' ? 'selected' : ''; ?>>SY (+963)</option>
                                    <option value="+886" <?php echo isset($country_code) && $country_code == 'TW' ? 'selected' : ''; ?>>TW (+886)</option>
                                    <option value="+992" <?php echo isset($country_code) && $country_code == 'TJ' ? 'selected' : ''; ?>>TJ (+992)</option>
                                    <option value="+255" <?php echo isset($country_code) && $country_code == 'TZ' ? 'selected' : ''; ?>>TZ (+255)</option>
                                    <option value="+66" <?php echo isset($country_code) && $country_code == 'TH' ? 'selected' : ''; ?>>TH (+66)</option>
                                    <option value="+228" <?php echo isset($country_code) && $country_code == 'TG' ? 'selected' : ''; ?>>TG (+228)</option>
                                    <option value="+676" <?php echo isset($country_code) && $country_code == 'TO' ? 'selected' : ''; ?>>TO (+676)</option>
                                    <option value="+1 868" <?php echo isset($country_code) && $country_code == 'TT' ? 'selected' : ''; ?>>TT (+1 868)</option>
                                    <option value="+216" <?php echo isset($country_code) && $country_code == 'TN' ? 'selected' : ''; ?>>TN (+216)</option>
                                    <option value="+90" <?php echo isset($country_code) && $country_code == 'TR' ? 'selected' : ''; ?>>TR (+90)</option>
                                    <option value="+993" <?php echo isset($country_code) && $country_code == 'TM' ? 'selected' : ''; ?>>TM (+993)</option>
                                    <option value="+688" <?php echo isset($country_code) && $country_code == 'TV' ? 'selected' : ''; ?>>TV (+688)</option>
                                    <option value="+256" <?php echo isset($country_code) && $country_code == 'UG' ? 'selected' : ''; ?>>UG (+256)</option>
                                    <option value="+380" <?php echo isset($country_code) && $country_code == 'UA' ? 'selected' : ''; ?>>UA (+380)</option>
                                    <option value="+971" <?php echo isset($country_code) && $country_code == 'AE' ? 'selected' : ''; ?>>AE (+971)</option>
                                    <option value="+44" <?php echo isset($country_code) && $country_code == 'GB' ? 'selected' : ''; ?>>GB (+44)</option>
                                    <option value="+1" <?php echo isset($country_code) && $country_code == 'US' ? 'selected' : ''; ?>>US (+1)</option>
                                    <option value="+598" <?php echo isset($country_code) && $country_code == 'UY' ? 'selected' : ''; ?>>UY (+598)</option>
                                    <option value="+998" <?php echo isset($country_code) && $country_code == 'UZ' ? 'selected' : ''; ?>>UZ (+998)</option>
                                    <option value="+678" <?php echo isset($country_code) && $country_code == 'VU' ? 'selected' : ''; ?>>VU (+678)</option>
                                    <option value="+39" <?php echo isset($country_code) && $country_code == 'VA' ? 'selected' : ''; ?>>VA (+39)</option>
                                    <option value="+58" <?php echo isset($country_code) && $country_code == 'VE' ? 'selected' : ''; ?>>VE (+58)</option>
                                    <option value="+84" <?php echo isset($country_code) && $country_code == 'VN' ? 'selected' : ''; ?>>VN (+84)</option>
                                    <option value="+967" <?php echo isset($country_code) && $country_code == 'YE' ? 'selected' : ''; ?>>YE (+967)</option>
                                    <option value="+260" <?php echo isset($country_code) && $country_code == 'ZM' ? 'selected' : ''; ?>>ZM (+260)</option>
                                    <option value="+263" <?php echo isset($country_code) && $country_code == 'ZW' ? 'selected' : ''; ?>>ZW (+263)</option>
                                </select>
                                <input class="h-12 px-4 mt-2 border-line rounded-lg" style="width: 65%;" type="text" name="contact_number" id="contact_number" placeholder="Enter phone number" required value="<?php echo isset($contact_number) ? htmlspecialchars($contact_number) : ''; ?>">
                            </div>
                        </div>
                        <div class="contactemail">
                            <label for="contactemail">Contact Email <span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="contact_email" type="text" placeholder="Enter contact email" name="contact_email" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Job preferred location <span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg"
                                   id="jobLocation"
                                   type="text"
                                   placeholder="Enter job preferred location"
                                   autocomplete="off"
                                   name="preferred_job_location"
                                   required />
                            <!--<datalist id="locationList">
                                <option value="Open for relocation"></option>
                                <option value="Alberta"></option>
                                <option value="British Columbia"></option>
                                <option value="Manitoba"></option>
                                <option value="New Brunswick"></option>
                                <option value="Newfoundland and Labrador"></option>
                                <option value="Northwest Territories"></option>
                                <option value="Nova Scotia"></option>
                                <option value="Nunavut"></option>
                                <option value="Ontario"></option>
                                <option value="Prince Edward Island"></option>
                                <option value="Quebec"></option>
                                <option value="Saskatchewan"></option>
                                <option value="Yukon"></option>
                            </datalist>-->
                        </div>
                    </div>

                    <!-- global education -->
                    <div id="educationContainer">
                        <h5 class="heading5 mt-5">Global Education</h5>
                        <!-- Initial Education Set -->
                        <div class="educationSet grid sm:grid-cols-3 gap-3 mt-5">
                            <!-- Level of Education -->
                            <div class="education_level">
                                <label>Level of Education <span class="text-red">*</span></label>
                                <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="global_level_of_education[]" required>
                                    <option selected>Select Level of Education</option>
                                    <option value="Less than high school">Less than high school</option>
                                    <option value="High school graduation">High school graduation</option>
                                    <option value="One year program">One year program</option>
                                    <option value="Two year program">Two year program</option>
                                    <option value="Bachelors Degree">Bachelors Degree</option>
                                    <option value="Masters Degree">Masters Degree</option>
                                    <option value="Doctoral Level">Doctoral Level</option>
                                </select>
                            </div>

                            <!-- Field of Study -->
                            <div class="education_level">
                                <label>Field of Study <span class="text-red">*</span></label>
                                <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="global_field_of_study[]" required>
                                    <option selected>Select Field of Study</option>
                                    <?php
                                    $fetch_field_study = $db_handle->runQuery("select * from field_of_study");
                                    foreach ($fetch_field_study as $row) {
                                        ?>
                                        <option value="<?php echo $row['field_study_id']?>"><?php echo $row['field_study']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- GPA -->
                            <div class="jobLocation">
                                <label for="jobLocation">GPA</label>
                                <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="10" name="global_gpa[]"/>
                            </div>

                            <!-- College/University Name -->
                            <div class="jobLocation">
                                <label for="jobLocation">College/University Name <span class="text-red">*</span></label>
                                <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="College/University Name" name="global_university[]" required />
                            </div>

                            <!-- Credential Accreditation -->
                            <div class="education_level">
                                <label>Credential Accreditation</label>
                                <select class="w-full h-12 px-4 mt-2 border-line rounded-lg accreditation" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="accreditation[]">
                                    <option selected value="N/A">N/A</option>
                                    <option value="WES">WES</option>
                                    <option value="Alberta">Alberta</option>
                                </select>
                            </div>

                            <!-- Certificate number input (initially hidden) -->
                            <div class="jobLocation certificateDiv" style="display: none;">
                                <label for="certificate_number">Certificate No</label>
                                <input class="w-full h-12 px-4 mt-2 border-line rounded-lg certificate_number" type="text" placeholder="certificate number" name="certificate_number[]" />
                            </div>

                            <!-- Remove button for each set -->
                            <button class="removeEducationSet w-full h-12 px-4 mt-2 button-main -border mt-5 bg-red text-white" style="display: none;">Remove Education</button>
                        </div>
                    </div>

                    <!-- Button to add more education sets -->
                    <div class="grid sm:grid-cols-3 gap-3">
                        <button id="addGlobalEducation" class="w-full h-12 px-4 mt-2 button-main -border mt-5">Add Another Education</button>
                    </div>


                    <!--canadian education section starts-->
                    <div id="canadianEducationSection">
                        <!-- Initial Education Section -->
                        <div class="educationSection">
                            <h5 class="heading5 mt-5">Canadian Education</h5>
                            <button type="button" class="toggle_btn"></button>
                            <div class="educationFields grid sm:grid-cols-3 gap-3">
                                <div class="education_level">
                                    <label>Level of Education <span class="text-red">*</span></label>
                                    <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" name="canadian_level_of_education[]" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" disabled>
                                        <option selected>Select Level of Education</option>
                                        <option value="Less than high school">Less than high school</option>
                                        <option value="High school graduation">High school graduation</option>
                                        <option value="One year program">One year program</option>
                                        <option value="Two year program">Two year program</option>
                                        <option value="Bachelors Degree">Bachelors Degree</option>
                                        <option value="Masters Degree">Masters Degree</option>
                                        <option value="Doctoral Level">Doctoral Level</option>
                                    </select>
                                </div>
                                <div class="education_level">
                                    <label>Field of Study <span class="text-red">*</span></label>
                                    <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" name="canadian_field_of_study[]" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" disabled>
                                        <option selected>Select Field of Study</option>
                                        <?php
                                        $fetch_field_study = $db_handle->runQuery("select * from field_of_study_canadian");
                                        foreach ($fetch_field_study as $row) {
                                            ?>
                                            <option value="<?php echo $row['field_study_can_id']?>"><?php echo $row['study_field']?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="education_level">
                                    <label>College/University <span class="text-red">*</span></label>
                                    <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" name="college[]" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" disabled>
                                        <option selected>Select College/University</option>
                                        <?php
                                        $fetch_university = $db_handle->runQuery("select * from universities");
                                        foreach ($fetch_university as $row) {
                                            ?>
                                            <option value="<?php echo $row['university_id']?>"><?php echo $row['university_name']?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="education_level">
                                    <label>Location <span class="text-red">*</span></label>
                                    <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="canadian_study_location[]" disabled>
                                        <option selected>Select City</option>
                                        <?php
                                        $fetch_city = $db_handle->runQuery("select * from canadian_city");
                                        foreach ($fetch_city as $row) {
                                            ?>
                                            <option value="<?php echo $row['canadian_city_id']?>"><?php echo $row['canadian_city_name']?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="jobLocation">
                                    <label for="jobLocation">GPA</label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" placeholder="10" name="canadian_gpa[]" disabled/>
                                </div>
                                <div class="education_level">
                                    <label>Credential Accreditation</label>
                                    <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" name="canadian_accreditation[]" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" disabled>
                                        <option selected value="N/A">N/A</option>
                                        <option value="WES">WES</option>
                                        <option value="Alberta">Alberta</option>
                                    </select>
                                </div>
                                <div class="jobLocation certificateDivCanadian" style="display: none;">
                                    <label for="certificate_number">Certificate No</label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" placeholder="certificate number" name="canadian_certificate_number[]" disabled/>
                                </div>
                            </div>
                            <button type="button" class="remove_btn">Remove</button>
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-3 gap-3">
                        <button id="addCanadianEducation" class="w-full h-12 px-4 mt-2 button-main -border mt-5">Add Another Education</button>
                    </div>



                    <!--skills section starts-->
                    <h5 class="heading5 mt-5">Skill Mapping</h5>
                    <div class="grid sm:grid-cols-4 gap-3">
                        <!-- First set of core skills and sub-skills -->
                        <div class="education_level col-span-1">
                            <label>Core Skill 1 <span class="text-red">*</span></label>
                            <select id="coreSkills1" class="w-full h-12 px-4 mt-2 border-line rounded-lg" name="core_skill_one" required>
                                <option value="" selected disabled>Select Core Skills</option>
                                <?php
                                $fetch_skills = $db_handle->runQuery("SELECT * FROM skills");
                                foreach ($fetch_skills as $row) {
                                    ?>
                                    <option value="<?php echo $row['skill_id']?>"><?php echo $row['core_skill']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="education_level col-span-1">
                            <div id="subSkillsLabel1" style="display: none;">
                                <label>Sub Skills 1</label>
                            </div>
                            <input id="selectedSubSkills1" type="hidden" name="sub_skills_one"/>
                            <div id="subSkillsList1" type="hidden"></div>
                            <div class="selected-tags" id="selectedTags1"></div>
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-4 gap-3">
                        <!-- Button to toggle the form visibility -->
                        <button type="button" class="w-full h-12 px-4 mt-2 button-main -border mt-5" id="add_subskill">Add New Sub Skill</button>

                        <!-- The form is initially hidden using the 'hidden' class -->
                        <span class="mt-5 grid sm:grid-cols-3 gap-3 col-span-3 hidden" id="subskill_add_form" style="width: 100%; justify-content: space-between;">
                            <div class="flex-1">
                                <label>Enter new subskill <span class="text-red">*</span></label>
                                <input id="coreSkillId" class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="hidden" name="core_skill_id"/>
                            </div>
                            <div class="flex-1">
                                <input id="newSubSkill" class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" name="new_sub_skill" placeholder="Enter subskill"/>
                            </div>
                            <div class="flex-1">
                                <button type="button" id="addSubSkillButton" class="w-full h-12 px-4 button-main -border mt-2">Add</button>
                            </div>
                        </span>
                    </div>
                    <div class="grid sm:grid-cols-4 gap-3 mt-4">
                        <!-- Second set of core skills and sub-skills -->
                        <div class="education_level col-span-1">
                            <label>Core Skill 2</label>
                            <select id="coreSkills2" class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="core_skill_two">
                                <option value="">Select Core Skill</option>
                                <?php
                                $fetch_skills = $db_handle->runQuery("SELECT * FROM skills");
                                foreach ($fetch_skills as $row) {
                                    ?>
                                    <option value="<?php echo $row['skill_id']?>"><?php echo $row['core_skill']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="education_level col-span-1">
                            <div id="subSkillsLabel2" style="display: none;"> <!-- Initially hidden -->
                                <label>Sub Skills 2</label>
                            </div>
                            <input id="selectedSubSkills2" type="hidden" name="sub_skills_two"/>
                            <div class="selected-tags" id="selectedTags2"></div>
                            <div id="subSkillsList2" type="hidden"></div>
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-4 gap-3">
                        <!-- Button to toggle the form visibility -->
                        <button type="button" class="w-full h-12 px-4 mt-2 button-main -border mt-5" id="add_subskill_2">Add New Sub Skill</button>

                        <!-- The form is initially hidden using the 'hidden' class -->
                        <span class="mt-5 grid sm:grid-cols-3 gap-3 col-span-3 hidden" id="subskill_add_form_2" style="width: 100%; justify-content: space-between;">
                            <div class="flex-1">
                                <label>Enter new subskill <span class="text-red">*</span></label>
                                <input id="coreSkillId2" class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="hidden" name="core_skill_id"/>
                            </div>
                            <div class="flex-1">
                                <input id="newSubSkill2" class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" name="new_sub_skill" placeholder="Enter subskill"/>
                            </div>
                            <div class="flex-1">
                                <button type="button" id="addSubSkillButton2" class="w-full h-12 px-4 button-main -border mt-2">Add</button>
                            </div>
                        </span>
                    </div>
                    <div class="grid sm:grid-cols-4 gap-3 mt-4">
                        <!-- Third set of core skills and sub-skills -->
                        <div class="education_level col-span-1">
                            <label>Core Skill 3</label>
                            <select id="coreSkills3" class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="core_skill_three" >
                                <option value="">Select Core Skills</option>
                                <?php
                                $fetch_skills = $db_handle->runQuery("SELECT * FROM skills");
                                foreach ($fetch_skills as $row) {
                                    ?>
                                    <option value="<?php echo $row['skill_id']?>"><?php echo $row['core_skill']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="education_level col-span-1">
                            <div id="subSkillsLabel3" style="display: none;"> <!-- Initially hidden -->
                                <label>Sub Skills 3</label>
                            </div>
                            <input id="selectedSubSkills3" type="hidden" name="sub_skills_three"/>
                            <div class="selected-tags" id="selectedTags3"></div>
                            <div id="subSkillsList3" type="hidden"></div>
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-4 gap-3">
                        <!-- Button to toggle the form visibility -->
                        <button type="button" class="w-full h-12 px-4 mt-2 button-main -border mt-5" id="add_subskill_3">Add New Sub Skill</button>

                        <!-- The form is initially hidden using the 'hidden' class -->
                        <span class="mt-5 grid sm:grid-cols-3 gap-3 col-span-3 hidden" id="subskill_add_form_3" style="width: 100%; justify-content: space-between;">
                            <div class="flex-1">
                                <label>Enter new subskill <span class="text-red">*</span></label>
                                <input id="coreSkillId3" class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="hidden" name="core_skill_id"/>
                            </div>
                            <div class="flex-1">
                                <input id="newSubSkill3" class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" name="new_sub_skill" placeholder="Enter subskill"/>
                            </div>
                            <div class="flex-1">
                                <button type="button" id="addSubSkillButton3" class="w-full h-12 px-4 button-main -border mt-2">Add</button>
                            </div>
                        </span>
                    </div>



                    <!-- Work Experience Section Wrapper -->
                    <div id="experience-container">
                        <div class="experience-section">
                            <h5 class="heading5 mt-5">Work Experience</h5>
                            <div class="grid sm:grid-cols-3 gap-3">
                                <div class="education_level">
                                    <label>Industry <span class="text-red">*</span></label>
                                    <select id="industry" class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="industry[]" required>
                                        <option selected>Select Industry</option>
                                        <?php
                                        $fetch_industry = $db_handle->runQuery("SELECT * FROM industries ORDER BY industry ASC");
                                        foreach ($fetch_industry as $row) {
                                            echo "<option value='{$row['industry_id']}'>{$row['industry']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="education_level">
                                    <label>Sub Industry <span class="text-red">*</span></label>
                                    <select id="subindustry" class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="sub_industry[]" required>
                                        <option selected>Select Sub Industry</option>
                                    </select>
                                </div>
                                <div class="education_level">
                                    <label>Country</label>
                                    <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="countries[]">
                                        <option disabled selected>Please Select Country</option>
                                        <?php
                                        $fetch_country = $db_handle->runQuery("SELECT country_name FROM countries ORDER BY country_name ASC");
                                        foreach ($fetch_country as $country) {
                                            echo "<option value='{$country['country_name']}'>{$country['country_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="jobLocation">
                                    <label>Job Title <span class="text-red">*</span></label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" placeholder="Software Engineer" name="job_location[]" required />
                                </div>
                                <div class="jobLocation">
                                    <label>Company Name <span class="text-red">*</span></label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" placeholder="Company Name" name="company_name[]" required />
                                </div>
                                <div class="jobLocation">
                                    <label>Company Website Link <span class="text-red">*</span></label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg company-website" type="text" placeholder="www.abc.com or https://abc.com" name="company_website[]" required />
                                    <small class="website-error-message text-red-500 hidden">Invalid website format. Please use www.abc.com or https://abc.com.</small>
                                </div>
                                <div class="jobLocation">
                                    <label>Start Date <span class="text-red">*</span></label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="date" name="start_date[]" required />
                                </div>
                                <div class="jobLocation">
                                    <label>End Date</label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="date" name="end_date[]" id="endDate" required />
                                </div>
                                <div class="jobLocation">
                                    <label>Present</label>
                                    <input type="checkbox" class="px-4 mt-2 border-line rounded-lg" name="till_date[]" id="tillDateCheckbox" value="1"> Yes
                                </div>
                                <div class="jobLocation">
                                    <label>Accomplishments <span class="text-red">*</span></label>
                                    <textarea class="w-full h-12 px-4 mt-2 border-line rounded-lg" required name="accomplishment[]"></textarea>
                                </div>
                                <div class="jobLocation">
                                    <label>Accomplishments</label>
                                    <textarea class="w-full h-12 px-4 mt-2 border-line rounded-lg" name="accomplishment2[]"></textarea>
                                </div>
                                <div class="jobLocation">
                                    <label>Accomplishments</label>
                                    <textarea class="w-full h-12 px-4 mt-2 border-line rounded-lg" name="accomplishment3[]"></textarea>
                                </div>
                            </div>

                            <hr class="mt-5 mb-5">
                            <h2 style="font-size: 30px; font-weight: bold" class="mt-5 mb-5"> Work Period Verification:</h2>
                            <div class="grid sm:grid-cols-3 gap-3">
                                <div class="jobLocation">
                                    <label>Reference Type </label>
                                    <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="reporting_manager_job[]">
                                        <option>Please Select Reference Type</option>
                                        <option value="HR">HR</option>
                                        <option value="Reporting Manager">Reporting Manager</option>
                                    </select>
                                </div>
                                <div class="jobLocation">
                                    <label>Designation</label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" placeholder="Enter Designation" name="designation_job[]" />
                                </div>
                                <div class="jobLocation">
                                    <label>Name</label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" placeholder="Enter Name" name="name_job[]" />
                                </div>
                                <div class="jobLocation">
                                    <label>Email</label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg company-email" type="email" placeholder="Enter Email" name="email_job[]" />
                                    <small class="error-message text-red-500 hidden">Email domain must match the company website.</small>
                                </div>
                                <button class="remove-experience hidden w-1/3 h-10 mt-4 bg-red-500 text-white rounded-lg">Remove</button>
                            </div>

                            <hr class="mt-5 mb-5">
                            <h2 style="font-size: 30px; font-weight: bold" class="mt-5 mb-5">Accomplishment Verification:</h2>
                            <div class="grid sm:grid-cols-3 gap-3">
                                <div class="jobLocation">
                                    <label>Reference Type</label>
                                    <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="reporting_manager[]">
                                        <option>Please Select Reference Type</option>
                                        <option value="HR">HR</option>
                                        <option value="Reporting Manager">Reporting Manager</option>
                                    </select>
                                </div>
                                <div class="jobLocation">
                                    <label>Designation</label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" placeholder="Enter Designation" name="designation[]" />
                                </div>
                                <div class="jobLocation">
                                    <label>Name</label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" placeholder="Enter Name" name="name[]" />
                                </div>
                                <div class="jobLocation">
                                    <label>Email</label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg company-email" type="email" placeholder="Enter Email" name="email[]" />
                                    <small class="error-message text-red-500 hidden">Email domain must match the company website.</small>
                                </div>
                                <button class="remove-experience hidden w-full h-10 mt-4 bg-red-500 text-white rounded-lg">Remove</button>
                            </div>
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-3 gap-3">
                        <button id="addExperience" class="w-full h-12 px-4 mt-2 button-main -border mt-5">Add Another Experience</button>
                    </div>


                    <h5 class="heading5 mt-5">Video Section</h5>
                    <div class="grid sm:grid-cols-3 gap-3">
                        <!-- Trigger Button -->
                        <button type="button" class="w-full h-12 px-4 mt-2 button-main -border mt-5"
                                onclick="document.getElementById('modal').classList.remove('hidden')">Add Video <span class="text-red">*</span></button>

                        <div id="alert" class="bg-success text-white p-4 rounded-lg shadow-lg flex items-center justify-between space-x-4 hidden" style="height: 52px;margin-top: 18px;">
                            <span id="messageSuccess"></span>
                            <button onclick="dismissAlert()" class="text-white font-bold text-xl" type="button">&times;</button>
                        </div>

                        <script>
                            function dismissAlert() {
                                document.getElementById('alert').style.display = 'none';
                            }
                        </script>


                        <!-- Modal -->
                        <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center" style="z-index: 50">
                            <div class="bg-white rounded-2xl shadow-xl max-w-2xl w-full p-6 overflow-y-auto max-h-[90vh]">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-2xl font-bold">🎥 Video Recording Tips</h2>
                                    <button class="text-red-500 text-xl" type="button" onclick="document.getElementById('modal').classList.add('hidden')">
                                        &times;</button>
                                </div>

                                <div class="space-y-4" id="content">
                                    <h3 class="text-xl font-semibold">📋 Preparation Checklist:</h3>
                                    <ul class="list-disc pl-5 space-y-2">
                                        <li>📷 Use a good quality camera (smartphone or HD webcam).</li>
                                        <li>💡 Ensure good lighting, avoid backlighting.</li>
                                        <li>🖼️ Keep your background clean and professional.</li>
                                        <li>📹 Use a stable surface or tripod for steady shots.</li>
                                        <li>👔 Dress appropriately for your industry.</li>
                                        <li>🎯 Position the camera at eye level with good posture.</li>
                                        <li>🎙️ Ensure clear audio, use an external mic if possible.</li>
                                        <li>📝 Practice speaking naturally instead of reading a script.</li>
                                        <li>😊 Smile and maintain positive body language.</li>
                                        <li>⏳ Keep the video concise (1-2 minutes).</li>
                                    </ul>

                                    <div id="moreContent" class="hidden">
                                        <h3 class="text-xl font-semibold">🎬 Video Structure:</h3>

                                        <div>
                                            <h4 class="font-bold">👋 Introduction (10-15 seconds)</h4>
                                            <p>Start with a warm introduction and confidently present yourself.</p>
                                            <p class="italic">Example: "Hi, my name is [Your Name], and I’m a [Your Profession/Industry]."</p>
                                        </div>

                                        <div>
                                            <h4 class="font-bold">🚀 Key Highlights (30-45 seconds)</h4>
                                            <p>Highlight key skills, achievements, or recent education.</p>
                                            <p class="italic">Example: "I specialize in [Skill 1, Skill 2, Skill 3]."</p>
                                        </div>

                                        <div>
                                            <h4 class="font-bold">🎯 Closing & Call to Action (15-20 seconds)</h4>
                                            <p>Express enthusiasm and invite engagement.</p>
                                            <p class="italic">Example: "I’m excited about roles in [Industry] and eager to contribute my skills."</p>
                                        </div>

                                        <h3 class="text-xl font-semibold">✔️ Final Tips:</h3>
                                        <ul class="list-disc pl-5 space-y-2">
                                            <li>Practice a few times before recording to feel comfortable.</li>
                                            <li>Keep your tone friendly, professional, and engaging.</li>
                                            <li>Be authentic—it helps you stand out!</li>
                                        </ul>

                                        <h3 class="text-xl font-semibold">🎥 Additional Video Recording Tips:</h3>
                                        <ul class="list-disc pl-5 space-y-2">
                                            <li>🎬 Record in landscape mode for a professional look.</li>
                                            <li>🔇 Turn off notifications to avoid interruptions during recording.</li>
                                            <li>⏱️ Pause briefly before and after speaking to allow for smooth editing.</li>
                                            <li>📏 Maintain an appropriate distance from the camera (arm's length works well).</li>
                                            <li>🌟 Show your personality to create a memorable and engaging video.</li>
                                        </ul>
                                    </div>

                                    <button type="button" id="showMoreBtn" class="text-blue-600 font-semibold" onclick="toggleContent()">Show More</button>

                                    <!-- Audio Files Section -->
                                    <div class="mt-6">
                                        <h3 class="text-xl font-semibold">🎧 Instruction Audio Files:</h3>
                                        <div class="space-y-4">
                                            <div>
                                                <h4 class="font-bold">Tips on how to record: </h4>
                                                <audio controls style="width: 100%">
                                                    <source src="assets/audio/Tips%20on%20how%20to%20record%20record.mp3" type="audio/mp3">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            </div>
                                            <div>
                                                <h4 class="font-bold">Tips on Intro Video Format: </h4>
                                                <audio controls style="width: 100%">
                                                    <source src="assets/audio/Tips%20on%20Intro%20Video%20Format.mp3" type="audio/mp3">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Video Upload/Recording Section -->
                                    <div class="mt-6 space-y-4">
                                        <h3 class="text-xl font-semibold">📹 Video Options:</h3>
                                        <div class="flex justify-end space-x-4">
                                            <button id="openUploadModal" type="button" class="w-full h-12 px-4 mt-2 button-main -border mt-5">Upload Video</button>
                                            <button id="openRecordModal" type="button" class="w-full h-12 px-4 mt-2 button-main -border mt-5">Record Video</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="videoSrc" id="videoSrc" value="">

                        <!-- Upload Video Modal -->
                        <div id="uploadModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" style="z-index: 55">
                            <div class="bg-white rounded-2xl shadow-lg p-6 w-96 relative">
                                <h2 class="text-2xl font-semibold mb-4">Upload Video</h2>
                                <input type="file" id="video-file" accept="video/*" class="block w-full text-gray-700 border border-gray-300 rounded-lg p-2 mb-4" />

                                <button id="closeUploadModal" type="button" class="absolute top-2 right-2 text-gray-400 hover:text-gray-800 text-xl">&times;</button>

                                <div class="flex justify-end space-x-2">
                                    <button type="button" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400" onclick="closeModal('uploadModal')">Cancel</button>
                                    <button id="uploadButton" type="button" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600" disabled>Upload</button>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Progress Bar -->
                        <div id="progressContainer" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 hidden" style="z-index:1000;">
                            <div class="w-full bg-gray-200 rounded-lg relative">
                                <div id="progressBar" class="h-9" style="width: 100%;background: #00c5ff;border-radius: 0;"></div>
                                <span id="progressText" class="absolute inset-0 flex items-center justify-center text-sm font-semibold text-black" style="">100%</span>
                            </div>
                        </div>

                        <!-- Record Video Modal -->
                        <div id="recordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" style="z-index: 55">
                            <div class="bg-white rounded-2xl shadow-lg p-6 w-96 relative">
                                <h2 class="text-2xl font-semibold mb-4">Record Video for 2 Minutes</h2>
                                <video id="webcam" class="w-full h-48 bg-gray-200 rounded mb-4" autoplay muted></video>

                                <div id="timer">02:00</div>
                                <video id="video-player" controls style="display:none;margin-bottom: 30px;" autoplay muted></video>

                                <button id="closeRecordModal" type="button" class="absolute top-2 right-2 text-gray-400 hover:text-gray-800 text-xl">&times;</button>

                                <div class="flex justify-end space-x-2">
                                    <button type="button" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400" onclick="closeModal('recordModal')">Cancel</button>
                                    <button id="start-recording" type="button" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Start Recording</button>
                                    <button id="pause-recording" type="button" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600" style="display:none;">Pause</button>
                                    <button id="resume-recording" type="button" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600" style="display:none;">Resume</button>
                                </div>
                            </div>
                        </div>

                        <!-- Full-page Spinner -->
                        <div id="spinner" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center hidden" style="z-index: 100">
                            <div class="spinner-border animate-spin inline-block w-16 h-16 border-4 border-t-4 border-white rounded-full" role="status">
                                <span class="visually-hidden">.</span>
                            </div>
                        </div>


                        <script>
                            const spinner = document.getElementById('spinner');
                            // Modal Triggers
                            document.getElementById('openUploadModal').addEventListener('click', () => openModal('uploadModal'));
                            document.getElementById('openRecordModal').addEventListener('click', () => {
                                openModal('recordModal');
                                startWebcam(); // Start the webcam when the record modal opens
                            });

                            // Close Buttons
                            document.getElementById('closeUploadModal').addEventListener('click', () => closeModal('uploadModal'));
                            document.getElementById('closeRecordModal').addEventListener('click', () => closeModal('recordModal'));

                            // Open & Close Modal Functions
                            function openModal(id) {
                                document.getElementById(id).classList.remove('hidden');
                                document.getElementById(id).classList.add('flex');
                            }

                            function toggleContent(){
                                const moreContent = document.getElementById('moreContent');
                                const showMoreBtn = document.getElementById('showMoreBtn');

                                if (moreContent.classList.contains('hidden')) {
                                    moreContent.classList.remove('hidden');
                                    showMoreBtn.textContent = 'Show Less';
                                } else {
                                    moreContent.classList.add('hidden');
                                    showMoreBtn.textContent = 'Show More';
                                }
                            }

                            function closeModal(id) {
                                document.getElementById(id).classList.add('hidden');
                                document.getElementById(id).classList.remove('flex');
                            }

                            // Handle file input change and enable the upload button
                            document.getElementById("video-file").addEventListener("change", function () {
                                const fileInput = this;
                                const uploadButton = document.getElementById("uploadButton");

                                if (fileInput.files.length > 0) {
                                    const file = fileInput.files[0];
                                    const allowedTypes = ["video/mp4", "video/webm"];

                                    if (allowedTypes.includes(file.type)) {
                                        uploadButton.disabled = false;
                                    } else {
                                        uploadButton.disabled = true;
                                        alert("Please select an MP4 or WebM file.");
                                        fileInput.value = ""; // Clear the invalid file
                                    }
                                } else {
                                    uploadButton.disabled = true;
                                }
                            });


                            // When upload button is clicked, show progress bar and start upload
                            document.getElementById('uploadButton').addEventListener('click', function () {
                                // Show progress modal
                                openModal('uploadModal');
                                document.getElementById('messageSuccess').innerHTML="";

                                const fileInput = document.getElementById('video-file');
                                const file = fileInput ? fileInput.files[0] : null;

                                if (file) {
                                    // Show the progress bar and reset its value
                                    document.getElementById('progressContainer').classList.remove('hidden');
                                    document.getElementById('progressBar').style.width = "0%";
                                    document.getElementById('progressText').textContent = "0%";

                                    // Generate a random number between 1 and 1000 for the filename
                                    const randomNum = Math.floor(Math.random() * 1000) + 1;
                                    const currentDateTime = new Date().toISOString().replace(/[^\w\s]/gi, '_');
                                    const newFileName = `${randomNum}_${currentDateTime}.mp4`;

                                    const formData = new FormData();
                                    formData.append('video', file, newFileName);

                                    // AJAX request with progress tracking
                                    $.ajax({
                                        url: 'upload.php',
                                        type: 'POST',
                                        data: formData,
                                        contentType: false,
                                        processData: false,
                                        xhr: function () {
                                            const xhr = new window.XMLHttpRequest();
                                            xhr.upload.addEventListener("progress", function (event) {
                                                if (event.lengthComputable) {
                                                    const percentComplete = Math.round((event.loaded / event.total) * 100);
                                                    document.getElementById('progressBar').style.width = percentComplete + "%";
                                                    document.getElementById('progressText').textContent = percentComplete + "%";
                                                }
                                            }, false);
                                            return xhr;
                                        },
                                        success: function (response) {
                                            console.log('File uploaded successfully!');
                                            alert('File uploaded successfully!');
                                            document.getElementById('videoSrc').value = newFileName;

                                            // Set progress bar to 100% on success
                                            document.getElementById('progressBar').style.width = "100%";
                                            document.getElementById('progressText').textContent = "100%";


                                            document.getElementById('progressContainer').classList.add('hidden');
                                            document.getElementById('alert').classList.remove('hidden');
                                            document.getElementById('messageSuccess').innerHTML="Video Uploaded Successfully.";

                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            console.log('Error uploading file: ' + errorThrown);
                                            alert('Error uploading file.');

                                            // Hide progress bar on error as well
                                            document.getElementById('progressContainer').classList.add('hidden');
                                        }
                                    });
                                } else {
                                    alert('Please select a file to upload.');
                                }
                            });


                            let isRecording = false;  // To track recording state
                            let isPaused = false;  // To track if the recording is paused
                            let mediaRecorder;
                            let recordedChunks = [];
                            let stream;
                            let timerInterval;
                            let countdown = 120;  // 2 minutes
                            let currentTime = countdown;

                            // Function to start recording
                            document.getElementById('start-recording').addEventListener('click', function () {
                                if (!isRecording) {
                                    resetRecordingState();  // Reset previous recordings
                                    if (mediaRecorder && mediaRecorder.state === 'inactive') {
                                        isRecording = true;
                                        this.textContent = "Stop Recording";  // Change to "Stop Recording"
                                        this.classList.remove("bg-green-500");
                                        this.classList.add("bg-red-500", "hover:bg-red-600");
                                        document.getElementById('pause-recording').style.display = 'inline-block';  // Show Pause Button
                                        document.getElementById('resume-recording').style.display = 'none';  // Hide Resume Button
                                        setTimeout(() => {
                                            mediaRecorder.start();
                                            startTimer();
                                        }, 1000);
                                    }
                                } else {
                                    stopRecording();  // Stop if already recording
                                }
                            });

                            // Function to pause recording
                            document.getElementById('pause-recording').addEventListener('click', function () {
                                if (mediaRecorder && mediaRecorder.state === 'recording') {
                                    mediaRecorder.pause();  // Pause the media recording
                                    isPaused = true;
                                    clearInterval(timerInterval);  // Stop the timer

                                    // Show the Resume Button and Hide the Pause Button
                                    document.getElementById('pause-recording').style.display = 'none';
                                    document.getElementById('resume-recording').style.display = 'inline-block';
                                }
                            });

                            // Function to resume recording
                            document.getElementById('resume-recording').addEventListener('click', function () {
                                if (mediaRecorder && mediaRecorder.state === 'paused') {
                                    mediaRecorder.resume();  // Resume the media recording
                                    isPaused = false;
                                    startTimer();  // Resume the timer

                                    // Show the Pause Button and Hide the Resume Button
                                    document.getElementById('pause-recording').style.display = 'inline-block';
                                    document.getElementById('resume-recording').style.display = 'none';
                                }
                            });


                            // Log chunks during recording
                            /*mediaRecorder.ondataavailable = function (event) {
                                if (event.data.size > 0) {
                                    console.log('Recording chunk:', event.data);
                                    recordedChunks.push(event.data);  // Push each chunk into the array
                                }
                            };*/

                            // Log when the recording stops
                            mediaRecorder.onstop = function () {
                                console.log('Recording stopped');
                                if (recordedChunks.length > 0) {
                                    console.log('Recorded Chunks:', recordedChunks);
                                    const blob = new Blob(recordedChunks, { type: 'video/webm' });
                                    console.log('Blob created:', blob);
                                } else {
                                    console.log('No recorded data.');
                                }
                            };

                            // Call stopRecording when you're ready to stop recording
                            // Function to stop recording
                            function stopRecording() {
                                document.getElementById('messageSuccess').innerHTML="";
                                if (mediaRecorder && mediaRecorder.state === 'recording') {
                                    mediaRecorder.stop();
                                    stopWebcam();
                                    clearInterval(timerInterval); // Stop the countdown
                                    document.getElementById('start-recording').textContent = "Start Recording";  // Reset the button text
                                    document.getElementById('start-recording').classList.remove("bg-red-500", "hover:bg-red-600");
                                    document.getElementById('start-recording').classList.add("bg-green-500", "hover:bg-green-600");
                                    isRecording = false;

                                    // Hide Pause and Resume buttons
                                    document.getElementById('pause-recording').style.display = 'none';
                                    document.getElementById('resume-recording').style.display = 'none';

                                    // Show progress bar and reset its value before starting upload
                                    document.getElementById('progressContainer').classList.remove('hidden');  // Make progress bar visible
                                    document.getElementById('progressBar').style.width = "0%";
                                    document.getElementById('progressText').textContent = "0%";

                                    // Simulate progress from 0% to 100% over 5 seconds (5000 milliseconds)
                                    let progress = 0; // Initial progress
                                    const interval = setInterval(function () {
                                        progress += 2; // Increase progress by 2% every interval
                                        document.getElementById('progressBar').style.width = progress + "%";
                                        document.getElementById('progressText').textContent = progress + "%";

                                        if (progress >= 100) {
                                            clearInterval(interval);  // Stop interval once we reach 100%
                                        }
                                    }, 50); // Every 50 milliseconds (100% / 5 seconds = 2% per 50ms)


                                    // Hide progress bar after successful upload
                                    setTimeout(function() {
                                        document.getElementById('progressContainer').classList.add('hidden');  // Hide progress bar
                                    }, 10000);  // Hide after 10 seconds

                                    const blob = new Blob(recordedChunks, { type: 'video/webm' }); // Keep MIME type as webm
                                    const fileName = generateFileName(); // Filename generator function
                                    document.getElementById('videoSrc').value = fileName;


                                    // Check if there are recorded chunks to upload
                                    if (recordedChunks.length > 0) {


                                        const formData = new FormData();
                                        formData.append('video', blob, fileName); // Append video blob with the filename

                                        // AJAX request to upload the video
                                        $.ajax({
                                            url: 'upload.php',  // PHP script to handle the upload (adjust URL as needed)
                                            type: 'POST',
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            success: function (response) {
                                                console.log('Response from server:', response); // Log the response
                                                alert('File uploaded successfully!');  // Show success alert
                                            },
                                            error: function (jqXHR, textStatus, errorThrown) {
                                                console.log('Error uploading file: ' + errorThrown);
                                                alert('Error uploading file!');  // Show error alert
                                            }
                                        });
                                    } else {
                                        console.log('No data recorded to upload.');
                                    }
                                }

                                document.getElementById('alert').classList.remove('hidden');
                                document.getElementById('messageSuccess').innerHTML="Video Uploaded Successfully.";
                            }



                            // Function to generate a unique filename
                            function generateFileName() {
                                const randomNum = Math.floor(Math.random() * 1000) + 1;  // Generate random number for uniqueness
                                const timestamp = new Date().toISOString().replace(/[^\w\s]/gi, '_');  // Format timestamp
                                return `${randomNum}_${timestamp}_recording.webm`;  // Return formatted filename
                            }

                            // Function to start the countdown timer
                            function startTimer() {
                                timerInterval = setInterval(function () {
                                    if (!isPaused) {
                                        countdown--;
                                    }

                                    let minutes = Math.floor(countdown / 60);
                                    let seconds = countdown % 60;
                                    document.getElementById('timer').innerText = `${minutes < 10 ? '0' + minutes : minutes}:${seconds < 10 ? '0' + seconds : seconds}`;

                                    if (countdown <= 0) {
                                        clearInterval(timerInterval);
                                        stopRecording();  // Stop recording automatically when the timer hits 0
                                    }
                                }, 1000);
                            }

                            // Function to reset the recording state (useful for stopping or restarting)
                            function resetRecordingState() {
                                countdown = currentTime;
                                recordedChunks = [];
                                const videoPlayer = document.getElementById('video-player');
                                videoPlayer.style.display = 'none';
                                videoPlayer.src = '';
                                if (isRecording) {
                                    stopRecording();
                                }
                                startWebcam();
                            }

                            // Webcam setup (same as before)
                            function startWebcam() {
                                navigator.mediaDevices.getUserMedia({ video: true, audio: true })
                                    .then(function (mediaStream) {
                                        stream = mediaStream;
                                        const videoElement = document.getElementById('webcam');
                                        videoElement.srcObject = stream;
                                        videoElement.style.display = 'block';

                                        const mimeType = 'video/webm';
                                        mediaRecorder = new MediaRecorder(stream, { mimeType: mimeType });
                                        mediaRecorder.ondataavailable = function (event) {
                                            recordedChunks.push(event.data);
                                        };
                                        mediaRecorder.onstop = function () {
                                            // Upload the file after stopping the recording
                                            const blob = new Blob(recordedChunks, { type: mimeType });
                                            if (blob.size > 0) {
                                                const formData = new FormData();
                                                const fileName = generateFileName();
                                                formData.append('video', blob, fileName);

                                                // AJAX to upload the recorded video
                                                $.ajax({
                                                    url: 'upload.php',  // PHP script to handle the upload
                                                    type: 'POST',
                                                    data: formData,
                                                    contentType: false,
                                                    processData: false,
                                                    success: function(response) {
                                                        console.log(response);
                                                        alert('Upload successful!');
                                                    },
                                                    error: function(error) {
                                                        alert('Error uploading the file');
                                                    }
                                                });
                                            }
                                        };
                                    })
                                    .catch(function (err) {
                                        console.error("Error accessing webcam: ", err);
                                        alert('There was an issue accessing the webcam or microphone.');
                                    });
                            }

                            function stopWebcam() {
                                const videoElement = document.getElementById('webcam');
                                const stream = videoElement.srcObject;
                                if (stream) {
                                    const tracks = stream.getTracks();
                                    tracks.forEach(track => track.stop());
                                    videoElement.srcObject = null;
                                }
                            }
                        </script>
                    </div>

                    <!--career goal section-->
                    <h5 class="heading5 mt-5">Career Goals</h5>
                    <div class="grid sm:grid-cols-3 gap-3">
                        <div class="jobLocation">
                            <label for="jobLocation">Role <span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="Enter career role" name="career_role" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Industry <span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="Enter career industry" name="career_industry" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">NOC Number <span class="text-red">*</span></label>
                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity))" name="noc_number" required>
                                <option selected>Please select NOC</option>
                                <?php
                                $fetch_noc = $db_handle->runQuery("select * from noc");
                                foreach ($fetch_noc as $noc){
                                    ?>
                                    <option value="<?php echo $noc['noc_id']?>"><?php echo $noc['name'];?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!--reset and submit section starts here-->
                    <div class="flex items-center col-span-full gap-5 mt-5">
                        <button class="button-main -border">Reset</button>
                        <button class="button-main" type="submit" name="set_profile" id="publishButton">Publish</button>
                    </div>
                </form>
            </div>
        </div>
        <?php include ('include/dashboard_footer.php');?>
    </div>
</div>



<!-- Mobile Menu -->
<?php include ('include/mobile_menu.php');?>

<?php include ('include/script_new.php');?>


<!--js for appending global education field-->
<script>
    $(document).ready(function () {
        function initializeSelect2(container) {
            container.find('select').each(function () {
                if (!$(this).hasClass('select2-hidden-accessible')) {
                    $(this).select2({
                        dropdownParent: container
                    });
                }
            });
        }

        function destroySelect2(container) {
            container.find('select').each(function () {
                if ($(this).hasClass('select2-hidden-accessible')) {
                    $(this).select2('destroy');
                }
            });
        }

        // Initialize Select2 for existing dropdowns within the main container
        initializeSelect2($('#educationContainer'));

        $('#addGlobalEducation').on('click', function () {
            const educationContainer = $('#educationContainer');
            const educationSet = educationContainer.find('.educationSet').first();

            // Destroy Select2 on the original set before cloning
            destroySelect2(educationSet);

            // Clone the education set
            const newEducationSet = educationSet.clone();

            // Reinitialize Select2 on the original set
            initializeSelect2(educationSet);

            // Clear input values in the cloned set
            newEducationSet.find('input, select').each(function () {
                if ($(this).is('input')) {
                    $(this).val('');
                } else if ($(this).is('select')) {
                    $(this).val(null).trigger('change');
                }
            });

            // Remove 'id' attributes on cloned elements (ensuring unique ids)
            newEducationSet.find('input, select').removeAttr('id');

            // Show the remove button for the appended set
            newEducationSet.find('.removeEducationSet').show().on('click', function () {
                newEducationSet.remove();
            });

            // Append the new education set to the container
            educationContainer.append(newEducationSet);

            // Reinitialize Select2 only inside the new education set
            initializeSelect2(newEducationSet);
        });

        // Fix event delegation for dynamically added elements
        $(document).on('change', '.accreditation', function () {
            const accreditationDropdown = $(this);
            const certificateDiv = accreditationDropdown.closest('.educationSet').find('.certificateDiv');
            const certificateInput = accreditationDropdown.closest('.educationSet').find('.certificate_number');

            if (accreditationDropdown.val() && accreditationDropdown.val() !== 'N/A') {
                certificateDiv.show();
                certificateInput.prop('required', true);
            } else {
                certificateDiv.hide();
                certificateInput.prop('required', false).val('');
            }
        });
    });

</script>

<!--canadian education-->
<script>
    $(document).ready(function () {
        // Function to toggle certificateDivCanadian visibility
        function toggleCertificateField(selectElement) {
            const selectedValue = $(selectElement).val();
            const certificateDiv = $(selectElement).closest('.educationFields').find('.certificateDivCanadian');

            if (selectedValue === 'WES' || selectedValue === 'Alberta') {
                certificateDiv.show();
            } else {
                certificateDiv.hide();
            }
        }

        // Initialize Select2 for all select fields within the Canadian Education section
        $('#canadianEducationSection select').select2();

        // Toggle button functionality
        $(document).on('click', '.toggle_btn', function () {
            const educationFields = $(this).closest('.educationSection').find('.educationFields');
            educationFields.find('select, input').prop('disabled', function (i, val) {
                return !val;
            });
        });

        $('#addCanadianEducation').on('click', function() {
            const newEducationSection = $('#canadianEducationSection .educationSection').first().clone();
            newEducationSection.find('select, input').prop('disabled', true); // Disable fields initially
            newEducationSection.find('.toggle_btn').on('click', function() {
                const educationFields = $(this).closest('.educationSection').find('.educationFields');
                educationFields.find('select, input').prop('disabled', function(i, val) {
                    return !val;
                });
            });
            newEducationSection.find('.remove_btn').show().on('click', function() {
                $(this).closest('.educationSection').remove();
            });

            // Handle certificate field visibility for the new section
            newEducationSection.find('select[name="canadian_accreditation[]"]').on('change', function() {
                toggleCertificateField(this);
            });

            newEducationSection.insertBefore($(this).closest('.grid'));
            $('#canadianEducationSection select').select2(); // Reinitialize Select2 for new fields
        });


        // Hide remove button for the initial section
        $('#canadianEducationSection .educationSection').first().find('.remove_btn').hide();

        // Handle certificate field visibility for the initial section
        $('#canadianEducationSection select[name="canadian_accreditation[]"]').on('change', function () {
            toggleCertificateField(this);
        });

        // Initialize certificate field visibility on page load
        $('#canadianEducationSection select[name="canadian_accreditation[]"]').each(function () {
            toggleCertificateField(this);
        });
    });

</script>


<script>
    const selectElement = document.getElementById('graduation-year');
    const selectElement2 = document.getElementById('graduation-year-2');
    const currentYear = new Date().getFullYear();

    // Loop from current year down to 1996
    for (let year = currentYear; year >= 1996; year--) {
        const option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        selectElement.appendChild(option);
    }

    for (let year = currentYear; year >= 1996; year--) {
        const option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        selectElement2.appendChild(option);
    }
</script>

<!--skill section script-->
<script>
    $(document).ready(function() {
        // Toggle form visibility when the button is clicked
        $('#add_subskill').on('click', function() {
            // Get the selected core skill value
            const coreSkillId = $('#coreSkills1').val();
            if (!coreSkillId) {
                alert('Please select a core skill first.');
                return;
            }

            // Set the core skill ID in the hidden input field
            $('#coreSkillId').val(coreSkillId);

            // Toggle the form visibility
            $('#subskill_add_form').toggleClass('hidden visible');
        });

        // Handle the "Add" button click
        $('#addSubSkillButton').on('click', function() {
            const coreSkillId = $('#coreSkillId').val();
            const newSubSkill = $('#newSubSkill').val();

            if (!coreSkillId || !newSubSkill) {
                alert('Please fill in all required fields.');
                return;
            }

            // Send data to the server using AJAX
            $.ajax({
                url: 'insert_subskill.php',
                type: 'POST',
                data: {
                    core_skill_id: coreSkillId,
                    new_sub_skill: newSubSkill
                },
                success: function(response) {
                    alert('Sub skill added successfully!');
                    $('#newSubSkill').val(''); // Clear the input field
                    $('#subskill_add_form').addClass('hidden'); // Hide the form
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while adding the sub skill.');
                    console.error(xhr.responseText);
                }
            });
        });
    });

    $(document).ready(function() {
        // Toggle form visibility when the button is clicked
        $('#add_subskill_2').on('click', function() {
            // Get the selected core skill value
            const coreSkillId = $('#coreSkills2').val();
            if (!coreSkillId) {
                alert('Please select a core skill first.');
                return;
            }

            // Set the core skill ID in the hidden input field
            $('#coreSkillId2').val(coreSkillId);

            // Toggle the form visibility
            $('#subskill_add_form_2').toggleClass('hidden visible');
        });

        // Handle the "Add" button click
        $('#addSubSkillButton2').on('click', function() {
            const coreSkillId = $('#coreSkillId2').val();
            const newSubSkill = $('#newSubSkill2').val();

            if (!coreSkillId || !newSubSkill) {
                alert('Please fill in all required fields.');
                return;
            }

            // Send data to the server using AJAX
            $.ajax({
                url: 'insert_subskill.php',
                type: 'POST',
                data: {
                    core_skill_id: coreSkillId,
                    new_sub_skill: newSubSkill
                },
                success: function(response) {
                    alert('Sub skill added successfully!');
                    $('#newSubSkill2').val(''); // Clear the input field
                    $('#subskill_add_form_2').addClass('hidden'); // Hide the form
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while adding the sub skill.');
                    console.error(xhr.responseText);
                }
            });
        });
    });

    $(document).ready(function() {
        // Toggle form visibility when the button is clicked
        $('#add_subskill_3').on('click', function() {
            // Get the selected core skill value
            const coreSkillId = $('#coreSkills3').val();
            if (!coreSkillId) {
                alert('Please select a core skill first.');
                return;
            }

            // Set the core skill ID in the hidden input field
            $('#coreSkillId3').val(coreSkillId);

            // Toggle the form visibility
            $('#subskill_add_form_3').toggleClass('hidden visible');
        });

        // Handle the "Add" button click
        $('#addSubSkillButton3').on('click', function() {
            const coreSkillId = $('#coreSkillId3').val();
            const newSubSkill = $('#newSubSkill3').val();

            if (!coreSkillId || !newSubSkill) {
                alert('Please fill in all required fields.');
                return;
            }

            // Send data to the server using AJAX
            $.ajax({
                url: 'insert_subskill.php',
                type: 'POST',
                data: {
                    core_skill_id: coreSkillId,
                    new_sub_skill: newSubSkill
                },
                success: function(response) {
                    alert('Sub skill added successfully!');
                    $('#newSubSkill3').val(''); // Clear the input field
                    $('#subskill_add_form_3').addClass('hidden'); // Hide the form
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while adding the sub skill.');
                    console.error(xhr.responseText);
                }
            });
        });
    });

    $(document).ready(function() {
        console.log(jQuery.fn.jquery);
        // Initialize Select2 on the core skills dropdown
        $('#coreSkills1').select2();
        $('#coreSkills2').select2();
        $('#coreSkills3').select2();

        // Function to handle core skill change
        function handleCoreSkillChange(coreSkillId, subSkillsListId, selectedTagsId, selectedSubSkillsId, subSkillsLabelId) {
            $(`#${coreSkillId}`).on('change.select2', function() { // Use Select2's event handler
                var core_skill = $(this).val();

                if (core_skill !== "Select Core Skills") {
                    // Show the "Sub Skills" label
                    $(`#${subSkillsLabelId}`).show();

                    // Fetch sub-skills via AJAX
                    $.ajax({
                        url: 'fetch_sub_skills.php', // Path to your PHP script
                        type: 'POST',
                        data: { core_skill: core_skill },
                        success: function(response) {
                            $(`#${subSkillsListId}`).html(response); // Update the sub-skills list
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error: " + status + error);
                            $(`#${subSkillsListId}`).html('<div class="error">Error loading sub-skills</div>');
                        }
                    });
                } else {
                    // Hide the "Sub Skills" label if no core skill is selected
                    $(`#${subSkillsLabelId}`).hide();
                    $(`#${subSkillsListId}`).html(''); // Clear the sub-skills list
                }
            });
        }

        // Function to handle sub-skill selection
        function handleSubSkillSelection(subSkillsListId, selectedTagsId, selectedSubSkillsId) {
            $(document).on('click', `#${subSkillsListId} .sub-skill-item`, function() {
                var subSkill = $(this).text();
                var subSkillValue = $(this).data('value');

                // Replace spaces with underscores in subSkillValue
                var safeSubSkillValue = subSkillValue.replace(/[\s\(\)]+/g, '_').replace(/[!#$^&*()+=\[\]{};':"\\|,.<>\/?]+/g, '\\$&');

                // Add the selected sub-skill as a tag
                $(`#${selectedTagsId}`).append(
                    '<div class="tag">' + subSkill +
                    '<span class="remove" data-value="' + subSkillValue + '">×</span></div>'
                );

                // Create a file upload input for this sub-skill
                var fileUploadHTML = `
                <div class="file-upload-container" id="fileUpload-${safeSubSkillValue}">
                    <label for="file-${safeSubSkillValue}">Upload File for ${subSkill}:</label>
                    <input type="file" name="${safeSubSkillValue}" id="file-${safeSubSkillValue}" class="w-full h-12 px-4 mt-2 border-line rounded-lg mb-3">
                </div>
            `;

                $(`#${selectedTagsId}`).append(fileUploadHTML); // Add the file upload input under the tag

                // Add the selected sub-skill value to the hidden input field
                var selectedSubSkills = $(`#${selectedSubSkillsId}`).val();
                if (selectedSubSkills) {
                    selectedSubSkills += ',' + subSkillValue; // Append the new sub-skill
                } else {
                    selectedSubSkills = subSkillValue; // First selection
                }
                $(`#${selectedSubSkillsId}`).val(selectedSubSkills); // Update hidden input field

                // Remove the sub-skill from the list
                $(this).remove();
            });
        }

        // Function to handle tag removal
        function handleTagRemoval(selectedTagsId, subSkillsListId, selectedSubSkillsId) {
            $(document).on('click', `#${selectedTagsId} .tag .remove`, function() {
                var subSkillValue = $(this).data('value');

                // Replace spaces with underscores in subSkillValue
                var safeSubSkillValue = subSkillValue.replace(/[\s\(\)]+/g, '_').replace(/[!#$^&*()+=\[\]{};':"\\|,.<>\/?]+/g, '\\$&');

                // Add the sub-skill back to the list
                $(`#${subSkillsListId}`).append(
                    '<div class="sub-skill-item" data-value="' + subSkillValue + '">' + subSkillValue + '</div>'
                );

                // Remove the tag and the associated file upload input
                $(this).parent().remove();
                $(`#fileUpload-${safeSubSkillValue}`).remove();  // Use the safeSubSkillValue here

                // Update the hidden input field by removing the sub-skill value
                var selectedSubSkills = $(`#${selectedSubSkillsId}`).val().split(',');
                selectedSubSkills = selectedSubSkills.filter(function(value) {
                    return value !== subSkillValue;
                });
                $(`#${selectedSubSkillsId}`).val(selectedSubSkills.join(',')); // Update hidden input field
            });
        }

        // Initialize for each set of core skills and sub-skills
        handleCoreSkillChange('coreSkills1', 'subSkillsList1', 'selectedTags1', 'selectedSubSkills1', 'subSkillsLabel1');
        handleSubSkillSelection('subSkillsList1', 'selectedTags1', 'selectedSubSkills1');
        handleTagRemoval('selectedTags1', 'subSkillsList1', 'selectedSubSkills1');

        handleCoreSkillChange('coreSkills2', 'subSkillsList2', 'selectedTags2', 'selectedSubSkills2', 'subSkillsLabel2');
        handleSubSkillSelection('subSkillsList2', 'selectedTags2', 'selectedSubSkills2');
        handleTagRemoval('selectedTags2', 'subSkillsList2', 'selectedSubSkills2');

        handleCoreSkillChange('coreSkills3', 'subSkillsList3', 'selectedTags3', 'selectedSubSkills3', 'subSkillsLabel3');
        handleSubSkillSelection('subSkillsList3', 'selectedTags3', 'selectedSubSkills3');
        handleTagRemoval('selectedTags3', 'subSkillsList3', 'selectedSubSkills3');
    });
</script>

<!--fetch sub category script-->
<script>
    $(document).ready(function() {
        $("#industry").change(function() {
            var industry_id = $(this).val();
            $.ajax({
                url: "get_subindustries.php",
                method: "POST",
                data: {industry_id: industry_id},
                success: function(data) {
                    $("#subindustry").html(data);
                }
            });
        });
    });
</script>


<!--experience section script-->
<script>
    function extractDomain(website) {
        website = website.replace(/^https?:\/\//, '').replace(/^www\./, '');
        return website.split('/')[0];
    }

    function isValidWebsite(website) {
        const regex = /^(https:\/\/|www\.)[a-zA-Z0-9-]+\.[a-zA-Z]{2,}(\/\S*)?$/;
        return regex.test(website);
    }

    function countWords(text) {
        return text.trim().split(/\s+/).filter(word => word.length > 0).length;
    }

    function applyValidation(section) {
        // Bind validation to the company website field
        section.find('.company-website').on('input', function () {
            const website = $(this).val().trim();
            const websiteError = $(this).siblings('.website-error-message');

            if (website && !isValidWebsite(website)) {
                websiteError.removeClass('hidden');
            } else {
                websiteError.addClass('hidden');
            }
        });

        // Bind validation to the company email field
        section.find('.company-email').on('input', function () {
            const website = section.find('.company-website').val().trim();
            const email = $(this).val().trim();
            const emailDomain = email.split('@')[1];
            const errorMessage = $(this).siblings('.error-message');

            if (website && email && emailDomain !== extractDomain(website)) {
                errorMessage.removeClass('hidden');
            } else {
                errorMessage.addClass('hidden');
            }
        });

        section.find('textarea[name^="accomplishment"]').on('input', function () {
            const text = $(this).val().trim();
            const wordCount = countWords(text);

            if (wordCount > 14) {
                alert("You can only enter up to 14 words in the accomplishments field.");
                // Truncate the text to 14 words
                const truncatedText = text.split(/\s+/).slice(0, 14).join(' ');
                $(this).val(truncatedText);
            }
        });
    }

    $(document).ready(function () {
        // Apply validation to all existing experience sections on page load
        $('.experience-section').each(function () {
            applyValidation($(this));
        });

        // Bind the "Present" checkbox event handler to the document level
        $(document).on('change', '#tillDateCheckbox', function () {
            const endDateInput = $(this).closest('.experience-section').find('#endDate');
            if ($(this).is(':checked')) {
                endDateInput.prop('disabled', true);
            } else {
                endDateInput.prop('disabled', false);
            }
        });

        // If you're dynamically adding new sections, reapply validation to the new fields
        $(document).on('click', '#addExperience', function () {
            const newSection = $('.experience-section').first().clone();
            newSection.find('input').val(''); // Clear input values in the new section
            newSection.find('.error-message').addClass('hidden'); // Hide error messages in the new section
            // Remove any existing "Remove" buttons from the clone
            newSection.find('.remove-experience').remove();

            // Add a new "Remove" button only to the cloned section
            newSection.append('<button class="remove-experience w-full h-10 mt-4 bg-red-500 text-white rounded-lg">Remove</button>');
            newSection.find('#endDate').prop('disabled', false); // Ensure the end date is enabled by default
            $('#experience-container').append(newSection);
            applyValidation(newSection); // Apply validation to the new section
            $(document).on('click', '.remove-experience', function () {
                newSection.remove();
            });
        });

    });
</script>

</body>

</html>
