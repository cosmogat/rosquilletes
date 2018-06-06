SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `bdrosquilletes` ;
CREATE SCHEMA IF NOT EXISTS `bdrosquilletes` DEFAULT CHARACTER SET utf8 ;
USE `bdrosquilletes` ;

-- -----------------------------------------------------
-- Table `bdrosquilletes`.`Llocs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdrosquilletes`.`Llocs` ;

CREATE  TABLE IF NOT EXISTS `bdrosquilletes`.`Llocs` (
  `idllocs` INT NOT NULL AUTO_INCREMENT ,
  `modul` VARCHAR(45) NOT NULL ,
  `nom` VARCHAR(45) NOT NULL ,
  `llocpare` INT NULL ,
  PRIMARY KEY (`idllocs`) ,
  INDEX `fk_Llocs_Llocs1` (`llocpare` ASC) ,
  UNIQUE INDEX `modul_UNIQUE` (`modul` ASC) ,
  UNIQUE INDEX `nom_UNIQUE` (`nom` ASC) ,
  CONSTRAINT `fk_Llocs_Llocs1`
    FOREIGN KEY (`llocpare` )
    REFERENCES `bdrosquilletes`.`Llocs` (`idllocs` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bdrosquilletes`.`Blocs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdrosquilletes`.`Blocs` ;

CREATE  TABLE IF NOT EXISTS `bdrosquilletes`.`Blocs` (
  `idblocs` INT NOT NULL AUTO_INCREMENT ,
  `modul` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idblocs`) ,
  UNIQUE INDEX `modul_UNIQUE` (`modul` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bdrosquilletes`.`ModulsCap`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdrosquilletes`.`ModulsCap` ;

CREATE  TABLE IF NOT EXISTS `bdrosquilletes`.`ModulsCap` (
  `Llocs_idllocs` INT NOT NULL ,
  `Blocs_idblocs` INT NOT NULL ,
  `pes` INT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`Llocs_idllocs`, `Blocs_idblocs`) ,
  INDEX `fk_Llocs_has_Blocs_Blocs1` (`Blocs_idblocs` ASC) ,
  INDEX `fk_Llocs_has_Blocs_Llocs` (`Llocs_idllocs` ASC) ,
  CONSTRAINT `fk_Llocs_has_Blocs_Llocs`
    FOREIGN KEY (`Llocs_idllocs` )
    REFERENCES `bdrosquilletes`.`Llocs` (`idllocs` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Llocs_has_Blocs_Blocs1`
    FOREIGN KEY (`Blocs_idblocs` )
    REFERENCES `bdrosquilletes`.`Blocs` (`idblocs` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bdrosquilletes`.`ModulsDreta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdrosquilletes`.`ModulsDreta` ;

CREATE  TABLE IF NOT EXISTS `bdrosquilletes`.`ModulsDreta` (
  `Llocs_idllocs` INT NOT NULL ,
  `Blocs_idblocs` INT NOT NULL ,
  `pes` INT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`Llocs_idllocs`, `Blocs_idblocs`) ,
  INDEX `fk_Llocs_has_Blocs1_Blocs1` (`Blocs_idblocs` ASC) ,
  INDEX `fk_Llocs_has_Blocs1_Llocs1` (`Llocs_idllocs` ASC) ,
  CONSTRAINT `fk_Llocs_has_Blocs1_Llocs1`
    FOREIGN KEY (`Llocs_idllocs` )
    REFERENCES `bdrosquilletes`.`Llocs` (`idllocs` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Llocs_has_Blocs1_Blocs1`
    FOREIGN KEY (`Blocs_idblocs` )
    REFERENCES `bdrosquilletes`.`Blocs` (`idblocs` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bdrosquilletes`.`ModulsPeu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdrosquilletes`.`ModulsPeu` ;

CREATE  TABLE IF NOT EXISTS `bdrosquilletes`.`ModulsPeu` (
  `Llocs_idllocs` INT NOT NULL ,
  `Blocs_idblocs` INT NOT NULL ,
  `pes` INT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`Llocs_idllocs`, `Blocs_idblocs`) ,
  INDEX `fk_Llocs_has_Blocs3_Blocs1` (`Blocs_idblocs` ASC) ,
  INDEX `fk_Llocs_has_Blocs3_Llocs1` (`Llocs_idllocs` ASC) ,
  CONSTRAINT `fk_Llocs_has_Blocs3_Llocs1`
    FOREIGN KEY (`Llocs_idllocs` )
    REFERENCES `bdrosquilletes`.`Llocs` (`idllocs` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Llocs_has_Blocs3_Blocs1`
    FOREIGN KEY (`Blocs_idblocs` )
    REFERENCES `bdrosquilletes`.`Blocs` (`idblocs` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bdrosquilletes`.`Usuaris`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdrosquilletes`.`Usuaris` ;

CREATE  TABLE IF NOT EXISTS `bdrosquilletes`.`Usuaris` (
  `nom` VARCHAR(32) NOT NULL ,
  `pass` VARCHAR(32) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `admin` TINYINT(1) NOT NULL DEFAULT FALSE ,
  `blocat` TINYINT(1) NOT NULL DEFAULT FALSE ,
  PRIMARY KEY (`nom`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bdrosquilletes`.`Configuracio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdrosquilletes`.`Configuracio` ;

CREATE  TABLE IF NOT EXISTS `bdrosquilletes`.`Configuracio` (
  `nomweb` VARCHAR(45) NOT NULL ,
  `index` INT NOT NULL ,
  INDEX `fk_Configuracio_Llocs1` (`index` ASC) ,
  CONSTRAINT `fk_Configuracio_Llocs1`
    FOREIGN KEY (`index` )
    REFERENCES `bdrosquilletes`.`Llocs` (`idllocs` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `bdrosquilletes`.`Menu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bdrosquilletes`.`Menu` ;

CREATE  TABLE IF NOT EXISTS `bdrosquilletes`.`Menu` (
  `idmenu` INT NOT NULL ,
  `nommenu` VARCHAR(45) NOT NULL DEFAULT 'sn' ,
  `pesmenu` INT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`idmenu`) ,
  INDEX `fk_menu_Llocs1` (`idmenu` ASC) ,
  CONSTRAINT `fk_menu_Llocs1`
    FOREIGN KEY (`idmenu` )
    REFERENCES `bdrosquilletes`.`Llocs` (`idllocs` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
