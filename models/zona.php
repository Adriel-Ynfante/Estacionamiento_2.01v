<?php
class Zone {
    private $conn;
    public $id;
    public $id_empresa;
    public $nombre;
    public $ubicacion;
    public $latitud;
    public $longitud;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO Zonas (id_empresa, nombre, ubicacion, latitud, longitud) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->id_empresa, $this->nombre, $this->ubicacion, $this->latitud, $this->longitud]);
        $this->id = $this->conn->lastInsertId();
        return $stmt;
    }
}
?>
