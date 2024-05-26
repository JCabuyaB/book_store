-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-05-2024 a las 16:38:07
-- Versión del servidor: 8.2.0
-- Versión de PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `book_store`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categorias`
--

DROP TABLE IF EXISTS `tbl_categorias`;
CREATE TABLE IF NOT EXISTS `tbl_categorias` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `category_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_categorias`
--

INSERT INTO `tbl_categorias` (`id`, `category_name`) VALUES
(2, 'Anime'),
(3, 'Literatura'),
(8, 'Ciencia ficción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_compras`
--

DROP TABLE IF EXISTS `tbl_compras`;
CREATE TABLE IF NOT EXISTS `tbl_compras` (
  `cod` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `sale_date` date NOT NULL,
  `sale_state` varchar(80) DEFAULT 'En espera',
  PRIMARY KEY (`cod`),
  KEY `fk_usuario` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_compras`
--

INSERT INTO `tbl_compras` (`cod`, `id_user`, `sale_date`, `sale_state`) VALUES
(1, 3, '2024-05-24', NULL),
(2, 3, '2024-05-24', NULL),
(3, 3, '2024-05-24', 'Por confirmar'),
(4, 3, '2024-05-24', 'Por confirmar'),
(10, 3, '2024-05-25', 'Despachado'),
(19, 3, '2024-05-25', 'Por confirmar'),
(20, 5, '2024-05-25', 'Entregado'),
(21, 5, '2024-05-25', 'Por confirmar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_compras`
--

DROP TABLE IF EXISTS `tbl_detalle_compras`;
CREATE TABLE IF NOT EXISTS `tbl_detalle_compras` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `cod_bill` int NOT NULL,
  `id_book` int DEFAULT NULL,
  `quantity` tinyint NOT NULL,
  `total` decimal(18,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_compra` (`cod_bill`),
  KEY `fk_libro` (`id_book`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_detalle_compras`
--

INSERT INTO `tbl_detalle_compras` (`id`, `cod_bill`, `id_book`, `quantity`, `total`) VALUES
(1, 1, 12, 1, 12000.00),
(2, 2, 12, 2, 24000.00),
(3, 3, 12, 2, 24000.00),
(4, 4, 15, 1, 450000.00),
(5, 4, 12, 2, 24000.00),
(16, 10, 15, 1, 450000.00),
(22, 19, 11, 1, 211.00),
(23, 19, 15, 2, 900000.00),
(24, 19, 13, 1, 500000.00),
(25, 20, 16, 2, 40000.00),
(26, 20, 17, 1, 25000.00),
(27, 21, 13, 1, 500000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_editoriales`
--

DROP TABLE IF EXISTS `tbl_editoriales`;
CREATE TABLE IF NOT EXISTS `tbl_editoriales` (
  `id` smallint NOT NULL AUTO_INCREMENT,
  `editorial_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_editoriales`
--

INSERT INTO `tbl_editoriales` (`id`, `editorial_name`) VALUES
(1, 'Editorial Medellín'),
(2, 'Editorial 2000'),
(3, 'Editorial 3'),
(5, 'Jin'),
(7, 'Obeja negra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_libros`
--

DROP TABLE IF EXISTS `tbl_libros`;
CREATE TABLE IF NOT EXISTS `tbl_libros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `isbn` varchar(14) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `autor` varchar(160) NOT NULL,
  `synopsis` text NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `id_cat` tinyint NOT NULL,
  `id_edit` smallint NOT NULL,
  `price` decimal(18,2) NOT NULL,
  `stock` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_categoria` (`id_cat`),
  KEY `fk_editorial` (`id_edit`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_libros`
--

INSERT INTO `tbl_libros` (`id`, `isbn`, `title`, `autor`, `synopsis`, `image`, `id_cat`, `id_edit`, `price`, `stock`) VALUES
(11, '21313', 'ROMANCE DAWN - THE DAWN OF THE ADVENTURE', 'Eiichiro Oda', 'As a child, Monkey D. Luffy was inspired to become a pirate by listening to the tales of the buccaneer \"Red-Haired\" Shanks. But Luffy\'s life changed when he accidentally ate the fruit of the Gum-Gum Tree, and gained the power to stretch like rubber...at the cost of never being able to swim again! Years later, still vowing to become the king of the pirates, Luffy sets out on his adventure...one guy alone in a rowboat, in search of the legendary \"One Piece,\" said to be the greatest treasure in the world', 'Volumen_1.jpg', 2, 1, 211.00, 1),
(12, '23311', 'BUGGY THE CLOWN', 'Eiichiro Oda', '«¡¡VERSUS!! Los Piratas de Buggy».', 'Volumen_2.jpg', 2, 1, 12000.00, 2),
(13, '2222222', 'DON\'T GET FOOLED AGAIN', 'Oda', '«Aquello de lo que no se puede mentir».', 'Volumen_3.jpg', 2, 1, 500000.00, 13),
(15, '21321321', 'THE BLACK CAT PIRATES', 'Eiichiro oda', '«Luna nueva».', 'Volumen_4.jpg', 2, 1, 450000.00, 51),
(16, '2213213-12312', 'La guerra de las galaxias', 'George Lucas', 'En un lugar en la galaxia muy lejana ', 'guerra.jpg', 8, 7, 20000.00, 5),
(17, '12332111', 'Cien años de soledad', 'Gabriel García Marquez', 'Entre la boda de José Arcadio Buendía con Amelia Iguarán hasta la maldición de Aureliano Babilonia transcurre todo un siglo', '100.jpg', 3, 7, 25000.00, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

DROP TABLE IF EXISTS `tbl_usuarios`;
CREATE TABLE IF NOT EXISTS `tbl_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'user',
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_email` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id`, `name`, `role`, `mail`, `password`, `department`, `city`, `address`) VALUES
(1, 'david', 'admin', 'david@david.com', '$2y$04$f0Qy8L0G90pg8wRzgUHFjOshBhZEEhQqeN3QdvUgzFt3ABqJgOe7G', 'Antioquia', 'Marinilla', '14a'),
(3, 'Camilo Cabuya Berrio', 'user', 'camilo@camilo.com', '$2y$04$fmlfPwVxn4ae6OF6YUokv.lbcuROSr.czboeAIPA5.PcMTYcBtN.6', 'Amazonas', 'Puerto a', 'cll123456'),
(4, 'Sebastian', 'user', 'sebastian@sebastian.com', '$2y$04$o/gtqgWZX6AbaFFY7uTZ4ej9pS/HzqYkO51mhpCjSbpU6KtFc/X4y', 'Amazonas', 'Puerto B', 'cll123456'),
(5, 'kevin', 'user', 'kevin@kevin.com', '$2y$04$Cnp7GjfCtCdAUsZvrTfsCuVdyYbc4/lgL9VGc272MFHNyShRE15ca', 'Antioquia', 'Medellin', 'cll 40a');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_compras`
--
ALTER TABLE `tbl_compras`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_user`) REFERENCES `tbl_usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_detalle_compras`
--
ALTER TABLE `tbl_detalle_compras`
  ADD CONSTRAINT `fk_compra` FOREIGN KEY (`cod_bill`) REFERENCES `tbl_compras` (`cod`),
  ADD CONSTRAINT `fk_libro` FOREIGN KEY (`id_book`) REFERENCES `tbl_libros` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `tbl_libros`
--
ALTER TABLE `tbl_libros`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_cat`) REFERENCES `tbl_categorias` (`id`),
  ADD CONSTRAINT `fk_editorial` FOREIGN KEY (`id_edit`) REFERENCES `tbl_editoriales` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
