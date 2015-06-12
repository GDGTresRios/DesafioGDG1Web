-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema gdg_centrosul
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gdg_centrosul
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gdg_centrosul` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `gdg_centrosul` ;

-- -----------------------------------------------------
-- Table `gdg_centrosul`.`categorias_colaboradores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gdg_centrosul`.`categorias_colaboradores` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `logo` TEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gdg_centrosul`.`colaboradores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gdg_centrosul`.`colaboradores` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(70) NOT NULL,
  `descricao` VARCHAR(100) NOT NULL,
  `logo` TEXT NULL,
  `descricao_detalhada` TEXT NULL,
  `endereco_virtual` VARCHAR(70) NULL,
  `email` VARCHAR(70) NULL,
  `telefone` VARCHAR(20) NULL,
  `endereco` TEXT NULL,
  `patrocinador` TINYINT(1) NOT NULL,
  `palestrante` TINYINT(1) NOT NULL,
  `expositor` TINYINT(1) NOT NULL,
  `fk_categoria` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_colaboradores_categorias_colaboradores_idx` (`fk_categoria` ASC),
  CONSTRAINT `fk_colaboradores_categorias_colaboradores`
    FOREIGN KEY (`fk_categoria`)
    REFERENCES `gdg_centrosul`.`categorias_colaboradores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gdg_centrosul`.`categorias_eventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gdg_centrosul`.`categorias_eventos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gdg_centrosul`.`eventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gdg_centrosul`.`eventos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(70) NOT NULL,
  `descricao` VARCHAR(100) NULL,
  `descricao_detalhada` TEXT NULL,
  `data_hora` DATETIME NOT NULL,
  `duracao` TIME NULL,
  `local` VARCHAR(45) NULL,
  `fk_categoria` INT NOT NULL,
  `fk_colaborador` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_eventos_categorias_eventos1_idx` (`fk_categoria` ASC),
  INDEX `fk_eventos_colaboradores1_idx` (`fk_colaborador` ASC),
  CONSTRAINT `fk_eventos_categorias_eventos1`
    FOREIGN KEY (`fk_categoria`)
    REFERENCES `gdg_centrosul`.`categorias_eventos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_colaboradores1`
    FOREIGN KEY (`fk_colaborador`)
    REFERENCES `gdg_centrosul`.`colaboradores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gdg_centrosul`.`configuracao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gdg_centrosul`.`configuracao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(70) NOT NULL,
  `descricao` VARCHAR(100) NULL,
  `logo` TEXT NULL,
  `mapa` TEXT NULL,
  `endereco` TEXT NULL,
  `telefone` VARCHAR(20) NULL,
  `versao` VARCHAR(10) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
