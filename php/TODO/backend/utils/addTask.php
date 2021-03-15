<?php

// required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/x-www-form-urlencoded');
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

// Creating Instance of the Query class
$q = new Queries();

// calling addTask and return  output in json  
echo json_encode($q->addTask($_POST['task'], $_POST['isComp'],  $_POST['isFav']));
