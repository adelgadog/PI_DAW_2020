
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Cine
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `Cine` ;

-- -----------------------------------------------------
-- Schema Cine
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Cine` DEFAULT CHARACTER SET utf8 ;
USE `Cine` ;

-- -----------------------------------------------------
-- Table `Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Usuario` (
  `idCliente` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  `Mail` VARCHAR(45) NOT NULL,
  `Psw` VARCHAR(45) NOT NULL,
  `Admin` INT NOT NULL,
  PRIMARY KEY (`idCliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Sala`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sala` (
  `idsala` INT NOT NULL AUTO_INCREMENT,
  `Butacas` VARCHAR(45) NOT NULL,
  `Tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idsala`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Pelicula`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Pelicula` (
  `idPelicula` INT NOT NULL AUTO_INCREMENT,
  `Año` VARCHAR(45) NOT NULL,
  `Título` VARCHAR(45) NOT NULL,
  `País` VARCHAR(45) NOT NULL,
  `Género` VARCHAR(45) NOT NULL,
  `Duración` VARCHAR(45) NOT NULL,
  `Fecha de Estreno` VARCHAR(45) NOT NULL,
  `Calificación` VARCHAR(45) NOT NULL,
  `Sinopsis` VARCHAR(1000) NOT NULL,
  PRIMARY KEY (`idPelicula`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Tarifa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Tarifa` (
  `idTipo` INT NOT NULL AUTO_INCREMENT,
  `Definicion` VARCHAR(45) NOT NULL,
  `Precio` FLOAT NOT NULL,
  PRIMARY KEY (`idTipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Proyeccion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Proyeccion` (
  `idProyeccion` INT NOT NULL AUTO_INCREMENT,
  `IdSala` INT NOT NULL,
  `idPelicula` INT NOT NULL,
  `idTipo` INT NOT NULL,
  `Fecha` DATE NOT NULL,
  `Hora` TIME NOT NULL,
  PRIMARY KEY (`idProyeccion`),
  INDEX `idPelicula_idx` (`idPelicula` ASC),
  INDEX `idSala_idx` (`IdSala` ASC),
  INDEX `idTipo_idx` (`idTipo` ASC),
  CONSTRAINT `idPelicula`
    FOREIGN KEY (`idPelicula`)
    REFERENCES `Pelicula` (`idPelicula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idSala`
    FOREIGN KEY (`IdSala`)
    REFERENCES `Sala` (`idsala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idTipo`
    FOREIGN KEY (`idTipo`)
    REFERENCES `Tarifa` (`idTipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Reserva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Reserva` (
  `idReserva` INT NOT NULL AUTO_INCREMENT,
  `idUsuario` INT NOT NULL,
  `idProyección` INT NOT NULL,
  `Butacas` INT NOT NULL,
  PRIMARY KEY (`idReserva`, `idUsuario`, `idProyección`),
  INDEX `idUsuario_idx` (`idUsuario` ASC),
  INDEX `idProyección_idx` (`idProyección` ASC),
  CONSTRAINT `idUsuario`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `Usuario` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idProyección`
    FOREIGN KEY (`idProyección`)
    REFERENCES `Proyeccion` (`idProyeccion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Valoración`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Valoración` (
  `idUsuario` INT NOT NULL,
  `idPelicula` INT NOT NULL,
  `Valoración` FLOAT NOT NULL,
  INDEX `idPelicula_idx` (`idPelicula` ASC),
  INDEX `idUsuario_idx` (`idUsuario` ASC),
  CONSTRAINT `idUsuario2`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `Usuario` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idPelicula2`
    FOREIGN KEY (`idPelicula`)
    REFERENCES `Pelicula` (`idPelicula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


DROP USER IF EXISTS adminCine;
SET SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
CREATE USER 'adminCine' IDENTIFIED BY 'adminCine';

GRANT ALL ON * TO 'adminCine';

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


-- -----------------------------------------------------
-- Inserts
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Inserts `Usuario`
-- -----------------------------------------------------

INSERT INTO `usuario` (`Nombre`, `Mail`, `Psw`, `Admin`) VALUES ('administrador', 'admin@supercine.com', 'admin123', '1');
INSERT INTO `usuario` (`Nombre`, `Mail`, `Psw`, `Admin`) VALUES ('Andres', 'sitosys@hotmail.com', 'andres85', '0');

-- -----------------------------------------------------
-- Inserts `Sala`
-- -----------------------------------------------------

INSERT INTO `sala` (`Butacas`, `Tipo`) VALUES ('90', 'Normal');
INSERT INTO `sala` (`Butacas`, `Tipo`) VALUES ('110', '3D');

-- -----------------------------------------------------
-- Inserts `Pelicula`
-- -----------------------------------------------------

INSERT INTO `pelicula`(`Año`, `Título`, `País`, `Género`, `Duración`, `Fecha de Estreno`, `Calificación`, `Sinopsis`) VALUES ('2018', 'Vengadores: Infinity War', 'Estados Unidos', 'Ciencia ficción', '149 minutos', '27 de abril de 2018', 'PG-13', 'El todopoderoso Thanos ha despertado con la promesa de arrasar con todo a su paso, portando el Guantelete del Infinito, que le confiere un poder incalculable. Los únicos capaces de pararle los pies son los Vengadores y el resto de superhéroes de la galaxia, que deberán estar dispuestos a sacrificarlo todo por un bien mayor. Capitán América e Ironman deberán limar sus diferencias, Black Panther apoyará con sus tropas desde Wakanda, Thor y los Guardianes de la Galaxia e incluso Spider-Man se unirán antes de que los planes de devastación y ruina pongan fin al universo. ¿Serán capaces de frenar el avance del titán del caos?');
INSERT INTO `pelicula`(`Año`, `Título`, `País`, `Género`, `Duración`, `Fecha de Estreno`, `Calificación`, `Sinopsis`) VALUES ('2019', 'Vengadores: Endgame', 'Estados Unidos', 'Ciencia ficción', '181 minutos', '26 de abril de 2019', 'PG-13', 'Después de los eventos devastadores de "Avengers: Infinity War", el universo está en ruinas debido a las acciones de Thanos, el Titán Loco. Con la ayuda de los aliados que quedaron, los Vengadores deberán reunirse una vez más para intentar deshacer sus acciones y restaurar el orden en el universo de una vez por todas, sin importar cuáles son las consecuencias... Cuarta y última entrega de la saga "Vengadores".');

-- -----------------------------------------------------
-- Inserts `Tarifa`
-- -----------------------------------------------------

INSERT INTO `tarifa` (`idTipo`, `Definicion`, `Precio`) VALUES (NULL, 'General', '8.95');
INSERT INTO `tarifa` (`idTipo`, `Definicion`, `Precio`) VALUES (NULL, 'Espectador', '3.95');

-- -----------------------------------------------------
-- Inserts `Proyeccion`
-- -----------------------------------------------------

INSERT INTO `proyeccion` (`idProyeccion`, `IdSala`, `idPelicula`, `idTipo`, `Fecha`, `Hora`) VALUES (NULL, '1', '1', '2', '2020-06-23', '19:30:00');
INSERT INTO `proyeccion` (`idProyeccion`, `IdSala`, `idPelicula`, `idTipo`, `Fecha`, `Hora`) VALUES (NULL, '2', '2', '1', '2020-06-26', '20:00:00');

-- -----------------------------------------------------
-- Inserts `Reserva`
-- -----------------------------------------------------

INSERT INTO `reserva` (`idReserva`, `idUsuario`, `idProyección`, `Butacas`) VALUES (NULL, '2', '1', '4');
INSERT INTO `reserva` (`idReserva`, `idUsuario`, `idProyección`, `Butacas`) VALUES (NULL, '2', '2', '5');

-- -----------------------------------------------------
-- Inserts `Valoración`
-- -----------------------------------------------------

INSERT INTO `valoración` (`idUsuario`, `idPelicula`, `Valoración`) VALUES ('2', '1', '9');
INSERT INTO `valoración` (`idUsuario`, `idPelicula`, `Valoración`) VALUES ('2', '2', '9.5');