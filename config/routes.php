<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Connection to the database
$database = new Database();
$db = $database->getConnection();

// Function to sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Function to determine if an email is a business email
function isBusinessEmail($email) {
    $businessDomains = ['empresa.com', 'edu.pe']; // Domains considered as business
    $domain = substr(strrchr($email, "@"), 1); // Extracts the domain from the email
    return in_array($domain, $businessDomains);
}

// Registration handling
if (isset($_POST['registrar'])) {
    $nombreUsuario = sanitizeInput($_POST['userReg']);
    $correo = sanitizeInput($_POST['emailReg']);
    $contrasena = password_hash(sanitizeInput($_POST['passwordReg']), PASSWORD_DEFAULT);

    // Determine the user's role
    $rol = isBusinessEmail($correo) ? 'administrador' : 'usuario';

    $sql = "INSERT INTO usuarios (nombre, email, password, tipo_usuario) VALUES (:nombre, :email, :password, :tipo_usuario)";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':nombre', $nombreUsuario);
    $stmt->bindParam(':email', $correo);
    $stmt->bindParam(':password', $contrasena);
    $stmt->bindParam(':tipo_usuario', $rol);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Bienvenido, $nombreUsuario! Registro exitoso.";

        // Get the last inserted user ID
        $userId = $db->lastInsertId(); // Use lastInsertId directly if using PDO

        // Set cookies for user data
        setcookie('user_id', $userId, time() + (86400 * 30), "/"); // 30 días
        setcookie('user_name', $nombreUsuario, time() + (86400 * 30), "/");
        setcookie('user_email', $correo, time() + (86400 * 30), "/");
        setcookie('user_role', $rol, time() + (86400 * 30), "/");

        header("Location: home.php");
        exit();
    } else {
        $_SESSION['error'] = "Error al registrar. Intenta nuevamente.";
    }
}

// Login handling
if (isset($_POST['login'])) {
    $correoLogin = sanitizeInput($_POST['emailLogin']);
    $contrasenaLogin = sanitizeInput($_POST['passwordLogin']);

    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $correoLogin);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($contrasenaLogin, $usuario['password'])) {
            // Regenerate session ID to prevent session fixation
            session_regenerate_id(true);
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
            $_SESSION['success'] = "Inicio de sesión exitoso.";

            // Set cookies for user data
            setcookie('user_id', $usuario['id'], time() + (86400 * 30), "/");
            setcookie('user_name', $usuario['nombre'], time() + (86400 * 30), "/");
            setcookie('user_email', $usuario['email'], time() + (86400 * 30), "/");
            setcookie('user_role', $usuario['tipo_usuario'], time() + (86400 * 30), "/");

            header("Location: home.php");
            exit();
        } else {
            $_SESSION['error'] = "Contraseña incorrecta.";
        }
    } else {
        $_SESSION['error'] = "Correo no encontrado.";
    }
}
