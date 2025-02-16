<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select2 Example</title>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
<select id="coreSkills1" class="w-full h-12 px-4 mt-2 border-line rounded-lg" style="border: 1px solid rgb(228 228 228 / var(--tw-border-opacity));" name="core_skill_one" required>
    <option value="" selected disabled>Select Core Skills</option>
    <option value="" selected disabled>Select Core Skills</option>
    <option value="" selected disabled>Select Core Skills</option>
    <option value="" selected disabled>Select Core Skills</option>
    <option value="" selected disabled>Select Core Skills</option>
    <option value="" selected disabled>Select Core Skills</option>
    <option value="" selected disabled>Select Core Skills</option>
    <option value="" selected disabled>Select Core Skills</option>
    <option value="" selected disabled>Select Core Skills</option>
    <option value="" selected disabled>Select Core Skills</option>
    <option value="" selected disabled>Select Core Skills</option>
    <option value="" selected disabled>Select Core Skills</option>
    <?php
/*    $fetch_skills = $db_handle->runQuery("SELECT * FROM skills");
    foreach ($fetch_skills as $row) {
        */?><!--
        <option value="<?php /*echo $row['skill_id']*/?>"><?php /*echo $row['core_skill']*/?></option>
        --><?php
/*    }
    */?>
</select>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#coreSkills1').select2();
    });
</script>
</body>
</html>