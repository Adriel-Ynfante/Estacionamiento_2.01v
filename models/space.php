<?php
class Space {
    private $conn;
    public $id;
    public $id_zona;
    public $numero;
    public $disponible;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO Espacios (id_zona, numero, disponible) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->id_zona, $this->numero, $this->disponible]);
    }
}
?>
