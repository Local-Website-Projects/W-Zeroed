<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$inserted_at = date("Y-m-d H:i:s");

if(isset($_POST['industry_id'])) {
    $industry_id = $_POST['industry_id'];

    $query = $db_handle->runQuery("SELECT * FROM industries WHERE industry_id = '$industry_id'");

    echo '<option selected>Select Sub Industry</option>';
    foreach ($query as $row) {
        $sub_skills = explode("; ", $row['sub_industry']);
        foreach ($sub_skills as $sub_skill) {
            echo "<option value='$sub_skill'>$sub_skill</option>";
        }
    }
}