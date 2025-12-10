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

    //Initialisation d’un tableau vide qui contiendra les données à renvoyer.
    $data = [];
    
    // Initialisation du contenu de la requête
    $request = "SELECT Code_Liaison AS code, (SELECT Libelle_Port FROM port WHERE liaison.Id_Port = port.Id_Port) AS departure, (SELECT Libelle_Port FROM port WHERE liaison.Id_Port_1 = port.Id_Port) AS arrival FROM liaison";

    // Création d'une preparedStatement pour exécuter la requête
    $stmt = $conn->prepare($request);

    // Exécution de la requête
    $stmt->execute();

    //Récupére les résultats
    $results = $stmt->get_result();

    //Parcourt chaque ligne de résultat, ajoute les données dans le tableau $data.
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