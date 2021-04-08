<?php

// required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, 
Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

// import Queries
include_once("../models/queries.php");

// Make sure the requested call in POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array("message" => "Action Not Allowed"));
    exit;
}

$queryObj = new Queries();

// calling viewTasks and return output in string
echo $queryObj->loadCheckBoxValue($_POST['id'], $_POST['key']);
