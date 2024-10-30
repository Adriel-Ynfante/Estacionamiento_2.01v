<?php
class Zone {
    private $conn;
    private $table_name = "Zonas";

    public $id;
    public $id_empresa;
    public $nombre;
    public $ubicacion;
    public $capacidad;
    public $latitud;
    public $longitud;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (id_empresa, nombre, ubicacion, capacidad, latitud, longitud)
                  VALUES (:id_empresa, :nombre, :ubicacion, :capacidad, :latitud, :longitud)";
        
        $stmt = $this->conn->prepare($query);

        // Vincula los valores
        $stmt->bindParam(':id_empresa', $this->id_empresa);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':ubicacion', $this->ubicacion);
        $stmt->bindParam(':capacidad', $this->capacidad);
        $stmt->bindParam(':latitud', $this->latitud);
        $stmt->bindParam(':longitud', $this->longitud);

        // Ejecuta el query
        return $stmt->execute();
    }
    public function validateInputs() {
        // Verificar que los campos no estén vacíos
        if (empty($this->id_empresa) || empty($this->nombre) || empty($this->ubicacion) || empty($this->capacidad) || empty($this->latitud) || empty($this->longitud)) {
            return false;
        }
    
        // Validar capacidad (debe ser un número entero positivo)
        if (!is_numeric($this->capacidad) || $this->capacidad <= 0) {
            return false;
        }
    
        // Validar latitud y longitud
        if (!is_numeric($this->latitud) || !is_numeric($this->longitud) || $this->latitud < -90 || $this->latitud > 90 || $this->longitud < -180 || $this->longitud > 180) {
            return false;
        }
    
        return true; // Todo está bien
    }
    
}

?>
