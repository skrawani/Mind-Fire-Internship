<?php
include_once("../models/queries.php");
$q = new Queries();
echo $q->isComp($_POST['id']);
