<?php
//include database connection file
include_once("connect.php");

$query = "SELECT U.id, U.name, U.gender, U.age, U.state_id, S.state_name ";
$query .= "FROM users U, states S ";
$query .= "WHERE U.state_id = S.id";

$result = mysqli_query($conn, $query);

if (isset($_GET["msg"]) && !empty($_GET["msg"])) {
    echo $_GET["msg"];
}

?>
<table width="500" border="1">
    <tr>
        <th>Sl. No.</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>State</th>
        <th colspan="2">Action</th>
    </tr>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $name = $row["name"];
        $age = $row["age"];
        $gender = $row["gender"];
        $state_name = $row["state_name"];

        echo "<tr>";
        echo "<td>" . ++$i . "</td>";
        echo "<td>" . $name . "</td>";
        echo "<td>" . $age . "</td>";
        echo "<td>" . $gender . "</td>";
        echo "<td>" . $state_name . "</td>";
        echo "<td><a href='form.php?task=edit&id=$id'>edit</a></td>";
        echo "<td><a href='form.php?task=delete&id=$id'>delete</a></td>";
        echo "</tr>";
    }

    ?>
</table>
<a href="form.php?task=insert">
    <button>Insert</button>
</a>
<?php
//include database dis-connection file
include_once("disconnect.php");
?>