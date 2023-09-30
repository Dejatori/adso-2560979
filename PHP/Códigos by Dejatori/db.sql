--Código para la base de datos "Prueba-login" en MySQL

-- Creación de la base de datos

CREATE DATABASE IF NOT EXISTS `Prueba-login` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `Prueba-login`;

-- Creación de las tablas

-- Tabla de administradores

CREATE TABLE administradores (
    ID_Administrador INT NOT NULL AUTO_INCREMENT,
    Usuario VARCHAR(150) NOT NULL UNIQUE,
    Clave CHAR(60) NOT NULL,
    Correo VARCHAR(150) NOT NULL UNIQUE,
    Tipo_Usuario ENUM('Desarrollador', 'Administrador CEO') NOT NULL DEFAULT 'Administrador CEO',
    Fecha_Creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Ultimo_inicio_sesion DATETIME DEFAULT NULL,
    Inicio_sesion_actual DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID_Administrador, Tipo_Usuario),
    INDEX idx_administradores_usuario (Usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creación de 2 adminsitradores

INSERT INTO administradores (Usuario, Clave, Correo, Tipo_Usuario) VALUES ('Administrador', '$1y$10_TxT', 'admin@adso.com', 'Administrador CEO'), ('Dejatori', '$2y$10_TxT', 'dejatori@adso.com', 'Desarrollador');

-- Tabla de soporte

CREATE TABLE soporte (
    ID_Soporte INT NOT NULL AUTO_INCREMENT,
    Usuario VARCHAR(150) NOT NULL UNIQUE,
    Clave CHAR(60) NOT NULL,
    Correo VARCHAR(150) NOT NULL UNIQUE,
    Tipo_Usuario ENUM('Soporte correos', 'Soporte técnico', 'Soporte de prueba') NOT NULL DEFAULT 'Soporte de prueba',
    Fecha_Creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Ultimo_inicio_sesion DATETIME DEFAULT NULL,
    Inicio_sesion_actual DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID_Soporte, Tipo_Usuario),
    INDEX idx_soporte_usuario (Usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creación de 3 soportes

INSERT INTO soporte (Usuario, Clave, Correo, Tipo_Usuario) VALUES ('Soporte1', '$3y$10_TxT', 'soporte1@adso.com', 'Soporte correos'), ('Soporte2', '$4y$10_TxT', 'soporte2@adso.com', 'Soporte técnico'), ('Soporte3', '$5y$10_TxT', 'soporte3@adso.com', 'Soporte de prueba');

-- Tabla de usuarios

CREATE TABLE usuarios (
    ID_Usuario INT NOT NULL AUTO_INCREMENT,
    Cod_Usuario VARCHAR(10) NOT NULL UNIQUE,
    Nombre VARCHAR(200) NOT NULL,
    Apellido VARCHAR(200) NOT NULL,
    Correo VARCHAR(150) NOT NULL UNIQUE,
    Clave CHAR(60) NOT NULL,
    Tipo_Doc_Identidad ENUM('CC', 'DNI', 'CI', 'CURP', 'DPI', 'DUI', 'CIE', 'CIC', 'CIP', 'ID') NOT NULL,
    Doc_Identidad VARCHAR(30) NOT NULL UNIQUE,
    Fecha_Nacimiento DATE NOT NULL,
    Tipo_Usuario ENUM('Usuario', 'Usuario_verificado') DEFAULT 'Usuario' NOT NULL,
    Fecha_De_Registro DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (ID_Usuario, Tipo_Usuario),
    INDEX idx_usuarios_correo (Correo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creación de 5 usuarios

INSERT INTO usuarios (Cod_Usuario, Nombre, Apellido, Correo, Clave, Tipo_Doc_Identidad, Doc_Identidad, Fecha_Nacimiento, Tipo_Usuario) 
VALUES 
 ('COD-00001', 'Usuario', 'Uno', 'usuario1@adso.com', '$6y$10_TxT', 'CC', '123456789', '1990-01-01', 'Usuario'),
 ('COD-00002', 'Usuario', 'Dos', 'usuario2@adso.com', '$7y$10_TxT', 'CC', '987654321', '1990-01-02', 'Usuario'),
 ('COD-00003', 'Usuario', 'Tres', 'usuario3@adso.com', '$8y$10_TxT', 'CC', '123456789', '1990-01-03', 'Usuario'),
 ('COD-00004', 'Usuario', 'Cuatro', 'usuario4@adso.com', '$9y$10_TxT', 'CC', '987654321', '1990-01-04', 'Usuario'),
 ('COD-00005', 'Usuario', 'Cinco', 'usuario5@adso.com', '$10y$10_TxT', 'CC', '123456789', '1990-01-05', 'Usuario');

-- Disparador para el código de usuario

DELIMITER $$
CREATE TRIGGER before_insert_usuarios
BEFORE INSERT ON usuarios
FOR EACH ROW
BEGIN
    DECLARE next_val INT;
    SET next_val = (SELECT MAX(RIGHT(Cod_Usuario, 5)) + 1 FROM usuarios WHERE ID_Afiliado LIKE 'COD-%');
    IF next_val IS NULL THEN
        SET next_val = 10000;
    END IF;
    SET NEW.Cod_Usuario = CONCAT('COD-', LPAD(next_val, 5, '0'));
END;$$
DELIMITER ;

-- Tabla de actividad

CREATE TABLE actividad (
    ID_Actividad INT NOT NULL AUTO_INCREMENT,
    ID_Usuario INT(11) NOT NULL,
    Descripcion VARCHAR(255),
    Ultimo_inicio_sesion DATETIME DEFAULT NULL,
    Inicio_sesion_actual DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID_Actividad),
    UNIQUE KEY UC_Actividad_Usuario (ID_Usuario),
    KEY IDX_Actividad_Usuario (ID_Usuario),
    CONSTRAINT FK_Actividad_Usuarios FOREIGN KEY (ID_Usuario)
    REFERENCES usuarios(ID_Usuario)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla de restablecimiento de contraseña

CREATE TABLE restablecer_contrasena (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    Correo VARCHAR(255) NOT NULL,
    Token VARCHAR(255) NOT NULL,
    FechaCreacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
     PRIMARY KEY (ID),
      UNIQUE KEY Correo (Correo),
      KEY Token (Token)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;