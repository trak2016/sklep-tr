-- MySQL Script generated by MySQL Workbench
-- śro, 6 kwi 2016, 10:36:48
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Role` (
  `idRole` INT NOT NULL,
  `Nazwa` VARCHAR(45) NULL,
  PRIMARY KEY (`idRole`))
ENGINE = InnoDB
COMMENT = '\n	\n';


-- -----------------------------------------------------
-- Table `mydb`.`Adres`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Adres` (
  `idAdres` INT NOT NULL,
  `Kraj` VARCHAR(45) NULL,
  `Miasto` VARCHAR(45) NULL,
  `Ulica` VARCHAR(45) NULL,
  `Numer` VARCHAR(45) NULL,
  `KodPocztowy` VARCHAR(45) NULL,
  PRIMARY KEY (`idAdres`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Uzytkownik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Uzytkownik` (
  `idUzytkownik` INT NOT NULL,
  `Imie` VARCHAR(45) NULL,
  `Nazwisko` VARCHAR(45) NULL,
  `Login` VARCHAR(45) NULL,
  `Haslo` VARCHAR(45) NULL,
  `Email` VARCHAR(45) NULL,
  `Role_idRole` INT NOT NULL,
  `Adres_idAdres` INT NOT NULL,
  PRIMARY KEY (`idUzytkownik`, `Role_idRole`, `Adres_idAdres`),
  INDEX `fk_Uzytkownik_Role1_idx` (`Role_idRole` ASC),
  INDEX `fk_Uzytkownik_Adres1_idx` (`Adres_idAdres` ASC),
  CONSTRAINT `fk_Uzytkownik_Role1`
    FOREIGN KEY (`Role_idRole`)
    REFERENCES `mydb`.`Role` (`idRole`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Uzytkownik_Adres1`
    FOREIGN KEY (`Adres_idAdres`)
    REFERENCES `mydb`.`Adres` (`idAdres`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`MetodaPrzesylki`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`MetodaPrzesylki` (
  `idMetodaPrzesylki` INT NOT NULL,
  `Nazwa` VARCHAR(45) NULL,
  PRIMARY KEY (`idMetodaPrzesylki`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`MetodaPlatnosci`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`MetodaPlatnosci` (
  `idMetodaPlatnosci` INT NOT NULL,
  `Nazw` VARCHAR(45) NULL,
  PRIMARY KEY (`idMetodaPlatnosci`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Zamowienie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Zamowienie` (
  `idZamowienie` INT NOT NULL,
  `Data` VARCHAR(45) NULL,
  `idUzytkownik` VARCHAR(45) NULL,
  `Status` VARCHAR(45) NULL,
  `Uzytkownik_idUzytkownik` INT NOT NULL,
  `MetodaPrzesylki_idMetodaPrzesylki` INT NOT NULL,
  `MetodaPlatnosci_idMetodaPlatnosci` INT NOT NULL,
  PRIMARY KEY (`idZamowienie`, `Uzytkownik_idUzytkownik`, `MetodaPrzesylki_idMetodaPrzesylki`, `MetodaPlatnosci_idMetodaPlatnosci`),
  INDEX `fk_Zamowienie_Uzytkownik1_idx` (`Uzytkownik_idUzytkownik` ASC),
  INDEX `fk_Zamowienie_MetodaPrzesylki1_idx` (`MetodaPrzesylki_idMetodaPrzesylki` ASC),
  INDEX `fk_Zamowienie_MetodaPlatnosci1_idx` (`MetodaPlatnosci_idMetodaPlatnosci` ASC),
  CONSTRAINT `fk_Zamowienie_Uzytkownik1`
    FOREIGN KEY (`Uzytkownik_idUzytkownik`)
    REFERENCES `mydb`.`Uzytkownik` (`idUzytkownik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Zamowienie_MetodaPrzesylki1`
    FOREIGN KEY (`MetodaPrzesylki_idMetodaPrzesylki`)
    REFERENCES `mydb`.`MetodaPrzesylki` (`idMetodaPrzesylki`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Zamowienie_MetodaPlatnosci1`
    FOREIGN KEY (`MetodaPlatnosci_idMetodaPlatnosci`)
    REFERENCES `mydb`.`MetodaPlatnosci` (`idMetodaPlatnosci`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Produkt`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Produkt` (
  `idProdukt` INT NOT NULL,
  `Nazwa` VARCHAR(45) NULL,
  `iloscSztuk` VARCHAR(45) NULL,
  `Opis` VARCHAR(45) NULL,
  `Zdięcie` VARCHAR(45) NULL,
  `Cena` VARCHAR(45) NULL,
  PRIMARY KEY (`idProdukt`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`SzczegolyZamowienia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`SzczegolyZamowienia` (
  `idSzczegolyZamowienia` INT NOT NULL,
  `idZamowienie` INT NOT NULL,
  `Produkt_idProdukt` INT NOT NULL,
  PRIMARY KEY (`idSzczegolyZamowienia`, `Produkt_idProdukt`, `idZamowienie`),
  INDEX `fk_SzczegolyZamowienia_Produkt1_idx` (`Produkt_idProdukt` ASC),
  INDEX `fk_SzczegolyZamowienia_1_idx` (`idZamowienie` ASC),
  CONSTRAINT `fk_SzczegolyZamowienia_Produkt1`
    FOREIGN KEY (`Produkt_idProdukt`)
    REFERENCES `mydb`.`Produkt` (`idProdukt`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SzczegolyZamowienia_1`
    FOREIGN KEY (`idZamowienie`)
    REFERENCES `mydb`.`Zamowienie` (`idZamowienie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`GrupaProduktow`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`GrupaProduktow` (
  `idGrupaProduktow` INT NOT NULL,
  `Nazwa` VARCHAR(45) NULL,
  PRIMARY KEY (`idGrupaProduktow`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ListaGrup`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`ListaGrup` (
  `idListaGrup` INT NOT NULL,
  `idProdukt` INT NOT NULL,
  `idGrupaProduktow` INT NOT NULL,
  PRIMARY KEY (`idListaGrup`, `idProdukt`, `idGrupaProduktow`),
  INDEX `fk_ListaGrup_Produkt1_idx` (`idProdukt` ASC),
  INDEX `fk_ListaGrup_GrupaProduktow1_idx` (`idGrupaProduktow` ASC),
  CONSTRAINT `fk_ListaGrup_Produkt1`
    FOREIGN KEY (`idProdukt`)
    REFERENCES `mydb`.`Produkt` (`idProdukt`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ListaGrup_GrupaProduktow1`
    FOREIGN KEY (`idGrupaProduktow`)
    REFERENCES `mydb`.`GrupaProduktow` (`idGrupaProduktow`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;