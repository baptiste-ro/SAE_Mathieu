<?php

//Démarre une session
    session_start();

    include "../../getRacine.php";
    // Connexion à la base de données
    include "$racine/bdd/bdd.php";

    // Vérifier la connexion
    if (!$conn) {
        // Renvoie d'une erreur si la connexion renvoie elle-même une erreur
        die('Erreur de connexion : ' . $conn->connect_error);
    }

    //Initialisation d’un tableau $variable
    $variable = [];

    //Début d’un bloc try pour gérer les erreurs éventuelles lors de l’exécution du code.
    try {
        //Initialisation d’un tableau $results pour stocker des résultats
        $results = [];

        //Lecture des données JSON envoyées dans la requête HTTP. Conversion de ces données JSON en tableau associatif PHP.
        $content_pushed = json_decode(file_get_contents("php://input"), true);

        //Récupération d’un identifiant id depuis les données reçues.
        $id = $content_pushed['id'];

        //Extraction de plusieurs valeurs depuis le tableau JSON
        $adults = $content_pushed['adults'];
        $juniors = $content_pushed['juniors'];
        $kids = $content_pushed['kids'];

        $short_cars = $content_pushed['short_cars'];
        $long_cars = $content_pushed['long_cars'];

        $vans = $content_pushed['vans'];
        $motorhomes = $content_pushed['motorhomes'];
        $trucks = $content_pushed['trucks'];

        //Regroupe toutes ces valeurs dans un tableau $max.
        $max = [$adults, $juniors, $kids, $short_cars, $long_cars, $vans, $motorhomes, $trucks];

        //Récupère l’identifiant du compte utilisateur connecté stocké dans la session.
        $compte = $_SESSION["Id_Compte"];
        
        // Initialisation du contenu de la requête
        $request = "INSERT INTO reservation (Id_Traversee, Id_Compte) VALUES (?,?)";

        // Création d'une preparedStatement pour exécuter la requête
        $stmt = $conn->prepare($request);
        $stmt->bind_param("ii", $id, $compte);

        // Exécution de la requête
        $stmt->execute();

        //Stockage dans $results du nombre de lignes affectées par l’insertion 
        $results[] = $stmt->affected_rows;

        //Nettoie (vide) le tampon de sortie pour éviter d’envoyer du contenu superflu avant les prochains headers ou la réponse.
        ob_clean();

        $request = "SELECT reservation.Id_Reservation FROM reservation ORDER BY Id_Reservation DESC LIMIT 1";

        //Prépare la requête
        $stmt = $conn->prepare($request);

        //exécute la requête
        $stmt->execute();

        // récupère le résultat.
        $temp = $stmt->get_result();

        //Extrait le champ Id_Reservation de la première ligne retournée, donc l’ID de la réservation juste insérée.
        $booking_id = $temp->fetch_assoc()["Id_Reservation"];
        //Ajoute cet ID dans le tableau $variable
        $variable[] = $booking_id;

        //Vide à nouveau le tampon de sortie.
        ob_clean();

        //Cette requête SQL récupère l’ID du tarif (Id_Tarif) associé à une traversée spécifique (Id_Traversee).
        $request = "SELECT DISTINCT traversee.Id_Tarif FROM traversee WHERE traversee.Id_Traversee = ?";

        //Préparation et exécution de la requête avec l’ID de traversée $id.
        $stmt = $conn->prepare($request);
        $stmt->bind_param("i", $id);

        //exécution de la requête
        $stmt->execute();
        $temp = $stmt->get_result();

        //Extraction de la valeur Id_Tarif.
        $price_id = $temp->fetch_assoc()["Id_Tarif"];
        //Stockage dans $price_id puis ajout dans $variable
        $variable[] = $price_id;

        //Nettoyage du tampon de sortie
        ob_clean();

        for ($i=0; $i < 8; $i++) { 
            if ($max[$i] > 0) {
                $request = "INSERT INTO billet (Id_Reservation, Id_Type, Id_Tarif)
                            SELECT id, type, tarif FROM (
                                WITH RECURSIVE traffic(id, type, tarif, n) AS (
                                    SELECT ?, ?, ?, 1
                                    UNION ALL 
                                    SELECT id, type, tarif, n + 1 FROM traffic WHERE n < ?
                                )
                                SELECT id, type, tarif FROM traffic
                            ) AS traffic2";

                // Création d'une preparedStatement pour exécuter la requête
                $stmt = $conn->prepare($request);
                $var = $i + 1;
                $curr_max = $max[$i];
                $stmt->bind_param("iiii", $booking_id, $var, $price_id, $curr_max);

                // Exécution de la requête
                $stmt->execute();

                //Stockage du nombre de lignes insérées dans $results
                $results[] = $stmt->affected_rows;

                //Nettoyage du tampon de sortie
                ob_clean();
            }
        }

        //Cette requête met à jour les colonnes places_restantes_A, places_restantes_B et places_restantes_C dans la table traversee.
        $request = "UPDATE traversee SET places_restantes_A = (places_restantes_A - ?), places_restantes_B = (places_restantes_B - ?), places_restantes_C = (places_restantes_C - ?) WHERE Id_Traversee = ?";

        //La requête est préparée pour éviter les injections SQL.
        $stmt = $conn->prepare($request);
        $places_taken_A = $adults + $juniors + $kids;
        $places_taken_B = $short_cars + $long_cars;
        $places_taken_C = $vans + $motorhomes + $trucks;
        $stmt->bind_param("iiii", $places_taken_A, $places_taken_B, $places_taken_C, $id);

        //La requête est exécutée
        $stmt->execute();

        //nettoie le tampon de sortie
        ob_clean();

        // Passage du type de résultat en format text
        header('Content-Type: application/json');

        // Renvoie du contenu de $results
        echo json_encode($results);

        //commit() confirme les modifications dans la base de données, ce qui indique que la transaction est validée.
        $conn->commit();

        // Fermeture du preparedStatement
        $stmt->close();

        // Fermeture de la connection
        $conn->close();
    } catch (Exception $e) {
        header('Content-Type: text/plain');
    }
?>