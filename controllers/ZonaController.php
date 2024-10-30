<?php
require_once __DIR__ . '/../models/zona.php';
require_once __DIR__ . '/../models/space.php';
require_once __DIR__ . '/../config/database.php';

class ZoneController {
    public function registerZone() {
        $database = new Database();
        $db = $database->getConnection();

        $zone = new Zone($db);
        
        // Asignar valores desde POST
        $zone->id_empresa = $_POST['id_empresa'] ?? null;
        $zone->nombre = $_POST['nombre'] ?? null;
        $zone->ubicacion = $_POST['ubicacion'] ?? null;
        $zone->capacidad = $_POST['capacidad'] ?? null;
        $zone->latitud = $_POST['latitud'] ?? null;
        $zone->longitud = $_POST['longitud'] ?? null;

        // Validaciones adicionales
        if (!$this->validateZone($  )) {
            echo "Error: Datos de zona inválidos.";
            return;
        }

        if ($zone->create()) {
            // Crear espacios después de que la zona ha sido creada
            $this->createSpaces($zone->id, $zone->capacidad);
            echo "Zona y espacios registrados exitosamente.";
        } else {
            echo "Error al registrar la zona.";
        }
    }

    private function validateZone($zone) {
        // Verificar que id_empresa sea un número válido
        if (!is_numeric($zone->id_empresa) || $zone->id_empresa <= 0) {
            return false;
        }
        // Validar otros atributos en la clase Zone
        return $zone->validateInputs(); // Asegúrate de que este método exista
    }
    

    private function createSpaces($id_zona, $capacidad) {
        $database = new Database();
        $db = $database->getConnection();

        for ($i = 0; $i < $capacidad; $i++) {
            $space = new Space($db);
            $space->id_zona = $id_zona; // Asignar el ID de la zona recién creada
            $space->disponible = true; // Marcar el espacio como disponible

            $space->create(); // Registrar el espacio
        }
    }
}

?>
