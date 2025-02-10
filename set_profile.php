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

    <!-- jQuery (Required for Select2) -->
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    </style>
</head>

<body class="lg:overflow-hidden">
<!-- Header -->
<?php include ('include/header.php');?>

<div class="dashboard_main overflow-hidden lg:w-screen lg:h-screen flex sm:pt-20 pt-16">

    <div class="dashboard_payouts scrollbar_custom w-full bg-surface">
        <div class="container h-fit lg:pt-15 lg:pb-30 max-lg:py-12 max-sm:py-8">
            <button class="btn_open_popup btn_menu_dashboard flex items-center gap-2 lg:hidden" data-type="menu_dashboard">
                <span class="ph ph-squares-four text-xl"></span>
                <strong class="text-button">Menu</strong>
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
                                $fetch_country = $db_handle->runQuery("SELECT id,nationality FROM countries order by country_name ASC");
                                foreach($fetch_country as $country){
                                    ?>
                                    <option value="<?php echo $country['id'];?>"><?php echo $country['nationality'];?></option>
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
                            <label>Current State <span class="text-red">*</span></label>
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
                                <select class="h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity)); width: 35%" name="country_code" required>
                                    <option selected>Code</option>
                                    <option value="AF" <?php echo isset($country_code) && $country_code == 'AF' ? 'selected' : ''; ?>>(+93)</option>
                                    <option value="AL" <?php echo isset($country_code) && $country_code == 'AL' ? 'selected' : ''; ?>>(+355)</option>
                                    <option value="DZ" <?php echo isset($country_code) && $country_code == 'DZ' ? 'selected' : ''; ?>>(+213)</option>
                                    <option value="AD" <?php echo isset($country_code) && $country_code == 'AD' ? 'selected' : ''; ?>>(+376)</option>
                                    <option value="AO" <?php echo isset($country_code) && $country_code == 'AO' ? 'selected' : ''; ?>>(+244)</option>
                                    <option value="AG" <?php echo isset($country_code) && $country_code == 'AG' ? 'selected' : ''; ?>>(+1-268)</option>
                                    <option value="AR" <?php echo isset($country_code) && $country_code == 'AR' ? 'selected' : ''; ?>>(+54)</option>
                                    <option value="AM" <?php echo isset($country_code) && $country_code == 'AM' ? 'selected' : ''; ?>>(+374)</option>
                                    <option value="AU" <?php echo isset($country_code) && $country_code == 'AU' ? 'selected' : ''; ?>>(+61)</option>
                                    <option value="AT" <?php echo isset($country_code) && $country_code == 'AT' ? 'selected' : ''; ?>>(+43)</option>
                                    <option value="AZ" <?php echo isset($country_code) && $country_code == 'AZ' ? 'selected' : ''; ?>>(+994)</option>
                                    <option value="BS" <?php echo isset($country_code) && $country_code == 'BS' ? 'selected' : ''; ?>>(+1-242)</option>
                                    <option value="BH" <?php echo isset($country_code) && $country_code == 'BH' ? 'selected' : ''; ?>>(+973)</option>
                                    <option value="BD" <?php echo isset($country_code) && $country_code == 'BD' ? 'selected' : ''; ?>>(+880)</option>
                                    <option value="BB" <?php echo isset($country_code) && $country_code == 'BB' ? 'selected' : ''; ?>>(+1-246)</option>
                                    <option value="BY" <?php echo isset($country_code) && $country_code == 'BY' ? 'selected' : ''; ?>>(+375)</option>
                                    <option value="BE" <?php echo isset($country_code) && $country_code == 'BE' ? 'selected' : ''; ?>>(+32)</option>
                                    <option value="BZ" <?php echo isset($country_code) && $country_code == 'BZ' ? 'selected' : ''; ?>>(+501)</option>
                                    <option value="BJ" <?php echo isset($country_code) && $country_code == 'BJ' ? 'selected' : ''; ?>>(+229)</option>
                                    <option value="BT" <?php echo isset($country_code) && $country_code == 'BT' ? 'selected' : ''; ?>>(+975)</option>
                                    <option value="BO" <?php echo isset($country_code) && $country_code == 'BO' ? 'selected' : ''; ?>>(+591)</option>
                                    <option value="BA" <?php echo isset($country_code) && $country_code == 'BA' ? 'selected' : ''; ?>>(+387)</option>
                                    <option value="BW" <?php echo isset($country_code) && $country_code == 'BW' ? 'selected' : ''; ?>>(+267)</option>
                                    <option value="BR" <?php echo isset($country_code) && $country_code == 'BR' ? 'selected' : ''; ?>>(+55)</option>
                                    <option value="BN" <?php echo isset($country_code) && $country_code == 'BN' ? 'selected' : ''; ?>>(+673)</option>
                                    <option value="BG" <?php echo isset($country_code) && $country_code == 'BG' ? 'selected' : ''; ?>>(+359)</option>
                                    <option value="BF" <?php echo isset($country_code) && $country_code == 'BF' ? 'selected' : ''; ?>>(+226)</option>
                                    <option value="BI" <?php echo isset($country_code) && $country_code == 'BI' ? 'selected' : ''; ?>>(+257)</option>
                                    <option value="CV" <?php echo isset($country_code) && $country_code == 'CV' ? 'selected' : ''; ?>>(+238)</option>
                                    <option value="KH" <?php echo isset($country_code) && $country_code == 'KH' ? 'selected' : ''; ?>>(+855)</option>
                                    <option value="CM" <?php echo isset($country_code) && $country_code == 'CM' ? 'selected' : ''; ?>>(+237)</option>
                                    <option value="CA" <?php echo isset($country_code) && $country_code == 'CA' ? 'selected' : ''; ?>>(+1)</option>
                                    <option value="CF" <?php echo isset($country_code) && $country_code == 'CF' ? 'selected' : ''; ?>>(+236)</option>
                                    <option value="TD" <?php echo isset($country_code) && $country_code == 'TD' ? 'selected' : ''; ?>>(+235)</option>
                                    <option value="CL" <?php echo isset($country_code) && $country_code == 'CL' ? 'selected' : ''; ?>>(+56)</option>
                                    <option value="CN" <?php echo isset($country_code) && $country_code == 'CN' ? 'selected' : ''; ?>>(+86)</option>
                                    <option value="CO" <?php echo isset($country_code) && $country_code == 'CO' ? 'selected' : ''; ?>>(+57)</option>
                                    <option value="KM" <?php echo isset($country_code) && $country_code == 'KM' ? 'selected' : ''; ?>>(+269)</option>
                                    <option value="CD" <?php echo isset($country_code) && $country_code == 'CD' ? 'selected' : ''; ?>>(+243)</option>
                                    <option value="CG" <?php echo isset($country_code) && $country_code == 'CG' ? 'selected' : ''; ?>>(+242)</option>
                                    <option value="CR" <?php echo isset($country_code) && $country_code == 'CR' ? 'selected' : ''; ?>>(+506)</option>
                                    <option value="CI" <?php echo isset($country_code) && $country_code == 'CI' ? 'selected' : ''; ?>>(+225)</option>
                                    <option value="HR" <?php echo isset($country_code) && $country_code == 'HR' ? 'selected' : ''; ?>>(+385)</option>
                                    <option value="CU" <?php echo isset($country_code) && $country_code == 'CU' ? 'selected' : ''; ?>>(+53)</option>
                                    <option value="CY" <?php echo isset($country_code) && $country_code == 'CY' ? 'selected' : ''; ?>>(+357)</option>
                                    <option value="CZ" <?php echo isset($country_code) && $country_code == 'CZ' ? 'selected' : ''; ?>>(+420)</option>
                                    <option value="DK" <?php echo isset($country_code) && $country_code == 'DK' ? 'selected' : ''; ?>>(+45)</option>
                                    <option value="DJ" <?php echo isset($country_code) && $country_code == 'DJ' ? 'selected' : ''; ?>>(+253)</option>
                                    <option value="DM" <?php echo isset($country_code) && $country_code == 'DM' ? 'selected' : ''; ?>>(+1-767)</option>
                                    <option value="DO" <?php echo isset($country_code) && $country_code == 'DO' ? 'selected' : ''; ?>>(+1-809)</option>
                                    <option value="TL" <?php echo isset($country_code) && $country_code == 'TL' ? 'selected' : ''; ?>>(+670)</option>
                                    <option value="EC" <?php echo isset($country_code) && $country_code == 'EC' ? 'selected' : ''; ?>>(+593)</option>
                                    <option value="EG" <?php echo isset($country_code) && $country_code == 'EG' ? 'selected' : ''; ?>>(+20)</option>
                                    <option value="SV" <?php echo isset($country_code) && $country_code == 'SV' ? 'selected' : ''; ?>>(+503)</option>
                                    <option value="GQ" <?php echo isset($country_code) && $country_code == 'GQ' ? 'selected' : ''; ?>>(+240)</option>
                                    <option value="ER" <?php echo isset($country_code) && $country_code == 'ER' ? 'selected' : ''; ?>>(+291)</option>
                                    <option value="EE" <?php echo isset($country_code) && $country_code == 'EE' ? 'selected' : ''; ?>>(+372)</option>
                                    <option value="SZ" <?php echo isset($country_code) && $country_code == 'SZ' ? 'selected' : ''; ?>>(+268)</option>
                                    <option value="ET" <?php echo isset($country_code) && $country_code == 'ET' ? 'selected' : ''; ?>>(+251)</option>
                                    <option value="FJ" <?php echo isset($country_code) && $country_code == 'FJ' ? 'selected' : ''; ?>>(+679)</option>
                                    <option value="FI" <?php echo isset($country_code) && $country_code == 'FI' ? 'selected' : ''; ?>>(+358)</option>
                                    <option value="FR" <?php echo isset($country_code) && $country_code == 'FR' ? 'selected' : ''; ?>>(+33)</option>
                                    <option value="GA" <?php echo isset($country_code) && $country_code == 'GA' ? 'selected' : ''; ?>>(+241)</option>
                                    <option value="GM" <?php echo isset($country_code) && $country_code == 'GM' ? 'selected' : ''; ?>>(+220)</option>
                                    <option value="GE" <?php echo isset($country_code) && $country_code == 'GE' ? 'selected' : ''; ?>>(+995)</option>
                                    <option value="DE" <?php echo isset($country_code) && $country_code == 'DE' ? 'selected' : ''; ?>>(+49)</option>
                                    <option value="GH" <?php echo isset($country_code) && $country_code == 'GH' ? 'selected' : ''; ?>>(+233)</option>
                                    <option value="GR" <?php echo isset($country_code) && $country_code == 'GR' ? 'selected' : ''; ?>>(+30)</option>
                                    <option value="GD" <?php echo isset($country_code) && $country_code == 'GD' ? 'selected' : ''; ?>>(+1-473)</option>
                                    <option value="GT" <?php echo isset($country_code) && $country_code == 'GT' ? 'selected' : ''; ?>>(+502)</option>
                                    <option value="GN" <?php echo isset($country_code) && $country_code == 'GN' ? 'selected' : ''; ?>>(+224)</option>
                                    <option value="GW" <?php echo isset($country_code) && $country_code == 'GW' ? 'selected' : ''; ?>>(+245)</option>
                                    <option value="GY" <?php echo isset($country_code) && $country_code == 'GY' ? 'selected' : ''; ?>>(+592)</option>
                                    <option value="HT" <?php echo isset($country_code) && $country_code == 'HT' ? 'selected' : ''; ?>>(+509)</option>
                                    <option value="HN" <?php echo isset($country_code) && $country_code == 'HN' ? 'selected' : ''; ?>>(+504)</option>
                                    <option value="HU" <?php echo isset($country_code) && $country_code == 'HU' ? 'selected' : ''; ?>>(+36)</option>
                                    <option value="IS" <?php echo isset($country_code) && $country_code == 'IS' ? 'selected' : ''; ?>>(+354)</option>
                                    <option value="IN" <?php echo isset($country_code) && $country_code == 'IN' ? 'selected' : ''; ?>>(+91)</option>
                                    <option value="ID" <?php echo isset($country_code) && $country_code == 'ID' ? 'selected' : ''; ?>>(+62)</option>
                                    <option value="IR" <?php echo isset($country_code) && $country_code == 'IR' ? 'selected' : ''; ?>>(+98)</option>
                                    <option value="IQ" <?php echo isset($country_code) && $country_code == 'IQ' ? 'selected' : ''; ?>>(+964)</option>
                                    <option value="IE" <?php echo isset($country_code) && $country_code == 'IE' ? 'selected' : ''; ?>>(+353)</option>
                                    <option value="IL" <?php echo isset($country_code) && $country_code == 'IL' ? 'selected' : ''; ?>>(+972)</option>
                                    <option value="IT" <?php echo isset($country_code) && $country_code == 'IT' ? 'selected' : ''; ?>>(+39)</option>
                                    <option value="JM" <?php echo isset($country_code) && $country_code == 'JM' ? 'selected' : ''; ?>>(+1-876)</option>
                                    <option value="JP" <?php echo isset($country_code) && $country_code == 'JP' ? 'selected' : ''; ?>>(+81)</option>
                                    <option value="JO" <?php echo isset($country_code) && $country_code == 'JO' ? 'selected' : ''; ?>>(+962)</option>
                                    <option value="KZ" <?php echo isset($country_code) && $country_code == 'KZ' ? 'selected' : ''; ?>>(+7)</option>
                                    <option value="KE" <?php echo isset($country_code) && $country_code == 'KE' ? 'selected' : ''; ?>>(+254)</option>
                                    <option value="KI" <?php echo isset($country_code) && $country_code == 'KI' ? 'selected' : ''; ?>>(+686)</option>
                                    <option value="KP" <?php echo isset($country_code) && $country_code == 'KP' ? 'selected' : ''; ?>>(+850)</option>
                                    <option value="KR" <?php echo isset($country_code) && $country_code == 'KR' ? 'selected' : ''; ?>>(+82)</option>
                                    <option value="XK" <?php echo isset($country_code) && $country_code == 'XK' ? 'selected' : ''; ?>>(+383)</option>
                                    <option value="KW" <?php echo isset($country_code) && $country_code == 'KW' ? 'selected' : ''; ?>>(+965)</option>
                                    <option value="KG" <?php echo isset($country_code) && $country_code == 'KG' ? 'selected' : ''; ?>>(+996)</option>
                                    <option value="LA" <?php echo isset($country_code) && $country_code == 'LA' ? 'selected' : ''; ?>>(+856)</option>
                                    <option value="LV" <?php echo isset($country_code) && $country_code == 'LV' ? 'selected' : ''; ?>>(+371)</option>
                                    <option value="LB" <?php echo isset($country_code) && $country_code == 'LB' ? 'selected' : ''; ?>>(+961)</option>
                                    <option value="LS" <?php echo isset($country_code) && $country_code == 'LS' ? 'selected' : ''; ?>>(+266)</option>
                                    <option value="LR" <?php echo isset($country_code) && $country_code == 'LR' ? 'selected' : ''; ?>>(+231)</option>
                                    <option value="LY" <?php echo isset($country_code) && $country_code == 'LY' ? 'selected' : ''; ?>>(+218)</option>
                                    <option value="LI" <?php echo isset($country_code) && $country_code == 'LI' ? 'selected' : ''; ?>>(+423)</option>
                                    <option value="LT" <?php echo isset($country_code) && $country_code == 'LT' ? 'selected' : ''; ?>>(+370)</option>
                                    <option value="LU" <?php echo isset($country_code) && $country_code == 'LU' ? 'selected' : ''; ?>>(+352)</option>
                                    <option value="MG" <?php echo isset($country_code) && $country_code == 'MG' ? 'selected' : ''; ?>>(+261)</option>
                                    <option value="MW" <?php echo isset($country_code) && $country_code == 'MW' ? 'selected' : ''; ?>>(+265)</option>
                                    <option value="MY" <?php echo isset($country_code) && $country_code == 'MY' ? 'selected' : ''; ?>>(+60)</option>
                                    <option value="MV" <?php echo isset($country_code) && $country_code == 'MV' ? 'selected' : ''; ?>>(+960)</option>
                                    <option value="ML" <?php echo isset($country_code) && $country_code == 'ML' ? 'selected' : ''; ?>>(+223)</option>
                                    <option value="MT" <?php echo isset($country_code) && $country_code == 'MT' ? 'selected' : ''; ?>>(+356)</option>
                                    <option value="MH" <?php echo isset($country_code) && $country_code == 'MH' ? 'selected' : ''; ?>>(+692)</option>
                                    <option value="MR" <?php echo isset($country_code) && $country_code == 'MR' ? 'selected' : ''; ?>>(+222)</option>
                                    <option value="MU" <?php echo isset($country_code) && $country_code == 'MU' ? 'selected' : ''; ?>>(+230)</option>
                                    <option value="MX" <?php echo isset($country_code) && $country_code == 'MX' ? 'selected' : ''; ?>>(+52)</option>
                                    <option value="FM" <?php echo isset($country_code) && $country_code == 'FM' ? 'selected' : ''; ?>>(+691)</option>
                                    <option value="MD" <?php echo isset($country_code) && $country_code == 'MD' ? 'selected' : ''; ?>>(+373)</option>
                                    <option value="MC" <?php echo isset($country_code) && $country_code == 'MC' ? 'selected' : ''; ?>>(+377)</option>
                                    <option value="MN" <?php echo isset($country_code) && $country_code == 'MN' ? 'selected' : ''; ?>>(+976)</option>
                                    <option value="ME" <?php echo isset($country_code) && $country_code == 'ME' ? 'selected' : ''; ?>>(+382)</option>
                                    <option value="MA" <?php echo isset($country_code) && $country_code == 'MA' ? 'selected' : ''; ?>>(+212)</option>
                                    <option value="MZ" <?php echo isset($country_code) && $country_code == 'MZ' ? 'selected' : ''; ?>>(+258)</option>
                                    <option value="MM" <?php echo isset($country_code) && $country_code == 'MM' ? 'selected' : ''; ?>>(+95)</option>
                                    <option value="NA" <?php echo isset($country_code) && $country_code == 'NA' ? 'selected' : ''; ?>>(+264)</option>
                                    <option value="NR" <?php echo isset($country_code) && $country_code == 'NR' ? 'selected' : ''; ?>>(+674)</option>
                                    <option value="NP" <?php echo isset($country_code) && $country_code == 'NP' ? 'selected' : ''; ?>>(+977)</option>
                                    <option value="NL" <?php echo isset($country_code) && $country_code == 'NL' ? 'selected' : ''; ?>>(+31)</option>
                                    <option value="NZ" <?php echo isset($country_code) && $country_code == 'NZ' ? 'selected' : ''; ?>>(+64)</option>
                                    <option value="NI" <?php echo isset($country_code) && $country_code == 'NI' ? 'selected' : ''; ?>>(+505)</option>
                                    <option value="NE" <?php echo isset($country_code) && $country_code == 'NE' ? 'selected' : ''; ?>>(+227)</option>
                                    <option value="NG" <?php echo isset($country_code) && $country_code == 'NG' ? 'selected' : ''; ?>>(+234)</option>
                                    <option value="MK" <?php echo isset($country_code) && $country_code == 'MK' ? 'selected' : ''; ?>>(+389)</option>
                                    <option value="NO" <?php echo isset($country_code) && $country_code == 'NO' ? 'selected' : ''; ?>>(+47)</option>
                                    <option value="OM" <?php echo isset($country_code) && $country_code == 'OM' ? 'selected' : ''; ?>>(+968)</option>
                                    <option value="PK" <?php echo isset($country_code) && $country_code == 'PK' ? 'selected' : ''; ?>>(+92)</option>
                                    <option value="PW" <?php echo isset($country_code) && $country_code == 'PW' ? 'selected' : ''; ?>>(+680)</option>
                                    <option value="PA" <?php echo isset($country_code) && $country_code == 'PA' ? 'selected' : ''; ?>>(+507)</option>
                                    <option value="PG" <?php echo isset($country_code) && $country_code == 'PG' ? 'selected' : ''; ?>>(+675)</option>
                                    <option value="PY" <?php echo isset($country_code) && $country_code == 'PY' ? 'selected' : ''; ?>>(+595)</option>
                                    <option value="PE" <?php echo isset($country_code) && $country_code == 'PE' ? 'selected' : ''; ?>>P(+51)</option>
                                    <option value="PH" <?php echo isset($country_code) && $country_code == 'PH' ? 'selected' : ''; ?>>(+63)</option>
                                    <option value="PL" <?php echo isset($country_code) && $country_code == 'PL' ? 'selected' : ''; ?>>(+48)</option>
                                    <option value="PT" <?php echo isset($country_code) && $country_code == 'PT' ? 'selected' : ''; ?>>(+351)</option>
                                    <option value="QA" <?php echo isset($country_code) && $country_code == 'QA' ? 'selected' : ''; ?>>(+974)</option>
                                    <option value="RO" <?php echo isset($country_code) && $country_code == 'RO' ? 'selected' : ''; ?>>(+40)</option>
                                    <option value="RU" <?php echo isset($country_code) && $country_code == 'RU' ? 'selected' : ''; ?>>(+7)</option>
                                    <option value="RW" <?php echo isset($country_code) && $country_code == 'RW' ? 'selected' : ''; ?>>(+250)</option>
                                    <option value="KN" <?php echo isset($country_code) && $country_code == 'KN' ? 'selected' : ''; ?>>(+1 869)</option>
                                    <option value="LC" <?php echo isset($country_code) && $country_code == 'LC' ? 'selected' : ''; ?>>(+1 758)</option>
                                    <option value="VC" <?php echo isset($country_code) && $country_code == 'VC' ? 'selected' : ''; ?>>(+1 784)</option>
                                    <option value="WS" <?php echo isset($country_code) && $country_code == 'WS' ? 'selected' : ''; ?>>(+685)</option>
                                    <option value="SM" <?php echo isset($country_code) && $country_code == 'SM' ? 'selected' : ''; ?>>(+378)</option>
                                    <option value="ST" <?php echo isset($country_code) && $country_code == 'ST' ? 'selected' : ''; ?>>(+239)</option>
                                    <option value="SA" <?php echo isset($country_code) && $country_code == 'SA' ? 'selected' : ''; ?>>(+966)</option>
                                    <option value="SN" <?php echo isset($country_code) && $country_code == 'SN' ? 'selected' : ''; ?>>(+221)</option>
                                    <option value="RS" <?php echo isset($country_code) && $country_code == 'RS' ? 'selected' : ''; ?>>S(+381)</option>
                                    <option value="SC" <?php echo isset($country_code) && $country_code == 'SC' ? 'selected' : ''; ?>>(+248)</option>
                                    <option value="SL" <?php echo isset($country_code) && $country_code == 'SL' ? 'selected' : ''; ?>>S(+232)</option>
                                    <option value="SG" <?php echo isset($country_code) && $country_code == 'SG' ? 'selected' : ''; ?>>(+65)</option>
                                    <option value="SK" <?php echo isset($country_code) && $country_code == 'SK' ? 'selected' : ''; ?>>(+421)</option>
                                    <option value="SI" <?php echo isset($country_code) && $country_code == 'SI' ? 'selected' : ''; ?>>(+386)</option>
                                    <option value="SB" <?php echo isset($country_code) && $country_code == 'SB' ? 'selected' : ''; ?>>(+677)</option>
                                    <option value="SO" <?php echo isset($country_code) && $country_code == 'SO' ? 'selected' : ''; ?>>(+252)</option>
                                    <option value="ZA" <?php echo isset($country_code) && $country_code == 'ZA' ? 'selected' : ''; ?>>(+27)</option>
                                    <option value="ES" <?php echo isset($country_code) && $country_code == 'ES' ? 'selected' : ''; ?>>(+34)</option>
                                    <option value="LK" <?php echo isset($country_code) && $country_code == 'LK' ? 'selected' : ''; ?>>(+94)</option>
                                    <option value="SD" <?php echo isset($country_code) && $country_code == 'SD' ? 'selected' : ''; ?>>(+249)</option>
                                    <option value="SS" <?php echo isset($country_code) && $country_code == 'SS' ? 'selected' : ''; ?>>(+211)</option>
                                    <option value="SR" <?php echo isset($country_code) && $country_code == 'SR' ? 'selected' : ''; ?>>(+597)</option>
                                    <option value="SE" <?php echo isset($country_code) && $country_code == 'SE' ? 'selected' : ''; ?>>(+46)</option>
                                    <option value="CH" <?php echo isset($country_code) && $country_code == 'CH' ? 'selected' : ''; ?>>(+41)</option>
                                    <option value="SY" <?php echo isset($country_code) && $country_code == 'SY' ? 'selected' : ''; ?>>(+963)</option>
                                    <option value="TW" <?php echo isset($country_code) && $country_code == 'TW' ? 'selected' : ''; ?>>(+886)</option>
                                    <option value="TJ" <?php echo isset($country_code) && $country_code == 'TJ' ? 'selected' : ''; ?>>(+992)</option>
                                    <option value="TZ" <?php echo isset($country_code) && $country_code == 'TZ' ? 'selected' : ''; ?>>(+255)</option>
                                    <option value="TH" <?php echo isset($country_code) && $country_code == 'TH' ? 'selected' : ''; ?>>(+66)</option>
                                    <option value="TG" <?php echo isset($country_code) && $country_code == 'TG' ? 'selected' : ''; ?>>(+228)</option>
                                    <option value="TO" <?php echo isset($country_code) && $country_code == 'TO' ? 'selected' : ''; ?>>(+676)</option>
                                    <option value="TT" <?php echo isset($country_code) && $country_code == 'TT' ? 'selected' : ''; ?>>(+1 868)</option>
                                    <option value="TN" <?php echo isset($country_code) && $country_code == 'TN' ? 'selected' : ''; ?>>(+216)</option>
                                    <option value="TR" <?php echo isset($country_code) && $country_code == 'TR' ? 'selected' : ''; ?>>(+90)</option>
                                    <option value="TM" <?php echo isset($country_code) && $country_code == 'TM' ? 'selected' : ''; ?>>(+993)</option>
                                    <option value="TV" <?php echo isset($country_code) && $country_code == 'TV' ? 'selected' : ''; ?>>(+688)</option>
                                    <option value="UG" <?php echo isset($country_code) && $country_code == 'UG' ? 'selected' : ''; ?>>(+256)</option>
                                    <option value="UA" <?php echo isset($country_code) && $country_code == 'UA' ? 'selected' : ''; ?>>(+380)</option>
                                    <option value="AE" <?php echo isset($country_code) && $country_code == 'AE' ? 'selected' : ''; ?>>(+971)</option>
                                    <option value="GB" <?php echo isset($country_code) && $country_code == 'GB' ? 'selected' : ''; ?>>(+44)</option>
                                    <option value="US" <?php echo isset($country_code) && $country_code == 'US' ? 'selected' : ''; ?>>(+1)</option>
                                    <option value="UY" <?php echo isset($country_code) && $country_code == 'UY' ? 'selected' : ''; ?>>(+598)</option>
                                    <option value="UZ" <?php echo isset($country_code) && $country_code == 'UZ' ? 'selected' : ''; ?>>(+998)</option>
                                    <option value="VU" <?php echo isset($country_code) && $country_code == 'VU' ? 'selected' : ''; ?>>(+678)</option>
                                    <option value="VA" <?php echo isset($country_code) && $country_code == 'VA' ? 'selected' : ''; ?>>(+39)</option>
                                    <option value="VE" <?php echo isset($country_code) && $country_code == 'VE' ? 'selected' : ''; ?>>(+58)</option>
                                    <option value="VN" <?php echo isset($country_code) && $country_code == 'VN' ? 'selected' : ''; ?>>(+84)</option>
                                    <option value="YE" <?php echo isset($country_code) && $country_code == 'YE' ? 'selected' : ''; ?>>(+967)</option>
                                    <option value="ZM" <?php echo isset($country_code) && $country_code == 'ZM' ? 'selected' : ''; ?>>(+260)</option>
                                    <option value="ZW" <?php echo isset($country_code) && $country_code == 'ZW' ? 'selected' : ''; ?>>(+263)</option>
                                </select>
                                <input class="h-12 px-4 mt-2 border-line rounded-lg" style="width: 65%;" type="text" name="contact_number" id="contact_number" placeholder="Enter phone number" required value="<?php echo isset($contact_number) ? htmlspecialchars($contact_number) : ''; ?>">
                            </div>
                        </div>
                        <div class="contactemail">
                            <label for="contactemail">Contact Email <span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="contact_email" type="text" placeholder="enter contact email" name="contact_email" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Job preferred location <span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg"
                                   id="jobLocation"
                                   type="text"
                                   placeholder="Search job preferred location"
                                   list="locationList"
                                   autocomplete="off"
                                   name="preferred_job_location"
                                   required />
                            <datalist id="locationList">
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
                            </datalist>
                        </div>
                    </div>
                    <!-- Your HTML Container -->
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
                                    <!-- Add dynamic field options here -->
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="Engineering">Engineering</option>
                                    <option value="Business">Business</option>
                                    <!-- Add more options as required -->
                                </select>
                            </div>

                            <!-- GPA -->
                            <div class="jobLocation">
                                <label for="jobLocation">GPA</label>
                                <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="10" name="global_gpa[]" required />
                            </div>

                            <!-- College/University Name -->
                            <div class="jobLocation">
                                <label for="jobLocation">College/University Name</label>
                                <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="College/University Name" name="global_university[]" required />
                            </div>

                            <!-- Credential Accreditation -->
                            <div class="education_level">
                                <label>Credential Accreditation <span class="text-red">*</span></label>
                                <select class="w-full h-12 px-4 mt-2 border-line rounded-lg accreditation" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="accreditation[]" required>
                                    <option selected value="">Select Credential Accreditation</option>
                                    <option value="N/A">N/A</option>
                                    <option value="WES">WES</option>
                                    <option value="Alberta">Alberta</option>
                                </select>
                            </div>

                            <!-- Certificate number input (initially hidden) -->
                            <div class="jobLocation certificateDiv" style="display: none;">
                                <label for="certificate_number">Certificate No (If applicable)</label>
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
                    <div id="educationContainer">
                        <!-- Initial Education Section -->
                        <div class="educationSection">
                            <h5 class="heading5 mt-5">Canadian Education</h5>
                            <button type="button" class="toggle_btn"></button>
                            <div class="educationFields grid sm:grid-cols-3 gap-3">
                                <div class="education_level">
                                    <label>Level of Education</label>
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
                                    <label>Field of Study</label>
                                    <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" name="canadian_field_of_study[]" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" disabled>
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
                                <div class="education_level">
                                    <label>College/University</label>
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
                                    <label>Location</label>
                                    <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="canadian_study_location[]" disabled>
                                        <option selected>Select City</option>
                                        <?php
                                        $fetch_city = $db_handle->runQuery("select * from cities");
                                        foreach ($fetch_city as $row) {
                                            ?>
                                            <option value="<?php echo $row['city_id']?>"><?php echo $row['city_name']?></option>
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
                                    <label>Credential Accreditation <span class="text-red">*</span></label>
                                    <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" name="canadian_accreditation[]" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" required disabled>
                                        <option selected value="">Select Credential Accreditation</option>
                                        <option value="N/A">N/A</option>
                                        <option value="WES">WES</option>
                                        <option value="Alberta">Alberta</option>
                                    </select>
                                </div>
                                <div class="jobLocation certificateDivCanadian" style="display: none;">
                                    <label for="certificate_number">Certificate No (If applicable)</label>
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
                    <h5 class="heading5 mt-5">Skills</h5>
                    <div class="grid grid-cols-4 gap-3">
                        <!-- First set of core skills and sub-skills -->
                        <div class="education_level col-span-1">
                            <label>Core Skill 1</label>
                            <select id="coreSkills1" class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="core_skill_one" required>
                                <option selected>Select Core Skills</option>
                                <?php
                                $fetch_skills = $db_handle->runQuery("SELECT * FROM skills ORDER BY core_skill ASC");
                                foreach ($fetch_skills as $row) {
                                    ?>
                                    <option value="<?php echo $row['skill_id']?>"><?php echo $row['core_skill']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="education_level" style="width: 300%">
                            <div id="subSkillsLabel1" style="display: none;">
                                <label>Sub Skills 1</label>
                            </div>
                            <input id="selectedSubSkills1" type="hidden" name="sub_skills_one"/>
                            <div id="subSkillsList1" type="hidden"></div>
                            <div class="selected-tags" id="selectedTags1"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-4 gap-3 mt-4">
                        <!-- Second set of core skills and sub-skills -->
                        <div class="education_level col-span-1">
                            <label>Core Skill 2</label>
                            <select id="coreSkills2" class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="core_skill_two">
                                <option value="">Select Core Skill</option>
                                <?php
                                $fetch_skills = $db_handle->runQuery("SELECT * FROM skills ORDER BY core_skill ASC");
                                foreach ($fetch_skills as $row) {
                                    ?>
                                    <option value="<?php echo $row['skill_id']?>"><?php echo $row['core_skill']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="education_level" style="width: 300%">
                            <div id="subSkillsLabel2" style="display: none;"> <!-- Initially hidden -->
                                <label>Sub Skills 2</label>
                            </div>
                            <input id="selectedSubSkills2" type="hidden" name="sub_skills_two"/>
                            <div class="selected-tags" id="selectedTags2"></div>
                            <div id="subSkillsList2" type="hidden"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-4 gap-3 mt-4">
                        <!-- Third set of core skills and sub-skills -->
                        <div class="education_level col-span-1">
                            <label>Core Skill 3</label>
                            <select id="coreSkills3" class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="core_skill_three" >
                                <option value="">Select Core Skills</option>
                                <?php
                                $fetch_skills = $db_handle->runQuery("SELECT * FROM skills ORDER BY core_skill ASC");
                                foreach ($fetch_skills as $row) {
                                    ?>
                                    <option value="<?php echo $row['skill_id']?>"><?php echo $row['core_skill']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="education_level" style="width: 300%">
                            <div id="subSkillsLabel3" style="display: none;"> <!-- Initially hidden -->
                                <label>Sub Skills 3</label>
                            </div>
                            <input id="selectedSubSkills3" type="hidden" name="sub_skills_three"/>
                            <div class="selected-tags" id="selectedTags3"></div>
                            <div id="subSkillsList3" type="hidden"></div>
                        </div>
                    </div>

                    <!-- Work Experience Section Wrapper -->
                    <div id="experience-container">
                        <div class="experience-section">
                            <h5 class="heading5 mt-5">Work Experience</h5>
                            <div class="grid sm:grid-cols-3 gap-3">
                                <div class="education_level">
                                    <label>Industry</label>
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
                                    <label>Sub Industry</label>
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
                                    <label>Job Title</label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" placeholder="Software Engineer" name="job_location[]" required />
                                </div>
                                <div class="jobLocation">
                                    <label>Company Name</label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" placeholder="Company Name" name="company_name[]" required />
                                </div>
                                <div class="jobLocation">
                                    <label>Company Website Link</label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg company-website" type="text" placeholder="www.abc.com or https://abc.com" name="company_website[]" required />
                                </div>
                                <div class="jobLocation">
                                    <label>Start Date</label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="date" name="start_date[]" required />
                                </div>
                                <div class="jobLocation">
                                    <label>End Date</label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="date" name="end_date[]" id="endDate" required />
                                </div>
                                <div class="jobLocation">
                                    <label>Working till now?</label>
                                    <input type="checkbox" class="px-4 mt-2 border-line rounded-lg" name="till_date[]" id="tillDateCheckbox" value="1"> Yes
                                </div>
                                <div class="jobLocation">
                                    <label>Accomplishments</label>
                                    <textarea class="w-full h-12 px-4 mt-2 border-line rounded-lg" required name="accomplishment[]"></textarea>
                                </div>
                                <div class="jobLocation">
                                    <label>Accomplishments</label>
                                    <textarea class="w-full h-12 px-4 mt-2 border-line rounded-lg" required name="accomplishment2[]"></textarea>
                                </div>
                                <div class="jobLocation">
                                    <label>Accomplishments</label>
                                    <textarea class="w-full h-12 px-4 mt-2 border-line rounded-lg" required name="accomplishment3[]"></textarea>
                                </div>
                            </div>

                            <hr class="mt-5 mb-5">
                            <h2 style="font-size: 30px; font-weight: bold" class="mt-5 mb-5">Work Experience Verification:</h2>
                            <div class="grid sm:grid-cols-3 gap-3">
                                <div class="jobLocation">
                                    <label>Reference Type</label>
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
                            <h2 style="font-size: 30px; font-weight: bold" class="mt-5 mb-5">Reference:</h2>
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

                    <!--video section-->
                    <h5 class="heading5 mt-5">Video Section</h5>
                    <div class="grid sm:grid-cols-3 gap-3">
                        <!-- Trigger Button -->
                        <button type="button" class="w-full h-12 px-4 mt-2 button-main -border mt-5"
                                onclick="document.getElementById('modal').classList.remove('hidden')">Add Video</button>

                        <!-- Modal -->
                        <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center" style="z-index: 50">
                            <div class="bg-white rounded-2xl shadow-xl max-w-2xl w-full p-6 overflow-y-auto max-h-[90vh]">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-2xl font-bold">🎥 Video Recording Tips</h2>
                                    <button class="text-red-500 text-xl" onclick="document.getElementById('modal').classList.add('hidden')">
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

                                    <button id="showMoreBtn" class="text-blue-600 font-semibold" onclick="toggleContent()">Show More ▼</button>

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
                                    <button id="uploadButton" type="button" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Upload</button>
                                </div>
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

                            function closeModal(id) {
                                document.getElementById(id).classList.add('hidden');
                                document.getElementById(id).classList.remove('flex');
                            }

                            // Handle File Upload
                            document.getElementById('uploadButton').addEventListener('click', function () {
                                closeModal('uploadModal');
                                const fileInput = document.getElementById('video-file');  // Ensure this is the correct ID
                                const file = fileInput ? fileInput.files[0] : null;  // Check if fileInput is found and the file exists
                                spinner.classList.remove('hidden'); // Show the spinner
                                if (file) {
                                    // Generate a random number between 1 and 1000
                                    const randomNum = Math.floor(Math.random() * 1000) + 1;

                                    // Get the current date and time (in a simplified format)
                                    const currentDateTime = new Date().toISOString().replace(/[^\w\s]/gi, '_');  // Format: YYYY-MM-DDTHH-MM-SS

                                    // Construct a new filename with random number + date-time
                                    const newFileName = `${randomNum}_${currentDateTime}.mp4`;  // Assuming the file is MP4

                                    const formData = new FormData();
                                    formData.append('video', file, newFileName);  // Send the file with the new name

                                    // Send the file to the server
                                    $.ajax({
                                        url: 'upload.php',
                                        type: 'POST',
                                        data: formData,
                                        contentType: false,
                                        processData: false,
                                        success: function (response) {
                                            console.log('File uploaded successfully!');
                                            console.log(response); // Show success message from PHP
                                            document.getElementById('videoSrc').value = newFileName; // Set the response (URL or path) in the hidden input
                                            spinner.classList.add('hidden'); // Show the spinner
                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            console.log('Error uploading file: ' + errorThrown);
                                        }
                                    });
                                } else {
                                    alert('Please select a file to upload.');
                                }
                            });


                            let mediaRecorder;
                            let recordedChunks = [];
                            let stream;
                            let timerInterval;
                            let countdown = 120; // 5 seconds countdown
                            let isRecording = false; // Flag to check if recording is in progress

                            // Create a timestamp for the filename
                            function generateFileName() {
                                const randomNum = Math.floor(Math.random() * 1000) + 1; // Generate random number
                                const timestamp = new Date().toISOString().replace(/[^\w\s]/gi, '_'); // Timestamp with valid characters
                                return `${randomNum}_${timestamp}_recording.mp4`; // Format filename as randomNum_timestamp_recording.mp4
                            }

                            const fileName = generateFileName(); // Example format: 123_2025-02-06T14-35-20_recording.mp4

                            // Check if MediaRecorder is supported
                            if (!window.MediaRecorder) {
                                alert('MediaRecorder is not supported in your browser. Please use a modern browser like Chrome or Firefox.');
                                throw new Error('MediaRecorder is not supported.');
                            }

                            // Start the webcam and initialize media recorder
                            function startWebcam() {
                                navigator.mediaDevices.getUserMedia({ video: true, audio: true })
                                    .then(function (mediaStream) {
                                        console.log("Media Stream is successfully acquired:", mediaStream);
                                        stream = mediaStream;
                                        const videoElement = document.getElementById('webcam');
                                        videoElement.srcObject = stream;
                                        videoElement.style.display = 'block'; // Show webcam preview

                                        try {
                                            // Try setting MIME type to 'video/webm' as it's widely supported
                                            const mimeType = 'video/webm'; // Default MIME type for recording
                                            if (!MediaRecorder.isTypeSupported(mimeType)) {
                                                console.error(`${mimeType} is not supported. Trying 'video/mp4'...`);
                                            } else {
                                                console.log(`${mimeType} is supported.`);
                                            }

                                            mediaRecorder = new MediaRecorder(stream, { mimeType: mimeType });

                                            console.log("MediaRecorder initialized:", mediaRecorder);

                                            mediaRecorder.ondataavailable = function (event) {
                                                recordedChunks.push(event.data);
                                            };

                                            mediaRecorder.onstop = function () {
                                                console.log("Recording stopped.");
                                                const blob = new Blob(recordedChunks, { type: mimeType });
                                                if (blob.size > 0) {
                                                    const formData = new FormData();
                                                    formData.append('video', blob, fileName);

                                                    // Send the video to PHP for saving
                                                    $.ajax({
                                                        url: 'upload.php',
                                                        type: 'POST',
                                                        data: formData,
                                                        contentType: false,
                                                        processData: false,
                                                        success: function (response) {
                                                            console.log('File uploaded successfully!');
                                                            document.getElementById('videoSrc').value = fileName; // Set the response (URL or message) in the hidden input
                                                            document.getElementById('webcam').style.display = 'none';
                                                            document.getElementById('timer').style.display = 'none';
                                                            document.getElementById('start-recording').style.display = 'none';
                                                        },
                                                        error: function (jqXHR, textStatus, errorThrown) {
                                                            console.log('Error uploading file: ' + errorThrown);
                                                        }
                                                    });

                                                    // Play the recorded video
                                                    const videoPlayer = document.getElementById('video-player');
                                                    videoPlayer.src = URL.createObjectURL(blob); // Create URL for playback
                                                    videoPlayer.style.display = 'block'; // Show the video player
                                                    videoPlayer.play(); // Start playing the video
                                                } else {
                                                    console.log("Recording resulted in empty file.");
                                                }
                                            };
                                        } catch (error) {
                                            console.error("Error initializing MediaRecorder: ", error);
                                        }
                                    })
                                    .catch(function (err) {
                                        console.error("Error accessing webcam: ", err);
                                        alert('There was an issue accessing the webcam or microphone.');
                                    });
                            }

                            // Stop the webcam stream
                            function stopWebcam() {
                                const videoElement = document.getElementById('webcam');
                                const stream = videoElement.srcObject;

                                // Stop all tracks in the webcam stream
                                if (stream) {
                                    const tracks = stream.getTracks();
                                    tracks.forEach(track => track.stop()); // Stop each track (video/audio)
                                    videoElement.srcObject = null; // Clear the video source object
                                }
                            }

                            // Start recording
                            $('#start-recording').click(function () {
                                if (!isRecording) {
                                    resetRecordingState(); // Reset all variables and UI elements
                                    if (mediaRecorder && mediaRecorder.state === 'inactive') {
                                        isRecording = true; // Set the recording flag to true
                                        $('#start-recording').attr('disabled', true); // Disable the start button
                                        $('#timer').show(); // Show timer

                                        // Wait 1 second before starting recording
                                        setTimeout(function () {
                                            try {
                                                console.log("Starting recording...");
                                                mediaRecorder.start(); // Start recording
                                                startTimer(); // Start countdown timer
                                            } catch (error) {
                                                console.error("Error starting MediaRecorder: ", error);
                                                alert("Failed to start recording. Please check if your camera and microphone are accessible.");
                                            }
                                        }, 1000); // 1-second delay before starting recording
                                    } else {
                                        console.error("MediaRecorder is not initialized or already recording.");
                                        alert("Recording is already in progress or MediaRecorder is not ready.");
                                    }
                                } else {
                                    console.log("Already recording...");
                                }
                            });

                            // Reset all variables and UI elements after stopping or starting again
                            function resetRecordingState() {
                                // Reset countdown
                                countdown = 120;
                                $('#timer').text('02:00'); // Reset the timer display

                                // Clear previous recorded video
                                const videoPlayer = document.getElementById('video-player');
                                videoPlayer.style.display = 'none'; // Hide the previous video player
                                videoPlayer.src = ''; // Clear the previous video

                                // Clear previous chunks
                                recordedChunks = [];

                                // Stop any active recording or webcam
                                if (isRecording) {
                                    stopRecording();
                                }

                                // Restart webcam if needed
                                stopWebcam();
                                startWebcam();
                            }

                            // Start countdown timer
                            function startTimer() {
                                timerInterval = setInterval(function () {
                                    countdown--;
                                    let minutes = Math.floor(countdown / 60);
                                    let seconds = countdown % 60;
                                    document.getElementById('timer').innerText = `${minutes < 10 ? '0' + minutes : minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
                                    if (countdown <= 0) {
                                        clearInterval(timerInterval);
                                        stopRecording(); // Automatically stop recording after 5 seconds
                                    }
                                }, 1000);
                            }

                            // Stop recording automatically after 5 seconds
                            function stopRecording() {
                                if (mediaRecorder && mediaRecorder.state === 'recording') {
                                    mediaRecorder.stop();
                                    stopWebcam(); // Stop webcam stream
                                    $('#start-recording').attr('disabled', false); // Re-enable the start button
                                    $('#timer').hide(); // Hide timer
                                    isRecording = false; // Reset the recording flag
                                } else {
                                    console.log("MediaRecorder is not recording.");
                                }
                            }
                        </script>
                    </div>

                    <!--career goal section-->
                    <h5 class="heading5 mt-5">Career Goals</h5>
                    <div class="grid sm:grid-cols-3 gap-3">
                        <div class="jobLocation">
                            <label for="jobLocation">Role</label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="Enter career role" name="career_role" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Industry</label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="Enter career industry" name="career_industry" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">NOC Number</label>
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

<?php include ('include/script.php');?>

<!--js for appending global education field-->
<script>
    document.getElementById('addGlobalEducation').addEventListener('click', function () {
        const educationContainer = document.getElementById('educationContainer');
        const educationSet = educationContainer.querySelector('.educationSet').cloneNode(true);

        // Clear input values in the cloned set
        educationSet.querySelectorAll('input, select').forEach(element => {
            if (element.tagName === 'INPUT') {
                element.value = ''; // Clear input fields
            } else if (element.tagName === 'SELECT') {
                element.selectedIndex = 0; // Reset select options
            }
        });

        // Remove 'id' attributes on cloned elements (ensuring unique ids)
        educationSet.querySelectorAll('input, select').forEach(element => {
            element.removeAttribute('id');
        });

        // Show the remove button for the appended set
        const removeButton = educationSet.querySelector('.removeEducationSet');
        removeButton.style.display = 'block'; // Make the remove button visible

        // Add remove button functionality
        removeButton.addEventListener('click', function () {
            educationSet.remove();
        });

        // Add accreditation dropdown functionality for the new set
        const accreditationDropdown = educationSet.querySelector('.accreditation');
        const certificateDiv = educationSet.querySelector('.certificateDiv');
        const certificateInput = educationSet.querySelector('.certificate_number');

        // Event listener to toggle certificate input based on accreditation selection
        accreditationDropdown.addEventListener('change', function () {
            if (this.value && this.value !== 'N/A') {
                certificateDiv.style.display = 'block';
                certificateInput.required = true;
            } else {
                certificateDiv.style.display = 'none';
                certificateInput.required = false;
                certificateInput.value = ''; // Clear the field if hidden
            }
        });

        // Append the new education set to the container
        educationContainer.appendChild(educationSet);
    });

    // Initial accreditation dropdown functionality for the first set
    document.querySelectorAll('.accreditation').forEach(dropdown => {
        dropdown.addEventListener('change', function () {
            const certificateDiv = this.closest('.educationSet').querySelector('.certificateDiv');
            const certificateInput = this.closest('.educationSet').querySelector('.certificate_number');

            if (this.value && this.value !== 'N/A') {
                certificateDiv.style.display = 'block';
                certificateInput.required = true;
            } else {
                certificateDiv.style.display = 'none';
                certificateInput.required = false;
                certificateInput.value = ''; // Optional: Clear the field when hidden
            }
        });
    });

</script>

<!--for hiding and displaying the certificate in global and canadian study fields-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const educationContainer = document.getElementById('educationContainer');
        const addButton = document.getElementById('addCanadianEducation');

        // Function to enable/disable fields when toggle button is clicked
        function setupToggleButton(section) {
            const toggleButton = section.querySelector('.toggle_btn');
            const educationFields = section.querySelectorAll('select, input');

            toggleButton.addEventListener('click', function () {
                const isActive = toggleButton.classList.contains('active');

                if (isActive) {
                    educationFields.forEach(field => field.disabled = true);
                } else {
                    educationFields.forEach(field => field.disabled = false);
                }
            });
        }

        // Function to handle accreditation change
        function setupAccreditationChange(section) {
            const accreditationSelect = section.querySelector('select[name="canadian_accreditation[]"]');
            const certificateDiv = section.querySelector('.certificateDivCanadian');
            const certificateInput = section.querySelector('input[name="canadian_certificate_number[]"]');

            if (accreditationSelect) {
                accreditationSelect.addEventListener('change', function () {
                    if (this.value && this.value !== 'N/A') {
                        certificateDiv.style.display = 'block';
                        certificateInput.required = true;
                    } else {
                        certificateDiv.style.display = 'none';
                        certificateInput.required = false;
                        certificateInput.value = ''; // Clear the field when hidden
                    }
                });
            }
        }

        // Function to handle the remove button
        function setupRemoveButton(section) {
            const removeButton = section.querySelector('.remove_btn');
            if (removeButton) {
                removeButton.addEventListener('click', function () {
                    section.remove(); // Remove the entire section
                });
            }
        }

        // Function to clone and append a new education section
        function addEducationSection() {
            const originalSection = document.querySelector('.educationSection');
            const newSection = originalSection.cloneNode(true); // Deep clone the section

            // Reset the fields in the new section
            newSection.querySelectorAll('select').forEach(select => {
                select.selectedIndex = 0; // Reset dropdowns to the first option
            });
            newSection.querySelectorAll('input').forEach(input => {
                input.value = ''; // Clear input fields
            });

            // Append the new section to the container
            educationContainer.appendChild(newSection);

            // Reattach event listeners for the new section
            setupToggleButton(newSection);
            setupAccreditationChange(newSection);
            setupRemoveButton(newSection); // Attach remove button functionality
        }

        // Attach the addEducationSection function to the "Add Another Education" button
        addButton.addEventListener('click', addEducationSection);

        // Initialize event listeners for the first section
        setupToggleButton(document.querySelector('.educationSection'));
        setupAccreditationChange(document.querySelector('.educationSection'));
        setupRemoveButton(document.querySelector('.educationSection')); // Attach remove button for the first section
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


<script>
    $(document).ready(function() {
        // Function to handle core skill change
        function handleCoreSkillChange(coreSkillId, subSkillsListId, selectedTagsId, selectedSubSkillsId, subSkillsLabelId) {
            $(`#${coreSkillId}`).change(function() {
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


<script>
    function extractDomain(website) {
        website = website.replace(/^https?:\/\//, '').replace(/^www\./, '');
        return website.split('/')[0];
    }

    function validateAllEmails() {
        let allValid = true;

        $('.experience-section').each(function () {
            const website = $(this).find('.company-website').val().trim();
            const domain = extractDomain(website);

            $(this).find('.company-email').each(function () {
                const email = $(this).val().trim();
                const emailDomain = email.split('@')[1];
                const errorMessage = $(this).siblings('.error-message');

                if (website && email && emailDomain !== domain) {
                    errorMessage.removeClass('hidden');
                    allValid = false;
                } else {
                    errorMessage.addClass('hidden');
                }
            });
        });

        $('#publishButton').prop('disabled', !allValid);
    }

    $(document).ready(function () {
        function applyValidation(section) {
            section.find('.company-website, .company-email').on('input', function () {
                validateAllEmails();
            });
        }

        applyValidation($('.experience-section').first());

        $("#addExperience").click(function (e) {
            e.preventDefault();
            let newExperience = $(".experience-section").first().clone();

            // Clear all input fields and error messages
            newExperience.find("input, textarea, select").val("");
            newExperience.find('.error-message').addClass('hidden');

            // Remove any existing "Remove" buttons from the clone
            newExperience.find('.remove-experience').remove();

            // Add a new "Remove" button only to the cloned section
            newExperience.append('<button class="remove-experience w-full h-10 mt-4 bg-red-500 text-white rounded-lg">Remove</button>');

            // Append the new experience section
            $("#experience-container").append(newExperience);

            applyValidation(newExperience);
        });

        // Remove the specific experience section on clicking the "Remove" button
        $(document).on('click', '.remove-experience', function () {
            $(this).closest('.experience-section').remove();
            validateAllEmails();
        });

        validateAllEmails();
    });


</script>

</body>

</html>
