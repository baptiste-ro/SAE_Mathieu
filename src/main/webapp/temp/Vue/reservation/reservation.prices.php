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
    $id = file_get_contents("php://input");

    // Initialisation du contenu de la requête
    //Objectif : récupérer le prix (Prix) et le type de tarif (Libelle_Type) pour une traversée donnée.
    $request = "SELECT tarif.Prix AS price, (SELECT type.Libelle_Type FROM type WHERE type.Id_Type = tarif.Id_Type) AS type FROM tarif WHERE tarif.Id_Tarif = (SELECT DISTINCT traversee.Id_Tarif FROM traversee WHERE traversee.Id_Traversee = ?);";

    // Création d'une preparedStatement pour exécuter la requête
    $stmt = $conn->prepare($request);
    $stmt->bind_param("i", $id);

    // Exécution de la requête
    $stmt->execute();
    
    // Retrait des résultats
    $results = $stmt->get_result();
    
    // Initialisation du tableau qui contiendra le résultat de la requête
    $data = [];

    // Vérifie si la requête SQL a retourné au moins une ligne.
    if ($results->num_rows > 0) {
        // Parcours des lignes renvoyées par le résultat.
        while ($row = $results->fetch_assoc()) {
            // Ajout du contenu du select au tableau.
            $data[] = $row;
        }
    }

    // Passage du type de résultat en format .json
    header('Content-Type: application/json');

    //Vide le tampon de sortie, garantit que la réponse contient uniquement du JSON.
    ob_clean();
    //Convertit le tableau $data en chaîne JSON et l’envoie au client.
    echo json_encode($data);

    // Fermeture du preparedStatement
    $stmt->close();

    // Fermeture de la connection
    $conn->close();
?>