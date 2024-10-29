<?php
require_once 'models/Company.php';

class CompanyController {
    private $companyModel;

    public function __construct() {
        $this->companyModel = new Company();
    }

    public function index() {
        $companies = $this->companyModel->getAll();
        include 'views/admin/gestionar_empresas.php';
    }

    public function create($descripcion) {
        if ($this->companyModel->add($descripcion)) {
            header('Location: /admin/companies');
        } else {
            echo "Error al agregar la empresa";
        }
    }

    public function delete($id) {
        if ($this->companyModel->delete($id)) {
            header('Location: /admin/companies');
        } else {
            echo "Error al eliminar la empresa";
        }
    }
}
?>
