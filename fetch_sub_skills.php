<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$inserted_at = date("Y-m-d H:i:s");

// Redirect if the user is not logged in
if (!isset($_SESSION['seller_id'])) {
    echo "
    <script>
    window.location.href='Login';
    </script>
    ";
    exit(); // Stop further execution
}

// Handle AJAX request for fetching sub-skills
if (isset($_POST['core_skill'])) {
    $core_skill = $db_handle->checkValue($_POST['core_skill']);

    // Fetch sub-skills from the database
    $query = $db_handle->runQuery("SELECT sub_skill FROM skills WHERE skill_id = '$core_skill'");

    if ($query && !empty($query)) {
        // Loop through the results
        foreach ($query as $row) {
            $sub_skills = explode(", ", $row['sub_skill']); // Split comma-separated sub-skills into an array

            // Add each sub-skill as a list item
            foreach ($sub_skills as $sub_skill) {
                echo '<div class="sub-skill-item" data-value="' . htmlspecialchars(trim($sub_skill)) . '">' . htmlspecialchars(trim($sub_skill)) . '</div>';
            }
        }
    } else {
        // If no sub-skills are found, return a message
        echo '<div class="no-skills">No Sub Skills Found</div>';
    }
} else {
    // If no core_skill is provided, return an error
    echo '<div class="error">Invalid Request</div>';
}
?>