<?php
require_once __DIR__ . '/../models/Company.php';
require_once __DIR__ . '/../config/database.php';

class CompanyController {
    public function registerCompany() {
        $database = new Database();
        $db = $database->getConnection();

        $company = new Company($db);

        // Verifica si 'nombre' y 'descripcion' existen en $_POST
        $company->nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $company->descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;

        // Validar que los datos obligatorios no sean null o estén vacíos
        if ($company->nombre && $company->descripcion) {
            if ($company->create()) {
                echo "Empresa registrada exitosamente.";
            } else {
                echo "Error al registrar la empresa.";
            }
        } else {
            echo "Por favor, complete todos los campos requeridos.";
        }
    }
}
?>
