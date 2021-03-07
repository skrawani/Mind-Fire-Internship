<?php
$servername = "localhost";
$username = "root";
$password = "pass123";
$dbName = "todo";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbName);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

$sql = "insert into user VALUES('s1@g.com', 'sachisn', 'male', '9556193085', '12356789');";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
