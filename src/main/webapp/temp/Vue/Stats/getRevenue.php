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

    // Séparation de la chaine de caractère en un tableau de chaine de caractère (pour séparer les ID)
    $table = explode(",", $id);

    // Récupération du premier élément pour éviter d'avoir une virgule de trop
    $str = $table[0];

    // Ajout des autres ID à la chaine de caractère
    for ($i=1; $i < count($table); $i++) { 
        $str = $str . ", " . $table[$i];
    }

    // Initialisation du contenu de la requête
    $request = "WITH temp AS (SELECT billet.Id_Tarif, billet.Id_Type FROM billet WHERE billet.Id_Reservation IN (SELECT reservation.Id_Reservation FROM reservation WHERE reservation.Id_Traversee IN (" . $str . "))) SELECT COALESCE(SUM(tarif.Prix), 0) AS CA FROM tarif INNER JOIN temp ON tarif.Id_Tarif = temp.Id_Tarif AND tarif.Id_Type = temp.Id_Type";

    // Création d'une preparedStatement pour exécuter la requête
    $stmt = $conn->prepare($request);

    // Exécution de la requête
    $stmt->execute();
    
    // Retrait des résultats
    $results = $stmt->get_result()->fetch_assoc()['CA'];

    // Passage du type de résultat en format .json
    header('Content-Type: text/plain');

    // Renvoie du contenu de $data
    echo json_encode($results);

    // Fermeture du preparedStatement
    $stmt->close();

    // Fermeture de la connection
    $conn->close();
?>