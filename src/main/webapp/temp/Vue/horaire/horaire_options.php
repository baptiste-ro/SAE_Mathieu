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
    $d_or_a = $content_pushed['column'];
    $forbidden = $content_pushed['forbidden'];

    if ($d_or_a == "departure") {
        $column = "Id_Port";
    } else {
        $column = "Id_Port_1";
    }

    // Initialisation du contenu de la requête
    $request = "SELECT DISTINCT (SELECT port.Libelle_Port FROM port WHERE port.Id_Port = liaison.$column) AS libelle, $column AS id FROM liaison";

    // Créé la requête
    $stmt = $conn->prepare($request);
    // $stmt->bind_param("s", $forbidden);

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