<?php

    //Inclusion des fichiers nécessaires pour définir la racine du projet
    include "../../getRacine.php";
    // Connexion à la base de données
    include "$racine/bdd/bdd.php";

    // Vérifier la connexion
    if (!$conn) {
        // Renvoie d'une erreur si la connexion renvoie elle-même une erreur
        die('Erreur de connexion : ' . $conn->connect_error);
    }

    ////Initialisation d’un tableau vide qui contiendra les données à renvoyer.
    $data = [];
    
    // Initialisation du contenu de la requête
    $request = "SELECT DISTINCT Id_Tarif AS id FROM tarif";

    // Création d'une preparedStatement pour exécuter la requête
    $stmt = $conn->prepare($request);

    // Exécution de la requête
    $stmt->execute();

    //Récupère le résultat dans $results.
    $results = $stmt->get_result();

    //Si le résultat contient des lignes, boucle pour parcourir chaque ligne.
    if ($results->num_rows > 0) {
        // Parcours des lignes renvoyées par le résultat.
        while ($row = $results->fetch_assoc()) {
            // Ajout du contenu du select au tableau.
            $data[] = $row;
        }
    }

    //Vide le tampon de sortie
    ob_clean();

    // Passage du type de résultat en format text
    header('Content-Type: application/json');

    // Renvoie du contenu de $data
    echo json_encode($data);

    // Fermeture du preparedStatement
    $stmt->close();

    // Fermeture de la connection
    $conn->close();
?>