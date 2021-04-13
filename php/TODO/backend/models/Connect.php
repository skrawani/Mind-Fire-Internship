<?php
// Create connection
class Connect
{
    private $config;
    public function __construct($configLoc)
    {
        $this->config = require __DIR__ . $configLoc;
    }

    public function connectDB()
    {
        try {
            if ($conn =  new mysqli($this->config['server'], $this->config['username'], $this->config['password'], $this->config['dbName'])) {
            } else {
                throw new Exception('Unable to connect');
            }
        } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(array("message" =>  $e->getMessage(), "code" => $e->getCode()));
        }
        return $conn;
    }
}

$conn = new Connect('/../../app/config.php');
return $conn->connectDB();
