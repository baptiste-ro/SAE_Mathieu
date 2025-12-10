<?php

    include "../getRacine.php";
    // Connexion à la base de données
    include "$racine/bdd/bdd.php";

    // Vérifier la connexion
    if (!$conn) {
        // Renvoie d'une erreur si la connexion renvoie elle-même une erreur
        die('Erreur de connexion : ' . $conn->connect_error);
    }

    // On récupère les données envoyées en JSON via POST
    $inputs_content = json_decode(file_get_contents("php://input"), true);

    // Récupération du contenu des trois inputs
    $secteur = $inputs_content['secteur'] . "%";
    $departure = $inputs_content['departure'] . "%";
    $arrival = $inputs_content['arrival'] . "%";

    // Initialisation du contenu de la requête
    $request = "SELECT Nom_Secteur AS secteur, (SELECT Libelle_Port FROM port WHERE liaison.Id_Port = port.Id_Port) AS depart, (SELECT Libelle_Port FROM port WHERE liaison.Id_Port_1 = port.Id_Port) AS arrivee, Code_Liaison AS liaison, DistanceEnMillesMarin AS distance FROM liaison LEFT JOIN secteur USING(Id_Secteur) WHERE Nom_Secteur LIKE ? AND Id_Port IN (SELECT Id_Port FROM port WHERE Libelle_Port LIKE ?) AND Id_Port_1 IN (SELECT Id_Port FROM port WHERE Libelle_Port LIKE ?)";

    // Création d'une preparedStatement pour exécuter la requête
    $stmt = $conn->prepare($request);
    $stmt->bind_param("sss", $secteur, $departure, $arrival);

    // Exécution de la requête
    $stmt->execute();
    
    //récupère les résultats sous forme d’objet.
    $results = $stmt->get_result();
    
    // Initialisation du tableau qui contiendra le résultat de la requête
    $data = [];

    // on vérifie s’il y a au moins une ligne de résultat.
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
    //json_encode($data) convertit le tableau PHP en chaîne JSON.
    //echo l’envoie en réponse à la requête HTTP.
    echo json_encode($data);

    // Fermeture du preparedStatement
    $stmt->close();

    // Fermeture de la connection
    $conn->close();
?>