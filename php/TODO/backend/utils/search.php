<?php

// required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// import Queries
include_once("../models/queries.php");


$q = new Queries();

// calling viewTasks and return output in jsonv
// var_dump($_POST);
// echo json_decode(array(["key"] => $_GET["key"]));

echo json_encode($q->searchNormal($_POST["key"], $_POST["byPrority"]));
    
// var_dump($q->searchNormal("sa"));
