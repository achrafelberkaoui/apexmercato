CREATE DATABASE ApexMercato;

CREATE TABLE equipe(
    id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    manager varchar(100) NOT NULL, 
    budget int NOT NULL
);
CREATE table joueur(
	id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    role varchar(100) NOT NULL,
    email varchar(200) unique NOT NULL,
    nationalite varchar(100) NOT NULL,
    equipe_id int,
    valeur_marches int NOT NULL,
    FOREIGN KEY (equipe_id) REFERENCES equipe(id)
);
CREATE table coach(
	id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    email varchar(200) unique NOT NULL,
    nationalite varchar(100) NOT NULL,
    equipe_id int,
    FOREIGN KEY (equipe_id) REFERENCES equipe(id)
);
CREATE table contrat(
	id int PRIMARY KEY AUTO_INCREMENT,
    joueur_id int,
    FOREIGN KEY (joueur_id) REFERENCES joueur(id),
    coach_id int,
    FOREIGN KEY (coach_id) REFERENCES coach(id),
    date_contrat datetime DEFAULT CURRENT_TIMESTAMP
);

CREATE table transfert(
	id int PRIMARY KEY AUTO_INCREMENT,
    equipeA_id int,
    FOREIGN KEY (equipeA_id) REFERENCES equipe(id),
    equipeB_id int,
    FOREIGN KEY (equipeB_id) REFERENCES equipe(id),
    joueur_id int,
    FOREIGN KEY (joueur_id) REFERENCES joueur(id),
    coach_id int,
    FOREIGN KEY (coach_id) REFERENCES coach(id)
);

//modification

ALTER TABLE equipe
MODIFY budget DECIMAL NOT NULL;

ALTER TABLE joueur 
MODIFY valeur_marches DECIMAL NOT NULL;

CREATE INDEX idx_joueur on joueur(name);

CREATE INDEX idx_equipe on equipe(name);
