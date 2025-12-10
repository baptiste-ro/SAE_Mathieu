<?php

    include "../getRacine.php";
    // Connexion à la base de données
    include "$racine/bdd/bdd.php";

    // Vérifier la connexion
    if (!$conn) {
        // Renvoie d'une erreur si la connexion renvoie elle-même une erreur
        die('Erreur de connexion : ' . $conn->connect_error);
    }

    // Récupérer l'ID de la traversée depuis la requête POST
    $idTraversee = file_get_contents('php://input');

    //Vérifie que l’ID reçu n’est pas vide avant de poursuivre.
    if (!empty($idTraversee)) {
        // Requête pour récupérer les tarifs groupés par catégorie et type
        $request = "SELECT 
            c.Nom_Categorie,
            ty.Libelle_Type,
            t.Prix,
            p.dateDebut,
            p.dateFin
        FROM tarif t
        JOIN type ty ON t.Id_Type = ty.Id_Type
        JOIN categorie c ON ty.lettre = c.lettre
        JOIN periode p ON t.idPeriode = p.idPeriode
        WHERE t.Id_Tarif IN (
            SELECT Id_Tarif 
            FROM traversee 
            WHERE Id_Traversee = ?
        )
        ORDER BY c.Nom_Categorie, ty.Libelle_Type";

        $stmt = $conn->prepare($request);
        $stmt->bind_param("i", $idTraversee);
        $stmt->execute();
        $result = $stmt->get_result();

        //Crée un tableau associatif vide avec 3 catégories 
        $data = [
            'passagers' => [],
            'vehicules_moins_2m' => [],
            'vehicules_plus_2m' => []
        ];

        //On parcourt chaque ligne du résultat.
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tarif = [
                    //On crée un petit tableau $tarif contenant type, prix et periode
                    'type' => $row['Libelle_Type'],
                    'prix' => $row['Prix'],
                    'periode' => $row['dateDebut'] . ' - ' . $row['dateFin']
                ];

                switch ($row['Nom_Categorie']) {
                    case 'Passagers':
                        $data['passagers'][] = $tarif;
                        break;
                    case 'Véhicules < 2m':
                        $data['vehicules_moins_2m'][] = $tarif;
                        break;
                    case 'Véhicules > 2m':
                        $data['vehicules_plus_2m'][] = $tarif;
                        break;
                }
            }
        }

        //On indique que la réponse sera du type JSON.
        header('Content-Type: application/json');
        //Puis on renvoie les données structurées
        echo json_encode($data);
        //Si $idTraversee est vide ou absent, on retourne une erreur JSON.
    } else {
        echo json_encode(['error' => 'Aucun ID de traversée fourni']);
    }

    // Fermeture du preparedStatement
    $stmt->close();

    // Fermeture de la connection
    $conn->close();
?>