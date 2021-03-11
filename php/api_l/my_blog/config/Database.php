<?php
//*DEBUG ERROR REPORTING
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);
//END DEBUG ERROR REPORTING*/
class Database
{
    private $host = 'localhost';
    private $db_name = 'myblog';
    private $uname = 'root';
    private $pass = 'pass123';
    private $conn;

    public function connect()
    {
        $this->conn = null;

        try {

            $this->conn = new PDO(
                "mysql:host=" . $this->host . ';dbname=' . $this->db_name,
                $this->uname,
                $this->pass
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // var_dump($this->conn);

        } catch (PDOException $e) {
            echo 'DB Connection Eroor' . $e->getMessage();
        }
        return $this->conn;
    }
}

$d = new Database();
$d->connect();
