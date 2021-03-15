<?php

// required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// import Queries
include_once("../models/queries.php");


$q = new Queries();

// calling viewTasks and return output in json
echo json_encode($q->viewTasks());
