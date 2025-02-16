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

                <?php
                $count_skills = $db_handle->numRows("SELECT * FROM `seller_core_skills` WHERE user_id={$_SESSION['seller_id']}");
                if($count_skills <= 2){
                    ?>
                    <form class="form" method="post" action="Insert" enctype="multipart/form-data">
                        <!--personal information section start-->

                        <!--skills section starts-->
                        <h5 class="heading5 mt-5">Add Skills</h5>
                        <div class="grid grid-cols-4 gap-3">
                            <!-- First set of core skills and sub-skills -->
                            <div class="education_level col-span-1">
                                <label>Core Skill 1</label>
                                <select id="coreSkills1" class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="core_skill_one" required>
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
                                <div id="subSkillsLabel1" style="display: none;">
                                    <label>Sub Skills 1</label>
                                </div>
                                <input id="selectedSubSkills1" type="hidden" name="sub_skills_one" required/>
                                <div id="subSkillsList1" type="hidden"></div>
                                <div class="selected-tags" id="selectedTags1"></div>
                            </div>
                        </div>


                        <!--reset and submit section starts here-->
                        <div class="flex items-center col-span-full gap-5 mt-5">
                            <button class="button-main" type="submit" name="add_skill">Add Skills</button>
                        </div>
                    </form>
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
