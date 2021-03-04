<?php
include_once("../models/queries.php");
$q = new Queries();
echo $q->addTask($_POST['task'], $_POST['isComp'],  $_POST['isFav']);
