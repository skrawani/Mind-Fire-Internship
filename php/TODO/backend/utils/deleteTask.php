<?php
include_once("../models/queries.php");
$q = new Queries();
echo $q->deleteTasks($_POST['id']);
