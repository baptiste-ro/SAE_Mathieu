CREATE TABLE User (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    adresse VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    mot_de_passe VARCHAR(255)
);

CREATE TABLE Docteur (
    id_docteur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    ville VARCHAR(50),
    specialite VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    mot_de_passe VARCHAR(255)
);

CREATE TABLE Creneau (
    id_creneau INT AUTO_INCREMENT PRIMARY KEY,
    id_docteur INT,
    date_heure_debut DATETIME,
    date_heure_fin DATETIME,
    est_libre BOOLEAN DEFAULT TRUE,
    capacite_max INT DEFAULT 1,
    FOREIGN KEY (id_docteur) REFERENCES Docteur(id_docteur)
);

CREATE TABLE RendezVous (
    id_rdv INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_creneau INT UNIQUE,
    statut ENUM('réservé','annulé') DEFAULT 'réservé',
    date_reservation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES User(id_user),
    FOREIGN KEY (id_creneau) REFERENCES Creneau(id_creneau)
);

-- Users
INSERT INTO User (nom, prenom, email, mot_de_passe)
VALUES ('Dupont', 'Alice', 'alice@mail.com', '1234'),
       ('Martin', 'Paul', 'paul@mail.com', '1234');

-- Docteurs
INSERT INTO Docteur (nom, prenom, specialite, email, mot_de_passe)
VALUES ('Durand', 'Sophie', 'Généraliste', 'sophie@mail.com', '1234'),
       ('Bernard', 'Luc', 'Dentiste', 'luc@mail.com', '1234');

-- Créneaux
INSERT INTO Creneau (id_docteur, date_heure_debut, date_heure_fin)
VALUES (1, '2025-10-01 09:00:00', '2025-10-01 09:15:00'),
       (1, '2025-10-01 09:15:00', '2025-10-01 09:30:00'),
       (2, '2025-10-02 10:00:00', '2025-10-02 10:30:00');

-- Rendez-vous (Alice réserve le 1er créneau)
INSERT INTO RendezVous (id_user, id_creneau, statut)
VALUES (1, 1, 'réservé');
UPDATE Creneau SET est_libre = FALSE WHERE id_creneau = 1;

-- NB réservations aujourd'hui 
SELECT COUNT(*) AS nb_reservations
FROM RendezVous rv
JOIN Creneau c ON rv.id_creneau = c.id_creneau
WHERE DATE(c.date_heure_debut) = CURRENT_DATE
  AND rv.statut = 'réservé';

-- Créneaux libres dans le mois (pour un docteur donné)
SELECT * 
FROM Creneau
WHERE est_libre = TRUE
  AND id_docteur = 1
  AND MONTH(date_heure_debut) = MONTH(CURRENT_DATE);

-- Personnes impliquées dans un créneau donné
SELECT u.nom, u.prenom, d.nom AS docteur_nom, d.prenom AS docteur_prenom
FROM RendezVous rv
JOIN User u ON rv.id_user = u.id_user
JOIN Creneau c ON rv.id_creneau = c.id_creneau
JOIN Docteur d ON c.id_docteur = d.id_docteur
WHERE c.id_creneau = 1;
