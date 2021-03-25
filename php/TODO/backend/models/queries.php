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
            $msg = ["success" => "1", "msg" => "New Record Successfully created", "id" =>  $stmt->insert_id];
        } else {
            $msg = ["success" => "0", "msg" => "Error: "  . "<br>" . $this->conn->error, "id" =>  $stmt->insert_id];
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
            $msg = ["success" => "1", "msg" => "Record deleted successfully"];
        } else {
            $msg = ["success" => "0", "msg" => "Error deleting record: " . $this->conn->error];
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
            $msg = ["success" => "1", "msg" => "Record successfully Editted"];
        } else {
            $msg = ["success" => "0", "msg" => "Error deleting record: " . $this->conn->error];
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
    public function searchNormal($key,  $byPrority = '2')
    {
        $stmt = 'SELECT id,msg,description,isComp,isFav  FROM tasks t where (msg like "' . $key . '%" ' .
            'or description like "' . $key . '%") and isFav != ' . $byPrority  . ' order by isFav != ' . '1 , id;';

        // return $stmt;
        $data = $this->conn->query($stmt);
        $result = [];
        foreach ($data as $k => $value) {
            $result[$k] = $value;
        }
        return $result;
    }
};
