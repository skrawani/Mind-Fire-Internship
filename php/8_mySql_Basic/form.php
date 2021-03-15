<?php
//include database connection file
include_once("connect.php");
if (isset($_POST["submit"])) {

    //process the data
    $id = (int) $_POST["id"];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $state_id = $_POST["state_id"];

    //error variable
    $error = array();

    if (empty($name)) {
        $error[] = "Please enter your name";
    }
    if (empty($age)) {
        $error[] = "Please enter your age";
    } else if (!is_numeric($age)) {
        $error[] = "Please enter valid age";
    }
    if (empty($gender)) {
        $error[] = "Please select your gender";
    }

    if ($error) {
        echo implode("<br />", $error);
    } else {

        if (!empty($id)) {
            $query = "UPDATE users SET ";
            $query .= "name = '$name', ";
            $query .= "age = $age, ";
            $query .= "gender = '$gender', ";
            $query .= "state_id = $state_id ";
            $query .= "WHERE id = $id";
        } else {
            $query = "INSERT INTO users SET ";
            $query .= "name = '$name', ";
            $query .= "age = $age, ";
            $query .= "gender = '$gender', ";
            $query .= "state_id = '$state_id'";
        }

        // echo $query;exit;

        $status = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if ($status) {
            $msg = "Data saved successfully";
            header("location:index.php?msg=$msg");
        } else {
            echo "Data could not be inserted";
        }
    }
}


if (isset($_GET["task"]) && ($_GET["task"] == "insert")) {
?>
    <form method="post">
        <h2>Name <input type="text" name="name"> </h2>
        <h2>Age <input type="text" name="age"></h2>
        <h2>Gender
            <input type="radio" name="gender" value="male" /> Male
            <input type="radio" name="gender" value="female" /> Female
        </h2>
        <h2>State
            <select name="state_id">
                <?php
                $states = mysqli_query($conn, "SELECT * FROM states ORDER BY state_name");
                while ($state = mysqli_fetch_assoc($states)) {
                    $sid = $state["id"];
                    $sname = $state["state_name"];
                    $selected = ($state_id == $sid) ? "selected" : "";

                    echo '<option value="' . $sid . '" ' . $selected . '>' . $sname . '</option>';
                }
                ?>
            </select>
        </h2>
        <input type="hidden" name="id">
        <input type="submit" name="submit" value="SUBMIT" />
    </form>
<?php


}


if (isset($_GET["task"]) && ($_GET["task"] == "edit")) {
    $id = (int) $_GET["id"];
    $query = "SELECT * FROM users WHERE id=$id";

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $name = $row["name"];
    $age = $row["age"];
    $gender = $row["gender"];
    $state_id = $row["state_id"];
?>
    <form method="post">
        <h2>Name <input type="text" name="name" value="<?php echo $name ?>" /></h2>
        <h2>Age <input type="text" name="age" value="<?php echo $age ?>" /></h2>
        <h2>Gender
            <input type="radio" name="gender" value="male" <?php if ($gender == "male") {
                                                                echo "checked";
                                                            } ?> /> Male
            <input type="radio" name="gender" value="female" <?php if ($gender == "female") {
                                                                    echo "checked";
                                                                } ?> /> Female
        </h2>
        <h2>State
            <select name="state_id">
                <?php
                $states = mysqli_query($conn, "SELECT * FROM states ORDER BY state_name");
                while ($state = mysqli_fetch_assoc($states)) {
                    $sid = $state["id"];
                    $sname = $state["state_name"];
                    $selected = ($state_id == $sid) ? "selected" : "";

                    echo '<option value="' . $sid . '" ' . $selected . '>' . $sname . '</option>';
                }
                ?>
            </select>
        </h2>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" name="submit" value="SUBMIT" />
    </form>
<?php
}
?>

<?php
if (isset($_GET["task"]) && ($_GET["task"] == "delete")) {

    //process the data
    $id = (int) $_GET["id"];
    $query = "DELETE FROM users ";
    $query .= "WHERE id = $id";
    echo $query;
    $status = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if ($status) {
        $msg = "Data deleted successfully";
        header("location:index.php?msg=$msg");
    } else {
        echo "Data could not be delete";
    }
}
?>
<?php
//include database dis-connection file
include_once("disconnect.php");
?>