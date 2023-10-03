-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-09-2023 a las 20:38:22
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO"; -- Elimina el modo de valor cero para las tablas AUTO_INCREMENT
START TRANSACTION; -- Inicia una transacción
SET
time_zone = "+00:00"; -- Establece la zona horaria predeterminada


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `despachos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--


CREATE TABLE `compras`
(                                          -- Crea la tabla compras
    `Consecutivo` int(11) NOT NULL,        -- Crea el campo consecutivo (int(11) = Entero de 11 digitos, NOT NULL = No puede ser nulo)
    `Fecha`       datetime DEFAULT NULL,   -- Crea el campo fecha (datetime = Fecha y hora, DEFAULT NULL = Puede ser nulo)
    `Id_Persona`  int(11) DEFAULT NULL,    -- Crea el campo id_persona (int(11) = Entero de 11 digitos, DEFAULT NULL = Puede ser nulo)
    `Id_Producto` int(11) DEFAULT NULL,    -- Crea el campo id_producto (int(11) = Entero de 11 digitos, DEFAULT NULL = Puede ser nulo)
    `Cantidad`    int(11) DEFAULT NULL,    -- Crea el campo cantidad (int(11) = Entero de 11 digitos, DEFAULT NULL = Puede ser nulo)
    `Id_Medida`   int(11) DEFAULT NULL,    -- Crea el campo id_medida (int(11) = Entero de 11 digitos, DEFAULT NULL = Puede ser nulo)
    `Precio_Unitario` double DEFAULT NULL, -- Crea el campo precio_unitario (double = Decimal, DEFAULT NULL = Puede ser nulo)
    `Total_Compra` double DEFAULT NULL     -- Crea el campo total_compra (double = Decimal, DEFAULT NULL = Puede ser nulo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Establece el motor de la tabla (InnoDB = Motor de base de datos, DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci = Codificacion de caracteres)

--
-- Volcado de datos para la tabla `compras`
--

-- Inserta los siguientes datos en la tabla compras
INSERT INTO `compras` (`Consecutivo`, `Fecha`, `Id_Persona`, `Id_Producto`, `Cantidad`, `Id_Medida`, `Precio_Unitario`,
                       `Total_Compra`)
VALUES (1, '2023-09-15 09:30:31', 1, 1, 400, 1, 3000.5, 1200200),
       (2, '2023-09-15 09:30:31', 2, 2, 200, 1, 4000.8, 800160);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas`
(                                           -- Crea la tabla personas
    `Id_Persona`  int(11) NOT NULL,         -- Crea el campo id_persona (int(11) = Entero de 11 digitos, NOT NULL = No puede ser nulo)
    `Nombre`      varchar(30) DEFAULT NULL, -- Crea el campo nombre (varchar(30) = Cadena de 30 caracteres, DEFAULT NULL = Puede ser nulo)
    `Apellido`    varchar(30) DEFAULT NULL, -- Crea el campo apellido (varchar(30) = Cadena de 30 caracteres, DEFAULT NULL = Puede ser nulo)
    `Id_TipoDcto` int(11) DEFAULT NULL,     -- Crea el campo id_tipodcto (int(11) = Entero de 11 digitos, DEFAULT NULL = Puede ser nulo)
    `Nro_Dcto`    varchar(20) DEFAULT NULL  -- Crea el campo nro_dcto (varchar(20) = Cadena de 20 caracteres, DEFAULT NULL = Puede ser nulo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Establece el motor de la tabla (InnoDB = Motor de base de datos, DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci = Codificacion de caracteres)

--
-- Volcado de datos para la tabla `personas`
--

-- Inserta los siguientes datos en la tabla personas
INSERT INTO `personas` (`Id_Persona`, `Nombre`, `Apellido`, `Id_TipoDcto`, `Nro_Dcto`)
VALUES (1, 'Juan', 'Rodriguez', 1, '1234343'),
       (2, 'Pedro', 'Suarez', 2, '1243343'),
       (3, 'Luis Arnulfo', 'Briseño', 1, '1242343');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos`
(                                           -- Crea la tabla productos
    `Id_Producto` int(11) NOT NULL,         -- Crea el campo id_producto (int(11) = Entero de 11 digitos, NOT NULL = No puede ser nulo)
    `Descripcion` varchar(40) DEFAULT NULL, -- Crea el campo descripcion (varchar(40) = Cadena de 40 caracteres, DEFAULT NULL = Puede ser nulo)
    `Precio_Unitario` double DEFAULT NULL,  -- Crea el campo precio_unitario (double = Decimal, DEFAULT NULL = Puede ser nulo)
    `Id_Medida`   int(11) DEFAULT NULL,     -- Crea el campo id_medida (int(11) = Entero de 11 digitos, DEFAULT NULL = Puede ser nulo)
    `Stock`       int(11) DEFAULT NULL      -- Crea el campo stock (int(11) = Entero de 11 digitos, DEFAULT NULL = Puede ser nulo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Establece el motor de la tabla (InnoDB = Motor de base de datos, DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci = Codificacion de caracteres)

--
-- Volcado de datos para la tabla `productos`
--

-- Inserta los siguientes datos en la tabla productos
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
(                                          -- Crea la tabla tipo_documento
    `id_TipoDcto` int(11) NOT NULL,        -- Crea el campo id_tipodcto (int(11) = Entero de 11 digitos, NOT NULL = No puede ser nulo)
    `Descripcion` varchar(20) DEFAULT NULL -- Crea el campo descripcion (varchar(20) = Cadena de 20 caracteres, DEFAULT NULL = Puede ser nulo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Establece el motor de la tabla (InnoDB = Motor de base de datos, DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci = Codificacion de caracteres)

--
-- Volcado de datos para la tabla `tipo_documento`
--

-- Inserta los siguientes datos en la tabla tipo_documento
INSERT INTO `tipo_documento` (`id_TipoDcto`, `Descripcion`)
VALUES (1, 'Cedula de Ciudadania'),
       (2, 'Tarjeta de Identidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades_medida`
--

CREATE TABLE `unidades_medida`
(                                           -- Crea la tabla unidades_medida
    `Id_Unidad`   int(11) NOT NULL,         -- Crea el campo id_unidad (int(11) = Entero de 11 digitos, NOT NULL = No puede ser nulo)
    `Descripcion` varchar(30) DEFAULT NULL, -- Crea el campo descripcion (varchar(30) = Cadena de 30 caracteres, DEFAULT NULL = Puede ser nulo)
    `Abreviatura` varchar(10) DEFAULT NULL  -- Crea el campo abreviatura (varchar(10) = Cadena de 10 caracteres, DEFAULT NULL = Puede ser nulo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Establece el motor de la tabla (InnoDB = Motor de base de datos, DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci = Codificacion de caracteres)

--
-- Volcado de datos para la tabla `unidades_medida`
--

-- Inserta los siguientes datos en la tabla unidades_medida
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

-- Crea los indices de la tabla compras
ALTER TABLE `compras`
    ADD PRIMARY KEY (`Consecutivo`), -- Crea el indice consecutivo (PRIMARY KEY = Clave primaria) sobre el campo consecutivo
  ADD KEY `Id_Producto` (`Id_Producto`), -- Crea el indice id_producto sobre el campo id_producto
  ADD KEY `Id_Medida` (`Id_Medida`), -- Crea el indice id_medida sobre el campo id_medida
  ADD KEY `Id_Persona` (`Id_Persona`);
-- Crea el indice id_persona sobre el campo id_persona

--
-- Indices de la tabla `personas`
--

-- Crea los indices de la tabla personas
ALTER TABLE `personas`
    ADD PRIMARY KEY (`Id_Persona`), -- Crea el indice id_persona (PRIMARY KEY = Clave primaria) sobre el campo id_persona
  ADD KEY `Id_TipoDcto` (`Id_TipoDcto`), -- Crea el indice id_tipodcto sobre el campo id_tipodcto
  ADD KEY `Id_TipoDcto_2` (`Id_TipoDcto`), -- Crea el indice id_tipodcto_2 sobre el campo id_tipodcto
  ADD KEY `Id_TipoDcto_3` (`Id_TipoDcto`);
-- Crea el indice id_tipodcto_3 sobre el campo id_tipodcto

--
-- Indices de la tabla `productos`
--

-- Crea los indices de la tabla productos
ALTER TABLE `productos`
    ADD PRIMARY KEY (`Id_Producto`), -- Crea el indice id_producto (PRIMARY KEY = Clave primaria) sobre el campo id_producto
  ADD KEY `Id_Medida` (`Id_Medida`);
-- Crea el indice id_medida sobre el campo id_medida

--
-- Indices de la tabla `tipo_documento`
--

-- Crea los indices de la tabla tipo_documento
ALTER TABLE `tipo_documento`
    ADD PRIMARY KEY (`id_TipoDcto`);
-- Crea el indice id_tipodcto (PRIMARY KEY = Clave primaria) sobre el campo id_tipodcto

--
-- Indices de la tabla `unidades_medida`
--

-- Crea los indices de la tabla unidades_medida
ALTER TABLE `unidades_medida`
    ADD PRIMARY KEY (`Id_Unidad`);
-- Crea el indice id_unidad (PRIMARY KEY = Clave primaria) sobre el campo id_unidad

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras`
--

-- Establece el auto_increment de la tabla compras
ALTER TABLE `compras`
    MODIFY `Consecutivo` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
-- Establece el auto_increment del campo consecutivo en 4 (AUTO_INCREMENT=4)

--
-- AUTO_INCREMENT de la tabla `personas`
--

-- Establece el auto_increment de la tabla personas
ALTER TABLE `personas`
    MODIFY `Id_Persona` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
-- Establece el auto_increment del campo id_persona en 4 (AUTO_INCREMENT=4)

--
-- AUTO_INCREMENT de la tabla `productos`
--

-- Establece el auto_increment de la tabla productos
ALTER TABLE `productos`
    MODIFY `Id_Producto` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
-- Establece el auto_increment del campo id_producto en 15 (AUTO_INCREMENT=15)

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--

-- Establece el auto_increment de la tabla tipo_documento
ALTER TABLE `tipo_documento`
    MODIFY `id_TipoDcto` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
-- Establece el auto_increment del campo id_tipodcto en 3 (AUTO_INCREMENT=3)

--
-- AUTO_INCREMENT de la tabla `unidades_medida`
--

-- Establece el auto_increment de la tabla unidades_medida
ALTER TABLE `unidades_medida`
    MODIFY `Id_Unidad` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
-- Establece el auto_increment del campo id_unidad en 29 (AUTO_INCREMENT=29)

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--

-- Crea los filtros de la tabla compras
ALTER TABLE `compras`
    ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`Id_Medida`) REFERENCES `unidades_medida` (`Id_Unidad`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`Id_Producto`) REFERENCES `productos` (`Id_Producto`),
  ADD CONSTRAINT `compras_ibfk_3` FOREIGN KEY (`Id_Persona`) REFERENCES `personas` (`Id_Persona`);
-- En resumen, crea los filtros de las tablas unidades_medida, productos y personas sobre los campos id_medida, id_producto e id_persona de la tabla compras

--
-- Filtros para la tabla `personas`
--

-- Crea los filtros de la tabla personas
ALTER TABLE `personas`
    ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`Id_TipoDcto`) REFERENCES `tipo_documento` (`id_TipoDcto`);
-- En resumen, crea el filtro de la tabla tipo_documento sobre el campo id_tipodcto de la tabla personas

--
-- Filtros para la tabla `productos`
--

-- Crea los filtros de la tabla productos
ALTER TABLE `productos`
    ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`Id_Medida`) REFERENCES `unidades_medida` (`Id_Unidad`);
COMMIT;
-- En resumen, crea el filtro de la tabla unidades_medida sobre el campo id_medida de la tabla productos
-- COMMIT = Finaliza la transacción

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;