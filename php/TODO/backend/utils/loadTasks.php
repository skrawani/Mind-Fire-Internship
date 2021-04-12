<?php

// NOTE: Only for debugging purpose will delete on final commit

// required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// import Queries
include_once("../models/queries.php");


$queryObj = new Queries();

// calling viewTasks and return output in json
echo json_encode($queryObj->viewTasks());
