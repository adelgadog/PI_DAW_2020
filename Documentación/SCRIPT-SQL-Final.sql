-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-05-2020 a las 16:01:23
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- -----------------------------------------------------
-- Schema Cine
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `Cine` ;


--
-- Base de datos: `cine`
--
CREATE DATABASE IF NOT EXISTS `cine` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cine`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

DROP TABLE IF EXISTS `pelicula`;
CREATE TABLE IF NOT EXISTS `pelicula` (
  `idPelicula` int(11) NOT NULL AUTO_INCREMENT,
  `Año` varchar(45) NOT NULL,
  `Título` varchar(45) NOT NULL,
  `País` varchar(45) NOT NULL,
  `Género` varchar(45) NOT NULL,
  `Duración` varchar(45) NOT NULL,
  `Fecha de Estreno` varchar(45) NOT NULL,
  `Calificación` varchar(45) NOT NULL,
  `Sinopsis` varchar(1000) NOT NULL,
  `Cartel` varchar(400) NOT NULL,
  `Video` varchar(200) NOT NULL,
  PRIMARY KEY (`idPelicula`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pelicula`
--

INSERT INTO `pelicula` (`idPelicula`, `Año`, `Título`, `País`, `Género`, `Duración`, `Fecha de Estreno`, `Calificación`, `Sinopsis`, `Cartel`, `Video`) VALUES
(1, '2018', 'Vengadores: Infinity War', 'Estados Unidos', 'Ciencia ficción', '149 minutos', '27 de abril de 2018', 'PG-13', 'El todopoderoso Thanos ha despertado con la promesa de arrasar con todo a su paso, portando el Guantelete del Infinito, que le confiere un poder incalculable. Los únicos capaces de pararle los pies son los Vengadores y el resto de superhéroes de la galaxia, que deberán estar dispuestos a sacrificarlo todo por un bien mayor. Capitán América e Ironman deberán limar sus diferencias, Black Panther apoyará con sus tropas desde Wakanda, Thor y los Guardianes de la Galaxia e incluso Spider-Man se unirán antes de que los planes de devastación y ruina pongan fin al universo. ¿Serán capaces de frenar el avance del titán del caos?', 'M/MV5BMjMxNjY2MDU1OV5BMl5BanBnXkFtZTgwNzY1MTUwNTM@._V1_SY1000_CR0,0,674,1000_AL_.jpg', 'https://www.youtube.com/embed/-f5PwE_Q8Fs'),
(2, '2019', 'Vengadores: Endgame', 'Estados Unidos', 'Ciencia ficción', '181 minutos', '26 de abril de 2019', 'PG-13', 'Después de los eventos devastadores de \"Avengers: Infinity War\", el universo está en ruinas debido a las acciones de Thanos, el Titán Loco. Con la ayuda de los aliados que quedaron, los Vengadores deberán reunirse una vez más para intentar deshacer sus acciones y restaurar el orden en el universo de una vez por todas, sin importar cuáles son las consecuencias... Cuarta y última entrega de la saga \"Vengadores\".', 'M/MV5BMTc5MDE2ODcwNV5BMl5BanBnXkFtZTgwMzI2NzQ2NzM@._V1_SY1000_CR0,0,674,1000_AL_.jpg', 'https://www.youtube.com/embed/svLSGZkTzC0'),
(3, '2001', 'ESDLA: La comunidad del anillo', 'Nueva Zelanda', 'Fantástico, Aventuras.', '180 min.', '19 de diciembre de 2001 ', 'PG-13', 'En la Tierra Media, el Señor Oscuro Saurón ordenó a los Elfos que forjaran los Grandes Anillos de Poder. Tres para los reyes Elfos, siete para los Señores Enanos, y nueve para los Hombres Mortales. Pero Saurón también forjó, en secreto, el Anillo Único, que tiene el poder de esclavizar toda la Tierra Media. Con la ayuda de sus amigos y de valientes aliados, el joven hobbit Frodo emprende un peligroso viaje con la misión de destruir el Anillo Único. Pero el malvado Sauron ordena la persecución del grupo, compuesto por Frodo y sus leales amigos hobbits, un mago, un hombre, un elfo y un enano. La misión es casi suicida pero necesaria, pues si Sauron con su ejército de orcos lograra recuperar el Anillo, sería el final de la Tierra Media.', 'M/MV5BN2EyZjM3NzUtNWUzMi00MTgxLWI0NTctMzY4M2VlOTdjZWRiXkEyXkFqcGdeQXVyNDUzOTQ5MjY@._V1_SY999_CR0,0,673,999_AL_.jpg', 'https://www.youtube.com/embed/V75dMMIW2B4'),
(4, '2002', 'ESDLA: Las dos torres', 'Nueva Zelanda', 'Fantástico, Aventuras', '179 min.', '18 Diciembre 2002 ', 'PG-13', 'Tras la disolución de la Compañía del Anillo, Frodo y su fiel amigo Sam se dirigen hacia Mordor para destruir el Anillo Único y acabar con el poder de Sauron, pero les sigue un siniestro personaje llamado Gollum. Mientras, y tras la dura batalla contra los orcos donde cayó Boromir, el hombre Aragorn, el elfo Legolas y el enano Gimli intentan rescatar a los medianos Merry y Pipin, secuestrados por los orcos de Mordor. Por su parte, Saurón y el traidor Sarumán continúan con sus planes en Mordor, a la espera de la guerra contra las razas libres de la Tierra Media.', 'M/MV5BNGE5MzIyNTAtNWFlMC00NDA2LWJiMjItMjc4Yjg1OWM5NzhhXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SY1000_CR0,0,684,1000_AL_.jpg', 'https://www.youtube.com/embed/hYcw5ksV8YQ'),
(5, '2003', 'ESDLA: El retorno del rey', 'Nueva Zelanda', 'Fantástico, Aventuras.', '201 min.', '17 Diciembre2003', 'PG-13', 'Las fuerzas de Saruman han sido destruidas, y su fortaleza sitiada. Ha llegado el momento de decidir el destino de la Tierra Media, y, por primera vez, parece que hay una pequeña esperanza. El interés del señor oscuro Sauron se centra ahora en Gondor, el último reducto de los hombres, cuyo trono será reclamado por Aragorn. Sauron se dispone a lanzar un ataque decisivo contra Gondor. Mientras tanto, Frodo y Sam continuan su camino hacia Mordor, con la esperanza de llegar al Monte del Destino.', 'M/MV5BNzA5ZDNlZWMtM2NhNS00NDJjLTk4NDItYTRmY2EwMWZlMTY3XkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SY1000_CR0,0,675,1000_AL_.jpg', 'https://www.youtube.com/embed/r5X-hFf6Bwo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyeccion`
--

DROP TABLE IF EXISTS `proyeccion`;
CREATE TABLE IF NOT EXISTS `proyeccion` (
  `idProyeccion` int(11) NOT NULL AUTO_INCREMENT,
  `IdSala` int(11) NOT NULL,
  `idPelicula` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  PRIMARY KEY (`idProyeccion`),
  KEY `idPelicula_idx` (`idPelicula`),
  KEY `idSala_idx` (`IdSala`),
  KEY `idTipo_idx` (`idTipo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyeccion`
--

INSERT INTO `proyeccion` (`idProyeccion`, `IdSala`, `idPelicula`, `idTipo`, `Fecha`, `Hora`) VALUES
(1, 1, 1, 2, '2020-06-23', '19:30:00'),
(2, 2, 2, 1, '2020-06-26', '20:00:00'),
(3, 1, 1, 3, '2020-06-27', '12:00:00'),
(4, 2, 1, 1, '2020-06-27', '22:00:00'),
(5, 3, 2, 2, '2020-06-30', '20:00:00'),
(6, 1, 3, 1, '2020-06-29', '20:00:00'),
(7, 3, 4, 3, '2020-06-28', '12:00:00'),
(8, 1, 5, 2, '2020-06-30', '17:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

DROP TABLE IF EXISTS `reserva`;
CREATE TABLE IF NOT EXISTS `reserva` (
  `idReserva` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idProyección` int(11) NOT NULL,
  `Butacas` int(11) NOT NULL,
  PRIMARY KEY (`idReserva`,`idUsuario`,`idProyección`),
  KEY `idUsuario_idx` (`idUsuario`),
  KEY `idProyección_idx` (`idProyección`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`idReserva`, `idUsuario`, `idProyección`, `Butacas`) VALUES
(1, 2, 1, 4),
(2, 2, 2, 5),
(3, 2, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

DROP TABLE IF EXISTS `sala`;
CREATE TABLE IF NOT EXISTS `sala` (
  `idsala` int(11) NOT NULL AUTO_INCREMENT,
  `Butacas` varchar(45) NOT NULL,
  `Tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`idsala`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sala`
--

INSERT INTO `sala` (`idsala`, `Butacas`, `Tipo`) VALUES
(1, '90', 'Normal'),
(2, '110', '3D'),
(3, '90', 'Panoramica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifa`
--

DROP TABLE IF EXISTS `tarifa`;
CREATE TABLE IF NOT EXISTS `tarifa` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `Definicion` varchar(45) NOT NULL,
  `Descripcion` varchar(400) NOT NULL,
  `Precio` float NOT NULL,
  PRIMARY KEY (`idTipo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tarifa`
--

INSERT INTO `tarifa` (`idTipo`, `Definicion`, `Descripcion`, `Precio`) VALUES
(1, 'General', 'Entrada General. Se le pueden aplicar descuentos.', 8.95),
(2, 'Espectador', 'Entrada Día del Espectador. Solo aplicable los Miércoles. No se le pueden aplicar descuentos.', 3.95),
(3, 'Matinal', 'Entrada Matinal. Solo aplicable Sábados y Domingos, sesión de las 12:00. No se le pueden aplicar descuentos.', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Mail` varchar(45) NOT NULL,
  `Psw` varchar(45) NOT NULL,
  `Admin` int(11) NOT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idCliente`, `Nombre`, `Mail`, `Psw`, `Admin`) VALUES
(1, 'administrador', 'admin@supercine.com', 'admin123', 1),
(2, 'Andres', 'sitosys@hotmail.com', 'andres85', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoración`
--

DROP TABLE IF EXISTS `valoración`;
CREATE TABLE IF NOT EXISTS `valoración` (
  `idUsuario` int(11) NOT NULL,
  `idPelicula` int(11) NOT NULL,
  `Valoración` float NOT NULL,
  KEY `idPelicula_idx` (`idPelicula`),
  KEY `idUsuario_idx` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `valoración`
--

INSERT INTO `valoración` (`idUsuario`, `idPelicula`, `Valoración`) VALUES
(2, 1, 9),
(2, 2, 9.5);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `proyeccion`
--
ALTER TABLE `proyeccion`
  ADD CONSTRAINT `idPelicula` FOREIGN KEY (`idPelicula`) REFERENCES `pelicula` (`idPelicula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idSala` FOREIGN KEY (`IdSala`) REFERENCES `sala` (`idsala`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idTipo` FOREIGN KEY (`idTipo`) REFERENCES `tarifa` (`idTipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `idProyección` FOREIGN KEY (`idProyección`) REFERENCES `proyeccion` (`idProyeccion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `valoración`
--
ALTER TABLE `valoración`
  ADD CONSTRAINT `idPelicula2` FOREIGN KEY (`idPelicula`) REFERENCES `pelicula` (`idPelicula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idUsuario2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;



DROP USER IF EXISTS adminCine;
SET SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
CREATE USER 'adminCine' IDENTIFIED BY 'adminCine';

GRANT ALL ON * TO 'adminCine';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
