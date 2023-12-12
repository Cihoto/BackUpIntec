-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema intech
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema intech
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `intech` DEFAULT CHARACTER SET utf8 ;
USE `intech` ;

-- -----------------------------------------------------
-- Table `intech`.`marca`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`marca` ;

CREATE TABLE IF NOT EXISTS `intech`.`marca` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `marca` VARCHAR(45) NOT NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  `delete` TINYINT NULL,
  `deleteAt` DATE NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `intech`.`modelo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`modelo` ;

CREATE TABLE IF NOT EXISTS `intech`.`modelo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `modelo` VARCHAR(45) NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  `delete` TINYINT NULL,
  `deleteAt` DATE NULL,
  `marca_id` INT NOT NULL,
  PRIMARY KEY (`id`, `marca_id`),
  INDEX `fk_modelo_marca1_idx` (`marca_id` ASC),
  CONSTRAINT `fk_modelo_marca1`
    FOREIGN KEY (`marca_id`)
    REFERENCES `intech`.`marca` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intech`.`categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`categoria` ;

CREATE TABLE IF NOT EXISTS `intech`.`categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `desc` TEXT NOT NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NOT NULL,
  `delete` VARCHAR(45) NULL,
  `deleteAt` DATE NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intech`.`item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`item` ;

CREATE TABLE IF NOT EXISTS `intech`.`item` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `item` VARCHAR(45) NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  `delete` TINYINT NULL,
  `deleteAt` DATE NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `intech`.`categoria_has_item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`categoria_has_item` ;

CREATE TABLE IF NOT EXISTS `intech`.`categoria_has_item` (
  `id` INT NOT NULL,
  `categoria_id` INT NOT NULL,
  `item_id` INT NOT NULL,
  PRIMARY KEY (`id`, `categoria_id`, `item_id`),
  INDEX `fk_categoria_has_item_item1_idx` (`item_id` ASC),
  INDEX `fk_categoria_has_item_categoria1_idx` (`categoria_id` ASC),
  CONSTRAINT `fk_categoria_has_item_categoria1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `intech`.`categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_categoria_has_item_item1`
    FOREIGN KEY (`item_id`)
    REFERENCES `intech`.`item` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intech`.`producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`producto` ;

CREATE TABLE IF NOT EXISTS `intech`.`producto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `desc` TEXT NOT NULL,
  `modelo_id` INT NOT NULL,
  `categoria_has_item_id` INT NOT NULL,
  `codigo_barra` LONGTEXT NOT NULL,
  `precio_compra` INT NOT NULL,
  `precio_arriendo` INT NOT NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NOT NULL,
  `delete` TINYINT NULL,
  `deleteAt` DATE NULL,
  PRIMARY KEY (`id`, `categoria_has_item_id`),
  INDEX `fk_producto_modelo1_idx` (`modelo_id` ASC),
  INDEX `fk_producto_categoria_has_item1_idx` (`categoria_has_item_id` ASC),
  CONSTRAINT `fk_producto_modelo1`
    FOREIGN KEY (`modelo_id`)
    REFERENCES `intech`.`modelo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_categoria_has_item1`
    FOREIGN KEY (`categoria_has_item_id`)
    REFERENCES `intech`.`categoria_has_item` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intech`.`pais`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`pais` ;

CREATE TABLE IF NOT EXISTS `intech`.`pais` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pais` VARCHAR(45) NOT NULL,
  `codigo` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intech`.`region`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`region` ;

CREATE TABLE IF NOT EXISTS `intech`.`region` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `region` VARCHAR(45) NOT NULL,
  `codigo` VARCHAR(45) NOT NULL,
  `numero` INT NOT NULL,
  `pais_id` INT NOT NULL,
  PRIMARY KEY (`id`, `pais_id`),
  INDEX `fk_region_pais1_idx` (`pais_id` ASC),
  CONSTRAINT `fk_region_pais1`
    FOREIGN KEY (`pais_id`)
    REFERENCES `intech`.`pais` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intech`.`direccion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`direccion` ;

CREATE TABLE IF NOT EXISTS `intech`.`direccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `direccion` VARCHAR(45) NOT NULL,
  `numero` VARCHAR(45) NOT NULL,
  `dpto` VARCHAR(45) NULL,
  `extra` VARCHAR(45) NULL,
  `postal_code` VARCHAR(45) NULL,
  `region_id` INT NOT NULL,
  PRIMARY KEY (`id`, `region_id`),
  INDEX `fk_direccion_region1_idx` (`region_id` ASC),
  CONSTRAINT `fk_direccion_region1`
    FOREIGN KEY (`region_id`)
    REFERENCES `intech`.`region` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intech`.`bodega`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`bodega` ;

CREATE TABLE IF NOT EXISTS `intech`.`bodega` (
  `idbodega` INT NOT NULL AUTO_INCREMENT,
  `bodega` VARCHAR(45) NOT NULL,
  `direccion_id` INT NOT NULL,
  PRIMARY KEY (`idbodega`, `direccion_id`),
  INDEX `fk_bodega_direccion1_idx` (`direccion_id` ASC),
  CONSTRAINT `fk_bodega_direccion1`
    FOREIGN KEY (`direccion_id`)
    REFERENCES `intech`.`direccion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intech`.`posicion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`posicion` ;

CREATE TABLE IF NOT EXISTS `intech`.`posicion` (
  `idposicion` INT NOT NULL AUTO_INCREMENT,
  `codigo_posicion` VARCHAR(45) NOT NULL,
  `codigo_barra` LONGTEXT NOT NULL,
  `bodega_idbodega` INT NOT NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  `delete` TINYINT NULL,
  `deleteAt` DATE NULL,
  PRIMARY KEY (`idposicion`, `bodega_idbodega`),
  INDEX `fk_posicion_bodega1_idx` (`bodega_idbodega` ASC),
  CONSTRAINT `fk_posicion_bodega1`
    FOREIGN KEY (`bodega_idbodega`)
    REFERENCES `intech`.`bodega` (`idbodega`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intech`.`comuna`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`comuna` ;

CREATE TABLE IF NOT EXISTS `intech`.`comuna` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comuna` VARCHAR(45) NOT NULL,
  `region_id` INT NOT NULL,
  PRIMARY KEY (`id`, `region_id`),
  INDEX `fk_comuna_region1_idx` (`region_id` ASC),
  CONSTRAINT `fk_comuna_region1`
    FOREIGN KEY (`region_id`)
    REFERENCES `intech`.`region` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intech`.`localidad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`localidad` ;

CREATE TABLE IF NOT EXISTS `intech`.`localidad` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `localidad` VARCHAR(45) NOT NULL,
  `comuna_id` INT NOT NULL,
  PRIMARY KEY (`id`, `comuna_id`),
  INDEX `fk_localidad_comuna_idx` (`comuna_id` ASC),
  CONSTRAINT `fk_localidad_comuna`
    FOREIGN KEY (`comuna_id`)
    REFERENCES `intech`.`comuna` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intech`.`inventario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`inventario` ;

CREATE TABLE IF NOT EXISTS `intech`.`inventario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `producto_id` INT NOT NULL,
  `cantidad` INT NOT NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  PRIMARY KEY (`id`, `producto_id`),
  INDEX `fk_inventario_producto1_idx` (`producto_id` ASC),
  CONSTRAINT `fk_inventario_producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `intech`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intech`.`recepcion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`recepcion` ;

CREATE TABLE IF NOT EXISTS `intech`.`recepcion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `intech`.`lugar`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`lugar` ;

CREATE TABLE IF NOT EXISTS `intech`.`lugar` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lugar` VARCHAR(45) NOT NULL,
  `createAt` DATE NOT NULL,
  `direccion_id` INT NOT NULL,
  PRIMARY KEY (`id`, `direccion_id`),
  INDEX `fk_lugar_direccion1_idx` (`direccion_id` ASC),
  CONSTRAINT `fk_lugar_direccion1`
    FOREIGN KEY (`direccion_id`)
    REFERENCES `intech`.`direccion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intech`.`estado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`estado` ;

CREATE TABLE IF NOT EXISTS `intech`.`estado` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `estado` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `intech`.`proyecto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`proyecto` ;

CREATE TABLE IF NOT EXISTS `intech`.`proyecto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre_proyecto` VARCHAR(100) NOT NULL,
  `lugar_id` INT NOT NULL,
  `fecha_inicio` DATE NOT NULL,
  `fecha_termino` DATE NOT NULL,
  `estado_id` INT NOT NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  `delete` TINYINT NULL,
  `deleteAt` DATE NULL,
  PRIMARY KEY (`id`, `lugar_id`, `estado_id`),
  INDEX `fk_proyecto_lugar1_idx` (`lugar_id` ASC),
  INDEX `fk_proyecto_estado1_idx` (`estado_id` ASC),
  CONSTRAINT `fk_proyecto_lugar1`
    FOREIGN KEY (`lugar_id`)
    REFERENCES `intech`.`lugar` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_proyecto_estado1`
    FOREIGN KEY (`estado_id`)
    REFERENCES `intech`.`estado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intech`.`proyecto_has_producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`proyecto_has_producto` ;

CREATE TABLE IF NOT EXISTS `intech`.`proyecto_has_producto` (
  `proyecto_id` INT NOT NULL,
  `producto_id` INT NOT NULL,
  `cantidad` INT NOT NULL,
  `arriendo` INT NULL,
  PRIMARY KEY (`producto_id`, `proyecto_id`),
  INDEX `fk_proyecto_has_producto_producto1_idx` (`producto_id` ASC),
  INDEX `fk_proyecto_has_producto_proyecto1_idx` (`proyecto_id` ASC),
  CONSTRAINT `fk_proyecto_has_producto_proyecto1`
    FOREIGN KEY (`proyecto_id`)
    REFERENCES `intech`.`proyecto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_proyecto_has_producto_producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `intech`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intech`.`producto_has_posicion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`producto_has_posicion` ;

CREATE TABLE IF NOT EXISTS `intech`.`producto_has_posicion` (
  `producto_id` INT NOT NULL,
  `posicion_idposicion` INT NOT NULL,
  `cantidad` INT NOT NULL,
  PRIMARY KEY (`producto_id`, `posicion_idposicion`),
  INDEX `fk_producto_has_posicion_posicion1_idx` (`posicion_idposicion` ASC),
  INDEX `fk_producto_has_posicion_producto1_idx` (`producto_id` ASC),
  CONSTRAINT `fk_producto_has_posicion_producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `intech`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_has_posicion_posicion1`
    FOREIGN KEY (`posicion_idposicion`)
    REFERENCES `intech`.`posicion` (`idposicion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intech`.`recepcion_has_producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`recepcion_has_producto` ;

CREATE TABLE IF NOT EXISTS `intech`.`recepcion_has_producto` (
  `recepcion_id` INT NOT NULL,
  `producto_id` INT NOT NULL,
  `cantidad` INT NOT NULL,
  PRIMARY KEY (`recepcion_id`, `producto_id`),
  INDEX `fk_recepcion_has_producto_producto1_idx` (`producto_id` ASC),
  INDEX `fk_recepcion_has_producto_recepcion1_idx` (`recepcion_id` ASC),
  CONSTRAINT `fk_recepcion_has_producto_recepcion1`
    FOREIGN KEY (`recepcion_id`)
    REFERENCES `intech`.`recepcion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recepcion_has_producto_producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `intech`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intech`.`rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`rol` ;

CREATE TABLE IF NOT EXISTS `intech`.`rol` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `rol` VARCHAR(45) NOT NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  `delete` TINYINT NULL,
  `deleteAt` DATE NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `intech`.`especialidad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`especialidad` ;

CREATE TABLE IF NOT EXISTS `intech`.`especialidad` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `especialidad` VARCHAR(45) NOT NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  `delete` TINYINT NULL,
  `deleteAt` DATE NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `intech`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`usuario` ;

CREATE TABLE IF NOT EXISTS `intech`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `createAt` DATE NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `intech`.`cargo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`cargo` ;

CREATE TABLE IF NOT EXISTS `intech`.`cargo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cargo` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intech`.`personal`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`personal` ;

CREATE TABLE IF NOT EXISTS `intech`.`personal` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `rut` VARCHAR(45) NULL,
  `usuario_id` INT NOT NULL,
  `cargo_id` INT NOT NULL,
  `rol_id` INT NOT NULL,
  `especialidad_id` INT NOT NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  `delete` TINYINT NULL,
  `deleteAt` DATE NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_personal_rol1_idx` (`rol_id` ASC),
  INDEX `fk_personal_especialidad1_idx` (`especialidad_id` ASC),
  INDEX `fk_personal_usuario1_idx` (`usuario_id` ASC),
  INDEX `fk_personal_cargo1_idx` (`cargo_id` ASC),
  CONSTRAINT `fk_personal_rol1`
    FOREIGN KEY (`rol_id`)
    REFERENCES `intech`.`rol` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_personal_especialidad1`
    FOREIGN KEY (`especialidad_id`)
    REFERENCES `intech`.`especialidad` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_personal_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `intech`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_personal_cargo1`
    FOREIGN KEY (`cargo_id`)
    REFERENCES `intech`.`cargo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intech`.`personal_has_proyecto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intech`.`personal_has_proyecto` ;

CREATE TABLE IF NOT EXISTS `intech`.`personal_has_proyecto` (
  `personal_id` INT NOT NULL,
  `proyecto_id` INT NOT NULL,
  `costo` INT NULL,
  PRIMARY KEY (`personal_id`, `proyecto_id`),
  INDEX `fk_personal_has_proyecto_proyecto1_idx` (`proyecto_id` ASC),
  INDEX `fk_personal_has_proyecto_personal1_idx` (`personal_id` ASC),
  CONSTRAINT `fk_personal_has_proyecto_personal1`
    FOREIGN KEY (`personal_id`)
    REFERENCES `intech`.`personal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_personal_has_proyecto_proyecto1`
    FOREIGN KEY (`proyecto_id`)
    REFERENCES `intech`.`proyecto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
