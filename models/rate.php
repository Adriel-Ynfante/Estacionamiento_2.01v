<?php
require_once 'Database.php';

class Rate {
    private $conn;
    private $table = 'Tarifas';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($tipo_vehiculo, $tipo_reserva, $costo, $id_zona) {
        $stmt = $this->conn->prepare("INSERT INTO " . $this->table . " (tipo_vehiculo, tipo_reserva, costo, id_zona) VALUES (:tipo_vehiculo, :tipo_reserva, :costo, :id_zona)");
        $stmt->bindParam(':tipo_vehiculo', $tipo_vehiculo, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_reserva', $tipo_reserva, PDO::PARAM_STR);
        $stmt->bindParam(':costo', $costo);
        $stmt->bindParam(':id_zona', $id_zona, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
