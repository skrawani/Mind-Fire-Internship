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
$email = $name = $gender = $phone = $pass = $cpass = "";
$skill = $interests = [];
$emailErr =  $nameErr = $genderErr = $phoneErr = $passErr = $cpassErr = "";

// Check if Value Exist in DB or not
function isExist($key, $val)
{
    $mysqli = new mysqli("localhost", "root", "pass123", "todo");
    $stmt = "SELECT * FROM user WHERE $key = '$val';";
    $result = $mysqli->query($stmt);

    $mysqli->close();
    if ($result->num_rows == 0)
        return false;
    return true;
}

// Function to do Validation of Fields
function validateFields($key, $re, $ifEmpty, $ifInvalid, $ifSame = false)
{
    $data = $_POST[$key];
    if (empty($data))
        return $ifEmpty;
    else {
        $tmp = preProcessInput($data);
        if (!preg_match($re, $tmp))
            return $ifInvalid;
    }
    if ($ifSame && isExist($key, $data))  return $ifSame;
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
    $dobErr = validateDate("dob", "Date of Birth is Required!", "DOB must lies between 1900 to current date");

    // Gender Validation
    if (empty($_POST['gender']))
        $genderErr = $emailErr || $nameErr ? "" : "Gender is Required!";
    else
        $_SESSION["gender"] = $gender = $_POST['gender'];

    // Email Validation
    $email = $_SESSION["email"] = $_POST["email"];
    $emailErr = validateFields(
        "email",
        '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
        "Email is Required!",
        "Enter valid email id",
        "Another account with same EMAIL ID exist!"
    );

    // Phone No validation
    $_SESSION["phone"] = $phone = $_POST["phone"];
    $phoneErr = $emailErr || $nameErr || $genderErr  ? "" : validateFields("phone", '/^\d{10}$/', "Phone no is Required!", "Enter valid phone no.", "Another account with same PHONE NO exist!");


    // skilss Validation
    $_SESSION["skill"] = $skill = $_POST["skill"];
    $skillErr = count($skill) === 0 ? "Skills are required!" : "";


    // TODO: VAlidate Image

    // About is Optional

    // VAlidate Validation
    $_SESSION["addr"] = $addr = $_POST["addr"];
    $addrErr = $addr == "" ? "Addesss is required!" : "";

    //  Education Qualification
    $_SESSION["education"] = $education = $_POST["education"];
    $educationErr = $education == "" ? "Education field is required!" : "";


    // Interests
    $_SESSION["interests"] = $interests = $_POST["interests"];
    $interestsErr = count($interests) === 0 ? "Interests are required!" : "";


    // VAlidate Linkedin
    $linkedinErr = validateURL(
        "linkedin",
        "",
        "Enter valid Linked URL"
    );

    // VAlidate Github
    $githubErr = validateURL(
        "github",
        "",
        "Enter valid Github URL"
    );

    if (!$emailErr && !$nameErr && !$genderErr && !$phoneErr && !$passErr && !$cpassErr) {
        header('Location: ./backend/Submitted.php');
        exit();
    }
}
