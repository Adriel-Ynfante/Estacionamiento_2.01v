<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Función para sanitizar entradas
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Verificar si el usuario está logueado a través de cookies
$userId = $_COOKIE['user_id'] ?? null; // Obtén el ID del usuario desde la cookie

if ($userId) {
    // Obtener datos del usuario
    $sql = "SELECT * FROM usuarios WHERE id = :user_id"; // Consulta por ID
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    $datos = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$datos) {
        // Si no se encuentra el usuario, redirigir al login
        header("Location: login_register.php");
        exit();
    }
} else {
    header("Location: login_register.php");
    exit();
}

// Sanitización de entradas para la actualización del perfil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateProfile'])) {
    $telefono = sanitizeInput($_POST['telefono']);
    $direccion = sanitizeInput($_POST['direccion']);

    if ($userId) {
        $updateSql = "UPDATE usuarios SET telefono = :telefono, direccion = :direccion WHERE id = :user_id";
        $updateStmt = $db->prepare($updateSql);
        $updateStmt->bindParam(':telefono', $telefono);
        $updateStmt->bindParam(':direccion', $direccion);
        $updateStmt->bindParam(':user_id', $userId);

        if ($updateStmt->execute()) {
            $_SESSION['success'] = "Perfil actualizado con éxito.";
        } else {
            $_SESSION['error'] = "Error al actualizar el perfil. Intenta nuevamente.";
        }
    }
}

// Manejo de adición de tarjeta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'addCard') {
    $numero = sanitizeInput($_POST['numero']);
    $expiracion = sanitizeInput($_POST['expiracion']);

    if ($userId) {
        $insertCardSql = "INSERT INTO tarjetas (usuario_id, numero, expiracion) VALUES (:user_id, :numero, :expiracion)";
        $insertCardStmt = $db->prepare($insertCardSql);
        $insertCardStmt->bindParam(':user_id', $userId);
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

// Manejo de adición de vehículo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'addVehicle') {
    $marca = sanitizeInput($_POST['marca']);
    $modelo = sanitizeInput($_POST['modelo']);
    $placa = sanitizeInput($_POST['placa']);

    if ($userId) {
        $insertVehicleSql = "INSERT INTO vehiculos (usuario_id, marca, modelo, placa) VALUES (:id_usuario, :marca, :modelo, :placa)";
        $insertVehicleStmt = $db->prepare($insertVehicleSql);
        $insertVehicleStmt->bindParam(':user_id', $userId);
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
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 2 * 1024 * 1024; // 2 MB

    if (in_array($file['type'], $allowedTypes) && $file['size'] <= $maxFileSize) {
        $targetDir = "assets/images/";
        $targetFile = $targetDir . basename($file["name"]);

        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            // Actualizar la ruta de la imagen en la base de datos
            if ($userId) {
                $updatePhotoSql = "UPDATE usuarios SET foto_perfil = :foto WHERE id = :user_id";
                $updatePhotoStmt = $db->prepare($updatePhotoSql);
                $updatePhotoStmt->bindParam(':foto', $targetFile);
                $updatePhotoStmt->bindParam(':user_id', $userId);

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
?>
