<?php
class Company {
    private $conn;
    private $table_name = "Empresas";

    public $id;
    public $nombre;
    public $descripcion;
    public $fecha_registro;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para registrar una nueva empresa
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, descripcion=:descripcion";
        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
