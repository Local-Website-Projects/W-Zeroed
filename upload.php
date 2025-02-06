<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the file was uploaded
    if (isset($_FILES['video'])) {
        $fileTmpName = $_FILES['video']['tmp_name'];
        $fileName = $_FILES['video']['name'];
        $fileSize = $_FILES['video']['size'];
        $fileError = $_FILES['video']['error'];

        // Check if there's no error
        if ($fileError === 0) {
            $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
            $allowed = ['mp4'];

            // Check if the file extension is allowed
            if (in_array(strtolower($fileExt), $allowed)) {
                // Define the upload folder path
                $uploadDir = 'videos/';  // Ensure this folder exists in your project root
                if (!is_dir($uploadDir)) {
                    // Create the folder if it doesn't exist
                    mkdir($uploadDir, 0777, true);  // Ensure it's created with write permissions
                }

                // Define the full file path
                $uploadFilePath = $uploadDir . basename($fileName);

                // Move the uploaded file to the desired folder
                if (move_uploaded_file($fileTmpName, $uploadFilePath)) {
                    echo "File uploaded successfully!";
                } else {
                    echo "Failed to upload the file.";
                }
            } else {
                echo "Invalid file type. Only MP4 files are allowed.";
            }
        } else {
            echo "Error uploading the file. Error code: " . $fileError;
        }
    } else {
        echo "No video file received.";
    }
}
?>

