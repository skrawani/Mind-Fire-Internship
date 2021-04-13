<?php
// import Queries and Return Data Class
include_once("../models/queries.php");
include_once("../utils/ReturnData.php");

// Class to Provide all services of Tasks
class TaskServices
{
    private $queryObj, $returnObj;

    // Set Private variables of Class
    public function __construct()
    {
        $this->queryObj = new Queries();
        $this->returnObj = new ReturnData();
    }

    // Private helper Function to send resp to send function(ReturnData Class)  
    private function helperSend(array $resp, int $successCode, int $errorCode)
    {
        if ($resp['success'] === '1') {
            $this->returnObj->send($successCode, $resp);
        } else {
            $this->returnObj->send($errorCode, $resp);
        }
    }

    // Service Function to add task 
    public function addTask($postVars)
    {
        $resp =  $this->queryObj->addTask($postVars['task'], $postVars['description'], $postVars['isComp'],  $postVars['isFav']);
        $this->helperSend($resp, 201, 400);
    }

    // Service Function to delete task 
    public function deleteTask($postVars)
    {
        $resp =  $this->queryObj->deleteTasks($postVars['id']);
        $this->helperSend($resp, 200, 400);
    }
    // Service Function to edit task 
    public function editTask($postVars)
    {
        $resp =  $this->queryObj->editTask($postVars['id'], $postVars['task'], $postVars['description'], $postVars['isComp'],  $postVars['isFav']);
        $this->helperSend($resp, 200, 400);
    }

    // Service Function to load All Tasks
    public function loadTasks()
    {
        $resp =  $this->queryObj->viewTasks();
        $this->returnObj->send(200, $resp);
    }

    // Setvice Function for Searching
    public function search($postVars)
    {
        $resp =  $this->queryObj->search($_POST["byPriority"], $_POST["byTitle"], $_POST["byDesc"]);
        $this->returnObj->send(200, $resp);
    }
}
