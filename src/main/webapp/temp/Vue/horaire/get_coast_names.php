<?php

    //Inclusion d’un fichier permettant d’obtenir la racine du projet.
    include "../../getRacine.php";
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
    $dep = $content_pushed['dep'];
    $arr = $content_pushed['arr'];

    // Initialisation du contenu de la requête
    $request = "SELECT (SELECT port.Libelle_Port FROM port WHERE Id_Port = ?) AS dep, (SELECT port.Libelle_Port FROM port WHERE Id_Port = ?) AS arr LIMIT 1";

    // Création d'une preparedStatement pour exécuter la requête
    $stmt = $conn->prepare($request);
    $stmt->bind_param("ii", $dep, $arr);

    // Exécution de la requête
    $stmt->execute();
    
    // Retrait des résultats
    $results = $stmt->get_result();

    $data = $results->fetch_assoc();

    // Passage du type de résultat en format .json
    header('Content-Type: application/json');

    // Nettoyage du buffer pour éviter toute sortie parasite
    ob_clean();
    //Envoi du tableau converti en JSON.
    echo json_encode($data);

    // Fermeture du preparedStatement
    $stmt->close();

    // Fermeture de la connection
    $conn->close();
?>