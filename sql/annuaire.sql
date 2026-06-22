USE annuaire;

CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL,
    motdepasse VARCHAR(255) NOT NULL
);

CREATE TABLE personnel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    service VARCHAR(100),
    telephone VARCHAR(20),
    email VARCHAR(150)
);
