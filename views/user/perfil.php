<?php
include '../../config/ruta_perfil.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="/assets/css/user_perfil.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>
    <div class="container">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <span class="menu-title">Menú</span>
                <button id="toggleSidebar" class="toggle-sidebar" aria-label="Alternar menú">
                    <i data-lucide="menu"></i>
                </button>
            </div>
            <ul class="sidebar-menu">
                <li><i data-lucide="user"></i> <span>Perfil</span></li>
                <li><i data-lucide="settings"></i> <span>Configuración</span></li>
                <li><i data-lucide="log-out"></i> <span>Cerrar Sesión</span></li>
            </ul>
        </nav>
        
        <main class="content">
            <div class="card profile-card">
                <div class="profile-left">
                <div class="profile-picture" id="profilePicture">
                    <img src="../../assets/images/goku_perfil.jpg" alt="Avatar de usuario" class="default-avatar" />
                </div>
                <input type="file" id="profileImage" name="profileImage" accept="image/*" />
                    <button id="editProfileBtn" class="btn">Editar Perfil</button>
                </div>
                <div class="profile-right">
                    <h2>Perfil de Usuario</h2>
                    <form id="profileForm" method="POST" action="">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($datos['nombre']); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($datos['email']); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="tel" id="telefono" name="telefono" value="<?php echo htmlspecialchars($datos['telefono'] ?? ''); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <textarea id="direccion" name="direccion" disabled><?php echo htmlspecialchars($datos['direccion'] ?? ''); ?></textarea>
                            </div>
                        </div>
                        <button type="submit" name="updateProfile" class="btn save-btn" style="display: none;">Guardar Cambios</button>
                    </form>
                </div>
            </div>

            <div class="card-grid">
                <div class="card">
                    <h2>Tarjetas de Crédito <button id="addCardBtn" class="btn-icon" aria-label="Agregar tarjeta"><i data-lucide="plus-circle"></i></button></h2>
                    <div id="cardList"></div>
                    <form id="addCardForm" style="display: none;">
                        <input type="text" name="numero" placeholder="Número de tarjeta" required>
                        <input type="text" name="expiracion" placeholder="MM/AA" required>
                        <button type="submit" class="btn">Agregar Tarjeta</button>
                    </form>
                </div>
                <div class="card">
                    <h2>Vehículos <button id="addVehicleBtn" class="btn-icon" aria-label="Agregar vehículo"><i data-lucide="plus-circle"></i></button></h2>
                    <div id="vehicleList"></div>
                    <form id="addVehicleForm" style="display: none;">
                        <input type="text" name="marca" placeholder="Marca" required>
                        <input type="text" name="modelo" placeholder="Modelo" required>
                        <input type="text" name="placa" placeholder="Placa" required>
                        <button type="submit" class="btn">Agregar Vehículo</button>
                    </form>
                </div>
            </div>

            <div class="card settings-card">
                <h2>Configuraciones</h2>
                <div class="settings-content">
                    <div class="setting-item">
                        <div class="setting-label">
                            <i data-lucide="lock"></i>
                            <span>Contraseña</span>
                            <button class="btn-outline">Cambiar</button>
                        </div>
                        <div class="group">
                            <input class="input" type="password" placeholder="Nueva contraseña">
                        </div>
                    </div>
                    <div class="setting-item">
                        <label for="notificaciones" class="setting-label">
                            <i data-lucide="bell"></i>
                            <span>Recibir notificaciones</span>
                            <label>
                                <input type="checkbox" class="input" id="notificaciones">
                                <span class="custom-checkbox"></span>
                            </label>
                        </label>
                    </div>
                    <div class="setting-item">
                        <label for="terminos" class="setting-label">
                            <i data-lucide="file-text"></i>
                            <span>Acepto los términos y condiciones</span>
                            <label>
                                <input type="checkbox" class="input" id="terminos">
                                <span class="custom-checkbox"></span>
                            </label>
                        </label>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="/assets/js/user_perfil.js"></script>
</body>
</html>
