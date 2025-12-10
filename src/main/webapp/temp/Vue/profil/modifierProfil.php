<!DOCTYPE html>
<html lang="fr">

<head>
      <meta charset="utf-8">
    <title>Mariteam</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
 

    <!-- Permet de faire apparaitre les elements progressivement -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Lien avec le css -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Lien avec le css -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
<?php
        
// Affiche un message d'erreur s'il y en a 
// Initialisation des variables pour stocker les messages d'erreur ou de succès
$error = '';
$success = '';

if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php 
// Sinon affiche le message de succès s'il existe
elseif ($success): ?>
    <p style="color:green;"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<!-- Fin du Message d'erreur -->


    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>Mariteam</h1>
                <!-- <img src="img/logo.png" alt="Logo"> -->
          
   
					<!-- Navbar !-->
           
               <!-- Sert a former la navbar, a separer les éléments, ne pas les superposer et avoir le fond (photo) !-->
               <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <!-- Navbar pour naviguer et selectionner la page qu'on souhaite visiter !-->
                        <a href="../index.php" class="nav-item nav-link ">Accueil</a>
                        <a href="liaisons.html.php" class="nav-item nav-link">Liaisons</a>
                        <a href="tarifs.html.php" class="nav-item nav-link">Tarifs</a>
                        <a href="horaire.html.php" class="nav-item nav-link">Horaires</a>
                </div>
                <a href="deconnect.php" style="background-color: #e36355;border-color: #e36355;" class="btn btn-primary rounded-pill py-2 px-4">Se déconnecter</a>

          </div>
        </nav>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown active">Modification du Profil</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="../index.php">Accueil</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">profil</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

  

<?php

// Démarre la session pour accéder aux variables de session
session_start();

// Inclut les fichiers nécessaires pour localiser la base de données
include "../getRacine.php";
include "$racine/bdd/bdd.php";

// Initialise les variables de message pour les erreurs et succès
$error = '';
$success = '';

// Vérifie si l'utilisateur est connecté (sinon on bloque l'accès)
if (!isset($_SESSION['Id_Compte'])) {
    die("Erreur : utilisateur non connecté.");
}

// Vérifie si le formulaire est soumis (par la méthode POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupère les données envoyées par le formulaire ou vide par défaut
    $nom = $_POST['Nom_Compte'] ?? '';
    $email = $_POST['Mail_Compte'] ?? '';
    $ancien_mdp = $_POST['ancien_mdp'] ?? '';
    $nouveau_mdp = $_POST['nouveau_mdp'] ?? '';
    $confirmer_mdp = $_POST['confirmer_mdp'] ?? '';

    // Prépare la requête pour récupérer le mot de passe haché actuel de l'utilisateur
    $stmt = $conn->prepare("SELECT Mdp_Compte FROM compte WHERE Id_Compte = ?");
    $stmt->bind_param("i", $_SESSION['Id_Compte']); // Lie l'identifiant du compte
    $stmt->execute(); // Exécute la requête
    $stmt->bind_result($mdp_hash); // Lie le résultat (mot de passe haché)
    $stmt->fetch(); // Récupère la valeur du mot de passe haché
    $stmt->close(); // Ferme la requête préparée

    // Vérifie si le mot de passe actuel correspond à celui de la base
    if (!password_verify($ancien_mdp, $mdp_hash)) {
        $error = "Mot de passe actuel incorrect.";

    // Vérifie si les nouveaux mots de passe ne correspondent pas
    } elseif (!empty($nouveau_mdp) && $nouveau_mdp !== $confirmer_mdp) {
        $error = "Les nouveaux mots de passe ne correspondent pas.";

    } else {
        // Commence la requête de mise à jour
        $sql = "UPDATE compte SET Nom_Compte = ?, Mail_Compte = ?";
        $params = [$nom, $email];
        $types = "ss"; // Types des paramètres (2 strings)

        // Si un nouveau mot de passe est renseigné, on le hache et l'ajoute à la requête
        if (!empty($nouveau_mdp)) {
            $hash = password_hash($nouveau_mdp, PASSWORD_DEFAULT); // Hash du nouveau mot de passe
            $sql .= ", Mdp_Compte = ?";
            $params[] = $hash;
            $types .= "s"; // Un string supplémentaire
        }

        // Ajoute la clause WHERE pour modifier uniquement le compte de l'utilisateur connecté
        $sql .= " WHERE Id_Compte = ?";
        $params[] = $_SESSION['Id_Compte'];
        $types .= "i"; // Un entier pour l'ID

        // Prépare la requête finale avec tous les paramètres
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params); // Lie les types et les valeurs
        $stmt->execute(); // Exécute la mise à jour
        $stmt->close(); // Ferme la requête

        // Met à jour les valeurs en session
        $_SESSION['Nom_Compte'] = $nom;
        $_SESSION['Mail_Compte'] = $email;

        // Redirige vers la page profil avec succès
        header('Location: profil.php');
        exit;
    }
}


?>

<!-- Formulaire de modification du profil -->
<!-- Ajoute l'attribut onsubmit pour appeler la fonction JavaScript verifierMdp() avant l'envoi -->
<form method="post" onsubmit="return verifierMdp()" style="display: flex; flex-direction: column; align-items: center;">
    
    <div class="champs_modif" style="display: flex; flex-direction: column; align-items: stretch; font-size: 15px; background-color: #B2CCCE; padding: 12px; border-radius: 4px;">
    <!-- Champ pour modifier le nom, prérempli avec le nom actuel en session -->
     <div class="champ_nom" style="display: flex; flex-direction: column; align-items: center;">
        <label style="color: black;">Nom :</label>
        <input type="text" name="Nom_Compte" value="<?= htmlspecialchars($_SESSION['Nom_Compte'] ?? '') ?>" required><br>
    </div>
     <!-- Champ pour modifier le prenom, prérempli avec le prenom actuel en session -->
     <div class="champ_prenom" style="display: flex; flex-direction: column; align-items: center;">
        <label style="color: black;">Prénom :</label>
        <input type="text" name="Prenom_Compte" value="<?= htmlspecialchars($_SESSION['Prenom_Compte'] ?? '') ?>" required><br>
    </div>
    <!-- Champ pour modifier l'e-mail, prérempli avec l'e-mail actuel en session -->
     <div class="champ_mail" style="display: flex; flex-direction: column; align-items: center;">
        <label style="color: black;">Email :</label>
        <input type="email" name="Mail_Compte" value="<?= htmlspecialchars($_SESSION['Mail_Compte'] ?? '') ?>" required><br>
    </div>
    <!-- Champ pour entrer l'ancien mot de passe (obligatoire) -->
     <div class="champ_ancien-mdp" style="display: flex; flex-direction: column; align-items: center;">
        <label style="color: black;">Ancien mot de passe :</label>
        <input type="password" name="ancien_mdp" required><br>
    </div>
    <!-- Champ pour entrer un nouveau mot de passe (facultatif) -->
     <div class="champ_new-mdp" style="display: flex; flex-direction: column; align-items: center;">
        <label style="color: black;">Nouveau mot de passe (facultatif) :</label>
        <input type="password" id="nouveau_mdp" name="nouveau_mdp"><br>
    </div>  
    <!-- Champ pour confirmer le nouveau mot de passe -->
     <div class="champ_confirm-mdp" style="display: flex; flex-direction: column; align-items: center;"> 
        <label style="color: black;">Confirmer le nouveau mot de passe :</label>
        <input type="password" id="confirmer_mdp" name="confirmer_mdp"><br>
    </div>
    <!-- Bouton pour soumettre le formulaire -->
    <input type="submit" value="Mettre à jour" style="background-color: #4D7EDD; border-radius: 4px; padding:5px;">

    </div>
</form>

<!-- Script JavaScript qui vérifie que les deux nouveaux mots de passe sont identiques -->
<script>
// Fonction appelée au moment de soumettre le formulaire
function verifierMdp() {
    // Récupère la valeur du champ "nouveau mot de passe"
    const mdp = document.getElementById('nouveau_mdp').value;

    // Récupère la valeur du champ "confirmation du mot de passe"
    const confirmer = document.getElementById('confirmer_mdp').value;

    // Si au moins un des champs de mot de passe est rempli
    if (mdp !== '' || confirmer !== '') {
        // Vérifie si les deux champs sont identiques
        if (mdp !== confirmer) {
            // Si ce n’est pas le cas, affiche une alerte à l’utilisateur
            alert("Les nouveaux mots de passe ne correspondent pas.");

            // Empêche l'envoi du formulaire
            return false;
        }
    }

    // Si tout est bon ou si les champs sont vides (pas de changement), on envoie le formulaire
    return true;
}
</script>


     <!-- Footer Start -->

    <!-- Permet de placer les éléments -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <!-- Permet de fmettre la grande bande noir du bas -->
       <div class="container py-5">
           <!-- Permet de placer les éléments -->
           <div class="row g-5">
               <!-- Permet de ne pas faire d'espace entre chaque éléments -->
               <div class="col-lg-3 col-md-6">
                   <!-- Met le titre -->
                   <h4 class="text-white mb-3">Mariteam</h4>
                   <!-- Lien vers les autres pages du site sous le titre-->
                   <a href="../index.php">Accueil</a> <br>
                   <a href="liaisons.html.php">Liaisons</a> <br>
                   <a href="tarifs.html.php">Tarifs</a> <br>
                   <a href="horaire.html.php">Horaire</a> <br>
                   <a href="connexion.html.php"> Se connecter</a> <br>
                   <a href="rgpd.html"> RGPD</a> <br>


               </div>
               <!-- Permt de placer " Nous contacter" a droite des liens -->
               <div class="col-lg-3 col-md-6">
                   <!-- Met le titre -->
                   <h4 class="text-white mb-3">Nous contacter</h4>
                   <!-- Indique le mail sous le titre -->
                   <p class="mb-2"><i class="fa fa-envelope me-3"></i>Mariteam@voyage.com</p>
                  
               </div>
           </div>
       </div>
       <!-- Permet de mettre le texte au milieu -->
       <div class="container">
           <!-- Permet de mettre le texte dans la meme couleur -->
           <div class="copyright">
               <div class="row">
                   <!-- Permet de mettre le texte en dessous de la barre du bas -->
                   <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                       <!-- Peremt d'ecrire et d'indiquer les droits-->
                       &copy; <a class="border-bottom" href="../index.php">Mariteam</a>, All Right Reserved.
                       Designed By Tom Lelievre, Axel Wilfart, Baptiste Royer</a>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!-- Footer End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>
