<?php
include_once("../models/queries.php");
$q = new Queries();
echo json_encode($q->viewTasks());
