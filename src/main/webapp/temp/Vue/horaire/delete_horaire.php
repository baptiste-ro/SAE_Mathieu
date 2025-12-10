<?php

//Cette ligne inclut un fichier externe nommé getRacine.php situé dans le dossier parent
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
    //Création d’un tableau vide $results. Il servira à stocker des résultats.
    $results = [];
    
    // Cette ligne définit une requête SQL qui va supprimer tous les billets liés à une traversée.
    $request = "DELETE FROM billet WHERE billet.Id_Reservation IN (SELECT reservation.Id_Reservation FROM reservation WHERE reservation.Id_Traversee = ?)";

    // Création d'une preparedStatement pour exécuter la requête. C’est plus sécurisé et protège contre les injections SQL.
    $stmt = $conn->prepare($request);
    // On associe la variable $id à la requête préparée. "i" signifie que c’est un entier (integer)
    $stmt->bind_param("i", $id);

    // Cette ligne exécute la requête. Les billets concernés seront supprimés de la base.
    $stmt->execute();
    //On ajoute au tableau $results le nombre de billets supprimés.
    // affected_rows donne le nombre de lignes impactées par la dernière requête exécutée
    $results[] = $stmt->affected_rows;

    // Cette ligne vide le tampon de sortie PHP
    ob_clean();

    // On prépare une nouvelle requête SQL, cette fois pour supprimer directement les réservations liées à la traversée.
    //Elle vise la table reservation, toujours en se basant sur le même identifiant $id
    $request = "DELETE FROM reservation WHERE reservation.Id_Traversee = ?";

    // Création d'une preparedStatement pour exécuter la requête
    $stmt = $conn->prepare($request);
    //On associe la variable $id à la requête. "i" signifie que l’on passe un entier.
    $stmt->bind_param("i", $id);

    // Exécution de la requête : les réservations liées à cette traversée seront supprimées.
    $stmt->execute();

    //On ajoute au tableau $results le nombre de lignes supprimées
    $results[] = $stmt->affected_rows;

    //On vide à nouveau le tampon de sortie.
    // Cela évite tout texte inutile ou affichage parasite si on renvoie une réponse JSON à la fin.
    ob_clean();

    //On prépare une troisième requête SQL, cette fois pour supprimer la traversée elle-même.
    // On supprime maintenant l'entrée de la table traversee dont l’Id_Traversee correspond à $id.
    $request = "DELETE FROM traversee WHERE traversee.Id_Traversee = ?";

    // Création d'une preparedStatement pour exécuter la requête
    $stmt = $conn->prepare($request);
    //On associe à nouveau la variable $id à la requête.
    //Cela garantit que c’est toujours la même traversée qui est ciblée, dans les trois suppressions successives :
    $stmt->bind_param("i", $id);

    // Exécution de la requête : la traversée est définitivement supprimée de la base de données.
    $stmt->execute();

    //On ajoute au tableau $results le nombre de traversées supprimées (devrait être 1 si tout se passe bien)
    $results[] = $stmt->affected_rows;

    //Encore une fois, on nettoie le tampon de sortie
    ob_clean();


    //Cette ligne change le type de contenu (Content-Type) de la réponse HTTP envoyée par le serveur
    header('Content-Type: application/json');

    // Renvoie du contenu de $data
    //Cette ligne convertit le tableau PHP $results en JSON et l’envoie en réponse
    echo json_encode($results);

    // Fermeture du preparedStatement
    $stmt->close();

    // Fermeture de la connection à la base de données
    $conn->close();
?>