<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Submitted</title>
  <style>
    td,
    th {
      width: 20vw;
    }
  </style>
</head>

<body>
  <?php session_start();
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbName = "todo";
  $msg = "";
  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbName);

  // Check connection
  if (!$conn) {
    $msg = "Connection failed: " . mysqli_connect_error();
    exit();
  }
  $stmt = $conn->prepare("INSERT INTO user(email, name, gender, phone, pass) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param('sssss', $_SESSION['email'], $_SESSION['name'], $_SESSION['gender'], $_SESSION['phone'], $_SESSION['pass']);

  if ($stmt->execute() === TRUE) {
    $msg = "New record created successfully";
  } else {
    $msg = "Error: "  . "<br>" . $conn->error;
  }

  $conn->close();

  ?>
  <h2>Form Submitted</h2>
  <table>
    <tr>
      <th>Field</th>
      <th>Value</th>
    </tr>
    <tr>
      <td>Email </td>
      <td><?php echo $_SESSION["email"];  ?></td>
    </tr>
    <tr>
      <td>Name </td>
      <td><?php echo $_SESSION["name"];  ?></td>
    </tr>
    <tr>
      <td>Gender </td>
      <td><?php echo $_SESSION["gender"];  ?></td>
    </tr>
    <tr>
      <td>Phone no. </td>
      <td><?php echo $_SESSION["phone"];  ?></td>
    </tr>
  </table>
  <h3><?php echo $msg; ?></h3>
</body>

</html>