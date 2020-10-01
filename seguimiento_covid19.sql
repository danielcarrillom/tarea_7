-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-09-2020 a las 20:20:44
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `seguimiento_covid19`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionario`
--

CREATE TABLE `funcionario` (
  `rut_funcionario` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_funcionario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apellidop_funcionario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apellidom_funcionario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_funcionario` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `hospital_id_hospital` int(11) NOT NULL,
  `perfil_id_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `funcionario`
--

INSERT INTO `funcionario` (`rut_funcionario`, `nombre_funcionario`, `apellidop_funcionario`, `apellidom_funcionario`, `telefono_funcionario`, `hospital_id_hospital`, `perfil_id_perfil`) VALUES
('16.707.185-6', 'Diego', 'Aravena', 'Carrasco', '87451236', 2, 9),
('17.291.909-k', 'Juan', 'Carrillo', 'Mendoza', '87456987', 3, 10),
('17.647.459-9', 'Daniel', 'Carrillo', 'Mendoza', '87451236', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_clinico`
--

CREATE TABLE `historial_clinico` (
  `id_historial_clinico` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `observacion_preliminar` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `paciente_rut_paciente` varchar(12) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `historial_clinico`
--

INSERT INTO `historial_clinico` (`id_historial_clinico`, `fecha_ingreso`, `observacion_preliminar`, `estado`, `paciente_rut_paciente`) VALUES
(1, '2020-09-07', 'Paciente llega con fiebre', 'Activo', '10.415.174-4'),
(2, '2020-09-07', 'Paciente llega con mareos', 'Activo', '19.308.675-6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_llamada`
--

CREATE TABLE `historial_llamada` (
  `id_llamado` int(11) NOT NULL,
  `fecha_hora_llamada` datetime NOT NULL,
  `observacion_llamada` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `historial_clinico_id_historial_clinico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `historial_llamada`
--

INSERT INTO `historial_llamada` (`id_llamado`, `fecha_hora_llamada`, `observacion_llamada`, `historial_clinico_id_historial_clinico`) VALUES
(1, '2020-09-08 16:56:00', 'Paciente se recupera de la fiebre', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospital`
--

CREATE TABLE `hospital` (
  `id_hospital` int(11) NOT NULL,
  `nombre_hospital` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `direccion_hospital` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_hospital` varchar(7) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `hospital`
--

INSERT INTO `hospital` (`id_hospital`, `nombre_hospital`, `direccion_hospital`, `telefono_hospital`) VALUES
(1, 'Hospital Rafael Avaria', 'Ohiggins 112', '2725845'),
(2, 'Hospital San Vicente', 'Alameda 566', '2725489'),
(3, 'Hospital Kallvu Llanka', 'San Felipe 322', '2752148');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_bitacora`
--

CREATE TABLE `movimiento_bitacora` (
  `id_movimiento` int(11) NOT NULL,
  `nombre_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_usuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_movimiento` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_movimiento` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_movimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `movimiento_bitacora`
--

INSERT INTO `movimiento_bitacora` (`id_movimiento`, `nombre_usuario`, `tipo_usuario`, `tipo_movimiento`, `descripcion_movimiento`, `fecha_movimiento`) VALUES
(1, 'danielc', 'Full', 'Acción Insert', 'Se agregó el perfil: diegoa', '2020-09-07'),
(2, 'danielc', 'Full', 'Acción Insert', 'Se agregó el hospital: Hospital San Vicente', '2020-09-07'),
(3, 'danielc', 'Full', 'Acción Insert', 'Se agregó el funcionario con rut: 16.707.185-6', '2020-09-07'),
(4, 'danielc', 'Full', 'Acción Insert', 'Se agregó el paciente con rut: 10.415.174-4', '2020-09-07'),
(5, 'danielc', 'Full', 'Acción Insert', 'Se agregó el historial de paciente: Miguel Medina Vidal', '2020-09-07'),
(6, 'diegoa', 'Limited', 'Acción Insert', 'Se agregó historial de llamada a paciente: Miguel Medina Vidal', '2020-09-07'),
(7, 'danielc', 'Full', 'Acción Update', 'Se modificó el paciente con rut: 10.415.174-4', '2020-09-07'),
(8, 'danielc', 'Full', 'Acción Insert', 'Se agregó el hospital: Hospital Kallvu Llanka', '2020-09-07'),
(9, 'danielc', 'Full', 'Acción Insert', 'Se agregó el paciente con rut: 19.308.675-6', '2020-09-07'),
(10, 'diegoa', 'Limited', 'Acción Insert', 'Se agregó el historial de paciente: Juan Armando Castillo', '2020-09-07'),
(11, 'danielc', 'Full', 'Acción Update', 'Se modificó el hospital: Hospital Rafael Avaria', '2020-09-07'),
(12, 'danielc', 'Full', 'Acción Insert', 'Se agregó el perfil: juanc', '2020-09-07'),
(13, 'danielc', 'Full', 'Acción Insert', 'Se agregó el funcionario con rut: 17.291.909-k', '2020-09-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `rut_paciente` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_paciente` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apellidop_paciente` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apellidom_paciente` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_paciente` int(11) NOT NULL,
  `direccion_paciente` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`rut_paciente`, `nombre_paciente`, `apellidop_paciente`, `apellidom_paciente`, `telefono_paciente`, `direccion_paciente`) VALUES
('10.415.174-4', 'Miguel', 'Medina', 'Vidal', 89456321, 'Alameda 100'),
('19.308.675-6', 'Juan', 'Armando', 'Castillo', 89547123, 'Colo colo 122');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `usuario` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `contraseña` varchar(90) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_perfil` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `usuario`, `contraseña`, `tipo_perfil`, `fecha_creacion`) VALUES
(1, 'danielc', '$2y$10$mG8wWvsjTQye.JgiTse5TeWYrP3ybUCODpdPip6rJpKgGnyM.Qy0O', 'Full', '2020-09-01'),
(9, 'diegoa', '$2y$10$Ey.eDpWt2baXtil573J9IufqmHW7WUdRYBxkiA5qICyFD2tEg4p3y', 'Limited', '2020-09-07'),
(10, 'juanc', '$2y$10$HpGN0uZdbYYFcwSYMn0Y1OjQBGB7AUT5hMMm/0Cy6OfsEpQf0Xamm', 'Full', '2020-09-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supervisa`
--

CREATE TABLE `supervisa` (
  `funcionario_rut_funcionario` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `paciente_rut_paciente` varchar(12) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `supervisa`
--

INSERT INTO `supervisa` (`funcionario_rut_funcionario`, `paciente_rut_paciente`) VALUES
('16.707.185-6', '19.308.675-6'),
('17.647.459-9', '10.415.174-4');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`rut_funcionario`),
  ADD KEY `fk_funcionario_hospital_idx` (`hospital_id_hospital`),
  ADD KEY `fk_funcionario_perfil1_idx` (`perfil_id_perfil`);

--
-- Indices de la tabla `historial_clinico`
--
ALTER TABLE `historial_clinico`
  ADD PRIMARY KEY (`id_historial_clinico`),
  ADD KEY `fk_historial_clinico_paciente1_idx` (`paciente_rut_paciente`);

--
-- Indices de la tabla `historial_llamada`
--
ALTER TABLE `historial_llamada`
  ADD PRIMARY KEY (`id_llamado`),
  ADD KEY `fk_historial_llamado_historial_clinico1_idx` (`historial_clinico_id_historial_clinico`);

--
-- Indices de la tabla `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id_hospital`);

--
-- Indices de la tabla `movimiento_bitacora`
--
ALTER TABLE `movimiento_bitacora`
  ADD PRIMARY KEY (`id_movimiento`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`rut_paciente`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `supervisa`
--
ALTER TABLE `supervisa`
  ADD PRIMARY KEY (`funcionario_rut_funcionario`,`paciente_rut_paciente`),
  ADD KEY `fk_funcionario_has_paciente_paciente1_idx` (`paciente_rut_paciente`),
  ADD KEY `fk_funcionario_has_paciente_funcionario1_idx` (`funcionario_rut_funcionario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `historial_clinico`
--
ALTER TABLE `historial_clinico`
  MODIFY `id_historial_clinico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historial_llamada`
--
ALTER TABLE `historial_llamada`
  MODIFY `id_llamado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id_hospital` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `movimiento_bitacora`
--
ALTER TABLE `movimiento_bitacora`
  MODIFY `id_movimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_funcionario_hospital` FOREIGN KEY (`hospital_id_hospital`) REFERENCES `hospital` (`id_hospital`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_funcionario_perfil1` FOREIGN KEY (`perfil_id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial_clinico`
--
ALTER TABLE `historial_clinico`
  ADD CONSTRAINT `fk_historial_clinico_paciente1` FOREIGN KEY (`paciente_rut_paciente`) REFERENCES `paciente` (`rut_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial_llamada`
--
ALTER TABLE `historial_llamada`
  ADD CONSTRAINT `fk_historial_llamado_historial_clinico1` FOREIGN KEY (`historial_clinico_id_historial_clinico`) REFERENCES `historial_clinico` (`id_historial_clinico`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `supervisa`
--
ALTER TABLE `supervisa`
  ADD CONSTRAINT `fk_funcionario_has_paciente_funcionario1` FOREIGN KEY (`funcionario_rut_funcionario`) REFERENCES `funcionario` (`rut_funcionario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_funcionario_has_paciente_paciente1` FOREIGN KEY (`paciente_rut_paciente`) REFERENCES `paciente` (`rut_paciente`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
