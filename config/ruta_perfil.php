<?php
session_start();
require_once './database.php'; // Asegúrate de incluir tu clase de conexión a la base de datos

// Conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Obtener datos del usuario usando el correo electrónico
$email = $_SESSION['email'] ?? null;
if ($email) {
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $datos = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Redirigir si no hay sesión activa
    header("Location: login_register.php");
    exit();
}

// Función para sanitizar la entrada
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Manejo de actualización del perfil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateProfile'])) {
    $telefono = sanitizeInput($_POST['telefono']);
    $direccion = sanitizeInput($_POST['direccion']);

    if ($email) {
        $updateSql = "UPDATE usuarios SET telefono = :telefono, direccion = :direccion WHERE email = :email";
        $updateStmt = $db->prepare($updateSql);
        $updateStmt->bindParam(':telefono', $telefono);
        $updateStmt->bindParam(':direccion', $direccion);
        $updateStmt->bindParam(':email', $email);

        if ($updateStmt->execute()) {
            $_SESSION['success'] = "Perfil actualizado con éxito.";
        } else {
            $_SESSION['error'] = "Error al actualizar el perfil. Intenta nuevamente.";
        }
    }
}

// Manejo de agregar tarjeta de crédito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'addCard') {
    $numero = sanitizeInput($_POST['numero']);
    $expiracion = sanitizeInput($_POST['expiracion']);

    if ($email) {
        $insertCardSql = "INSERT INTO tarjetas (usuario_id, numero, expiracion) VALUES ((SELECT id FROM usuarios WHERE email = :email), :numero, :expiracion)";
        $insertCardStmt = $db->prepare($insertCardSql);
        $insertCardStmt->bindParam(':email', $email);
        $insertCardStmt->bindParam(':numero', $numero);
        $insertCardStmt->bindParam(':expiracion', $expiracion);

        if ($insertCardStmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Tarjeta añadida con éxito.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al añadir la tarjeta.']);
        }
    }
    exit();
}

// Manejo de agregar vehículo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'addVehicle') {
    $marca = sanitizeInput($_POST['marca']);
    $modelo = sanitizeInput($_POST['modelo']);
    $placa = sanitizeInput($_POST['placa']);

    if ($email) {
        $insertVehicleSql = "INSERT INTO vehiculos (usuario_id, marca, modelo, placa) VALUES ((SELECT id FROM usuarios WHERE email = :email), :marca, :modelo, :placa)";
        $insertVehicleStmt = $db->prepare($insertVehicleSql);
        $insertVehicleStmt->bindParam(':email', $email);
        $insertVehicleStmt->bindParam(':marca', $marca);
        $insertVehicleStmt->bindParam(':modelo', $modelo);
        $insertVehicleStmt->bindParam(':placa', $placa);

        if ($insertVehicleStmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Vehículo añadido con éxito.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al añadir el vehículo.']);
        }
    }
    exit();
}

// Manejo de carga de foto de perfil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
    $file = $_FILES['foto'];

    // Validar tipo y tamaño del archivo
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 2 * 1024 * 1024; // 2 MB

    if (in_array($file['type'], $allowedTypes) && $file['size'] <= $maxFileSize) {
        $targetDir = "assets/images/"; // Asegúrate de que esta carpeta tenga permisos de escritura
        $targetFile = $targetDir . basename($file["name"]);

        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            // Actualiza la ruta de la imagen en la base de datos
            if ($email) {
                $updatePhotoSql = "UPDATE usuarios SET foto_perfil = :foto WHERE email = :email";
                $updatePhotoStmt = $db->prepare($updatePhotoSql);
                $updatePhotoStmt->bindParam(':foto', $targetFile);
                $updatePhotoStmt->bindParam(':email', $email);

                if ($updatePhotoStmt->execute()) {
                    echo json_encode(['success' => true, 'foto' => $targetFile]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar la base de datos.']);
                }
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al mover el archivo.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Archivo no válido o demasiado grande.']);
    }
    exit();
}
