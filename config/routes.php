<?php
session_start();
require_once 'database.php'; // conexión a la base de datos

// Función para sanitizar la entrada
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Función para determinar si un correo es de empresa
function isBusinessEmail($email) {
    $businessDomains = ['empresa.com', 'edu.pe']; // dominios que se consideran de empresa
    $domain = substr(strrchr($email, "@"), 1); // Obtiene el dominio del correo
    return in_array($domain, $businessDomains);
}

// Manejo del registro
if (isset($_POST['registrar'])) {
    $nombreUsuario = sanitizeInput($_POST['userReg']);
    $correo = sanitizeInput($_POST['emailReg']);
    $contrasena = sanitizeInput($_POST['passwordReg']);

    // Determina si el usuario es administrador
    $rol = isBusinessEmail($correo) ? 'usuario' : 'administrador';

    // Conexión a la base de datos
    $database = new Database();
    $db = $database->getConnection();

    // Insertar usuario en la base de datos
    $sql = "INSERT INTO usuarios (nombre, email, password, tipo_usuario) VALUES (:nombre, :email, :password, :tipo_usuario)";
    $stmt = $db->prepare($sql);

    // Bind de parámetros
    $stmt->bindParam(':nombre', $nombreUsuario);
    $stmt->bindParam(':email', $correo);
    $stmt->bindParam(':password', $contrasena);
    $stmt->bindParam(':tipo_usuario', $rol); // Añade el rol al bind

    // Intentar ejecutar la consulta
    if ($stmt->execute()) {
        // Guardar el mensaje de éxito en la sesión
        $_SESSION['success'] = "Bienvenido, $nombreUsuario! Registro exitoso.";
        header("Location: home.php"); // Redirigir a la página de perfil
        exit();
    } else {
        $_SESSION['error'] = "Error al registrar. Intenta nuevamente.";
    }
}

// Manejo del inicio de sesión
if (isset($_POST['login'])) {
    $correoLogin = sanitizeInput($_POST['emailLogin']);
    $contrasenaLogin = sanitizeInput($_POST['passwordLogin']);

    // Conexión a la base de datos
    $database = new Database();
    $db = $database->getConnection();

    // Buscar el usuario en la base de datos
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $correoLogin);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verificar la contraseña directamente
        if ($contrasenaLogin === $usuario['password']) { // Comparación directa
            $_SESSION['user_id'] = $usuario['id']; // Suponiendo que tienes un campo 'id'
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario']; // Guardar el rol en la sesión
            $_SESSION['success'] = "Inicio de sesión exitoso.";
            header("Location: home.php"); // Redirigir a una página de éxito
            exit();
        } else {
            $_SESSION['error'] = "Contraseña incorrecta.";
        }
    } else {
        $_SESSION['error'] = "Correo no encontrado.";
    }
}
