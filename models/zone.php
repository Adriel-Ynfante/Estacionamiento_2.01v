<?php
require_once 'Database.php';

class Zone {
    private $conn;
    private $table = 'Zonas';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getByCompanyId($companyId) {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE id_empresa = :id_empresa");
        $stmt->bindParam(':id_empresa', $companyId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($nombre, $ubicacion, $capacidad, $id_empresa, $id_tarifa) {
        $stmt = $this->conn->prepare("INSERT INTO " . $this->table . " (nombre, ubicacion, capacidad, id_empresa, id_tarifa) VALUES (:nombre, :ubicacion, :capacidad, :id_empresa, :id_tarifa)");
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':ubicacion', $ubicacion, PDO::PARAM_STR);
        $stmt->bindParam(':capacidad', $capacidad, PDO::PARAM_INT);
        $stmt->bindParam(':id_empresa', $id_empresa, PDO::PARAM_INT);
        $stmt->bindParam(':id_tarifa', $id_tarifa, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
