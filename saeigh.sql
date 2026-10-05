-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-10-2026 a las 16:49:29
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
-- Base de datos: `saeigh`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `matricula_al` varchar(15) DEFAULT NULL,
  `nombre_al` varchar(15) DEFAULT NULL,
  `apaterno_al` varchar(15) DEFAULT NULL,
  `amaterno_al` varchar(15) DEFAULT NULL,
  `dom_al` varchar(80) DEFAULT NULL,
  `mail_al` varchar(50) DEFAULT NULL,
  `tel_al` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`matricula_al`, `nombre_al`, `apaterno_al`, `amaterno_al`, `dom_al`, `mail_al`, `tel_al`) VALUES
('2026001', 'Israel', 'Garduño', 'Heredia', 'Cuauhtemoc', 'isrgarher17@gmail.com', '5561599011'),
('2026001', 'Leonardo', 'Villaseñor', 'Vazquezz', 'tlanepantla', 'dodo2345@gmail.com', '5617066725'),
('2026007', 'Erik', 'Fuentes', 'Gonzales', 'tlanepantla', 'fuentesgE751@gmail.com', '5547329653');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `descripcion_grupo` varchar(15) DEFAULT 'ALTA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `descripcion_mat` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`descripcion_mat`) VALUES
('Base de Datos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `nocontrol_prof` varchar(15) DEFAULT NULL,
  `nombre_prof` varchar(15) DEFAULT NULL,
  `apaterno_prof` varchar(15) DEFAULT NULL,
  `amaterno_prof` varchar(15) DEFAULT NULL,
  `dom_prof` varchar(80) DEFAULT NULL,
  `mail_prof` varchar(50) DEFAULT NULL,
  `tel_prof` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`nocontrol_prof`, `nombre_prof`, `apaterno_prof`, `amaterno_prof`, `dom_prof`, `mail_prof`, `tel_prof`) VALUES
('PROF001', 'Carlos', 'Gonzales', 'Hernandez', 'CDMX', 'carlos@gmail.com', '5567231904');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
