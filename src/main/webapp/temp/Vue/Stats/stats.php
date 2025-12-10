<?php

    include "../../getRacine.php";
    // Connexion à la base de données
    include "$racine/bdd/bdd.php";

    // Vérifier la connexion
    if (!$conn) {
        // Renvoie d'une erreur si la connexion renvoie elle-même une erreur
        die('Erreur de connexion : ' . $conn->connect_error);
    }

    // Initialisation de la requête
    $request = "SELECT DISTINCT periode.idPeriode AS id, periode.dateDebut AS 'start', periode.dateFin AS 'end' FROM periode";

    // Préparation et exécution de la requête
    $stmt = $conn->prepare($request);
    $stmt->execute();
    
    // Retrait des résultats
    $results = $stmt->get_result();

    // Instanciation du tableau qui contiendra les résultats
    $data = [];

    // Parcours du résultat
    if ($results->num_rows > 0) {
        // Parcours des lignes renvoyées par le résultat.
        while ($row = $results->fetch_assoc()) {
            // Ajout du contenu du select au tableau.
            $data[] = $row;
        }
    }

    // Passage du type de résultat en format .json
    header('Content-Type: application/json');

    // Renvoie du contenu de $data
    echo json_encode($data);

    // Fermeture du preparedStatement
    $stmt->close();

    // Fermeture de la connection
    $conn->close();

?>