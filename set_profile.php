<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from freelanhub.vercel.app/candidates-payouts.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 25 Jan 2025 07:12:43 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="FreelanHub - Job Board & Freelance Marketplace" />
    <title>FreelanHub - Job Board & Freelance Marketplace</title>
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon" />
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/leaflet.css" />
    <link rel="stylesheet" href="assets/css/slick.css" />
    <link rel="stylesheet" href="assets/css/apexcharts.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="dist/output-tailwind.css" />
    <link rel="stylesheet" href="dist/output-scss.css" />
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
                <h5 class="heading5">Personal Information</h5>
                <form class="form mt-5">
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
                            <label for="profile">Profile <span class="text-red">*</span></label>
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
                            <div class="select_block flex items-center w-full h-12 pr-10 pl-4 mt-2 border border-line rounded-lg">
                                <div class="select" id="nationality">
                                    <span class="selected capitalize" data-title="Canada">Canada</span>
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
                        <div class="country">
                            <label>Country <span class="text-red">*</span></label>
                            <div class="select_block flex items-center w-full h-12 pr-10 pl-4 mt-2 border border-line rounded-lg">
                                <div class="select" id="nationality">
                                    <span class="selected capitalize" data-title="Canada">Canada</span>
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
                        <div class="state">
                            <label>Current State <span class="text-red">*</span></label>
                            <div class="select_block flex items-center w-full h-12 pr-10 pl-4 mt-2 border border-line rounded-lg">
                                <div class="select" id="nationality">
                                    <span class="selected capitalize" data-title="Canada">Canada</span>
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
                        <div class="city">
                            <label>Current City <span class="text-red">*</span></label>
                            <div class="select_block flex items-center w-full h-12 pr-10 pl-4 mt-2 border border-line rounded-lg">
                                <div class="select" id="nationality">
                                    <span class="selected capitalize" data-title="Canada">Canada</span>
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
                        <div class="contactno">
                            <label for="contactno">Contact No <span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="contactno" type="text" placeholder="+1 250-555-0199" required />
                        </div>
                        <div class="contactemail">
                            <label for="contactemail">Contact Email <span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="contactemail" type="text" placeholder="enter contact email" required />
                        </div>
                        <div class="jobLocation">
                            <label for="jobLocation">Job preferred location <span class="text-red">*</span></label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="Search job preferred location" required />
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
                            <label for="jobLocation">Company Email</label>
                            <input class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" type="text" placeholder="Company Email" autocomplete="off" required />
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
                        <div class="jobLocation">
                            <label for="jobLocation">Accomplishments</label>
                            <textarea class="w-full h-12 px-4 mt-2 border-line rounded-lg" id="jobLocation" required></textarea>
                        </div>
                        <button class="button-main -border mt-5">Add Another Experience</button>

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
</body>

</html>
