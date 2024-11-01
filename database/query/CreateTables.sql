CREATE DATABASE Parking;
USE Parking;

CREATE TABLE Usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(250),
    apellido VARCHAR(250),
    telefono VARCHAR(12),
    email VARCHAR(250) UNIQUE,
    direccion VARCHAR(60),
    password VARCHAR(250),
    tipo_usuario ENUM('usuario', 'administrador') NOT NULL,
    foto_perfil VARCHAR(255),
    token VARCHAR(40),
    token_password VARCHAR(40),
    password_request INT,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Vehiculos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    placa VARCHAR(20) UNIQUE,
    tipo ENUM('motocicleta', 'auto') NOT NULL,
    id_usuario INT,
    modelo VARCHAR (60),
    marca VARCHAR (60),
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id)
);

CREATE TABLE Empresas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(250),
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Tarifas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_zona INT,  -- Llave foránea para asociar la tarifa con una zona específica
    tipo_vehiculo ENUM('motocicleta', 'auto') NOT NULL,
    tipo_reserva ENUM('hora', 'dia', 'semana', 'mes') NOT NULL,
    costo DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_zona) REFERENCES Zonas(id)
);

CREATE TABLE Zonas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_empresa INT,
    nombre VARCHAR(250),
    ubicacion VARCHAR(250),
    latitud DECIMAL(10, 8),
    longitud DECIMAL(11, 8),
    FOREIGN KEY (id_empresa) REFERENCES Empresas(id)
);

CREATE TABLE Espacios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_zona INT,
    numero INT,
    disponible BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_zona) REFERENCES Zonas(id)
);

CREATE TABLE Reservas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    fecha_inicio DATETIME,
    fecha_fin DATETIME,
    duracion INT,
    fecha_reserva DATETIME,
    estado_reserva ENUM('pendiente', 'confirmado', 'cancelado') NOT NULL,
    total_costo DECIMAL(10,2) NOT NULL,
    id_vehiculo INT,
    id_espacio INT,
    id_usuario INT,
    FOREIGN KEY (id_vehiculo) REFERENCES Vehiculos(id),
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id),
    FOREIGN KEY (id_espacio) REFERENCES Espacios(id)
);

CREATE TABLE TARJETAS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    numero_tarjeta VARCHAR(16) NOT NULL,  -- Solo los últimos 4 dígitos de la tarjeta
    fecha_expiracion DATE NOT NULL,
    tipo_tarjeta ENUM('Visa', 'MasterCard', 'Amex', 'Otro') NOT NULL,
    id_usuario INT,
    token VARCHAR(255),  -- Token generado por el proveedor de pagos
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id)
);

CREATE TABLE Pagos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    monto DECIMAL(10,2) NOT NULL,
    metodo_pago ENUM('paypal', 'tarjeta_credito') NOT NULL,
    id_reserva INT,
    id_tarjeta INT,
    fecha_pago DATE,
    FOREIGN KEY (id_reserva) REFERENCES Reservas(id),
    FOREIGN KEY (id_tarjeta) REFERENCES TARJETAS(id),
);