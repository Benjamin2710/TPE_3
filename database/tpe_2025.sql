-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2025 a las 03:02:37
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tpe_2025`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `escudo` varchar(500) NOT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `pais` varchar(20) DEFAULT NULL,
  `liga` varchar(50) NOT NULL,
  `anio` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipo`, `nombre`, `escudo`, `ciudad`, `pais`, `liga`, `anio`) VALUES
(1, 'Boca Juniors', '', 'Buenos Aires', 'Argentina', 'Liga Profesional Argentina', 1905),
(3, 'River Plate', '', 'Buenos Aires', 'Argentina', 'Liga Profesional Argentina', 1901),
(7, 'Real Madrid', '', 'Madrid', 'España', 'La Liga', 1902),
(9, 'Barcelona', '', 'Barcelona', 'España', 'La Liga', 1899),
(11, 'Manchester United', 'asdasd', 'Manchester', 'Inglat', 'Premier League', 1878),
(14, 'Aldosivi', '', 'Mar del Plata', 'Argentina', 'Liga profesional futbol', 1913);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `id_jugador` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `posicion` varchar(50) DEFAULT NULL,
  `puntaje` int(2) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `id_equipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`id_jugador`, `nombre`, `pais`, `posicion`, `puntaje`, `fecha_nacimiento`, `id_equipo`) VALUES
(2, 'Edinson Cavani', 'Uruguay', 'CENTRO DELANTERO', 88, '1987-02-14', 1),
(7, 'Ayrton Preciado', 'Ecuador', 'MED', 77, '1994-07-17', 14),
(9, 'Vinicius Jr', 'Brasil', 'delantero', 88, '2000-07-12', 7),
(10, 'Pedro Gonzalez', 'España', 'Mediocampista', 80, '2002-11-25', 9),
(11, 'Jadon Sancho', 'Inglaterra', 'Delantero', 77, '2000-03-25', 11),
(12, 'Miguel Borja', 'Colombia', 'Delantero', 70, '1993-01-26', 3),
(13, 'Facundo Colidio', 'Argentina', 'Delantero', 72, '2000-01-04', 3),
(14, 'Exequiel Zeballos', 'Argentina', 'Delantero', 70, '2002-04-24', 1),
(15, 'Sergio Romero', 'Argentina', 'Arquero', 68, '1987-02-22', 1),
(16, 'Roberet Lewandowski', 'Polonia', 'Delantero', 82, '1988-08-21', 9),
(17, 'Jude Bellingham', 'Inglaterra', 'Mediocampista', 88, '2003-06-29', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasenia` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `contrasenia`) VALUES
(1, 'webadmin', '$2y$10$/iMmkZQYxZAdPJcYDBWb1.hjH7sC2ggdCvfboptQ2Gus51U25MKni');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipo`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id_jugador`),
  ADD KEY `id_equipo` (`id_equipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id_jugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD CONSTRAINT `jugadores_ibfk_1` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id_equipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
