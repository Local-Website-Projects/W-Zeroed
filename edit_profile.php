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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Zeroed - Job Board & Freelance Marketplace" />
    <title>Zeroed - Edit Profile</title>
    <?php include ('include/css.php');?>

    <!-- jQuery (Required for Select2) -->
    <!-- jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
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
            </button>
            <div class="list_category p-6 mt-7.5 rounded-lg bg-white">
                <h5 class="heading5" style="margin-top: 0 !important;">Personal Information</h5>

                <form class="form" method="post" action="Update" enctype="multipart/form-data">
                    <?php
                    $seller = $_SESSION['seller_id'];
                    $fetch_profile = $db_handle->runQuery("select * from seller_personal_information where user_id = '$seller'");
                    ?>
                    <!--personal information section start-->
                    <div class="grid sm:grid-cols-3 gap-3">
                        <div class="firstName">
                            <label for="firstName">First name <span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="firstName" type="text" value="<?php echo $fetch_profile[0]['first_name']; ?>" placeholder="Enter first name" autocomplete="off" name="first_name" required />
                        </div>
                        <div class="lastName">
                            <label for="lastName">Last name <span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="lastName" type="text" placeholder="Enter last name" value="<?php echo $fetch_profile[0]['last_name']; ?>" autocomplete="off" name="last_name" required />
                        </div>
                        <div class="profile">
                            <label for="profile">Profile Image<span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="profile" type="file" name="profile_image" />
                            <img src="<?php echo $fetch_profile[0]['profile_image']; ?>" alt="" width="100px;" style="margin-left: auto"/>
                        </div>
                        <div class="gender">
                            <label for="gender">Gender <span class="text-red">* </span></label><br/>
                            <input class="px-4 mt-2 border-line rounded-lg" id="gender" type="radio" name="gender" value="male" <?php if($fetch_profile[0]['gender']=="male") echo 'checked'; ?> required />
                            <label for="gender" style="padding-right: 20px;">Male</label>
                            <input class="px-4 mt-2 border-line rounded-lg" id="gender" type="radio" name="gender" value="female" <?php if($fetch_profile[0]['gender']=="female") echo 'checked'; ?> required />
                            <label for="gender" style="padding-right: 20px;">Female</label>
                            <input class="px-4 mt-2 border-line rounded-lg" id="gender" type="radio" name="gender" value="Other" <?php if($fetch_profile[0]['gender']=="Other") echo 'checked'; ?> required />
                            <label for="gender" style="padding-right: 20px;">Other</label>
                        </div>
                        <div class="nationality">
                            <label>Nationality <span class="text-red">*</span></label>
                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity))" id="mySelect2" name="nationality" required>
                                <option disabled>Please select your nationality</option>
                                <?php
                                $fetch_country = $db_handle->runQuery("SELECT id,nationality FROM countries order by country_name ASC");
                                foreach($fetch_country as $country){
                                    ?>
                                    <option value="<?php echo $country['id'];?>" <?php if($fetch_profile[0]['nationality']==$country['id']) echo 'selected'; ?>><?php echo $country['nationality'];?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="country">
                            <label>Country <span class="text-red">*</span></label>
                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg country_select" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity))" onchange="loadStates()" name="country" required>
                                <option selected>Please select country</option>
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
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="contact_email" type="text"  value="<?php echo $fetch_profile[0]['contact_email']; ?>" placeholder="enter contact email" name="contact_email" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Job preferred location <span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg"
                                   id="jobLocation"
                                   type="text"
                                   value="<?php echo $fetch_profile[0]['job_preferred_location']; ?>"
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
                    <div class="flex items-center col-span-full gap-5 mt-5">
                        <button class="button-main" type="submit" name="update_personal_info" id="publishButton">Update Personal Information</button>
                    </div>

                </form>

                <!--skills section-->
                <div class="list_category mt-7.5 rounded-lg bg-white">
                    <?php
                    $count_skills = $db_handle->numRows("SELECT * FROM `seller_core_skills` WHERE user_id={$_SESSION['seller_id']}");
                    if($count_skills <= 2){
                        ?>
                    <h5 class="heading5 mt-5">Add Skills</h5>
                    <div class="grid sm:grid-cols-4 gap-3">
                        <form method="post" action="Insert" enctype="multipart/form-data">
                        <!-- First set of core skills and sub-skills -->
                        <div class="education_level col-span-1">
                            <label>Core Skill<span class="text-red">*</span></label>
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
                        <div class="flex items-center col-span-full gap-5 mt-5">
                            <button class="button-main" type="submit" name="add_skill">Add Skills</button>
                        </div>
                        </form>
                    </div>
                        <?php
                        }
                        ?>
                    <form>
                        <h5 class="heading5 mt-5">Delete Skills</h5>
                        <div class="grid grid-cols-1 gap-3">
                            <!-- First set of core skills and sub-skills -->
                            <div class="education_level col-span-1">
                                <?php
                                $fetch_core_skills = $db_handle->runQuery("select * from seller_core_skills,skills where user_id={$_SESSION['seller_id']} and seller_core_skills.core_skill = skills.skill_id");
                                $fetch_core_skills_no = $db_handle->numRows("select * from seller_core_skills,skills where user_id={$_SESSION['seller_id']} and seller_core_skills.core_skill = skills.skill_id");
                                for($i=0; $i<$fetch_core_skills_no; $i++){
                                    ?>
                                    <br/>
                                    <label><?php echo $fetch_core_skills[$i]['core_skill'];?> <a href="Update?dlt_id=<?php echo $fetch_core_skills[$i]['s_core_skill_id'];?>" ><i class="ph ph-trash text-2xl"></i></a> <br/></label>
                                    <?php
                                    $fetch_sub_skills = $db_handle->runQuery("SELECT * FROM `seller_sub_skills` WHERE core_skill_id = {$fetch_core_skills[$i]['skill_id']} and user_id = {$_SESSION['seller_id']}");
                                    $fetch_sub_skills_no = $db_handle->numRows("SELECT * FROM `seller_sub_skills` WHERE core_skill_id = {$fetch_core_skills[$i]['skill_id']} and user_id = {$_SESSION['seller_id']}");
                                    for($j=0; $j<$fetch_sub_skills_no; $j++){
                                        ?>
                                        <p><?php echo $fetch_sub_skills[$j]['sub_skill'];?> <a href="Update?dlt_subskill_id=<?php echo $fetch_sub_skills[$j]['seller_s_skill_id'];?>" ><i class="ph ph-trash text-2xl"></i></a></p>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                    </form>
                </div>

                <!-- global education section -->
                <form action="Update" method="post">
                    <div id="educationContainer">
                        <h5 class="heading5 mt-5">Global Education</h5>
                        <?php
                        $fetch_globalEducation = $db_handle->runQuery("SELECT * FROM seller_global_education WHERE user_id='$seller'");
                        $fetch_row = $db_handle->numRows("SELECT * FROM seller_global_education WHERE user_id='$seller'");
                        for($i = 0; $i < $fetch_row; $i++){
                            $row = $fetch_globalEducation[$i]; // Fetch each row from the result
                            ?>
                            <div class="educationSet grid sm:grid-cols-3 gap-3 mt-5">
                                <input type="hidden" value="<?php echo $row['seller_global_education_id'];?>" name="global_education_id[]"/>
                                <!-- Level of Education -->
                                <div class="education_level">
                                    <label>Level of Education <span class="text-red">*</span></label>
                                    <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="global_level_of_education[]" required>
                                        <option value="" <?php echo ($row['global_level_of_education'] == '') ? 'selected' : ''; ?>>Select Level of Education</option>
                                        <option value="Less than high school" <?php echo ($row['global_level_of_education'] == 'Less than high school') ? 'selected' : ''; ?>>Less than high school</option>
                                        <option value="High school graduation" <?php echo ($row['global_level_of_education'] == 'High school graduation') ? 'selected' : ''; ?>>High school graduation</option>
                                        <option value="One year program" <?php echo ($row['global_level_of_education'] == 'One year program') ? 'selected' : ''; ?>>One year program</option>
                                        <option value="Two year program" <?php echo ($row['global_level_of_education'] == 'Two year program') ? 'selected' : ''; ?>>Two year program</option>
                                        <option value="Bachelors Degree" <?php echo ($row['global_level_of_education'] == 'Bachelors Degree') ? 'selected' : ''; ?>>Bachelors Degree</option>
                                        <option value="Masters Degree" <?php echo ($row['global_level_of_education'] == 'Masters Degree') ? 'selected' : ''; ?>>Masters Degree</option>
                                        <option value="Doctoral Level" <?php echo ($row['global_level_of_education'] == 'Doctoral Level') ? 'selected' : ''; ?>>Doctoral Level</option>
                                    </select>
                                </div>

                                <!-- Field of Study -->
                                <div class="education_level">
                                    <label>Field of Study <span class="text-red">*</span></label>
                                    <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="global_field_of_study[]" required>
                                        <option value="" <?php echo ($row['global_field_of_study'] == '') ? 'selected' : ''; ?>>Select Field of Study</option>
                                        <option value="Computer Science" <?php echo ($row['global_field_of_study'] == 'Computer Science') ? 'selected' : ''; ?>>Computer Science</option>
                                        <option value="Engineering" <?php echo ($row['global_field_of_study'] == 'Engineering') ? 'selected' : ''; ?>>Engineering</option>
                                        <option value="Business" <?php echo ($row['global_field_of_study'] == 'Business') ? 'selected' : ''; ?>>Business</option>
                                        <!-- Add more options as required -->
                                    </select>
                                </div>

                                <!-- GPA -->
                                <div class="jobLocation">
                                    <label for="jobLocation">GPA</label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="10" name="global_gpa[]" value="<?php echo htmlspecialchars($row['global_gpa']); ?>" required />
                                </div>

                                <!-- College/University Name -->
                                <div class="jobLocation">
                                    <label for="jobLocation">College/University Name</label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="College/University Name" name="global_university[]" value="<?php echo htmlspecialchars($row['global_university']); ?>" required />
                                </div>

                                <!-- Credential Accreditation -->
                                <div class="education_level">
                                    <label>Credential Accreditation <span class="text-red">*</span></label>
                                    <select class="w-full h-12 px-4 mt-2 border-line rounded-lg accreditation" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="accreditation[]" required>
                                        <option value="" <?php echo ($row['global_accreditation'] == '') ? 'selected' : ''; ?>>Select Credential Accreditation</option>
                                        <option value="N/A" <?php echo ($row['global_accreditation'] == 'N/A') ? 'selected' : ''; ?>>N/A</option>
                                        <option value="WES" <?php echo ($row['global_accreditation'] == 'WES') ? 'selected' : ''; ?>>WES</option>
                                        <option value="Alberta" <?php echo ($row['global_accreditation'] == 'Alberta') ? 'selected' : ''; ?>>Alberta</option>
                                    </select>
                                </div>

                                <!-- Certificate number input (initially hidden) -->
                                <div class="jobLocation certificateDiv">
                                    <label for="certificate_number">Certificate No (If applicable)</label>
                                    <input class="w-full h-12 px-4 mt-2 border-line rounded-lg certificate_number" type="text" placeholder="certificate number" name="certificate_number[]" value="<?php echo htmlspecialchars($row['global_certificate_no']); ?>" />
                                </div>
                            </div>
                            <hr class="mt-10 mb-10"/>
                            <?php
                        }
                        ?>
                    </div>

                    <!-- Button to add more education sets -->
                    <div class="flex items-center col-span-full gap-5 mt-5">
                        <button class="button-main" type="submit" name="update_global_info">Update Global Education</button>
                    </div>
                </form>


                <!--canadian education section starts-->
                <?php
                $fetch_canadianEducation = $db_handle->runQuery("SELECT * FROM seller_canadian_education WHERE user_id='$seller'");
                $fetch_row = $db_handle->numRows("SELECT * FROM seller_canadian_education WHERE user_id='$seller'");
                if($fetch_row > 0){
                    ?>
                    <form action="Update" method="post">
                        <div id="canadianEducationSection">
                            <!-- Initial Education Section -->
                            <div class="educationSection">
                                <h5 class="heading5 mt-5">Canadian Education</h5>
                                <?php
                                for($i = 0; $i < $fetch_row; $i++){
                                    $row = $fetch_canadianEducation[$i]; // Fetch each row from the result
                                    ?>
                                    <div class="educationFields grid sm:grid-cols-3 gap-3">
                                        <input type="hidden" value="<?php echo $row['s_can_edu_id']?>" name="canadian_edu_id[]"/>
                                        <!-- Level of Education -->
                                        <div class="education_level">
                                            <label>Level of Education</label>
                                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" name="canadian_level_of_education[]" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));">
                                                <option value="" <?php echo ($row['can_level_of_education'] == '') ? 'selected' : ''; ?>>Select Level of Education</option>
                                                <option value="Less than high school" <?php echo ($row['can_level_of_education'] == 'Less than high school') ? 'selected' : ''; ?>>Less than high school</option>
                                                <option value="High school graduation" <?php echo ($row['can_level_of_education'] == 'High school graduation') ? 'selected' : ''; ?>>High school graduation</option>
                                                <option value="One year program" <?php echo ($row['can_level_of_education'] == 'One year program') ? 'selected' : ''; ?>>One year program</option>
                                                <option value="Two year program" <?php echo ($row['can_level_of_education'] == 'Two year program') ? 'selected' : ''; ?>>Two year program</option>
                                                <option value="Bachelors Degree" <?php echo ($row['can_level_of_education'] == 'Bachelors Degree') ? 'selected' : ''; ?>>Bachelors Degree</option>
                                                <option value="Masters Degree" <?php echo ($row['can_level_of_education'] == 'Masters Degree') ? 'selected' : ''; ?>>Masters Degree</option>
                                                <option value="Doctoral Level" <?php echo ($row['can_level_of_education'] == 'Doctoral Level') ? 'selected' : ''; ?>>Doctoral Level</option>
                                            </select>
                                        </div>

                                        <!-- Field of Study -->
                                        <div class="education_level">
                                            <label>Field of Study</label>
                                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" name="canadian_field_of_study[]" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));">
                                                <option value="" <?php echo ($row['can_field_of_study'] == '') ? 'selected' : ''; ?>>Select Field of Study</option>
                                                <?php
                                                $fetch_field_study = $db_handle->runQuery("SELECT * FROM field_of_study_canadian");
                                                foreach ($fetch_field_study as $field_row) {
                                                    ?>
                                                    <option value="<?php echo $field_row['field_study_can_id ']; ?>" <?php echo ($row['can_field_of_study'] == $field_row['field_study_can_id ']) ? 'selected' : ''; ?>>
                                                        <?php echo $field_row['study_field']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!-- College/University -->
                                        <div class="education_level">
                                            <label>College/University</label>
                                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" name="college[]" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));">
                                                <option value="" <?php echo ($row['can_college'] == '') ? 'selected' : ''; ?>>Select College/University</option>
                                                <?php
                                                $fetch_university = $db_handle->runQuery("SELECT * FROM universities");
                                                foreach ($fetch_university as $university_row) {
                                                    ?>
                                                    <option value="<?php echo $university_row['university_id']; ?>" <?php echo ($row['can_college'] == $university_row['university_id']) ? 'selected' : ''; ?>>
                                                        <?php echo $university_row['university_name']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!-- Location -->
                                        <div class="education_level">
                                            <label>Location</label>
                                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="canadian_study_location[]">
                                                <option value="" <?php echo ($row['can_location'] == '') ? 'selected' : ''; ?>>Select City</option>
                                                <?php
                                                $fetch_city = $db_handle->runQuery("SELECT * FROM canadian_city");
                                                foreach ($fetch_city as $city_row) {
                                                    ?>
                                                    <option value="<?php echo $city_row['canadian_city_id']; ?>" <?php echo ($row['can_location'] == $city_row['canadian_city_id']) ? 'selected' : ''; ?>>
                                                        <?php echo $city_row['canadian_city_name']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!-- GPA -->
                                        <div class="jobLocation">
                                            <label for="jobLocation">GPA</label>
                                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" placeholder="10" name="canadian_gpa[]" value="<?php echo htmlspecialchars($row['can_gpa']); ?>"/>
                                        </div>

                                        <!-- Credential Accreditation -->
                                        <div class="education_level">
                                            <label>Credential Accreditation <span class="text-red">*</span></label>
                                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" name="canadian_accreditation[]" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" required>
                                                <option value="" <?php echo ($row['canadian_accreditation'] == '') ? 'selected' : ''; ?>>Select Credential Accreditation</option>
                                                <option value="N/A" <?php echo ($row['canadian_accreditation'] == 'N/A') ? 'selected' : ''; ?>>N/A</option>
                                                <option value="WES" <?php echo ($row['canadian_accreditation'] == 'WES') ? 'selected' : ''; ?>>WES</option>
                                                <option value="Alberta" <?php echo ($row['canadian_accreditation'] == 'Alberta') ? 'selected' : ''; ?>>Alberta</option>
                                            </select>
                                        </div>

                                        <!-- Certificate number input (initially hidden) -->
                                        <div class="jobLocation certificateDivCanadian">
                                            <label for="certificate_number">Certificate No (If applicable)</label>
                                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" placeholder="certificate number" name="canadian_certificate_number[]" value="<?php echo htmlspecialchars($row['canadian_certificate_number']); ?>" />
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="flex items-center col-span-full gap-5 mt-5">
                            <button class="button-main" type="submit" name="update_canadian_info">Update Canadian Education</button>
                        </div>
                    </form>
                    <?php
                }
                ?>


                <!--experience section-->
                <form action="Update" method="POST">
                    <div id="experience-container">
                        <div class="experience-section">
                            <?php
                            $fetch_experienceData = $db_handle->runQuery("SELECT * FROM seller_experience_data WHERE user_id='$seller'");
                            $fetch_row = $db_handle->numRows("SELECT * FROM seller_experience_data WHERE user_id='$seller'");
                            for($i = 0; $i < $fetch_row; $i++){
                                $row = $fetch_experienceData[$i];
                                ?>
                                <h5 class="heading5 mt-5">Work Experience</h5>
                                <?php
                                if($row['job_experience_status'] == 0){
                                    ?>
                                    <input type="hidden" value="<?php echo $row['seller_experience_id'];?>" name="seller_exp_id[]"/>
                                    <div class="grid sm:grid-cols-3 gap-3">
                                    <div class="education_level">
                                        <label>Industry</label>
                                        <select id="industry" class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="industry[]" required>
                                            <option selected>Select Industry</option>
                                            <?php
                                            $fetch_industry = $db_handle->runQuery("SELECT * FROM industries ORDER BY industry ASC");
                                            foreach ($fetch_industry as $row1) {
                                                ?>
                                                <option value="<?php echo $row1['industry_id']?>" <?php if ($row['industry'] == $row1['industry_id']) echo "selected"?>><?php echo $row1['industry']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="education_level">
                                        <label>Sub Industry</label>
                                        <select id="subindustry" class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="sub_industry[]" required>
                                            <option value="<?php echo $row['sub_industry'];?>" selected><?php echo $row['sub_industry'];?></option>
                                        </select>
                                    </div>
                                    <div class="education_level">
                                        <label>Country</label>
                                        <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="countries[]">
                                            <option disabled selected>Please Select Country</option>
                                            <?php
                                            $fetch_country = $db_handle->runQuery("SELECT country_name FROM countries ORDER BY country_name ASC");
                                            foreach ($fetch_country as $country) {
                                                ?>
                                                <option value="<?php echo $country['country_name']?>" <?php if($country['country_name'] == $row['countries']) echo "selected";?>><?php echo $country['country_name']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="jobLocation">
                                        <label>Job Title</label>
                                        <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" placeholder="Software Engineer" name="job_designation[]" value="<?php echo htmlspecialchars($row['job_designation']); ?>" required />
                                    </div>
                                    <div class="jobLocation">
                                        <label>Company Name</label>
                                        <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" placeholder="Company Name" name="company_name[]" value="<?php echo htmlspecialchars($row['company_name']); ?>" required />
                                    </div>

                                    <div class="jobLocation">
                                        <label>Company Website Link</label>
                                        <input class="w-full h-12 px-4 mt-2 border-line rounded-lg company-website" type="text" placeholder="www.abc.com or https://abc.com" name="company_website[]" value="<?php echo htmlspecialchars($row['company_website']); ?>" required />
                                        <small class="website-error-message text-red-500 hidden">Invalid website format. Please enter a valid URL (e.g., https://example.com or www.example.com).</small>
                                    </div>

                                    <div class="jobLocation">
                                        <label>Start Date</label>
                                        <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="date" name="start_date[]" value="<?php echo htmlspecialchars($row['start_date']); ?>" required />
                                    </div>
                                    <div class="jobLocation">
                                        <label>End Date</label>
                                        <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="date" name="end_date[]" value="<?php echo htmlspecialchars($row['end_date']); ?>" required />
                                    </div>
                                    <div class="jobLocation">
                                        <label>Working till now?</label>
                                        <input type="checkbox" class="px-4 mt-2 border-line rounded-lg" name="till_date[]" id="tillDateCheckbox" value="1"> Yes
                                    </div>
                                    <?php
                                } if($row['reference_status'] == 0){
                                    if($row['accomplishment_one_status'] == 0){
                                        ?>
                                        <div class="jobLocation">
                                            <label>Accomplishments</label>
                                            <textarea class="w-full h-12 px-4 mt-2 border-line rounded-lg" required name="accomplishment[]"><?php echo htmlspecialchars($row['accomplishment']); ?></textarea>
                                        </div>
                                        <?php
                                    } if($row['accomplishment_two_status'] == 0){
                                        ?>
                                        <div class="jobLocation">
                                            <label>Accomplishments</label>
                                            <textarea class="w-full h-12 px-4 mt-2 border-line rounded-lg" required name="accomplishment2[]"><?php echo htmlspecialchars($row['accomplishment_two']); ?></textarea>
                                        </div>
                                        <?php
                                    } if($row['accomplishment_two_status'] == 0){
                                        ?>
                                        <div class="jobLocation">
                                            <label>Accomplishments</label>
                                            <textarea class="w-full h-12 px-4 mt-2 border-line rounded-lg" required name="accomplishment3[]"><?php echo htmlspecialchars($row['accomplishment_three']); ?></textarea>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                </div>

                                <?php
                                if($row['job_experience_status'] == 0){
                                    ?>
                                    <hr class="mt-5 mb-5">
                                    <h2 style="font-size: 30px; font-weight: bold" class="mt-5 mb-5">Work Experience Verification:</h2>
                                    <div class="grid sm:grid-cols-3 gap-3">
                                        <div class="jobLocation">
                                            <label>Reference Type</label>
                                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="reporting_manager_job[]">
                                                <option>Please Select Reference Type</option>
                                                <option value="HR" <?php if ($row['reporting_manager_job'] == 'HR') echo "selected";?>>HR</option>
                                                <option value="Reporting Manager" <?php if ($row['reporting_manager_job'] == 'Reporting Manager') echo "selected";?>>Reporting Manager</option>
                                            </select>
                                        </div>
                                        <div class="jobLocation">
                                            <label>Designation</label>
                                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" value="<?php echo $row['designation_job']?>" name="designation_job[]" />
                                        </div>
                                        <div class="jobLocation">
                                            <label>Name</label>
                                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" value="<?php echo $row['name_job']?>" name="name_job[]" />
                                        </div>
                                        <div class="jobLocation">
                                            <label>Email</label>
                                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg company-email" type="email" value="<?php echo $row['email_job']?>" name="email_job[]" />
                                            <small class="error-message text-red-500 hidden">Email domain must match the company website.</small>
                                        </div>
                                        <button class="remove-experience hidden w-1/3 h-10 mt-4 bg-red-500 text-white rounded-lg">Remove</button>
                                    </div>
                                    <?php
                                } if($row['reference_status'] == 0){
                                    ?>

                                    <hr class="mt-5 mb-5">
                                    <h2 style="font-size: 30px; font-weight: bold" class="mt-5 mb-5">Reference:</h2>
                                    <div class="grid sm:grid-cols-3 gap-3">
                                        <div class="jobLocation">
                                            <label>Reference Type</label>
                                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="reporting_manager[]">
                                                <option>Please Select Reference Type</option>
                                                <option value="HR" <?php if($row['reporting_manager'] == 'HR') echo "selected";?>>HR</option>
                                                <option value="Reporting Manager" <?php if($row['reporting_manager'] == 'Reporting Manager') echo "selected";?>>Reporting Manager</option>
                                            </select>
                                        </div>
                                        <div class="jobLocation">
                                            <label>Designation</label>
                                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" value="<?php echo $row['designation'];?>" name="designation[]" />
                                        </div>
                                        <div class="jobLocation">
                                            <label>Name</label>
                                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" type="text" value="<?php echo $row['name'];?>" name="name[]" />
                                        </div>
                                        <div class="jobLocation">
                                            <label>Email</label>
                                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg company-email" type="email" value="<?php echo $row['email'];?>" name="email[]" />
                                            <small class="error-message text-red-500 hidden">Email domain must match the company website.</small>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="flex items-center col-span-full gap-5 mt-5">
                        <button class="button-main" type="submit" name="update_experience_info">Update Experience Info</button>
                    </div>
                </form>


                <!--career goal section-->
                <h5 class="heading5 mt-5">Career Goals</h5>
                <form action="Update" method="POST">
                    <?php
                    $fetch_careerData = $db_handle->runQuery("SELECT * FROM seller_career WHERE seller_id='$seller'");
                    $fetch_row = $db_handle->numRows("SELECT * FROM seller_career WHERE seller_id='$seller'");
                    for($i = 0; $i < $fetch_row; $i++){
                        $row = $fetch_careerData[$i]; // Fetch each row from the result
                        ?>
                        <div class="grid sm:grid-cols-3 gap-3">
                            <input type="hidden" value="<?php echo $row['seller_career_id']?>" name="seller_career_id"/>
                            <div class="jobLocation">
                                <label for="jobLocation">Role</label>
                                <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="Enter career role" name="career_role" value="<?php echo htmlspecialchars($row['career_role']); ?>" required />
                            </div>

                            <div class="jobLocation">
                                <label for="jobLocation">Industry</label>
                                <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="Enter career industry" name="career_industry" value="<?php echo htmlspecialchars($row['career_industry']); ?>" required />
                            </div>

                            <div class="jobLocation">
                                <label for="jobLocation">NOC Number</label>
                                <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity))" name="noc_number" required>
                                    <option selected>Please select NOC</option>
                                    <?php
                                    $fetch_noc = $db_handle->runQuery("SELECT * FROM noc");
                                    foreach ($fetch_noc as $noc) {
                                        // Pre-select the NOC number if it matches the value in the database
                                        $selected = ($noc['noc_id'] == $row['noc_number']) ? 'selected' : '';
                                        echo "<option value='{$noc['noc_id']}' {$selected}>{$noc['name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <!--reset and submit section starts here-->
                    <div class="flex items-center col-span-full gap-5 mt-5">
                        <button class="button-main" type="submit" name="update_career" id="publishButton">Update Career Goal</button>
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

<!--for hiding and displaying the certificate in global and canadian study fields-->
<script>
    $(document).ready(function() {
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
        $('#canadianEducationSection .toggle_btn').on('click', function() {
            const educationFields = $(this).closest('.educationSection').find('.educationFields');
            educationFields.find('select, input').prop('disabled', function(i, val) {
                return !val;
            });
        });

        // Add Another Education button functionality
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
        $('#canadianEducationSection select[name="canadian_accreditation[]"]').on('change', function() {
            toggleCertificateField(this);
        });

        // Initialize certificate field visibility on page load
        $('#canadianEducationSection select[name="canadian_accreditation[]"]').each(function() {
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

    function isValidWebsite(website) {
        const regex = /^(https:\/\/|www\.)[a-zA-Z0-9-]+\.[a-zA-Z]{2,}(\/\S*)?$/;
        return regex.test(website);
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
    }

    $(document).ready(function () {
        // Apply validation to all existing experience sections on page load
        $('.experience-section').each(function () {
            applyValidation($(this));
        });

        // If you're dynamically adding new sections, reapply validation to the new fields
        $(document).on('click', '#add-experience', function () {
            const newSection = $('.experience-section').first().clone();
            newSection.find('input').val(''); // Clear input values in the new section
            newSection.find('.error-message').addClass('hidden'); // Hide error messages in the new section
            $('#experience-container').append(newSection);
            applyValidation(newSection); // Apply validation to the new section
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        // Apply Select2 to the select element
        $('#coreSkills1').select2();
    });
</script>
</body>

</html>
