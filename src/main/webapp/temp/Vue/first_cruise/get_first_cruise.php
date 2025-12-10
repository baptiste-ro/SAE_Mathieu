<?php

    //Inclusion d’un fichier pour récupérer la racine du projet
    include "../../getRacine.php";
    // Connexion à la base de données
    include "$racine/bdd/bdd.php";

    // Vérifier la connexion
    if (!$conn) {
        // Renvoie d'une erreur si la connexion renvoie elle-même une erreur
        die('Erreur de connexion : ' . $conn->connect_error);
    }

    // Récupération du contenu de l'input ayant appelé la page.
    $content_pushed = file_get_contents("php://input");

    // Initialisation du contenu de la requête
    $request = "SELECT traversee.Id_Traversee AS id FROM traversee WHERE Code_Liaison = ? LIMIT 1";

    // Création d'une preparedStatement pour exécuter la requête
    $stmt = $conn->prepare($request);
    $stmt->bind_param("i", $content_pushed);

    // Exécution de la requête
    $stmt->execute();
    
    // Retrait des résultats
    $results = $stmt->get_result();
    
    // Initialisation du tableau qui contiendra le résultat de la requête
    $data = $results->fetch_assoc();

    // Passage du type de résultat en format .json
    header('Content-Type: text/plain');

    // Renvoie du contenu de $data
    ob_clean();

    echo $data['id'];

    // Fermeture du preparedStatement
    $stmt->close();

    // Fermeture de la connection
    $conn->close();
?>