<?php
class Database {
    private $host = '172.17.0.2';
    private $db = 'paquetes';
    private $user = 'root';
    private $pass = 'root';
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->conn->connect_error) {
            die("Error DB: " . $this->conn->connect_error);
        }
    }
}
?>
