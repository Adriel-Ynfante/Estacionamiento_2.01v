<?php
require_once __DIR__ . '/../models/zona.php';
require_once __DIR__ . '/../config/database.php';

class ZoneController {
    public function registerZone() {
        $database = new Database();
        $db = $database->getConnection();

        $zone = new Zone($db);
        $zone->id_empresa = $_POST['id_empresa'];
        $zone->nombre = $_POST['nombre'];
        $zone->ubicacion = $_POST['ubicacion'];
        $zone->latitud = $_POST['latitud'];
        $zone->longitud = $_POST['longitud'];
        $capacidad = $_POST['capacidad'];

        if ($zone->create()) {
            $this->createSpaces($zone->id, $capacidad);
            echo "Zona y espacios registrados exitosamente.";
        } else {
            echo "Error al registrar la zona.";
        }
    }

    private function createSpaces($id_zona, $capacidad) {
        $database = new Database();
        $db = $database->getConnection();

        for ($i = 1; $i <= $capacidad; $i++) {
            $space = new Space($db);
            $space->id_zona = $id_zona;
            $space->numero = $i;
            $space->disponible = true;
            $space->create();
        }
    }
}
?>
