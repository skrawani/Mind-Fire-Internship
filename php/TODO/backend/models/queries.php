<?php


class Queries
{
    private $conn;
    // add task to DB
    public function __construct($connLoc = "/Connect.php")
    {
        $this->conn = require __DIR__ . $connLoc;
        // var_dump($this->conn);
    }

    public function addTask($msg, $isComp, $isFav)
    {
        $stmt = $this->conn->prepare("INSERT INTO tasks(msg, isComp, isFav) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $msg, $isComp, $isFav);
        if ($stmt->execute() === TRUE) {
            $msg = ["success" => "1", "msg" => "New Record Successfully created", "id" =>  $stmt->insert_id];
        } else {
            $msg = ["success" => "0", "msg" => "Error: "  . "<br>" . $this->conn->error, "id" =>  $stmt->insert_id];
        }
        return json_encode($msg);
    }
    public function viewTasks()
    {
        $stmt = "SELECT * FROM tasks;";
        $data = $this->conn->query($stmt);
        $result = [];
        foreach ($data as $key => $value) {
            $result[$key] = $value;
        }
        return  $result;
    }
    public function deleteTasks($id)
    {
        $stmt = "DELETE FROM tasks where id = $id;";

        if ($this->conn->query($stmt) === TRUE) {
            $msg = ["success" => "1", "msg" => "Record deleted successfully"];
        } else {
            $msg = ["success" => "0", "msg" => "Error deleting record: " . $this->conn->error];
        }
        return json_encode($msg);
    }
    public function editTask($id, $field, $msg)
    {
        $stmt = "UPDATE tasks SET $field='$msg' WHERE id=$id;";
        if ($this->conn->query($stmt) === TRUE) {
            $msg = ["success" => "1", "msg" => "Record successfully Editted"];
        } else {
            $msg = ["success" => "0", "msg" => "Error deleting record: " . $this->conn->error];
        }
        return json_encode($msg);
    }
    public function isComp($id)
    {

        $stmt = "SELECT isComp FROM tasks where id = $id;";
        $data = $this->conn->query($stmt);
        $result = [];
        foreach ($data as $key => $value) {
            $result[$key] = $value;
        }
        return $result[0]['isComp'];
    }
};
