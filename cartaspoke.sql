DROP DATABASE IF EXISTS cartasPokemon;

CREATE database cartasPokemon;

USE cartasPokemon;

CREATE TABLE Carta (
    carta_id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) not null,
    descripcio TEXT not null,
    imagen varchar(255) 
);

CREATE TABLE Generacio (
    generacio_id INT PRIMARY KEY AUTO_INCREMENT,
    numerog INT
);

CREATE TABLE Tipus (
    tipus_id INT PRIMARY KEY AUTO_INCREMENT,
    nomt VARCHAR(255),
    nomt2 VARCHAR(255)
);

-- relación Pertany_a (1:N entre Carta y Generació)
CREATE TABLE Pertany_a (
    carta_id INT,
    generacio_id INT,
    PRIMARY KEY (carta_id, generacio_id),
    FOREIGN KEY (carta_id) REFERENCES Carta(carta_id),
    FOREIGN KEY (generacio_id) REFERENCES Generacio(generacio_id)
);

-- Relación de muchos a muchos entre Carta y Tipus (con dos tipos)
CREATE TABLE Te_Tipus (
    carta_id INT,
    tipus_id_1 INT,
    tipus_id_2 INT,
    PRIMARY KEY (carta_id),
    FOREIGN KEY (carta_id) REFERENCES Carta(carta_id),
    FOREIGN KEY (tipus_id_1) REFERENCES Tipus(tipus_id),
    FOREIGN KEY (tipus_id_2) REFERENCES Tipus(tipus_id)
);



-- Cartas Pokemon
-- INSERT INTO Carta (nom, descripcio)
-- VLUES ('Torchic', 'Pokemon polluelo de fuego');
-- INSERT INTO Carta (nom, descripcio)
-- VALUES ('Pikachu', 'La rata electrica');
-- INSERT INTO Carta (nom, descripcio)
-- VALUES ('Squirtle', 'tortuga');

-- select * from Carta;


-- Generaciócarta
INSERT INTO Generacio (numerog)
VALUES 
 (1),
 (2),
 (3),
 (4),
 (5),
 (6),
 (7);

-- Tipus
INSERT INTO Tipus (nomt)
VALUES ('No tiene'),
		('Fuego'),
       ('Agua'),
       ('Planta'),
       ('Eléctrico'),
       ('Hielo'),
       ('Lucha'),
       ('Volador'),
       ('Bicho'),
       ('Veneno'),
       ('Tierra'),
       ('Roca'),
       ('Fantasma'),
       ('Psíquico'),
       ('Siniestro'),
       ('Acero'),
       ('Hada');



