<?php
require_once 'models/Rate.php';

class RateController {
    private $rateModel;

    public function __construct() {
        $this->rateModel = new Rate();
    }

    public function index() {
        $rates = $this->rateModel->getAll();
        include 'views/admin/gestionar_tarifas.php';
    }

    public function create($tipo_vehiculo, $tipo_reserva, $costo, $id_zona) {
        if ($this->rateModel->add($tipo_vehiculo, $tipo_reserva, $costo, $id_zona)) {
            header('Location: /admin/rates');
        } else {
            echo "Error al agregar la tarifa";
        }
    }
}
?>
