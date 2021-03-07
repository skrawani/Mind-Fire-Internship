<?php
ini_set('display_errors', 1);
include_once("../models/queries.php");
$q = new Queries();
echo json_encode($q->viewTasks());
