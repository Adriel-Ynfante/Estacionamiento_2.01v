<?php
require_once 'Database.php';

class Company {
    private $conn;
    private $table = 'Empresas';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($descripcion) {
        $stmt = $this->conn->prepare("INSERT INTO " . $this->table . " (descripcion, fecha_registro) VALUES (:descripcion, NOW())");
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
