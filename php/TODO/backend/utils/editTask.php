<?php

// required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, 
Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

// import Queries
include_once("../models/queries.php");

// Make sure the requested call in PUT
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    echo json_encode(array("message" => "Action Not Allowed"));
    exit;
}

// Extracting the variables
parse_str(file_get_contents("php://input"), $postVars);

$queryObj = new Queries();

// calling deleteTasks and return status msg in json  
if (!isset($postVars['field2']))
    echo json_encode($queryObj->editTask($postVars['id'], $postVars['field'],  $postVars['msg']));
else
    echo json_encode($queryObj->editTask($postVars['id'], $postVars['field'],  $postVars['msg'], $postVars['field2'],  $postVars['msg2']));
