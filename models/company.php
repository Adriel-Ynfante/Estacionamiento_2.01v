<?php
class Company {
    private $conn;
    private $table = 'Empresas';

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function registrarEmpresa($nombre, $descripcion) {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (nombre, descripcion, fecha_registro) VALUES (?, ?, NOW())");
        return $stmt->execute([$nombre, $descripcion]);
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
