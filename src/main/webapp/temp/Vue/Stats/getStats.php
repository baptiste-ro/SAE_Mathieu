<?php

    include "../../getRacine.php";
    // Connexion à la base de données
    include "$racine/bdd/bdd.php";

    // Vérifier la connexion
    if (!$conn) {
        // Renvoie d'une erreur si la connexion renvoie elle-même une erreur
        die('Erreur de connexion : ' . $conn->connect_error);
    }

    // Récupération du contenu de l'input ayant appelé la page.
    $id = file_get_contents("php://input");

    // Initialisation du contenu de la requête
    $request = "SELECT traversee.Id_Traversee AS id,
                (SELECT nbr_places.CapaciteMax FROM nbr_places WHERE nbr_places.Id_Bat = traversee.Id_Bat AND nbr_places.lettre = 'A') - traversee.places_restantes_A AS CatA,
                (SELECT nbr_places.CapaciteMax FROM nbr_places WHERE nbr_places.Id_Bat = traversee.Id_Bat AND nbr_places.lettre = 'B') - traversee.places_restantes_B AS CatB,
                (SELECT nbr_places.CapaciteMax FROM nbr_places WHERE nbr_places.Id_Bat = traversee.Id_Bat AND nbr_places.lettre = 'C') - traversee.places_restantes_C AS CatC
                FROM traversee 
                WHERE traversee.date_Traversee > (SELECT periode.dateDebut AS 'start' FROM periode WHERE periode.idPeriode = ? LIMIT 1) 
                AND traversee.date_Traversee < (SELECT periode.dateFin AS 'end' FROM periode WHERE periode.idPeriode = ? LIMIT 1)";

    // Création d'une preparedStatement pour exécuter la requête
    $stmt = $conn->prepare($request);
    $stmt->bind_param("ii", $id, $id);

    // Exécution de la requête
    $stmt->execute();
    
    // Retrait des résultats
    $results = $stmt->get_result();
    
    // Initialisation du tableau qui contiendra le résultat de la requête
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