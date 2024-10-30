<?php
require_once '../config/database.php';
require_once '../app/models/Zona.php';

class ZonaController {
    private $zonaModel;

    public function __construct() {
        $database = new Database();
        $this->zonaModel = new Zona($database);
    }

    public function registrar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['nombre'];
            $ubicacion = $_POST['ubicacion'];
            $capacidad = $_POST['capacidad'];
            $id_empresa = $_POST['id_empresa'];
            $latitud = $_POST['latitud'];
            $longitud = $_POST['longitud'];

            // Obtener tarifas del formulario
            $tarifas = [
                ['tipo_vehiculo' => 'motocicleta', 'tipo_reserva' => 'hora', 'costo' => $_POST['motocicleta_hora']],
                ['tipo_vehiculo' => 'motocicleta', 'tipo_reserva' => 'dia', 'costo' => $_POST['motocicleta_dia']],
                ['tipo_vehiculo' => 'motocicleta', 'tipo_reserva' => 'semana', 'costo' => $_POST['motocicleta_semana']],
                ['tipo_vehiculo' => 'motocicleta', 'tipo_reserva' => 'mes', 'costo' => $_POST['motocicleta_mes']],
                ['tipo_vehiculo' => 'auto', 'tipo_reserva' => 'hora', 'costo' => $_POST['auto_hora']],
                ['tipo_vehiculo' => 'auto', 'tipo_reserva' => 'dia', 'costo' => $_POST['auto_dia']],
                ['tipo_vehiculo' => 'auto', 'tipo_reserva' => 'semana', 'costo' => $_POST['auto_semana']],
                ['tipo_vehiculo' => 'auto', 'tipo_reserva' => 'mes', 'costo' => $_POST['auto_mes']],
            ];

            if ($this->zonaModel->registrar($nombre, $ubicacion, $capacidad, $id_empresa, $latitud, $longitud, $tarifas)) {
                header("Location: /public/index.php?action=listar_zonas");
            } else {
                echo "Error al registrar la zona y tarifas.";
            }
        }
    }
}
?>


