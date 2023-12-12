-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema intec
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema intec
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `intec` DEFAULT CHARACTER SET utf8 ;
USE `intec` ;

-- -----------------------------------------------------
-- Table `intec`.`categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`categoria` ;

CREATE TABLE IF NOT EXISTS `intec`.`categoria` (
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
-- Table `intec`.`item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`item` ;

CREATE TABLE IF NOT EXISTS `intec`.`item` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `item` VARCHAR(45) NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  `delete` TINYINT NULL,
  `deleteAt` DATE NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `intec`.`categoria_has_item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`categoria_has_item` ;

CREATE TABLE IF NOT EXISTS `intec`.`categoria_has_item` (
  `id` INT NOT NULL,
  `categoria_id` INT NOT NULL,
  `item_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_categoria_has_item_item1_idx` (`item_id` ASC),
  INDEX `fk_categoria_has_item_categoria1_idx` (`categoria_id` ASC),
  CONSTRAINT `fk_categoria_has_item_categoria1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `intec`.`categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_categoria_has_item_item1`
    FOREIGN KEY (`item_id`)
    REFERENCES `intec`.`item` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intec`.`marca`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`marca` ;

CREATE TABLE IF NOT EXISTS `intec`.`marca` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `marca` VARCHAR(45) NOT NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  `delete` TINYINT NULL,
  `deleteAt` DATE NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `intec`.`producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`producto` ;

CREATE TABLE IF NOT EXISTS `intec`.`producto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `desc` TEXT NOT NULL,
  `marca_id` INT NOT NULL,
  `categoria_has_item_id` INT NOT NULL,
  `codigo_barra` LONGTEXT NOT NULL,
  `precio_compra` INT NOT NULL,
  `precio_arriendo` INT NOT NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NOT NULL,
  `delete` TINYINT NULL,
  `deleteAt` DATE NULL,
  PRIMARY KEY (`id`, `marca_id`, `categoria_has_item_id`),
  INDEX `fk_producto_categoria_has_item1_idx` (`categoria_has_item_id` ASC),
  INDEX `fk_producto_marca1_idx` (`marca_id` ASC),
  CONSTRAINT `fk_producto_categoria_has_item1`
    FOREIGN KEY (`categoria_has_item_id`)
    REFERENCES `intec`.`categoria_has_item` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_marca1`
    FOREIGN KEY (`marca_id`)
    REFERENCES `intec`.`marca` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intec`.`pais`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`pais` ;

CREATE TABLE IF NOT EXISTS `intec`.`pais` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pais` VARCHAR(45) NOT NULL,
  `codigo` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intec`.`region`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`region` ;

CREATE TABLE IF NOT EXISTS `intec`.`region` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `region` VARCHAR(45) NOT NULL,
  `codigo` VARCHAR(45) NOT NULL,
  `numero` INT NOT NULL,
  `pais_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_region_pais1_idx` (`pais_id` ASC),
  CONSTRAINT `fk_region_pais1`
    FOREIGN KEY (`pais_id`)
    REFERENCES `intec`.`pais` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intec`.`comuna`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`comuna` ;

CREATE TABLE IF NOT EXISTS `intec`.`comuna` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comuna` VARCHAR(45) NOT NULL,
  `region_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comuna_region1_idx` (`region_id` ASC),
  CONSTRAINT `fk_comuna_region1`
    FOREIGN KEY (`region_id`)
    REFERENCES `intec`.`region` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intec`.`direccion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`direccion` ;

CREATE TABLE IF NOT EXISTS `intec`.`direccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `direccion` VARCHAR(45) NOT NULL,
  `numero` VARCHAR(45) NOT NULL,
  `extra` VARCHAR(45) NULL,
  `dpto` VARCHAR(45) NULL,
  `postal_code` VARCHAR(45) NULL,
  `comuna_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_direccion_comuna1_idx` (`comuna_id` ASC),
  CONSTRAINT `fk_direccion_comuna1`
    FOREIGN KEY (`comuna_id`)
    REFERENCES `intec`.`comuna` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intec`.`bodega`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`bodega` ;

CREATE TABLE IF NOT EXISTS `intec`.`bodega` (
  `idbodega` INT NOT NULL AUTO_INCREMENT,
  `bodega` VARCHAR(45) NOT NULL,
  `direccion_id` INT NOT NULL,
  PRIMARY KEY (`idbodega`),
  INDEX `fk_bodega_direccion1_idx` (`direccion_id` ASC),
  CONSTRAINT `fk_bodega_direccion1`
    FOREIGN KEY (`direccion_id`)
    REFERENCES `intec`.`direccion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intec`.`posicion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`posicion` ;

CREATE TABLE IF NOT EXISTS `intec`.`posicion` (
  `idposicion` INT NOT NULL AUTO_INCREMENT,
  `codigo_posicion` VARCHAR(45) NOT NULL,
  `codigo_barra` LONGTEXT NOT NULL,
  `bodega_idbodega` INT NOT NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  `delete` TINYINT NULL,
  `deleteAt` DATE NULL,
  PRIMARY KEY (`idposicion`),
  INDEX `fk_posicion_bodega1_idx` (`bodega_idbodega` ASC),
  CONSTRAINT `fk_posicion_bodega1`
    FOREIGN KEY (`bodega_idbodega`)
    REFERENCES `intec`.`bodega` (`idbodega`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intec`.`localidad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`localidad` ;

CREATE TABLE IF NOT EXISTS `intec`.`localidad` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `localidad` VARCHAR(45) NOT NULL,
  `comuna_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_localidad_comuna_idx` (`comuna_id` ASC),
  CONSTRAINT `fk_localidad_comuna`
    FOREIGN KEY (`comuna_id`)
    REFERENCES `intec`.`comuna` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intec`.`inventario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`inventario` ;

CREATE TABLE IF NOT EXISTS `intec`.`inventario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `producto_id` INT NOT NULL,
  `cantidad` INT NOT NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  PRIMARY KEY (`id`, `producto_id`),
  INDEX `fk_inventario_producto1_idx` (`producto_id` ASC),
  CONSTRAINT `fk_inventario_producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `intec`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intec`.`proveedor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`proveedor` ;

CREATE TABLE IF NOT EXISTS `intec`.`proveedor` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre_fantasia` VARCHAR(45) NOT NULL,
  `razon_social` VARCHAR(255) NULL,
  `datos_facturacion` VARCHAR(255) NULL,
  `contacto` VARCHAR(45) NULL,
  `datos_contacto` VARCHAR(255) NULL,
  `proveedorcol` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intec`.`recepcion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`recepcion` ;

CREATE TABLE IF NOT EXISTS `intec`.`recepcion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  `proveedor_id` INT NOT NULL,
  PRIMARY KEY (`id`, `proveedor_id`),
  INDEX `fk_recepcion_proveedor1_idx` (`proveedor_id` ASC),
  CONSTRAINT `fk_recepcion_proveedor1`
    FOREIGN KEY (`proveedor_id`)
    REFERENCES `intec`.`proveedor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intec`.`lugar`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`lugar` ;

CREATE TABLE IF NOT EXISTS `intec`.`lugar` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lugar` VARCHAR(45) NOT NULL,
  `createAt` DATE NOT NULL,
  `direccion_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_lugar_direccion1_idx` (`direccion_id` ASC),
  CONSTRAINT `fk_lugar_direccion1`
    FOREIGN KEY (`direccion_id`)
    REFERENCES `intec`.`direccion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intec`.`gastos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`gastos` ;

CREATE TABLE IF NOT EXISTS `intec`.`gastos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `gasto` VARCHAR(255) NULL,
  `monto` VARCHAR(45) NULL,
  `proveedor_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_gastos_proveedor1_idx` (`proveedor_id` ASC),
  CONSTRAINT `fk_gastos_proveedor1`
    FOREIGN KEY (`proveedor_id`)
    REFERENCES `intec`.`proveedor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intec`.`arriendos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`arriendos` ;

CREATE TABLE IF NOT EXISTS `intec`.`arriendos` (
  `idarriendos` INT NOT NULL AUTO_INCREMENT,
  `item` VARCHAR(255) NULL,
  `costo` VARCHAR(45) NULL,
  `proveedor_id` INT NOT NULL,
  PRIMARY KEY (`idarriendos`, `proveedor_id`),
  INDEX `fk_arriendos_proveedor1_idx` (`proveedor_id` ASC),
  CONSTRAINT `fk_arriendos_proveedor1`
    FOREIGN KEY (`proveedor_id`)
    REFERENCES `intec`.`proveedor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intec`.`cliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`cliente` ;

CREATE TABLE IF NOT EXISTS `intec`.`cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intec`.`proyecto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`proyecto` ;

CREATE TABLE IF NOT EXISTS `intec`.`proyecto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre_proyecto` VARCHAR(100) NOT NULL,
  `lugar_id` INT NOT NULL,
  `fecha_inicio` DATE NOT NULL,
  `fecha_termino` DATE NOT NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  `delete` TINYINT NULL,
  `deleteAt` DATE NULL,
  `gastos_id` INT NULL,
  `arriendos_idarriendos` INT NULL,
  `cliente_id` INT NOT NULL,
  PRIMARY KEY (`id`, `lugar_id`, `cliente_id`),
  INDEX `fk_proyecto_lugar1_idx` (`lugar_id` ASC),
  INDEX `fk_proyecto_gastos1_idx` (`gastos_id` ASC),
  INDEX `fk_proyecto_arriendos1_idx` (`arriendos_idarriendos` ASC),
  INDEX `fk_proyecto_cliente1_idx` (`cliente_id` ASC),
  CONSTRAINT `fk_proyecto_lugar1`
    FOREIGN KEY (`lugar_id`)
    REFERENCES `intec`.`lugar` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_proyecto_gastos1`
    FOREIGN KEY (`gastos_id`)
    REFERENCES `intec`.`gastos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_proyecto_arriendos1`
    FOREIGN KEY (`arriendos_idarriendos`)
    REFERENCES `intec`.`arriendos` (`idarriendos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_proyecto_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `intec`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intec`.`modelo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`modelo` ;

CREATE TABLE IF NOT EXISTS `intec`.`modelo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `modelo` VARCHAR(45) NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  `delete` TINYINT NULL,
  `deleteAt` DATE NULL,
  `marca_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_modelo_marca1_idx` (`marca_id` ASC),
  CONSTRAINT `fk_modelo_marca1`
    FOREIGN KEY (`marca_id`)
    REFERENCES `intec`.`marca` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intec`.`proyecto_has_producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`proyecto_has_producto` ;

CREATE TABLE IF NOT EXISTS `intec`.`proyecto_has_producto` (
  `proyecto_id` INT NOT NULL,
  `producto_id` INT NOT NULL,
  `cantidad` INT NOT NULL,
  `arriendo` INT NULL,
  INDEX `fk_proyecto_has_producto_producto1_idx` (`producto_id` ASC),
  INDEX `fk_proyecto_has_producto_proyecto1_idx` (`proyecto_id` ASC),
  CONSTRAINT `fk_proyecto_has_producto_proyecto1`
    FOREIGN KEY (`proyecto_id`)
    REFERENCES `intec`.`proyecto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_proyecto_has_producto_producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `intec`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intec`.`producto_has_posicion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`producto_has_posicion` ;

CREATE TABLE IF NOT EXISTS `intec`.`producto_has_posicion` (
  `producto_id` INT NOT NULL,
  `posicion_idposicion` INT NOT NULL,
  `cantidad` INT NOT NULL,
  INDEX `fk_producto_has_posicion_posicion1_idx` (`posicion_idposicion` ASC),
  INDEX `fk_producto_has_posicion_producto1_idx` (`producto_id` ASC),
  CONSTRAINT `fk_producto_has_posicion_producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `intec`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_has_posicion_posicion1`
    FOREIGN KEY (`posicion_idposicion`)
    REFERENCES `intec`.`posicion` (`idposicion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intec`.`recepcion_has_producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`recepcion_has_producto` ;

CREATE TABLE IF NOT EXISTS `intec`.`recepcion_has_producto` (
  `recepcion_id` INT NOT NULL,
  `producto_id` INT NOT NULL,
  `cantidad` INT NOT NULL,
  INDEX `fk_recepcion_has_producto_producto1_idx` (`producto_id` ASC),
  INDEX `fk_recepcion_has_producto_recepcion1_idx` (`recepcion_id` ASC),
  CONSTRAINT `fk_recepcion_has_producto_recepcion1`
    FOREIGN KEY (`recepcion_id`)
    REFERENCES `intec`.`recepcion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recepcion_has_producto_producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `intec`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intec`.`especialidad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`especialidad` ;

CREATE TABLE IF NOT EXISTS `intec`.`especialidad` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `especialidad` VARCHAR(45) NOT NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  `delete` TINYINT NULL,
  `deleteAt` DATE NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `intec`.`rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`rol` ;

CREATE TABLE IF NOT EXISTS `intec`.`rol` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `rol` VARCHAR(45) NOT NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  `delete` TINYINT NULL,
  `deleteAt` DATE NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `intec`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`usuario` ;

CREATE TABLE IF NOT EXISTS `intec`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `createAt` DATE NOT NULL,
  `rol_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_usuario_rol1_idx` (`rol_id` ASC),
  CONSTRAINT `fk_usuario_rol1`
    FOREIGN KEY (`rol_id`)
    REFERENCES `intec`.`rol` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intec`.`cargo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`cargo` ;

CREATE TABLE IF NOT EXISTS `intec`.`cargo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cargo` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intec`.`tipo_contrato`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`tipo_contrato` ;

CREATE TABLE IF NOT EXISTS `intec`.`tipo_contrato` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `contrato` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intec`.`personal`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`personal` ;

CREATE TABLE IF NOT EXISTS `intec`.`personal` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `rut` VARCHAR(45) NULL,
  `usuario_id` INT NULL,
  `cargo_id` INT NOT NULL,
  `especialidad_id` INT NOT NULL,
  `tipo_contrato_id` INT NOT NULL,
  `createAt` DATE NOT NULL,
  `modifiedAt` DATE NULL,
  `delete` TINYINT NULL,
  `deleteAt` DATE NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_personal_especialidad1_idx` (`especialidad_id` ASC),
  INDEX `fk_personal_usuario1_idx` (`usuario_id` ASC),
  INDEX `fk_personal_cargo1_idx` (`cargo_id` ASC),
  INDEX `fk_personal_tipo_contrato1_idx` (`tipo_contrato_id` ASC),
  CONSTRAINT `fk_personal_especialidad1`
    FOREIGN KEY (`especialidad_id`)
    REFERENCES `intec`.`especialidad` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_personal_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `intec`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_personal_cargo1`
    FOREIGN KEY (`cargo_id`)
    REFERENCES `intec`.`cargo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_personal_tipo_contrato1`
    FOREIGN KEY (`tipo_contrato_id`)
    REFERENCES `intec`.`tipo_contrato` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intec`.`personal_has_proyecto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`personal_has_proyecto` ;

CREATE TABLE IF NOT EXISTS `intec`.`personal_has_proyecto` (
  `personal_id` INT NOT NULL,
  `proyecto_id` INT NOT NULL,
  `costo` INT NULL,
  PRIMARY KEY (`personal_id`, `proyecto_id`),
  INDEX `fk_personal_has_proyecto_proyecto1_idx` (`proyecto_id` ASC),
  INDEX `fk_personal_has_proyecto_personal1_idx` (`personal_id` ASC),
  CONSTRAINT `fk_personal_has_proyecto_personal1`
    FOREIGN KEY (`personal_id`)
    REFERENCES `intec`.`personal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_personal_has_proyecto_proyecto1`
    FOREIGN KEY (`proyecto_id`)
    REFERENCES `intec`.`proyecto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intec`.`estado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`estado` ;

CREATE TABLE IF NOT EXISTS `intec`.`estado` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `estado` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `intec`.`vehiculo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`vehiculo` ;

CREATE TABLE IF NOT EXISTS `intec`.`vehiculo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `patente` VARCHAR(45) NULL,
  `personal_id` INT NOT NULL,
  PRIMARY KEY (`id`, `personal_id`),
  INDEX `fk_vehiculo_personal1_idx` (`personal_id` ASC),
  CONSTRAINT `fk_vehiculo_personal1`
    FOREIGN KEY (`personal_id`)
    REFERENCES `intec`.`personal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intec`.`ingresos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`ingresos` ;

CREATE TABLE IF NOT EXISTS `intec`.`ingresos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ingreso` VARCHAR(255) NULL,
  `monto` VARCHAR(45) NULL,
  `proyecto_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_ingresos_proyecto1_idx` (`proyecto_id` ASC),
  CONSTRAINT `fk_ingresos_proyecto1`
    FOREIGN KEY (`proyecto_id`)
    REFERENCES `intec`.`proyecto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intec`.`empresa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`empresa` ;

CREATE TABLE IF NOT EXISTS `intec`.`empresa` (
  `idempresa` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idempresa`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intec`.`proyecto_has_vehiculo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`proyecto_has_vehiculo` ;

CREATE TABLE IF NOT EXISTS `intec`.`proyecto_has_vehiculo` (
  `proyecto_id` INT NOT NULL,
  `vehiculo_id` INT NOT NULL,
  PRIMARY KEY (`proyecto_id`, `vehiculo_id`),
  INDEX `fk_proyecto_has_vehiculo_vehiculo1_idx` (`vehiculo_id` ASC),
  INDEX `fk_proyecto_has_vehiculo_proyecto1_idx` (`proyecto_id` ASC),
  CONSTRAINT `fk_proyecto_has_vehiculo_proyecto1`
    FOREIGN KEY (`proyecto_id`)
    REFERENCES `intec`.`proyecto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_proyecto_has_vehiculo_vehiculo1`
    FOREIGN KEY (`vehiculo_id`)
    REFERENCES `intec`.`vehiculo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `intec`.`proyecto_has_estado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intec`.`proyecto_has_estado` ;

CREATE TABLE IF NOT EXISTS `intec`.`proyecto_has_estado` (
  `proyecto_id` INT NOT NULL,
  `estado_id` INT NOT NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`proyecto_id`, `estado_id`),
  INDEX `fk_proyecto_has_estado_estado1_idx` (`estado_id` ASC),
  INDEX `fk_proyecto_has_estado_proyecto1_idx` (`proyecto_id` ASC),
  CONSTRAINT `fk_proyecto_has_estado_proyecto1`
    FOREIGN KEY (`proyecto_id`)
    REFERENCES `intec`.`proyecto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_proyecto_has_estado_estado1`
    FOREIGN KEY (`estado_id`)
    REFERENCES `intec`.`estado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;








(14,'RegiÃ³n de Los RÃ­os',1"14",14,1),
(13,'RegiÃ³n Metropolitana',1"13",13,1),
(12,'RegiÃ³n de Magallanes y la AntÃ¡rtica Chilena',1"12",12,1),
(11,'RegiÃ³n de AysÃ©n del General Carlos IbÃ¡Ã±ez del Campo',1"11",11,1),
(10,'RegiÃ³n de Los Lagos',1"10",10,1),
(9,'RegiÃ³n de la AraucanÃ­a',"9",9,1),
(8,'RegiÃ³n del BÃ­o-BÃ­o',"8",8,1),
(7,'RegiÃ³n del Maule',"7",7,1),
(6,'RegiÃ³n del Libertador General Bernardo O Higgins',"6",6,1),
(5,'RegiÃ³n de Valparaiso',"5",5,1),
(4,'RegiÃ³n de Coquimbo',"4",4,1),
(3,'RegiÃ³n de Atacama',"3",3,1),
(2,'RegiÃ³n de Antofagasta',"2",2,1),
(1,'RegiÃ³n de TarapacÃ¡',"1",1,1),
(15,'RegiÃ³n de Arica y Parinacota',1"15",15,1);






