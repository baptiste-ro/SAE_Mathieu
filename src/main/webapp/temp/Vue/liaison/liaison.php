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
    $content = $content_pushed['content'] . "%";
    $table = $content_pushed['table'];
    $forbidden = $content_pushed['forbidden'];

    // Définition de la colonne à selectionner en fonction de la table
    if ($table == 'secteur') {
        $column = 'Nom_Secteur';
    } else if ($table == 'port') {
        $column = 'Libelle_Port';
    }

    // Initialisation du contenu de la requête
    $request = "SELECT $column FROM $table WHERE $column LIKE ? AND $column <> ?";

    // Création d'une preparedStatement pour exécuter la requête
    $stmt = $conn->prepare($request);
    $stmt->bind_param("ss", $content, $forbidden);

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