<?php

    //Inclusion de fichiers pour accéder à la racine du projet
    include "../getRacine.php";
    // Connexion à la base de données
    include "$racine/bdd/bdd.php";

    //Définit d'abord le type de contenu renvoyé par le script comme texte brut
    header('Content-Type: text/plain');

    // Vérifier la connexion
    if (!$conn) {
        // Renvoie d'une erreur si la connexion renvoie elle-même une erreur
        die('Erreur de connexion : ' . $conn->connect_error);
    }

    // Récupération du contenu de l'input ayant appelé la page.
    $content_pushed = json_decode(file_get_contents("php://input"), true);

    // Récupération du contenu, de la table à selectionner, ainsi que tu la variable ne pouvant pas être sélectionnée (Pour ne pas proposer le même port au départ et à l'arrivée)
    $id = $content_pushed['id'];
    $date = $content_pushed['date'];
    $time = $content_pushed['time'];
    $boat = $content_pushed['boat'];
    $places = $content_pushed['places'];

    $results = [];
    
    // Initialisation du contenu de la requête
    $request = "UPDATE traversee SET traversee.places_restantes = ?, traversee.date_Traversee = ?, traversee.HeureDepart_Trav = ?, Id_Bat = (SELECT Id_Bat FROM bateau WHERE Nom_Bat = ?) WHERE EXISTS (SELECT 1 FROM bateau WHERE Nom_Bat = ?) AND traversee.Id_Traversee = ?";

    // Création d'une preparedStatement pour exécuter la requête
    $stmt = $conn->prepare($request);
    $stmt->bind_param("issssi", $places, $date, $time, $boat, $boat, $id);

    // Exécution de la requête
    $stmt->execute();
    
    //Stocke dans $results le nombre de lignes affectées (modifiées) par la requête.
    $results[] = $stmt->affected_rows;

    //Nettoie la mémoire tampon de sortie (pour éviter tout autre texte envoyé avant).
    ob_clean();

    // Passage du type de résultat en format .json
    header('Content-Type: application/json');

    // Renvoie du contenu de $data en JSON
    echo json_encode($results);

    // Fermeture du preparedStatement
    $stmt->close();

    // Fermeture de la connection
    $conn->close();
?>