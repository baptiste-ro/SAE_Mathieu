<?php
session_start();
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']); // Pour ne pas afficher le message plusieurs fois
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <!-- Affiche "MarieTeam" dans l’onglet du navigateur -->
    <title>Mariteam</title>
    <!-- Rend le site responsive -->
    <meta content="width=device-width, initial-scale=1.0" name="viewport">


   
    <!-- Permet de faire apparaitre les elements progressivement -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <!--  Date/heure avec Bootstrap -->
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Feuille de style Bootstrap (structure et composants)-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Lien avec le css -->
    <link href="../css/style.css" rel="stylesheet">

    <script type="module" src="../js/connexion.js" defer></script>
</head>
<body>

     <!-- Navbar & Hero Start -->
     <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>Mariteam</h1>
                <!-- <img src="img/logo.png" alt="Logo"> -->
          
   
					<!-- Navbar !-->
           
               <!-- Permet à la navbar d’être réduite sur mobile et dépliée (expand) sur les écrans larges. 
                Utilise Bootstrap pour rendre la barre de navigation responsive  !-->
               <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <!-- Navbar pour naviguer et selectionner la page qu'on souhaite visiter !-->
                        <a href="../index.php" class="nav-item nav-link ">Accueil</a>
                        <a href="liaisons.html.php" class="nav-item nav-link">Liaisons</a>
                        <a href="tarifs.html.php" class="nav-item nav-link">Tarifs</a>
                        <a href="horaire.html.php" class="nav-item nav-link ">Horaires</a>
                </div>
                <a href="connexion.html.php" class="btn btn-primary rounded-pill py-2 px-4">Se connecter</a>

          </div>
        </nav>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <!-- Un autre conteneur de largeur fixe pour contenir le contenu de la section (ce qui permet de ne pas avoir le texte collé aux bords de l'écran). -->
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown active">Se connecter</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Formulaire Start -->

    <div class="container" style="display: flex; flex-direction: column; flex-wrap: nowrap; align-items: center;">
   
    <form action="connect.php" method="POST" style="background-color: #B2CCCE; padding: 12px; border-radius: 4px;">
            
            <div class="champ_mail" style="display: flex; flex-direction: column; align-items: center;">
            <label for="Mail_Compte" style="color: black;">Email :</label>
            <input type="mail" id="Mail_Compte" name="Mail_Compte" required>
            </div>

            <br>

            <div class="champ_mdp" style="display: flex; flex-direction: column; align-items: center;">
            <label for="Mdp_Compte" style="color: black;">Mot de passe :</label>
            <input type="password" id="Mdp_Compte" name="Mdp_Compte" required>
            </div>
            <br>
         
        
            <div class="boutons_valid" style="display: flex; flex-direction: row; justify-content: center;">
                <button style="color: white; background-color: #4D7EDD; border-radius: 4px; padding:5px; margin-right: 5px;" id="valid_form">Se connecter</button>
                <button type="reset" style="color: white; background-color: #4D7EDD; border-radius: 4px; padding:5px;">Tout effacer</button>
            </div>
<br>

    <?php if ($error): ?>
    <p style="color: red; margin-top: 10px;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

        <br>
        <a href="creerUnCompte.html" style="color: black;">Pas encore de compte ? Créer un compte</a>
        </form>
    
        <div class="drop drop-1"></div>
        <div class="drop drop-2"></div>
        <div class="drop drop-3"></div>
        <div class="drop drop-4"></div>
        <div class="drop drop-5"></div>
    </div>

    <!-- Formulaire End -->
    

<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">Mariteam</h4>
                <a href="../index.php">Accueil</a> <br>
                <a href="liaisons.html.php">Liaisons</a> <br>
                <a href="tarifs.html.php">Tarifs</a> <br>
                <a href="horaire.html.php">Horaires</a> <br>
                <?php
                    // Cette condition vérifie si la variable de session $_SESSION["connecté"] n'est pas définie (c’est-à-dire que l’utilisateur n’est pas connecté).
                    if (!isset($_SESSION["connecté"])) {
                        //Si l'utilisateur n'est pas connecté, on affiche un bouton "Se connecter" qui redirige vers la page de connexion (connexion.html.php).
                        echo "<a href='connexion.html.php'>Se connecter</a>";
                        // Sinon, donc si l'utilisateur est connecté
                    } else {
                        //on affiche un lien vers la page de profil de l'utilisateur (profil.php), avec le même style de bouton.
                        echo "<a href='profil.php'>Mon Profil</a>";
                    }
                    ?> <br>
                <a href="rgpd.html"> RGPD</a> <br>

            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">Nous contacter</h4>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>Mariteam@voyage.com</p>
               
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">Mariteam</a>, All Right Reserved.
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
