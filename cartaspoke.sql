DROP DATABASE IF EXISTS cartasPokemon;

CREATE database cartasPokemon;

USE cartasPokemon;

CREATE TABLE Carta (
    carta_id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) not null,
    descripcio TEXT not null,
    imatge blob
);

CREATE TABLE Generacio (
    generacio_id INT PRIMARY KEY AUTO_INCREMENT,
    numero INT
);

CREATE TABLE Tipus (
    tipus_id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255)
);

-- relación Pertany_a (1:N entre Carta y Generació)
CREATE TABLE Pertany_a (
    carta_id INT,
    generacio_id INT,
    PRIMARY KEY (carta_id, generacio_id),
    FOREIGN KEY (carta_id) REFERENCES Carta(carta_id),
    FOREIGN KEY (generacio_id) REFERENCES Generacio(generacio_id)
);

-- relación Té_Tipus (M:N entre Carta y Tipus)
CREATE TABLE Te_Tipus (
    carta_id INT,
    tipus_id INT,
    PRIMARY KEY (carta_id, tipus_id),
    FOREIGN KEY (carta_id) REFERENCES Carta(carta_id),
    FOREIGN KEY (tipus_id) REFERENCES Tipus(tipus_id)
);


-- Cartas Pokemon
INSERT INTO Carta (nom, descripcio, imatge)
VALUES ('Torchic', 'Pokemon polluelo de fuego', LOAD_FILE('imagenesCarta/torchicim.txt'));
INSERT INTO Carta (nom, descripcio, imatge)
VALUES ('Pikachu', 'La rata electrica', LOAD_FILE('pikachu.jpg'));


-- Generació
INSERT INTO Generacio (numero)
VALUES (1);
INSERT INTO Generacio (numero)
VALUES (2);
INSERT INTO Generacio (numero)
VALUES (3);
INSERT INTO Generacio (numero)
VALUES (4);
INSERT INTO Generacio (numero)
VALUES (5);
INSERT INTO Generacio (numero)
VALUES (6);
INSERT INTO Generacio (numero)
VALUES (7);

-- Tipus
INSERT INTO Tipus (nom)
VALUES ('Fuego');


select * from Carta;

