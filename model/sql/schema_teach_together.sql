SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `TeachTogether` DEFAULT CHARACTER SET utf8 ;
USE `TeachTogether`;

CREATE USER IF NOT EXISTS 'teacher'@'localhost' IDENTIFIED BY 'Super';

CREATE TABLE IF NOT EXISTS `TeachTogether`.`Tbl_Education` (
`Id_Education` INT(11) NOT NULL AUTO_INCREMENT,
`Nm_Education` VARCHAR(100) NOT NULL,
`Txt_Education_Link` VARCHAR(200),
PRIMARY KEY (`Id_Education`)
);

CREATE TABLE IF NOT EXISTS `TeachTogether`.`Tbl_Permission`(
`Cd_Permission` VARCHAR(45) NOT NULL,
`Cd_Role` VARCHAR(45) NOT NULL,
PRIMARY KEY(`Cd_Permission`, `Cd_Role`) 
);

CREATE TABLE IF NOT EXISTS `TeachTogether`.`Tbl_User` (
`Id_User` INT(11) NOT NULL AUTO_INCREMENT,
`Nm_First` VARCHAR(45),
`Nm_Last` VARCHAR(45),
`Txt_Email` VARCHAR(100),
`Nm_File_Profile_Picture` VARCHAR(45),
`Txt_Password_Hash` VARCHAR(100),
`Txt_Password_Salt` VARCHAR(20),
`Cd_Role` VARCHAR(45),
`Is_Active` TINYINT,
`Id_Education` INT(11),
PRIMARY KEY (`Id_User`),
UNIQUE INDEX `Id_User` (`Id_User` ASC),
UNIQUE INDEX `Txt_Email_UNIQUE` (`Txt_Email` ASC),
  CONSTRAINT `Id_Education`
    FOREIGN KEY (`Id_Education`)
    REFERENCES `TeachTogether`.`Tbl_Education` (`Id_Education`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`Cd_Role`)
    REFERENCES `TeachTogether`.`Tbl_Permission` (`Cd_Role`))
ENGINE = InnoDB
AUTO_INCREMENT = 0
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `TeachTogether`.`Tbl_Module` (
`Id_Module` INT(11) NOT NULL AUTO_INCREMENT,
`Cd_Module` VARCHAR(5) NOT NULL,
`Nm_Module` VARCHAR(45) NOT NULL,
`Txt_Module_Link` VARCHAR(200),
`Id_Education` INT(11) NOT NULL,
PRIMARY KEY (`Id_Module`),
UNIQUE INDEX `Id_Education` (`Id_Education` ASC),
FOREIGN KEY (`Id_Education`)
REFERENCES `TeachTogether`.`Tbl_Education` (`Id_Education`)
);

CREATE TABLE IF NOT EXISTS `TeachTogether`.`Tbl_Resource` (
  `Id_Resource` INT(11) NOT NULL AUTO_INCREMENT,
  `Dttm_Creation` DATETIME NOT NULL,
  `Dttm_Last_Update` DATETIME NULL DEFAULT NULL,
  `Nm_Resource` VARCHAR(100) NOT NULL,
  `Txt_Description` VARCHAR(1000) NULL DEFAULT NULL,
  `Is_Deleted` TINYINT(4) NOT NULL DEFAULT 0,
  `Id_User_Owner` INT(11) NOT NULL,
  `Id_Module` INT(11) NOT NULL,
  PRIMARY KEY (`Id_Resource`),
  UNIQUE INDEX `Id_Resource_UNIQUE` (`Id_Resource` ASC),
  INDEX `Id_User_idx` (`Id_User_Owner` ASC),
  CONSTRAINT `Id_User_Owner`
    FOREIGN KEY (`Id_User_Owner`)
    REFERENCES `TeachTogether`.`Tbl_User` (`Id_User`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  INDEX `Id_Module_idx` (`Id_Module` ASC),
  CONSTRAINT `Id_Module`
    FOREIGN KEY (`Id_Module`)
    REFERENCES `TeachTogether`.`Tbl_Module` (`Id_Module`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION )
ENGINE = InnoDB
AUTO_INCREMENT = 0
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `TeachTogether`.`Tbl_Attachment` (
`Id_Attachment` INT(11) NOT NULL AUTO_INCREMENT,
  `Dttm_Upload` DATETIME NOT NULL,
  `Nb_Bytes` INT(11) NOT NULL,
  `Cd_Mime_Type` VARCHAR(45) NOT NULL,
  `Nm_Attachment` VARCHAR(100) NOT NULL,
  `Nm_File` VARCHAR(45) NOT NULL,
  `Is_Deleted` TINYINT NOT NULL DEFAULT 0,
  `Id_Resource` INT(11) NOT NULL,
  PRIMARY KEY (`Id_Attachment`),
  UNIQUE INDEX `Id_Resource_UNIQUE` (`Id_Resource` ASC),
  CONSTRAINT `Id_Resource`
    FOREIGN KEY (`Id_Resource`)
    REFERENCES `TeachTogether`.`Tbl_Resource` (`Id_Resource`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);
