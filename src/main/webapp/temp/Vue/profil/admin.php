<?php
    session_start();

    if(isset($_SESSION["connecté"])) {        
        include "../getRacine.php";
        // Connexion à la base de données
        include "$racine/bdd/bdd.php";
    
        // Vérifier la connexion
        if (!$conn) {
            // Renvoie d'une erreur si la connexion renvoie elle-même une erreur
            die('Erreur de connexion : ' . $conn->connect_error);
        }

        $Id = $_SESSION["Id_Compte"];
    
        $request = "WITH test AS (SELECT Count(*) AS count FROM administrateur WHERE administrateur.Id_Compte = ?)
                    SELECT 
                    CASE test.count > 0 
                        WHEN 1 THEN 't'
                        WHEN 0 THEN 'f'
                        ELSE 'f'
                    END AS admin
                    FROM test";
    
        $stmt = $conn->prepare($request);
        $stmt->bind_param('i', $Id);
        $stmt->execute();
    
        $res = $stmt->get_result();
    
        $is_admin = $res->fetch_assoc();
    
        header('Content-Type: text/plain');
        echo $is_admin['admin'];
    } else {
        echo 'null';
    }
?>