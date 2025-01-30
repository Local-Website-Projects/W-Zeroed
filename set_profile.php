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
            <h4 class="heading4 max-lg:mt-3">Set Up Profile</h4>
            <div class="list_category p-6 mt-7.5 rounded-lg bg-white">
                <h5 class="heading5" style="margin-top: 0 !important;">Personal Information</h5>
                <form class="form">
                    <div class="grid sm:grid-cols-3 gap-3">
                        <div class="firstName">
                            <label for="firstName">Firstname <span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="firstName" type="text" placeholder="Enter first name" autocomplete="off" required />
                        </div>
                        <div class="lastName">
                            <label for="lastName">Lastname <span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="lastName" type="text" placeholder="Enter last name" autocomplete="off" required />
                        </div>
                        <div class="profile">
                            <label for="profile">Profile Image<span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="profile" type="file" required />
                        </div>
                        <div class="gender">
                            <label for="gender">Gender <span class="text-red">* </span>:</label><br/>
                            <input class="px-4 mt-2 border-line rounded-lg" id="gender" type="radio" name="gender" value="male" required />
                            <label for="gender" style="padding-right: 20px;">Male</label>
                            <input class="px-4 mt-2 border-line rounded-lg" id="gender" type="radio" name="gender" value="female" required />
                            <label for="gender" style="padding-right: 20px;">Female</label>
                            <input class="px-4 mt-2 border-line rounded-lg" id="gender" type="radio" name="gender" value="Other" required />
                            <label for="gender" style="padding-right: 20px;">Other</label>
                        </div>
                        <div class="nationality">
                            <label>Nationality <span class="text-red">*</span></label>
                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity))" id="mySelect2">
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
                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg country_select" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity))" onchange="loadStates()">
                                <option selected>Please select your country</option>
                            </select>
                        </div>
                        <div class="state">
                            <label>Current State <span class="text-red">*</span></label>
                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg state_select" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity))" onchange="loadCities()"">
                                <option selected>Please select state</option>
                            </select>
                        </div>
                        <div class="city">
                            <label>Current City <span class="text-red">*</span></label>
                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg city_select" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity))">
                                <option selected>Please select city</option>
                            </select>
                        </div>
                        <div class="contactno">
                            <label for="contactno">Contact No <span class="text-red">*</span></label>
                            <div class="flex space-x-2">
                                <select class="h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity)); width: 25%" required>
                                    <option selected>Code</option>
                                    <option value="AF" <?php echo isset($country_code) && $country_code == 'AF' ? 'selected' : ''; ?>>Afghanistan (+93)</option>
                                    <option value="AL" <?php echo isset($country_code) && $country_code == 'AL' ? 'selected' : ''; ?>>Albania (+355)</option>
                                    <option value="DZ" <?php echo isset($country_code) && $country_code == 'DZ' ? 'selected' : ''; ?>>Algeria (+213)</option>
                                    <option value="AD" <?php echo isset($country_code) && $country_code == 'AD' ? 'selected' : ''; ?>>Andorra (+376)</option>
                                    <option value="AO" <?php echo isset($country_code) && $country_code == 'AO' ? 'selected' : ''; ?>>Angola (+244)</option>
                                    <option value="AG" <?php echo isset($country_code) && $country_code == 'AG' ? 'selected' : ''; ?>>Antigua and Barbuda (+1-268)</option>
                                    <option value="AR" <?php echo isset($country_code) && $country_code == 'AR' ? 'selected' : ''; ?>>Argentina (+54)</option>
                                    <option value="AM" <?php echo isset($country_code) && $country_code == 'AM' ? 'selected' : ''; ?>>Armenia (+374)</option>
                                    <option value="AU" <?php echo isset($country_code) && $country_code == 'AU' ? 'selected' : ''; ?>>Australia (+61)</option>
                                    <option value="AT" <?php echo isset($country_code) && $country_code == 'AT' ? 'selected' : ''; ?>>Austria (+43)</option>
                                    <option value="AZ" <?php echo isset($country_code) && $country_code == 'AZ' ? 'selected' : ''; ?>>Azerbaijan (+994)</option>
                                    <option value="BS" <?php echo isset($country_code) && $country_code == 'BS' ? 'selected' : ''; ?>>The Bahamas (+1-242)</option>
                                    <option value="BH" <?php echo isset($country_code) && $country_code == 'BH' ? 'selected' : ''; ?>>Bahrain (+973)</option>
                                    <option value="BD" <?php echo isset($country_code) && $country_code == 'BD' ? 'selected' : ''; ?>>Bangladesh (+880)</option>
                                    <option value="BB" <?php echo isset($country_code) && $country_code == 'BB' ? 'selected' : ''; ?>>Barbados (+1-246)</option>
                                    <option value="BY" <?php echo isset($country_code) && $country_code == 'BY' ? 'selected' : ''; ?>>Belarus (+375)</option>
                                    <option value="BE" <?php echo isset($country_code) && $country_code == 'BE' ? 'selected' : ''; ?>>Belgium (+32)</option>
                                    <option value="BZ" <?php echo isset($country_code) && $country_code == 'BZ' ? 'selected' : ''; ?>>Belize (+501)</option>
                                    <option value="BJ" <?php echo isset($country_code) && $country_code == 'BJ' ? 'selected' : ''; ?>>Benin (+229)</option>
                                    <option value="BT" <?php echo isset($country_code) && $country_code == 'BT' ? 'selected' : ''; ?>>Bhutan (+975)</option>
                                    <option value="BO" <?php echo isset($country_code) && $country_code == 'BO' ? 'selected' : ''; ?>>Bolivia (+591)</option>
                                    <option value="BA" <?php echo isset($country_code) && $country_code == 'BA' ? 'selected' : ''; ?>>Bosnia and Herzegovina (+387)</option>
                                    <option value="BW" <?php echo isset($country_code) && $country_code == 'BW' ? 'selected' : ''; ?>>Botswana (+267)</option>
                                    <option value="BR" <?php echo isset($country_code) && $country_code == 'BR' ? 'selected' : ''; ?>>Brazil (+55)</option>
                                    <option value="BN" <?php echo isset($country_code) && $country_code == 'BN' ? 'selected' : ''; ?>>Brunei (+673)</option>
                                    <option value="BG" <?php echo isset($country_code) && $country_code == 'BG' ? 'selected' : ''; ?>>Bulgaria (+359)</option>
                                    <option value="BF" <?php echo isset($country_code) && $country_code == 'BF' ? 'selected' : ''; ?>>Burkina Faso (+226)</option>
                                    <option value="BI" <?php echo isset($country_code) && $country_code == 'BI' ? 'selected' : ''; ?>>Burundi (+257)</option>
                                    <option value="CV" <?php echo isset($country_code) && $country_code == 'CV' ? 'selected' : ''; ?>>Cabo Verde (+238)</option>
                                    <option value="KH" <?php echo isset($country_code) && $country_code == 'KH' ? 'selected' : ''; ?>>Cambodia (+855)</option>
                                    <option value="CM" <?php echo isset($country_code) && $country_code == 'CM' ? 'selected' : ''; ?>>Cameroon (+237)</option>
                                    <option value="CA" <?php echo isset($country_code) && $country_code == 'CA' ? 'selected' : ''; ?>>Canada (+1)</option>
                                    <option value="CF" <?php echo isset($country_code) && $country_code == 'CF' ? 'selected' : ''; ?>>Central African Republic (+236)</option>
                                    <option value="TD" <?php echo isset($country_code) && $country_code == 'TD' ? 'selected' : ''; ?>>Chad (+235)</option>
                                    <option value="CL" <?php echo isset($country_code) && $country_code == 'CL' ? 'selected' : ''; ?>>Chile (+56)</option>
                                    <option value="CN" <?php echo isset($country_code) && $country_code == 'CN' ? 'selected' : ''; ?>>China (+86)</option>
                                    <option value="CO" <?php echo isset($country_code) && $country_code == 'CO' ? 'selected' : ''; ?>>Colombia (+57)</option>
                                    <option value="KM" <?php echo isset($country_code) && $country_code == 'KM' ? 'selected' : ''; ?>>Comoros (+269)</option>
                                    <option value="CD" <?php echo isset($country_code) && $country_code == 'CD' ? 'selected' : ''; ?>>Congo, Democratic Republic of the (+243)</option>
                                    <option value="CG" <?php echo isset($country_code) && $country_code == 'CG' ? 'selected' : ''; ?>>Congo, Republic of the (+242)</option>
                                    <option value="CR" <?php echo isset($country_code) && $country_code == 'CR' ? 'selected' : ''; ?>>Costa Rica (+506)</option>
                                    <option value="CI" <?php echo isset($country_code) && $country_code == 'CI' ? 'selected' : ''; ?>>Côte d’Ivoire (+225)</option>
                                    <option value="HR" <?php echo isset($country_code) && $country_code == 'HR' ? 'selected' : ''; ?>>Croatia (+385)</option>
                                    <option value="CU" <?php echo isset($country_code) && $country_code == 'CU' ? 'selected' : ''; ?>>Cuba (+53)</option>
                                    <option value="CY" <?php echo isset($country_code) && $country_code == 'CY' ? 'selected' : ''; ?>>Cyprus (+357)</option>
                                    <option value="CZ" <?php echo isset($country_code) && $country_code == 'CZ' ? 'selected' : ''; ?>>Czech Republic (+420)</option>
                                    <option value="DK" <?php echo isset($country_code) && $country_code == 'DK' ? 'selected' : ''; ?>>Denmark (+45)</option>
                                    <option value="DJ" <?php echo isset($country_code) && $country_code == 'DJ' ? 'selected' : ''; ?>>Djibouti (+253)</option>
                                    <option value="DM" <?php echo isset($country_code) && $country_code == 'DM' ? 'selected' : ''; ?>>Dominica (+1-767)</option>
                                    <option value="DO" <?php echo isset($country_code) && $country_code == 'DO' ? 'selected' : ''; ?>>Dominican Republic (+1-809)</option>
                                    <option value="TL" <?php echo isset($country_code) && $country_code == 'TL' ? 'selected' : ''; ?>>East Timor (Timor-Leste) (+670)</option>
                                    <option value="EC" <?php echo isset($country_code) && $country_code == 'EC' ? 'selected' : ''; ?>>Ecuador (+593)</option>
                                    <option value="EG" <?php echo isset($country_code) && $country_code == 'EG' ? 'selected' : ''; ?>>Egypt (+20)</option>
                                    <option value="SV" <?php echo isset($country_code) && $country_code == 'SV' ? 'selected' : ''; ?>>El Salvador (+503)</option>
                                    <option value="GQ" <?php echo isset($country_code) && $country_code == 'GQ' ? 'selected' : ''; ?>>Equatorial Guinea (+240)</option>
                                    <option value="ER" <?php echo isset($country_code) && $country_code == 'ER' ? 'selected' : ''; ?>>Eritrea (+291)</option>
                                    <option value="EE" <?php echo isset($country_code) && $country_code == 'EE' ? 'selected' : ''; ?>>Estonia (+372)</option>
                                    <option value="SZ" <?php echo isset($country_code) && $country_code == 'SZ' ? 'selected' : ''; ?>>Eswatini (+268)</option>
                                    <option value="ET" <?php echo isset($country_code) && $country_code == 'ET' ? 'selected' : ''; ?>>Ethiopia (+251)</option>
                                    <option value="FJ" <?php echo isset($country_code) && $country_code == 'FJ' ? 'selected' : ''; ?>>Fiji (+679)</option>
                                    <option value="FI" <?php echo isset($country_code) && $country_code == 'FI' ? 'selected' : ''; ?>>Finland (+358)</option>
                                    <option value="FR" <?php echo isset($country_code) && $country_code == 'FR' ? 'selected' : ''; ?>>France (+33)</option>
                                    <option value="GA" <?php echo isset($country_code) && $country_code == 'GA' ? 'selected' : ''; ?>>Gabon (+241)</option>
                                    <option value="GM" <?php echo isset($country_code) && $country_code == 'GM' ? 'selected' : ''; ?>>The Gambia (+220)</option>
                                    <option value="GE" <?php echo isset($country_code) && $country_code == 'GE' ? 'selected' : ''; ?>>Georgia (+995)</option>
                                    <option value="DE" <?php echo isset($country_code) && $country_code == 'DE' ? 'selected' : ''; ?>>Germany (+49)</option>
                                    <option value="GH" <?php echo isset($country_code) && $country_code == 'GH' ? 'selected' : ''; ?>>Ghana (+233)</option>
                                    <option value="GR" <?php echo isset($country_code) && $country_code == 'GR' ? 'selected' : ''; ?>>Greece (+30)</option>
                                    <option value="GD" <?php echo isset($country_code) && $country_code == 'GD' ? 'selected' : ''; ?>>Grenada (+1-473)</option>
                                    <option value="GT" <?php echo isset($country_code) && $country_code == 'GT' ? 'selected' : ''; ?>>Guatemala (+502)</option>
                                    <option value="GN" <?php echo isset($country_code) && $country_code == 'GN' ? 'selected' : ''; ?>>Guinea (+224)</option>
                                    <option value="GW" <?php echo isset($country_code) && $country_code == 'GW' ? 'selected' : ''; ?>>Guinea-Bissau (+245)</option>
                                    <option value="GY" <?php echo isset($country_code) && $country_code == 'GY' ? 'selected' : ''; ?>>Guyana (+592)</option>
                                    <option value="HT" <?php echo isset($country_code) && $country_code == 'HT' ? 'selected' : ''; ?>>Haiti (+509)</option>
                                    <option value="HN" <?php echo isset($country_code) && $country_code == 'HN' ? 'selected' : ''; ?>>Honduras (+504)</option>
                                    <option value="HU" <?php echo isset($country_code) && $country_code == 'HU' ? 'selected' : ''; ?>>Hungary (+36)</option>
                                    <option value="IS" <?php echo isset($country_code) && $country_code == 'IS' ? 'selected' : ''; ?>>Iceland (+354)</option>
                                    <option value="IN" <?php echo isset($country_code) && $country_code == 'IN' ? 'selected' : ''; ?>>India (+91)</option>
                                    <option value="ID" <?php echo isset($country_code) && $country_code == 'ID' ? 'selected' : ''; ?>>Indonesia (+62)</option>
                                    <option value="IR" <?php echo isset($country_code) && $country_code == 'IR' ? 'selected' : ''; ?>>Iran (+98)</option>
                                    <option value="IQ" <?php echo isset($country_code) && $country_code == 'IQ' ? 'selected' : ''; ?>>Iraq (+964)</option>
                                    <option value="IE" <?php echo isset($country_code) && $country_code == 'IE' ? 'selected' : ''; ?>>Ireland (+353)</option>
                                    <option value="IL" <?php echo isset($country_code) && $country_code == 'IL' ? 'selected' : ''; ?>>Israel (+972)</option>
                                    <option value="IT" <?php echo isset($country_code) && $country_code == 'IT' ? 'selected' : ''; ?>>Italy (+39)</option>
                                    <option value="JM" <?php echo isset($country_code) && $country_code == 'JM' ? 'selected' : ''; ?>>Jamaica (+1-876)</option>
                                    <option value="JP" <?php echo isset($country_code) && $country_code == 'JP' ? 'selected' : ''; ?>>Japan (+81)</option>
                                    <option value="JO" <?php echo isset($country_code) && $country_code == 'JO' ? 'selected' : ''; ?>>Jordan (+962)</option>
                                    <option value="KZ" <?php echo isset($country_code) && $country_code == 'KZ' ? 'selected' : ''; ?>>Kazakhstan (+7)</option>
                                    <option value="KE" <?php echo isset($country_code) && $country_code == 'KE' ? 'selected' : ''; ?>>Kenya (+254)</option>
                                    <option value="KI" <?php echo isset($country_code) && $country_code == 'KI' ? 'selected' : ''; ?>>Kiribati (+686)</option>
                                    <option value="KP" <?php echo isset($country_code) && $country_code == 'KP' ? 'selected' : ''; ?>>Korea, North (+850)</option>
                                    <option value="KR" <?php echo isset($country_code) && $country_code == 'KR' ? 'selected' : ''; ?>>Korea, South (+82)</option>
                                    <option value="XK" <?php echo isset($country_code) && $country_code == 'XK' ? 'selected' : ''; ?>>Kosovo (+383)</option>
                                    <option value="KW" <?php echo isset($country_code) && $country_code == 'KW' ? 'selected' : ''; ?>>Kuwait (+965)</option>
                                    <option value="KG" <?php echo isset($country_code) && $country_code == 'KG' ? 'selected' : ''; ?>>Kyrgyzstan (+996)</option>
                                    <option value="LA" <?php echo isset($country_code) && $country_code == 'LA' ? 'selected' : ''; ?>>Laos (+856)</option>
                                    <option value="LV" <?php echo isset($country_code) && $country_code == 'LV' ? 'selected' : ''; ?>>Latvia (+371)</option>
                                    <option value="LB" <?php echo isset($country_code) && $country_code == 'LB' ? 'selected' : ''; ?>>Lebanon (+961)</option>
                                    <option value="LS" <?php echo isset($country_code) && $country_code == 'LS' ? 'selected' : ''; ?>>Lesotho (+266)</option>
                                    <option value="LR" <?php echo isset($country_code) && $country_code == 'LR' ? 'selected' : ''; ?>>Liberia (+231)</option>
                                    <option value="LY" <?php echo isset($country_code) && $country_code == 'LY' ? 'selected' : ''; ?>>Libya (+218)</option>
                                    <option value="LI" <?php echo isset($country_code) && $country_code == 'LI' ? 'selected' : ''; ?>>Liechtenstein (+423)</option>
                                    <option value="LT" <?php echo isset($country_code) && $country_code == 'LT' ? 'selected' : ''; ?>>Lithuania (+370)</option>
                                    <option value="LU" <?php echo isset($country_code) && $country_code == 'LU' ? 'selected' : ''; ?>>Luxembourg (+352)</option>
                                    <option value="MG" <?php echo isset($country_code) && $country_code == 'MG' ? 'selected' : ''; ?>>Madagascar (+261)</option>
                                    <option value="MW" <?php echo isset($country_code) && $country_code == 'MW' ? 'selected' : ''; ?>>Malawi (+265)</option>
                                    <option value="MY" <?php echo isset($country_code) && $country_code == 'MY' ? 'selected' : ''; ?>>Malaysia (+60)</option>
                                    <option value="MV" <?php echo isset($country_code) && $country_code == 'MV' ? 'selected' : ''; ?>>Maldives (+960)</option>
                                    <option value="ML" <?php echo isset($country_code) && $country_code == 'ML' ? 'selected' : ''; ?>>Mali (+223)</option>
                                    <option value="MT" <?php echo isset($country_code) && $country_code == 'MT' ? 'selected' : ''; ?>>Malta (+356)</option>
                                    <option value="MH" <?php echo isset($country_code) && $country_code == 'MH' ? 'selected' : ''; ?>>Marshall Islands (+692)</option>
                                    <option value="MR" <?php echo isset($country_code) && $country_code == 'MR' ? 'selected' : ''; ?>>Mauritania (+222)</option>
                                    <option value="MU" <?php echo isset($country_code) && $country_code == 'MU' ? 'selected' : ''; ?>>Mauritius (+230)</option>
                                    <option value="MX" <?php echo isset($country_code) && $country_code == 'MX' ? 'selected' : ''; ?>>Mexico (+52)</option>
                                    <option value="FM" <?php echo isset($country_code) && $country_code == 'FM' ? 'selected' : ''; ?>>Micronesia, Federated States of (+691)</option>
                                    <option value="MD" <?php echo isset($country_code) && $country_code == 'MD' ? 'selected' : ''; ?>>Moldova (+373)</option>
                                    <option value="MC" <?php echo isset($country_code) && $country_code == 'MC' ? 'selected' : ''; ?>>Monaco (+377)</option>
                                    <option value="MN" <?php echo isset($country_code) && $country_code == 'MN' ? 'selected' : ''; ?>>Mongolia (+976)</option>
                                    <option value="ME" <?php echo isset($country_code) && $country_code == 'ME' ? 'selected' : ''; ?>>Montenegro (+382)</option>
                                    <option value="MA" <?php echo isset($country_code) && $country_code == 'MA' ? 'selected' : ''; ?>>Morocco (+212)</option>
                                    <option value="MZ" <?php echo isset($country_code) && $country_code == 'MZ' ? 'selected' : ''; ?>>Mozambique (+258)</option>
                                    <option value="MM" <?php echo isset($country_code) && $country_code == 'MM' ? 'selected' : ''; ?>>Myanmar (+95)</option>
                                    <option value="NA" <?php echo isset($country_code) && $country_code == 'NA' ? 'selected' : ''; ?>>Namibia (+264)</option>
                                    <option value="NR" <?php echo isset($country_code) && $country_code == 'NR' ? 'selected' : ''; ?>>Nauru (+674)</option>
                                    <option value="NP" <?php echo isset($country_code) && $country_code == 'NP' ? 'selected' : ''; ?>>Nepal (+977)</option>
                                    <option value="NL" <?php echo isset($country_code) && $country_code == 'NL' ? 'selected' : ''; ?>>Netherlands (+31)</option>
                                    <option value="NZ" <?php echo isset($country_code) && $country_code == 'NZ' ? 'selected' : ''; ?>>New Zealand (+64)</option>
                                    <option value="NI" <?php echo isset($country_code) && $country_code == 'NI' ? 'selected' : ''; ?>>Nicaragua (+505)</option>
                                    <option value="NE" <?php echo isset($country_code) && $country_code == 'NE' ? 'selected' : ''; ?>>Niger (+227)</option>
                                    <option value="NG" <?php echo isset($country_code) && $country_code == 'NG' ? 'selected' : ''; ?>>Nigeria (+234)</option>
                                    <option value="MK" <?php echo isset($country_code) && $country_code == 'MK' ? 'selected' : ''; ?>>North Macedonia (+389)</option>
                                    <option value="NO" <?php echo isset($country_code) && $country_code == 'NO' ? 'selected' : ''; ?>>Norway (+47)</option>
                                    <option value="OM" <?php echo isset($country_code) && $country_code == 'OM' ? 'selected' : ''; ?>>Oman (+968)</option>
                                    <option value="PK" <?php echo isset($country_code) && $country_code == 'PK' ? 'selected' : ''; ?>>Pakistan (+92)</option>
                                    <option value="PW" <?php echo isset($country_code) && $country_code == 'PW' ? 'selected' : ''; ?>>Palau (+680)</option>
                                    <option value="PA" <?php echo isset($country_code) && $country_code == 'PA' ? 'selected' : ''; ?>>Panama (+507)</option>
                                    <option value="PG" <?php echo isset($country_code) && $country_code == 'PG' ? 'selected' : ''; ?>>Papua New Guinea (+675)</option>
                                    <option value="PY" <?php echo isset($country_code) && $country_code == 'PY' ? 'selected' : ''; ?>>Paraguay (+595)</option>
                                    <option value="PE" <?php echo isset($country_code) && $country_code == 'PE' ? 'selected' : ''; ?>>Peru (+51)</option>
                                    <option value="PH" <?php echo isset($country_code) && $country_code == 'PH' ? 'selected' : ''; ?>>Philippines (+63)</option>
                                    <option value="PL" <?php echo isset($country_code) && $country_code == 'PL' ? 'selected' : ''; ?>>Poland (+48)</option>
                                    <option value="PT" <?php echo isset($country_code) && $country_code == 'PT' ? 'selected' : ''; ?>>Portugal (+351)</option>
                                    <option value="QA" <?php echo isset($country_code) && $country_code == 'QA' ? 'selected' : ''; ?>>Qatar (+974)</option>
                                    <option value="RO" <?php echo isset($country_code) && $country_code == 'RO' ? 'selected' : ''; ?>>Romania (+40)</option>
                                    <option value="RU" <?php echo isset($country_code) && $country_code == 'RU' ? 'selected' : ''; ?>>Russia (+7)</option>
                                    <option value="RW" <?php echo isset($country_code) && $country_code == 'RW' ? 'selected' : ''; ?>>Rwanda (+250)</option>
                                    <option value="KN" <?php echo isset($country_code) && $country_code == 'KN' ? 'selected' : ''; ?>>Saint Kitts and Nevis (+1 869)</option>
                                    <option value="LC" <?php echo isset($country_code) && $country_code == 'LC' ? 'selected' : ''; ?>>Saint Lucia (+1 758)</option>
                                    <option value="VC" <?php echo isset($country_code) && $country_code == 'VC' ? 'selected' : ''; ?>>Saint Vincent and the Grenadines (+1 784)</option>
                                    <option value="WS" <?php echo isset($country_code) && $country_code == 'WS' ? 'selected' : ''; ?>>Samoa (+685)</option>
                                    <option value="SM" <?php echo isset($country_code) && $country_code == 'SM' ? 'selected' : ''; ?>>San Marino (+378)</option>
                                    <option value="ST" <?php echo isset($country_code) && $country_code == 'ST' ? 'selected' : ''; ?>>Sao Tome and Principe (+239)</option>
                                    <option value="SA" <?php echo isset($country_code) && $country_code == 'SA' ? 'selected' : ''; ?>>Saudi Arabia (+966)</option>
                                    <option value="SN" <?php echo isset($country_code) && $country_code == 'SN' ? 'selected' : ''; ?>>Senegal (+221)</option>
                                    <option value="RS" <?php echo isset($country_code) && $country_code == 'RS' ? 'selected' : ''; ?>>Serbia (+381)</option>
                                    <option value="SC" <?php echo isset($country_code) && $country_code == 'SC' ? 'selected' : ''; ?>>Seychelles (+248)</option>
                                    <option value="SL" <?php echo isset($country_code) && $country_code == 'SL' ? 'selected' : ''; ?>>Sierra Leone (+232)</option>
                                    <option value="SG" <?php echo isset($country_code) && $country_code == 'SG' ? 'selected' : ''; ?>>Singapore (+65)</option>
                                    <option value="SK" <?php echo isset($country_code) && $country_code == 'SK' ? 'selected' : ''; ?>>Slovakia (+421)</option>
                                    <option value="SI" <?php echo isset($country_code) && $country_code == 'SI' ? 'selected' : ''; ?>>Slovenia (+386)</option>
                                    <option value="SB" <?php echo isset($country_code) && $country_code == 'SB' ? 'selected' : ''; ?>>Solomon Islands (+677)</option>
                                    <option value="SO" <?php echo isset($country_code) && $country_code == 'SO' ? 'selected' : ''; ?>>Somalia (+252)</option>
                                    <option value="ZA" <?php echo isset($country_code) && $country_code == 'ZA' ? 'selected' : ''; ?>>South Africa (+27)</option>
                                    <option value="ES" <?php echo isset($country_code) && $country_code == 'ES' ? 'selected' : ''; ?>>Spain (+34)</option>
                                    <option value="LK" <?php echo isset($country_code) && $country_code == 'LK' ? 'selected' : ''; ?>>Sri Lanka (+94)</option>
                                    <option value="SD" <?php echo isset($country_code) && $country_code == 'SD' ? 'selected' : ''; ?>>Sudan (+249)</option>
                                    <option value="SS" <?php echo isset($country_code) && $country_code == 'SS' ? 'selected' : ''; ?>>Sudan, South (+211)</option>
                                    <option value="SR" <?php echo isset($country_code) && $country_code == 'SR' ? 'selected' : ''; ?>>Suriname (+597)</option>
                                    <option value="SE" <?php echo isset($country_code) && $country_code == 'SE' ? 'selected' : ''; ?>>Sweden (+46)</option>
                                    <option value="CH" <?php echo isset($country_code) && $country_code == 'CH' ? 'selected' : ''; ?>>Switzerland (+41)</option>
                                    <option value="SY" <?php echo isset($country_code) && $country_code == 'SY' ? 'selected' : ''; ?>>Syria (+963)</option>
                                    <option value="TW" <?php echo isset($country_code) && $country_code == 'TW' ? 'selected' : ''; ?>>Taiwan (+886)</option>
                                    <option value="TJ" <?php echo isset($country_code) && $country_code == 'TJ' ? 'selected' : ''; ?>>Tajikistan (+992)</option>
                                    <option value="TZ" <?php echo isset($country_code) && $country_code == 'TZ' ? 'selected' : ''; ?>>Tanzania (+255)</option>
                                    <option value="TH" <?php echo isset($country_code) && $country_code == 'TH' ? 'selected' : ''; ?>>Thailand (+66)</option>
                                    <option value="TG" <?php echo isset($country_code) && $country_code == 'TG' ? 'selected' : ''; ?>>Togo (+228)</option>
                                    <option value="TO" <?php echo isset($country_code) && $country_code == 'TO' ? 'selected' : ''; ?>>Tonga (+676)</option>
                                    <option value="TT" <?php echo isset($country_code) && $country_code == 'TT' ? 'selected' : ''; ?>>Trinidad and Tobago (+1 868)</option>
                                    <option value="TN" <?php echo isset($country_code) && $country_code == 'TN' ? 'selected' : ''; ?>>Tunisia (+216)</option>
                                    <option value="TR" <?php echo isset($country_code) && $country_code == 'TR' ? 'selected' : ''; ?>>Turkey (+90)</option>
                                    <option value="TM" <?php echo isset($country_code) && $country_code == 'TM' ? 'selected' : ''; ?>>Turkmenistan (+993)</option>
                                    <option value="TV" <?php echo isset($country_code) && $country_code == 'TV' ? 'selected' : ''; ?>>Tuvalu (+688)</option>
                                    <option value="UG" <?php echo isset($country_code) && $country_code == 'UG' ? 'selected' : ''; ?>>Uganda (+256)</option>
                                    <option value="UA" <?php echo isset($country_code) && $country_code == 'UA' ? 'selected' : ''; ?>>Ukraine (+380)</option>
                                    <option value="AE" <?php echo isset($country_code) && $country_code == 'AE' ? 'selected' : ''; ?>>United Arab Emirates (+971)</option>
                                    <option value="GB" <?php echo isset($country_code) && $country_code == 'GB' ? 'selected' : ''; ?>>United Kingdom (+44)</option>
                                    <option value="US" <?php echo isset($country_code) && $country_code == 'US' ? 'selected' : ''; ?>>United States (+1)</option>
                                    <option value="UY" <?php echo isset($country_code) && $country_code == 'UY' ? 'selected' : ''; ?>>Uruguay (+598)</option>
                                    <option value="UZ" <?php echo isset($country_code) && $country_code == 'UZ' ? 'selected' : ''; ?>>Uzbekistan (+998)</option>
                                    <option value="VU" <?php echo isset($country_code) && $country_code == 'VU' ? 'selected' : ''; ?>>Vanuatu (+678)</option>
                                    <option value="VA" <?php echo isset($country_code) && $country_code == 'VA' ? 'selected' : ''; ?>>Vatican City (+39)</option>
                                    <option value="VE" <?php echo isset($country_code) && $country_code == 'VE' ? 'selected' : ''; ?>>Venezuela (+58)</option>
                                    <option value="VN" <?php echo isset($country_code) && $country_code == 'VN' ? 'selected' : ''; ?>>Vietnam (+84)</option>
                                    <option value="YE" <?php echo isset($country_code) && $country_code == 'YE' ? 'selected' : ''; ?>>Yemen (+967)</option>
                                    <option value="ZM" <?php echo isset($country_code) && $country_code == 'ZM' ? 'selected' : ''; ?>>Zambia (+260)</option>
                                    <option value="ZW" <?php echo isset($country_code) && $country_code == 'ZW' ? 'selected' : ''; ?>>Zimbabwe (+263)</option>
                                </select>
                                <input class="h-12 px-4 mt-2 border-line rounded-lg" style="width: 75%;" type="text" name="contact_number" id="contact_number" placeholder="Enter phone number" required value="<?php echo isset($contact_number) ? htmlspecialchars($contact_number) : ''; ?>">
                            </div>
                        </div>
                        <div class="contactemail">
                            <label for="contactemail">Contact Email <span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="contactemail" type="text" placeholder="enter contact email" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Job preferred location <span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg"
                                   id="jobLocation"
                                   type="text"
                                   placeholder="Search job preferred location"
                                   list="locationList"
                                   autocomplete="off"
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

                    <h5 class="heading5 mt-5">Global Education</h5>
                    <div class="grid sm:grid-cols-3 gap-3">
                        <div class="education_level">
                            <label>Level of Education <span class="text-red">*</span></label>
                            <div class="select_block flex items-center w-full h-12 pr-10 pl-4 mt-2 border border-line rounded-lg">
                                <div class="select" id="education_level">
                                    <span class="selected capitalize" data-title="Canada">Select level of education</span>
                                    <ul class="list_option scrollbar_custom w-full max-h-[200px] bg-white">
                                        <li class="capitalize" data-item="Canada">Canada</li>
                                        <li class="capitalize" data-item="Australia">Australia</li>
                                        <li class="capitalize" data-item="South Korea">South Korea</li>
                                        <li class="capitalize" data-item="United Kingdom">United Kingdom</li>
                                        <li class="capitalize" data-item="South Africa">South Africa</li>
                                    </ul>
                                </div>
                                <span class="icon_down ph ph-caret-down right-3"></span>
                            </div>
                        </div>
                        <div class="education_level">
                            <label>Field of Study <span class="text-red">*</span></label>
                            <div class="select_block flex items-center w-full h-12 pr-10 pl-4 mt-2 border border-line rounded-lg">
                                <div class="select" id="education_level">
                                    <span class="selected capitalize" data-title="Canada">Select field of study</span>
                                    <ul class="list_option scrollbar_custom w-full max-h-[200px] bg-white">
                                        <li class="capitalize" data-item="Canada">Canada</li>
                                        <li class="capitalize" data-item="Australia">Australia</li>
                                        <li class="capitalize" data-item="South Korea">South Korea</li>
                                        <li class="capitalize" data-item="United Kingdom">United Kingdom</li>
                                        <li class="capitalize" data-item="South Africa">South Africa</li>
                                    </ul>
                                </div>
                                <span class="icon_down ph ph-caret-down right-3"></span>
                            </div>
                        </div>
                        <div class="education_level">
                            <label>Year of Graduation <span class="text-red">*</span></label>
                            <div class="select_block flex items-center w-full h-12 pr-10 pl-4 mt-2 border border-line rounded-lg">
                                <div class="select" id="education_level">
                                    <span class="selected capitalize" data-title="Canada">Select year of graduation</span>
                                    <ul class="list_option scrollbar_custom w-full max-h-[200px] bg-white">
                                        <li class="capitalize" data-item="Canada">Canada</li>
                                        <li class="capitalize" data-item="Australia">Australia</li>
                                        <li class="capitalize" data-item="South Korea">South Korea</li>
                                        <li class="capitalize" data-item="United Kingdom">United Kingdom</li>
                                        <li class="capitalize" data-item="South Africa">South Africa</li>
                                    </ul>
                                </div>
                                <span class="icon_down ph ph-caret-down right-3"></span>
                            </div>
                        </div>
                    </div>

                    <h5 class="heading5 mt-5">Canadian Education</h5>
                    <div class="grid sm:grid-cols-3 gap-3">
                        <div class="education_level">
                            <label>College/University</label>
                            <div class="select_block flex items-center w-full h-12 pr-10 pl-4 mt-2 border border-line rounded-lg">
                                <div class="select" id="education_level">
                                    <span class="selected capitalize" data-title="Canada">Select College/University</span>
                                    <ul class="list_option scrollbar_custom w-full max-h-[200px] bg-white">
                                        <li class="capitalize" data-item="Canada">Canada</li>
                                        <li class="capitalize" data-item="Australia">Australia</li>
                                        <li class="capitalize" data-item="South Korea">South Korea</li>
                                        <li class="capitalize" data-item="United Kingdom">United Kingdom</li>
                                        <li class="capitalize" data-item="South Africa">South Africa</li>
                                    </ul>
                                </div>
                                <span class="icon_down ph ph-caret-down right-3"></span>
                            </div>
                        </div>
                        <div class="education_level">
                            <label>City</label>
                            <div class="select_block flex items-center w-full h-12 pr-10 pl-4 mt-2 border border-line rounded-lg">
                                <div class="select" id="education_level">
                                    <span class="selected capitalize" data-title="Canada">Select City</span>
                                    <ul class="list_option scrollbar_custom w-full max-h-[200px] bg-white">
                                        <li class="capitalize" data-item="Canada">Canada</li>
                                        <li class="capitalize" data-item="Australia">Australia</li>
                                        <li class="capitalize" data-item="South Korea">South Korea</li>
                                        <li class="capitalize" data-item="United Kingdom">United Kingdom</li>
                                        <li class="capitalize" data-item="South Africa">South Africa</li>
                                    </ul>
                                </div>
                                <span class="icon_down ph ph-caret-down right-3"></span>
                            </div>
                        </div>
                        <div class="education_level">
                            <label>Level of Education</label>
                            <div class="select_block flex items-center w-full h-12 pr-10 pl-4 mt-2 border border-line rounded-lg">
                                <div class="select" id="education_level">
                                    <span class="selected capitalize" data-title="Canada">Select Level of Education</span>
                                    <ul class="list_option scrollbar_custom w-full max-h-[200px] bg-white">
                                        <li class="capitalize" data-item="Canada">Canada</li>
                                        <li class="capitalize" data-item="Australia">Australia</li>
                                        <li class="capitalize" data-item="South Korea">South Korea</li>
                                        <li class="capitalize" data-item="United Kingdom">United Kingdom</li>
                                        <li class="capitalize" data-item="South Africa">South Africa</li>
                                    </ul>
                                </div>
                                <span class="icon_down ph ph-caret-down right-3"></span>
                            </div>
                        </div>
                        <div class="education_level">
                            <label>Field of Study</label>
                            <div class="select_block flex items-center w-full h-12 pr-10 pl-4 mt-2 border border-line rounded-lg">
                                <div class="select" id="education_level">
                                    <span class="selected capitalize" data-title="Canada">Select Field of Study</span>
                                    <ul class="list_option scrollbar_custom w-full max-h-[200px] bg-white">
                                        <li class="capitalize" data-item="Canada">Canada</li>
                                        <li class="capitalize" data-item="Australia">Australia</li>
                                        <li class="capitalize" data-item="South Korea">South Korea</li>
                                        <li class="capitalize" data-item="United Kingdom">United Kingdom</li>
                                        <li class="capitalize" data-item="South Africa">South Africa</li>
                                    </ul>
                                </div>
                                <span class="icon_down ph ph-caret-down right-3"></span>
                            </div>
                        </div>
                        <div class="education_level">
                            <label>Year of completion</label>
                            <div class="select_block flex items-center w-full h-12 pr-10 pl-4 mt-2 border border-line rounded-lg">
                                <div class="select" id="education_level">
                                    <span class="selected capitalize" data-title="Canada">Select Year of completion</span>
                                    <ul class="list_option scrollbar_custom w-full max-h-[200px] bg-white">
                                        <li class="capitalize" data-item="Canada">Canada</li>
                                        <li class="capitalize" data-item="Australia">Australia</li>
                                        <li class="capitalize" data-item="South Korea">South Korea</li>
                                        <li class="capitalize" data-item="United Kingdom">United Kingdom</li>
                                        <li class="capitalize" data-item="South Africa">South Africa</li>
                                    </ul>
                                </div>
                                <span class="icon_down ph ph-caret-down right-3"></span>
                            </div>
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">GPA</label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="10" required />
                        </div>
                    </div>
                    <h5 class="heading5 mt-5">Skills</h5>
                    <div class="grid sm:grid-cols-3 gap-3">
                        <div class="education_level">
                            <label>Core Skills</label>
                            <div class="select_block flex items-center w-full h-12 pr-10 pl-4 mt-2 border border-line rounded-lg">
                                <div class="select" id="education_level">
                                    <span class="selected capitalize" data-title="Canada">Search Core Skills</span>
                                    <ul class="list_option scrollbar_custom w-full max-h-[200px] bg-white">
                                        <li class="capitalize" data-item="Canada">Canada</li>
                                        <li class="capitalize" data-item="Australia">Australia</li>
                                        <li class="capitalize" data-item="South Korea">South Korea</li>
                                        <li class="capitalize" data-item="United Kingdom">United Kingdom</li>
                                        <li class="capitalize" data-item="South Africa">South Africa</li>
                                    </ul>
                                </div>
                                <span class="icon_down ph ph-caret-down right-3"></span>
                            </div>
                        </div>
                        <div class="education_level">
                            <label>Sub Skills</label>
                            <div class="select_block flex items-center w-full h-12 pr-10 pl-4 mt-2 border border-line rounded-lg">
                                <div class="select" id="education_level">
                                    <span class="selected capitalize" data-title="Canada">Search Core Skills</span>
                                    <ul class="list_option scrollbar_custom w-full max-h-[200px] bg-white">
                                        <li class="capitalize" data-item="Canada">Canada</li>
                                        <li class="capitalize" data-item="Australia">Australia</li>
                                        <li class="capitalize" data-item="South Korea">South Korea</li>
                                        <li class="capitalize" data-item="United Kingdom">United Kingdom</li>
                                        <li class="capitalize" data-item="South Africa">South Africa</li>
                                    </ul>
                                </div>
                                <span class="icon_down ph ph-caret-down right-3"></span>
                            </div>
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Upload Certificate for</label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="file" required />
                        </div>
                    </div>
                    <h5 class="heading5 mt-5">Work Experience</h5>
                    <div class="grid sm:grid-cols-3 gap-3">
                        <div class="education_level">
                            <label>Industry</label>
                            <div class="select_block flex items-center w-full h-12 pr-10 pl-4 mt-2 border border-line rounded-lg">
                                <div class="select" id="education_level">
                                    <span class="selected capitalize" data-title="Canada">Search Industry</span>
                                    <ul class="list_option scrollbar_custom w-full max-h-[200px] bg-white">
                                        <li class="capitalize" data-item="Canada">Canada</li>
                                        <li class="capitalize" data-item="Australia">Australia</li>
                                        <li class="capitalize" data-item="South Korea">South Korea</li>
                                        <li class="capitalize" data-item="United Kingdom">United Kingdom</li>
                                        <li class="capitalize" data-item="South Africa">South Africa</li>
                                    </ul>
                                </div>
                                <span class="icon_down ph ph-caret-down right-3"></span>
                            </div>
                        </div>
                        <div class="education_level">
                            <label>Sub Industry</label>
                            <div class="select_block flex items-center w-full h-12 pr-10 pl-4 mt-2 border border-line rounded-lg">
                                <div class="select" id="education_level">
                                    <span class="selected capitalize" data-title="Canada">Search Sub Industry</span>
                                    <ul class="list_option scrollbar_custom w-full max-h-[200px] bg-white">
                                        <li class="capitalize" data-item="Canada">Canada</li>
                                        <li class="capitalize" data-item="Australia">Australia</li>
                                        <li class="capitalize" data-item="South Korea">South Korea</li>
                                        <li class="capitalize" data-item="United Kingdom">United Kingdom</li>
                                        <li class="capitalize" data-item="South Africa">South Africa</li>
                                    </ul>
                                </div>
                                <span class="icon_down ph ph-caret-down right-3"></span>
                            </div>
                        </div>
                        <div class="education_level">
                            <label>Country</label>
                            <div class="select_block flex items-center w-full h-12 pr-10 pl-4 mt-2 border border-line rounded-lg">
                                <div class="select" id="education_level">
                                    <span class="selected capitalize" data-title="Canada">Search Country</span>
                                    <ul class="list_option scrollbar_custom w-full max-h-[200px] bg-white">
                                        <li class="capitalize" data-item="Canada">Canada</li>
                                        <li class="capitalize" data-item="Australia">Australia</li>
                                        <li class="capitalize" data-item="South Korea">South Korea</li>
                                        <li class="capitalize" data-item="United Kingdom">United Kingdom</li>
                                        <li class="capitalize" data-item="South Africa">South Africa</li>
                                    </ul>
                                </div>
                                <span class="icon_down ph ph-caret-down right-3"></span>
                            </div>
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Job Title</label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="Software Engineer" autocomplete="off" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Company Name</label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="Company Name" autocomplete="off" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Company Website Link</label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="Company Website Link" autocomplete="off" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Start Date</label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="date" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">End Date</label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="date" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Accomplishments</label>
                            <textarea class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" required></textarea>
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Accomplishments</label>
                            <textarea class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" required></textarea>
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Accomplishments</label>
                            <textarea class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" required></textarea>
                        </div>
                    </div>
                    <h5 class="heading5 mt-5">Reference Check</h5>
                    <div class="grid sm:grid-cols-3 gap-3">
                        <div class="jobLocation">
                            <label for="jobLocation">Reference Type</label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="HR Reporting Manager" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Designation</label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="Enter Designation" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Name</label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="Enter Name" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Email</label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="email" placeholder="Enter Email" required />
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-3 gap-3">
                        <button class="w-full h-12 px-4 mt-2 button-main -border mt-5">Send Email</button>
                        <button class="w-full h-12 px-4 mt-2 button-main -border mt-5">Add Another Experience</button>
                        <button class="w-full h-12 px-4 mt-2 button-main -border mt-5">Record Video</button>
                    </div>

                    <h5 class="heading5 mt-5">Career Goals</h5>
                    <div class="grid sm:grid-cols-3 gap-3">
                        <div class="jobLocation">
                            <label for="jobLocation">Role</label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="Enter career role" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Industry</label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="Enter career industry" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">NOC Number</label>
                            <select class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity))">
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                                <option>E</option>
                                <option>F</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center col-span-full gap-5 mt-5">
                        <button class="button-main -border">Reset</button>
                        <button class="button-main">Publish</button>
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

<!--<script>
    $(document).ready(function() {
        $('#mySelect2').select2();
    });
</script>-->
</body>

</html>
