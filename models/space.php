<?php
class Space {
    private $conn;
    private $table_name = "Espacios";

    public $id;
    public $id_zona;
    public $disponible;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        // Validar que id_zona sea un número válido
        if (empty($this->id_zona) || !is_numeric($this->id_zona) || $this->id_zona <= 0) {
            throw new Exception("Error: ID de zona debe ser un número válido y mayor que cero.");
        }

        // Validar que disponible sea un valor booleano
        if (!is_bool($this->disponible)) {
            throw new Exception("Error: Disponibilidad debe ser un valor booleano (true/false).");
        }

        $query = "INSERT INTO " . $this->table_name . " (id_zona, disponible) VALUES (:id_zona, :disponible)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_zona', $this->id_zona);
        $stmt->bindParam(':disponible', $this->disponible, PDO::PARAM_BOOL);

        return $stmt->execute();
    }

    // Método para actualizar disponibilidad
    public function updateAvailability($id, $availability) {
        // Validar que el ID sea un número válido
        if (empty($id) || !is_numeric($id) || $id <= 0) {
            throw new Exception("Error: ID debe ser un número válido y mayor que cero.");
        }

        // Validar que availability sea un valor booleano
        if (!is_bool($availability)) {
            throw new Exception("Error: Disponibilidad debe ser un valor booleano (true/false).");
        }

        $query = "UPDATE " . $this->table_name . " SET disponible = :disponible WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':disponible', $availability, PDO::PARAM_BOOL);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
}
?>
