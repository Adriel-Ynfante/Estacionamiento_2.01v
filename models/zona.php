<?php
session_start();
require_once './config/database.php'; // Asegúrate de incluir tu clase de conexión a la base de datos

// Conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

class Zona {
    private $conn;
    private $table_name = "zonas";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todas las zonas con ubicación
    public function obtenerZonasConUbicacion() {
        $query = "SELECT id, nombre, latitud, longitud FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Registrar una nueva zona y sus tarifas
    public function registrar($nombre, $ubicacion, $capacidad, $id_empresa, $latitud, $longitud, $tarifas) {
        try {
            // Iniciar la transacción
            $this->conn->beginTransaction();

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

            // Confirmar la transacción
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $this->conn->rollBack();
            error_log("Error al registrar la zona: " . $e->getMessage()); // Registrar el error
            return false; // Devolver falso en caso de fallo
        }
    }
}
