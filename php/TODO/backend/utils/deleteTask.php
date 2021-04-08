<?php
// required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/x-www-form-urlencoded');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, 
Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');


// import Queries
include_once("../models/queries.php");

// Make sure the requested call in DELETE
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    echo json_encode(array("message" => "Action Not Allowed"));
    exit;
}
// Extracting the variables
parse_str(file_get_contents("php://input"), $postVars);

$queryObj = new Queries();

// calling deleteTasks and return  status msg in json  
echo json_encode($queryObj->deleteTasks($postVars['id']));
