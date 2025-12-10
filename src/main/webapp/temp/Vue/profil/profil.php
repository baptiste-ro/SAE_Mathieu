<?php
//Assure que la session est démarrée
session_start();

//Vérifie que l'utilisateur est connecté
if (!isset($_SESSION["Id_Compte"])) {
    header("Location: connexion.html.php"); // Redirige vers la page de connexion si non connecté
    exit();
}
?>

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
    <script type="module" src="../js/profile.js" defer></script>
</head>

<body>
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
                <a style="background-color: #e36355;border-color: #e36355;" class="btn btn-primary rounded-pill py-2 px-4" id="disconnect">Se déconnecter</a>

          </div>
        </nav>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown active">Profil</h1>
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

   
    <div class="informations_compte" style="display: flex; flex-direction: column; align-items: center;">
           
        <div class="infos-regroupés" style="display: flex;">

            <img src="../public/profil.png" alt="image-profil" style="height:100px; width:100px;">

                <div class="bloc_infos" style="display: flex; flex-direction: column; align-items: flex-start; font-size: 15px; color:black;">
                    <p><?= htmlspecialchars($_SESSION['Nom_Compte'] ?? 'Non défini') ?></p> <p><?= htmlspecialchars($_SESSION['Prenom_Compte'] ?? 'Non défini') ?></p>
                    <p><?= htmlspecialchars($_SESSION['Mail_Compte'] ?? 'Non défini') ?></p>

                <div class="delete-account" style="font-size: 15px; height:60px; width:300px;">
                    <a href="supp_compte.php" class="btn btn-primary rounded-pill" style="background-color: #e36355; border-color: #e36355; text-size: 15px;">supprimer mon compte</a>
                </div>
            </div>
        </div>

            
        

            <div class="infos-dispersés" style="display: flex; flex-direction: column; align-items: stretch; font-size: 15px; background-color: #B2CCCE; padding: 12px; border-radius: 4px;">
                <div class="name-account">
                    <p style="color:black; background-color: #EEEEEE; border-radius: 4px; padding:5px;">Votre nom : <?= htmlspecialchars($_SESSION['Nom_Compte'] ?? 'Non défini') ?></p>
                </div>

                <div class="firstname-account">
                    <p style="color:black; background-color: #EEEEEE; border-radius: 4px; padding:5px;">Votre prenom : <?= htmlspecialchars($_SESSION['Prenom_Compte'] ?? 'Non défini') ?></p>
                </div>

                <div class="mail-account">
                    <p style="color:black; background-color: #EEEEEE; border-radius: 4px; padding:5px;">Votre email : <?= htmlspecialchars($_SESSION['Mail_Compte'] ?? 'Non défini') ?></p>
                </div>
        
                <a href="modifierProfil.php" style="color:white; background-color: #4D7EDD; border-radius: 4px; padding:5px;">Modifiez vos informations</a>
            </div>
        <!--<h2 style="text_in_blue;">Modifier mes informations</h2>
            <form action="modifierProfil.php" method="post">

                <label for="nom">Prénom :</label>
                    <input type="text" name="nom" value="<?= htmlspecialchars($_SESSION['Prenom_Compte'] ?? '') ?>" required><br>

                <label for="nom">Nom :</label>
                    <input type="text" name="nom" value="<?= htmlspecialchars($_SESSION['Nom_Compte'] ?? '') ?>" required><br>

                <label for="email">Email :</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($_SESSION['Email_Compte'] ?? '') ?>" required><br>

                <label for="ancien_mdp">Ancien mot de passe :</label>
                    <input type="password" name="ancien_mdp" required><br>

                <label for="nouveau_mdp">Nouveau mot de passe :</label>
                    <input type="password" name="nouveau_mdp"><br>

                <label for="confirmer_mdp">Confirmer le mot de passe :</label>
                    <input type="password" name="confirmer_mdp"><br>

                    <input type="submit" value="Mettre à jour">
            </form>-->
    </div>


    

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
