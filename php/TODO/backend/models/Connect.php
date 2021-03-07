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
        $conn =  new mysqli($this->config['server'], $this->config['username'], $this->config['password'], $this->config['dbName']) or die("Connection failed: " . mysqli_connect_error());
        return $conn;
    }
}

$conn = new Connect('/../app/config.php');
return $conn->connectDB();
