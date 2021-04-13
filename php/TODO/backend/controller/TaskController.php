<?php
// NOTE: Header files for debugging purpose will remove in Final commit

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/x-www-form-urlencoded');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');
include_once("../utils/TaskServices.php");


$requestMethod = $_SERVER['REQUEST_METHOD'];

// Set postVars Varibles with request variables
if ($requestMethod  !== 'POST') {
    parse_str(file_get_contents("php://input"), $postVars);
} else {
    $postVars = $_POST;
}
// Create Task Object od TaksServuces class
$taskObj = new TaskServices();

// call addTask Serice
if ($requestMethod  === 'POST' && isset($postVars['api']) && $postVars['api'] === 'addTask') {
    $taskObj->addTask($postVars);
}
// call deleteTask Serice
else if ($requestMethod  === 'DELETE' && isset($postVars['api']) && $postVars['api'] === 'deleteTask') {
    $taskObj->deleteTask($postVars);
}
// call editTask Serice
else if ($requestMethod  === 'PUT' && isset($postVars['api']) && $postVars['api'] === 'editTask') {
    $taskObj->editTask($postVars);
}
// call loadTasks Serice
else if ($requestMethod  === 'GET') {
    $taskObj->loadTasks();
}
// call Filter Service
else if ($requestMethod  === 'POST' && isset($postVars['api']) && $postVars['api'] === 'filter') {
    $taskObj->search($postVars);
}
