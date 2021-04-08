<?php
// Class for all queries related to task 
class Queries
{
    private $conn;
    // add task to DB
    // Default is Connect.php but can be overridden if required
    // constructor to store db connect variable in class private variable
    public function __construct($connLoc = "/Connect.php")
    {
        $this->conn = require __DIR__ . $connLoc;
    }

    // Add Task in Database
    public function addTask($msg, $isComp, $isFav)
    {
        $defaultDescription = '';
        $stmt = $this->conn->prepare("INSERT INTO tasks(msg, description, isComp, isFav ) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $msg, $defaultDescription, $isComp, $isFav);
        if ($stmt->execute() === TRUE) {
            $msg = ["success" => "1", "message" => "New task added ", "id" =>  $stmt->insert_id];
        } else {
            $msg = ["success" => "0", "message" => "Error: "  . "<br>" . $this->conn->error, "id" =>  $stmt->insert_id];
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

        if ($this->conn->query($stmt) === TRUE) {
            $msg = ["success" => "1", "message" => "Task deleted"];
        } else {
            $msg = ["success" => "0", "message" => "Error deleting record: " . $this->conn->error];
        }
        return $msg;
    }

    // Edit a Task in DB(Msg or is Checked)
    public function editTask($id, $field1, $msg1, $field2 = null, $msg2 = null)
    {
        if ($field2 === null || $msg2 === null)
            $stmt = "UPDATE tasks SET $field1='$msg1' WHERE id=$id;";
        else
            $stmt = "UPDATE tasks SET $field1='$msg1', $field2='$msg2' WHERE id=$id;";

        if ($this->conn->query($stmt) === TRUE) {
            $msg = ["success" => "1", "message" => "Task updated"];
        } else {
            $msg = ["success" => "0", "message" => "Error deleting record: " . $this->conn->error];
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
        return $result[0][$key];
    }


    // function to perform searching with both filters support (priority only, full text)
    public function search($key,  $byPrority = '2', $isFullText = false)
    {
        $key = addslashes($key);

        if (!$isFullText) {
            $stmt = 'SELECT id,msg,description,isComp,isFav  FROM tasks t where (msg like "' . $key . '%" ' .
                'or description like "' . $key . '%")';
        } else {
            $tokens = implode("* ", explode(" ", $key)) . "*";
            $stmt = "SELECT id,msg,description,isComp,isFav FROM  tasks  WHERE MATCH (msg, description) AGAINST( ' " . $tokens . " ' IN BOOLEAN MODE)";
        }

        if ($byPrority != '2') {
            $stmt .= 'and isFav != ' . $byPrority;
        }

        $data = $this->conn->query($stmt);
        $result = [];
        foreach ($data as $k => $value) {
            $result[$k] = $value;
        }
        return $result;
    }
};
