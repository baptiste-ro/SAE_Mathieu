<?php
    session_start();

    include "../getRacine.php";
    include "$racine/bdd/bdd.php";

    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }

    // Récupération du contenu de l'input ayant appelé la page.
    $content_pushed = json_decode(file_get_contents("php://input"), true);

    $mail = $content_pushed['Mail_Compte'];
    $password = $content_pushed['Mdp_Compte'];

    $stmt = $conn->prepare("SELECT Id_Compte, Nom_Compte, Prenom_Compte, Mdp_Compte FROM compte WHERE Mail_Compte = ?");
    $stmt->bind_param("s", $mail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($Id_Compte, $Nom_Compte, $Prenom_Compte, $hashStocke);
        $stmt->fetch();

        if (password_verify($password, $hashStocke)) {
            // Enregistre toutes les infos utiles en session
            $_SESSION["connecté"] = true;
            $_SESSION['Id_Compte'] = $Id_Compte;
            $_SESSION['Mail_Compte'] = $mail;
            $_SESSION['Nom_Compte'] = $Nom_Compte;
            $_SESSION['Prenom_Compte'] = $Prenom_Compte;

            // Passage du type de résultat en format .json
            header('Content-Type: text/plain');

            // Renvoie du contenu de $data
            echo "true";
        } else {
                // Passage du type de résultat en format .json
            header('Content-Type: text/plain');

            // Renvoie du contenu de $data
            echo "Mot de passe incorrect.\n[" . $hashStocke . ":" . $password ."]";
        }
    } else {
        echo "Compte introuvable.\n" . $content_pushed;
    }

    $stmt->close();
    $conn->close();
?>
