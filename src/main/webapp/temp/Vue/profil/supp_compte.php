<?php
// Démarre la session pour accéder à la variable de session utilisateur
session_start();

// Inclut les fichiers nécessaires pour trouver la racine et se connecter à la base de données
include "../getRacine.php";
include "$racine/bdd/bdd.php";

// Vérifie que l'utilisateur est connecté (sinon, on bloque la suppression)
if (!isset($_SESSION['Id_Compte'])) {
    die("Accès refusé. Tu dois être connecté pour supprimer ton compte.");
}

// Récupère l'identifiant de l'utilisateur connecté depuis la session
$idCompte = $_SESSION['Id_Compte'];

// Prépare la requête SQL pour supprimer le compte de l'utilisateur
$stmt = $conn->prepare("DELETE FROM compte WHERE Id_Compte = ?");
$stmt->bind_param("i", $idCompte); // Associe l'identifiant en tant qu'entier (i = integer)

// Exécute la requête
if ($stmt->execute()) {
    // Si la suppression réussit, on détruit la session pour déconnecter l'utilisateur
    session_destroy();

    // Redirige l'utilisateur vers la page d'accueil
    header("Location: ../index.php");
    exit();
} else {
    // En cas d'erreur lors de la suppression (problème base de données, etc.)
    echo "Erreur lors de la suppression du compte : " . $stmt->error;
}

// Ferme la requête et la connexion à la base
$stmt->close();
$conn->close();
?>
