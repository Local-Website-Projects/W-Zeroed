<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$inserted_at = date("Y-m-d H:i:s");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $coreSkillId = $_POST['core_skill_id'];
    $newSubSkill = $_POST['new_sub_skill'];

    if (!empty($coreSkillId) && !empty($newSubSkill)) {
        // Insert the new sub-skill into the database
        $fetch_skill = $db_handle->runQuery("select * from skills where skill_id = '$coreSkillId'");

        $old_sub_skill = $fetch_skill[0]['sub_skill'];
        $updateSubSkill = $old_sub_skill . ', ' . $newSubSkill;

        $update_core_skill = $db_handle->insertQuery("UPDATE `skills` SET `sub_skill`='$updateSubSkill' WHERE `skill_id` = '$coreSkillId'");

        if ($update_core_skill) {
            echo json_encode(['status' => 'success', 'message' => 'Sub skill added successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add sub skill.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}