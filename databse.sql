DROP DATABASE if EXISTS GestionE;
CREATE DATABASE GestionE;
use GestionE;


CREATE table nivau(
    id int not null AUTO_INCREMENT,
    labelle varchar(50) not null,
    PRIMARY key(id)
);


CREATE table formation(
    id int not null AUTO_INCREMENT,
    labelle varchar(50) not null,
    PRIMARY key(id),
);

CREATE table groupe(
    id int not null AUTO_INCREMENT,
    labelle varchar(50) not null,
    id_nivau int not null,
    id_formation int not null,
    PRIMARY key(id),
    FOREIGN key(id_formation) REFERENCES formation(id),
    FOREIGN key(id_nivau) REFERENCES nivau(id)
);


CREATE table etudiants(
    id int not null AUTO_INCREMENT,
    nom varchar(50) not null,
    prenom varchar(50) not null,
    sexe varchar(50) not null,
    daten date not null,
    paiement varchar(50) default "non_payé",
    PRIMARY key(id)
);

CREATE TABLE group_etu(
    id_etu int not null,
    id_group int not null,
    FOREIGN key(id_etu) REFERENCES etudiants(id),
    FOREIGN key(id_group) REFERENCES groupe(id)
);

