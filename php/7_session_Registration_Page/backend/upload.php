<?php
$target_dir = "uploads/";
$target_file_name = basename($_FILES["img"]["name"]);
$target_file = $target_dir . $target_file_name;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["img"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $imgErr = "No File selected or File is not an image ";
        $uploadOk = 0;
    }


    // Check if file already exists
    if (!$imgErr && file_exists($target_file)) {
        $imgErr = "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if (!$imgErr && $_FILES["img"]["size"] > 500000) {
        $imgErr = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        !$imgErr &&
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $imgErr = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if (!$imgErr && $uploadOk == 0) {
        $imgErr = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        var_dump($target_file);
        if (!$imgErr && !move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            $imgErr = "Sorry, there was an error uploading your file.";
        }
    }
}
