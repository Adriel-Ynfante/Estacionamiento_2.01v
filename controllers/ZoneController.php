<?php
require_once 'models/Zone.php';

class ZoneController {
    private $zoneModel;

    public function __construct() {
        $this->zoneModel = new Zone();
    }

    public function index($companyId) {
        $zones = $this->zoneModel->getByCompanyId($companyId);
        include 'views/admin/gestionar_zonas.php';
    }

    public function create($nombre, $ubicacion, $capacidad, $id_empresa, $id_tarifa) {
        if ($this->zoneModel->add($nombre, $ubicacion, $capacidad, $id_empresa, $id_tarifa)) {
            header('Location: /admin/zones');
        } else {
            echo "Error al agregar la zona";
        }
    }
}
?>
