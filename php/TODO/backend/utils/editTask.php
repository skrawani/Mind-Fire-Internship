<?php
include_once("../models/queries.php");
$q = new Queries();
echo $q->editTask($_POST['id'], $_POST['field'],  $_POST['msg']);
