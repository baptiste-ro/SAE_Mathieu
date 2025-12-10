<?php
//getRacine.php : détermine le chemin racine du projet.
include "../getRacine.php";
//bdd.php : contient les informations de connexion à la base de données 
include "$racine/bdd/bdd.php";

//Si la connexion échoue, on arrête l'exécution du script avec un message d’erreur.
if (!$conn) {
    die('Erreur de connexion : ' . $conn->connect_error);
}

$request = "SELECT 
    t.Id_Traversee,
    t.date_Traversee,
    t.HeureDepart_Trav,
    b.Nom_Bat,
    p1.Libelle_Port as port_depart,
    p2.Libelle_Port as port_arrivee,
    s.Nom_Secteur
FROM traversee t
JOIN bateau b ON t.Id_Bat = b.Id_Bat
JOIN liaison l ON t.Code_Liaison = l.Code_Liaison
JOIN port p1 ON l.Id_Port = p1.Id_Port
JOIN port p2 ON l.Id_Port_1 = p2.Id_Port
JOIN secteur s ON l.Id_Secteur = s.Id_Secteur
ORDER BY t.date_Traversee";

$result = $conn->query($request);

//Pour chaque ligne renvoyée par la requête SQL, on crée un tableau
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'id_Traversee' => $row['Id_Traversee'],
            'nom_traversee' => $row['Nom_Bat'] . ' - ' . $row['port_depart'] . ' → ' . $row['port_arrivee'] . ' (' . $row['Nom_Secteur'] . ')',
            'date' => $row['date_Traversee'],
            'heure' => $row['HeureDepart_Trav']
        ];
    }
}

//Indique au navigateur que la réponse est au format JSON.
header('Content-Type: application/json');
//Envoie le tableau $data converti en JSON
echo json_encode($data);

//ferme proprement la connexion à la base.
$conn->close();
?>
