-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2023 a las 20:11:30
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `despachos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carro`
--

CREATE TABLE `carro` (
  `Id_Carro` int(11) NOT NULL,
  `Id_Cliente` int(11) NOT NULL,
  `Total` float NOT NULL,
  `Fecha_Crea` datetime NOT NULL,
  `Fecha_Mod` datetime NOT NULL,
  `Estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carro`
--

INSERT INTO `carro` (`Id_Carro`, `Id_Cliente`, `Total`, `Fecha_Crea`, `Fecha_Mod`, `Estado`) VALUES
(1, 1, 156000, '2023-10-23 06:41:10', '2023-10-23 06:41:10', 0),
(2, 1, 6000, '2023-10-23 06:43:31', '2023-10-23 06:43:31', 0),
(3, 1, 22000.8, '2023-10-24 10:17:58', '2023-10-24 10:17:58', 0),
(4, 1, 73001.6, '2023-10-24 10:32:53', '2023-10-24 10:32:53', 0),
(5, 1, 14200, '2023-10-24 11:47:04', '2023-10-24 11:47:04', 0),
(6, 1, 6000, '2023-10-24 11:47:25', '2023-10-24 11:47:25', 0),
(7, 1, 10000.8, '2023-10-24 18:20:32', '2023-10-24 18:20:32', 0),
(8, 1, 8201.6, '2023-10-24 18:21:09', '2023-10-24 18:21:09', 0),
(13, 1, 10000.8, '2023-10-24 18:40:03', '2023-10-24 18:40:03', 0),
(14, 1, 12000, '2023-10-25 14:10:18', '2023-10-25 14:10:18', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `Id_Cliente` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Apellido` varchar(30) NOT NULL,
  `eCorreo` varchar(50) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `Direccion` varchar(60) NOT NULL,
  `Estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`Id_Cliente`, `Nombre`, `Apellido`, `eCorreo`, `Telefono`, `Direccion`, `Estado`) VALUES
(1, 'Franklin', 'Sayago', 'franklin.solandy@gmail.com', '3168594688', 'Mz F1 Lt 31 Urb. La Concordia', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `Consecutivo` int(11) NOT NULL,
  `Fecha` datetime DEFAULT NULL,
  `Id_Persona` int(11) DEFAULT NULL,
  `Id_Producto` int(11) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Id_Medida` int(11) DEFAULT NULL,
  `Precio_Unitario` double DEFAULT NULL,
  `Total_Compra` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`Consecutivo`, `Fecha`, `Id_Persona`, `Id_Producto`, `Cantidad`, `Id_Medida`, `Precio_Unitario`, `Total_Compra`) VALUES
(1, '2023-09-15 15:30:31', 1, 1, 400, 1, 3000.5, 1200200),
(2, '2023-09-15 09:30:31', 2, 2, 200, 1, 4000.8, 800160),
(4, '2023-09-29 12:57:42', 1, 14, 1000, 30, 2000, 2000),
(5, '2023-09-29 16:57:42', 3, 2, 2000, 26, 4000, 8000),
(6, '2023-10-02 20:08:29', 3, 2, 300, 2, 2000, 600000),
(7, '2023-10-02 12:00:00', 2, 14, 30, 25, 300, 9000),
(8, '2023-10-02 06:00:00', 1, 10, 40, 1, 300, 5000),
(9, '2023-10-04 18:10:36', 1, 10, 20, 24, 20, 400),
(10, '2023-10-04 06:11:21', 1, 10, 10, 24, 10, 100),
(11, '2023-10-03 12:00:47', 1, 10, 30, 24, 30, 900),
(12, '2023-10-03 12:00:00', 1, 15, 40, 2, 40, 1600);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_carro`
--

CREATE TABLE `detalle_carro` (
  `Id_Detalle` int(11) NOT NULL,
  `Id_Carro` int(11) NOT NULL,
  `Id_Producto` int(11) NOT NULL,
  `Cantidad` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_carro`
--

INSERT INTO `detalle_carro` (`Id_Detalle`, `Id_Carro`, `Id_Producto`, `Cantidad`) VALUES
(1, 1, 1, 26),
(2, 2, 1, 1),
(3, 3, 2, 1),
(4, 3, 1, 3),
(5, 4, 25, 1),
(6, 4, 2, 2),
(7, 4, 1, 10),
(8, 13, 2, 1),
(9, 13, 1, 1),
(10, 14, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `Id_Evento` int(11) NOT NULL,
  `Id_TipoEvento` int(11) NOT NULL,
  `Id_Producto` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`Id_Evento`, `Id_TipoEvento`, `Id_Producto`, `Fecha`, `Descripcion`) VALUES
(1, 1, 20, '2023-10-30 19:54:25', 'Noviembre 2023'),
(2, 1, 19, '2023-10-30 13:59:30', 'Diciembre'),
(3, 4, 20, '2023-10-30 14:04:11', 'Solo en Cucuta al x mayor'),
(4, 2, 1, '2023-10-30 15:52:54', 'Vuelve en Diciembre'),
(5, 4, 1, '2023-10-31 18:57:18', 'Cúcuta al x mayor'),
(6, 2, 20, '2023-11-01 13:50:30', 'Hasta 5 Nov'),
(7, 1, 19, '2023-11-01 13:51:54', '30% hasta 5 Nov'),
(8, 3, 1, '2023-11-01 13:53:57', 'Cambio Presentación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images_tabla`
--

CREATE TABLE `images_tabla` (
  `id` int(11) NOT NULL,
  `imagenes` longblob NOT NULL,
  `creado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `Id_Persona` int(11) NOT NULL,
  `Nombre` varchar(30) DEFAULT NULL,
  `Apellido` varchar(30) DEFAULT NULL,
  `Id_TipoDcto` int(11) DEFAULT NULL,
  `Nro_Dcto` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`Id_Persona`, `Nombre`, `Apellido`, `Id_TipoDcto`, `Nro_Dcto`) VALUES
(1, 'Juan', 'Rodriguez', 1, '1234343'),
(2, 'Pedro', 'Suarez', 1, '1243343'),
(3, 'Luis Arnulfo', 'Briseño', 1, '1242343');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Id_Producto` int(11) NOT NULL,
  `Descripcion` varchar(40) DEFAULT NULL,
  `Precio_Unitario` double DEFAULT NULL,
  `Id_Medida` int(11) DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Id_Producto`, `Descripcion`, `Precio_Unitario`, `Id_Medida`, `Stock`) VALUES
(1, 'Purina', 6000, 1, 22000),
(2, 'Melasa', 4000.8, 2, 2000),
(10, 'Abono', 3000, 1, 12000),
(11, 'Sal Mineral', 2000, 25, 20000),
(14, 'Fertilizantes', 2000, 2, 20000),
(15, 'Insectisidas', 20000, 25, 4000),
(19, 'Otros', 200, 28, 200),
(20, 'Otro', 200, 25, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_imagenes`
--

CREATE TABLE `tbl_imagenes` (
  `imagen_ID` int(11) NOT NULL,
  `imagen_Marca` varchar(200) CHARACTER SET ucs2 COLLATE ucs2_general_ci NOT NULL,
  `imagen_Tipo` varchar(200) NOT NULL,
  `imagen_Img` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Tabla de Imagenes';

--
-- Volcado de datos para la tabla `tbl_imagenes`
--

INSERT INTO `tbl_imagenes` (`imagen_ID`, `imagen_Marca`, `imagen_Tipo`, `imagen_Img`) VALUES
(1, 'Formateo', 'Datasa', '770585.jpg'),
(3, 'Cibertel', 'Amperio', '798786.jpg'),
(4, 'mantenimiento', 'Reparacion', '736043.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `Id_TipoDcto` int(11) NOT NULL,
  `Descripcion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`Id_TipoDcto`, `Descripcion`) VALUES
(1, 'Cedula de Ciudadania'),
(2, 'Tarjeta de Identidad'),
(4, 'Otro TD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_eventos`
--

CREATE TABLE `tipo_eventos` (
  `Id_TipoEvento` int(11) NOT NULL,
  `Nombre` varchar(25) NOT NULL,
  `Descripcion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_eventos`
--

INSERT INTO `tipo_eventos` (`Id_TipoEvento`, `Nombre`, `Descripcion`) VALUES
(1, 'Promoción', '20% de descuento entre Noviembre 1 y 10'),
(2, 'Agotado', 'Disponible a partir de Noviembre 13'),
(3, 'Otro Proveedor', 'A partir de Noviembre 15'),
(4, 'Ubicación', 'Disponible al por mayor solo en Cúcuta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades_medida`
--

CREATE TABLE `unidades_medida` (
  `Id_Unidad` int(11) NOT NULL,
  `Descripcion` varchar(30) DEFAULT NULL,
  `Abreviatura` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `unidades_medida`
--

INSERT INTO `unidades_medida` (`Id_Unidad`, `Descripcion`, `Abreviatura`) VALUES
(1, 'Toneladas', 'Tns'),
(2, 'Kilogramos', 'Kgs'),
(23, 'Metros', 'Mt\r'),
(24, 'Centimetros', 'Cm\r'),
(25, 'Gramos', 'Gr\r'),
(26, 'Kilometros', 'Km'),
(27, 'Pulgadas', 'Pg'),
(28, 'Hectareas', 'Ht'),
(30, 'Otra', 'Otra'),
(32, 'Otra', 'Otro');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carro`
--
ALTER TABLE `carro`
  ADD PRIMARY KEY (`Id_Carro`),
  ADD KEY `Id_Cliente` (`Id_Cliente`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`Id_Cliente`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`Consecutivo`),
  ADD KEY `Id_Producto` (`Id_Producto`),
  ADD KEY `Id_Medida` (`Id_Medida`),
  ADD KEY `Id_Persona` (`Id_Persona`);

--
-- Indices de la tabla `detalle_carro`
--
ALTER TABLE `detalle_carro`
  ADD PRIMARY KEY (`Id_Detalle`),
  ADD KEY `Id_Carro` (`Id_Carro`,`Id_Producto`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`Id_Evento`),
  ADD KEY `Id_TipoEvento` (`Id_TipoEvento`,`Id_Producto`),
  ADD KEY `Id_Producto` (`Id_Producto`);

--
-- Indices de la tabla `images_tabla`
--
ALTER TABLE `images_tabla`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `tbl_imagenes`
--
ALTER TABLE `tbl_imagenes`
  ADD PRIMARY KEY (`imagen_ID`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`Id_TipoDcto`);

--
-- Indices de la tabla `tipo_eventos`
--
ALTER TABLE `tipo_eventos`
  ADD PRIMARY KEY (`Id_TipoEvento`);

--
-- Indices de la tabla `unidades_medida`
--
ALTER TABLE `unidades_medida`
  ADD PRIMARY KEY (`Id_Unidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carro`
--
ALTER TABLE `carro`
  MODIFY `Id_Carro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `Id_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `Consecutivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `detalle_carro`
--
ALTER TABLE `detalle_carro`
  MODIFY `Id_Detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `Id_Evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `images_tabla`
--
ALTER TABLE `images_tabla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `Id_Persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Id_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tbl_imagenes`
--
ALTER TABLE `tbl_imagenes`
  MODIFY `imagen_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `Id_TipoDcto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_eventos`
--
ALTER TABLE `tipo_eventos`
  MODIFY `Id_TipoEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `unidades_medida`
--
ALTER TABLE `unidades_medida`
  MODIFY `Id_Unidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`Id_TipoEvento`) REFERENCES `tipo_eventos` (`Id_TipoEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`Id_Producto`) REFERENCES `productos` (`Id_Producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
