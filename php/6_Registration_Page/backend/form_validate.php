<?php
// Function To PreProcess The Input Fields

var_dump($_POST);

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
    $_SESSION["name"] = $name = $_POST["name"];
    $nameErr =   validateFields(
        "name",
        '/^[a-zA-Z ]{1,40}$/',
        "Name is Required!",
        "Name must only contains alphabets and length should be greater than 0 and less than 40"
    );

    // Date of Birth Validation
    // $dobErr = $nameErr  ? "" : validateDate("dob", "Date of Birth is Required!", "DOB must lies between 1900 to current date");
    $dobErr = $nameErr ? "" : validateDate("dob", "Date of Birth is Required!", "DOB must lies between 1900 to current date");

    // Gender Validation
    if (empty($_POST['gender']))
        $genderErr =  $nameErr || $dobErr  ? "" : "Gender is Required!";
    else
        $_SESSION["gender"] = $gender = $_POST['gender'];

    // Email Validation
    $email = $_SESSION["email"] = $_POST["email"];
    $emailErr = $nameErr || $dobErr || $genderErr   ? "" :  validateFields(
        "email",
        '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
        "Email is Required!",
        "Enter valid email id"
    );

    // Phone No validation
    $_SESSION["phone"] = $phone = $_POST["phone"];
    $phoneErr = $nameErr || $dobErr || $genderErr  || $emailErr  ? "" :  validateFields("phone", '/^\d{10}$/', "Phone no is Required!", "Enter valid phone no.", "Another account with same PHONE NO exist!");


    // skilss Validation
    $_SESSION["skill"] = $skill = $_POST["skill"];
    $skillErr = $nameErr || $dobErr || $genderErr  || $emailErr || $phoneErr ? "" : (count($skill) === 0 ? "Skills are required!" : "");


    // Vaidate Image 
    $imgErr = $nameErr || $dobErr || $genderErr  || $emailErr || $phoneErr || $skillErr ? "" : $imgErr;
    // About is Optional

    // VAlidate Validation
    $_SESSION["addr"] = $addr = $_POST["addr"];
    $addrErr = $nameErr || $dobErr || $genderErr  || $emailErr || $imgErr   ? "" : ($addr == "" ? "Addesss is required!" : "");

    //  Education Qualification
    $_SESSION["education"] = $education = $_POST["education"];
    $educationErr = $nameErr || $dobErr || $genderErr  || $emailErr || $imgErr || $addrErr  ? "" : ($education == "" ? "Education field is required!" : "");


    // Interests
    $_SESSION["interests"] = $interests = $_POST["interests"];
    $interestsErr = $nameErr || $dobErr || $genderErr  || $emailErr || $imgErr || $addrErr || $educationErr ? "" : (count($interests) === 0 ? "Interests are required!" : "");


    // VAlidate Linkedin
    $_SESSION["linkedin"] = $linkedin = $_POST["linkedin"];
    $linkedinErr = $nameErr || $dobErr || $genderErr  || $emailErr || $imgErr || $addrErr || $educationErr || $interestsErr ? "" :  validateURL(
        "linkedin",
        "",
        "Enter valid Linked URL"
    );

    // VAlidate Github
    $_SESSION["github"] = $github = $_POST["github"];
    $githubErr = $nameErr || $dobErr || $genderErr  || $emailErr || $imgErr || $addrErr || $educationErr || $interestsErr || $linkedinErr ? "" :  validateURL(
        "github",
        "",
        "Enter valid Github URL"
    );



    // 'Location:download.php?fname='.$_POST['fname']."&lname=".$_POST['lname']
    if (!$githubErr && !$nameErr && !$dobErr && !$genderErr && !$emailErr && !$imgErr && !$addrErr && !$educationErr && !$interestsErr && !$linkedinErr) {
        header('Location: ./profile.php?email=' . $_POST['email'] . '&name=' . $_POST['name'] . '&gender=' . $_POST['gender'] . '&phone=' . $_POST['phone'] . '&addr=' . $_POST['addr'] . '&education=' . $_POST['education'] . '&skill=' . $_POST['skill'] . '&interests=' . $_POST['interests'] . '&target_file=' . $target_file . '&linkedin=' . $_POST['linkedin'] . '&github=' . $_POST['github']);
        exit();
    }
}
