<?php
require_once __DIR__ . '/../models/zona.php';
require_once __DIR__ . '/../config/database.php';

class ZoneController {
    public function registerZone() {
        // Verificar que los campos requeridos existan y no estén vacíos
        if (
            empty($_POST['id_empresa']) ||
            empty($_POST['nombre']) ||
            empty($_POST['ubicacion']) ||
            empty($_POST['latitud']) ||
            empty($_POST['longitud']) ||
            empty($_POST['capacidad'])
        ) {
            echo "Error: Todos los campos son obligatorios.";
            return;
        }

        // Validar que ciertos campos sean numéricos
        if (!is_numeric($_POST['id_empresa']) || !is_numeric($_POST['capacidad'])) {
            echo "Error: ID de empresa y capacidad deben ser numéricos.";
            return;
        }

        // Validar latitud y longitud
        if (!is_numeric($_POST['latitud']) || !is_numeric($_POST['longitud'])) {
            echo "Error: Latitud y longitud deben ser valores numéricos.";
            return;
        }

        // Validar que la capacidad sea un número positivo
        if ((int)$_POST['capacidad'] <= 0) {
            echo "Error: La capacidad debe ser un número positivo.";
            return;
        }

        // Conexión a la base de datos
        $database = new Database();
        $db = $database->getConnection();

        $zone = new Zone($db);
        $zone->id_empresa = $_POST['id_empresa'];
        $zone->nombre = $_POST['nombre'];
        $zone->ubicacion = $_POST['ubicacion'];
        $zone->latitud = $_POST['latitud'];
        $zone->longitud = $_POST['longitud'];
        $capacidad = $_POST['capacidad'];

        // Intentar crear la zona y los espacios asociados
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
