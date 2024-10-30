<?php
require_once __DIR__ . '/../models/Rate.php';
require_once __DIR__ . '/../config/database.php';

class RateController {
    public function registerRate() {
        $database = new Database();
        $db = $database->getConnection();

        $rate = new Rate($db);

        // Asignar los valores desde el formulario
        $rate->id_zona = isset($_POST['id_zona']) ? trim($_POST['id_zona']) : null;
        $rate->tipo_vehiculo = isset($_POST['tipo_vehiculo']) ? trim($_POST['tipo_vehiculo']) : null;
        $rate->tipo_reserva = isset($_POST['tipo_reserva']) ? trim($_POST['tipo_reserva']) : null;
        $rate->costo = isset($_POST['costo']) ? trim($_POST['costo']) : null;

        // Validar que todos los datos necesarios estén completos
        if (empty($rate->id_zona) || !is_numeric($rate->id_zona)) {
            echo "Error: ID de zona debe ser un número válido.";
            return;
        }

        if (empty($rate->tipo_vehiculo)) {
            echo "Error: Debe seleccionar un tipo de vehículo.";
            return;
        }

        if (empty($rate->tipo_reserva)) {
            echo "Error: Debe seleccionar un tipo de reserva.";
            return;
        }

        if (empty($rate->costo) || !is_numeric($rate->costo) || floatval($rate->costo) < 0) {
            echo "Error: Costo debe ser un número positivo.";
            return;
        }

        // Intentar crear la tarifa
        if ($rate->create()) {
            echo "Tarifa registrada exitosamente.";
        } else {
            echo "Error al registrar la tarifa.";
        }
    }
}
?>
