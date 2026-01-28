# Projet SAE - Système de gestion de rendez-vous en ligne

**Université de Lille**  
**BUT Informatique – Semestre 5**  
**Matière : S5.A.01 - Frameworks Web**  
**Enseignant : Philippe Mathieu**  
**Année universitaire 2025-2026**

**Auteurs**
- Baptiste Royer
- Tom Lelievre

## Introduction

Ce projet consiste à réaliser un **site web de gestion de rendez-vous multi-utilisateurs**, inspiré de plateformes comme Doctolib ou des outils de prise de créneaux.

### Fonctionnalités principales
- Inscription et connexion des utilisateurs
- Affichage d’un calendrier réactif avec créneaux disponibles
- Réservation d’un créneau (avec vérification des contraintes)
- Visualisation des créneaux occupés / libres (couleurs)
- Gestion du profil utilisateur (modification informations, photo)
- Déconnexion

### Technologies utilisées
- Backend : Spring Boot, Spring Data JPA
- Frontend : JSP, JS, Tailwind
- Base de données : H2, Flyway
- Build : Maven

## Installation et démarrage

### Prérequis
- Java 17+
- Maven 3.8+

### Étapes
1. Dézipper le projet

2. Installer les dépendances

    ```bash
    mvn install
    ```

3. Lancer l'application

    ```bash
    mvn spring-boot:run
    ```

4. Accéder au site

    - **URL principale** : http://localhost:8080/sae/Accueil.jsp

    - **Console H2** : http://localhost:8080/sae/h2-console

        - **JDBC URL** : `jdbc:h2:file:./data/demo`

        - **Utilisateur** : `sa`
        - **Mot de passe** : `password`

### Tester rapidement

- Cliquez sur le bouton **« Se connecter »** en haut à droite de l’écran.

- Sélectionnez ensuite **« Pas encore de compte ? Créer un compte »** et suivez les étapes pour créer votre compte.

- Une fois le compte créé, vous serez redirigé vers la page de connexion.

- Après vous être connecté, vous pouvez consulter le **calendrier** depuis la page d’accueil.

- Il ne vous reste plus qu’à **réserver un créneau**.

- Un **rôle administrateur** est disponible avec les identifiants suivants :
    - **Email** : `baptiste-royer@outlook.com`
    - **Mot de passe** : `root`



## Fonctionnalités principales

| Fonctionnalité                        | Description                                                                 |
|---------------------------------------|-----------------------------------------------------------------------------|
| Inscription & Connexion               | Création de compte et connexion avec email/mot de passe          |
| Déconnexion                           | Bouton de déconnexion                                              |
| Calendrier réactif                    | Affichage mensuel avec cases cliquables      |
| Prise de rendez-vous                  | Sélection d’une date + horaire         |
| Contraintes métier                    | 1 personne maximum par créneau de 15 minutes (cas médecin)                 |
| Gestion du profil                     | Modification du nom, prénom, adresse et photo de profil                     |
| Pop-up cookies & RGPD                 | Affichage au premier accès avec lien vers la politique de confidentialité  |

## Aspects techniques

### Modèle Conceptuel de Données (MCD)

Deux entités principales :

- **Users**  
  id (PK), nom, prenom, adresse, email, mot_de_passe, role

- **Appointment**  
  appointment_date, appointment_time, cid (FK → Users.id)  
  → Clé primaire composite : (appointment_date + appointment_time)

Le modèle est simple et centré sur la réservation : un utilisateur peut avoir plusieurs rendez-vous, chaque rendez-vous est lié à un créneau précis (date + heure).

### Base de données

- **SGBD utilisé** : H2 embarquée (fichier `./data/demo`) pour le développement
- **Migrations** : Flyway (scripts versionnés)
    - V1__create_tables.sql : création des tables Users et Appointment
    - V2__increase_password_size.sql : agrandissement du champ mot_de_passe
    - V3__addition_of_appointment_table.sql : ajout de la table des rendez-vous

- **Données d’exemple insérées** :
    - alice@mail.com / 1234
    - paul@mail.com / 1234

La base est calibrée pour gérer des créneaux fixes de 30 minutes (8h–20h30)

### Objets métier principaux

- **Users** : entité JPA pour les utilisateurs (nom, prénom, email, mot de passe, adresse)
- **Appointment** : entité pour les rendez-vous avec clé composite (date + heure) + lien vers l’utilisateur
- **AppointmentID** : classe @Embeddable pour la clé primaire composite
- **DTOs** : ConnectionUser (login), ProfileUser (édition profil), AppointmentAnswer (réponses sur les RDV)

### Contrôleurs principaux

- **ConnectionController** : gestion connexion / déconnexion
- **AccountManagementController** : création de compte
- **ProfileController** : modification des informations utilisateur et upload photo
- **AppointmentController** : ajout de RDV et comptage par mois/date
- **IndexPageController** : chargement des textes et images de la page d’accueil

### Ce qui a pris le plus de temps

Le calibrage et la mise au point de la **base de données** ont représenté la partie la plus chronophage :

- Conception des tables et clés composites (date + heure)
- Écriture et tests des scripts Flyway (migrations)
- Insertion et vérification des données d’exemple
- Requêtes SQL pour vérifier les contraintes (disponibilité, nombre de RDV par créneau)

## Conclusion détaillée

### Intérêt du projet
Ce projet permet de créer un site de gestion de rendez-vous simple et fonctionnel, inspiré de plateformes comme Doctolib. Il met en pratique la conception d’une base de données, la gestion de créneaux horaires, un calendrier réactif et des contraintes métier de base. C’est un bon exercice full-stack qui montre comment lier backend, base de données et interface utilisateur.

### Difficultés rencontrées
Le plus dur a été de **bien calibrer la base de données** :
- structure des tables avec clé composite (date + heure)
- migrations Flyway sans perte de données
- requêtes SQL pour vérifier la disponibilité en temps réel

Le calendrier réactif et l’intégration JSP + responsive ont aussi demandé plusieurs itérations.

### Ce que j’ai appris
- Concevoir un MCD pour un système de réservation
- Utiliser Flyway pour versionner la BDD
- Écrire des requêtes SQL efficaces pour les contraintes en temps réel
- Gérer une clé composite en JPA
- Intégrer un calendrier interactif avec JS et couleurs dynamiques
- Lier backend Java et frontend JSP

### Perspectives futures
- Ajouter un paramétrage des contraintes (ex : piscine 30 pers/h) via interface
- Afficher l’historique « Mes rendez-vous »
- Permettre de supprimer les rendez-vous d'une journée
- Ajouter la possibilité d'empêcher les utilisateurs de prendre des rendez-vous certains jours
- Multi-plannings (plusieurs types de créneaux sur le même site)
- Spring Security 