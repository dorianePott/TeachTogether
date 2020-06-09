-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema TeachTogether
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema TeachTogether
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `TeachTogether` DEFAULT CHARACTER SET utf8 ;
USE `TeachTogether` ;

-- -----------------------------------------------------
-- Table `TeachTogether`.`Tbl_Education`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TeachTogether`.`Tbl_Education` (
  `Id_Education` INT(11) NOT NULL AUTO_INCREMENT,
  `Nm_Education` VARCHAR(100) NOT NULL,
  `Txt_Education_Link` VARCHAR(200) NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Education`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `TeachTogether`.`Tbl_Module`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TeachTogether`.`Tbl_Module` (
  `Id_Module` INT(11) NOT NULL AUTO_INCREMENT,
  `Cd_Module` VARCHAR(5) NOT NULL,
  `Nm_Module` VARCHAR(45) NOT NULL,
  `Txt_Module_Link` VARCHAR(200) NULL DEFAULT NULL,
  `Id_Education` INT(11) NOT NULL,
  PRIMARY KEY (`Id_Module`),
  INDEX `Tbl_Module_ibfk_1` (`Id_Education` ASC),
  CONSTRAINT `Tbl_Module_ibfk_1`
    FOREIGN KEY (`Id_Education`)
    REFERENCES `TeachTogether`.`Tbl_Education` (`Id_Education`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `TeachTogether`.`Tbl_Permission`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TeachTogether`.`Tbl_Permission` (
  `Cd_Permission` VARCHAR(45) NOT NULL,
  `Cd_Role` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Cd_Permission`, `Cd_Role`),
  INDEX `Cd_Role_idx` (`Cd_Role` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `TeachTogether`.`Tbl_User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TeachTogether`.`Tbl_User` (
  `Id_User` INT(11) NOT NULL AUTO_INCREMENT,
  `Nm_First` VARCHAR(45) NOT NULL,
  `Nm_Last` VARCHAR(45) NOT NULL,
  `Txt_Email` VARCHAR(100) NOT NULL,
  `Nm_File_Profile_Picture` VARCHAR(45) NULL DEFAULT NULL,
  `Txt_Password_Hash` VARCHAR(100) NOT NULL,
  `Txt_Password_Salt` VARCHAR(20) NOT NULL,
  `Is_Active` TINYINT(4) NOT NULL DEFAULT 0,
  `Id_Education` INT(11) NULL DEFAULT NULL,
  `Cd_Role` VARCHAR(45) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`Id_User`),
  UNIQUE INDEX `Id_User` (`Id_User` ASC),
  UNIQUE INDEX `Txt_Email_UNIQUE` (`Txt_Email` ASC),
  INDEX `Cd_Role_idx` (`Cd_Role` ASC),
  INDEX `Id_Education` (`Id_Education` ASC),
  CONSTRAINT `Cd_Role`
    FOREIGN KEY (`Cd_Role`)
    REFERENCES `TeachTogether`.`Tbl_Permission` (`Cd_Role`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Id_Education`
    FOREIGN KEY (`Id_Education`)
    REFERENCES `TeachTogether`.`Tbl_Education` (`Id_Education`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `TeachTogether`.`Tbl_Resource`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TeachTogether`.`Tbl_Resource` (
  `Id_Resource` INT(11) NOT NULL AUTO_INCREMENT,
  `Dttm_Creation` DATETIME NOT NULL,
  `Dttm_Last_Update` DATETIME NOT NULL,
  `Nm_Resource` VARCHAR(100) NOT NULL,
  `Txt_Description` VARCHAR(1000) NULL DEFAULT NULL,
  `Is_Deleted` TINYINT(4) NOT NULL DEFAULT 0,
  `Id_User_Owner` INT(11) NOT NULL,
  `Id_Module` INT(11) NOT NULL,
  PRIMARY KEY (`Id_Resource`),
  UNIQUE INDEX `Id_Resource_UNIQUE` (`Id_Resource` ASC),
  INDEX `Id_User_idx` (`Id_User_Owner` ASC),
  INDEX `Id_Module_idx` (`Id_Module` ASC),
  CONSTRAINT `Id_Module`
    FOREIGN KEY (`Id_Module`)
    REFERENCES `TeachTogether`.`Tbl_Module` (`Id_Module`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `Id_User_Owner`
    FOREIGN KEY (`Id_User_Owner`)
    REFERENCES `TeachTogether`.`Tbl_User` (`Id_User`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 65
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `TeachTogether`.`Tbl_Attachment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TeachTogether`.`Tbl_Attachment` (
  `Id_Attachment` INT(11) NOT NULL AUTO_INCREMENT,
  `Dttm_Upload` DATETIME NOT NULL,
  `Nb_Bytes` INT(11) NOT NULL,
  `Cd_Mime_Type` VARCHAR(45) NOT NULL,
  `Nm_Attachment` VARCHAR(100) NOT NULL,
  `Nm_File` VARCHAR(45) NOT NULL,
  `Is_Deleted` TINYINT(4) NOT NULL DEFAULT 0,
  `Id_Resource` INT(11) NOT NULL,
  PRIMARY KEY (`Id_Attachment`),
  INDEX `IdResource_idx` (`Id_Resource` ASC),
  CONSTRAINT `Id_Resource`
    FOREIGN KEY (`Id_Resource`)
    REFERENCES `TeachTogether`.`Tbl_Resource` (`Id_Resource`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 52
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


INSERT INTO `Tbl_Permission` (`Cd_Permission`, `Cd_Role`) VALUES
('faq-view', 'admin'),
('faq-view', 'anonyme'),
('faq-view', 'user'),
('file-view', 'user'),
('home-view', 'admin'),
('home-view', 'anonyme'),
('home-view', 'user'),
('login-view', 'anonyme'),
('logout-view', 'admin'),
('logout-view', 'user'),
('manage-education', 'admin'),
('manage-module', 'admin'),
('manage-resource', 'admin'),
('manage-user', 'admin'),
('profile-view', 'admin'),
('profile-view', 'user'),
('register-view', 'anonyme'),
('settings-view', 'admin'),
('settings-view', 'user'),
('update-view', 'admin'),
('update-view', 'user');


INSERT INTO `Tbl_User` (`Id_User`, `Nm_First`, `Nm_Last`, `Txt_Email`, `Nm_File_Profile_Picture`, `Txt_Password_Hash`, `Txt_Password_Salt`, `Is_Active`, `Id_Education`, `Cd_Role`) VALUES
(1, 'admin', 'none', 'admin@teacher.com', '', '5965058327eb0eb125d54130cbeee2105e53b43f', '01oejvjeiuvjfkeifkgt', 1, NULL, 'admin');

