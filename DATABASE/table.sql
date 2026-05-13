CREATE DATABASE employee;

USE employee;

CREATE TABLE employes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(255) NOT NULL,
    departement_id INT,
    date_embauche DATE,
    actif ENUM('1', '0') NOT NULL,
    FOREIGN KEY (departement_id) REFERENCES departements(id)

);

CREATE TABLE departements (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    description TEXT
);

CREATE TABLE types_conge(
    id INT PRIMARY KEY AUTO_INCREMENT,
    jours_annuels INT NOT NULL,
    deductible ENUM('1', '0') NOT NULL
);

CREATE TABLE soldes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    employe_id INT,
    type_conge_id INT,
    annee INT NOT NULL,
    jours_attribues INT NOT NULL,
    jours_pris INT NOT NULL,
    FOREIGN KEY (employe_id) REFERENCES employes(id),
    FOREIGN KEY (type_conge_id) REFERENCES types_conge(id)
);

CREATE TABLE conges (
    id INT PRIMARY KEY AUTO_INCREMENT,
    employe_id INT,
    type_conge_id INT,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    nb_jours INT NOT NULL,
    motif TEXT,
    statut ENUM('en_attente', 'approuve', 'refuse') NOT NULL,
    commentaire_rh TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    traite_par VARCHAR(255),
    FOREIGN KEY (employe_id) REFERENCES employes(id),
    FOREIGN KEY (type_conge_id) REFERENCES types_conge(id)
);