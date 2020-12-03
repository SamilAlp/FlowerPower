create database flowerpower;
use flowerpower;

create table artikel (
	id INT NOT NULL AUTO_INCREMENT,
    artikelcode varchar(255) NOT NULL,
    artikel varchar(255) NOT NULL,
    prijs varchar(255) NOT NULL,
    factuurregelid INT NOT NULL,
    bestellingid INT NOT NULL,
    FOREIGN KEY (factuurregelid) REFERENCES factuurregel(id),
    FOREIGN KEY (bestellingid) REFERENCES bestelling(id),
    PRIMARY KEY (id)
);

create table factuurregel (
	id INT NOT NULL AUTO_INCREMENT,
    artikel varchar(255),
    aantal varchar(255),
	factuurid INT NOT NULL,
    FOREIGN KEY (factuurid) REFERENCES factuur(id),
    PRIMARY KEY (id)
);

create table winkel (
	id INT NOT NULL AUTO_INCREMENT,
    winkelcode varchar(255) NOT NULL,
    verstiging varchar(255) NOT NULL,
    adres varchar(255) NOT NULL,
    postcode varchar(255) NOT NULL,
    verstiginsplaats varchar(255) NOT NULL,
    telefoonnummer varchar(255) NOT NULL,
    bestellingid INT NOT NULL,
    FOREIGN KEY (bestellingid) REFERENCES bestelling(id),
    PRIMARY KEY (id)
);
 

create table bestelling (
	id INT NOT NULL AUTO_INCREMENT,
    artikel varchar(255) NOT NULL,
    winkel varchar(255) NOT NULL,
    aantal varchar(255) NOT NULL,
    klant varchar(255) NOT NULL,
    datum date NOT NULL,
    medewerker varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

create table factuur(
	id INT NOT NULL AUTO_INCREMENT,
    factuurregel varchar(255),
    factuurdatum varchar(255),
    klant varchar(255),
    factuurregelid INT NOT NULL,
    FOREIGN KEY (factuurregelid) REFERENCES factuurregel(id),
    PRIMARY KEY (id)
);

create table klant (
	id INT NOT NULL AUTO_INCREMENT,
    voorletters varchar(255) NOT NULL,
    tussenvoegsel varchar(255),
    achternaam varchar(255) NOT NULL,
    adres varchar(255) NOT NULL,
    postcode varchar(255) NOT NULL,
    woonplaats varchar(255) NOT NULL,
    gebruikersnaam varchar(255) NOT NULL,
    wachtwoord varchar(255),
	bestellingid INT NOT NULL,
    FOREIGN KEY (bestellingid) REFERENCES bestelling(id),
    PRIMARY KEY (id)
);

create table medewerker (
	id INT NOT NULL AUTO_INCREMENT,
    medewerkerscode varchar(255) NOT NULL,
    voorletters varchar(255) NOT NULL,
    voorvoegsels varchar(255),
    achternaam varchar(255) NOT NULL,
    naam varchar(255) NOT NULL,
    gebruikersnaam varchar(255) NOT NULL,
    wachtwoord varchar(255) NOT NULL,
	bestellingid INT NOT NULL,
    FOREIGN KEY (bestellingid) REFERENCES bestelling(id),
    PRIMARY KEY (id)
);