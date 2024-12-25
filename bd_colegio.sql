-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2024 a las 01:46:11
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_colegio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificate`
--

CREATE TABLE `certificate` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `student_name` varchar(50) DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `dni_type_id` int(11) DEFAULT NULL,
  `grade` varchar(4) DEFAULT NULL,
  `dni_type_id1` int(11) NOT NULL,
  `user_role_id1` int(11) NOT NULL,
  `user_dni_type_id1` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` varchar(100) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `comment_id1` int(11) NOT NULL,
  `user_role_id1` int(11) NOT NULL,
  `user_dni_type_id1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dni_type`
--

CREATE TABLE `dni_type` (
  `id` int(11) NOT NULL,
  `description` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `content` varchar(150) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `user_id1` int(11) NOT NULL,
  `user_role_id1` int(11) NOT NULL,
  `user_dni_type_id1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `fecha`, `descripcion`, `imagen`) VALUES
(2, 'Periodico', '2024-11-03', 'En resumen, la metafísica es una disciplina esencial que busca comprender las bases más profundas de nuestra realidad. A través de su estudio, se nos invita a reflexionar sobre nuestra existencia, el universo que nos rodea y los principios que rigen todo ', 'uploads/Captura de pantalla (2).png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `description` varchar(30) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student_data`
--

CREATE TABLE `student_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `guardian_name` varchar(50) DEFAULT NULL,
  `guardian_dni` varchar(15) DEFAULT NULL,
  `dni_type_id` int(11) DEFAULT NULL,
  `user_id1` int(11) NOT NULL,
  `dni_type_id1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(15) DEFAULT NULL,
  `second_name` varchar(30) DEFAULT NULL,
  `first_family_name` varchar(20) DEFAULT NULL,
  `second_family_name` varchar(25) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `dni_type_id` int(11) DEFAULT NULL,
  `email` varchar(90) DEFAULT NULL,
  `password` varchar(512) DEFAULT NULL,
  `news_id` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `first_name`, `second_name`, `first_family_name`, `second_family_name`, `role_id`, `dni`, `dni_type_id`, `email`, `password`, `news_id`, `image`, `token`) VALUES
(1, 'Ruben', 'Dario', 'Cardona', 'Rios', 1, 123, 1, 'ruben@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', NULL, '', ''),
(2, 'Daniel', '', 'Acuña', 'Aranzazu', 3, 1040, 2, 'danielacunaaranzazu@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', NULL, '', ''),
(3, 'Mirriam', '', 'uiqwd', 'ajsd', 2, 1234, 1, 'miriam@gmail.com', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', NULL, '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dni_type`
--
ALTER TABLE `dni_type`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
