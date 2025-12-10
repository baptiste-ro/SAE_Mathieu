<?php

    include "../getRacine.php";
    // Connexion à la base de données
    include "$racine/bdd/bdd.php";

    // Vérifier la connexion
    if (!$conn) {
        // Renvoie d'une erreur si la connexion renvoie elle-même une erreur
        die('Erreur de connexion : ' . $conn->connect_error);
    }

    // Récupération du contenu de l'input ayant appelé la page.
    $content_pushed = json_decode(file_get_contents("php://input"), true);

    // Récupération du contenu, de la table à selectionner, ainsi que tu la variable ne pouvant pas être sélectionnée (Pour ne pas proposer le même port au départ et à l'arrivée)
    $code = $content_pushed['code'];
    $date = $content_pushed['date'];
    $time = $content_pushed['time'];

    // Initialisation du contenu de la requête
    $request = "SELECT Id_Traversee AS id, date_traversee AS date, HeureDepart_Trav AS time, (SELECT Nom_Bat FROM bateau WHERE Id_Bat = traversee.Id_Bat) AS boat, places_restantes_A AS places, (SELECT nbr_places.CapaciteMax FROM nbr_places WHERE Id_Bat = traversee.Id_Bat AND lettre = \"A\") AS max_places FROM traversee WHERE Code_Liaison = ? AND date_Traversee >= ? AND HeureDepart_Trav >= ? ORDER BY date, time";

    // Création d'une preparedStatement pour exécuter la requête
    $stmt = $conn->prepare($request);
    $stmt->bind_param("iss", $code, $date, $time);

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
    ob_clean();
    echo json_encode($data);

    // Fermeture du preparedStatement
    $stmt->close();

    // Fermeture de la connection
    $conn->close();
?>