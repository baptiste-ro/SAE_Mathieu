<?php

    include "../../getRacine.php";
    // Connexion à la base de données
    include "$racine/bdd/bdd.php";

    // Vérifier la connexion
    if (!$conn) {
        // Renvoie d'une erreur si la connexion renvoie elle-même une erreur
        die('Erreur de connexion : ' . $conn->connect_error);
    }

    //Récupère les données envoyées en JSON via une requête HTTP.Ces données sont décodées en tableau associatif PHP.
    $content_pushed = json_decode(file_get_contents("php://input"), true);

    //On extrait les valeurs des clés date, time, boat, link, et price du tableau JSON reçu.
    $date = $content_pushed['date'];
    $time = $content_pushed['time'];
    $boat = $content_pushed['boat'];
    $link = $content_pushed['link'];
    $price = $content_pushed['price'];
    
    // Initialisation du contenu de la requête
    $request = "INSERT INTO traversee(date_Traversee, HeureDepart_Trav, Id_Bat, Code_Liaison, Id_Tarif, places_restantes) SELECT ?, ?, ?, ?, ?, (SELECT CapaciteMax FROM nbr_places WHERE Id_Bat = ? LIMIT 1)";

    // Création d'une preparedStatement pour exécuter la requête
    $stmt = $conn->prepare($request);
    $stmt->bind_param("ssiiii", $date, $time, $boat, $link, $price, $boat);

    // Exécution de la requête
    $stmt->execute();

    //Récupère le nombre de lignes affectées
    $results = $stmt->affected_rows;

    //Nettoie le buffer de sortie
    ob_clean();

    // Passage du type de résultat en format text
    header('Content-Type: text/plain');

    // Renvoie du contenu de $results
    echo json_encode($results);

    // Fermeture du preparedStatement
    $stmt->close();

    // Fermeture de la connection
    $conn->close();
?>