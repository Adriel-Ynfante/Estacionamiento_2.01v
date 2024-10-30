<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Company.php';

class CompanyController {
    private $companyModel;

    public function __construct() {
        $database = new Database();
        $this->companyModel = new Company($database->getConnection());
    }

    public function index() {
        $companies = $this->companyModel->getAll();
    return $companies; // Asegúrate de retornar las empresas
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
    
            if ($this->companyModel->registrarEmpresa($nombre, $descripcion)) {
                header("Location: /Parking/views/admin/gestionar_empresas.php?success=1");
            } else {
                header("Location: /Parking/views/admin/gestionar_empresas.php?error=1");
            }
            exit;
        }
    }
    

    public function delete($id) {
        if ($this->companyModel->delete($id)) {
            header('Location: /admin/companies?deleted=1');
        } else {
            echo "Error al eliminar la empresa";
        }
    }
}
?>
