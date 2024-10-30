<?php
class Rate {
    private $conn;
    private $table_name = "Tarifas";

    public $id;
    public $id_zona;
    public $tipo_vehiculo;
    public $tipo_reserva;
    public $costo;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (id_zona, tipo_vehiculo, tipo_reserva, costo)
                  VALUES (:id_zona, :tipo_vehiculo, :tipo_reserva, :costo)";
        
        $stmt = $this->conn->prepare($query);

        // Vincula los valores
        $stmt->bindParam(':id_zona', $this->id_zona);
        $stmt->bindParam(':tipo_vehiculo', $this->tipo_vehiculo);
        $stmt->bindParam(':tipo_reserva', $this->tipo_reserva);
        $stmt->bindParam(':costo', $this->costo);

        // Intenta ejecutar el query
        try {
            if ($stmt->execute()) {
                return true;
            } else {
                // Manejo de error si la ejecución falla
                $errorInfo = $stmt->errorInfo();
                echo "Error al registrar la tarifa: " . $errorInfo[2];
                return false;
            }
        } catch (PDOException $e) {
            // Captura de excepciones de PDO
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
