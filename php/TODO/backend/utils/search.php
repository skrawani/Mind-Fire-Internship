<?php

// required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// import Queries
include_once("../models/queries.php");

// Make sure the requested call in POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array("message" => "Action Not Allowed"));
    exit;
}

$q = new Queries();

// Calling search function depending upon isFullText is set or not
if (isset($_POST['isFullText']))
    echo json_encode($q->search($_POST["key"], $_POST["byPrority"], true));
else
    echo json_encode($q->search($_POST["key"], $_POST["byPrority"]));
