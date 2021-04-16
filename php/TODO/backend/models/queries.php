<?php
// Class for all queries related to task 
class Queries
{
    private $conn;
    private $success = "success", $message = "message";
    // add task to DB
    // Default is Connect.php but can be overridden if required
    // constructor to store db connect variable in class private variable
    public function __construct($connLoc = "/Connect.php")
    {
        $this->conn = require __DIR__ . $connLoc;
    }

    // Add Task in Database
    public function addTask($msg, $description, $isComp, $isFav)
    {

        $stmt = $this->conn->prepare("INSERT INTO tasks(msg, description, isComp, isFav ) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $msg, $description, $isComp, $isFav);
        if ($stmt->execute() === TRUE) {
            $msg = [$this->success => "1", $this->message => "New task added ", "id" =>  $stmt->insert_id];
        } else {
            $msg = [$this->success => "0", $this->message => "Error: "  . "<br>" . $this->conn->error, "id" =>  $stmt->insert_id];
        }
        return $msg;
    }

    // Retrive Tasks from DB and send it to front-end
    public function viewTasks()
    {
        $stmt = "SELECT id,msg,isComp,isFav,description  FROM tasks;";
        $data = $this->conn->query($stmt);
        $result = [];
        foreach ($data as $key => $value) {
            $result[$key] = $value;
        }
        return  $result;
    }

    // Delete a task in DB
    public function deleteTasks($id)
    {
        $stmt = "DELETE FROM tasks where id = $id;";

        if ($this->conn->query($stmt) === TRUE && mysqli_affected_rows($this->conn) !== 0) {
            $msg = [$this->success => "1", $this->message => "Task deleted"];
        } else {
            $errorMsg = $this->conn->error === "" ? "File Not Found!" : $this->conn->error;
            $msg = [$this->success => "0", $this->message => "Error deleting record : " .  $errorMsg];
        }
        return $msg;
    }


    // Edit a Task in DB(Msg or is Checked)
    public function editTask($id, $msg, $description, $isComp, $isFav)
    {

        $stmt = "UPDATE tasks SET msg = '$msg', description='$description', isComp='$isComp', isFav='$isFav' WHERE id=$id;";
        if ($this->conn->query($stmt) === TRUE) {
            $msg = [$this->success => "1", $this->message => "Task updated"];
        } else {
            $msg = [$this->success => "0", $this->message => "Error deleting record: " . $this->conn->error];
        }
        return $msg;
    }

    // Returns if a particular is Checked(completed) or not
    public function loadCheckBoxValue($id, $key)
    {
        $stmt = "SELECT $key FROM tasks where id = $id;";
        $data = $this->conn->query($stmt);
        $result = [];
        foreach ($data as $k => $value) {
            $result[$k] = $value;
        }
        return $result[0];
    }


    // function to perform searching with both filters support (priority only, full text)
    public function search($byPrority, $byTitle, $byDesc)
    {
        $byTitle = addslashes($byTitle);
        $byDesc = addslashes($byDesc);
        $stmt = 'SELECT id,msg,description,isComp,isFav  FROM tasks t where 1 ';
        if ($byTitle !== "") {
            $tokens = implode("* ", explode(" ", $byTitle)) . "*";
            $stmt .= "and MATCH (msg) AGAINST( ' " . $tokens . " ' IN BOOLEAN MODE) ";
        }
        if ($byDesc !== "") {
            $tokens = implode("* ", explode(" ", $byDesc)) . "*";
            $stmt .= "and MATCH (description) AGAINST( ' " . $tokens . " ' IN BOOLEAN MODE) ";
        }

        $stmt .= 'and isFav != ' . $byPrority;
        $data = $this->conn->query($stmt);
        $result = [];
        foreach ($data as $k => $value) {
            $result[$k] = $value;
        }
        return $result;
    }
}
