<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'Parking';
    private $username = 'root';
    private $password = '';
    public $conn;
    public $connectionMessage; // Variable para el mensaje de conexión

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name};charset=utf8", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connectionMessage = "Conexión exitosa."; // Mensaje de conexión exitosa
        } catch (PDOException $exception) {
            throw new Exception("Error de conexión: " . $exception->getMessage());
        }
        return $this->conn;
    }
}
