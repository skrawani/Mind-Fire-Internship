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
$email = $name = $gender = $phone = $pass = $cpass = "";
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Email Validation
    $email = $_SESSION["email"] = $_POST["email"];
    $emailErr = validateFields(
        "email",
        '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
        "Email is Required!",
        "Enter valid email id",
        "Another account with same EMAIL ID exist!"
    );

    // Name Validation
    $_SESSION["name"] = $name = $_POST["name"];
    $nameErr = $emailErr  ? "" :  validateFields(
        "name",
        '/^[a-zA-Z ]{1,40}$/',
        "Name is Required!",
        "Name must only contains alphabets and length should be greater than 0 and less than 40"
    );

    // Gender Validation
    if (empty($_POST['gender']))
        $genderErr = $emailErr || $nameErr ? "" : "Gender is Required!";
    else
        $_SESSION["gender"] = $gender = $_POST['gender'];

    // Phone No validation
    $_SESSION["phone"] = $phone = $_POST["phone"];
    $phoneErr = $emailErr || $nameErr || $genderErr  ? "" : validateFields("phone", '/^\d{10}$/', "Phone no is Required!", "Enter valid phone no.", "Another account with same PHONE NO exist!");

    // Password Validation
    $_SESSION["pass"] = $pass = $_POST["pass"];
    $passErr = $emailErr || $nameErr || $genderErr || $phoneErr ? "" : validateFields(
        "pass",
        '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
        "Password is Required!",
        ' <p class="py-0 text-center  m-0 ">Password must</p>
        <ul>
        <li>be atleat 8 characters long</li>
        <li>contain a uppercase, a lowercase character</li>
        <li>contain a digit and a special Character</li>
        </ul>'
    );

    // Confirm Pass Validation 
    $_SESSION["cpass"] = $cpass = $_POST["cpass"];
    if (!empty($_POST["pass"])) {
        if ($_POST["pass"] !== $_POST["cpass"])
            $cpassErr = $emailErr || $nameErr || $genderErr || $phoneErr || $passErr ? "" : "Both Passwords are not same!";
    }

    if (!$emailErr && !$nameErr && !$genderErr && !$phoneErr && !$passErr && !$cpassErr) {
        header('Location: ./backend/Submitted.php');
        exit();
    }
}
