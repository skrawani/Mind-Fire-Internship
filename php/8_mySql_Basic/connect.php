<?php
//establishing connection
$conn = mysqli_connect('localhost', 'root', 'pass123', 'demo') or die("ERROR");

//selecting database
mysqli_select_db($conn, 'demo') or die(mysqli_error($conn));
