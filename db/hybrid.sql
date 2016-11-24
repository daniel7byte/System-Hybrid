-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2016 a las 14:32:21
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hybrid`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nit` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `nit`, `telefono`, `direccion`) VALUES
(1, 'yenny', '3123', '123123S', 'SFGSD'),
(2, 'posso garcia', '3123', '123123S', 'SFGSD'),
(3, 'enrique', '3123', '123123S', 'SFGSD'),
(4, 'luz', '3123', '123123S', 'SFGSD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `id` bigint(20) NOT NULL,
  `fechaManual` date NOT NULL,
  `eS` enum('ENTRADA','SALIDA') COLLATE utf8_unicode_ci NOT NULL,
  `tipoDocumento` enum('CXC','DITRIJUEGOS','SIN IVA','FUERA INVENTARIO','COMPRA','DEVOLUCION','SIN FACTURA','SEPARADO','AVERIADO') COLLATE utf8_unicode_ci NOT NULL,
  `consecutivoManual` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `referencia` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` int(100) NOT NULL,
  `proveedor` bigint(20) NOT NULL,
  `estado` enum('NO APLICA','PAGADO','ABONADO','PENDIENTE','ANULADO','DEVOLUCION','CRUCE DE CUENTAS') COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `refAdmin` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contabilizadoAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `error` tinyint(1) NOT NULL DEFAULT '0',
  `fechaCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idUsuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`id`, `fechaManual`, `eS`, `tipoDocumento`, `consecutivoManual`, `referencia`, `cantidad`, `proveedor`, `estado`, `descripcion`, `refAdmin`, `contabilizadoAdmin`, `error`, `fechaCreacion`, `idUsuario`) VALUES
(1, '2016-11-09', 'ENTRADA', 'SIN IVA', 'a', 'b', 1, 4, 'ABONADO', 'dsds', 'das', 0, 1, '2016-11-23 16:06:52', 1),
(2, '2016-11-09', 'SALIDA', 'SIN IVA', 'a', 'b', 1, 4, 'ABONADO', 'dsds', 'das', 1, 0, '2016-11-23 16:06:52', 2),
(4, '2016-11-19', 'SALIDA', 'DEVOLUCION', 'jisda', 'asdad', 15, 2, 'ANULADO', 'Hola Luz', 'joajsda', 1, 1, '2016-11-23 18:18:43', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) NOT NULL,
  `usuario` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `contrasenia` text COLLATE utf8_unicode_ci NOT NULL,
  `rol` enum('ADMIN','USER') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contrasenia`, `rol`) VALUES
(1, 'luz_bedoya', '$2y$12$KEPmreyMhcVujtfspnpTYeJ.L1Xfr/0mNjoLfHljAiDDXjP5SnZya', 'ADMIN'),
(2, 'jose_posso', '$2y$12$KEPmreyMhcVujtfspnpTYeJ.L1Xfr/0mNjoLfHljAiDDXjP5SnZya', 'USER'),
(3, 'enrique_posso', '$2y$12$KEPmreyMhcVujtfspnpTYeJ.L1Xfr/0mNjoLfHljAiDDXjP5SnZya', 'ADMIN');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
