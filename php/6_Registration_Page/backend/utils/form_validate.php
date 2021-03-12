<?php

// Function To PreProcess The Input Fields
function preProcessInput($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// All variables
$email = $name = $gender = $phone = $addr =  $education  = $linkedin = $github =  "";
$skill = $interests = [];
$emailErr =  $nameErr = $genderErr = $phoneErr = $addrErr =  $educationErr  = $linkedinErr = $githubErr = $skillErr = $interestsErr = $imgErr =  "";


// Function to do Validation of Fields
function validateFields($key, $re, $ifEmpty, $ifInvalid)
{
    $data = $_POST[$key];
    if (empty($data))
        return $ifEmpty;
    else {
        $tmp = preProcessInput($data);
        if (!preg_match($re, $tmp))
            return $ifInvalid;
    }

    return "";
}

// Function to valiate URL
function validateURL($key, $ifEmpty, $ifInvalid)
{
    $url = $_POST[$key];
    if ($url == "") return "";
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return $ifInvalid;
    }
    return "";
}

// Validate Date 
function validateDate($key, $ifEmpty, $ifInvalid)
{
    $data = $_POST[$key];
    if (empty($data))
        return $ifEmpty;
    else {
        $test_arr  = explode('-', $data);
        if (checkdate($test_arr[1], $test_arr[2], $test_arr[0])) {
            $test_date =  mktime(0, 0, 0, $test_arr[1], $test_arr[2], $test_arr[0]);
            if ($test_arr < 1900 || time() <=  $test_date)
                return $ifInvalid;
        }
    }
    return "";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Name Validation
    $name = $_POST["name"];
    $nameErr =   validateFields(
        "name",
        '/^[a-zA-Z ]{1,40}$/',
        "Name is Required!",
        "Name must only contains alphabets and length should be greater than 0 and less than 40"
    );

    // Date of Birth Validation
    $dob = $_POST["dob"];
    $dobErr = $nameErr ? "" : validateDate("dob", "Date of Birth is Required!", "DOB must lies between 1900 to current date");

    // Gender Validation
    if (empty($_POST['gender']))
        $genderErr =  $nameErr || $dobErr  ? "" : "Gender is Required!";
    else
        $gender = $_POST['gender'];

    // Email Validation
    $email = $_POST["email"];
    $emailErr = $nameErr || $dobErr || $genderErr   ? "" :  validateFields(
        "email",
        '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
        "Email is Required!",
        "Enter valid email id"
    );

    // Phone No validation
    $phone = $_POST["phone"];
    $phoneErr = $nameErr || $dobErr || $genderErr  || $emailErr  ? "" :  validateFields("phone", '/^\d{10}$/', "Phone no is Required!", "Enter valid phone no.", "Another account with same PHONE NO exist!");

    // skilss Validation
    $skill = $_POST["skill"];
    $skillErr = $nameErr || $dobErr || $genderErr  || $emailErr || $phoneErr ? "" : (count($skill) === 0 ? "Skills are required!" : "");

    // Vaidate Image 
    $imgErr = $nameErr || $dobErr || $genderErr  || $emailErr || $phoneErr || $skillErr ? "" : $imgErr;
    // About is Optional
    $about = $_POST['about'];

    // VAlidate Validation
    $addr = $_POST["addr"];
    $addrErr = $nameErr || $dobErr || $genderErr  || $emailErr || $phoneErr || $skillErr || $imgErr   ? "" : ($addr == "" ? "Addesss is required!" : "");

    //  Education Qualification
    $education = $_POST["education"];
    $educationErr = $nameErr || $dobErr || $genderErr  || $emailErr || $phoneErr || $skillErr || $imgErr  || $addrErr  ? "" : ($education == "" ? "Education field is required!" : "");

    // Interests
    $interests = $_POST["interests"];
    $interestsErr = $nameErr || $dobErr || $genderErr  || $emailErr || $phoneErr || $skillErr || $imgErr  || $addrErr || $educationErr ? "" : (count($interests) === 0 ? "Interests are required!" : "");

    // VAlidate Linkedin
    $linkedin = $_POST["linkedin"];
    $linkedinErr = $nameErr || $dobErr || $genderErr  || $emailErr || $phoneErr || $skillErr || $imgErr  || $addrErr || $educationErr || $interestsErr ? "" :  validateURL(
        "linkedin",
        "",
        "Enter valid Linked URL"
    );

    // VAlidate Github
    $github = $_POST["github"];
    $githubErr = $nameErr || $dobErr || $genderErr  || $emailErr || $phoneErr || $skillErr || $imgErr  || $addrErr || $educationErr || $interestsErr || $linkedinErr ? "" :  validateURL(
        "github",
        "",
        "Enter valid Github URL"
    );

    $skill = implode(", ", $skill);
    $interests = implode(", ", $interests);
    if (!$githubErr && !$nameErr && !$dobErr && !$genderErr && !$emailErr && !$phoneErr && !$skillErr &&  !$imgErr &&  !$addrErr && !$educationErr && !$interestsErr && !$linkedinErr && !$githubErr) {
        header('Location: ./profile.php?email=' . $email . '&name=' . $name .  '&dob=' . $dob . '&about=' . $about . '&gender=' . $gender . '&phone=' . $phone . '&addr=' . $addr . '&education=' . $education . '&skill=' . $skill . '&interests=' . $interests . '&target_file=' . $target_file . '&linkedin=' . $linkedin . '&github=' . $github);
        exit();
    }
}
