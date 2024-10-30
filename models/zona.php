<?php
class Zona {
    private $conn;
    private $table_name = "zonas";

    public function __construct($db) {
        $this->conn = $db;
    }
    public function obtenerZonasConUbicacion() {
        $query = "SELECT id, nombre, latitud, longitud FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar($nombre, $ubicacion, $capacidad, $id_empresa, $latitud, $longitud, $tarifas) {
        // Insertar la zona
        $query = "INSERT INTO " . $this->table_name . " (nombre, ubicacion, capacidad, id_empresa, latitud, longitud) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nombre, $ubicacion, $capacidad, $id_empresa, $latitud, $longitud]);
        $zona_id = $this->conn->lastInsertId();

        // Insertar tarifas
        foreach ($tarifas as $tarifa) {
            $query = "INSERT INTO Tarifas (id_zona, tipo_vehiculo, tipo_reserva, costo) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$zona_id, $tarifa['tipo_vehiculo'], $tarifa['tipo_reserva'], $tarifa['costo']]);
        }

        return true;
    }
}
?>
