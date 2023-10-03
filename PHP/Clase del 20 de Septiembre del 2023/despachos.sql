-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-09-2023 a las 20:38:22
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO"; -- Elimina el modo de inserción automática para tablas con valores de clave primaria no definidos
START TRANSACTION; -- Inicia una transacción, desactiva el modo de inserción automática
SET time_zone = "+00:00"; -- Establece la zona horaria predeterminada, puede establecerla en su zona horaria


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */; -- Guarda el juego de caracteres del cliente
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */; -- Guarda el juego de caracteres de los resultados
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */; -- Guarda la conexión de intercalación de caracteres
/*!40101 SET NAMES utf8mb4 */;
-- Establece el juego de caracteres del cliente en utf8mb4

--
-- Base de datos: `despachos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` -- Crea la tabla compras
(
    `Consecutivo`     int(11) NOT NULL, -- Crea la columna consecutivo
    `Fecha`           datetime DEFAULT NULL,
    `Id_Persona`      int(11)  DEFAULT NULL,
    `Id_Producto`     int(11)  DEFAULT NULL,
    `Cantidad`        int(11)  DEFAULT NULL,
    `Id_Medida`       int(11)  DEFAULT NULL,
    `Precio_Unitario` double   DEFAULT NULL,
    `Total_Compra`    double   DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

-- Inserta datos en la tabla compras
INSERT INTO `compras` (`Consecutivo`, `Fecha`, `Id_Persona`, `Id_Producto`, `Cantidad`, `Id_Medida`, `Precio_Unitario`,
                       `Total_Compra`)
VALUES (1, '2023-09-15 09:30:31', 1, 1, 400, 1, 3000.5, 1200200),
       (2, '2023-09-15 09:30:31', 2, 2, 200, 1, 4000.8, 800160);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas`
(
    `Id_Persona`  int(11) NOT NULL,
    `Nombre`      varchar(30) DEFAULT NULL,
    `Apellido`    varchar(30) DEFAULT NULL,
    `Id_TipoDcto` int(11)     DEFAULT NULL,
    `Nro_Dcto`    varchar(20) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`Id_Persona`, `Nombre`, `Apellido`, `Id_TipoDcto`, `Nro_Dcto`)
VALUES (1, 'Juan', 'Rodriguez', 1, '1234343'),
       (2, 'Pedro', 'Suarez', 2, '1243343'),
       (3, 'Luis Arnulfo', 'Briseño', 1, '1242343');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos`
(
    `Id_Producto`     int(11) NOT NULL,
    `Descripcion`     varchar(40) DEFAULT NULL,
    `Precio_Unitario` double      DEFAULT NULL,
    `Id_Medida`       int(11)     DEFAULT NULL,
    `Stock`           int(11)     DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Id_Producto`, `Descripcion`, `Precio_Unitario`, `Id_Medida`, `Stock`)
VALUES (1, 'Purina', 6000, 1, 22000),
       (2, 'Melasa', 4000.8, 2, 2000),
       (10, 'Abono', 3000, 1, 12000),
       (11, 'Sal Mineral', 2000, 25, 20000),
       (14, 'Fertilizantes', 2000, 2, 20000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento`
(
    `id_TipoDcto` int(11) NOT NULL,
    `Descripcion` varchar(20) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_TipoDcto`, `Descripcion`)
VALUES (1, 'Cedula de Ciudadania'),
       (2, 'Tarjeta de Identidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades_medida`
--

CREATE TABLE `unidades_medida`
(
    `Id_Unidad`   int(11) NOT NULL,
    `Descripcion` varchar(30) DEFAULT NULL,
    `Abreviatura` varchar(10) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `unidades_medida`
--

INSERT INTO `unidades_medida` (`Id_Unidad`, `Descripcion`, `Abreviatura`)
VALUES (1, 'Toneladas', 'Tns'),
       (2, 'Kilogramos', 'Kgs'),
       (23, 'Metros', 'Mt\r'),
       (24, 'Centimetros', 'Cm\r'),
       (25, 'Gramos', 'Gr\r'),
       (26, 'Kilometros', 'Km'),
       (27, 'Pulgadas', 'Pg'),
       (28, 'Hectareas', 'Ht');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
    ADD PRIMARY KEY (`Consecutivo`),
    ADD KEY `Id_Producto` (`Id_Producto`),
    ADD KEY `Id_Medida` (`Id_Medida`),
    ADD KEY `Id_Persona` (`Id_Persona`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
    ADD PRIMARY KEY (`Id_Persona`),
    ADD KEY `Id_TipoDcto` (`Id_TipoDcto`),
    ADD KEY `Id_TipoDcto_2` (`Id_TipoDcto`),
    ADD KEY `Id_TipoDcto_3` (`Id_TipoDcto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
    ADD PRIMARY KEY (`Id_Producto`),
    ADD KEY `Id_Medida` (`Id_Medida`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
    ADD PRIMARY KEY (`id_TipoDcto`);

--
-- Indices de la tabla `unidades_medida`
--
ALTER TABLE `unidades_medida`
    ADD PRIMARY KEY (`Id_Unidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
    MODIFY `Consecutivo` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
    MODIFY `Id_Persona` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
    MODIFY `Id_Producto` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 15;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
    MODIFY `id_TipoDcto` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 3;

--
-- AUTO_INCREMENT de la tabla `unidades_medida`
--
ALTER TABLE `unidades_medida`
    MODIFY `Id_Unidad` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
    ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`Id_Medida`) REFERENCES `unidades_medida` (`Id_Unidad`),
    ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`Id_Producto`) REFERENCES `productos` (`Id_Producto`),
    ADD CONSTRAINT `compras_ibfk_3` FOREIGN KEY (`Id_Persona`) REFERENCES `personas` (`Id_Persona`);

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
    ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`Id_TipoDcto`) REFERENCES `tipo_documento` (`id_TipoDcto`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
    ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`Id_Medida`) REFERENCES `unidades_medida` (`Id_Unidad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;