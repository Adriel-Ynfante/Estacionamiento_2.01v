<?php
require_once __DIR__ . '/../models/Space.php';
require_once __DIR__ . '/../config/database.php';

class SpaceController {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function occupySpace($space_id) {
        $space = new Space($this->conn);
        if ($space->updateAvailability($space_id, false)) { // Cambiar a false para ocupar
            echo "Espacio ocupado.";
        } else {
            echo "Error al ocupar el espacio.";
        }
    }

    public function freeSpace($space_id) {
        $space = new Space($this->conn);
        if ($space->updateAvailability($space_id, true)) { // Cambiar a true para liberar
            echo "Espacio liberado.";
        } else {
            echo "Error al liberar el espacio.";
        }
    }
}
?>
