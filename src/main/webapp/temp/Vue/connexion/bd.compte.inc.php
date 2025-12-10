<?php
    include "../getRacine.php";
    // Connexion à la base de données
    include "$racine/bdd/bdd.php";

    // Vérifier la connexion
    if (!$conn) {
        die('Erreur de connexion : ' . $conn->connect_error);
    }

    // Vérifier si le formulaire est soumis en méthode POST
    // Cela évite d’exécuter le code lors d’un simple chargement de page.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = htmlspecialchars($_POST['Nom_Compte']);
        $prenom = htmlspecialchars($_POST['Prenom_Compte']);
        $mail = htmlspecialchars($_POST['Mail_Compte']);
        $mot_de_passe = $_POST['Mdp_Compte']; // On ne fait pas htmlspecialchars ici sur le mot de passe, car il faut le hacher brut
        $confirmation_mot_de_passe = $_POST['confirmation_mot_de_passe'];

        // Vérifier si les mots de passe correspondent
        //Si ce n’est pas le cas, le script s'arrête (die) et affiche une erreur.
        if ($mot_de_passe !== $confirmation_mot_de_passe) {
            die("Les mots de passe ne correspondent pas.");
        }

        // Hacher le mot de passe avec bcrypt
        $mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_DEFAULT);


        // Préparer la requête d’insertion avec le mot de passe haché
        $stmt = $conn->prepare("INSERT INTO compte (Mail_Compte, Nom_Compte, Prenom_Compte, Mdp_Compte) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $mail, $nom, $prenom, $mot_de_passe_hache);
        
        //Tente d’exécuter la requête préparée (insertion des données utilisateur dans la base).
        //Si elle réussit (pas d’erreur SQL, champs valides, email unique, etc.), on continue dans le if
        if ($stmt->execute()) {
            // Redirige l’utilisateur vers la page de connexion, car l’inscription s’est bien déroulée.
            //exit est important pour arrêter immédiatement l’exécution du script après la redirection (évite des erreurs ou affichages inutiles).
            header("Location: connexion.html.php");
            exit();
            //Si la requête échoue (par exemple, doublon de mail, problème de requête…), affiche un message d’erreur.
        } else {
            echo "Erreur : " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();

?>